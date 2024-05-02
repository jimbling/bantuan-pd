<?php

namespace App\Controllers;

use App\Models\PipModel;
use App\Models\DanalainModel;
use App\Models\MasterDataModel;

class Rekap extends BaseController
{
    protected $pipModel;
    protected $danalainModel;
    protected $masterdataModel;

    public function __construct()
    {
        $this->pipModel = new PipModel();
        $this->danalainModel = new DanalainModel();
        $this->masterdataModel = new MasterDataModel();
    }

    public function index()
    {
        session();

        // Ambil tahun dari parameter atau dari input form, sesuaikan dengan kebutuhan Anda
        $year = $this->request->getVar('tahun');

        // Panggil metode untuk mendapatkan data siswa PIP berdasarkan tahun
        $dataSiswaPip = $this->pipModel->getSiswaPipByYear($year);

        // Panggil metode untuk mendapatkan data siswa Dana Lainnya berdasarkan tahun
        $dataSiswaDanalain = $this->danalainModel->getSiswaDanalainByYear($year);
        // Membuat instance dari model
        $currentYear = date('Y');

        // Lakukan sesuatu dengan data yang telah ditemukan, seperti passing ke view
        $data = [
            'judul' => 'Rekapitulasi',
            'dataSiswaPip' => $dataSiswaPip,
            'dataSiswaDanalain' => $dataSiswaDanalain,
            'currentYear' => $currentYear,
            'tahun' => $year, // Tambahkan nilai tahun ke dalam data


        ];

        return view('admin/rekapitulasi', $data);
    }

    public function cetakRekap($tahun)
    {
        $pipModel = new PipModel();
        $danalainModel = new DanalainModel();
        $masterdataModel = new MasterDataModel();
        $dataCetak = $masterdataModel->getDataById(1);

        // Ambil data PIP dari PipModel dan urutkan berdasarkan kelas
        $pipData = $pipModel->where('YEAR(tanggal_sk)', $tahun)->orderBy('kelas', 'ASC')->findAll();

        // Ambil data dari DanalainModel
        $danalainData = $danalainModel->where('YEAR(tanggal_sk)', $tahun)->findAll();

        // Inisialisasi array untuk menyimpan data terkelompok
        $dataKelompok = [
            'BSM' => [],
            'SIABAZKu' => [],
            'Lainnya' => [],
        ];

        // Iterasi data dari DanalainModel dan kelompokkan berdasarkan jenis bantuan
        foreach ($danalainData as $siswa) {
            switch ($siswa['jenis_bantuan']) {
                case 'BSM':
                    $dataKelompok['BSM'][] = $siswa;
                    break;
                case 'SIABAZKu':
                    $dataKelompok['SIABAZKu'][] = $siswa;
                    break;
                case 'Lainnya':
                    $dataKelompok['Lainnya'][] = $siswa;
                    break;
                    // Tambahkan case untuk jenis bantuan lainnya jika diperlukan
            }
        }

        // Hitung jumlah siswa dan total nominal PIP
        $jumlahSiswaPIP = count($pipData);
        $totalNominalPIP = array_sum(array_column($pipData, 'nominal'));

        // Inisialisasi jumlah siswa dan total nominal untuk jenis bantuan lainnya
        $jumlahSiswaBSM = count($dataKelompok['BSM']);
        $totalNominalBSM = array_sum(array_column($dataKelompok['BSM'], 'nominal'));

        $jumlahSiswaSIABAZKu = count($dataKelompok['SIABAZKu']);
        $totalNominalSIABAZKu = array_sum(array_column($dataKelompok['SIABAZKu'], 'nominal'));

        $jumlahSiswaLainnya = count($dataKelompok['Lainnya']);
        $totalNominalLainnya = array_sum(array_column($dataKelompok['Lainnya'], 'nominal'));

        $data = [
            'judul' => 'Rekapitulasi',
            'tahun' => $tahun,
            'PIP' => $jumlahSiswaPIP,
            'totalNominalPIP' => $totalNominalPIP,
            'BSM' => $jumlahSiswaBSM,
            'totalNominalBSM' => $totalNominalBSM,
            'SIABAZKu' => $jumlahSiswaSIABAZKu,
            'totalNominalSIABAZKu' => $totalNominalSIABAZKu,
            'Lainnya' => $jumlahSiswaLainnya,
            'totalNominalLainnya' => $totalNominalLainnya,
            'dataCetak' => $dataCetak,
            'pipData' => $pipData,
            'danalainData' => $danalainData,
            'dataKelompok' => $dataKelompok, // Tambahkan dataKelompok ke dalam array $data
        ];

        return view('admin/print_suket/rekap_bantuan', $data);
    }
}
