@extends ('layouts.main')

@section ('title', '| ')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@stop 
 
@section('content')

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="active">Roles</li>
    </ol>
    
    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Create New Role
                        <div class="pull-right">
                            <button type="submit" class="btn btn-success btn-xs">Create Role</button>
                            <a class="btn btn-primary btn-xs" href="{{ route('roles.index') }}">Cancel</a>
                        </div>
                    </div>
                    <div class="panel-body">
                    	<div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Internal Name:</div>
                                    <div class="panel-body {{ $errors->has('name') ? 'has-error' : '' }}">
                                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'autofocus')) !!}
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                        		<div class="panel panel-default">
                                    <div class="panel-heading">Display Name:</div>
                                    <div class="panel-body {{ $errors->has('display_name') ? 'has-error' : '' }}">
                                        {!! Form::text('display_name', null, array('placeholder' => 'Display Name','class' => 'form-control')) !!}
                                        <span class="text-danger">{{ $errors->first('display_name') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Description:</div>
                                    <div class="panel-body {{ $errors->has('description') ? 'has-error' : '' }}">
                                        {!! Form::textarea('description', null, array('rows'=>'2', 'placeholder' => 'Description','class' => 'form-control')) !!}
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Permissions: (Select permissions for this Role)</div>
                                    <div class="panel-body">
                                        <span class="text-danger">{{ $errors->first('permission') }}</span>
                                        
                                        <?php $tmpHead = ''; ?>

                                        <div class="panel panel-primary panel-borderless">
                                            @foreach($permission as $value)
                                                <?php $split = explode("_", $value->name); ?>

                                                @if($tmpHead != $split[0])
                                                    <?php $tmpHead = $split[0]; ?>
                                                    <div class="panel-heading">{!! ucfirst($tmpHead) !!}</div>
                                                @endif

                                                <label style="font-weight:normal;">
                                                    {{ str_replace($tmpHead, '', $value->display_name) }}
                                                    <br />
                                                    {{ Form::checkbox('permission[]', $value->id, false, ['data-toggle=toggle', 'data-on="Yes"', 'data-off="No"', 'data-onstyle="success"', 'data-offstyle="danger"', 'data-size="mini"']) }}
                                                    <br /><br /><br />
                                                </label>
                                                &nbsp;&nbsp;
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <b><span class="text text-danger">CAUTION:</span></b> The Admin right superseeds all other given rigths. No other selection need be made.
                                    </div>
                                </div>
                            </div>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@stop

@section ('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@stop 
