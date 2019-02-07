@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.roles.index') }}">Roles</a></li>
  <li>Add Role</li>
@stop

@section('page_top_menu')
{!! Form::open(['route' => 'admin.roles.store']) !!}
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- CANCEL BUTTON                                                                                                                  --}}
          {{--================================================================================================================================--}}
          <a href="{{ route('admin.roles.index') }}" class="btn btn-default btn-xs">
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
          {{ Form::button('<i class="fa fa-save"></i> Save Role', array('type' => 'submit', 'class' => 'btn btn-success btn-xs')) }}
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
        <div class="panel-heading">Add Role</div>
        <div class="panel-body">
          @include('layouts.common.displayErrorsWarning')
          {{-- NOTES/INSTRUCTIONS ABOUT PERMISSIONS --}}
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div id="click_advance">
              <a class="btn btn-primary btn-block" role="button" data-toggle="collapse" href="#instructions" aria-expanded="false" aria-controls="instructions">
                <div class="text text-left">
                  Instructions
                  <i class="fa fa-plus-square pull-right" aria-hidden="true"></i>
                </div>
              </a>
            </div>

            <!-- collapse contain -->
            <div class="collapse" id="instructions">
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
            </div>
            <!-- collapse contain end -->
            <br />
          </div>

          <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
              {{ Form::label('name', 'Internal Name', ['class'=>'required']) }}
              {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'autofocus')) !!}
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
{{Form::close() }}
@stop

@section ('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@stop 