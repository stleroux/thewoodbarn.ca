{{-- Duplicate record --}}

@if (Auth::user()->id == $model->user_id)

	@ability('admin', 'admin,'.$primer.'_duplicate')
		<a href="{{ route($field.'.duplicate', $model->id) }}" class="btn btn-default btn-xs" {{ $model->user->actionButtons == 2 ? 'title=Duplicate' : '' }}>
			
			{{-- Icons and Text --}}
			@if($model->user->actionButtons == 1)
				<i class="glyphicon glyphicon-duplicate"></i> Duplicate
			@endif

			{{-- Icons Only --}}
			@if($model->user->actionButtons == 2)
				<i class="glyphicon glyphicon-duplicate"></i>
			@endif

			{{-- Text Only --}}
			@if($model->user->actionButtons == 3)
				Duplicate
			@endif
			
		</a>
	@endability

@else

	@ability('admin', 'admin,'.$primer.'_duplicate')
		<a href="{{ route($field.'.duplicate', $model->id) }}" class="btn btn-default btn-xs" {{ Auth::user()->actionButtons == 2 ? 'title=Duplicate' : '' }}>

			{{-- Icons and Text --}}
			@if(Auth::user()->actionButtons == 1)
				<i class="glyphicon glyphicon-duplicate"></i> Duplicate
			@endif

			{{-- Icons Only --}}
			@if(Auth::user()->actionButtons == 2)
				<i class="glyphicon glyphicon-duplicate"></i>
			@endif

			{{-- Text Only --}}
			@if(Auth::user()->actionButtons == 3)
				Duplicate
			@endif

		</a>
	@endability

@endif
