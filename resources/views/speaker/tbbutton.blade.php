@permission('update-speakers')
<a href="#edit_speaker" class="badge bg-yellow" data-toggle="modal" data-speaker_name="{{ $speaker->user->name }}" data-speaker_id="{{ $speaker->user_id }}" data-subject_name="{{ $speaker->subject->name }}" data-subject_id="{{ $speaker->subject_id }}" data-id="{{ $speaker->id }}"><i class="fa fa-pencil"></i></a>
@endpermission
@permission('delete-speakers')
&nbsp;&nbsp;<a href="#del_speaker" data-speaker_id="{{ $speaker->id }}" class="badge bg-red" data-toggle="modal"><i class="fa fa-trash"></i></a>
@endpermission