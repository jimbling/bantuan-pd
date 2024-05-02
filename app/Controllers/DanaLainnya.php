<?php

namespace App\Controllers;

use App\Models\DanalainModel;
use App\Models\JenisbantuanModel;


class DanaLainnya extends BaseController
{
    protected $danalainModel;
    protected $jenisbantuanModel;

    public function __construct()
    {

        $this->danalainModel = new DanalainModel();
        $this->jenisbantuanModel = new JenisbantuanModel();
    }
    public function index()
    {
        session();
        $csrfToken = csrf_hash();
        $danalainModel = new DanalainModel();
        $dana_lain = $danalainModel->getSiswaDanalain();
        $jenisbantuanModel = new JenisbantuanModel();
        $jenis_bantuan = $jenisbantuanModel->getJenisBantuan();

        // Membuat instance dari model
        $danalainModel = new DanalainModel();
        // Menggunakan fungsi dari model
        $jmlBsm = $danalainModel->jumlahSiswaBSM();
        $jmlSiabazku = $danalainModel->jumlahSiswaSIABAZKu();
        $jmlLainnya = $danalainModel->jumlahSiswaLainnya();
        $currentYear = date('Y');
        $data = [
            'judul' => 'Bantuan Dana Lainnya',
            'dana_lain' => $dana_lain,
            'jenis_bantuan' => $jenis_bantuan,
            'jmlBSM' => $jmlBsm,
            'jmlSiabazku' => $jmlSiabazku,
            'jmlLainnya' => $jmlLainnya,
            'currentYear' => $currentYear,
            'csrfToken' => $csrfToken  // Sertakan token CSRF dalam data
        ];

        return view('admin/dana_lainnya', $data);
    }

    public function ambilDanaLainnya($data_id)
    {
        // Validasi $data_id dan pastikan itu adalah integer atau sesuai kebutuhan Anda.

        // Panggil model
        $danalainModel = new DanalainModel();

        // Update kolom 'ambil_dibank' menjadi 'Sudah diambil'
        $danalainModel->updateDanalain($data_id, ['ambil_dibank' => 'Sudah diambil']);

        // Response JSON jika perlu
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
    }

    public function simpanDanaLain()
    {

        // Ambil data dari form input
        $nama_pd = $this->request->getPost('nama_pd');
        $nisn = $this->request->getPost('nisn');
        $kelas = $this->request->getPost('kelas');
        $tempat_lahir = $this->request->getPost('tempat_lahir');
        $tanggal_lahir = $this->request->getPost('tanggal_lahir');
        $nik = $this->request->getPost('nik');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $nama_ayah = $this->request->getPost('nama_ayah');
        $nama_ibu_kandung = $this->request->getPost('nama_ibu_kandung');
        $jenis_bantuan = $this->request->getPost('jenis_bantuan');
        $tahap_id = $this->request->getPost('tahap_id');
        $tanggal_sk = $this->request->getPost('tanggal_sk');
        $nomor_sk = $this->request->getPost('nomor_sk');
        $nama_rekening = $this->request->getPost('nama_rekening');
        $no_rekening = $this->request->getPost('no_rekening');
        $nominal = $this->request->getPost('nominal');
        $informasi = $this->request->getPost('informasi');

        // Validasi dan konversi tanggal menggunakan DateTime class
        try {
            $dateTime = new \DateTime($tanggal_lahir);
            $dateTime = new \DateTime($tanggal_sk);
        } catch (\Exception $e) {
            // Tanggal tidak valid, tampilkan pesan kesalahan
            return redirect()->to('/bantuan/lainnya')->withInput()->with('errorMessages', 'Format tanggal tidak valid.');
        }

        // Data valid, simpan ke dalam database
        $data = [
            'nama_pd' => $nama_pd,
            'nisn' => $nisn,
            'kelas' => $kelas,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $dateTime->format('Y-m-d'),
            'nik' => $nik,
            'jenis_kelamin' => $jenis_kelamin,
            'nama_ayah' => $nama_ayah,
            'nama_ibu_kandung' => $nama_ibu_kandung,
            'jenis_bantuan' => $jenis_bantuan,
            'tahap_id' => $tahap_id,
            'tanggal_sk' => $dateTime->format('Y-m-d'),
            'nomor_sk' => $nomor_sk,
            'nama_rekening' => $nama_rekening,
            'no_rekening' => $no_rekening,
            'nominal' => $nominal,
            'informasi' => $informasi,
        ];

        $this->danalainModel->insertDanalain($data);

        // Redirect atau tampilkan pesan sukses
        session()->setFlashData('pesanSimpanDanaLain', 'Data siswa berhasil disimpan');
        return redirect()->to('/bantuan/lainnya')->with('success', 'Data pengguna berhasil disimpan.');
    }

    public function hapus($id)
    {
        // Membuat instance model
        $danalainModel = new \App\Models\DanalainModel();

        // Melakukan pengecekan apakah siswa dengan ID tersebut ada dalam database
        $siswaDanalain = $danalainModel->find($id);

        if ($siswaDanalain) {
            // Jika siswa ditemukan, panggil fungsi deleteSiswa untuk menghapus siswa
            $danalainModel->hapus($id);

            // Set pesan flash data untuk sukses
            session()->setFlashData('pesanHapusSiswa', 'Siswa Penerima Bantuan berhasil dihapus.');
        } else {
            // Jika siswa tidak ditemukan, set pesan flash data untuk kesalahan
            session()->setFlashData('error', 'Siswa penerima PIP tidak ditemukan.');
        }

        // Redirect kembali ke halaman /siswa setelah penghapusan
        return redirect()->to('/bantuan/pip');
        // return redirect()->to(base_url tambahkan itu, agar tidak membuat ada tulisan index.php pada url
    }

    public function get_detail($id)
    {
        $model = new DanalainModel();
        $data['detail'] = $model->getdetail($id);

        // Return JSON response
        return $this->response->setJSON($data['detail']);
    }

    public function edit($id)
    {
        // Ambil data dari form input
        $nama_pd = $this->request->getPost('nama_pd_edit');
        $nisn = $this->request->getPost('nisn_edit');
        $kelas = $this->request->getPost('kelas_edit');
        $tempat_lahir = $this->request->getPost('tempat_lahir_edit');
        $tanggal_lahir = $this->request->getPost('tanggalLahir_edit');
        $nik = $this->request->getPost('nik_edit');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin_edit');
        $nama_ayah = $this->request->getPost('nama_ayah_edit');
        $nama_ibu_kandung = $this->request->getPost('nama_ibu_kandung_edit');
        $jenis_bantuan = $this->request->getPost('jenis_bantuan_edit');
        $tahap_id = $this->request->getPost('tahap_id_edit');
        $tanggal_sk = $this->request->getPost('tanggalSk_edit');
        $nomor_sk = $this->request->getPost('nomor_sk_edit');
        $nama_rekening = $this->request->getPost('nama_rekening_edit');
        $no_rekening = $this->request->getPost('no_rekening_edit');
        $nominal = $this->request->getPost('nominal_edit');
        $informasi = $this->request->getPost('informasi_edit');

        // Validasi dan konversi tanggal menggunakan DateTime class
        try {
            $dateTimeLahir = new \DateTime($tanggal_lahir);
            $dateTimeSk = new \DateTime($tanggal_sk);
        } catch (\Exception $e) {
            // Tanggal tidak valid, tampilkan pesan kesalahan
            return redirect()->to('/bantuan/lainnya')->withInput()->with('errorMessages', 'Format tanggal tidak valid.');
        }

        // Data valid, simpan ke dalam database
        $data = [
            'nama_pd' => $nama_pd,
            'nisn' => $nisn,
            'kelas' => $kelas,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $dateTimeLahir->format('Y-m-d'), // Menggunakan objek DateTime untuk tanggal_lahir
            'nik' => $nik,
            'jenis_kelamin' => $jenis_kelamin,
            'nama_ayah' => $nama_ayah,
            'nama_ibu_kandung' => $nama_ibu_kandung,
            'jenis_bantuan' => $jenis_bantuan,
            'tahap_id' => $tahap_id,
            'tanggal_sk' => $dateTimeSk->format('Y-m-d'), // Menggunakan objek DateTime untuk tanggal_sk
            'nomor_sk' => $nomor_sk,
            'nama_rekening' => $nama_rekening,
            'no_rekening' => $no_rekening,
            'nominal' => $nominal,
            'informasi' => $informasi,
        ];

        // Panggil model untuk melakukan update data
        $this->danalainModel->updateDanalain($id, $data);

        // Redirect atau tampilkan pesan sukses
        session()->setFlashData('pesanEditDanaLain', 'Data siswa berhasil diubah');
        return redirect()->to('/bantuan/lainnya')->with('success', 'Data siswa berhasil diubah.');
    }
}
