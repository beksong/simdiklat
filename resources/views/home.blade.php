@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-danger box-solid">
                <!-- box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">Selamat Datang {{ Auth::User()->name }}</h3>
                    <!-- box control -->
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- box body -->
                <div class="box-body">

                    @if(session('status'))
                        {{ session('status') }}
                    @endif
                    
                    Jangan Lupa untuk melengkapi profil anda pada menu <a href="{{ route('profile') }}">Profile</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-info box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Pelatihan yang akan dilaksanakan</h3>
                    <p>Silahkan klik daftar untuk mendaftar dan klik cetak untuk mencetak formulir pendaftaran ( setelah melakukan pendaftaran )</p>
                </div>
                <div class="box-body table-responsive">
                    <!-- table right here -->
                    <table class="table table-bordered" id="tb-registration">
                        <thead>
                            <tr>
                                <td>No.</td>
                                <td>Nama Diklat</td>
                                <td>Tanggal Mulai</td>
                                <td>Persyaratan/Keterangan</td>
                                <td>Daftar/Cetak</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <a href="" class="btn btn-primary"><i class="fa fa-btn fa-pencil"></i></a> -->
@endsection
@push('jscript')
<script>
$(document).ready(function(){
    $('#tb-registration').DataTable({
        processing : true,
        serverside : true,
        paging      : true,
        lengthChange: false,
        searching   : true,
        ordering    : true,
        info        : true,
        autoWidth   : false,
        ajax : {
            url : '{!! route('getopenregistration') !!}',
            dataType : 'json'
        },
        fnCreatedRow: function (row, data, index) {
            $('td', row).eq(0).html(index + 1);
        },
        columns : [
            { data : null, sortable : false},
            { data : "name",name : 'name'},
            { data : "start_date",name : 'start_date'},
            { data : "description",name : 'description'},
            { data : "action",name : "action",orderable : false, searchable : false},
        ],
    });
});
</script>
@endpush
