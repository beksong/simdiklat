@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">PIC Lembaga Diklat</li>
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
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah/Ubah Data PIC Aplikasi Simdiklat di Provinsi/ Kabupaten/ Kota</h3>
                </div>
                <!-- form profile -->
                <form action="{{ route('pic') }}" method="post">
                    @csrf

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">User</label>
                            <select class="form-control select2"  id="name" name="name" style="width: 100%;" required>
                            
                            </select>
                            <span class="fa fa-users form-control-feedback"></span>
                            @if($errors->has('name'))
                                <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('name') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="institution_name" class="control-label">Lembaga Diklat/BKD/Kab/Kota</label>

                            <select class="form-control select2"  id="institution_name" name="institution_name" style="width: 100%;" required>
                            
                            </select>
                            <span class="fa fa-university form-control-feedback"></span>
                            @if($errors->has('name'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('institution_name') }}</strong></span> 
                            @endif
                        </div>
                    </div>
                    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
                
            </div>
        </div>
        <!-- right side -->
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">PIC Lembaga Diklat/BKD/Kabupaten/Kota</h3>
                </div>
                <div class="box-body">
                    <table id="tb-pic" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lembaga</th>
                                <th>Nama PIC</th>
                                <th>action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- edit_pic -->
<div class="modal modal-warning fade" id="edit_pic" role="dialog" aria-labelledby="modalLabel" style="overflow:hidden;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalLabel">Update Data PIC Lembaga Diklat</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_pic_modal" action ="{{url('pic')}}">
                    @csrf
                    {{ method_field("PUT") }}
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">User</label>
                            <select class="form-control select2"  id="user_id" name="user_id" style="width: 100%;" required>
                            
                            </select>
                            <span class="fa fa-users form-control-feedback"></span>
                            @if($errors->has('user_id'))
                                <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('user_id') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="institution_id" class="control-label">Lembaga Diklat/BKD/Kab/Kota</label>

                            <select class="form-control select2"  id="institution_id" name="institution_id" style="width: 100%;" required>
                            
                            </select>
                            <span class="fa fa-university form-control-feedback"></span>
                            @if($errors->has('institution_id'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('institution_id') }}</strong></span> 
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
<!-- del_pic -->
<!-- modal delete -->
<div class="modal modal-danger fade" id="del_pic">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Hapus Data</h4>
            </div>
            <div class="modal-body">
            <p>Yakin Akan Menghapus Data lembaga?</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <form method="post" id="frm_delete_pic">
                    @csrf
                    {{ method_field('DELETE')}}
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
    $(document).ready(function(){
        
        $('#name').select2({
            placeholder : "Ketikkan nama user : ex. jhon, budi, andi irawati",
            minimumInputLength : 4,
            ajax: {
                delay : 250,
                dataType : "json",
                url : "../../getuser",
                data : function(params){
                    return {
                        q : $.trim(params.term)
                    };
                },
                processResults : function(data){
                    return {
                        results : $.map(data,function(user){
                            return {
                                text : user.name,
                                id : user.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        // end select2 name
        $('#institution_name').select2({
            placeholder : "Ketikkan nama lembaga diklat : ex. Badan pengembangan....",
            minimumInputLength : 4,
            ajax : {
                delay : 250,
                dataType : "json",
                url : "../../getlikeinstitution",
                data : function(params){
                    return {
                        q : $.trim(params.term)
                    };
                },
                processResults : function(data){
                    return {
                        results : $.map(data,function(institution){
                            return {
                                text : institution.name,
                                slug : institution.slug,
                                id : institution.id
                            }
                        })
                    };
                },
                cache : true
            }
        });
        // end select2 institution name
    });
    // datatables
    $(function(){
        $('#tb-pic').DataTable({
            processing: true,
            serverSide: true,
            paging      : true,
            lengthChange: false,
            searching   : true,
            ordering    : true,
            info        : true,
            autoWidth   : false,
            ajax : {
                url : '{!! route('datatablespic') !!}',
                dataType : 'json'
            },
            fnCreatedRow: function (row, data, index) {
                $('td', row).eq(0).html(index + 1);
            },
            columns : [
                { data : null, sortable : false},
                { data : "user.name",name : 'user_id'},
                { data : "institution.name",name : 'institution_id'},
                { data : "action",name : "action",orderable : false, searchable : false},
            ],
        });

        // edit pic modal
        $('#edit_pic').on('show.bs.modal',function(e){
            var modal=$(this)
            var link=$(e.relatedTarget)

            modal.find('.modal-body #frm_pic_modal').attr('action','pic/'+link.data('pic'));
            modal.find('.modal-body #user_id').append('<option value="'+link.data('user_id')+'" seleected >'+link.data('username')+'</option>');
            modal.find('.modal-body #user_id').select2({
                minimumInputLength : 4,
                ajax: {
                    delay : 250,
                    dataType : "json",
                    url : "../../getuser",
                    data : function(params){
                        return {
                            q : $.trim(params.term)
                        };
                    },
                    processResults : function(data){
                        return {
                            results : $.map(data,function(user){
                                return {
                                    text : user.name,
                                    id : user.id
                                }
                            })
                        };
                    },
                    cache: true
                },
            });
            // institution
            modal.find('.modal-body #institution_id').append('<option value="'+link.data('institution_id')+'" seleected >'+link.data('institution_name')+'</option>');
            modal.find('.modal-body #institution_id').select2({
                minimumInputLength : 4,
                ajax : {
                    delay : 250,
                    dataType : "json",
                    url : "../../getlikeinstitution",
                    data : function(params){
                        return {
                            q : $.trim(params.term)
                        };
                    },
                    processResults : function(data){
                        return {
                            results : $.map(data,function(institution){
                                return {
                                    text : institution.name,
                                    slug : institution.slug,
                                    id : institution.id
                                }
                            })
                        };
                    },
                    cache : true
                }
            });
        });

        $('#del_pic').on('show.bs.modal',function(e){
            var modal = $(this)
            var link = $(e.relatedTarget)

            modal.find('.modal-footer #frm_delete_pic').attr('action','pic/'+link.data('pic'))
        });
    });
    
</script>
@endpush