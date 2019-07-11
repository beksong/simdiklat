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
                <span class="info-box-icon"> <i class="ion ion-ios-pricetag-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Diklat yang sedang saya ikuti</span>
                    <span class="info-box-number">{{ $participant->training->name }} </span>
                    <span class="info-box-text"> Tanggal Mulai : {{ \Carbon\Carbon::parse($participant->training->start_date)->format('d-m-Y') }} || Tanggal Selesai : {{ \Carbon\Carbon::parse($participant->training->end_date)->format('d-m-Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- form proyek perubahan -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Upload Proyek Perubahan / Laporan Aktualisasi</h3>
                    <h4 class="box-title">{{ $participant->training->name }}</h4>
                </div>
                <div class="box-body">
                    <form action="{{ route('participantproper') }}" role="form"  method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="participant_id" id="participant_id" value="{{ $participant->id }}">
                        <div class="form-group has-feedback">
                            <label for="propername" class="col-sm-3 control-label">Judul Proyek Perubahan</label>
                            <div class="col-sm-9">
                                <input type="text" id="propername" name="propername" class="form-control{{ $errors->has('propername') ? ' is-invalid' : '' }}" aria-describedby="helpBlock1" placeholder="Judul Proyek Perubahan" value="{{ $participant->propername }}" required>
                                <span class="fa fa-file-o form-control-feedback"></span>
                                @if($errors->has('propername'))
                                    <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('propername') }}</strong></span> 
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="properplan" class="col-sm-3 control-label">Upload Laporan Rancangan Proyek Perubahan / Rancangan Aktualisasi</label>
                            <div class="col-sm-9">
                                <input type="file" id="properplan" name="properplan" accept="application/pdf">
                                <p>{{ $participant->properplan }}</p>
                                <span class="fa fa-file-o form-control-feedback"></span>
                                @if($errors->has('properplan'))
                                    <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('properplan') }}</strong></span> 
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="properabstract" class="col-sm-3 control-label">Upload Abstrak File/Softcopy Proyek Perubahan</label>
                            <div class="col-sm-9">
                                <input type="file" id="properabstract" name="properabstract" accept="application/pdf">
                                <p>{{ $participant->properabstract }}</p>
                                <span class="fa fa-file-o form-control-feedback"></span>
                                @if($errors->has('properabstract'))
                                    <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('properabstract') }}</strong></span> 
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="properdocs" class="col-sm-3 control-label">Upload Softcopy Proyek Perubahan</label>
                            <div class="col-sm-9">
                                <input type="file" id="properdocs" name="properdocs" accept="application/pdf">
                                <p>{{ $participant->properdocs }}</p>
                                <span class="fa fa-file-o form-control-feedback"></span>
                                @if($errors->has('properdocs'))
                                    <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('properdocs') }}</strong></span> 
                                @endif
                            </div>
                        </div>
                    
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-send"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
