@extends ('layouts.admin.main')

@section ('title', '')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li>Test 1</li>
@stop

@section ('content')

@stop

@section ('scripts')
@stop