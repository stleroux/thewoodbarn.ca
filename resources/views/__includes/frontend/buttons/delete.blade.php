{{-- Delete record --}}

@section('deleteBlock')
	@if($model->user->actionButtons == 1)
		{{-- Icons and Text --}}<i class="glyphicon glyphicon-trash"></i> Delete
	@elseif($model->user->actionButtons == 2)
		{{-- Icons Only --}}<i class="glyphicon glyphicon-trash"></i>
	@elseif($model->user->actionButtons == 3)
		{{-- Text Only --}}Delete
	@endif
@stop

{{-- @if(Auth::check()) --}}
	@if (Auth::user()->id == $model->user_id)
		@ability('admin', 'admin,'.$primer.'_delete,'.$primer.'_delete_admin')
			<form method="POST" action="{{ route($section_name.'.destroy', $model->id) }}" accept-charset="UTF-8" style="display:inline">
				<input type="hidden" name="_method" value="DELETE">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button
					class="btn btn-xs btn-danger"
					{{ $model->user->actionButtons == 2 ? 'title=Delete' : '' }}
					type="button"
					data-toggle="modal"
					data-id="{{ $model->id }}"
					data-target="#confirmDelete"
					data-title="Delete {{ str_singular(ucfirst($section_name)) }}"
					data-message="Are you sure you want to delete this {{ str_singular($section_name) }}?">
						
						@if($model->user->actionButtons == 1)
							{{-- Icons and Text --}}<i class="glyphicon glyphicon-trash"></i> Delete
						@elseif($model->user->actionButtons == 2)
							{{-- Icons Only --}}<i class="glyphicon glyphicon-trash"></i>
						@elseif($model->user->actionButtons == 3)
							{{-- Text Only --}}Delete
						@endif
				</button>
			</form>
		@endability
	@else
		@ability('admin', 'admin,'.$primer.'_delete_admin')
			
			<form method="POST" action="{{ route($section_name.'.destroy', $model->id) }}" accept-charset="UTF-8" style="display:inline">
				<input type="hidden" name="_method" value="DELETE">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button
					class="btn btn-xs btn-danger"
					{{ $model->user->actionButtons == 2 ? 'title=Delete' : '' }}
					type="button"
					data-toggle="modal"
					data-id="{{ $model->id }}"
					data-target="#confirmDelete"
					data-title="Delete {{ str_singular(ucfirst($section_name)) }}"
					data-message="Are you sure you want to delete this {{ str_singular($section_name) }}?">
						
						@if($model->user->actionButtons == 1)
							{{-- Icons and Text --}}<i class="glyphicon glyphicon-trash"></i> Delete
						@elseif($model->user->actionButtons == 2)
							{{-- Icons Only --}}<i class="glyphicon glyphicon-trash"></i>
						@elseif($model->user->actionButtons == 3)
							{{-- Text Only --}}Delete
						@endif
				</button>
			</form>
		@endability
	@endif
{{-- @endif --}}