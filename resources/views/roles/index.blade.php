@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Roles</li>
@stop

@section('menubar')
  @include('layouts.dropdowns.import', ['name'=>'roles'])
  @include('layouts.buttons.dashboard')
  @include('layouts.buttons.add', ['name'=>'roles'])
@stop

@section('content')
@include('layouts.partials.section_top', ['name'=>'Roles', 'icon'=>'fa-circle'])
        <div class="panel-body">
          <table id="datatable" class="table table-hover table-striped table-condensed">
            <thead>
              <tr>
                {{-- <th>ID</th> --}}
                <th>Name</th>
                <th class="hidden-xs">Display Name</th>
                <th class="hidden-xs">Description</th>
                <th class="hidden-sm hidden-xs">Created On</th>
                <th data-orderable="false"></th>
              </tr>
            </thead>
            <tbody>
            {{-- @foreach ($roles as $key => $role) --}}
            @foreach ($roles as $role)
              <tr>
                {{-- <td>{{ $role->id }}</td> --}}
                <td><a href="{{ route('roles.show', $role->id) }}">{{ $role->name }}</a></td>
                <td class="hidden-xs">{{ $role->display_name }}</td>
                <td class="hidden-xs">{{ $role->description }}</td>
                <td class="hidden-sm hidden-xs">@include('layouts.dateFormat', ['model'=>$role, 'field'=>'created_at'])</td>
                <td class="text-right">
                  {{--================================================================================================================================--}}
                  {{-- EDIT BUTTON                                                                                                                    --}}
                  {{--================================================================================================================================--}}
                  {{-- @ability('admin', 'admin,roles_edit,roles_edit_admin') --}}
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=Edit' : '' }}>
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
                  {{-- DELETE BUTTON                                                                                                                  --}}
                  {{--================================================================================================================================--}}
                  {{-- @ability('admin', 'admin,roles_delete,roles_delete_admin') --}}
                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}" accept-charset="UTF-8" style="display:inline">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <button
                        class="btn btn-danger btn-xs"
                        {{ Auth::user()->actionButtons == 2 ? 'title=Delete' : '' }}
                        type="button"
                        data-toggle="modal"
                        data-id="{{ $role->id }}"
                        data-target="#confirmDelete"
                        data-title="Delete Role"
                        data-message="Are you sure you want to delete this role?">
                          @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="glyphicon glyphicon-trash"></i> Delete
                          @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="glyphicon glyphicon-trash"></i>
                          @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}Delete
                          @endif
                      </button>
                    </form>
                  {{-- @endability --}}
                  {{--================================================================================================================================--}}
                  {{-- END DELETE BUTTON                                                                                                              --}}
                  {{--================================================================================================================================--}}
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      @include('layouts.partials.section_close')
@stop