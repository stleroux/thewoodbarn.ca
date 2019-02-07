{{-- Only be used in recipes index page to display All Recipes button in panelHeader --}}

{{-- @if($section_name === 'recipes') --}}
	<a href="{{ route($section_name.'.index','all') }}" class="btn {{ Request::is('recipes/index/all') ? "btn-primary": "btn-default" }} btn-xs">
{{-- @else
	<a href="{{ route($section_name.'.index') }}" class="btn btn-default btn-xs">
@endif --}}

	@if(Auth::check())
		{{-- Icons and Text --}}
		@if(Auth::user()->actionButtons == 1)
			<i class="fa fa-list-alt" aria-hidden="true"></i> All {{ ucfirst($section_name) }}
		@endif

		{{-- Icons Only --}}
		@if(Auth::user()->actionButtons == 2)
			<i class="fa fa-list-alt" aria-hidden="true"></i>
		@endif

		{{-- Text Only --}}
		@if(Auth::user()->actionButtons == 3)
			All {{ ucfirst($section_name) }}
		@endif
	@else
		<i class="fa fa-list-alt" aria-hidden="true"></i> All {{ ucfirst($section_name) }}
	@endif
</a>
