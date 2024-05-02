<?php

namespace App\Controllers;

use App\Models\PipModel;
use App\Models\DanalainModel;

class Dashboard extends BaseController
{

    protected $pipModel;
    protected $danalainModel;

    public function __construct()
    {

        $this->pipModel = new PipModel();
        $this->danalainModel = new DanalainModel();
    }

    public function index()
    {
        $currentYear = date('Y');

        $pipModel = new PipModel();
        $danalainModel = new DanalainModel();

        // Memanggil metode dari model untuk mendapatkan daftar siswa yang sudah dan belum mengambil dana
        $siswa_sudah_diambil = $pipModel->getSiswaSudahDiambil($currentYear);
        $siswa_belum_diambil = $pipModel->getSiswaBelumDiambil($currentYear);
        $jumlahSiswa = $pipModel->countSiswaByAmbilDibank($currentYear);

        // Mendapatkan data untuk tahun berjalan dari model PipModel
        $penerimaPip = $pipModel->getPenerimaPip($currentYear);

        // Mendapatkan data untuk tahun berjalan dari model DanalainModel
        $penerimaBsm = $danalainModel->jumlahSiswaBSM($currentYear);
        $penerimaSiabazku = $danalainModel->jumlahSiswaSIABAZKu($currentYear);
        $penerimaLainnya = $danalainModel->jumlahSiswaLainnya($currentYear);

        // Total penerima bantuan untuk tahun berjalan
        $total_penerima_bantuan_current_year = array_sum([$penerimaPip, $penerimaBsm, $penerimaSiabazku, $penerimaLainnya]);

        // Mendapatkan tahun-tahun unik dari model PipModel
        $uniqueYears = $pipModel->getUniqueYearsFromTanggalSK();

        // Mendapatkan total penerima bantuan per tahun dari model PipModel
        $totalPenerimaBantuanPerTahun = $pipModel->getTotalPenerimaBantuanPerTahun();

        // Mendapatkan jumlah siswa penerima bantuan dari model DanalainModel
        $jumlahSiswaDanalainPerTahun = $danalainModel->getJumlahSiswaDanalainPerTahun();

        // Konversi data ke dalam format JSON
        $uniqueYearsJSON = json_encode($uniqueYears);
        $jumlahSiswaDanalainPerTahunJSON = json_encode($jumlahSiswaDanalainPerTahun);
        $totalPenerimaBantuanPerTahunJSON = json_encode($totalPenerimaBantuanPerTahun);

        // Menyiapkan data untuk dikirimkan ke tampilan
        $data = [
            'judul' => 'Dashboard',
            'currentYear' => $currentYear,
            'jumlah_siswa' => $jumlahSiswa,
            'siswa_pip' =>  $penerimaPip,
            'jmlBSM' => $penerimaBsm,
            'jmlSiabazku' => $penerimaSiabazku,
            'jmlLainnya' => $penerimaLainnya,
            'sudah_mengambil' => $siswa_sudah_diambil,
            'belum_mengambil' => $siswa_belum_diambil,
            'total_penerima_bantuan_current_year' => $total_penerima_bantuan_current_year,
            'uniqueYears' => $uniqueYears,
            'total_penerima_bantuan_per_tahun' => $totalPenerimaBantuanPerTahun,
            'jumlah_siswa_danalain_per_tahun' => $jumlahSiswaDanalainPerTahun, // Jumlah siswa penerima bantuan dari model DanalainModel
            'uniqueYearsJSON' => $uniqueYearsJSON,
            'totalPenerimaBantuanPerTahunJSON' => $totalPenerimaBantuanPerTahunJSON,
            'jumlahSiswaDanalainPerTahunJSON' => $jumlahSiswaDanalainPerTahunJSON,
        ];

        return view('admin/dashboard', $data);
    }

    public function searchByNisn()
    {
        $nisn = $this->request->getPost('nisn');
        $currentYear = date('Y');


        // Pastikan NISN ada sebelum melakukan query
        if (!empty($nisn)) {
            $db = \Config\Database::connect();

            $builder = $db->table('tbl_danapip');
            $builder->select('tbl_danapip.nisn, tbl_danapip.nama_pd, tbl_danapip.jenis_bantuan, tbl_danapip.tanggal_sk, tbl_danapip.tahap_id');
            $builder->where('tbl_danapip.nisn', $nisn);

            $query1 = $builder->get();

            $builder = $db->table('tbl_dana_lainnya');
            $builder->select('tbl_dana_lainnya.nisn, tbl_dana_lainnya.nama_pd, tbl_dana_lainnya.jenis_bantuan, tbl_dana_lainnya.tanggal_sk, tbl_dana_lainnya.tahap_id');
            $builder->where('tbl_dana_lainnya.nisn', $nisn);

            $query2 = $builder->get();

            $result = array_merge($query1->getResultArray(), $query2->getResultArray());
            $data = [
                'judul' => 'Pencarian.....',
                'result' => $result,
                'currentYear' => $currentYear,
            ];
            return view('admin/dashboard', $data);
        } else {
            // NISN kosong, tampilkan pesan kesalahan atau redirect ke halaman form
            // Contoh: return redirect()->to(base_url('your_controller'));
        }
    }

    public function ApisearchByNisn()
    {
        // Tangani permintaan pencarian
        $nisn = $this->request->getGet('nisn');

        // Lakukan validasi input NISN
        // (Anda dapat menambahkan validasi lainnya sesuai kebutuhan)
        if (empty($nisn)) {
            return "Masukkan NISN untuk melakukan pencarian.";
        }

        // Panggil API untuk mencari data berdasarkan NISN
        $url = "https://bantuan-pd.sdnkedungrejo.sch.id/api/bantuan/searchByNisn?nisn={$nisn}";
        $result = file_get_contents($url);

        // Tampilkan hasil pencarian
        echo $result;
    }
}
