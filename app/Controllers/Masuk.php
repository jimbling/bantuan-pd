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

        // Mendapatkan data pengguna berdasarkan username
        $user = $userModel->get_data_by_username($username);

        // Memeriksa apakah pengguna ada dan password sesuai
        if ($user !== null && password_verify($password, $user['password'])) {
            $session = session();

            // Menyimpan data pengguna ke dalam session
            $session->set('username', $user['username']);
            $session->set('id', $user['id']);
            $session->set('nama', $user['nama']);

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
