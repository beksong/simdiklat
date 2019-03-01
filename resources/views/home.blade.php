@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-success box-solid">
                <!-- box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">Selamat Datang {{ Auth::User()->name }}</h3>
                    <!-- box control -->
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- box body -->
                <div class="box-body">

                    @if(session('status'))
                        {{ session('status') }}
                    @endif
                    
                    Jangan Lupa untuk melengkapi profil anda pada menu <a href="{{ route('profile') }}">Profile</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <a href="" class="btn btn-primary"><i class="fa fa-btn fa-pencil"></i></a> -->
@endsection
