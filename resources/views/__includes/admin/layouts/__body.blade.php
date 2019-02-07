<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">

				{{ ucfirst($action_name) }} {{ ucfirst(str_singular($section_name)) }}
				
				<div class="pull-right">
					@include('includes.admin.actions.menu', ['name'=>$section_name])
				</div>
			</div>
			<div class="panel-body">
				@include('layouts.common.displayErrorsWarning')
				@include('admin.'. $section_name . '.form')
			</div>
			@include('includes.admin.layouts.panelFooter')
		</div>
	</div>
</div>