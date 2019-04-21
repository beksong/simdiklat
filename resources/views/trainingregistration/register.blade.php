@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Open Regsitration Trainings</li>
        <li class="active">Register {{ $training->name }}</li>
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
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Pendaftaran {{ $training->name }}</h3>
                    <p>Pastikan anda mendaftar pada diklat yang tepat sesuai dengan surat panggilan yang diberikan oleh Badan Kepegawaian Daerah</p>
                </div>

                <div class="box-body table-responsive">
                    <!-- registration form here -->
                    <!-- form profile -->
                    <form action="{{ route('registertraining') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @if($participant!=null)
                            {{method_field('PUT')}}
                        @endif
                        <input type="hidden" name="training_id" value="{{$training->id}}">
                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="name" class="col-sm-3 control-label">Nama Lengkap</label>

                                <div class="col-sm-9">
                                    <input type="text" id="fullname" name="fullname" class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" value ="{{ $participant!=null ? $participant->fullname : ''}}" aria-describedby="helpBlock1" placeholder="Isikan dengan nama lengkap saudara tanpa gelar ex: bowo alexander patrick (wajib isi)" autofocus required>
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    @if($errors->has('fullname'))
                                        <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('fullname') }}</strong></span> 
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="frontdegree" class="col-sm-3 control-label">Gelar Depan</label>

                                <div class="col-sm-9">
                                    <input type="text" id="frontdegree" name="frontdegree" class="form-control{{ $errors->has('frontdegree') ? ' is-invalid' : '' }}" value ="{{ $participant!=null ? $participant->frontdegree : ''}}" aria-describedby="helpBlock2" placeholder="Gelar depan anda ex : Ir... Prof... dll">
                                    <span class="form-control-feedback"></span>
                                    @if($errors->has('frontdegree'))
                                        <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('frontdegree') }}</strong></span> 
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="backdegree" class="col-sm-3 control-label">Gelar Belakang</label>

                                <div class="col-sm-9">
                                    <input type="text" id="backdegree" name="backdegree" class="form-control{{ $errors->has('backdegree') ? ' is-invalid' : '' }}" value ="{{ $participant!=null ? $participant->backdegree : ''}}" aria-describedby="helpBlock3" placeholder="Gelar belakang anda ex. S.Kom... S.Sos.,M.Si.... dll">
                                    <span class="form-control-feedback"></span>
                                    @if($errors->has('backdegree'))
                                        <span id="helpBlock3" class="help-block"><strong>{{ $errors->first('backdegree') }}</strong></span> 
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="rank" class="col-sm-3 control-label" aria-describedby="helpBlock4">Pangkat, Golongan/Ruang saat ini</label>

                                <div class="col-sm-9">
                                    <select name="rank" id="rank" class="form-control">
                                        @if($participant!=null)
                                            <option value="{{$participant->rank}}"> {{ $participant->rank }} </option>
                                        @endif
                                        <option value="">--Pilih Pangkat,Golongan/Ruang anda--</option>
                                        <option value="Juru Muda, I/a" >Juru Muda, I/a</option>
                                        <option value="Juru Muda Tingkat I, I/b">Juru Muda Tingkat I, I/b</option>
                                        <option value="Juru, I/c">Juru, I/c</option>
                                        <option value="Juru Tingkat I, I/d">Juru Tingkat I, I/d</option>
                                        <option value="Pengatur Muda, II/a">Pengatur Muda, II/a</option>
                                        <option value="Pengatur Muda Tingkat I, II/b">Pengatur Muda Tingkat I, II/b</option>
                                        <option value="Pengatur, II/c">Pengatur, II/c</option>
                                        <option value="Pengatur Tingkat I, II/d">Pengatur Tingkat I, II/d</option>
                                        <option value="Penata Muda, III/a">Penata Muda, III/a</option>
                                        <option value="Penata Muda Tingkat I, III/b">Penata Muda Tingkat I, III/b</option>
                                        <option value="Penata, III/c">Penata, III/c</option>
                                        <option value="Penata Tingkat I, III/d">Penata Tingkat I, III/d</option>
                                        <option value="Pembina, IV/a">Pembina, IV/a</option>
                                        <option value="Pembina Tingkat I, IV/b">Pembina Tingkat I, IV/b</option>
                                        <option value="Pembina Utama Muda, IV/c">Pembina Utama Muda, IV/c</option>
                                        <option value="Pembina Utama Madya, IV/d">Pembina Utama Madya, IV/d</option>
                                        <option value="Pembina Utama, IV/e">Pembina Utama, IV/e</option>
                                    </select>
                                    @if($errors->has('rank'))
                                        <span id="helpBlock4" class="help-block"><strong>{{ $errors->first('rank') }}</strong></span> 
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="position" class="col-sm-3 control-label">Jabatan saat ini</label>

                                <div class="col-sm-9">
                                    <input type="text" id="position" name="position" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" value ="{{ $participant!=null ? $participant->position : ''}}" aria-describedby="helpBlock5" placeholder="Jabatan anda saat ini ex: Kepala subbagian.... Kepala Bidang.. Pranata Komputer Ahli Utama">
                                    @if($errors->has('position'))
                                        <span id="helpBlock5" class="help-block"><strong>{{ $errors->first('position') }}</strong></span> 
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="institution" class="col-sm-3 control-label">Unit Kerja saat ini</label>
                                <div class="col-sm-9">
                                    <input type="text" id="institution" name="institution" class="form-control pull-right {{ $errors->has('institution') ? ' is-invalid' : '' }}" value ="{{ $participant!=null ? $participant->institution : ''}}" aria-describedby="helpBlock6" placeholder="Unit kerja saat ini ex: Badan Pemberdayaan Perempuan Kab. Donggala... (wajib isi)" required>
                                    <span class="form-control-feedback"></span>
                                    @if($errors->has('institution'))
                                        <span id="helpBlock6" class="help-block"><strong>{{ $errors->first('institution') }}</strong></span> 
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="institution_address" class="col-sm-3 control-label">Alamat Kantor / Unit Kerja</label>
                                <div class="col-sm-9">
                                    <input type="text" id="institution_address" name="institution_address" class="form-control pull-right {{ $errors->has('institution_address') ? ' is-invalid' : '' }}" value ="{{ $participant!=null ? $participant->institution_address : ''}}" aria-describedby="helpBlock6" placeholder="Isikan dengan alamat kantor anda saat ini,,, ex : Jl. S. Parman No. 67" required>
                                    <span class="form-control-feedback"></span>
                                    @if($errors->has('institution_address'))
                                        <span id="helpBlock7" class="help-block"><strong>{{ $errors->first('institution_address') }}</strong></span> 
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="phone" class="col-sm-3 control-label">Nomor Telepon / Hp</label>
                                <div class="col-sm-9">
                                    <input type="text" id="phone" name="phone" class="form-control pull-right {{ $errors->has('phone') ? ' is-invalid' : '' }}" value ="{{ $participant!=null ? $participant->phone : ''}}" aria-describedby="helpBlock8" placeholder="Isikan dengan nomor telepon/HP anda... ex : 082193xxxxxx" required>
                                    <span class="form-control-feedback"></span>
                                    @if($errors->has('phone'))
                                        <span id="helpBlock8" class="help-block"><strong>{{ $errors->first('phone') }}</strong></span> 
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="institution_phone" class="col-sm-3 control-label">Nomor Telepon Kantor</label>
                                <div class="col-sm-9">
                                    <input type="text" id="institution_phone" name="institution_phone" class="form-control pull-right {{ $errors->has('institution_phone') ? ' is-invalid' : '' }}" value ="{{ $participant!=null ? $participant->institution_phone : ''}}" aria-describedby="helpBlock9" placeholder="Isikan dengan nomor telepon kantor anda ex : (0451) 426xxx" required>
                                    <span class="form-control-feedback"></span>
                                    @if($errors->has('institution_phone'))
                                        <span id="helpBlock9" class="help-block"><strong>{{ $errors->first('institution_phone') }}</strong></span> 
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="requirements" class="col-sm-3 control-label">Upload scan berkas persyaratan pendaftaran</label>
                            <div class="col-sm-9">
                                <input type="file" id="requirements" name="requirements" accept="application/pdf">
                                <p>{{ $participant!=null ? $participant->requirements : 'Belum Ada Dokumen diupload' }}</p>
                                <span class="fa fa-file-o form-control-feedback"></span>
                                @if($errors->has('requirements'))
                                    <span id="helpBlock10" class="help-block"><strong>{{ $errors->first('requirements') }}</strong></span> 
                                @endif
                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-send"></i> Daftar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
