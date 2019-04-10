@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Roles - Users </li>
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
        <!-- left side -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Roles Users Lists</h3>
                    <h4>Here is configuration between roles and users, consult your dev to modify or make any change, b'cause it could affect your apps  </h4>
                </div>
            </div>
        </div>
    </div>

    <!-- table row -->
    <div class="row">
        <!-- right side -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Roles users relationship table</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-roleusers" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Roles</th>
                                <th>Action</th>
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
    $(function(){
        var table = $('#tb-roleusers').DataTable({
            processing: true,
            serverSide: true,
            paging      : true,
            lengthChange: false,
            searching   : true,
            ordering    : true,
            info        : true,
            autoWidth   : false,
            ajax : {
                url : '{!! route('getuserroles') !!}',
                dataType : 'json'
            },
            fnCreatedRow: function (row, data, index) {
                $('td', row).eq(0).html(index + 1);
            },
            columns : [
                { data : null, sortable : false},
                { data : "name",name : 'name'},
                { data : "roles",name : "roles"},
                { data : "action",name : "action",orderable : false, searchable : false},
            ]
            // buttons: {
            //     buttons: [
            //     {
            //         text: "<i class='fa fa-plus'></i> New Role",
            //         action: function(e, dt, node, config) {
            //             $('#add_role').modal('show');
            //         }
            //     }],
            //     dom: {
            //         button: {
            //             tag: "button",
            //             className: "btn btn-success"
            //         },
            //         buttonLiner: {
            //             tag: null
            //         }
            //     }
            // },
            // dom: 'Bfrtip',
            // initcomplete : function(){
            //     buttons().container().appendTo($('#example_wrapper .col-sm-6:eq(0)'));
            // }
        });
    });
</script>
@endpush