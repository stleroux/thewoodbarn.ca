{{-- Make a permission ADMIN --}}

@if(!$model->admin == 1)

	@if (Auth::user()->id == $model->user_id)

		@ability('admin', 'admin,'.$primer.'_makeAdmin')
			<a href="{{ route($field.'.makeAdmin', $model->id) }}" class="btn btn-default btn-xs" {{ $model->user->actionButtons == 2 ? 'title=Make Admin' : '' }}>
				
				{{-- Icons and Text --}}
				@if($model->user->actionButtons == 1)
					<i class="glyphicon glyphicon-text-color"></i> Admin
				@endif

				{{-- Icons Only --}}
				@if($model->user->actionButtons == 2)
					<i class="glyphicon glyphicon-text-color"></i>
				@endif

				{{-- Text Only --}}
				@if($model->user->actionButtons == 3)
					Admin
				@endif
				
			</a>
		@endability

	@else

		@ability('admin', 'admin,'.$primer.'_makeAdmin')
			<a href="{{ route($field.'.makeAdmin', $model->id) }}" class="btn btn-default btn-xs" {{ Auth::user()->actionButtons == 2 ? 'title=Make Admin' : '' }}>

				{{-- Icons and Text --}}
				@if(Auth::user()->actionButtons == 1)
					<i class="glyphicon glyphicon-text-color"></i> Admin
				@endif

				{{-- Icons Only --}}
				@if(Auth::user()->actionButtons == 2)
					<i class="glyphicon glyphicon-text-color"></i>
				@endif

				{{-- Text Only --}}
				@if(Auth::user()->actionButtons == 3)
					Admin
				@endif

			</a>
		@endability

	@endif

@endif