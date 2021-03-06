@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Management Peserta</li>
        <li class="active">Diklat yang pernah dibuka / yang lalu</li>
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

    <!-- table row -->
    <div class="row">
        <!-- right side -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Diklat yang pernah dibuka / yang lalu</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-openedregistration" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Diklat</th>
                                <th>Tanggal Mulai</th>
                                <th>Lama Diklat (hari)</th>
                                <th>Tanggal Selesai</th>
                                <th>Penyelenggara</th>
                                <th>Calon Peserta</th>
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
    // datatables
    $(function(){
        $('#tb-openedregistration').DataTable({
            processing: true,
            serverSide: true,
            paging      : true,
            lengthChange: false,
            searching   : true,
            ordering    : true,
            info        : true,
            autoWidth   : false,
            ajax : {
                url : '{!! route('getclosedtraininglist') !!}',
                dataType : 'json'
            },
            fnCreatedRow: function (row, data, index) {
                $('td', row).eq(0).html(index + 1);
            },
            columns : [
                { data : null, sortable : false},
                { data : "name",name : 'name'},
                { data : "startingdate",name : 'startingdate'},
                { data : "period",name : 'period'},
                { data : "enddate",name : 'enddate'},
                { data : "pic.institution.name",name: 'pic.institution.name'},
                { data : "participant",name : "participant",orderable : false, searchable : false},
            ],
        });
    });
</script>
@endpush