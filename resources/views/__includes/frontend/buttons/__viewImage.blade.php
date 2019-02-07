@ability ('admin','recipes_print')
	<a href="" type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#viewImageModal">
		<div class="text text-left">
			<i class="fa fa-eye" aria-hidden="true"></i> View {{ ucfirst(str_singular($section_name)) }}
		</div>
	</a>&nbsp;
@endability