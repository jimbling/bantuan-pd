<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterDataModel extends Model
{
    protected $table = 'tbl_datasp'; // Nama tabel riwayat peminjaman
    protected $primaryKey = 'id'; // Nama kolom primary key
    protected $useAutoIncrement = true; // Pastikan ini true
    protected $useTimestamps = false; // Sesuaikan dengan kebutuhan Anda
    protected $allowedFields = ['nama_sp', 'npsn', 'dusun_sp', 'kapanewon_sp', 'kabupaten_sp', 'nama_ks', 'nip_ks', 'ctk_kopsurat', 'website'];

    // Definisikan metode untuk mendapatkan data riwayat peminjaman
    public function getDataCetak()
    {
        return $this->findAll(); // Atau gunakan metode lain sesuai kebutuhan
    }

    public function updateData($id, $data)
    {
        return $this->update($id, $data);
    }
    public function getDataById($id)
    {
        return $this->find($id); // Mengambil data berdasarkan ID
    }
}
