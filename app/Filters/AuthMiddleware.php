<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthMiddleware implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah pengguna telah login
        if (!session()->has('username')) {
            return redirect()->to('/'); // Redirect ke halaman login jika belum login
        }

        // Penting untuk mengembalikan $request agar proses permintaan dapat dilanjutkan
        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Logika setelah proses request
    }
}
