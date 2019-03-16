@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Jadwal Diklat / Schedule</li>
        <li class="active">Master Jadwal {{$training->name}}</li>
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
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Data Master Jadwal Diklat</h3>
                </div>
                <!-- form master schedule -->
                <form action="{{ route('schedules') }}" method="post">
                    @csrf
                    <input type="hidden" value="{{ $training->id }}" name="training_id">
                    
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="typeschedule" class="control-label">Jenis Jadwal</label>

                            <select class="form-control"  id="typeschedule" name="typeschedule" required>
                                <option value="">--Pilih Jenis / Tipe Jadwal --</option>
                                <option value="On_Class"> On Class </option>
                                <option value="Off_Class"> Off Class </option>
                                <option value="Benchmarking"> Benchmarking </option>
                            </select>
                            @if($errors->has('typeschedule'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('typeschedule') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="nameschedule" class="control-label">Nama Jadwal</label>

                            <input type="text" id="nameschedule" name="nameschedule" class="form-control{{ $errors->has('nameschedule') ? ' is-invalid' : '' }}" aria-describedby="helpBlock1" placeholder="Nama Jadwal isikan dengan ex. On Class 1, Off Class 1, On Class 2... " required>
                            
                            @if($errors->has('user_id'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('user_id') }}</strong></span> 
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
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Jadwal {{ $training->name }}</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-masterschedules" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Jadwal</th>
                                <th>Nama Jadwal</th>
                                <th>Nama Diklat</th>
                                <th>Detail Jadwal</th>
                                <th>Cetak Jadwal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- editmastermodal -->
<div class="modal modal-warning fade" id="edit_masterschedule" role="dialog" aria-labelledby="modalLabel" style="overflow:hidden;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalLabel">Update Data Master Jadwal</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('schedules') }}" method="post">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="hidden" value="{{ $training->id }}" name="training_id">
                    <input type="hidden" id="masterschedule_id" name="masterschedule_id">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="typeschedule" class="control-label">Jenis Jadwal</label>

                            <select class="form-control"  id="typeschedule" name="typeschedule" required>
                                <option value="">--Pilih Jenis / Tipe Jadwal --</option>
                                <option value="On Class"> On Class </option>
                                <option value="Off Class"> Off Class </option>
                                <option value="Benchmarking"> Benchmarking </option>
                            </select>
                            @if($errors->has('typeschedule'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('typeschedule') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="nameschedule" class="control-label">Nama Jadwal</label>

                            <input type="text" id="nameschedule" name="nameschedule" class="form-control{{ $errors->has('nameschedule') ? ' is-invalid' : '' }}" aria-describedby="helpBlock1" placeholder="Nama Jadwal isikan dengan ex. On Class 1, Off Class 1, On Class 2... " required>
                            
                            @if($errors->has('user_id'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('user_id') }}</strong></span> 
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
<!-- modal delete masterschedule -->
<div class="modal modal-danger fade" id="del_masterschedule">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Hapus Data Master Jadwal</h4>
            </div>
            <div class="modal-body">
            <p>Yakin Akan Menghapus Data Master Jadwal?</p>
            <p>PERHATIAN !!! Menghapus data akan master jadwal, akan menghapus detail jadwal terkait</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <form method="post" action="{{ route('schedules') }}">
                @csrf
                {{ method_field('DELETE')}}
                <input type="hidden" id="masterschedule_id" name="masterschedule_id">
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
    // datatables
    $('#tb-masterschedules').DataTable({
        processing: true,
        serverSide: true,
        paging      : true,
        lengthChange: true,
        searching   : true,
        ordering    : true,
        info        : true,
        autoWidth   : true,
        ajax : {
            type : 'GET',
            url : '{!! route('getschedules') !!}',
            dataType : 'json',
            data : {q: '{!! $training->id !!}'}
        },
        fnCreatedRow: function (row, data, index) {
            $('td', row).eq(0).html(index + 1);
        },
        columns : [
            { data : null, sortable : false},
            { data : "type",name : 'type'},
            { data : "nameschedulemaster",name : 'nameschedulemaster'},
            { data : "training.name",name : 'training.name'},
            { data : "detail", name: "detail", orderable: false, searchable: false},
            { data : "print", name: "print", orderable: false, searchable: false},
            { data : "action",name : "action",orderable : false, searchable : false},
        ],
    });
});

$('#edit_masterschedule').on('show.bs.modal',function(e){
    modal = $(this);
    link = $(e.relatedTarget);

    modal.find('.modal-body #typeschedule').val(link.data('mastertype'));
    modal.find('.modal-body #nameschedule').val(link.data('mastername'));
    modal.find('.modal-body #masterschedule_id').val(link.data('masterschedule_id'));
});

$('#del_masterschedule').on('show.bs.modal',function(e){
    modal = $(this);
    link = $(e.relatedTarget);

    modal.find('.modal-footer #masterschedule_id').val(link.data('masterschedule_id'));
});
</script>
@endpush