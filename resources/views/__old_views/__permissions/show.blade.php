@extends ('layouts.main')

@section ('title', '| ')

@section ('stylesheets')
	{{ Html::style('css/admin.css') }}
@stop 
 
@section('content')

	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
		<li class="active">Permissions</li>
	</ol>

	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Show Permission</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('permissions.index') }}"> Back</a>
	        </div>
	    </div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Internal Name:</strong>
                {{ $permission->display_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $permission->description }}
            </div>
        </div>
	</div>
@stop

@section ('scripts')
@stop 