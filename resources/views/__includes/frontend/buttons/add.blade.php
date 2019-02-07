{{-- Add record --}}

@ability('admin', 'admin,'.$primer.'_create,'.$primer.'_create_admin')
	<a href="{{ route($section_name.'.create') }}" class="btn btn-success btn-xs">
		@if(Auth::check())
			{{-- Icons and Text --}}
			@if(Auth::user()->actionButtons == 1)
				<i class="fa fa-plus-square" aria-hidden="true"></i> New {{ str_singular(ucfirst($section_name)) }}
			@endif

			{{-- Icons Only --}}
			@if(Auth::user()->actionButtons == 2)
				<i class="fa fa-plus-square" aria-hidden="true"></i>
			@endif

			{{-- Text Only --}}
			@if(Auth::user()->actionButtons == 3)
				New {{ str_singular(ucfirst($section_name)) }}
			@endif
		@endif
	</a>
@endability
