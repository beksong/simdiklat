@extends('layouts.dashboard')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 0.1</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Role User</li>
        <li class="active">Sync Role User</li>
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
                    <h3 class="box-title">Sync Role User</h3>
                </div>
                <!-- form profile -->
                <form action="{{ route('syncroleuser') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name" class="col-sm-2 control-label">Username</label>

                            <div class="col-sm-10">
                                <input type="text" id="username" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" aria-describedby="helpBlock1" value="{{ $user->name }}" readonly>
                                <span class="fa fa-cog form-control-feedback"></span>
                                @if($errors->has('username'))
                                    <span id="helpBlock1" class="help-block"><strong>{{ $errors->first('username') }}</strong></span> 
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       @foreach($roles as $p)
                            @if($user->hasRole($p->name))
                                <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <div class="checkbox" style="margin-left:50px;">
                                                <input type="checkbox" name="role_name[]" value="{{$p->name}}" id="role_name" checked> {{ $p->display_name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <div class="checkbox" style="margin-left:50px;">
                                                <input type="checkbox" name="role_name[]" value="{{$p->name}}" id="role_name"> {{ $p->display_name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                       @endforeach
                    </div>
                    <div class="box-footer">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-11">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 col-sm-1 col-xs-12">
            
        </div>
    </div>
</section>
@endsection
