@extends ('includes.frontend.layouts.main')

@section ('title', '| ' . ucfirst($section_name))

@section ('stylesheets')
	@if($section_name == 'recipes')
		{{ Html::style('css/recipes.css') }}
	@else
		{{ Html::style('css/main.css') }}
	@endif
@stop

@section ('content')

	@php
		$model_name = str_singular($section_name);
	@endphp

	<div class="panel panel-default">
		@include('includes.frontend.panelHeader')
		
		<div class="panel-body">
			@if (count($$section_name) > 0)
				{{-- Do something here --}}
				@include('frontend.'.$section_name.'.index')
			@else
				<div class="row">
					<div class="col-md-12">
						@if($section_name == 'recipes')
							<div class="pull-right"><a href="{{ route($section_name.'.index','all') }}" class="btn btn-default btn-xs">Back</a></div>
						@else
							<div class="pull-right"><a href="{{ route($section_name.'.index') }}" class="btn btn-default btn-xs">Back</a></div>
						@endif
						<div class="text text-danger">No {{ $section_name }} found</div>
					</div>
				</div>
			@endif
		</div>
		
		{{-- Add footer section to individual index page to display the footer content here --}}
		@if(View::hasSection('footer'))
			<div class="panel-footer">
				@yield('footer')
			</div>
		@endif
		
	</div>

@stop

@section ('scripts')
@stop