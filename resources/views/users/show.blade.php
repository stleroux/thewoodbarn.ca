@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('users.index') }}">Users</a></li>
  <li>Show User</li>
@stop

@section('menubar')
          {{--================================================================================================================================--}}
          {{-- BACK TO CONTROL PANEL BUTTON                                                                                                   --}}
          {{--================================================================================================================================--}}
          @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'admin')
            <a class="btn btn-default btn-xs" href="{{ route('admin') }}">
              @if(Auth::user()->actionButtons == 1){{-- Icons and Text --}}<i class="glyphicon glyphicon-cog"></i> Control Panel
              @elseif(Auth::user()->actionButtons == 2){{-- Icons Only --}}<i class="glyphicon glyphicon-cog"></i>
              @elseif(Auth::user()->actionButtons == 3){{-- Text Only --}}Control Panel
              @endif
            </a>
          @endif
          {{--================================================================================================================================--}}
          {{-- END BACK TO CONTROL PANEL BUTTON                                                                                               --}}
          {{--================================================================================================================================--}}

          {{--================================================================================================================================--}}
          {{-- EDIT BUTTON                                                                                                                    --}}
          {{--================================================================================================================================--}}
          {{-- @ability('admin', 'admin,users_edit,users_edit_admin') --}}
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=Edit' : '' }}>
              @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}} <i class="glyphicon glyphicon-pencil"></i> Edit
              @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}} <i class="glyphicon glyphicon-pencil"></i>
              @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}} Edit
              @endif
            </a>
          {{-- @endability --}}
          {{--================================================================================================================================--}}
          {{-- END EDIT BUTTON                                                                                                                --}}
          {{--================================================================================================================================--}}
          {{--================================================================================================================================--}}
          {{-- INDEX BUTTON                                                                                                                   --}}
          {{--================================================================================================================================--}}
          <a class="btn btn-default btn-xs" href="{{ route('users.index') }}">
            <div class="text text-left">
              <i class="fa fa-list"></i> Users List
            </div>
          </a>
          {{--================================================================================================================================--}}
          {{-- END INDEX BUTTON                                                                                                               --}}
          {{--================================================================================================================================--}}
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading"><b>User Permissions</b> :: {{ $user->first_name }} {{ $user->last_name }} ({{ $user->email }})</div>
        <div class="panel-body">
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">Personal Info</div>
              <div class="panel-body">
                <table>
                  <tr>
                    <th width='120px'>First Name</th>
                    <td>{{ $user->first_name }}</td>
                  </tr>
                  <tr>
                    <th>Last Name</th>
                    <td>{{ $user->last_name }}</td>
                  </tr>
                  <tr>
                    <th>Email Address</th>
                    <td>{{ $user->email }}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
  	<div class="col-md-12">
    	<div class="panel panel-default">
        <div class="panel-heading">Account Information</div>
    		<div class="panel-body">
          <div class="col-md-4">
            @include ('users/panels/creation_info')
          </div>
          <div class="col-md-3">
            @include ('users/panels/role_info')
          </div>
          <div class="col-md-2">
            <div class="panel panel-default">
              <div class="panel-heading">Active</div>
              <div class="panel-body">
                @if ($user->active)
                  <i class="fa fa-check" aria-hidden="true"></i>
                @else
                  <i class="fa fa-ban" aria-hidden="true"></i>
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading">Show Email</div>
              <div class="panel-body">
                @if ($user->show_email)
                  <i class="fa fa-check" aria-hidden="true"></i>
                @else
                  <i class="fa fa-ban" aria-hidden="true"></i>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section ('scripts')
@stop
