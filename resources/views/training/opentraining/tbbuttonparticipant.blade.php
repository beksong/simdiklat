@if($participant->training->end_date > Carbon\Carbon::now())
<a href="#edit_participant" data-toggle="modal" data-id="{{$participant->id}}" data-fullname="{{ $participant->fullname }}" data-nip="{{ $participant->user->nip }}" data-training_id="{{ $participant->training->id }}" data-training_name="{{ $participant->training->name }}" class="badge bg-orange"><i class="fa fa-undo"></i></a>
&nbsp;&nbsp;<a href="#del_participant" data-toggle="modal" data-id="{{ $participant->id }}" class="badge bg-red"><i class="fa fa-trash"></i></a>
@endif