{{-- List all records --}}

@section('listBlock')
	@if($section_name === 'recipes')
		<a href="{{ route($section_name.'.index','all') }}" class="btn {{ Request::is('recipes/index/all') ? "btn-primary": "btn-default" }} btn-xs">
	@else
		<a href="{{ route($field.'.index') }}" class="btn btn-default btn-xs" {{ $model->user->actionButtons == 2 ? 'title=List' : '' }}>
	@endif

		@if(Auth::check())
			{{-- Icons and Text --}}
			@if($model->user->actionButtons == 1)
				<i class="glyphicon glyphicon-list"></i> All {{ ucfirst($primer) }}
			@endif

			{{-- Icons Only --}}
			@if($model->user->actionButtons == 2)
				<i class="glyphicon glyphicon-list"></i>
			@endif

			{{-- Text Only --}}
			@if($model->user->actionButtons == 3)
				All {{ ucfirst($primer) }}
			@endif
		@endif
	</a>
@stop

@if(Auth::check())
	@if (Auth::user()->id == $model->user_id)
		@ability('admin', 'admin,'.$primer.'_list,'.$primer.'_list_admin')
			@yield('listBlock')
		@endability
	@else
		@ability('admin', 'admin,'.$primer.'_list,'.$primer.'_list_admin')
			@yield('listBlock')
		@endability
	@endif
@else
	@if($section_name === 'recipes')
		<a href="{{ route($section_name.'.index','all') }}" class="btn btn-default btn-xs">
	@else
		<a href="{{ route($section_name.'.index') }}" class="btn btn-primary btn-lg">
	@endif

		<i class="glyphicon glyphicon-list"></i> All {{ ucfirst($primer) }}
	</a>
@endif
