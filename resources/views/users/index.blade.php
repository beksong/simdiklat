@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User Aplikasi</li>
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
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar User Aplikasi</h3>
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
                    <h3 class="box-title">Data User Aplikasi</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-users" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>nip</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>address</th>
                                <th>action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- del_user -->
<!-- modal delete -->
<div class="modal modal-danger fade" id="del_user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Hapus Data</h4>
            </div>
            <div class="modal-body">
            <p>Yakin Akan Menghapus Data User?</p>
            <p>PERHATIAN !! :Menghapus data user akan menghapus semua data yang terkait dengannya</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <form method="post" action="{{ route('user') }}">
                    @csrf
                    {{ method_field('DELETE')}}
                    <input type="hidden" id="user_id" name="user_id">
                    <button type="submit" class="btn btn-outline"> <i class="fa fa-btn fa-trash"></i> Hapus Data</button>
            </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@push('jscript')
<script>
    $(function(){
        $('#tb-users').DataTable({
            processing: true,
            serverSide: true,
            paging      : true,
            lengthChange: false,
            searching   : true,
            ordering    : true,
            info        : true,
            autoWidth   : false,
            ajax : {
                url : '{!! route('getusers') !!}',
                dataType : 'json'
            },
            fnCreatedRow: function (row, data, index) {
                $('td', row).eq(0).html(index + 1);
            },
            columns : [
                { data : null, sortable : false},
                { data : "nip",name : 'nip'},
                { data : "name",name : 'name'},
                { data : "email",name : 'email'},
                { data : "address",name : 'address'},
                { data : "action",name : "action",orderable : false, searchable : false},
            ],
        });
    });

    $('#del_user').on('show.bs.modal',function(e){
        modal = $(this);
        link = $(e.relatedTarget);

        modal.find('.modal-footer #user_id').val(link.data('user'));
    });
    
</script>
@endpush