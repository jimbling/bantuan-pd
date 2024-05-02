<!DOCTYPE html>
<html class="login-page">

<head>
  <meta charset="UTF-8">
  <title>SIM SDN Kedungrejo</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta name="description" content="Sitem Informasi Manajemen (SIM) Bantuan Peserta Didik, adalah SIM untuk mengelola bantuan PIP dan lainnya pada SD Negeri Kedungrejo Pengasih Kulon Progo">
  <meta name="keywords" content="sim, sdn kedungrejo, pengasih, kulon progo, sd pengasih, website sd, webiste sekolah dasar">
  <meta name="author" content="SD Negeri Kedungrejo Pengasih">
  <!-- bootstrap 3.0.2 -->
  <link href="../../assets/dist/css/login/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- font Awesome -->
  <link href="../../assets/dist/css/login/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="../../assets/dist/css/login/css/style.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/dist/css/login/css/app.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/dist/css/login/css/login.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/dist/css/login/css/style_menu.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <style type="text/css">
    html,
    body {
      background-image: url('#'), url('../../assets/dist/img/gedung.png');
    }
  </style>
</head>
<div class="flash-data" data-flashdata="<?= (session()->getFlashData('pesanMasuk')); ?>"></div><!-- Page Heading -->

<body>
  <div id="main_cont">
    <div class="form-box" id="login-box">
      <div class="header company-pattern">
        <img src="../../assets/dist/img/logo.png" height="150"><br />
        Sistem Informasi Manajemen <p> <b>Bantuan Peserta Didik</b> </p>
      </div>

      <form action="masuk/auth" method="post">
        <input type="hidden" name="<?= csrf_token() ?>" value="<?= $csrfToken ?>">
        <div class="body bg-gray">
          <div class="form-group">
            <input type="text" name="username" id="username" class="form-control" placeholder="Akun Pengguna" />
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Kata Sandi" />
          </div>
          <div class="form-group">
            <div class="checkbox" style="margin-left:20px">
              <label>
                <input type="checkbox" name="remember_me" value="1" /> Ingat saya
              </label>
            </div>
          </div>
        </div>
        <div class="footer">


          <div class="col-lg-12 col-md-12 col-12" style="padding: 8px; ">
            <div class="body_tombol_warna">
              <div class="container_tombol">
                <a href="http://webmail.kulonprogokab.go.id/" style="text-decoration:none; " target="_blank">
                  <div class="box_tombol" style="--clr:#FCA64D; --clr2:#FA4F11; --clr3:#cc4210; --clr4:#af3205;">
                    <div class="content_tombol">
                      <div class="icon_tombol"><ion-icon name="checkmark-done-outline"></ion-icon></div>
                      <div class="text_tombol">
                        <h5>Login Webmail</h5>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>


          <div class="footer">
            <a href="https://sdnkedungrejo.sch.id" target="_blank">SD Negeri Kedungrejo</a>
            <a href="#" style="float: right; color:#A7A9AC;">Kulon Progo</a>
          </div>
      </form>

    </div>
  </div>

  <!-- jQuery 2.0.2 -->
  <script src="../../assets/dist/css/login/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../../assets/dist/css/login/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="../../assets/dist/sweet/sweetalert2.all.min.js"></script>
  <script src="../../assets/dist/sweet/myscript.js"></script>
  <script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-91361426-1', 'auto');
    ga('send', 'pageview');
  </script>
</body>

</html>