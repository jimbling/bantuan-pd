<?php

namespace App\Models;

use CodeIgniter\Model;

class PipModel extends Model
{
    protected $table = 'tbl_danapip';
    protected $primaryKey = 'id'; // Nama kolom primary key
    protected $useAutoIncrement = true; // Pastikan ini true
    protected $useTimestamps = true; // Sesuaikan dengan kebutuhan Anda
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id', 'peserta_didik_id', 'sekolah_id', 'npsn', 'nomenklatur', 'kelas', 'rombel', 'nama_pd', 'nama_ibu_kandung', 'nama_ayah', 'tanggal_lahir', 'tempat_lahir', 'nisn', 'nik', 'jenis_kelamin', 'nominal', 'no_rekening', 'tahap_id', 'nomor_sk', 'tanggal_sk', 'nama_rekening', 'tanggal_cair', 'status_cair', 'no_KIP', 'no_KKS', 'no_KPS', 'virtual_acc', 'nama_kartu', 'semester_id', 'layak_pip', 'keterangan_pencairan', 'confirmation_text', 'tahap_keterangan', 'nama_pengusul', 'ambil_dibank', 'jumlah_cetak', 'no_surat', 'jenis_bantuan', 'buku_tabungan', 'sk', 'created_at', 'updated_at', 'deleted_at'];

    public function getSiswaPip()
    {
        return $this->where('deleted_at', null)->findAll();
    }

    public function insertPip($data)
    {
        return $this->insert($data);
    }
    public function updatePip($id, $data)
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
        // Query untuk mendapatkan tahun unik dari tanggal_sk dan mengurutkannya dari yang terkecil ke yang terbesar
        $query = $this->distinct()->select('YEAR(tanggal_sk) as tahun')->where('deleted_at', null)->orderBy('tahun', 'ASC')->findAll();

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
    public function getAllSiswaPip()
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

        // Menambahkan pengurutan berdasarkan tahap_id
        $query = $query->orderBy('tahap_id', 'ASC');

        return $query->findAll();
    }

    public function getuniqueDanas()
    {
        return $this->distinct('ambil_dibank')
            ->where('deleted_at', null)
            ->findAll();
    }

    public function getSiswaPipByYear($year)
    {
        return $this->withDeleted()
            ->where('YEAR(tanggal_sk)', $year)
            ->where('deleted_at', null)
            ->orderBy('tahap_id', 'ASC') // Menambahkan pengurutan berdasarkan tahap_id secara menaik (ASC)
            ->findAll();
    }

    public function getJumlahSiswaPipPerTahun($year)
    {
        return $this->where('deleted_at', null)
            ->where('YEAR(tanggal_sk)', $year)
            ->findAll();
    }

    public function getPenerimaPip($year)
    {
        return $this->where('deleted_at', null)
            ->where('YEAR(tanggal_sk)', $year)
            ->countAllResults();
    }

    public function countSiswaByAmbilDibank($tahun)
    {
        $querySudahDiambil = $this->db->table('tbl_danapip')
            ->where('ambil_dibank', 'Sudah diambil')
            ->where('YEAR(tanggal_sk)', $tahun)
            ->countAllResults();

        $queryBelumDiambil = $this->db->table('tbl_danapip')
            ->where('ambil_dibank', 'Belum diambil')
            ->where('YEAR(tanggal_sk)', $tahun)
            ->countAllResults();

        $totalSiswa = $querySudahDiambil + $queryBelumDiambil;

        return [
            'sudah_diambil' => $querySudahDiambil,
            'belum_diambil' => $queryBelumDiambil,
            'total' => $totalSiswa,
        ];
    }

    public function getSiswaSudahDiambil($tahun)
    {
        return $this->db->table('tbl_danapip')
            ->where('ambil_dibank', 'Sudah diambil')
            ->where('YEAR(tanggal_sk)', $tahun)
            ->orderBy('kelas', 'ASC') // Mengurutkan berdasarkan kelas secara menaik
            ->get()
            ->getResultArray();
    }

    public function getSiswaBelumDiambil($tahun)
    {
        return $this->db->table('tbl_danapip')
            ->where('ambil_dibank', 'Belum diambil')
            ->where('YEAR(tanggal_sk)', $tahun)
            ->orderBy('kelas', 'ASC') // Mengurutkan berdasarkan kelas secara menaik
            ->get()
            ->getResultArray();
    }

    public function getTotalPenerimaBantuanPerTahun()
    {
        // Mengambil tahun-tahun unik dari tanggal SK
        $uniqueYears = $this->getUniqueYearsFromTanggalSK();

        // Inisialisasi array untuk menyimpan total penerima bantuan untuk setiap tahun
        $total_penerima_bantuan_per_tahun = [];

        // Iterasi melalui tahun-tahun unik
        foreach ($uniqueYears as $year) {
            $tahun = $year['tahun'];

            // Mendapatkan jumlah siswa penerima bantuan dari tbl_danapip untuk tahun ini
            $penerimaPip = $this->getPenerimaPip($tahun);


            // Menjumlahkan jumlah siswa dari berbagai sumber bantuan untuk tahun ini
            $total_penerima_bantuan = $penerimaPip;

            // Simpan total penerima bantuan untuk tahun ini ke dalam array
            $total_penerima_bantuan_per_tahun[$tahun] = $total_penerima_bantuan;
        }

        return $total_penerima_bantuan_per_tahun;
    }

    public function getNominasiSiswa()
    {
        return $this->where('sk', 'nominasi')->findAll();
    }

    public function hapusBukuTabungan($id)
    {
        $this->where('id', $id)
            ->set('buku_tabungan', null)
            ->update();
    }
}
