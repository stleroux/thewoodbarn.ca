<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			{{-- <div class="panel-heading">

				{{ ucfirst($action_name) }} {{ ucfirst(str_singular($section_name)) }}
				
				<div class="pull-right">
					@include('includes.frontend.actions.menu', ['name'=>$section_name])
				</div> --}}
				@include('includes.frontend.panelHeader')
			{{-- </div> --}}
			<div class="panel-body">
				@include('includes.frontend.partials._displayErrorsWarning')
				@include('frontend.'. $section_name . '.form')
			</div>
			@include('includes.frontend.panelFooter')
		</div>
	</div>
</div>