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
            <h4 class="header">JADWAL PEMBELAJARAN {{ $training->name}}</h4>
            <center><h4>Tanggal {{ \Carbon\Carbon::parse($training->start_date)->format('d-m-Y') }} sampai dengan tanggal {{ \Carbon\Carbon::parse($training->end_date)->format('d-m-Y') }} </h4></center>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="report-wrapper">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Tanggal</td>
                        <td>Materi</td>
                        <td>Fasilitator/Narasumber</td>
                        <td>Jam</td>
                        <td>Jumlah JP</td>
                        <td>Sesi</td>
                        <td>Keterangan</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($training->masterschedules as $key=>$mschedule)
                        <tr>
                            <td colspan="8"><center>{{ $mschedule->nameschedulemaster }}</center></td>
                        </tr>
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
                                <td>{{ $schedule->subject->name}}</td>
                                <td>{{ $schedule->user->name }}</td>
                                <td>{{ $schedule->timeschedule }}</td>
                                <td>{{ $schedule->jp }}</td>
                                <td>Sesi Ke-{{ $schedule->sessionschedule }}</td>
                                <td>{{ $schedule->description }}</td>
                            </tr>
                            <tr>
                                <td align="center" colspan="8">
                                    <b>Break</b>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection