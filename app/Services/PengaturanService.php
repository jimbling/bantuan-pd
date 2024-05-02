<?php

namespace App\Services;

use App\Models\MasterDataModel;

class PengaturanService
{
    protected $pengaturanModel;

    public function __construct()
    {
        $this->pengaturanModel = new MasterDataModel();
    }

    public function getNamaSatdik()
    {
        $pengaturan = $this->pengaturanModel->first(); // Mengambil baris pertama dari tabel
        if ($pengaturan) {
            return [
                'nama_sp' => $pengaturan['nama_sp'],
                'website' => $pengaturan['website'],

            ];
        } else {
            return [
                'nama_sp' => "Nama Instansi",
                'website' => "www.sekolah.sch.id",
            ];
        }
    }
}
