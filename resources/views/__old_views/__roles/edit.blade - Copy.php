@extends ('layouts.main')

@section ('title', '| ')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@stop 
 
@section('content')
    {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit Role
                        <div class="pull-right">
                            <button type="submit" class="btn btn-info btn-xs">Submit</button>
                            <a class="btn btn-primary btn-xs" href="{{ route('roles.index') }}">Cancel</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class=" panel panel-default">
                                    <div class="panel-heading">Name:</div>
                                    <div class="panel-body">
                                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Display Name:</div>
                                    <div class="panel-body">
                                        {!! Form::text('display_name', null, array('placeholder' => 'Display Name','class' => 'form-control')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Description:</div>
                                    <div class="panel-body">
                                        {!! Form::textarea('description', null, array('rows'=>'2', 'placeholder' => 'Description','class' => 'form-control')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Permission:</div>
                                    <div class="panel-body">
                                        <?php $tmpHead = ''; ?>
                                        @foreach($permission as $value)
                                        <?php $split = explode("_", $value->name); ?>
                                        @if($tmpHead != $split[0])
                                            <?php $tmpHead = $split[0]; ?>
                                            <p>
                                            <strong><div class="text text-danger">{!! ucfirst($tmpHead) !!}</div></strong>
                                        @endif
                                        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                            {{ str_replace($tmpHead, '', $value->display_name) }}
                                        </label>
                                        &nbsp;&nbsp;
                                        @endforeach
                                        {{ Form::checkbox('personal', 1, null, ['data-toggle=toggle', 'data-on="Yes"', 'data-off="No"', 'data-onstyle="success"', 'data-offstyle="danger"']) }}
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
