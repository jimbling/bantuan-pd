<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisbantuanModel extends Model
{
    protected $table = 'tbl_jenisbantuan'; // Nama tabel riwayat peminjaman
    protected $primaryKey = 'id'; // Nama kolom primary key
    protected $useAutoIncrement = true; // Pastikan ini true
    protected $useTimestamps = false; // Sesuaikan dengan kebutuhan Anda
    protected $allowedFields = ['id', 'jenis_bantuan'];

    // Definisikan metode untuk mendapatkan data riwayat peminjaman
    public function getJenisBantuan()
    {
        return $this->findAll(); // Atau gunakan metode lain sesuai kebutuhan
    }

    public function updateJenisBantuan($id, $data)
    {
        return $this->update($id, $data);
    }
}
