<div class="pull-right">

	@if (in_array('view', $actions))
		@include('partials.buttons.view')
	@endif

	@if (in_array('makeAdmin', $actions))
		@include('partials.buttons.makeAdmin') 
	@endif	

	@if (in_array('duplicate', $actions))
		@include('partials.buttons.duplicate') 
	@endif	

	@if (in_array('edit', $actions))
		@include('partials.buttons.edit') 
	@endif

	@if (in_array('delete', $actions))
		@include('partials.buttons.delete')
	@endif

</div>