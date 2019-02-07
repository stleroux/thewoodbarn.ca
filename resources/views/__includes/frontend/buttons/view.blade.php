{{-- View record --}}

@section('viewBlock')
	{{-- Icons and Text --}}
	@if($model->user->actionButtons == 1)
		<i class="glyphicon glyphicon-eye-open"></i> View
	@endif

	{{-- Icons Only --}}
	@if($model->user->actionButtons == 2)
		<i class="glyphicon glyphicon-eye-open"></i>
	@endif

	{{-- Text Only --}}
	@if($model->user->actionButtons == 3)
		View
	@endif
@stop


@if (Auth::user()->id == $model->user_id)
	@ability('admin', 'admin,'.$primer.'_list,'.$primer.'_list_admin')
		<a href="{{ route($field.'.show', $model->id) }}" class="btn btn-default btn-xs" {{ $model->user->actionButtons == 2 ? 'title=View' : '' }}>
			@yield('viewBlock')		
		</a>
	@endability
@else
	@ability('admin', 'admin,'.$primer.'_list_admin')
		<a href="{{ route($field.'.show', $model->id) }}" class="btn btn-default btn-xs" {{ $model->user->actionButtons == 2 ? 'title=View' : '' }}>
			@yield('viewBlock')
		</a>
	@endability
@endif
