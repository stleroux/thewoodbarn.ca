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
	            <h2>Edit Permission</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('permissions.index') }}"> Back</a>
	        </div>
	    </div>
	</div>

	{!! Form::model($permission, ['method' => 'PATCH','route' => ['permissions.update', $permission->id]]) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Internal Name:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'autofocus')) !!}
            </div>
        </div>
        	<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Display Name:</strong>
                {!! Form::text('display_name', null, array('placeholder' => 'Display Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
        </div>
	</div>
	{!! Form::close() !!}
@stop

@section ('scripts')
@stop 