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
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>BPSDM</b>Prov. Sulteng</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Masuk Sistem Informasi Diklat<br> BPSDM Prov. Sulteng</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <input type="email" id="email" name="email" aria-describedby="helpBlock1" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if($errors->has('email'))
                        <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('email') }}</strong></span> 
                    @endif
                </div>
                <div class="form-group has-feedback">
                    <input type="password" id="password" name="password" aria-describedby="helpBlock2" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if($errors->has('password'))
                        <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('password') }}</strong></span> 
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                            <input type="checkbox" id="remember" name="remember" value="{{ old('remember') ? 'checked' : '' }}"> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="#">Lupa Password ?</a><br>
            <a href="{{ route('register') }}" class="text-center">Belum punya akun?, Silahkan daftar disini</a>

        </div>
        <!-- /.login-box-body -->
    </div>
<!-- /.login-box -->

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
