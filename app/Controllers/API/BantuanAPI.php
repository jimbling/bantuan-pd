<?php

namespace App\Controllers\API;

use CodeIgniter\API\ResponseTrait;

class BantuanAPI extends \CodeIgniter\Controller
{
    use ResponseTrait;

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

            if (!empty($result)) {
                $response = [
                    'status' => 'success',
                    'data' => $result,
                    'currentYear' => $currentYear
                ];
            } else {
                $response = [
                    'status' => 'success',
                    'message' => 'Data tidak ditemukan',
                    'currentYear' => $currentYear
                ];
            }

            return $this->respond($response);
        } else {
            // NISN kosong, kirimkan respons error
            $response = [
                'status' => 'error',
                'message' => 'NISN tidak boleh kosong'
            ];

            return $this->respond($response, 400); // 400 untuk Bad Request
        }
    }
}
