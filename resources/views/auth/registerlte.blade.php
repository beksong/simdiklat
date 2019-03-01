<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>BPSDM</b>Prov. Sulteng</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Mendaftar Akun Sistem Informasi Diklat<br> BPSDM Prov. Sulteng</p>

    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="form-group has-feedback">
            <input type="text" id="nip" name="nip" class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" aria-describedby="helpBlock" placeholder="NIP anda" autofocus required>
            <span class="glyphicon glyphicon-card form-control-feedback"></span>
            @if($errors->has('nip'))
                <span id="helpBlock" class="help-block"><strong>{{ $errors->first('nip') }}</strong></span> 
            @endif
        </div>
        <div class="form-group has-feedback">
            <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" aria-describedby="helpBlock1" placeholder="Nama Lengkap" autofocus required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if($errors->has('name'))
                <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('name') }}</strong></span> 
            @endif
        </div>
        <div class="form-group has-feedback">
            <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" aria-describedby="helpBlock2" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if($errors->has('email'))
                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('email') }}</strong></span> 
            @endif
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" aria-describedby="helpBlock3" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if($errors->has('password'))
                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('password') }}</strong></span> 
            @endif
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation" required>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <a href="{{route('login')}}" class="text-center">Login,Jika sudah punya akun</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="{{ asset('jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
