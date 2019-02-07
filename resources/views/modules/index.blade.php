@extends('layouts.main')

@section('title','| ')

@section('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Modules</li>
@stop

@section('menubar')
  @include('layouts.dropdowns.import', ['name'=>'modules'])
  @include('layouts.buttons.dashboard')
@stop

@section('content')

  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-cubes" aria-hidden="true"></i> Modules</div>
        <div class="panel-body">
          <table id="datatable" class="table table-hover table-condensed">
            <thead>
              <tr>
                <th>Name</th>
                <th data-orderable="false"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($modules as $module)
                <tr>
                  <td>{{ $module->name }}</td>
                  <td class="text-right">
                    {{--================================================================================================================================--}}
                    {{-- EDIT BUTTON                                                                                                                    --}}
                    {{--================================================================================================================================--}}
                    {{-- @ability('admin', 'modules_edit_admin') --}}
                      <a href="{{ route('modules.edit', $module->id) }}" class="btn btn-primary btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=Edit' : '' }}>
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
                    {{-- @ability('admin', 'admin,module_delete,modules_delete_admin') --}}
                      <form method="POST" action="{{ route('modules.destroy', $module->id) }}" accept-charset="UTF-8" style="display:inline">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button
                          class="btn btn-xs btn-danger"
                          {{ Auth::user()->actionButtons == 2 ? 'title=Delete' : '' }}
                          type="button"
                          data-toggle="modal"
                          data-id="{{ $module->id }}"
                          data-target="#confirmDelete"
                          data-title="Delete Module"
                          data-message="Are you sure you want to delete this module?">
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
      </div>
    </div>

    <div class="col-md-3">
      {{-- @ability('admin','modules_create') --}}
        {!! Form::open(['route' => 'modules.store']) !!}
          <div class="panel panel-default">
            <div class="panel-heading">New Module</div>
            <div class="panel-body">
              <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {{ Form::label('name', 'Name', ['class'=>'required']) }}
                {{ Form::text('name', null, ['class' => 'form-control input-sm', 'autofocus']) }}
                <span class="text-danger">{{ $errors->first('name') }}</span>
              </div>
              {{ Form::button('<div class="text text-left"><i class="fa fa-save" aria-hidden="true"></i> Save</div>', array('type' => 'submit', 'class' => 'btn btn-success btn-xs btn-block')) }}
            </div>
            <div class="panel-footer">
              <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
            </div>
        </div>
      {!! Form::close() !!}
    {{-- @endability --}}
  </div>

</div>

@stop