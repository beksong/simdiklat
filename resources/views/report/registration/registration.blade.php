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
        <div class="col-sm-4">Nama Lengkapt</div>
        <div class="col-sm-8">: {{ $participant->frontdegree }} {{ $participant->fullname }},{{ $participant->backdegree }}</div>
        <div class="col-sm-4">Nama Lengkapt</div>
        <div class="col-sm-8">: {{ $participant->fullname }}</div>
    </div>
</div>
@endsection