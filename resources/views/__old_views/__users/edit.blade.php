@extends ('layouts.main')

@section ('title', '| Edit User')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
    {!! Html::style('css/select2.min.css') !!}
@stop

@section ('content')
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="{{ route('users.index') }}">Users</a></li>
      <li class="active">Edit</li>
    </ol>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit User</div>
                <div class="panel-body">
                    {!! Form::model($user, ['method'=>'PATCH', 'route'=>['users.update', $user->id]]) !!}
                   	<div class="row">
                   		<div class="col-md-9">

                            @include('partials._displayErrorsWarning')

                       		<div class="panel panel-default">
                                <div class="panel-heading">Account Information</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4 {{ $errors->has('username') ? 'has-error' : '' }}">
                                            <div class="input-group input-group-sm">
                                                {{ Form::label ('username', 'Username:') }}
                                                {{ Form::text ('username', null, ['class' => 'form-control', 'autofocus']) }}
                                            </div>
                                            <span class="text-danger">{{ $errors->first('username') }}</span>
                                        </div>

                                       	<div class="col-md-4 {{ $errors->has('first_name') ? 'has-error' : '' }}">
                                            <div class="input-group input-group-sm">
                       						   {{ Form::label ('first_name', 'First Name:') }}
                       						   {{ Form::text ('first_name', null, ['class' => 'form-control']) }}
                                            </div>
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                       					</div>
                	       				<div class="col-md-4 {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                            <div class="input-group input-group-sm">
                                                {{ Form::label ('last_name', 'Last Name:') }}
                                                {{ Form::text ('last_name', null, ['class' => 'form-control']) }}
                                            </div>
                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                					   </div>

                                    </div>
                                    
                                    <div class="row">
                                        <div>&nbsp;</div>
                                    </div>
                                    
                                    <div class="row">
                    					<div class="col-md-9 {{ $errors->has('email') ? 'has-error' : '' }}">
                                            <div class="input-group input-group-sm">
                    						  {{ Form::label ('email', 'Email Address:') }}
                    						  {{ Form::text ('email', null, ['class' => 'form-control']) }}
                                            </div>
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                    					</div>
                                    </div>

                                    <div class="row">
                                        <div>&nbsp;</div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12 {{ $errors->has('roles') ? 'has-error' : '' }}">
                                            <div class="select-group select-group-sm">
                                                {{ Form::label ('roles', 'Roles:') }}
                                                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control select2-multi','multiple')) !!}
                                            </div>
                                            <span class="text-danger">{{ $errors->first('roles') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        
                        <!-- Sidebar -->
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">Options</div>
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        {{ Form::submit('Update User', ['class' => 'btn btn-success btn-sm btn-block']) }}
                                        @if ($user->active)
                                            <a href="{{ route('users.deactivate', $user->id) }}" class="btn btn-danger btn-sm btn-block">Deactivate User</a>
                                        @else
                                            <a href="{{ route('users.activate', $user->id) }}" class="btn btn-info btn-sm btn-block">Activate User</a>
                                        @endif
                                        <a href="{{ route('users.index') }}" class="btn btn-default btn-sm btn-block">Cancel</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {!! Form::close() !!}

                    <div class="row">
                        <div class="col-md-9">
                            <div class="panel panel-default">
                                <div class="panel-heading">Dates</div>
                                <div class="panel-body">
                                    <div class="col-md-3">
                                        <div><b>Created On :</b></div>
                                        <div>{{ $user->created_at }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div><b>Last Updated On :</b></div>
                                        <div>{{ $user->updated_at }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Password reset section begin -->
                    @ability('admin', 'users_reset_password')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Reset Password for {{ $user->first_name}} {{ $user->last_name}}</div>
                                <div class="panel-body">
                                {!! Form::model($user, ['route'=>['users.updatePassword', $user->id], 'method' => 'POST']) !!}
                                    <div class="col-md-4 {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <div class="input-group input-group-sm">
                                            {{ Form::label('password', 'New Password:') }}
                                            {{ Form::password('password', ['class'=>'form-control', 'autofocus']) }}
                                        </div>
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    </div>
                                    <div class="col-md-4 {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                        <div class="input-group input-group-sm">
                                            {{ Form::label('password_confirmation', 'Confirm New Password:') }}
                                            {{ Form::password('password_confirmation', ['class'=>'form-control']) }}
                                        </div>
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    </div>
                                    <div class="col-md-2 col-md-offset-2">
                                        <div class="button-group button-group-sm">
                                            {{ Form::submit('Change Password', ['class'=>'btn btn-primary btn-block btn-sm']) }}
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endability
                    <!-- Password reset section end -->

                </div>
            </div>
        </div>
    </div>
@stop

@section ('scripts')
    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
        $('.select2-multi').select2();
        // set the values
        $('.select2-multi').select2().val({!! json_encode($user->roles()->getRelatedIds()) !!}).trigger('change');
    </script>
@stop