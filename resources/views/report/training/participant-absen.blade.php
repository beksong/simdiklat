@extends('layouts.reportnoheader')
@section('content')
<style>
.report-body{
    padding-top:120px;
}
.report-wrapper{
    margin:20px;
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
<div class="report-body">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="header">
                <h4>Absensi Peserta {{ $training->name }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <p>Tanggal</p>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <p>:</p>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <p>Pemateri / Widyaiswara</p>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <p>:</p>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <p>Materi</p>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <p>:</p>
        </div>
    </div>
    <div class="row">
        <div class="report-wrapper">
        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td class="col-xs-1">No.</td>
                        <td class="col-xs-3">Nama Peserta/NIP</td>
                        <td class="col-xs-2">Pangkat/Golongan</td>
                        <td class="col-xs-3">Instansi Asal</td>
                        <td class="col-xs-3">Tanda Tangan</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($participants as $key=>$p)
                            <tr>
                                <td style="height:80px;">{{ $key+1 }}.</td>
                                <td style="height:80px;">{{ $p->fullname }} <br>NIP : {{ $p->user->nip }}</td>
                                <td style="height:80px;">{{ $p->rank }}</td>
                                <td style="height:80px;">{{ $p->unit_institution }} pada {{ $p->institution }}</td>
                                @if(($key+1)%2==0)
                                    <td style="height:80px;"><center>{{ $key+1 }}.</center></td>
                                @else
                                    <td style="height:80px;">{{ $key+1 }}.</td>
                                @endif
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
@endsection