<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BPSDM Prov. Sulteng</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
        <!-- </head> -->
        <style>
         #help{
             background-color : #c2c2a3;
         }
         .black-li{
             color:black;
         }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <!-- header -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="{{ url('storage/profile/LOGO_SULAWESI_TENGAH.png') }}" alt="logo-sulteng" style="width:20px; height:30px;" class="img-responsive"></a>
                </div>

                <!-- container menu on navbar -->
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="nav navbar-nav">
                        <li><a href="#"> BPSDM SULAWESI TENGAH</a></li>
                        <!-- <li><a href="#help">Bantuan</a></li> -->
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ route('login')}}"> Masuk</a></li>
                        <li><a href="{{ route('register')}}"> Daftar</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- content -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="carousel1" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="carousel1" data-slide-to="0" class="active"></li>
                        <li data-target="carousel1" data-slide-to="1" class="active"></li>
                        <li data-target="carousel1" data-slide-to="2" class="active"></li>
                    </ol>

                    <!-- carousel content -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="{{ url('images/banner1.jpg') }}" alt="banner1" class="img-responsive">
                            <div class="carousel-caption">
                                <h3>DATA MENCERDASKAN BANGSA</h3>
                            </div>
                        </div>
                        <div class="item">
                            <img src="{{ url('images/banner2.jpg') }}" alt="banner1" class="img-responsive">
                            <div class="carousel-caption">
                                <h3>DIGITALISASI DATA UNTUK ADMINISTRASI YANG LEBIH BAIK</h3>
                            </div>
                        </div>
                        <div class="item">
                            <img src="{{ url('images/banner3.jpg') }}" alt="banner1" class="img-responsive">
                            <div class="carousel-caption">
                                <h3>SISTEM INFORMASI DIKLAT</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Control -->
                    <a class="left carousel-control" href="#carousel1" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel1" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-header text-center">
                    <i><h3>Historical Data</h3></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="thumbnail text-center">
                    <div class="caption">
                        <h3>Alumni</h3>
                        <span style="font-size:5em;" class="glyphicon glyphicon-education"></span>
                        <h4>10000+ alumni ASN</h4>
                        <p>Kami telah mengahasilkan alumni asn yang siap mengabdi demi kemajuan Sulawesi Tengah</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="thumbnail text-center">
                    <div class="caption">
                        <h3>Pelatihan</h3>
                        <span style="font-size:5em;" class="glyphicon glyphicon-wrench"></span>
                        <h4>10000+ Pelatihan ASN</h4>
                        <p>Melalui berbagai kegiatan pelatihan yang disesuaikan dengan kebutuhan OPD dan perkembangan jaman</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="thumbnail text-center">
                    <div class="caption">
                        <h3>Kurikulum</h3>
                        <span style="font-size:5em;" class="glyphicon glyphicon-bookmark"></span>
                        <h4>Uptodate</h4>
                        <p>Kurikulum yang menyesuaikan perkembangan dinamika bangsa serta tetap menjunjung nilai-nilai luhur bangsa</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="help">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-header text-center">
                    <i><h3>Bantuan</h3></i>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div>
                    <ol>
                        <li>
                            <a href="https://youtu.be/zxgREGtFyNg" class="black-li" target="_blank">Cara melakukan registrasi dan login ke SIMPEL ( Sistem informasi manajemen pelatihan )</a>
                        </li>
                        <li>
                            <a href="https://youtu.be/Yf0kLHjI134" class="black-li" target="_blank">Cara memperbaiki profile pada SIMPEL</a>
                        </li>
                        <li>
                            <a href="https://youtu.be/H1wMHRnHk1I" class="black-li" target="_blank"> Cara mendaftar pelatihan dan mencetak biodata calon peserta</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <!-- </body></html> -->
    </body>
</html>
