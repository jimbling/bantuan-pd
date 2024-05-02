<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Google_Client;
use Google_Service_Drive;

class GoogleDriveController extends Controller
{

    public function index()
    {
        $currentYear = date('Y');

        $data = [
            'judul' => 'Dashboard',
            'currentYear' => $currentYear,
        ];

        return view('admin/ss', $data);
    }

    public function authenticate()
    {
        // Buat objek Google_Client
        $client = new Google_Client();
        $client->setAuthConfig('assets/dist/gdrive/client_secret_643405018131-7gjb94f0nca2uh2lt11baalkr935i6sk.apps.googleusercontent.com.json');
        $client->setRedirectUri('http://localhost:8080/unggah');
        $client->addScope(Google_Service_Drive::DRIVE);

        // Buat URL autentikasi dan arahkan pengguna ke sana
        $authUrl = $client->createAuthUrl();
        return redirect()->to($authUrl);
    }

    public function callback()
    {
        // Terima kode otorisasi dari Google
        $code = $this->request->getGet('code');

        // Dapatkan token akses menggunakan kode otorisasi
        $client = new Google_Client();
        $client->setAuthConfig('assets/dist/gdrive/client_secret_643405018131-7gjb94f0nca2uh2lt11baalkr935i6sk.apps.googleusercontent.com.json');
        $client->setRedirectUri('http://localhost:8080/unggah');
        $accessToken = $client->fetchAccessTokenWithAuthCode($code);

        // Token akses dapat digunakan untuk mengakses API Google
        // Misalnya, Anda dapat menggunakan token akses ini untuk mengunggah file ke Google Drive
        if (isset($accessToken['access_token'])) {
            // Token akses berhasil diterima
            // Simpan token akses ke tempat penyimpanan yang sesuai
            $this->saveAccessToken($accessToken);

            return redirect()->to('success');
        } else {
            // Gagal mendapatkan token akses
            return redirect()->back()->with('error', 'Failed to authenticate.');
        }
    }

    private function saveAccessToken($accessToken)
    {
        // Contoh: Simpan token akses ke session
        session()->set('google_access_token', $accessToken);
    }

    public function upload()
    {
        // Muat token akses dari tempat penyimpanan yang sesuai
        $accessToken = session()->get('google_access_token');

        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            $driveModel = new \App\Models\DriveModel();
            $fileId = $driveModel->uploadToDrive($file, $accessToken);

            if ($fileId) {
                return redirect()->to('success');
            } else {
                // Handle upload failure
                return redirect()->back()->with('error', 'Failed to upload file.');
            }
        } else {
            // Handle invalid file or move failure
            return redirect()->back()->with('error', 'Invalid file.');
        }
    }
}
