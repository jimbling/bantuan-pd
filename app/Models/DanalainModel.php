<?php

namespace App\Models;

use CodeIgniter\Model;

class DanalainModel extends Model
{
    protected $table = 'tbl_dana_lainnya';
    protected $primaryKey = 'id'; // Nama kolom primary key
    protected $useAutoIncrement = true; // Pastikan ini true
    protected $useTimestamps = true; // Sesuaikan dengan kebutuhan Anda
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id', 'kelas', 'nama_pd', 'nama_ibu_kandung', 'nama_ayah', 'tanggal_lahir', 'tempat_lahir', 'nisn', 'nik', 'jenis_kelamin', 'nominal', 'no_rekening',  'tahap_id', 'nomor_sk', 'tanggal_sk', 'nama_rekening', 'informasi', 'ambil_dibank', 'jumlah_cetak', 'no_surat', 'jenis_bantuan', 'created_at', 'updated_at', 'deleted_at'];
    // Definisikan metode untuk mendapatkan data barang
    public function getSiswaDanalain()
    {
        return $this->where('deleted_at', null)
            ->where('deleted_at IS NULL') // Memastikan deleted_at tidak null
            ->findAll();
    }

    public function insertDanalain($data)
    {
        return $this->insert($data);
    }
    public function updateDanalain($id, $data)
    {
        return $this->set($data)->where('id', $id)->update();
    }
    public function hapus($id)
    {
        return $this->where('id', $id)->set(['deleted_at' => date('Y-m-d H:i:s')])->update();
    }
    public function getdetail($id)
    {
        return $this->find($id);
    }
    public function getUniqueYearsFromTanggalSK()
    {
        // Query untuk mendapatkan tahun unik dari tanggal_sk
        $query = $this->distinct()->select('YEAR(tanggal_sk) as tahun')->where('deleted_at', null)->findAll();

        // Mengembalikan hasil query
        return $query;
    }

    public function getSiswaPipByYearTahapDana($selectedYear, $selectedTahap, $selectedDana)
    {
        $query = $this->where('deleted_at', null);

        if (!empty($selectedYear) && $selectedYear !== 'Semua') {
            $query = $query->where('YEAR(tanggal_sk)', $selectedYear);
        }

        if (!empty($selectedTahap)) {
            $query = $query->where('tahap_id', $selectedTahap);
        }

        if (!empty($selectedDana)) {
            $query = $query->where('ambil_dibank', $selectedDana);
        }

        return $query->findAll();
    }


    // Tambahkan metode baru untuk mendapatkan semua data siswa PIP tanpa memfilter tahun
    public function getAllSiswaDanalain()
    {
        // Query untuk mendapatkan semua data siswa PIP tanpa memfilter tahun
        return $this->where('deleted_at', null)->findAll();
    }
    public function getUniqueTahapsByYear($selectedYear)
    {
        $query = $this->distinct('tahap_id')
            ->select('tahap_id')
            ->where('deleted_at', null);

        if (!empty($selectedYear) && $selectedYear !== 'Semua') {
            $query = $query->where('YEAR(tanggal_sk)', $selectedYear);
        }

        return $query->findAll();
    }
    public function getuniqueDanas()
    {
        return $this->distinct('ambil_dibank')
            ->where('deleted_at', null)
            ->findAll();
    }

    public function countSiswaByJenisBantuan($jenisBantuan)
    {
        // Ambil tahun berjalan dari tanggal_sk
        $tahunBerjalan = date('Y');

        // Hitung jumlah siswa berdasarkan jenis bantuan dan tahun berjalan
        return $this->where('jenis_bantuan', $jenisBantuan)
            ->where('YEAR(tanggal_sk)', $tahunBerjalan)
            ->countAllResults();
    }

    // Contoh penggunaan
    public function jumlahSiswaBSM()
    {
        return $this->countSiswaByJenisBantuan('BSM');
    }

    public function jumlahSiswaSIABAZKu()
    {
        return $this->countSiswaByJenisBantuan('SIABAZKu');
    }

    public function jumlahSiswaLainnya()
    {
        return $this->countSiswaByJenisBantuan('Lainnya');
    }
    public function getSiswaDanalainByYear($year)
    {
        return $this->withDeleted()
            ->where('YEAR(tanggal_sk)', $year)
            ->where('deleted_at', null)
            ->findAll();
    }

    public function countSiswaByJenisBantuanAndYear($jenisBantuan, $year)
    {
        return $this->where('jenis_bantuan', $jenisBantuan)
            ->where('YEAR(tanggal_sk)', $year)
            ->countAllResults();
    }

    public function getJumlahSiswaDanalainPerTahun()
    {
        // Ambil semua data siswa yang tidak dihapus (soft deleted)
        $siswaData = $this->where('deleted_at', null)->findAll();

        // Inisialisasi array untuk menyimpan jumlah siswa berdasarkan jenis bantuan per tahun
        $jumlahSiswaPerTahun = [];

        // Loop melalui setiap siswa
        foreach ($siswaData as $siswa) {
            // Ambil tahun dari tanggal_sk
            $tahun = date('Y', strtotime($siswa['tanggal_sk']));

            // Inisialisasi array untuk jenis bantuan jika belum ada
            if (!isset($jumlahSiswaPerTahun[$tahun])) {
                $jumlahSiswaPerTahun[$tahun] = [
                    'BSM' => 0,
                    'SIABAZKu' => 0,
                    'Lainnya' => 0,
                ];
            }

            // Hitung jumlah siswa berdasarkan jenis bantuan
            switch ($siswa['jenis_bantuan']) {
                case 'BSM':
                    $jumlahSiswaPerTahun[$tahun]['BSM']++;
                    break;
                case 'SIABAZKu':
                    $jumlahSiswaPerTahun[$tahun]['SIABAZKu']++;
                    break;
                case 'Lainnya':
                    $jumlahSiswaPerTahun[$tahun]['Lainnya']++;
                    break;
                    // Tambahkan jenis bantuan lain jika diperlukan
            }
        }

        return $jumlahSiswaPerTahun;
    }
}
