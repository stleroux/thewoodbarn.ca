@extends ('includes.admin.layouts.main')

@section ('title', '| ')

@section ('stylesheets')
	@include('includes.admin.actions.styles')
@stop

@section ('content')

	@php
		$model_name = str_singular($section_name);
	@endphp

	{!! Form::model($$model_name, ['route'=>['admin.'.$section_name.'.show', $$model_name->id], 'method' => 'PUT']) !!}
		@include('includes.admin.layouts.body', ['name'=>ucfirst($section_name)])
	{!! Form::close() !!}

@stop

@section ('scripts')
	@include('includes.admin.actions.scripts')
@stop