@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.permissions.index') }}">Permissions</a></li>
  <li>Edit Permission</li>
@stop

@section('page_top_menu')
{!! Form::model($permission, ['route'=>['admin.permissions.update', $permission->id], 'method' => 'PUT']) !!}
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- CANCEL BUTTON                                                                                                                  --}}
          {{--================================================================================================================================--}}
          <a href="{{ route('admin.permissions.index') }}" class="btn btn-default btn-xs">
            <div class="text text-left">
              @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-ban" aria-hidden="true"></i> Cancel
              @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-ban" aria-hidden="true"></i>
              @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}Cancel
              @endif
            </div>
          </a>
          {{--================================================================================================================================--}}
          {{-- END CANCEL BUTTON                                                                                                              --}}
          {{--================================================================================================================================--}}

          {{--================================================================================================================================--}}
          {{-- UPDATE BUTTON                                                                                                                  --}}
          {{--================================================================================================================================--}}
          {{ Form::button('<i class="fa fa-save"></i> Update Permission', array('type' => 'submit', 'class' => 'btn btn-primary btn-xs')) }}
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
        <div class="panel-heading">Edit Permission</div>
        <div class="panel-body">
          @include('layouts.common.displayErrorsWarning')
          <div class="row">
            <div class="col-xs-5 col-sm-5">
              <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label("name", "Internal Name", ['class'=>'required']) !!}
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'autofocus')) !!}
                <span class="text-danger">{{ $errors->first('name') }}</span>
              </div>
            </div>
            <div class="col-xs-5 col-sm-5">
              <div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
                {!! Form::label("display_name", "Display name", ['class'=>'required']) !!}
                {!! Form::text('display_name', null, array('placeholder' => 'Display Name','class' => 'form-control')) !!}
                <span class="text-danger">{{ $errors->first('display_name') }}</span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-5 col-sm-5">
              <div class="form-group">
                {!! Form::label("admin", "Admin?") !!}
                  {{-- http://nielson.io/2014/02/handling-checkbox-input-in-laravel/ --}}
                 {{--  {{ Form::hidden('admin', 0) }} --}}
                  {{ Form::checkbox('admin', '1', $permission->admin, ['data-toggle=toggle', 'data-on="Yes"', 'data-off="No"', 'data-onstyle="success"', 'data-offstyle="danger"', 'data-size="mini"']) }}
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-sm-12">
              <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                {{ Form::label('description', 'Description', ['class'=>'required']) }}
                {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
                <span class="text-danger">{{ $errors->first('description') }}</span>
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
@stop

@section ('scripts')
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@stop