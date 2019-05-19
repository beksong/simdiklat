@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mata Diklat</li>
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
        @permission('create-subjects')
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah/Ubah Data Mata Diklat</h3>
                </div>
                <!-- form profile -->
                <form action="{{ url('matadiklat') }}" method="post">
                    @csrf

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Nama Mata Diklat</label>

                            <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" aria-describedby="helpBlock1" placeholder="Nama Mata Diklat ex: wawasan kebangsaan,anti korupsi..." autofocus required>
                            <span class="fa fa-files form-control-feedback"></span>
                            @if($errors->has('name'))
                                <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('name') }}</strong></span> 
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
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Mata Diklat</h3>
                </div>
                <div class="box-body">
                    <table id="tb-subjects" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mata Diklat</th>
                                <th>action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- subject modal -->
<div class="modal modal-warning fade" id="edit_sub" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalLabel">Update Data Mata Diklat</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_sub">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Nama Mata Diklat</label>
                            <input type="hidden" id="subject_id" name="subject_id">
                            <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" aria-describedby="helpBlock1" placeholder="Nama Mata Diklat ex. wawasan kebangsaan, anti korupsi..." autofocus required>
                            <span class="fa fa-files form-control-feedback"></span>
                            @if($errors->has('name'))
                                <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('name') }}</strong></span> 
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

<!-- modal delete -->
<div class="modal modal-danger fade" id="del_sub">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Hapus Data</h4>
            </div>
            <div class="modal-body">
            <p>Yakin Akan Menghapus Data Mata Diklat?</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <form method="post">
                    @csrf
                    {{ method_field('DELETE')}}
                    <input type="hidden" id="subject_id" name="subject_id">
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
$(function () {
    $('#tb-subjects').DataTable({
      processing: true,
      serverSide: true,
      paging      : true,
      lengthChange: false,
      searching   : true,
      ordering    : true,
      info        : true,
      autoWidth   : false,
      ajax: {
          url         : '{!! route('getsubjects') !!}',
          dataType    : 'json',
      },
      fnCreatedRow: function (row, data, index) {
            $('td', row).eq(0).html(index + 1);
        },
      'columns' : [
          { data : null, 'sortable' : false},
          { data : 'name'},
          { data : 'action','orderable' : false, 'searchable' : false},
      ],
    });
    // edit modal
    $('#edit_sub').on('show.bs.modal',function(e){
        var modal = $(this);
        var link = $(e.relatedTarget);

        modal.find('.modal-body #name').val(link.data('sub_name'));
        modal.find('.modal-body #subject_id').val(link.data('id'));
    });
    // delete modal
    $('#del_sub').on('show.bs.modal',function(e){
        var modal = $(this);
        var link = $(e.relatedTarget);

        modal.find('.modal-footer #subject_id').val(link.data('id'));
    });
});
</script>
@endpush