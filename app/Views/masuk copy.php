<!DOCTYPE html>
<html lang="en" class="app">

<head>
  <meta charset="utf-8" />
  <title>Login :: Sistem Informasi Manajemen Bantuan Pendidikan SDN Kedungrejo</title>
  <meta name="description" content="Halaman Login Sistem Informasi Manajemen Data Penerima Bantuan Pendidikan" />
  <meta name="keywords" content="sim, sdnkedungrejo, sd n kedungrejo, pip, baznas, siabazku, bantuan">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto+Condensed" rel="stylesheet">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link rel="stylesheet" href="../../assets/dist/login/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../../assets/dist/login/css/app.css" type="text/css" />



  <style id="compiled-css" type="text/css">
    :root {
      --input-padding-x: 1.5rem;
      --input-padding-y: .75rem;
    }

    .mask,
    .plane {
      perspective: 1000;
      backface-visibility: hidden
    }

    #middle .plane,
    .plane {
      transform: translate3d(0, 0, 0)
    }

    body {
      background: #9CECFB;
      background: -webkit-linear-gradient(to right, #0052D4, #65C7F7, #9CECFB);
      background: linear-gradient(to right, #0052D4, #65C7F7, #9CECFB)
    }

    .card-signin {
      border: 0;
      border-radius: 1rem;
      box-shadow: 0 .5rem 1rem 0 rgba(0, 0, 0, .1)
    }

    .card-signin .card-title {
      margin-bottom: 2rem;
      font-weight: 300;
      font-size: 1.5rem
    }

    .card-signin .card-body {
      padding: 2rem
    }

    .form-signin {
      width: 100%
    }

    .form-signin .btn {
      font-size: 80%;
      border-radius: 5rem;
      letter-spacing: .1rem;
      font-weight: 700;
      padding: 1rem;
      transition: all .2s
    }

    .form-label-group {
      position: relative;
      margin-bottom: 1rem
    }

    .form-label-group input {
      height: auto;
      border-radius: 2rem
    }

    .form-label-group>input,
    .form-label-group>label {
      padding: var(--input-padding-y) var(--input-padding-x)
    }

    .form-label-group>label {
      position: absolute;
      top: 0;
      left: 0;
      display: block;
      width: 100%;
      margin-bottom: 0;
      line-height: 1.5;
      color: #495057;
      border: 1px solid transparent;
      border-radius: .25rem;
      transition: all .1s ease-in-out
    }

    .form-label-group input::-webkit-input-placeholder {
      color: transparent
    }

    .form-label-group input:-ms-input-placeholder {
      color: transparent
    }

    .form-label-group input::-ms-input-placeholder {
      color: transparent
    }

    .form-label-group input::-moz-placeholder {
      color: transparent
    }

    .form-label-group input::placeholder {
      color: transparent
    }

    .form-label-group input:not(:placeholder-shown) {
      padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
      padding-bottom: calc(var(--input-padding-y)/ 3)
    }

    .form-label-group input:not(:placeholder-shown)~label {
      padding-top: calc(var(--input-padding-y)/ 3);
      padding-bottom: calc(var(--input-padding-y)/ 3);
      font-size: 12px;
      color: #777
    }

    .btn-google {
      color: #fff;
      background-color: #ea4335
    }

    .btn-facebook {
      color: #fff;
      background-color: #3b5998
    }

    #global {
      width: 70px;
      margin: 300px auto auto;
      position: relative;
      cursor: pointer;
      height: 60px
    }

    .mask {
      position: absolute;
      border-radius: 2px;
      overflow: hidden
    }

    .plane {
      background: gold;
      width: 400%;
      height: 100%;
      position: absolute;
      z-index: 100
    }

    .animation {
      transition: all .3s ease
    }
  </style>


</head>
<div class="flash-data" data-flashdata="<?= (session()->getFlashData('pesanMasuk')); ?>"></div><!-- Page Heading -->

<body class="bg-login">


  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">

            <center><img src="../../assets/dist/login/logo.png" alt="" width="60" /></center><br>
            </center>
            <h5 class="text-left" style="font-size: 18px"><b>
                <center>Sistem Informasi Manajemen</center>
              </b></h5>

            <form class="form-signin" action="masuk/auth" id="login-form" method="post">
              <input type="hidden" name="<?= csrf_token() ?>" value="<?= $csrfToken ?>">

              <h5 class="text-left" style="font-size: 13px">
                <center>Bantuan Pendidikan Peserta Didik</center>
              </h5><br>
              </center>

              <div class="form-label-group">
                <input type="text" id="inputName" name="username" class="form-control" placeholder="Username" autocomplete="off" required>
                <label for="inputName">Username Admin</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>


              <button class="btn btn-lg btn-primary btn-block text-uppercase submit" type="submit">MASUK</button><br>
              <small class="card-title text-center msgform" style="font-size: 14px;text-align: center;"></small>
              <hr class="my-4">
              <a href="https://www.sdnkedungrejo.sch.id/" target="_blank" style="color: #1d2030; text-decoration: none;">
                <h5 class="text-left" style="font-size: 13px"><b>SD Negeri Kedungrejo Kapanewon Pengasih Kab. Kulon Progo</b> </h5>
              </a>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- jQuery 2.0.2 -->
  <script src="../../assets/dist/css/login/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../../assets/dist/css/login/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="../../assets/dist/sweet/sweetalert2.all.min.js"></script>
  <script src="../../assets/dist/sweet/myscript.js"></script>

</body>

</html>