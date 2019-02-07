@extends('includes.frontend.layouts.main')

<?php $titleTag = '| ' . ucfirst($action_name) . ' ' . str_singular(ucfirst($section_name)); ?>
@section ('title',"$titleTag")

@section ('stylesheets')
	@include('includes.frontend.actions.styles')
@stop

@section('content')

	@php
		$model_name = str_singular($section_name);
	@endphp

	{!! Form::model($$model_name, ['route'=>[$section_name.'.show', $$model_name->id], 'method' => 'PUT']) !!}
		@include('includes.frontend.body', ['name'=>ucfirst($section_name)])
	{!! Form::close() !!}

@stop

@section ('scripts')
	@include('includes.frontend.actions.scripts')
@stop