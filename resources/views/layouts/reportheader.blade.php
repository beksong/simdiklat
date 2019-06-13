<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BPSDM Prov. Sulteng</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="row">
        <div class="col-sm-2 col-xs-2">
            <center>
            <img src="{{ asset('storage/profile/LOGO_SULAWESI_TENGAH.png') }}" class="img img-responsive" alt="logo-sulteng" style="width:60px;height:100px;">
            </center>
        </div>
        <div class="col-sm-10 col-xs-10">
            <h4 style="text-align:center;">PEMERINTAH PROVINSI SULAWESI TENGAH</h4>
            <h5 style="text-align:center;">BADAN PENGEMBANGAN SUMBER DAYA MANUSIA DAERAH</h5>
            <p style="text-align:center;">Jl. S. Parman No. 67 Telp. ( 0451 ) 421292 Fax. ( 0451 ) 428116 </p>
            <p style="text-align:center;"> website : bspdm.sultengprov.go.id </p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <hr style="border:3px solid;">
        </div>
    </div>
@yield('content')
<script src="{{ asset('jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
@stack('jscript')
</body>
</html>
