<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Login :: Sistem Informasi Manajemen Bantuan Pendidikan SDN Kedungrejo</title>
  <meta name="description" content="Halaman Login Sistem Informasi Manajemen Data Penerima Bantuan Pendidikan" />
  <meta name="keywords" content="sim, sdnkedungrejo, sd n kedungrejo, pip, baznas, siabazku, bantuan">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../../assets/dist/css/spasi_icon.css">
  <link rel="stylesheet" href="../../assets/dist/css/login/css/login.css">
  <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../assets/plugins/toastr/toastr.min.css">
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<?php

use App\Services\PengaturanService;

$pengaturanService = new PengaturanService();

// Mendapatkan nama kampus dan website
$data_pengaturan = $pengaturanService->getNamaSatdik();
$nama_sp = $data_pengaturan['nama_sp'];
$website = $data_pengaturan['website'];
?>

<div class="flash-data" data-flashdata="<?= (session()->getFlashData('pesanMasuk')); ?>"></div><!-- Page Heading -->

<body class="bg-gray-100">

  <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-4 justify-center items-center h-screen">
    <!-- Deskripsi -->
    <div class="p-8 text-justify">
      <h2 class="text-2xl font-bold">SIM Bantuan PD</h2>
      <p class="text-gray-600">Sistem Informasi Manajemen untuk mengelola bantuan yang diterima oleh peserta didik di
        <?= $nama_sp; ?>.</p>
      <p class="text-gray-600">SIM Bantuan PD memungkinkan Administrator untuk melakukan pencetakan surat keterangan
        pengambilan dibank, menyimpan buku tabungan, rekap penerima bantuan, dan pencarian peserta didik yang
        menerima bantuan berdasarkan NISN.</p>
    </div>
    <!-- Form Login -->
    <div class="max-w-md w-full bg-white shadow-md rounded-md overflow-hidden">
      <div class="p-8">
        <h4 class="text-lg font-semibold mb-4">Masuk Administrator</h4>
        <form class="form-signin" action="masuk/auth" id="login-form" method="post">
          <input type="hidden" name="<?= csrf_token() ?>" value="<?= $csrfToken ?>">
          <div class="mb-3">
            <label for="username" class="form-label">Email</label>
            <input type="email" class="form-control" id="username" name="username" placeholder="Masukkan alamat email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
          </div>
          <button type="submit" class="btn btn-primary w-full flex justify-center items-center"><i class='fas fa-sign-in-alt spaced-icon'></i>Login</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/dist/css/login/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../../assets/dist/css/login/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="../../assets/dist/sweet/sweetalert2.all.min.js"></script>
  <script src="../../assets/plugins/toastr/toastr.min.js"></script>
  <script>
    // Ambil data flash message dari div dengan kelas flash-data
    var flashData = $('.flash-data').data('flashdata');

    // Jika ada flash data dengan pesanMasuk
    if (flashData) {
      // Tampilkan pesan menggunakan toastr
      toastr.error(flashData, 'Error');
    }
  </script>

</body>

</html>