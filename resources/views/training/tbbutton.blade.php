@permission('update-trainings')
<a href="#edit_training" class="badge bg-yellow" data-toggle="modal" data-training_name="{{ $training->name }}" data-start_date="{{ $training->start_date}}" data-period="{{ $training->period }}" data-end_date="{{ $training->end_date}}" data-training="{{ $training->id }}" data-description="{{ $training->description }}"><i class="fa fa-pencil"></i></a>
@endpermission
@permission('delete-trainings')
&nbsp;&nbsp;<a href="#del_training" data-training="{{ $training->id }}" class="badge bg-red" data-toggle="modal"><i class="fa fa-trash"></i></a>
@endpermission