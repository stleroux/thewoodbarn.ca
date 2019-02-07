@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Users</li>
@stop

@section('menubar')
  @include('layouts.dropdowns.import', ['name'=>'users'])
  @include('layouts.buttons.dashboard')
  @include('layouts.buttons.add', ['name'=>'users'])
@stop

@section('content')
  @include('layouts.partials.section_top', ['name'=>'Users', 'icon'=>'fa-users'])
        <div class="panel-body">
          <table id="datatable" class="table table-hover table-striped table-condensed">
            <thead>
              <tr>
                <th>Username</th>
                <th>Email</th>
                <th class="hidden-sm hidden-xs">SR</th>
                <th class="hidden-sm hidden-xs">Logins</th>
                <th class="hidden-sm hidden-xs">Active</th>
                <th>Roles</th>
                <th class="hidden-sm hidden-xs">Update Date</th>
                <th data-orderable="false"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>
                    <a href="#"
                    type="button"
                    data-html="true"
                    class="{{ (!$user->active)?'text text-danger':''}}"
                    style="text-decoration:none;"
                    data-toggle="popover"
                    title="User Information"
                    data-content="
                      <table>
                      <tr>
                      <td align='right'>User ID :</td>
                      <td>&nbsp;{{ $user->id }}</td>
                      </tr>
                      <tr>
                      <td>First Name :</td>
                      <td>&nbsp;{{ $user->first_name }}</td>
                      </tr>
                      <tr>
                      <td>Last Name :</td>
                      <td>&nbsp;{{ $user->last_name }}</td>
                      </tr>
                      </table>
                    ">{{ $user->username }}</a>
                  </td>
                  <td>
                    <div class="{{ (!$user->active)?'text text-danger':''}}">
                      {{ $user->email }}
                    </div>
                  </td>
                  <td class="hidden-sm hidden-xs">
                    <div class="{{ (!$user->active)?'text text-danger':''}}">
                      {{ ($user->selfRegistered == 1)? 'Yes':'No' }}
                    </div>
                  </td>
                  <td class="hidden-sm hidden-xs">
                    <div class="{{ (!$user->active)?'text text-danger':''}}">
                      {{ $user->login_count }}
                    </div>
                  </td>
                  <td class="hidden-sm hidden-xs">
                    @if ($user->active)
                      <i class="fa fa-check" aria-hidden="true"></i>
                    @else
                      <div class="{{ (!$user->active)?'text text-danger':''}}">
                        <i class="fa fa-ban" aria-hidden="true"></i>
                      </div>
                    @endif
                  </td>
                  <td>
                    <div class="{{ (!$user->active)?'text text-danger':''}}">
                      {{ ucfirst($user->role->name) }} <small>({{ $user->role->id }})</small>
                    </div>
                  </td>
                  <td class="hidden-sm hidden-xs">
                    <div class="{{ (!$user->active)?'text text-danger':''}}">
                      {{ date('M j, Y', strtotime($user->updated_at)) }}
                    </div>
                  </td>
                  <td>
                    @if(checkACL('manager'))
                      <div class="btn-group pull-right">
                        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Options <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="{{ route('users.show',$user->id) }}">
                              <i class="fa fa-eye fa-fw text-info"></i>
                              <span class="text text-info">View</span>
                            </a>
                          </li>
                          @if(checkACL('manager'))
                            @if (!$user->active)
                              <li>
                                <a href="{{ route('users.activate', $user->id) }}">
                                  <i class="fa fa-check-circle-o fa-fw text-primary" aria-hidden="true"></i>
                                  <span class="text text-primary">Activate</span>
                                </a>
                              </li>
                            @else
                              <li>
                                <a href="{{ route('users.deactivate', $user->id) }}">
                                  <i class="fa fa-times-circle-o fa-fw text-warning" aria-hidden="true"></i>
                                  <span class="text text-warning">Deactivate</span>
                                </a>
                              </li>
                            @endif
                          @endif
                          @if(checkACL('admin'))
                            <li>
                              <a href="{{ route('users.edit',$user->id) }}">
                                <i class="fa fa-pencil-square-o fa-fw text-success" aria-hidden="true"></i>
                                <span class="text text-success">Edit</span>
                              </a>
                            </li>
                          @endif
                          @if(checkACL('superadmin'))
                            <li>
                              <a href="{{ route('users.delete', $user->id) }}">
                                <i class="fa fa-trash-o fa-fw text-danger"></i>
                                <span class="text text-danger">Delete</span>
                              </a>
                            </li>
                          @endif
                        </ul>
                      </div>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="panel-footer">
          LEGEND : <br />
          SR => Self Registered account
        </div>
      </div>
    </div>
  </div>
@stop
