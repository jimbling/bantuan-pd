<?php

namespace App\Controllers;

use App\Models\UserModel;


class Masuk extends BaseController
{
    protected $siswaModel;

    protected $riwayatsiswaModel;

    public function index()
    {

        session();
        $csrfToken = csrf_hash();
        $data = [
            'judul' => 'Login Bantuan PD',
            'csrfToken' => $csrfToken  // Sertakan token CSRF dalam data
        ];


        return view('masuk', $data);
    }

    public function auth()
    {

        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $cek = $userModel->get_data($username, $password);

        if ($cek !== null && isset($cek['username']) && $cek['password'] == $username && isset($cek['username']) && $cek['password'] == $password) {
            $session = session();

            $session->set('username', $cek['password']);
            $session->set('id', $cek['id']);
            $session->set('nama', $cek['nama']);

            // // Menggunakan kolom "level" untuk menentukan peran pengguna
            // $role = ($cek['user_level'] == 'Admin') ? 'Admin' : 'User';
            // $session->set('role', $role);
            // Validasi token CSRF

            return redirect()->to('/dashboard');
        } else {
            // Autentikasi gagal
            // Set pesan kesalahan
            $session = session();
            $session->setFlashdata('pesanMasuk', 'Login gagal. Periksa Username dan Password anda.');
            return redirect()->to('/');
        }
    }


    public function keluar()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function login()
    {

        session();
        $data = [
            'judul' => 'Login eRapat',
        ];


        return view('masuk', $data);
    }
}
