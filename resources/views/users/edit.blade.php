@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
  {!! Html::style('css/select2.min.css') !!}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('users.index') }}">Users</a></li>
  <li>Edit User</li>
@stop

@section('menubar')
  {!! Form::model($user, ['route'=>['users.update', $user->id], 'method' => 'PUT']) !!}
    @include('layouts.buttons.cancel', ['name'=>'users'])
    @include('layouts.buttons.update', ['name'=>'users'])
@stop

@section('content')
  @include('layouts.partials.section_top', ['name'=>'Edit User', 'icon'=>'fa-user'])
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-3 {{ $errors->has('username') ? 'has-error' : '' }}">
              <div class="form-group">
                {{ Form::label('username', 'Username', ['class'=>'required']) }}
                {{ Form::text('username', null, ['class'=>'form-control']) }}
                <span class="text-danger">{{ $errors->first('username') }}</span>
              </div>
            </div>

            <div class="col-sm-3 {{ $errors->has('first_name') ? 'has-error' : '' }}">
              <div class="form-group">
                {{ Form::label('first_name', 'First Name', ['class'=>'required']) }}
                {{ Form::text('first_name', null, ['class'=>'form-control', 'autofocus'=>'autofocus', "onfocus"=>"this.focus();this.select()"]) }}
                <span class="text-danger">{{ $errors->first('first_name') }}</span>
              </div>
            </div>

            <div class="col-sm-3 {{ $errors->has('last_name') ? 'has-error' : '' }}">
              <div class="form-group">
                {{ Form::label('last_name', 'Last Name', ['class'=>'required']) }}
                {{ Form::text('last_name', null, ['class'=>'form-control']) }}
                <span class="text-danger">{{ $errors->first('last_name') }}</span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 {{ $errors->has('email') ? 'has-error' : '' }}">
              <div class="form-group">
                {{ Form::label('email', 'Email', ['class'=>'required']) }}
                {{ Form::email('email', null, ['class'=>'form-control']) }}
                <span class="text-danger">{{ $errors->first('email') }}</span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 {{ $errors->has('role') ? 'has-error' : '' }}">
              <div class="form-group">
                {{ Form::label('role_id', 'Role', ['class'=>'required']) }}
                {{-- {{ Form::select('role_id', array(''=>'Select a role') + $roles, null, ['class'=>'form-control']) }} --}}
                {{ Form::select('role_id', $roles, null, ['class'=>'form-control']) }}

                <span class="text-danger">{{ $errors->first('role') }}</span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-danger">
                <div class="panel-heading">Enter password only to replace the existing one</div>
                <div class="panel-body">
                  <div class="col-sm-3 {{ $errors->has('password') ? 'has-error' : '' }}">
                    <div class="form-group">
                      {{ Form::label('password', 'Password') }}
                      {{ Form::password('password', ['class'=>'form-control']) }}
                      <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                  </div>

                  <div class="col-sm-3 {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <div class="form-group">
                      {{ Form::label('password_confirmation', 'Confirm Password') }}
                      {{ Form::password('password_confirmation', ['class'=>'form-control']) }}
                      <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-footer">
          <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
        </div>
      </div>
    </div>
  </div>
{{ Form::close() }}
@stop

@section ('scripts')
{{--     {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
        $('.select2-multi').select2();
        // set the values
        $('.select2-multi').select2().val({!! json_encode($user->roles()->getRelatedIds()) !!}).trigger('change');
    </script> --}}
@stop