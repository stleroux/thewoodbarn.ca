@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
  {!! Html::style('css/select2.min.css') !!}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('users.index') }}">Users</a></li>
  <li>Add USer</li>
@stop

@section('menubar')
  {!! Form::open(['route' => 'users.store']) !!}
    @include('layouts.buttons.cancel', ['name'=>'users'])
    @include('layouts.buttons.save', ['name'=>'users'])
@stop

@section('content')
  @include('layouts.partials.section_top', ['name'=>'Create User', 'icon'=>'fa-users'])
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-3 {{ $errors->has('username') ? 'has-error' : '' }}">
              <div class="form-group">
                {{ Form::label('username', 'Username', ['class'=>'required']) }}
                {{ Form::text('username', null, ['class'=>'form-control', 'autofocus'=>'autofocus']) }}
                <span class="text-danger">{{ $errors->first('username') }}</span>
              </div>
            </div>

            <div class="col-sm-3 {{ $errors->has('first_name') ? 'has-error' : '' }}">
              <div class="form-group">
                {{ Form::label('first_name', 'First Name', ['class'=>'required']) }}
                {{ Form::text('first_name', null, ['class'=>'form-control']) }}
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
            <div class="col-sm-3 {{ $errors->has('password') ? 'has-error' : '' }}">
              <div class="form-group">
                {{ Form::label('password', 'Password', ['class'=>'required']) }}
                {{ Form::password('password', ['class'=>'form-control']) }}
                <span class="text-danger">{{ $errors->first('password') }}</span>
              </div>
            </div>

            <div class="col-sm-3 {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
              <div class="form-group">
                {{ Form::label('password_confirmation', 'Confirm Password', ['class'=>'required']) }}
                {{ Form::password('password_confirmation', ['class'=>'form-control']) }}
                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
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
            <div class="col-sm-12 {{ $errors->has('roles') ? 'has-error' : '' }}">
              <div class="form-group">
                {{ Form::label('roles', 'Roles', ['class'=>'required']) }}
                {{ Form::select('roles[]', $roles,[], array('class' => 'form-control select2-multi','multiple')) }}
                <span class="text-danger">{{ $errors->first('roles') }}</span>
              </div>
            </div>
          </div>
        </div>
    @include('layouts.create_edit_panel_footer')
    @include('layouts.partials.section_close')
{{ Form::close() }}
@stop

@section ('scripts')
    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
        $('.select2-multi').select2();
    </script>
@stop