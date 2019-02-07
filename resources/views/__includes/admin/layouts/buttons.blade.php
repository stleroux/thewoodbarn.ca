<div class="pull-right">

	@if (in_array('view', $actions))
		@include('includes.admin.buttons.view')
	@endif

	@if (in_array('makeAdmin', $actions))
		@include('includes.admin.buttons.makeAdmin') 
	@endif	

	@if (in_array('duplicate', $actions))
		@include('includes.admin.buttons.duplicate') 
	@endif	

	@if (in_array('edit', $actions))
		@include('includes.admin.buttons.edit') 
	@endif

	@if (in_array('delete', $actions))
		@include('includes.admin.buttons.delete')
	@endif

</div>