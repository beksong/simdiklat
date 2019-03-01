@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Lembaga</li>
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
                    <h3 class="box-title">Tambah/Ubah Data Penyelenggara</h3>
                </div>
                <!-- form profile -->
                <form action="{{ url('lembaga') }}" method="post">
                    @csrf

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Nama Lembaga</label>

                            <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" aria-describedby="helpBlock1" placeholder="Nama Lembaga Penyelenggara Diklat" autofocus required>
                            <span class="fa fa-university form-control-feedback"></span>
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
        <!-- right side -->
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Lembaga Penyelenggara Diklat Provinsi Sulawesi Tengah</h3>
                </div>
                <div class="box-body">
                    <table id="tb-lembaga" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lembaga</th>
                                <th>action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- edit_lembaga -->
<div class="modal modal-warning fade" id="edit_lembaga" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalLabel">Update Data Lembaga</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_lembaga">
                    @csrf
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Nama Lembaga</label>

                            <input type="text" id="lembaga" name="lembaga" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" aria-describedby="helpBlock1" placeholder="Nama Lembaga Penyelenggara Diklat" autofocus required>
                            <span class="fa fa-university form-control-feedback"></span>
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
<div class="modal modal-danger fade" id="del_lembaga">
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
            <form method="post" id="frm_delete_lembaga">
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
<!-- /.modal -->
@endsection

@push('jscript')
<script>
$(function () {
    $('#tb-lembaga').DataTable({
      processing: true,
      serverSide: true,
      paging      : true,
      lengthChange: false,
      searching   : true,
      ordering    : true,
      info        : true,
      autoWidth   : false,
      ajax: {
          url         : '{!! route('datatableinstitutions') !!}',
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
     // datatable
     $('#edit_lembaga').on('show.bs.modal',function(e){
        var modal=$(this)
        var button=$(e.relatedTarget)

        modal.find('.modal-body #lembaga').val(button.data('lembaga'))
        modal.find('.modal-body #frm_lembaga').attr('action','lembaga/'+button.data('slug'))
    });

    $('#del_lembaga').on('show.bs.modal',function(e){
        var modal=$(this)
        var button=$(e.relatedTarget)

        modal.find('.modal-footer #frm_delete_lembaga').attr('action','lembaga/'+button.data('slug'))
    });
});
</script>
@endpush