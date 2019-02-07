{{-- Edit record --}}

@if (Auth::user()->id == $model->user_id)

	@ability('admin', 'admin,'.$primer.'_edit,'.$primer.'_edit_admin')
		<a href="{{ route($field.'.edit', $model->id) }}" class="btn btn-primary btn-xs" {{ $model->user->actionButtons == 2 ? 'title=Edit' : '' }}>
			
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
		</a>
	@endability

@else

	@ability('admin', 'admin,'.$primer.'_edit_admin')
		<a href="{{ route($field.'.edit', $model->id) }}" class="btn btn-primary btn-xs" {{ Auth::user()->actionButtons == 2 ? 'title=Edit' : '' }}>
			
			{{-- Icons and Text --}}
			@if(Auth::user()->actionButtons == 1)
				<i class="glyphicon glyphicon-pencil"></i> Edit
			@endif

			{{-- Icons Only --}}
			@if(Auth::user()->actionButtons == 2)
				<i class="glyphicon glyphicon-pencil"></i>
			@endif

			{{-- Text Only --}}
			@if(Auth::user()->actionButtons == 3)
				Edit
			@endif
			
		</a>
	@endability

@endif
