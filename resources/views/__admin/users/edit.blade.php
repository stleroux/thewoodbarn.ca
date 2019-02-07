@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
  {!! Html::style('css/select2.min.css') !!}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.users.index') }}">Users</a></li>
  <li>Edit User</li>
@stop

@section('page_top_menu')
{!! Form::model($user, ['route'=>['admin.users.update', $user->id], 'method' => 'PUT']) !!}
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- INDEX BUTTON                                                                                                                   --}}
          {{--================================================================================================================================--}}
          <a href="{{ route('admin.users.index') }}" class="btn btn-default btn-xs">
            <div class="text text-left">
              @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-ban" aria-hidden="true"></i> Cancel
              @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-ban" aria-hidden="true"></i>
              @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}Cancel
              @endif
            </div>
          </a>
          {{--================================================================================================================================--}}
          {{-- END INDEX BUTTON                                                                                                               --}}
          {{--================================================================================================================================--}}

          {{--================================================================================================================================--}}
          {{-- UPDATE BUTTON                                                                                                                  --}}
          {{--================================================================================================================================--}}
          {{ Form::button('<i class="fa fa-save"></i> Update User', array('type' => 'submit', 'class' => 'btn btn-primary btn-xs')) }}
          {{--================================================================================================================================--}}
          {{-- END UPDATE BUTTON                                                                                                              --}}
          {{--================================================================================================================================--}}
        </div>
      </div>
    </div>
  </div>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Edit User</div>
        <div class="panel-body">
          @include('layouts.common.displayErrorsWarning')
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