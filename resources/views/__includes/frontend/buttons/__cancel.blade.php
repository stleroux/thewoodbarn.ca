{{-- @ability('admin', 'admin,'.$primer.'_list,'.$primer.'_list_admin') --}}
	
	@if($section_name === 'recipes')
		{{-- If coming from dashboard page --}}
		@if($_SERVER['HTTP_REFERER'] == Request::root() . "/dashboard")
			{{-- Cancel button to go back to previous page --}}
			<a href="{{ URL::previous() }}" class="btn btn-default btn-xs">
		@else
			{{-- Otherwise, go to the index page --}}
			<a href="{{ route($section_name.'.index','all') }}" class="btn btn-default btn-xs">
		@endif
	@else
		{{-- If coming from blog or dashboard page --}}
		@if(
			$_SERVER['HTTP_REFERER'] == Request::root() . "/blog" ||
			$_SERVER['HTTP_REFERER'] == Request::root() . "/dashboard"
			)
			{{-- Cancel button to go back to previous page --}}
			{{-- Need to add spaces here because the other buttons on the profile.edit page are coded on the page instead of using the button function --}}
			&nbsp;<a href="{{ URL::previous() }}" class="btn btn-default btn-xs">
		@else
			{{-- If profile page --}}
			@if($section_name == 'profile')
				&nbsp;<a href="{{ route($section_name.'.show', Auth::User()->id) }}" class="btn btn-default btn-xs">
			@else
				{{-- Otherwise, go to the standard index page --}}
				&nbsp;<a href="{{ route($section_name.'.index') }}" class="btn btn-default btn-xs">
			@endif
		@endif
	@endif
		
		{{-- Icons and Text --}}
		@if(Auth::user()->actionButtons == 1)
			<i class="fa fa-ban" aria-hidden="true"></i> Cancel
		@endif

		{{-- Icons Only --}}
		@if(Auth::user()->actionButtons == 2)
			<i class="fa fa-ban" aria-hidden="true"></i>
		@endif

		{{-- Text Only --}}
		@if(Auth::user()->actionButtons == 3)
			Cancel
		@endif
	</a>
{{-- @endability --}}



