@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Diklat</li>
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
                    <h3 class="box-title">Tambah/Ubah Data Diklat</h3>
                </div>
                <!-- form diklat -->
                <form id="form_trainings" action="{{ route('trainings') }}" method="post">
                    @csrf

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Nama diklat</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="input nama diklat ex. diklat prajabatan,diklat kepemimpinan tingkat IV.." required autofocus>
                            <span class="fa fa-file-o form-control-feedback"></span>
                            @if($errors->has('name'))
                                <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('name') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="period" class="control-label">Lama Diklat</label>
                            <input type="number" min="1" class="form-control" id="period" name="period" placeholder="Lama pelaksanaan diklat dalam hari ex. 238, 365" required>
                            <span class="fa fa-hourglass form-control-feedback"></span>
                            @if($errors->has('period'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('period') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="start_date" class="control-label">Tanggal Mulai</label>
                            <input type="text" class="form-control" id="start_date" name="start_date" placeholder="tanggal mulai diklat" data-date-format='yyyy-mm-dd' required>
                            <span class="fa fa-calendar form-control-feedback"></span>
                            @if($errors->has('subject_name'))
                                <span id="helpBlock3" class="help-block"><strong>{{ $errors->first('subject_name') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="description" class="control-label">Keterangan</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="Keterangan lain yang diperlukan..."></textarea>
                            @if($errors->has('description'))
                                <span id="helpBlock4" class="help-block"><strong>{{ $errors->first('description') }}</strong></span> 
                            @endif
                        </div>
                    </div>
                    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

    <!-- table row -->
    <div class="row">
        <!-- right side -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Data semua diklat yang akan dan telah diselenggarakan</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-trainings" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Diklat</th>
                                <th>Tanggal Mulai</th>
                                <th>Lama Diklat (hari)</th>
                                <th>Tanggal Selesai</th>
                                <th>Penyelenggara</th>
                                <th>Keterangan</th>
                                <th>Buat Jadwal</th>
                                <th>action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- edit training -->
<div class="modal modal-warning fade"  id="edit_training" role="dialog" aria-labelledby="modalLabel"  style="overflow-x: auto;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalLabel">Update data diklat</h4>
            </div>
            <div class="modal-body">
            <form action="{{ route('trainings') }}" method="post">
                    @csrf
                    {{ method_field('PUT')}}
                    <input type="hidden" id="training_id" name="training_id">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Nama diklat</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="input nama diklat ex. diklat prajabatan,diklat kepemimpinan tingkat IV.." required autofocus>
                            <span class="fa fa-file-o form-control-feedback"></span>
                            @if($errors->has('name'))
                                <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('name') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="period" class="control-label">Lama Diklat</label>
                            <input type="number" min="1" class="form-control" id="period" name="period" placeholder="Lama pelaksanaan diklat dalam hari ex. 238, 365" required>
                            <span class="fa fa-hourglass form-control-feedback"></span>
                            @if($errors->has('period'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('period') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="start_date" class="control-label">Tanggal Mulai</label>
                            <input type="text" class="form-control" id="datepicker" name="start_date" data-date-format="yyyy-mm-dd">
                            <span class="fa fa-calendar form-control-feedback"></span>
                            @if($errors->has('start_date'))
                                <span id="helpBlock3" class="help-block"><strong>{{ $errors->first('start_date') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="description" class="control-label">Keterangan</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="Keterangan lain yang diperlukan..."></textarea>
                            @if($errors->has('description'))
                                <span id="helpBlock4" class="help-block"><strong>{{ $errors->first('description') }}</strong></span> 
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
<!-- del_training -->
<!-- modal delete -->
<div class="modal modal-danger fade" id="del_training">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Hapus Data</h4>
            </div>
            <div class="modal-body">
            <p>Yakin Akan Menghapus Data Diklat?</p>
            <p>PERHATIAN !! :Menghapus data diklat akan menghapus semua data peserta yang telah mendaftar diklat tersebut</p>
            <p>PERHATIAN !! :Menghapus data diklat akan menghapus materi diklat yang telah diupload</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <form method="post" action="{{ route('trainings') }}">
                    @csrf
                    {{ method_field('DELETE')}}
                    <input type="hidden" id="training_id" name="training_id">
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
        $('#start_date').datepicker({});
    });
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
                url : '{!! route('gettrainings') !!}',
                dataType : 'json'
            },
            fnCreatedRow: function (row, data, index) {
                $('td', row).eq(0).html(index + 1);
            },
            columns : [
                { data : null, sortable : false},
                { data : "name",name : 'name'},
                { data : "start_date",name : 'start_date'},
                { data : "period",name : 'period'},
                { data : "end_date",name : 'end_date'},
                { data : "pic.institution.name",name : 'pic.institution.name'},
                { data : "description",name : 'description'},
                { data : "schedule",name :"schedule", orderable : false, searchable : false},
                { data : "action",name : "action",orderable : false, searchable : false},
            ],
        });
    });

    $('#edit_training').on('show.bs.modal',function(e){
        modal=$(this);
        link=$(e.relatedTarget);
        modal.find('.modal-body #name').val(link.data('training_name'));
        modal.find('.modal-body #period').val(link.data('period'));
        modal.find('.modal-body #description').val(link.data('description'));
        modal.find('.modal-body #training_id').val(link.data('training'));
        modal.find('.modal-body #datepicker').val(link.data('start_date'));
        modal.find('.modal-body #datepicker').datepicker({
            autoclose: 1,
            forceParse: 0,
        })
        .on('show',function(evt){
            return false;
        });
    });

    $('#del_training').on('show.bs.modal',function(e){
        modal = $(this);
        link = $(e.relatedTarget);

        modal.find('.modal-footer #training_id').val(link.data('training'));
    });
    
</script>
@endpush