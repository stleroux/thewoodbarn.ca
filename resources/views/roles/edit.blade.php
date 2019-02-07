@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('roles.index') }}">Roles</a></li>
  <li>Edit Role</li>
@stop

@section('menubar')
  {!! Form::model($role, ['route'=>['roles.update', $role->id], 'method' => 'PUT']) !!}
    @include('layouts.buttons.cancel', ['name'=>'roles'])
    @include('layouts.buttons.update', ['name'=>'roles'])
@stop

@section('content')
@include('layouts.partials.section_top', ['name'=>'Edit Role', 'icon'=>'fa-circle'])
        <div class="panel-body">
          {{-- NOTES/INSTRUCTIONS ABOUT PERMISSIONS --}}
{{--           <div class="col-xs-12 col-sm-12 col-md-12">
            <div id="click_advance">
              <a class="btn btn-primary btn-block" role="button" data-toggle="collapse" href="#instructions" aria-expanded="false" aria-controls="instructions">
                <div class="text text-left">
                  Instructions
                  <i class="fa fa-plus-square pull-right" aria-hidden="true"></i>
                </div>
              </a>
            </div>
            <div class="collapse" id="instructions"><!-- collapse contain -->
              <div class="well">
                <p>- You need to select at leadt 1 user permission</p>
                <p>- Admin permissions will override user permissions</p>
                <p>- Permissions are allowed centric</p>
                <p>-- Examples : </p>
                <p>--- Admin -> Articles -> Create -> No AND User -> Articles -> Create -> Yes => User will be able to add articles</p>
                <p>--- Admin -> Articles -> Edit All = Allowed AND User -> Articles -> Edit Own = Denied => User will be able to edit <b><u>All</u></b> articles in the system</p>
                <p>&nbsp;</p>
                <p><b><i>Enabling Super Admin will provide the user with God like access to the system. Use with EXTREME CAUTION.</i></b></p>
              </div>
            </div><!-- collapse contain end -->
            <br />
          </div> --}}
          <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
              {{ Form::label('name', 'Internal Name', ['class'=>'required']) }}
              {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'autofocus')) !!}
              <p class="small text-muted">&nbsp;&nbsp;[Changing the Internal name will require code updates]</p>
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
              {{ Form::label('display_name', 'Display Name', ['class'=>'required']) }}
              {!! Form::text('display_name', null, array('placeholder' => 'Display Name','class' => 'form-control')) !!}
              <span class="text-danger">{{ $errors->first('display_name') }}</span>
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
              {{ Form::label('description', 'Description', ['class'=>'required']) }}
              {!! Form::textarea('description', null, array('rows'=>'2', 'placeholder' => 'Description','class' => 'form-control')) !!}
              <span class="text-danger">{{ $errors->first('description') }}</span>
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
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@stop 