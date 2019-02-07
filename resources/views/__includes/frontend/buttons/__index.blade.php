{{-- Go to index page  --}}

	<a href="{{ route($section_name.'.index') }}" class="btn btn-default btn-xs">
		<div class="text text-left">
			<i class="fa fa-ban" aria-hidden="true"></i> Cancel
		</div>
	</a>

<a class="btn btn-default btn-xs" href="{{ URL::previous() }}">
	
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
	
</a>