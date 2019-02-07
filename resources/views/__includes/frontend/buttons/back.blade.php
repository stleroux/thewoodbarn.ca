{{-- Same as Cancel button except icon iand text are different --}}

@if(Auth::check())
	@ability('admin', 'admin,'.$primer.'_list,'.$primer.'_list_admin')
		
		@if($section_name === 'recipes')
			<a href="{{ route($section_name.'.index','all') }}" class="btn btn-default btn-xs">
		@else
			<a href="{{ route($section_name.'.index') }}" class="btn btn-default btn-xs">
		@endif

			{{-- Icons and Text --}}
			@if(Auth::user()->actionButtons == 1)
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Back
			@endif

			{{-- Icons Only --}}
			@if(Auth::user()->actionButtons == 2)
				<i class="fa fa-arrow-left" aria-hidden="true"></i>
			@endif

			{{-- Text Only --}}
			@if(Auth::user()->actionButtons == 3)
				Back
			@endif
		</a>
	@endability

@else

	@if($section_name === 'recipes')
		<a href="{{ route($section_name.'.index','all') }}" class="btn btn-default btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
	@else
		<a href="{{ route($section_name.'.index') }}" class="btn btn-default btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
	@endif

@endif