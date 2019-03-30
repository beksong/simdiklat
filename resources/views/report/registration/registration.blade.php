@extends('layouts.reportnoheader')
@section('content')
<style>
.report-wrapper{
    margin: 30px;
}
.header{
    text-align : center
}
.ishoma{
    text-align :center
}
.spacing{
    margin-top:20px;
}
</style>

<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="report-wrapper">
            <h4 class="header">BIODATA PESERTA</h4>
            <h4 class="header"> {{ $participant->training->name }} </h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="report-wrapper">
        <div class="col-sm-4 spacing">Nama Lengkap</div>
        <div class="col-sm-8 spacing">: {{ $participant->frontdegree }} {{ $participant->fullname }},{{ $participant->backdegree }}</div>
        <div class="col-sm-4 spacing">Tempat / Tanggal Lahir</div>
        <div class="col-sm-8 spacing">: {{ $participant->user->place_birth }}, {{ $participant->user->date_birth }}</div>
        <div class="col-sm-4 spacing">Nip</div>
        <div class="col-sm-8 spacing">: {{ $participant->user->nip }}</div>
        <div class="col-sm-4 spacing">Pangkat, Golongan/Ruang</div>
        <div class="col-sm-8 spacing">: {{ $participant->rank }}</div>
        <div class="col-sm-4 spacing">No. Telepon/HP</div>
        <div class="col-sm-8 spacing">: {{ $participant->phone }}</div>
        <div class="col-sm-4 spacing">Email</div>
        <div class="col-sm-8 spacing">: {{ $participant->user->email }}</div>
        <div class="col-sm-4 spacing">Alamat Rumah</div>
        <div class="col-sm-8 spacing">: {{ $participant->user->address }}</div>
        <div class="col-sm-4 spacing">Jabatan</div>
        <div class="col-sm-8 spacing">: {{ $participant->position }}</div>
        <div class="col-sm-4 spacing">Instansi</div>
        <div class="col-sm-8 spacing">: {{ $participant->institution }}</div>
        <div class="col-sm-4 spacing">Alamat Kantor</div>
        <div class="col-sm-8 spacing">: {{ $participant->institution_address }}</div>
        <div class="col-sm-4 spacing">Telepon Kantor</div>
        <div class="col-sm-8 spacing">: {{ $participant->institution_phone }}</div>
    </div>
</div>
<div class="row">
    <div class="report-wrapper">
        <div class="col-sm-6 spacing">
            <img src="{{ asset('storage/profile/'.\Auth::user()->photo)}}" alt="" style="width:150px; height:220px;">
        </div>
        <div class="col-sm-6 spacing" style="text-align:center;">
            Palu, {{\Carbon\Carbon::now()->format('d-m-Y') }}
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            {{ $participant->frontdegree}}. {{$participant->fullname}},{{$participant->backdegree}}
        </div>
    </div>
</div>
@endsection