@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Training</a></li>
        <li class="active">As Participant</li>
    </ol>
</section>
<!-- main content -->
<section class="content">
    <!-- flash message -->
    <div class="row">
        @if(Session::has('message'))
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-info box-solid">
                    <!-- box-header -->
                    <div class="box-header with-border">
                        <h3 class="box-title">Informasi</h3>
                        <!-- box control -->
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- box body -->
                    <div class="box-body">
                        <p>{{ Session::get('message') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- content -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="info-box bg-yellow">
                <span class="info-box-icon"> <a href=""><i class="ion ion-ios-pricetag-outline"></i></a></span>
                <div class="info-box-content">
                    <span class="info-box-text">Diklat yang sedang saya ikuti</span>
                    <span class="info-box-number">{{ $participant->training->name }} </span>
                    <span class="info-box-text"> Tanggal Mulai : {{ $participant->training->start_date }} || Tanggal Selesai : {{$participant->training->end_date }}</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
