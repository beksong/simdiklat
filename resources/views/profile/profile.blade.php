@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile Saya</li>
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
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Profile saya</h3>
                </div>
                <!-- form profile -->
                <form action="{{ url('profile') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" aria-describedby="helpBlock1" placeholder="Username" value="{{ $user->name }}" autofocus required>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                @if($errors->has('name'))
                                    <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('name') }}</strong></span> 
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="email" class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" aria-describedby="helpBlock2" placeholder="Email Anda" value="{{ $user->email }}" required>
                                <span class="fa fa-at form-control-feedback"></span>
                                @if($errors->has('email'))
                                    <span id="helpBlock2" class="help-block"><strong>{{ $errors->first('email') }}</strong></span> 
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="nip" class="col-sm-2 control-label">NIP</label>

                            <div class="col-sm-10">
                                <input type="nip" id="nip" name="nip" class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" aria-describedby="helpBlock3" placeholder="NIP Anda" value="{{ $user->nip }}" required>
                                @if($errors->has('nip'))
                                    <span id="helpBlock3" class="help-block"><strong>{{ $errors->first('nip') }}</strong></span> 
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="tempat_lahir" class="col-sm-2 control-label">Tempat Lahir</label>

                            <div class="col-sm-10">
                                <input type="tempat_lahir" id="tempat_lahir" name="tempat_lahir" class="form-control{{ $errors->has('place_birth') ? ' is-invalid' : '' }}" aria-describedby="helpBlock4" placeholder="Tempat lahir anda" value="{{ $user->place_birth }}" required>
                                @if($errors->has('place_birth'))
                                    <span id="helpBlock4" class="help-block"><strong>{{ $errors->first('place_birth') }}</strong></span> 
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="tanggal_lahir" class="col-sm-2 control-label">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control pull-right {{ $errors->has('date_birth') ? ' is-invalid' : '' }}" aria-describedby="helpBlock5" placeholder="Tanggal Lahir Anda" value="{{ $user->date_birth }}" required>
                                    <span class="fa fa-calendar form-control-feedback"></span>
                                </div>
                                @if($errors->has('date_birth'))
                                    <span id="helpBlock5" class="help-block"><strong>{{ $errors->first('date_birth') }}</strong></span> 
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="religion" class="col-sm-2 control-label">Agama</label>

                            <div class="col-sm-10">
                                <input type="religion" id="religion" name="religion" class="form-control{{ $errors->has('religion') ? ' is-invalid' : '' }}" aria-describedby="helpBlock4" placeholder="Agama anda" value="{{ $user->religion }}" required>
                                @if($errors->has('religion'))
                                    <span id="helpBlock4" class="help-block"><strong>{{ $errors->first('religion') }}</strong></span> 
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin</label>

                            <div class="col-sm-10">
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control select2 {{ $errors->has('gender') ? ' is-invalid' : '' }}" value="{{ $user->gender }}" required>
                                    <option value="">--Pilih Jenis kelamin--</option>
                                    @if($user->gender=="Laki-laki")
                                        <option value="Laki-laki" selected>Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    @endif

                                    @if($user->gender=="Perempuan")
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan" selected>Perempuan</option>
                                    @endif

                                    @if($user->gender==null)
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    @endif
                                </select>
                                @if($errors->has('gender'))
                                    <span id="helpBlock4" class="help-block"><strong>{{ $errors->first('gender') }}</strong></span> 
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="foto" class="col-sm-2 control-label">Alamat</label>

                            <div class="col-sm-10">
                                <textarea name="address" id="address" cols="30" rows="10" class="form-control">{{$user->address}}</textarea>
                                @if($errors->has('address'))
                                    <span id="helpBlock4" class="help-block"><strong>{{ $errors->first('address') }}</strong></span> 
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="foto" class="col-sm-2 control-label">Foto</label>

                            <div class="col-sm-10">
                                <input type="file" id="foto" name="foto"  accept="image/*" required>
                                @if($user->photo!=null)
                                    <p class="help-block">{{ $user->photo }}</p> 
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('jscript')
<script>
    $('.select2').select2();

    $('#tanggal_lahir').datepicker({
        autoclose:true,
        format:'yyyy/mm/dd'
    });
</script>
@endpush