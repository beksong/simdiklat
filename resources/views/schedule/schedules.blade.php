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
        <li>Master Jadwal {{ $mschedule->training->name }}</li>
        <li class="active">Detail Jadwal {{$mschedule->type}} / {{$mschedule->nameschedulemaster}}, {{$mschedule->training->name}}</li>
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
                    <h3 class="box-title">Tambah Data Jadwal Mengajar Widyaiswara</h3>
                </div>
                <!-- form profile -->
                <form action="{{ route('savedetailschedule') }}" method="post">
                    @csrf
                    <input type="hidden" value="{{ $mschedule->id }}" name="masterschedule_id" id="masterschedule_id">

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Tanggal</label>

                            <input type="text" id="dateschedule" name="dateschedule" data-date-format="yyyy-mm-dd" class="form-control{{ $errors->has('dateschedule') ? ' is-invalid' : '' }}" aria-describedby="helpBlock1" placeholder="Tanggal mata diklat diajarkan" required>
                            <span class="fa fa-calendar form-control-feedback"></span>
                            @if($errors->has('dateschedule'))
                                <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('dateschedule') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Pemateri</label>

                            <select class="form-control select2"  id="user_id" name="user_id" style="width: 100%;" required>
                            
                            </select>
                            <span class="fa fa-user form-control-feedback"></span>
                            @if($errors->has('user_id'))
                                <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('user_id') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Mata Diklat</label>
                            <select name="subject_id" id="subject_id" class="form-control" required>
                                <option value="">-- Pilih Mata Diklat --</option>
                            </select>
                            <span class="fa fa-book form-control-feedback"></span>
                            @if($errors->has('subject_id'))
                                <span id="helpBlock3" class="help-block"><strong>{{ $errors->first('subject_id') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Jam</label>

                            <input type="text" id="timeschedule" name="timeschedule" class="form-control{{ $errors->has('timeschedule') ? ' is-invalid' : '' }}" aria-describedby="helpBlock4" placeholder="jam pelaksanaan ex. 07:00-12.00..." required>
                            <span class="fa fa-clock-o form-control-feedback"></span>
                            @if($errors->has('timeschedule'))
                                <span id="helpBlock4" class="help-block"><strong>{{ $errors->first('timeschedule') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Sesi</label>

                            <select name="sessionschedule" id="sessionschedule" class="form-control{{ $errors->has('sessionschedule') ? ' is-invalid' : '' }}" aria-describedby="helpBlock5" required>
                                <option value="">-- Pilih Sesi Pembelajaran --</option>
                                <option value="1"> Sesi 1 </option>
                                <option value="2"> Sesi 2 </option>
                                <option value="3"> Sesi 3 </option>
                                <option value="4"> Sesi 4 </option>
                            </select>
                            <span class="fa fa-code-fork form-control-feedback"></span>
                            @if($errors->has('sessionschedule'))
                                <span id="helpBlock5" class="help-block"><strong>{{ $errors->first('sessionschedule') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Jumlah JP</label>

                            <input type="number" min="1" id="jp" name="jp" class="form-control{{ $errors->has('jp') ? ' is-invalid' : '' }}" aria-describedby="helpBlock6" placeholder="isi dengan angka ex. 1, 2,..." required>
                            <span class="fa fa-calculator form-control-feedback"></span>
                            @if($errors->has('jp'))
                                <span id="helpBlock6" class="help-block"><strong>{{ $errors->first('jp') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="control-label">Keterangan</label>

                            <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="isi dengan keterangan lain yang diperlukan untuk ditampilkan dalam jadwal diklat" aria-describedby="helpBlock7"></textarea>
                            <span class="fa fa-edit form-control-feedback"></span>
                            @if($errors->has('description'))
                                <span id="helpBlock7" class="help-block"><strong>{{ $errors->first('description') }}</strong></span> 
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" id="toprint" name="toprint" value="1"> Tambahkan ke daftar cetak
                                </label>
                            </div>
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
                    <h3 class="box-title">Detail Jadwal Widyaiswara {{$mschedule->nameschedulemaster}}, {{$mschedule->training->name}}</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-schedules" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Diklat</th>
                                <th>Pemateri</th>
                                <th>Mata Diklat</th>
                                <th>Jam</th>
                                <th>Sesi</th>
                                <th>JP</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- row for table schedule -->
    <div class="row">
        <div class="box box-info">
            <div class="box-header with-border">
                <a href="#newprinted" data-toggle="modal" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah detail cetak</a>
                <h3 class="box-title">Jadwal {{$mschedule->nameschedulemaster}}, {{$mschedule->training->name}}</h3>
            </div>
            <div class="box-body table-responsive">
                <table id="tb-printedschedules" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Diklat</th>
                            <th>Pemateri</th>
                            <th>Mata Diklat</th>
                            <th>Jam</th>
                            <th>Sesi</th>
                            <th>JP</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- modal edit -->
<div class="modal fade" id="updatedetailschedule" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('updatedetailschedule') }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="hidden" id="schedule_id" name="schedule_id">
                    <input type="hidden" value="{{ $mschedule->id }}" name="masterschedule_id" id="masterschedule_id">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Tanggal</label>

                                    <input type="text" id="dateschedule" name="dateschedule" data-date-format="yyyy-mm-dd" class="form-control{{ $errors->has('dateschedule') ? ' is-invalid' : '' }}" aria-describedby="helpBlock1" placeholder="Tanggal mata diklat diajarkan" required>
                                    <span class="fa fa-calendar form-control-feedback"></span>
                                    @if($errors->has('dateschedule'))
                                        <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('dateschedule') }}</strong></span> 
                                    @endif
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Pemateri</label>

                                    <select class="form-control select2"  id="user_id" name="user_id" style="width: 100%;" required>
                                    
                                    </select>
                                    <span class="fa fa-user form-control-feedback"></span>
                                    @if($errors->has('user_id'))
                                        <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('user_id') }}</strong></span> 
                                    @endif
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Mata Diklat</label>
                                    <select name="subject_id" id="subject_id" class="form-control" required>
                                        <option value="">-- Pilih Mata Diklat --</option>
                                    </select>
                                    <span class="fa fa-book form-control-feedback"></span>
                                    @if($errors->has('subject_id'))
                                        <span id="helpBlock3" class="help-block"><strong>{{ $errors->first('subject_id') }}</strong></span> 
                                    @endif
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Jam</label>

                                    <input type="text" id="timeschedule" name="timeschedule" class="datepicker form-control{{ $errors->has('timeschedule') ? ' is-invalid' : '' }}" aria-describedby="helpBlock4" placeholder="jam pelaksanaan ex. 07:00-12.00..." required>
                                    <span class="fa fa-clock-o form-control-feedback"></span>
                                    @if($errors->has('timeschedule'))
                                        <span id="helpBlock4" class="help-block"><strong>{{ $errors->first('timeschedule') }}</strong></span> 
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- right side modal -->
                        <div class="col-sm-6">
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Sesi</label>

                                    <select name="sessionschedule" id="sessionschedule" class="form-control{{ $errors->has('sessionschedule') ? ' is-invalid' : '' }}" aria-describedby="helpBlock5" required>
                                        <option value="">-- Pilih Sesi Pembelajaran --</option>
                                        <option value="1"> Sesi 1 </option>
                                        <option value="2"> Sesi 2 </option>
                                        <option value="3"> Sesi 3 </option>
                                        <option value="4"> Sesi 4 </option>
                                    </select>
                                    <span class="fa fa-code-fork form-control-feedback"></span>
                                    @if($errors->has('sessionschedule'))
                                        <span id="helpBlock5" class="help-block"><strong>{{ $errors->first('sessionschedule') }}</strong></span> 
                                    @endif
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Jumlah JP</label>

                                    <input type="number" min="1" id="jp" name="jp" class="form-control{{ $errors->has('jp') ? ' is-invalid' : '' }}" aria-describedby="helpBlock6" placeholder="isi dengan angka ex. 1, 2,..." required>
                                    <span class="fa fa-calculator form-control-feedback"></span>
                                    @if($errors->has('jp'))
                                        <span id="helpBlock6" class="help-block"><strong>{{ $errors->first('jp') }}</strong></span> 
                                    @endif
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Keterangan</label>

                                    <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="isi dengan keterangan lain yang diperlukan untuk ditampilkan dalam jadwal diklat" aria-describedby="helpBlock7"></textarea>
                                    <span class="fa fa-edit form-control-feedback"></span>
                                    @if($errors->has('description'))
                                        <span id="helpBlock7" class="help-block"><strong>{{ $errors->first('description') }}</strong></span> 
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>

            <div class="modal-footer">
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal delete detail schedule -->
<div class="modal modal-danger fade" id="del_schedule">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Hapus Data</h4>
            </div>
            <div class="modal-body">
            <p>Yakin Akan Jadwal?</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <form method="post" id="frm_delete_schedule" action="{{ route('deletedetailschedule') }}">
                    @csrf
                    {{ method_field('DELETE')}}
                    <input type="hidden" id="schedule_id" name="schedule_id">
                    <button type="submit" class="btn btn-outline"> <i class="fa fa-btn fa-trash"></i> Hapus Data</button>
            </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- modal newprinted -->
<div class="modal fade" id="newprinted" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('newprintedschedule') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $mschedule->id }}" name="masterschedule_id" id="masterschedule_id">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Tanggal</label>

                                    <input type="text" id="printednewdateschedule" name="dateschedule" data-date-format="yyyy-mm-dd" class="form-control{{ $errors->has('dateschedule') ? ' is-invalid' : '' }}" aria-describedby="helpBlock1" placeholder="Tanggal mata diklat diajarkan" required>
                                    <span class="fa fa-calendar form-control-feedback"></span>
                                    @if($errors->has('dateschedule'))
                                        <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('dateschedule') }}</strong></span> 
                                    @endif
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Pemateri/Narasumber</label>
                                    <input type="text" id="speaker" name="speaker" placeholder="Isikan Pemateri : TNI,Narasumber,Sekkab..." class="form-control">
                                    <span class="fa fa-user form-control-feedback"></span>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Materi Pembelajaran</label>
                                    <input type="text" id="subject" name="subject" placeholder="Isikan Materi : Coffee break, PBB, Kearifan lokal..." class="form-control">
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Jam</label>

                                    <input type="text" id="timeschedule" name="timeschedule" class="datepicker form-control{{ $errors->has('timeschedule') ? ' is-invalid' : '' }}" aria-describedby="helpBlock4" placeholder="jam pelaksanaan ex. 07:00-12.00...">
                                    <span class="fa fa-clock-o form-control-feedback"></span>
                                </div>
                            </div>
                        </div>
                        <!-- right side modal -->
                        <div class="col-sm-6">
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Jumlah JP</label>

                                    <input type="number" min="1" id="jp" name="jp" class="form-control{{ $errors->has('jp') ? ' is-invalid' : '' }}" aria-describedby="helpBlock6" placeholder="isi dengan angka ex. 1, 2,...">
                                    <span class="fa fa-calculator form-control-feedback"></span>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Keterangan</label>

                                    <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="isi dengan keterangan lain yang diperlukan untuk ditampilkan dalam jadwal diklat" aria-describedby="helpBlock7"></textarea>
                                    <span class="fa fa-edit form-control-feedback"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>

            <div class="modal-footer">
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal update printed schedule-->
<div class="modal fade" id="updateprintedschedule" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah data jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('newprintedschedule') }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="hidden" value="{{ $mschedule->id }}" name="masterschedule_id" id="masterschedule_id">
                    <input type="hidden" name="printedshcedule_id" id="printedshcedule_id">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Tanggal</label>

                                    <input type="text" id="printednewdateschedule" name="dateschedule" data-date-format="yyyy-mm-dd" class="form-control{{ $errors->has('dateschedule') ? ' is-invalid' : '' }}" aria-describedby="helpBlock1" placeholder="Tanggal mata diklat diajarkan" required>
                                    <span class="fa fa-calendar form-control-feedback"></span>
                                    @if($errors->has('dateschedule'))
                                        <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('dateschedule') }}</strong></span> 
                                    @endif
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Pemateri/Narasumber</label>
                                    <input type="text" id="speaker" name="speaker" placeholder="Isikan Pemateri : TNI,Narasumber,Sekkab..." class="form-control">
                                    <span class="fa fa-user form-control-feedback"></span>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Materi Pembelajaran</label>
                                    <input type="text" id="subject" name="subject" placeholder="Isikan Materi : Coffee break, PBB, Kearifan lokal..." class="form-control">
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Jam</label>

                                    <input type="text" id="timeschedule" name="timeschedule" class="datepicker form-control{{ $errors->has('timeschedule') ? ' is-invalid' : '' }}" aria-describedby="helpBlock4" placeholder="jam pelaksanaan ex. 07:00-12.00...">
                                    <span class="fa fa-clock-o form-control-feedback"></span>
                                </div>
                            </div>
                        </div>
                        <!-- right side modal -->
                        <div class="col-sm-6">
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Jumlah JP</label>

                                    <input type="number" min="1" id="jp" name="jp" class="form-control{{ $errors->has('jp') ? ' is-invalid' : '' }}" aria-describedby="helpBlock6" placeholder="isi dengan angka ex. 1, 2,...">
                                    <span class="fa fa-calculator form-control-feedback"></span>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Keterangan</label>

                                    <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="isi dengan keterangan lain yang diperlukan untuk ditampilkan dalam jadwal diklat" aria-describedby="helpBlock7"></textarea>
                                    <span class="fa fa-edit form-control-feedback"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>

            <div class="modal-footer">
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-danger fade" id="del_printedschedule">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Hapus Data</h4>
            </div>
            <div class="modal-body">
            <p>Yakin Akan Jadwal?</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <form method="post" id="frm_delete_schedule" action="{{ route('newprintedschedule') }}">
                    @csrf
                    {{ method_field('DELETE')}}
                    <input type="hidden" id="printedschedule_id" name="printedschedule_id">
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
    //  datepicker
    $('#dateschedule').datepicker({});
    $('#printednewdateschedule').datepicker({});
    // select2 user
    $('#user_id').select2({
        placeholder : "Ketikkan nama user : ex. jhon, budi, andi irawati",
        minimumInputLength : 4,
        ajax: {
            delay : 250,
            dataType : "json",
            url : '{!! route('getuserselect2') !!}',
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
            cache: true,
        },
    });
    // select2 subject on selected user_id
    $('#user_id').on('select2:select',function(e){
        var user = e.params.data;
        $.ajax({
            type : 'GET',
            dataType : "json",
            url : '{!! route('getsubjectbyid') !!}',
            data : {q:user.id},
            success : function(subjects){
                $('#subject_id').val("");
                $.map(subjects,function(subject){
                    $('#subject_id').append("<option value="+subject.subject.id+">"+subject.subject.name+"</option>");
                });
            }
        });
    });
    // datatables
    $('#tb-schedules').DataTable({
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
            url : '{!! route('getdetailschedules') !!}',
            dataType : 'json',
            data : {q: '{!! $mschedule->id !!}'}
        },
        fnCreatedRow: function (row, data, index) {
            $('td', row).eq(0).html(index + 1);
        },
        columns : [
            { data : null, sortable : false},
            { data : "dateschedule",name : 'dateschedule'},
            { data : "user.name",name : 'user.name'},
            { data : "subject.name",name : 'subject.name'},
            { data : "timeschedule",name : 'timeschedule'},
            { data : "sessionschedule",name : 'sessionschedule'},
            { data : "jp",name : 'jp'},
            { data : "description",name : 'description'},
            { data : "action",name : "action",orderable : false, searchable : false},
        ],
    });

    // datatables for printed schedules
    $('#tb-printedschedules').DataTable({
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
            url : '{!! route('getprintedschedules') !!}',
            dataType : 'json',
            data : {q: '{!! $mschedule->id !!}'}
        },
        fnCreatedRow: function (row, data, index) {
            $('td', row).eq(0).html(index + 1);
        },
        columns : [
            { data : null, sortable : false},
            { data : "dateschedule",name : 'dateschedule'},
            { data : "speaker",name : 'speaker'},
            { data : "subject",name : 'subject'},
            { data : "timeschedule",name : 'timeschedule'},
            { data : "sessionschedule",name : 'sessionschedule'},
            { data : "jp",name : 'jp'},
            { data : "description",name : 'description'},
            { data : "action",name : "action",orderable : false, searchable : false},
        ],
    });
});

$(function(){
    /** 
    * update schedule modal
    */
    $('#updatedetailschedule').on('show.bs.modal',function(e){
        var modal = $(this);
        var lnk = $(e.relatedTarget);

        modal.find('.modal-body #timeschedule').val(lnk.data('timeschedule'));
        modal.find('.modal-body #sessionschedule').val(lnk.data('sessionschedule'));
        modal.find('.modal-body #jp').val(lnk.data('jp'));
        modal.find('.modal-body #schedule_id').val(lnk.data('id'));
        modal.find('.modal-body #description').val(lnk.data('description'));
        // select2 on user_id
        modal.find('.modal-body #user_id').append('<option value="'+lnk.data('user_id')+'" selected >'+lnk.data('username')+'</option>');
        
        modal.find('.modal-body #user_id').select2({
            placeholder : "Ketikkan nama user : ex. jhon, budi, andi irawati",
            minimumInputLength : 4,
            dropdownParent : modal,
            ajax: {
                delay : 250,
                dataType : "json",
                url : '{!! route('getuserselect2') !!}',
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
                cache: true,
            },
        });
        // select option value init for subject_id
        $.ajax({
            type : 'GET',
            dataType : 'JSON',
            url : '{!! route('getsubjectbyid') !!}',
            data : {q : lnk.data('user_id')},
            success : function (subjects){
                $('.modal-body #subject_id').empty();
                $('.modal-body #subject_id').append('<option value="">--Pilih Mata Diklat--</option>');
                $.map(subjects,function(subject){
                    if(subject.subject.id===lnk.data('subject_id')){
                        $('.modal-body #subject_id').append("<option value="+subject.subject.id+" selected>"+subject.subject.name+"</option>");
                    }else{
                        $('.modal-body #subject_id').append("<option value="+subject.subject.id+">"+subject.subject.name+"</option>");
                    }
                });
            }
        });
        // select option for subject_id on change selected user
        modal.find('.modal-body #user_id').on('select2:select',function(e){
            var user = e.params.data;
            $.ajax({
                type : 'GET',
                dataType : 'JSON',
                url : '{!! route('getsubjectbyid') !!}',
                data : {q : user.id},
                success : function (subjects){
                    $('.modal-body #subject_id').empty();
                    $('.modal-body #subject_id').append('<option value="">--Pilih Mata Diklat--</option>');
                    $.map(subjects,function(subject){
                        if(subject.subject.id===lnk.data('subject_id')){
                            $('.modal-body #subject_id').append("<option value="+subject.subject.id+" selected>"+subject.subject.name+"</option>");
                        }else{
                            $('.modal-body #subject_id').append("<option value="+subject.subject.id+">"+subject.subject.name+"</option>");
                        }
                    });
                }
            });
        });

        modal.find('.modal-body #dateschedule').val(lnk.data('dateschedule'));
        modal.find('.modal-body #dateschedule').datepicker({
            autoclose: 1,
            forceParse: 0,
            inline : true,
        })
        .on('show',function(evt){
            return false;
        });
    });

    $('#del_schedule').on('show.bs.modal',function(e){
        var mdl = $(this);
        var lnk = $(e.relatedTarget);

        mdl.find('.modal-footer #schedule_id').val(lnk.data('schedule_id'));
    });

    $('#updateprintedschedule').on('show.bs.modal',function(e){
        var mdl = $(this);
        var lnk = $(e.relatedTarget);

        mdl.find('.modal-body #printedshcedule_id').val(lnk.data('printedschedule_id'));
        mdl.find('.modal-body #printednewdateschedule').val(lnk.data('dateschedule'));
        mdl.find('.modal-body #speaker').val(lnk.data('speaker'));
        mdl.find('.modal-body #subject').val(lnk.data('subject'));
        mdl.find('.modal-body #timeschedule').val(lnk.data('timeschedule'));
        mdl.find('.modal-body #description').val(lnk.data('description'));
        mdl.find('.modal-body #jp').val(lnk.data('jp'));
    });

    $('#del_printedschedule').on('show.bs.modal',function(e){
        var mdl = $(this);
        var lnk = $(e.relatedTarget);

        mdl.find('.modal-footer #printedschedule_id').val(lnk.data('printedschedule_id'));        
    });
});

</script>
@endpush