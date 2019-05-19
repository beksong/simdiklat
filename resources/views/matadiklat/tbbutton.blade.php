@permission('update-subjects')
<a href="#edit_sub" class="badge bg-yellow" data-toggle="modal" data-id="{{ $sub->id }}" data-sub_name="{{ $sub->name }}"><i class="fa fa-pencil"></i></a>
@endpermission
@permission('delete-subjects')
&nbsp;&nbsp;<a href="#del_sub" data-id="{{$sub->id}}" class="badge bg-red" data-toggle="modal"><i class="fa fa-trash"></i></a>
@endpermission