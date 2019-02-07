@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.roles.index') }}">Roles</a></li>
  <li>Show Role</li>
@stop

@section('page_top_menu')
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- INDEX BUTTON                                                                                                                   --}}
          {{--================================================================================================================================--}}
          <a class="btn btn-default btn-xs btn-block" href="{{ route('admin.roles.index') }}">
            <div class="text text-left">
              <i class="fa fa-list"></i> Roles List
            </div>
          </a>
          {{--================================================================================================================================--}}
          {{-- END INDEX BUTTON                                                                                                               --}}
          {{--================================================================================================================================--}}
        </div>
      </div>
    </div>
  </div>
@stop

@section('content')
  <div class="col-xs-12 col-sm-12 col-md-6">
    <div class="form-group">
      {{ Form::label('name', 'Internal Name') }}
      <div class="well well-sm">{!! $role->name !!}</div>
    </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-6">
    <div class="form-group">
      {{ Form::label('display_name', 'Display Name') }}
      <div class="well well-sm">{!! $role->display_name !!}</div>
    </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
      {{ Form::label('description', 'Description') }}
      <div class="well well-sm">{!! $role->description !!}</div>
    </div>
  </div>
{{-- 
  <div class="col-sm-6">
    <div class="panel panel-default">
      <div class="panel-heading">Permissions:</div>
      <div class="panel-body">
        @if(!empty($rolePermissions))
          @php $tmpHead = ''; @endphp
          @foreach($rolePermissions as $value)
            @php $split = explode("_", $value->name); @endphp
            @if($tmpHead != $split[0])
              @php $tmpHead = $split[0]; @endphp
              <p>
                <strong><div class="text text-danger">{!! ucfirst($tmpHead) !!}</div></strong>
              </p>
            @endif
            <i class="fa fa-minus" aria-hidden="true"></i> {{ str_replace($tmpHead, '', $value->display_name) }}&nbsp;&nbsp;
          @endforeach
        @endif
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="panel panel-default">
      <div class="panel-heading">Admin Permissions:</div>
      <div class="panel-body">
        @if(!empty($rolePermissionsAdmin))
          @php $tmpHead = ''; @endphp
          @foreach($rolePermissionsAdmin as $value)
            @php $split = explode("_", $value->name); @endphp
            @if($tmpHead != $split[0])
              @php $tmpHead = $split[0]; @endphp
              <p>
              <strong><div class="text text-danger">{!! ucfirst($tmpHead) !!}</div></strong></p>
            @endif
            <i class="fa fa-minus" aria-hidden="true"></i> {{ str_replace($tmpHead, '', $value->display_name) }}&nbsp;&nbsp;
          @endforeach
        @endif
      </div>
    </div>
  </div> --}}
@stop

@section ('scripts')
@stop 
