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
                <!-- form profile -->
                <form action="{{ route('schedules') }}" method="post">
                    @csrf
                    <input type="hidden" value="{{ $training->id }}" name="training_id">
                    
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
                                <th>Nama Jadwal</th>
                                <th>Nama Diklat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('jscript')
<script>
$(document).ready(function(){
    //  datepicker
    $('#dateschedule').datepicker({});
    // select2
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
});

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

</script>
@endpush