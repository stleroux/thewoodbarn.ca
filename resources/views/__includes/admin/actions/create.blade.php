@extends ('includes.admin.layouts.main')

<?php $titleTag = '| ' . ucfirst($action_name) . ' ' . str_singular(ucfirst($section_name)); ?>
@section ('title',"$titleTag")

@section ('stylesheets')
	@include('includes.admin.actions.styles')
@stop

@section('content')

	{!! Form::open(['route' => 'admin.' . $section_name . '.store']) !!}
		@include('includes.admin.layouts.body', ['name'=>ucfirst($section_name)])
	{!! Form::close() !!} 

@stop

@section ('scripts')
	@include('includes.admin.actions.scripts')
@stop
