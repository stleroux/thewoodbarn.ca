<div class="pull-right">

	@foreach($actions as $action)
		@include('includes.frontend.buttons.'. $action ) 
	@endforeach

</div>