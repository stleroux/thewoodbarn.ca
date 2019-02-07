{{-- Edit record --}}

@section('editBlock')
	{{-- Icons and Text --}}
	@if($model->user->actionButtons == 1)
		<i class="glyphicon glyphicon-pencil"></i> Edit
	@endif

	{{-- Icons Only --}}
	@if($model->user->actionButtons == 2)
		<i class="glyphicon glyphicon-pencil"></i>
	@endif

	{{-- Text Only --}}
	@if($model->user->actionButtons == 3)
		Edit
	@endif
@stop

@if (Auth::user()->id == $model->user_id)
	@ability('admin', 'admin,'.$primer.'_edit,'.$primer.'_edit_admin')
		<a href="{{ route($field.'.edit', $model->id) }}" class="btn btn-info btn-xs" {{ $model->user->actionButtons == 2 ? 'title=Edit' : '' }}>
			@yield('editBlock')
		</a>
	@endability
@else
	@ability('admin', 'admin,'.$primer.'_edit_admin')
		<a href="{{ route($field.'.edit', $model->id) }}" class="btn btn-info btn-xs" {{ $model->user->actionButtons == 2 ? 'title=Edit' : '' }}>
			@yield('editBlock')
		</a>
	@endability
@endif
