<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?> Tahun <?= $tahun ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../assets/dist/css/cetak_rekap.css" rel="stylesheet" type="text/css">
    <script>
        // Jalankan pencetakan saat halaman dimuat
        window.onload = function() {
            window.print();
        };
    </script>
</head>

<body>
    <div class="container-fluid">
        <div class="container mt-2">
            <h4>
                <center><b>REKAPITULASI PENERIMA BANTUAN PENDIDIKAN</b></CENTER>
                <P>
                    <center><b>TAHUN <?= $tahun ?> </b></CENTER>
            </h4>
        </div>
        <table class="table table-no-border">

            <tbody>
                <tr>
                    <td width="15%" style="text-align: left;">NPSN</td>
                    <td width="2%" style="text-align: right;">:</td>
                    <td style="text-align: left;"><?php echo $dataCetak['npsn'] ?></td>
                </tr>
                <tr>
                    <td width="10%" style="text-align: left;">Nama Sekolah</td>
                    <td width="2%" style="text-align: right;">:</td>
                    <td style="text-align: left;"><?php echo $dataCetak['nama_sp'] ?></td>
                </tr>
                <tr>
                    <td width="10%" style="text-align: left;">Alamat</td>
                    <td width="2%" style="text-align: right;">:</td>
                    <td style="text-align: left;"><?php echo $dataCetak['dusun_sp'] ?></td>
                </tr>
                <tr>
                    <td width="10%" style="text-align: left;">Kecamatan</td>
                    <td width="2%" style="text-align: right;">:</td>
                    <td style="text-align: left;"><?php echo $dataCetak['kapanewon_sp'] ?></td>
                </tr>
                <tr>
                    <td width="10%" style="text-align: left;">Kabupaten</td>
                    <td width="2%" style="text-align: right;">:</td>
                    <td style="text-align: left;"><?php echo $dataCetak['kabupaten_sp'] ?></td>
                </tr>

            </tbody>
        </table>
        <br>
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead class="thead-dark">
                <tr>
                    <td colspan="5" style="text-align: center;">Rekap Penerima Bantuan Dana Pendidikan</td>
                </tr>
                <tr>
                    <th>No</th>
                    <th>Jenis Bantuan</th>
                    <th>Jumlah Penerima</th>
                    <th>Jumlah Dana</th>
                    <th>Tahun Penerimaan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>PIP</td>
                    <td><?= $PIP ?></td>
                    <td><?= 'Rp. ' . number_format($totalNominalPIP, 0, ',', '.') ?></td>
                    <td><?= $tahun ?></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>BSM</td>
                    <td><?= $BSM ?></td>
                    <td><?= 'Rp. ' . number_format($totalNominalBSM, 0, ',', '.') ?></td>
                    <td><?= $tahun ?></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>SIABAZKu</td>
                    <td><?= $SIABAZKu ?></td>
                    <td><?= 'Rp. ' . number_format($totalNominalSIABAZKu, 0, ',', '.') ?></td>
                    <td><?= $tahun ?></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Lainnya</td>
                    <td><?= $Lainnya ?></td>
                    <td><?= 'Rp. ' . number_format($totalNominalLainnya, 0, ',', '.') ?></td>
                    <td><?= $tahun ?></td>
                </tr>
                <!-- Kolom untuk Jumlah Seluruh Dana -->
                <tr>
                    <td colspan="2"><strong>J U M L A H</strong></td>
                    <td><strong><?= $PIP + $BSM + $SIABAZKu + $Lainnya ?></strong></td>
                    <td><strong><?= 'Rp. ' . number_format($totalNominalPIP + $totalNominalBSM + $totalNominalSIABAZKu + $totalNominalLainnya, 0, ',', '.') ?></strong></td>
                    <td><strong><?= $tahun ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>

    <div class="container">
        <table class="table table-no-border text-center">
            <thead>
                <tr>
                    <th style="width: 50%;">
                    </th>
                    <th style="width: 50%;">
                        <p> <?php
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

                            echo $dataCetak['kapanewon_sp'] . ', ' . $tanggal_saat_ini;
                            ?>
                        <p>Kepala Sekolah
                            <br></br>

                        <p class="underlined-text"><b><?php echo $dataCetak['nama_ks'] ?></b>
                        <p>NIP. <?php echo $dataCetak['nip_ks'] ?></p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- Isi tabel sesuai kebutuhan -->
            </tbody>
        </table>
    </div>


    <div class="col page-break-before">
        <h4>
            <p class="underlined-text">Lampiran Data Peserta Didik Penerima Bantuan Tahun <b><?= $tahun ?></b></p>
        </h4>
        <br>
        <div class="tab mt-4">
            <span class="tab-marker"><strong>A.</strong></span>
            <span class="tab-content"><strong>Penerima Bantuan PIP Tahun <b><?= $tahun ?></b></strong></span>
            <br>
        </div>
        <br>
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>NISN</th>
                    <th>Kelas</th>
                    <th>Tanggal SK</th>
                    <th>Tahap</th>
                    <th>No Rek</th>
                    <th>Nominal</th>
                    <th>Nama Ibu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (empty($pipData)) {
                    echo '<tr><td colspan="10" style="text-align:center;">Tidak ada siswa penerima PIP Tahun ' . $tahun . '</td></tr>';
                } else {
                    $no = 1;
                    $totalNominalPIP = 0;

                    foreach ($pipData as $siswaPip) {
                        echo '<tr>';
                        echo '<td>' . $no++ . '</td>';
                        echo '<td style="text-align:left;">' . $siswaPip['nama_pd'] . '</td>';
                        echo '<td>' . $siswaPip['nisn'] . '</td>';
                        echo '<td>' . $siswaPip['kelas'] . '</td>';
                        echo '<td>' . $siswaPip['tanggal_sk'] . '</td>';
                        echo '<td>' . $siswaPip['tahap_id'] . '</td>';
                        echo '<td>' . $siswaPip['no_rekening'] . '</td>';
                        echo '<td>Rp. ' . number_format($siswaPip['nominal'], 0, ',', '.') . '</td>';
                        echo '<td>' . $siswaPip['nama_ibu_kandung'] . '</td>';
                        echo '</tr>';

                        // Akumulasi nilai nominal
                        $totalNominalPIP += $siswaPip['nominal'];
                    }

                    // Tampilkan kolom baru untuk jumlah nominal
                    echo '<tr>';
                    echo '<td colspan="7" style="text-align:right;"><b>Total Nominal</b></td>';
                    echo '<td><b>Rp. ' . number_format($totalNominalPIP, 0, ',', '.') . '</b></td>';
                    echo '<td></td>'; // Kolom kosong untuk menjaga tata letak
                    echo '</tr>';
                }
                ?>
            </tbody>

        </table>

        <br>
        <div class="col page-break-before">
            <div class="tab mt-4">
                <span class="tab-marker"><strong>B.</strong></span>
                <span class="tab-content"><strong>Penerima Bantuan BSM Tahun <b><?= $tahun ?></b></strong></span>
                <br>
            </div>
            <br>
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Tanggal SK</th>
                        <th>Tahap</th>
                        <th>No Rek</th>
                        <th>Nominal</th>
                        <th>Nama Ibu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (empty($dataKelompok['BSM'])) {
                        echo '<tr><td colspan="10" style="text-align:center;">Tidak ada siswa penerima BSM Tahun ' . $tahun . '</td></tr>';
                    } else {
                        $no = 1;
                        $totalNominalBSM = 0;

                        foreach ($dataKelompok['BSM'] as $siswaBSM) {
                            echo '<tr>';
                            echo '<td>' . $no++ . '</td>';
                            echo '<td style="text-align:left;">' . $siswaBSM['nama_pd'] . '</td>';
                            echo '<td>' . $siswaBSM['nisn'] . '</td>';
                            echo '<td>' . $siswaBSM['kelas'] . '</td>';
                            echo '<td>' . $siswaBSM['tanggal_sk'] . '</td>';
                            echo '<td>' . $siswaBSM['tahap_id'] . '</td>';
                            echo '<td>' . $siswaBSM['no_rekening'] . '</td>';
                            echo '<td>Rp. ' . number_format($siswaBSM['nominal'], 0, ',', '.') . '</td>';
                            echo '<td>' . $siswaBSM['nama_ibu_kandung'] . '</td>';
                            echo '</tr>';

                            // Akumulasi nilai nominal
                            $totalNominalBSM += $siswaBSM['nominal'];
                        }

                        // Tampilkan kolom baru untuk jumlah nominal
                        echo '<tr>';
                        echo '<td colspan="7" style="text-align:right;"><b>Total Nominal</b></td>';
                        echo '<td><b>Rp. ' . number_format($totalNominalBSM, 0, ',', '.') . '</b></td>';
                        echo '<td></td>'; // Kolom kosong untuk menjaga tata letak
                        echo '</tr>';
                    }
                    ?>
                </tbody>

            </table>

            <br>
            <div class="tab mt-4">
                <span class="tab-marker"><strong>C.</strong></span>
                <span class="tab-content"><strong>Penerima Bantuan SIABAZKu Tahun <b><?= $tahun ?></b></strong></span>
                <br>
            </div>
            <br>
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Tanggal SK</th>
                        <th>Tahap</th>
                        <th>No Rek</th>
                        <th>Nominal</th>
                        <th>Nama Ibu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (empty($dataKelompok['SIABAZKu'])) {
                        echo '<tr><td colspan="10" style="text-align:center;">Tidak ada siswa penerima SIABAZKu Tahun ' . $tahun . '</td></tr>';
                    } else {
                        $no = 1;
                        $totalNominalSiabazku = 0;

                        foreach ($dataKelompok['SIABAZKu'] as $siswaSiabazku) {
                            echo '<tr>';
                            echo '<td>' . $no++ . '</td>';
                            echo '<td style="text-align:left;">' . $siswaSiabazku['nama_pd'] . '</td>';
                            echo '<td>' . $siswaSiabazku['nisn'] . '</td>';
                            echo '<td>' . $siswaSiabazku['kelas'] . '</td>';
                            echo '<td>' . $siswaSiabazku['tanggal_sk'] . '</td>';
                            echo '<td>' . $siswaSiabazku['tahap_id'] . '</td>';
                            echo '<td>' . $siswaSiabazku['no_rekening'] . '</td>';
                            echo '<td>Rp. ' . number_format($siswaSiabazku['nominal'], 0, ',', '.') . '</td>';
                            echo '<td>' . $siswaSiabazku['nama_ibu_kandung'] . '</td>';
                            echo '</tr>';

                            // Akumulasi nilai nominal
                            $totalNominalSiabazku += $siswaSiabazku['nominal'];
                        }

                        // Tampilkan kolom baru untuk jumlah nominal
                        echo '<tr>';
                        echo '<td colspan="7" style="text-align:right;"><b>Total Nominal</b></td>';
                        echo '<td><b>Rp. ' . number_format($totalNominalSiabazku, 0, ',', '.') . '</b></td>';
                        echo '<td></td>'; // Kolom kosong untuk menjaga tata letak
                        echo '</tr>';
                    }
                    ?>
                </tbody>

            </table>

            <br>
            <div class="tab mt-4">
                <span class="tab-marker"><strong>D.</strong></span>
                <span class="tab-content"><strong>Penerima Bantuan Lainnya Tahun <b><?= $tahun ?></b></strong></span>
                <br>
            </div>
            <br>
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Tanggal SK</th>
                        <th>Tahap</th>
                        <th>No Rek</th>
                        <th>Nominal</th>
                        <th>Nama Ibu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (empty($dataKelompok['Lainnya'])) {
                        echo '<tr><td colspan="10" style="text-align:center;">Tidak ada siswa penerima Bantuan Lainnya Tahun ' . $tahun . '</td></tr>';
                    } else {
                        $no = 1;
                        $totalNominalLainnya = 0;

                        foreach ($dataKelompok['Lainnya'] as $siswaLainnya) {
                            echo '<tr>';
                            echo '<td>' . $no++ . '</td>';
                            echo '<td style="text-align:left;">' . $siswaLainnya['nama_pd'] . '</td>';
                            echo '<td>' . $siswaLainnya['nisn'] . '</td>';
                            echo '<td>' . $siswaLainnya['kelas'] . '</td>';
                            echo '<td>' . $siswaLainnya['tanggal_sk'] . '</td>';
                            echo '<td>' . $siswaLainnya['tahap_id'] . '</td>';
                            echo '<td>' . $siswaLainnya['no_rekening'] . '</td>';
                            echo '<td>Rp. ' . number_format($siswaLainnya['nominal'], 0, ',', '.') . '</td>';
                            echo '<td>' . $siswaLainnya['nama_ibu_kandung'] . '</td>';
                            echo '</tr>';

                            // Akumulasi nilai nominal
                            $totalNominalLainnya += $siswaLainnya['nominal'];
                        }

                        // Tampilkan kolom baru untuk jumlah nominal
                        echo '<tr>';
                        echo '<td colspan="7" style="text-align:right;"><b>Total Nominal</b></td>';
                        echo '<td><b>Rp. ' . number_format($totalNominalLainnya, 0, ',', '.') . '</b></td>';
                        echo '<td></td>'; // Kolom kosong untuk menjaga tata letak
                        echo '</tr>';
                    }
                    ?>
                </tbody>

            </table>


        </div>
        <br>
        <div class="col page-break-before">
            <div class="tab mt-4">
                <span class="tab-marker"><strong>E.</strong></span>
                <span class="tab-content"><strong>TOTAL DANA BANTUAN TAHUN <b><?= $tahun ?></b></strong></span>
                <br>
            </div>
            <br>

            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Jenis Bantuan</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $totalSemua = 0;

                    // Tampilkan baris untuk PIP terlebih dahulu
                    $totalNominalPIP = array_sum(array_column($pipData, 'nominal'));
                    echo '<tr>';
                    echo '<td>' . $no++ . '</td>';
                    echo '<td>PIP</td>';
                    echo '<td>Rp. ' . number_format($totalNominalPIP, 0, ',', '.') . '</td>';
                    echo '</tr>';

                    // Akumulasikan total semuanya dengan total nominal PIP
                    $totalSemua += $totalNominalPIP;

                    // Iterasi untuk setiap jenis bantuan selain PIP
                    foreach ($dataKelompok as $jenisBantuan => $data) {
                        if ($jenisBantuan !== 'PIP') {
                            $totalBantuan = array_sum(array_column($data, 'nominal'));

                            // Tampilkan baris untuk setiap jenis bantuan
                            echo '<tr>';
                            echo '<td>' . $no++ . '</td>';
                            echo '<td>' . $jenisBantuan . '</td>';
                            echo '<td>Rp. ' . number_format($totalBantuan, 0, ',', '.') . '</td>';
                            echo '</tr>';

                            // Akumulasikan total semuanya
                            $totalSemua += $totalBantuan;
                        }
                    }

                    // Tampilkan total keseluruhan
                    echo '<tr>';
                    echo '<td colspan="2" style="text-align:right;"><strong>Total Keseluruhan</strong></td>';
                    echo '<td><strong>Rp. ' . number_format($totalSemua, 0, ',', '.') . '</strong></td>';
                    echo '</tr>';
                    ?>
                </tbody>
            </table>
        </div>
    </div>



</body>

</html>