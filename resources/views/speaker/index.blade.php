@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Speaker/Widyaiswara</li>
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
        @permission('create-speakers')
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah/Ubah Data Pembicara/Widyaiswara/Pengampu Mata Diklat</h3>
                </div>
                <!-- form profile -->
                <form action="{{ route('speakers') }}" method="post">
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
                            <label for="subject_name" class="control-label">Mata Diklat Yang Diampu/Dibawakan</label>

                            <select class="form-control select2"  id="subject_name" name="subject_name" style="width: 100%;" required>
                            
                            </select>
                            <span class="fa fa-file form-control-feedback"></span>
                            @if($errors->has('subject_name'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('subject_name') }}</strong></span> 
                            @endif
                        </div>
                    </div>
                    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
                
            </div>
        </div>
        @endpermission
        <!-- right side -->
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Pembicara / Pemateri / Pengampu mata diklat</h3>
                </div>
                <div class="box-body">
                    <table id="tb-speaker" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pembicara/Pemateri</th>
                                <th>Mata Diklat Yang Diampu</th>
                                <th>action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- edit_speaker -->
<div class="modal modal-warning fade" id="edit_speaker" role="dialog" aria-labelledby="modalLabel" style="overflow:hidden;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalLabel">Update data Pemateri/Widyaiswara/Pengampu/Pembicara Mata Diklat</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_speaker_modal" action ="{{ route('speakers') }}">
                    @csrf
                    {{ method_field("PUT") }}
                    <input type="hidden" id="speaker_id" name="speaker_id">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Pemateri/Pembicara/Widyaiswara</label>
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
                            <label for="subject_id" class="control-label">Mata Diklat Yang Diampu/Dibawakan</label>

                            <select class="form-control select2"  id="subject_id" name="subject_id" style="width: 100%;" required>
                            
                            </select>
                            <span class="fa fa-file form-control-feedback"></span>
                            @if($errors->has('subject_id'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('subject_id') }}</strong></span> 
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
<!-- del_speaker -->
<!-- modal delete -->
<div class="modal modal-danger fade" id="del_speaker">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Hapus Data</h4>
            </div>
            <div class="modal-body">
            <p>Yakin Akan Menghapus Data Pemateri/Pembicara/Pengampu Mata Diklat?</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <form method="post" action="{{ route('speakers') }}">
                    @csrf
                    {{ method_field('DELETE')}}
                    <input type="hidden" id="speaker_id" name="speaker_id">
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
        $('#subject_name').select2({
            placeholder : "Ketikkan nama mata diklat : ex. wawasan kebangsaan,anti korupsi...",
            minimumInputLength : 4,
            ajax : {
                delay : 250,
                dataType : "json",
                url : "{!! route('getlikesubject') !!}",
                data : function(params){
                    return {
                        q : $.trim(params.term)
                    };
                },
                processResults : function(data){
                    return {
                        results : $.map(data,function(subject){
                            return {
                                text : subject.name,
                                slug : subject.slug,
                                id : subject.id
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
        $('#tb-speaker').DataTable({
            processing: true,
            serverSide: true,
            paging      : true,
            lengthChange: false,
            searching   : true,
            ordering    : true,
            info        : true,
            autoWidth   : false,
            ajax : {
                url : '{!! route('getspeakers') !!}',
                dataType : 'json'
            },
            fnCreatedRow: function (row, data, index) {
                $('td', row).eq(0).html(index + 1);
            },
            columns : [
                { data : null, sortable : false},
                { data : "user.name",name : 'user.name'},
                { data : "subject.name",name : 'subject.name'},
                { data : "action",name : "action",orderable : false, searchable : false},
            ],
        });

        // edit pic modal
        $('#edit_speaker').on('show.bs.modal',function(e){
            var modal=$(this)
            var link=$(e.relatedTarget)

            modal.find('.modal-body #speaker_id').val(link.data('id'));
            //modal.find('.modal-body #subject_id').append('<option value="'+link.data('subject_id')+'" selected>'+link.data('subject_name')+'</option>');
            modal.find('.modal-body #user_id').append('<option value="'+link.data('speaker_id')+'" selected >'+link.data('speaker_name')+'</option>');
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
            modal.find('.modal-body #subject_id').append('<option value="'+link.data('subject_id')+'" selected >'+link.data('subject_name')+'</option>');
            modal.find('.modal-body #subject_id').select2({
                minimumInputLength : 4,
                ajax : {
                    delay : 250,
                    dataType : "json",
                    url : '{!! route('getlikesubject') !!}',
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

        $('#del_speaker').on('show.bs.modal',function(e){
            var modal = $(this)
            var link = $(e.relatedTarget)

            modal.find('.modal-footer #speaker_id').val(link.data('speaker_id'));
        });
    });
    
</script>
@endpush