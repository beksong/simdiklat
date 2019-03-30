@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Training history</li>
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
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar pelatihan yang pernah saya ikuti</h3>
                </div>

                <div class="box-body table-responsive">
                    <!-- table right here -->
                    <table class="table table-bordered" id="tb-registration">
                        <thead>
                            <tr>
                                <td>No.</td>
                                <td>Nama Diklat</td>
                                <td>Tanggal Mulai</td>
                                <td>Tanggal Selesai</td>
                                <td>Abstract Proyek Perubahan</td>
                                <td>Proyek Perubahan</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
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
            url : '{!! route('getparticipanthistory') !!}',
            dataType : 'json'
        },
        fnCreatedRow: function (row, data, index) {
            $('td', row).eq(0).html(index + 1);
        },
        columns : [
            { data : null, sortable : false},
            { data : "name",name : 'name'},
            { data : "start_date",name : 'start_date'},
            { data : "end_date",name : 'end_date'},
            { data : "proper_abstract",name : 'proper_abstract'},
            { data : "proper_name",name : 'proper_name'},
        ],
    });
});
</script>
@endpush