@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Permissions - Roles</li>
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
                    <h3 class="box-title">Permissions Roles Lists</h3>
                    <h4>Here is configuration between permission and roles, consult your dev to modify or make any change, b'cause it could affect your apps  </h4>
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
                    <h3 class="box-title">Permission and Roles relationship table</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-permissionroles" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Role Name</th>
                                <th>Assign Permission to Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- add_role -->
<div class="modal modal-success fade" id="add_role" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalLabel">Add new role</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_speaker_modal" action ="">
                    @csrf
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Role Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                            <span class="fa fa-users form-control-feedback"></span>
                            @if($errors->has('name'))
                                <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('name') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="display_name" class="control-label">Role Display Name</label>

                            <input type="text" id="display_name" name="display_name" required class="form-control">
                            <span class="fa fa-file form-control-feedback"></span>
                            @if($errors->has('display_name'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('display_name') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="description" class="control-label">Role Description</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="5"></textarea>
                            <span class="fa fa-file form-control-feedback"></span>
                            @if($errors->has('description'))
                                <span id="helpBlock3" class="help-block"><strong>{{ $errors->first('description') }}</strong></span> 
                            @endif
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline"> <i class="fa fa-save"></i> </button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- edit_role -->
<div class="modal modal-warning fade" id="edit_role" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalLabel">Change Role Data</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_speaker_modal" action ="{{ route('role') }}">
                    @csrf
                    {{ method_field("PUT") }}
                    <input type="hidden" id="role_id" name="role_id">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Role Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                            <span class="fa fa-users form-control-feedback"></span>
                            @if($errors->has('name'))
                                <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('name') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="display_name" class="control-label">Role Display Name</label>

                            <input type="text" id="display_name" name="display_name" required class="form-control">
                            <span class="fa fa-file form-control-feedback"></span>
                            @if($errors->has('display_name'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('display_name') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="description" class="control-label">Role Description</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
                            <span class="fa fa-file form-control-feedback"></span>
                            @if($errors->has('description'))
                                <span id="helpBlock3" class="help-block"><strong>{{ $errors->first('description') }}</strong></span> 
                            @endif
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline"> <i class="fa fa-save"></i> </button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- del_user -->
<!-- modal delete -->
<div class="modal modal-danger fade" id="del_role">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Hapus Data</h4>
            </div>
            <div class="modal-body">
            <p>Yakin Akan Menghapus Role?</p>
            <p>PERHATIAN !! :Menghapus Role akan menghilangkan permission dan role user</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <form method="post" action="">
                    @csrf
                    {{ method_field('DELETE')}}
                    <input type="hidden" id="role_id" name="role_id">
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
        var table = $('#tb-permissionroles').DataTable({
            processing: true,
            serverSide: true,
            paging      : true,
            lengthChange: false,
            searching   : true,
            ordering    : true,
            info        : true,
            autoWidth   : false,
            ajax : {
                url : '{!! route('getpermissionroles') !!}',
                dataType : 'json'
            },
            fnCreatedRow: function (row, data, index) {
                $('td', row).eq(0).html(index + 1);
            },
            columns : [
                { data : null, sortable : false},
                { data : "name",name : 'name'},
                { data : "permissions",name : "permissions"},
                { data : "action",name : "action",orderable : false, searchable : false},
            ],
            buttons: {
                buttons: [
                {
                    text: "<i class='fa fa-plus'></i> New Role",
                    action: function(e, dt, node, config) {
                        $('#add_role').modal('show');
                    }
                }],
                dom: {
                    button: {
                        tag: "button",
                        className: "btn btn-success"
                    },
                    buttonLiner: {
                        tag: null
                    }
                }
            },
            dom: 'Bfrtip',
            initcomplete : function(){
                buttons().container().appendTo($('#example_wrapper .col-sm-6:eq(0)'));
            }
        });
    });

    $('#edit_role').on('show.bs.modal',function(e){
        modal =$(this);
        link = $(e.relatedTarget);

        modal.find('.modal-body #role_id').val(link.data('role_id'));
        modal.find('.modal-body #name').val(link.data('role_name'));
        modal.find('.modal-body #display_name').val(link.data('role_display_name'));
        modal.find('.modal-body #description').val(link.data('role_description'));
    });

    $('#del_role').on('show.bs.modal',function(e){
        modal = $(this);
        link = $(e.relatedTarget);

        modal.find('.modal-footer #role_id').val(link.data('role'));
    });
    
</script>
@endpush