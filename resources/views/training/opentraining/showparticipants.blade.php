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
        <li>Diklat yang sedang dibuka</li>
        <li class="active">Daftar Peserta</li>
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
                    <h3 class="box-title">Data peserta yang telah melakukan registrasi pada {{ $training->name }}</h3>
                    <h4>Tanggal Mulai Diklat : {{ $training->start_date }}</h4>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-openedregistration" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nip</th>
                                <th>Nama Lengkap</th>
                                <th>Telp/Email</th>
                                <th>Pangkat/Gol</th>
                                <th>Jabatan</th>
                                <th>Unit Kerja/Sub unit kerja</th>
                                <th>Alamat Kantor</th>
                                <th>Telepon Kantor</th>
                                <th>Persyaratan</th>
                                <th>Judul Proyek Perubahan/Aktualisasi</th>
                                <th>Rancangan Proyek Perubahan / Rancangan Aktualisasi</th>
                                <th>Abstract Proyek Perubahan/Aktualisasi</th>
                                <th>File Proyek Perubahan/Aktualisasi</th>
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
<div class="modal modal-warning fade"  id="edit_participant" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalLabel">Ubah data diklat peserta</h4>
            </div>
            <div class="modal-body">
            <form action="{{ route('updateparticipantbyadmin') }}" method="post">
                    @csrf
                    {{ method_field('PUT')}}
                    
                    <input type="hidden" id="participant_id" name="participant_id">

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="training_id" class="control-label">Nama Diklat</label>
                            <select class="form-control select2"  id="training_id" name="training_id" style="width: 100%;" required>
                            
                            </select>
                            <span class="fa fa-undo form-control-feedback"></span>
                            @if($errors->has('training_id'))
                                <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('training_id') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="nip" class="control-label">Nip Peserta diklat</label>
                            <input type="text" class="form-control" id="nip" name="nip" readonly>
                            <span class="fa fa-file-o form-control-feedback"></span>
                            @if($errors->has('nip'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('nip') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Nama peserta diklat</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" readonly>
                            <span class="fa fa-file-o form-control-feedback"></span>
                            @if($errors->has('fullname'))
                                <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('fullname') }}</strong></span> 
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
<div class="modal modal-danger fade" id="del_participant">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Hapus Data</h4>
            </div>
            <div class="modal-body">
            <p>Yakin Akan Menghapus Peserta?</p>
            <p>PERHATIAN !! :Menghapus peserta akan mengakibatkan peserta harus melakukan registrasi ulang</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <form method="post" action="{{ route('deleteparticipantbyadmin') }}">
                    @csrf
                    {{ method_field('DELETE')}}
                    <input type="hidden" id="participant_id" name="participant_id">
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
        $('#training_id').select2({});
    });
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
                url : '{!! route('getalreadyregisteredparticipants') !!}',
                dataType : 'json',
                data : {q: '{!! $training->id !!}'}
            },
            fnCreatedRow: function (row, data, index) {
                $('td', row).eq(0).html(index + 1);
            },
            columns : [
                { data : null, sortable : false},
                { data : "user.nip",name : 'user.nip'},
                { data : "fullname",name : 'fullname'},
                { data : "user.email",name : 'user.email'},
                { data : "rank",name : 'end_date'},
                { data : "position",name: 'position'},
                { data : "institution",name: 'institution'},
                { data : "institution_address",name: 'institution_address'},
                { data : "institution_phone",name: 'institution_phone'},
                { data : "requirementsdocs",name: 'requirementsdocs'},
                { data : "propername",name: 'propername'},
                { data : "properplan",name: 'properplan'},
                { data : "abstractfile",name: 'abstractfile'},
                { data : "docsfile",name: 'docsfile'},
                { data : "action",name : "action",orderable : false, searchable : false},
            ]
        });
    });

    $('#edit_participant').on('show.bs.modal',function(e){
        modal=$(this);
        link=$(e.relatedTarget);
        modal.find('.modal-body #fullname').val(link.data('fullname'));
        modal.find('.modal-body #nip').val(link.data('nip'));
        modal.find('.modal-body #participant_id').val(link.data('id'));
        modal.find('.modal-body #training_id').empty();
        modal.find('.modal-body #training_id').append('<option value="'+link.data('training_id')+'" selected>'+link.data('training_name')+'</option>');
        modal.find('.modal-body #training_id').select2({
            minimumInputLength : 4,
            ajax: {
                delay : 250,
                dataType : "json",
                url : '{!! route('gettraininglist') !!}',
                data : function(params){
                    return {
                        q : $.trim(params.term)
                    };
                },
                processResults : function(data){
                    return {
                        results : $.map(data,function(training){
                            return {
                                text : training.name+' Tanggal Mulai : '+training.start_date,
                                id : training.id
                            }
                        })
                    };
                },
                cache: true
            },
        });
    });

    $('#del_participant').on('show.bs.modal',function(e){
        modal = $(this);
        link = $(e.relatedTarget);

        modal.find('.modal-footer #participant_id').val(link.data('id'));
    });
    
</script>
@endpush