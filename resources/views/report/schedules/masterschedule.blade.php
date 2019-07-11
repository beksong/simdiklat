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
                        <td>Jam</td>
                        <td>Materi</td>
                        <td>Jumlah JP</td>
                        <td>Sesi</td>
                        <td>Fasilitator/Narasumber</td>
                        <td>Keterangan</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($training->masterschedules as $key=>$mschedule)
                        <tr>
                            <td colspan="8"><center>{{ $mschedule->nameschedulemaster }}</center></td>
                        </tr>
                        @foreach($mschedule->printedschedules as $key => $schedule )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ Carbon\Carbon::parse($schedule->dateschedule)->format('d-m-Y') }}</td>
                                <td>{{ $schedule->timeschedule }}</td>
                                <td>{{ $schedule->subject }}</td>
                                <td>{{ $schedule->jp }}</td>
                                <td>{{ $schedule->sessionschedule }}</td>
                                <td>{{ $schedule->speaker }}</td>
                                <td>{{ $schedule->description }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection