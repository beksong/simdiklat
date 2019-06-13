@extends('layouts.reportheader')
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
            <h4 class="header">Absensi Peserta {{ $training->name }}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="report-wrapper">
        <p>Tanggal : {{\Carbon\Carbon::now()->format('d-m-Y')}}</p>
       <div>
           <table class="table table-bordered">
               <thead>
                   <tr>
                       <td class="col-xs-1">No.</td>
                       <td class="col-xs-4">Nama Peserta/NIP</td>
                       <td class="col-xs-4">Instansi Asal</td>
                       <td class="col-xs-3">Tanda Tangan</td>
                   </tr>
               </thead>
               <tbody>
                   @foreach($participants as $key=>$p)
                        <tr>
                            <td style="height:50px;">{{ $key+1 }}.</td>
                            <td style="height:50px;">{{ $p->fullname }} <br>NIP : {{ $p->user->nip }}</td>
                            <td style="height:50px;">{{ $p->institution }}</td>
                            @if(($key+1)%2==0)
                                <td style="height:50px;"><center>{{ $key+1 }}.</center></td>
                            @else
                                <td style="height:50px;">{{ $key+1 }}.</td>
                            @endif
                        </tr>
                   @endforeach
               </tbody>
           </table>
       </div>
    </div>
</div>
@endsection