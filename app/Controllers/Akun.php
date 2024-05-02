<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\MasterDataModel;
use App\Models\PipModel;

class Akun extends Controller
{
    protected $userModel;
    protected $masterdataModel;
    protected $pipModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->masterdataModel = new MasterDataModel();
        $this->pipModel = new PipModel();
    }

    public function index()
    {
        session();
        $csrfToken = csrf_hash();
        $masterdataModel = new MasterDataModel();

        $dataCetak = $masterdataModel->getDataById(1);

        $pengguna = $this->userModel->getUser();
        $currentYear = date('Y');
        $data = [
            'judul' => 'Setting Data',
            'set_pengguna' => $pengguna,
            'currentYear' => $currentYear,
            'dataCetak' => $dataCetak,
            'csrfToken' => $csrfToken  // Sertakan token CSRF dalam data
        ];

        return view('admin/setting-sp', $data);
    }

    public function update()
    {

        // Mengambil data yang dikirimkan melalui POST
        $id = $this->request->getPost('id');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $nama = $this->request->getPost('nama');

        // Validasi data jika diperlukan

        // Lakukan pembaruan data ke database menggunakan model AkunModel
        $userModel = new \App\Models\UserModel();
        $data = [
            'username' => $username,
            'password' => $password,
            'nama' => $nama,

        ];
        $userModel->updateUser($id, $data);

        // Pesan respons
        $response = [
            'status' => 'success', // Atau 'error' jika terjadi kesalahan
            'message' => 'Data berhasil diperbarui', // Pesan sukses atau kesalahan
        ];

        // Kirim respons JSON ke JavaScript
        return $this->response->setJSON($response);
    }

    public function updateData()
    {

        $data = json_decode($this->request->getBody(), true); // Ambil data dari permintaan POST

        $id = 1; // Ganti dengan ID data yang ingin Anda perbarui

        // Panggil model untuk memperbarui data
        $this->masterdataModel->updateData($id, $data);


        // Berikan respons jika diperlukan
        return $this->response->setJSON(['message' => 'Data berhasil diperbaharui']);
    }

    public function kopsurat()
    {
        $model = new MasterDataModel();

        if ($this->request->getMethod() === 'post') {
            $existingData = $model->first();

            // Ambil file yang diunggah
            $file = $this->request->getFile('ctk_kopsurat');

            // Validasi file ekstensi
            if ($file->isValid() && !$file->hasMoved()) {
                // Validasi ekstensi file yang diijinkan
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg'];
                $fileExtension = $file->getClientExtension();

                if (in_array($fileExtension, $allowedExtensions)) {
                    $newName = $file->getRandomName();
                    $newLocation = 'assets/dist/img/kdrj' . DIRECTORY_SEPARATOR;
                    $file->move($newLocation, $newName);

                    // Perbarui nama file dalam database
                    $model->update($existingData['id'], ['ctk_kopsurat' => $newName]);
                    session()->setFlashData('pesanDataCetak', 'Data berhasil diperbaharui');
                    return redirect()->to('/setting');
                } else {
                    session()->setFlashData('pesanError', 'Jenis file tidak diijinkan.');
                    return redirect()->to('/setting');
                }
            } else {
                session()->setFlashData('pesanError', 'Terjadi kesalahan dalam pengunggahan file.');
                return redirect()->to('/setting');
            }
        }

        return view('upload_form');
    }

    public function cetakSuket()
    {
        session();
        $csrfToken = csrf_hash();
        $selectedYear = $this->request->getVar('selectYear');
        $selectedSiswaId = $this->request->getVar('selectedSiswaId'); // Add this line to get the selectedSiswaId

        $pipModel = new PipModel();

        // Jika tidak ada filter tahun yang dipilih, atur tahun berjalan sebagai nilai default
        if (empty($selectedYear)) {
            $selectedYear = date('Y');
        }

        // Ambil data untuk tahun yang dipilih
        $siswaPip = $pipModel->getSiswaPipByYear($selectedYear);

        // Ambil daftar tahun unik
        $uniqueYears = $pipModel->getUniqueYearsFromTanggalSK();
        $currentYear = date('Y');

        $data = [
            'judul' => 'Siswa Penerima PIP',
            'siswa_pip' => $siswaPip,
            'uniqueYears' => $uniqueYears,
            'selectedYear' => $selectedYear,
            'currentYear' => $currentYear,
            'csrfToken' => $csrfToken,
            'selectedSiswaId' => $selectedSiswaId, // Pass the selectedSiswaId to the view
        ];

        return view('admin/cetak_surat_wali', $data);
    }
}
