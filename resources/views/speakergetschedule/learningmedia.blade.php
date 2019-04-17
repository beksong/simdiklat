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
        <li class="active">Upload Administrasi Mengajar</li>
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
                    <h3 class="box-title">Upload Dokumen Administrasi Mengajar {{ \Auth::user()->name }}</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-trainings" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Diklat</th>
                                <th>Nama Materi</th>
                                <th>RPBMD</th>
                                <th>Bahan Ajar</th>
                                <th>Bahan Tayang</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Upload Dokumen -->
<div class="modal modal-warning fade"  id="teaching_administration" role="dialog" aria-labelledby="modalLabel"  style="overflow-x: auto;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalLabel">Update Dokumen Administrasi Mengajar</h4>
            </div>
            <div class="modal-body">
            <form action="{{ route('learningmedia') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="hidden" id="detailschedule_id" name="detailschedule_id">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Mata Diklat</label>
                            <input type="text" class="form-control" id="name" name="name" readonly>
                            <span class="fa fa-file-o form-control-feedback"></span>
                            @if($errors->has('name'))
                                <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('name') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="rpbmd" class="control-label">RPBMD</label>
                            <input type="file" id="rpbmd" name="rpbmd" accept="Application/pdf">
                            <span class="fa fa-file-o form-control-feedback"></span>
                            @if($errors->has('period'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('rpbmd') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="teaching_material" class="control-label">Bahan Ajar</label>
                            <input type="file" id="teaching_material" name="teaching_material" accept="Application/pdf">
                            <span class="fa fa-file-o form-control-feedback"></span>
                            @if($errors->has('period'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('teaching_material') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="airing_material" class="control-label">Bahan Tayang</label>
                            <input type="file" id="airing_material" name="airing_material" accept="Application/pdf">
                            <span class="fa fa-file-o form-control-feedback"></span>
                            @if($errors->has('period'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('airing_material') }}</strong></span> 
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
                url : '{!! route('getlearningmedia') !!}',
                dataType : 'json'
            },
            fnCreatedRow: function (row, data, index) {
                $('td', row).eq(0).html(index + 1);
            },
            columns : [
                { data : null, sortable : false},
                { data : "masterschedule.training.name",name : 'masaterschedule.training.name'},
                { data : "subject.name",name : 'subject.name'},
                { data : "rpbmd",name : 'rpbmd'},
                { data : "teaching_material",name : 'teaching_material'},
                { data : "airing_material",name : 'airing_material'},
                // { data : "sessionschedule",name : 'sessionschedule'}
                { data : "action",name :"action", orderable : false, searchable : false}
            ],
        });
    });

    $('#teaching_administration').on('show.bs.modal',function(e){
        modal = $(this);
        link = $(e.relatedTarget);

        modal.find('.modal-body #detailschedule_id').val(link.data('detailschedule_id'));
        modal.find('.modal-body #name').val(link.data('subject_name'));
    })
</script>
@endpush