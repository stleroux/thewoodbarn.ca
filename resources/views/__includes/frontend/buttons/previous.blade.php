{{-- Go to previous page  --}}

<a class="btn btn-default btn-xs" href="{{ URL::previous() }}">
	@if(Auth::check())
		{{-- Icons and Text --}}
		@if(Auth::user()->actionButtons == 1)
			<i class="glyphicon glyphicon-arrow-left"></i> Back
		@endif

		{{-- Icons Only --}}
		@if(Auth::user()->actionButtons == 2)
			<i class="glyphicon glyphicon-arrow-left"></i>
		@endif

		{{-- Text Only --}}
		@if(Auth::user()->actionButtons == 3)
			Back
		@endif
	@else
		<i class="glyphicon glyphicon-arrow-left"></i> Previous
	@endif
</a>
