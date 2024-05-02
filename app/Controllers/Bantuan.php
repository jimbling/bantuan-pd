<?php

namespace App\Controllers;

use App\Models\PipModel;
use App\Models\MasterDataModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


class Bantuan extends BaseController
{

    protected $pipModel;
    protected $masterdataModel;

    public function __construct()
    {

        $this->pipModel = new PipModel();
        $this->masterdataModel = new MasterDataModel();
    }


    public function index()
    {
        $csrfToken = csrf_hash();
        $selectedYear = $this->request->getVar('selectYear');
        $selectedTahap = $this->request->getVar('selectTahap');
        $selectedDana = $this->request->getVar('selectDana');

        $pipModel = new PipModel();

        // Jika tidak ada filter tahun yang dipilih, atur tahun berjalan sebagai nilai default
        if (empty($selectedYear)) {
            $selectedYear = date('Y');
        }

        if (empty($selectedTahap) && empty($selectedDana)) {
            // Jika tidak ada filter Tahap dan Dana, ambil data untuk tahun yang dipilih
            $siswaPip = $pipModel->getSiswaPipByYear($selectedYear);
        } else {
            // Jika ada filter Tahap atau Dana, gunakan metode filter yang sesuai
            $siswaPip = $pipModel->getSiswaPipByYearTahapDana($selectedYear, $selectedTahap, $selectedDana);
        }

        $uniqueYears = $pipModel->getUniqueYearsFromTanggalSK();
        $uniqueTahaps = $pipModel->getUniqueTahapsByYear($selectedYear);
        $uniqueDanas = $pipModel->getUniqueDanas();
        $currentYear = date('Y');


        $data = [
            'judul' => 'Siswa Penerima PIP',
            'siswa_pip' => $siswaPip,
            'uniqueYears' => $uniqueYears,
            'uniqueTahaps' => $uniqueTahaps,
            'uniqueDanas' => $uniqueDanas,
            'selectedYear' => $selectedYear,
            'selectedTahap' => $selectedTahap,
            'selectedDana' => $selectedDana,
            'currentYear' => $currentYear,
            'csrfToken' => $csrfToken,

        ];

        return view('admin/bantuan', $data);
    }




    public function importData()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
        $request = service('request');

        if ($request->getMethod() === 'post' && $request->getFile('excel_file')->isValid()) {
            $excelFile = $request->getFile('excel_file');

            // Pastikan folder penyimpanan untuk file Excel sudah ada
            $uploadPath = WRITEPATH . 'uploads';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Pindahkan file yang diunggah ke folder penyimpanan
            $excelFileName = $excelFile->getRandomName();
            $excelFile->move($uploadPath, $excelFileName);

            // Proses file Excel (misalnya menggunakan library PhpSpreadsheet)
            $reader = IOFactory::load($uploadPath . '/' . $excelFileName);
            $worksheet = $reader->getActiveSheet();
            $rows = $worksheet->toArray();

            $pipModel = new \App\Models\PipModel();

            foreach ($rows as $row) {
                // Buat data siswa dari baris Excel
                $peserta_didik_id = $row[0];
                $sekolah_id = $row[1];
                $npsn = $row[2];
                $nomenklatur = $row[3];
                $kelas = $row[4];
                $rombel = $row[5];
                $nama_pd = $row[6];
                $nama_ibu_kandung = $row[7];
                $nama_ayah = $row[8];
                $tanggal_lahir = $row[9];
                $tempat_lahir = $row[10];
                $nisn = $row[11];
                $nik = $row[12];
                $jenis_kelamin = $row[13];
                $nominal = $row[14];
                $no_rekening = str_replace("'", "", $row[15]);
                $tahap_id = $row[16];
                $nomor_sk = $row[17];
                $tanggal_sk = $row[18];
                $nama_rekening = $row[19];
                $tanggal_cair = $row[20];
                $status_cair = $row[21];
                $no_KIP = $row[22];
                $no_KKS = $row[23];
                $no_KPS = $row[24];
                $virtual_acc = $row[25];
                $nama_kartu = $row[26];
                $semester_id = $row[27];
                $layak_pip = $row[28];
                $keterangan_pencairan = $row[29];
                $confirmation_text = $row[30];
                $tahap_keterangan = $row[31];

                // Pengecekan dan pengisian kolom 'sk' berdasarkan nilai pada kolom 'tahap_keterangan'
                $sk = '';
                $tahap_keterangan_lower = strtolower($tahap_keterangan); // Ubah ke huruf kecil untuk pencocokan yang tidak bersifat case-sensitive
                if (strpos($tahap_keterangan_lower, 'nominasi') !== false) {
                    $sk = 'nominasi';
                } elseif (strpos($tahap_keterangan_lower, 'pemberian') !== false) {
                    $sk = 'pemberian';
                }

                $data = [
                    'peserta_didik_id' => $row[0],
                    'sekolah_id' => $row[1],
                    'npsn' => $row[2],
                    'nomenklatur' => $row[3],
                    'kelas' => $row[4],
                    'rombel' => $row[5],
                    'nama_pd' => $row[6],
                    'nama_ibu_kandung' => $row[7],
                    'nama_ayah' => $row[8],
                    'tanggal_lahir' => $row[9],
                    'tempat_lahir' => $row[10],
                    'nisn' => $row[11],
                    'nik' => $row[12],
                    'jenis_kelamin' => $row[13],
                    'nominal' => $row[14],
                    'no_rekening' => $no_rekening,
                    'tahap_id' => $row[16],
                    'nomor_sk' => $row[17],
                    'tanggal_sk' => $row[18],
                    'nama_rekening' => $row[19],
                    'tanggal_cair' => $row[20],
                    'status_cair' => $row[21],
                    'no_KIP' => $row[22],
                    'no_KKS' => $row[23],
                    'no_KPS' => $row[24],
                    'virtual_acc' => $row[25],
                    'nama_kartu' => $row[26],
                    'semester_id' => $row[27],
                    'layak_pip' => $row[28],
                    'keterangan_pencairan' => $row[29],
                    'confirmation_text' => $row[30],
                    'tahap_keterangan' => $row[31],
                    'sk' => $sk


                    // Lanjutkan dengan kolom lainnya
                ];

                $insertedId = $pipModel->insertPip($data);

                $data = [
                    'peserta_didik_id' => $row[0],
                    'sekolah_id' => $row[1],
                    'confirmation_text' => $row[30],
                    'tahap_keterangan' => $row[31],

                    // Tambahkan kolom 'no_surat' dengan format yang diinginkan
                    'no_surat' => '422.5/' . $row[16] . '/' . $insertedId,
                ];

                $pipModel->updatePip($insertedId, $data); // Update data dengan no_surat yang sesuai
            }


            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diimpor']);
        }

        return redirect()->to('/siswa')->with('error', 'Terjadi kesalahan dalam pengunggahan data.');
    }
    // Fungsi untuk menghasilkan no_surat sesuai format
    private function generateNoSurat($tahap_id, $nisn)
    {
        // Contoh format no_surat: 422.5/Tahap/Id
        return "422.5/{$tahap_id}/{$nisn}";
    }

    public function unduh()
    {
        // Path menuju file yang ingin diunduh
        $file = 'files/format_import.xlsx'; // Lokasi file di server

        // Periksa apakah file tersebut ada
        if (file_exists($file)) {
            // Tentukan tipe konten file yang akan diunduh
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            // Baca file dan kirimkan isinya ke output buffer
            readfile($file);
            exit;
        } else {
            // Jika file tidak ditemukan, tampilkan pesan error atau redirect ke halaman lain
            echo "File tidak ditemukan.";
            // atau
            // return redirect()->to('/halaman_error');
        }
    }


    public function hapus($id)
    {
        // Membuat instance model
        $pipModel = new \App\Models\PipModel();

        // Melakukan pengecekan apakah siswa dengan ID tersebut ada dalam database
        $siswaPip = $pipModel->find($id);

        if ($siswaPip) {
            // Jika siswa ditemukan, panggil fungsi deleteSiswa untuk menghapus siswa
            $pipModel->hapus($id);

            // Set pesan flash data untuk sukses
            session()->setFlashData('pesanHapusSiswa', 'Siswa Penerima PIP berhasil dihapus.');
        } else {
            // Jika siswa tidak ditemukan, set pesan flash data untuk kesalahan
            session()->setFlashData('error', 'Siswa penerima PIP tidak ditemukan.');
        }

        // Redirect kembali ke halaman /siswa setelah penghapusan
        return redirect()->to('/bantuan/pip');
        // return redirect()->to(base_url tambahkan itu, agar tidak membuat ada tulisan index.php pada url
    }

    public function ambilbank($data_id)
    {
        // Validasi $data_id dan pastikan itu adalah integer atau sesuai kebutuhan Anda.

        // Panggil model
        $pipModel = new PipModel();

        // Update kolom 'ambil_dibank' menjadi 'Sudah diambil'
        $pipModel->updatePip($data_id, ['ambil_dibank' => 'Sudah diambil']);

        // Response JSON jika perlu
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
    }

    public function cetaksuketpip($id)
    {
        // Inisialisasi model
        $pipModel = new PipModel();
        $siswaPip = $pipModel->getdetail($id); // Mengambil data siswa berdasarkan ID
        $masterdataModel = new MasterDataModel();
        $data_cetak = $masterdataModel->getDataById(1);


        // Periksa apakah siswa ditemukan
        if (!$siswaPip) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'judul' => 'Suket',
            'siswaPip' => $siswaPip,
            'data_cetak' => $data_cetak
        ];

        return view('admin/print_suket/suket', $data);
    }

    public function cetaksuketAktivasi($id)
    {
        // Inisialisasi model
        $pipModel = new PipModel();
        $siswaPip = $pipModel->getdetail($id); // Mengambil data siswa berdasarkan ID
        $masterdataModel = new MasterDataModel();
        $data_cetak = $masterdataModel->getDataById(1);


        // Periksa apakah siswa ditemukan
        if (!$siswaPip) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'judul' => 'Suket Aktivasi',
            'siswaPip' => $siswaPip,
            'data_cetak' => $data_cetak
        ];

        return view('admin/print_suket/suket_aktivasi', $data);
    }

    public function cetaksuketWali($id)
    {
        // Mendapatkan data yang dikirimkan melalui URL
        $namaWali = $this->request->getVar('nama_wali');
        $alamatWali = $this->request->getVar('alamat_wali');
        $hubunganPd = $this->request->getVar('hubungan_pd');

        // Mengambil data siswa berdasarkan ID
        $pipModel = new PipModel();
        $detailsiswaPip = $pipModel->getdetail($id);

        // Mengambil data lain yang mungkin diperlukan
        $selectedYear = $this->request->getVar('selectYear');
        $uniqueYears = $pipModel->getUniqueYearsFromTanggalSK();

        $masterdataModel = new MasterDataModel();
        $data_cetak = $masterdataModel->getDataById(1);

        // Mengirim data ke halaman cetak
        $data = [
            'judul' => 'Suket Wali',
            'siswaPip' => $detailsiswaPip,
            'namaWali' => $namaWali,
            'alamatWali' => $alamatWali,
            'hubunganPd' => $hubunganPd,
            'uniqueYears' => $uniqueYears,
            'selectedYear' => $selectedYear,
            'selectedSiswaId' => $id,
            'csrfToken' => csrf_hash(),
            'data_cetak' => $data_cetak
        ];

        return view('admin/print_suket/suket_wali', $data);
    }

    public function hitungCetak($id)
    {
        // Validasi ID atau lakukan operasi lain yang diperlukan

        // Dapatkan jumlah klik dari POST data
        $jumlahKlik = $this->request->getPost('jumlahKlik');

        // Ambil jumlah klik yang ada di database
        $pipModel = new \App\Models\PipModel(); // Ganti dengan nama model yang sesuai
        $existingData = $pipModel->find($id);

        // Jika ada data, tambahkan jumlah klik yang baru
        if ($existingData) {
            $jumlahKlik += $existingData['jumlah_cetak'];
        }

        // Simpan jumlah klik ke dalam database
        $pipModel->update($id, ['jumlah_cetak' => $jumlahKlik]);

        // Respon sukses atau lainnya jika diperlukan
        return $this->response->setJSON(['status' => 'success']);
    }


    // MEMBUAT FILTER DATA 
    public function filterByYearTahapDana()
    {
        $selectedYear = $this->request->getVar('selectYear');
        $selectedTahap = $this->request->getVar('selectTahap');
        $selectedDana = $this->request->getVar('selectDana');
        $csrfToken = csrf_hash();
        $currentYear = date('Y');

        if ($selectedYear === 'Semua' || empty($selectedYear)) {
            $selectedYear = '';
        }

        $pipModel = new PipModel();

        if ($selectedYear === 'Semua') {
            $siswaPip = $pipModel->getAllSiswaPip();
        } else {
            $siswaPip = $pipModel->getSiswaPipByYearTahapDana($selectedYear, $selectedTahap, $selectedDana);
        }

        $uniqueYears = $pipModel->getUniqueYearsFromTanggalSK();
        $uniqueTahaps = $pipModel->getUniqueTahapsByYear($selectedYear);
        $uniqueDanas = $pipModel->getUniqueDanas(); // Ganti dengan metode yang sesuai

        $data = [
            'judul' => 'Siswa Penerima PIP',
            'siswa_pip' => $siswaPip,
            'uniqueYears' => $uniqueYears,
            'uniqueTahaps' => $uniqueTahaps,
            'uniqueDanas' => $uniqueDanas,
            'selectedYear' => $selectedYear,
            'selectedTahap' => $selectedTahap,
            'selectedDana' => $selectedDana,
            'csrfToken' => $csrfToken,  // Sertakan token CSRF dalam data
            'currentYear' => $currentYear,
        ];

        return view('admin/bantuan', $data);
    }

    public function getTahapsByYear($selectedYear)
    {
        // Pastikan $selectedYear tidak kosong
        if (empty($selectedYear)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid selected year']);
        }

        // Instansiasi model PipModel
        $pipModel = new PipModel();

        // Panggil metode untuk mendapatkan opsi tahap_id berdasarkan tahun
        $tahaps = $pipModel->getUniqueTahapsByYear($selectedYear);

        // Kembalikan data dalam format JSON
        return $this->response->setJSON($tahaps);
    }

    public function edit($id)
    {
        $model = new PipModel();
        // Mengambil data siswa PIP berdasarkan ID
        $data['pip'] = $model->find($id);

        // Pastikan data ditemukan sebelum melanjutkan
        if (!$data['pip']) {
            // Tampilkan halaman error atau lakukan penanganan yang sesuai
            return redirect()->to('/error');
        }

        // Menghasilkan token CSRF
        $csrfToken = csrf_hash();
        // Mengambil tahun saat ini
        $currentYear = date('Y');

        // Menyertakan data dalam array
        $data = [
            'judul' => 'Edit Siswa', // Judul halaman
            'csrfToken' => $csrfToken, // Token CSRF
            'currentYear' => $currentYear, // Tahun saat ini
            'pip' => $data['pip'], // Data siswa PIP
        ];

        // Menampilkan halaman edit dengan data yang diperlukan
        return view('admin/edit_siswa', $data);
    }


    public function update()
    {
        $model = new PipModel();
        $id = $this->request->getVar('id');

        $tanggalLahir = new \DateTime($this->request->getPost('tanggal_lahir'));



        $data = [
            // Ambil data dari formulir penyuntingan
            'nama_pd' => $this->request->getVar('nama_pd'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $tanggalLahir->format('Y-m-d'), // Sesuaikan format yang sesuai dengan basis data
            'nisn' => $this->request->getVar('nisn'),
            'rombel' => $this->request->getVar('rombel'),
            'no_rekening' => $this->request->getVar('no_rekening'),
            'virtual_acc' => $this->request->getVar('virtual_acc'),
            'nama_ayah' => $this->request->getVar('nama_ayah'),
            'nama_ibu_kandung' => $this->request->getVar('nama_ibu_kandung'),

        ];

        // Simpan perubahan ke database
        $model->update($id, $data);

        return redirect()->to('/bantuan/pip');
    }

    public function filterData()
    {
        // Ambil CSRF Token
        $csrfToken = csrf_hash();

        // Simpan CSRF Token dalam Session
        $session = \Config\Services::session();
        $session->set('csrf_token', $csrfToken);

        // Proses formulir dan filter data di sini
    }

    public function upload_file_action()
    {
        $siswa_id = $this->request->getPost('siswa_id');

        // Mendapatkan nama_pd dari id siswa
        $pipModel = new PipModel();
        $siswa = $pipModel->find($siswa_id);
        $nama_pd = $siswa['nama_pd']; // Sesuaikan dengan nama kolom yang sesuai dalam tabel siswa

        // Validasi upload file
        $validation = \Config\Services::validation();
        $validation->setRule('buku_tabungan', 'Buku Tabungan', 'uploaded[buku_tabungan]|max_size[buku_tabungan,150]|ext_in[buku_tabungan,pdf]');

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, tampilkan pesan kesalahan
            return redirect()->back()->with('errors', $validation->getErrors());
        }

        // Lakukan upload file dan simpan ke database
        $buku_tabunganFile = $this->request->getFile('buku_tabungan');
        if ($buku_tabunganFile->isValid() && !$buku_tabunganFile->hasMoved()) {
            $newName = 'buku_tabungan_' . strtolower(str_replace(' ', '_', $nama_pd)) . '_' . $buku_tabunganFile->getRandomName();
            $buku_tabunganFile->move(ROOTPATH . 'public/buku-tabungan', $newName);

            // Simpan nama file ke database
            $pipModel->update($siswa_id, ['buku_tabungan' => $newName]);

            // Redirect atau berikan respons sesuai kebutuhan Anda
            return redirect()->back()->with('success', 'Buku tabungan berhasil diupload.');
        } else {
            return redirect()->back()->with('error', 'Gagal mengupload buku tabungan.');
        }
    }



    public function download_buku_tabungan($fileName)
    {
        // Path ke direktori tempat file disimpan
        $path = ROOTPATH . 'public/buku-tabungan/';

        // Mendapatkan nama file yang benar
        $file = $path . $fileName;

        // Memastikan file ada sebelum proses unduh
        if (file_exists($file)) {
            // Set header untuk unduhan
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            flush(); // Flush system output buffer

            // Baca file dan keluarkan ke output buffer
            readfile($file);
            exit;
        } else {
            // Jika file tidak ditemukan, berikan respons error
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }

    public function filterByYear()
    {
        $selectedYear = $this->request->getVar('selectYear');
        $csrfToken = csrf_hash();
        $currentYear = date('Y');

        if ($selectedYear === 'Semua' || empty($selectedYear)) {
            $selectedYear = '';
        }

        $pipModel = new PipModel();

        if ($selectedYear === 'Semua') {
            $siswaPip = $pipModel->getAllSiswaPip();
        } else {
            $siswaPip = $pipModel->getSiswaPipByYear($selectedYear);
        }

        $uniqueYears = $pipModel->getUniqueYearsFromTanggalSK();

        $data = [
            'judul' => 'Siswa Penerima PIP',
            'siswa_pip' => $siswaPip,
            'uniqueYears' => $uniqueYears,
            'selectedYear' => $selectedYear,
            'csrfToken' => $csrfToken,
            'currentYear' => $currentYear,
        ];

        return view('admin/bantuan', $data);
    }

    public function hapus_buku_tabungan()
    {
        // Ambil ID dari POST data
        $siswa_id = $this->request->getPost('siswa_id');

        // Buat instance dari model PipModel
        $pipModel = new PipModel();

        // Panggil metode hapusBukuTabungan dari model PipModel
        $pipModel->hapusbukuTabungan($siswa_id);

        // Redirect atau tampilkan pesan sukses setelah penghapusan data
        return redirect()->to('/bantuan/pip');
    }
}
