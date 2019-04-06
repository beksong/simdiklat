@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Widyaiswara</li>
        <li class="active">My schedule</li>
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

    <!-- table row -->
    <div class="row">
        <!-- right side -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Jadwal Mengajar {{ \Auth::user()->name }}</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-trainings" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Diklat</th>
                                <th>Nama Materi</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>JP</th>
                                <th>Sesi Ke</th>
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
        $('#tb-trainings').DataTable({
            processing: true,
            serverSide: true,
            paging      : true,
            lengthChange: true,
            searching   : true,
            ordering    : true,
            info        : true,
            autoWidth   : true,
            ajax : {
                url : '{!! route('getmyscheduledetails') !!}',
                dataType : 'json'
            },
            fnCreatedRow: function (row, data, index) {
                $('td', row).eq(0).html(index + 1);
            },
            columns : [
                { data : null, sortable : false},
                { data : "masterschedule.training.name",name : 'masaterschedule.training.name'},
                { data : "subject.name",name : 'subject.name'},
                { data : "dateschedule",name : 'dateschedule'},
                { data : "timeschedule",name : 'timeschedule'},
                { data : "jp",name : 'jp'},
                { data : "sessionschedule",name : 'sessionschedule'}
                // { data : "schedule",name :"schedule", orderable : false, searchable : false}
            ],
        });
    });
</script>
@endpush