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
                        <td>Materi</td>
                        <td>Pemateri/Widyaiswara</td>
                        <td>Jam</td>
                        <td>JP</td>
                        <td>Sesi</td>
                        <td>Keterangan</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mschedule->detailschedules as $key => $schedule )
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
                        @if($schedule->sessionschedule!='4')
                            <tr align="center">
                                <td colspan="8">
                                    Break
                                </td>
                            </tr>
                        @endif
                        @if($schedule->sessionschedule=='4')
                            <tr align="center">
                                <td colspan="8">
                                    {{ \Carbon\Carbon::parse($schedule->dateschedule)->format('d-m-Y') }}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection