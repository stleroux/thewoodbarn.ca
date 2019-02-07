@extends ('includes.admin.layouts.main')

@section ('title', '| ' . ucfirst($section_name))

@section ('stylesheets')
	{{ Html::style('css/admin.css') }}
@stop

@section ('content')
	
	<div class="panel panel-default">
		@include('includes.admin.layouts.panelHeader')
		
		<div class="panel-body">
			@if (count($$section_name) > 0)
				{{-- Do something here --}}
				@include('admin.'.$section_name.'.index')
			@else
				<div class="row">
					<div class="col-md-12">
						<div class="text text-danger">No {{ $section_name }} records found</div>
					</div>
				</div>
			@endif
		</div>
		{{-- Add footer section to individual index page to display the footer content here --}}
		@yield('footer')
	</div>

@stop

@section ('scripts')
@stop