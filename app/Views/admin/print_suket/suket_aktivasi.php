<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?>_<?php echo $siswaPip['nama_pd'] ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link href="../../assets/dist/css/cetak.css" rel="stylesheet" type="text/css">
    <script>
        // Jalankan pencetakan saat halaman dimuat
        window.onload = function() {
            window.print();
        };
    </script>
</head>

<body>
    <div class="col-sm-10">
        <img src="../../assets/dist/img/kdrj/<?php echo $data_cetak['ctk_kopsurat'] ?>" width="1000px">
    </div>
    <div class="container-fluid">
        <div class="container mt-2 ">
            <h3>
                <center><b>SURAT KETERANGAN</b></CENTER>
            </h3>
            <h3>
                <center class="underlined-text"><b>AKTIVASI REKENING SIMPEL PIP</b></CENTER>
            </h3>
        </div>
        <h4>
            <center> No. <?php echo $siswaPip['no_surat'] ?> </center>
        </h4>
        <br>
        <p>Yang bertanda tangan dibawah ini :


        <dl class="row">
            <dt-not-bold class="col-sm-3">Nama</dt-not-bold>
            <dd class="col-sm-9">: SRI MARDIYATI,S.Pd.</dd>
            <dt-not-bold class="col-sm-3">NIP</dt-not-bold>
            <dd class="col-sm-9">: 19691031 199103 2 003</dd>
            <dt-not-bold class="col-sm-3">Jabatan</dt-not-bold>
            <dd class="col-sm-9">: Kepala Sekolah</dd>
            <dt-not-bold class="col-sm-3">Alamat Kantor</dt-not-bold>
            <dd class="col-sm-9">: SD Negeri Kedungrejo Kapanewon Pengasih</dd>
        </dl>
        <p>Menerangkan dengan sebenarnya bahwa:</p>
        <dl class="row">
            <dt-not-bold class="col-sm-3">Nama</dt-not-bold>
            <dd class="col-sm-9">: <?php echo $siswaPip['nama_pd'] ?></dd>
            <dt-not-bold class="col-sm-3">Tempat, Tgl. Lahir</dt-not-bold>
            <dd class="col-sm-9">: <?php echo mb_convert_case($siswaPip['tempat_lahir'], MB_CASE_TITLE, 'UTF-8') ?>,
                <?php
                // Tanggal dari format database
                $tanggal_database = $siswaPip['tanggal_lahir'];

                // Konversi tanggal ke format Indonesia
                $tanggal_indonesia = date("d F Y", strtotime($tanggal_database));

                // Daftar nama bulan dalam bahasa Indonesia
                $bulan_indonesia = [
                    'January' => 'Januari',
                    'February' => 'Februari',
                    'March' => 'Maret',
                    'April' => 'April',
                    'May' => 'Mei',
                    'June' => 'Juni',
                    'July' => 'Juli',
                    'August' => 'Agustus',
                    'September' => 'September',
                    'October' => 'Oktober',
                    'November' => 'November',
                    'December' => 'Desember'
                ];

                // Ganti nama bulan dalam format Indonesia
                $tanggal_indonesia = strtr($tanggal_indonesia, $bulan_indonesia);

                // Tampilkan tanggal dalam format Indonesia
                echo $tanggal_indonesia;
                ?>
            </dd>
            <dt-not-bold class="col-sm-3">NISN</dt-not-bold>
            <dd class="col-sm-9">: <?php echo $siswaPip['nisn'] ?></dd>
            <dt-not-bold class="col-sm-3">Sekolah</dt-not-bold>
            <dd class="col-sm-9">: <?php echo strtoupper(substr(ucwords(strtolower($siswaPip['nomenklatur'])), 0, 2)) . substr(ucwords(strtolower($siswaPip['nomenklatur'])), 2); ?></dd>
            <dt-not-bold class="col-sm-3">Kelas</dt-not-bold>
            <dd class="col-sm-9">: <?php echo $siswaPip['kelas'] ?></dd>
            <dt-not-bold class="col-sm-3">No. Rekening</dt-not-bold>
            <dd class="col-sm-9">: <?php echo $siswaPip['no_rekening'] ?></dd>
            <dt-not-bold class="col-sm-3">Virtual Account</dt-not-bold>
            <dd class="col-sm-9">: <?php echo $siswaPip['virtual_acc'] ?></dd>
            <dt-not-bold class="col-sm-3">Nama Ayah</dt-not-bold>
            <dd class="col-sm-9">: <?php echo $siswaPip['nama_ayah'] ?></dd>
            <dt-not-bold class="col-sm-3">Nama Ibu</dt-not-bold>
            <dd class="col-sm-9">: <?php echo $siswaPip['nama_ibu_kandung'] ?></dd>
        </dl>
        <p style="text-align: justify;">Bahwa anak tersebut di atas adalah benar-benar siswa <?php echo $data_cetak['nama_sp'] ?> Kapanewon <?php echo $data_cetak['kapanewon_sp'] ?> Kabupaten <?php echo $data_cetak['kabupaten_sp'] ?> dan masuk dalam daftar Siswa Penerima PIP Tahun <?php echo (new DateTime())->format('Y'); ?>.
        </p>
        <p style="text-align: justify;">Demikian surat keterangan ini dibuat untuk digunakan sebagai salah satu persyaratan untuk melakukan aktivasi rekening SimPel PIP di bank penyalur.
        </p>
    </div>

    <div class="container mt-5">
        <div class="row mt">
            <div class="col">

            </div>
            <div class="col">
                <?php
                // Mendapatkan tanggal saat ini dalam format "d F Y"
                $tanggal_saat_ini = date('d F Y');

                // Konversi nama bulan ke bahasa Indonesia
                $bulan_indonesia = [
                    'January' => 'Januari',
                    'February' => 'Februari',
                    'March' => 'Maret',
                    'April' => 'April',
                    'May' => 'Mei',
                    'June' => 'Juni',
                    'July' => 'Juli',
                    'August' => 'Agustus',
                    'September' => 'September',
                    'October' => 'Oktober',
                    'November' => 'November',
                    'December' => 'Desember'
                ];

                $tanggal_saat_ini = strtr($tanggal_saat_ini, $bulan_indonesia);

                echo $data_cetak['kapanewon_sp'] . ', ' . $tanggal_saat_ini;
                ?>
                <p> Kepala Sekolah</p>

                <br>
                </br>
                <p class="underlined-text"><b><?php echo $data_cetak['nama_ks'] ?></b>
                <p>NIP. <?php echo $data_cetak['nip_ks'] ?></p>
            </div>




        </div>
    </div>

</body>

</html>