@extends('layouts.reportnoheader')
@section('content')
<style>
.report-wrapper{
    margin-top : 50px;
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
            <h4 class="header">Jadwal {{ $mschedule->nameschedulemaster}}</h4>
            <h4 class="header"> {{ $mschedule->training->name }} </h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="report-wrapper">
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Tanggal</td>
                        <td>Jam</td>
                        <td>Materi Pembelajaran</td>
                        <td>Jumlah JP</td>
                        <td>Fasilitator/Narasumber</td>
                        <td>Sesi</td>
                        <td>Keterangan</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mschedule->detailschedules as $key => $schedule )
                        @if($schedule->sessionschedule=='1')
                            <tr align="center">
                                <td colspan="8">
                                    <b>Agenda Pembelajaran Tanggal : {{ \Carbon\Carbon::parse($schedule->dateschedule)->format('d-m-Y') }} </b>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->dateschedule)->format('d-m-Y') }}</td>
                            <td>{{ $schedule->timeschedule }}</td>
                            <td>{{ $schedule->subject->name}}</td>
                            <td>{{ $schedule->jp }}</td>
                            <td>{{ $schedule->user->name }}</td>
                            <td>Sesi Ke-{{ $schedule->sessionschedule }}</td>
                            <td>{{ $schedule->description }}</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="8">
                                <b>Break</b>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection