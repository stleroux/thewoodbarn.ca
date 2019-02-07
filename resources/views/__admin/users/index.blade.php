@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li>Users</li>
@stop

@section('page_top_menu')
  <div class="well well-sm clearfix">
    <div class="pull-right">
      {{--================================================================================================================================--}}
      {{-- IMPORT / EXPORT DROPDOWN                                                                                                       --}}
      {{--================================================================================================================================--}}
      @if(checkACL('admin'))
        <div class="btn-group">
          <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-refresh" aria-hidden="true"></i>
            Import / Export <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="{{ route('admin.users.import') }}"><i class="fa fa-upload" aria-hidden="true"></i> Import Data</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::to('admin/users/downloadExcel/xls') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLS</a></li>
            <li><a href="{{ URL::to('admin/users/downloadExcel/xlsx') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLSX</a></li>
            <li><a href="{{ URL::to('admin/users/downloadExcel/csv') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i>Download as CSV</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::to('admin/users/exportPDF') }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF</a></li>
          </ul>
        </div>
      @endif
      {{--================================================================================================================================--}}
      {{-- END IMPORT / EXPORT DROPDOWN                                                                                                   --}}
      {{--================================================================================================================================--}}

      {{--================================================================================================================================--}}
      {{-- ADD BUTTON                                                                                                                     --}}
      {{--================================================================================================================================--}}
      @if(checkACL('admin'))
        <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-xs">
          @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-plus-square" aria-hidden="true"></i> New User
          @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-plus-square" aria-hidden="true"></i>
          @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}New User
          @endif
        </a>
      @endif
      {{--================================================================================================================================--}}
      {{-- END ADD BUTTON                                                                                                                 --}}
      {{--================================================================================================================================--}}
    </div>
  </div>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
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
                {{ ucfirst($user->role->name) }} <small>({{ $user->role->id }})</small>
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
                        <a href="{{ route('admin.users.show',$user->id) }}">
                          <i class="fa fa-eye fa-fw text-info"></i>
                          <span class="text text-info">View</span>
                        </a>
                      </li>
                      @if(checkACL('manager'))
                        @if (!$user->active)
                          <li>
                            <a href="{{ route('admin.users.activate', $user->id) }}">
                              <i class="fa fa-check-circle-o fa-fw text-primary" aria-hidden="true"></i>
                              <span class="text text-primary">Activate</span>
                            </a>
                          </li>
                        @else
                          <li>
                            <a href="{{ route('admin.users.deactivate', $user->id) }}">
                              <i class="fa fa-times-circle-o fa-fw text-warning" aria-hidden="true"></i>
                              <span class="text text-warning">Deactivate</span>
                            </a>
                          </li>
                        @endif
                      @endif
                      @if(checkACL('admin'))
                        <li>
                          <a href="{{ route('admin.users.edit',$user->id) }}">
                            <i class="fa fa-pencil-square-o fa-fw text-success" aria-hidden="true"></i>
                            <span class="text text-success">Edit</span>
                          </a>
                        </li>
                      @endif
                      @if(checkACL('superadmin'))
                        <li>
                          <a href="{{ route('admin.users.delete', $user->id) }}">
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
  </div>
@stop

@section('footer')
  <div class="panel-footer visible-lg visible-md">
    LEGEND : <br />
    SR => Self Registered account
  </div>
@stop


