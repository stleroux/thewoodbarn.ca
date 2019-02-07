@extends ('layouts.main')

@section ('title', '| All Tasks')

@section ('stylesheets')
    {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Tasks</li>
@stop

@section('menubar')
  @include('layouts.dropdowns.import', ['name'=>'tasks'])
  @include('layouts.buttons.dashboard')
  {{-- @include('layouts.buttons.add', ['name'=>'tasks']) --}}
@stop

@section('content')
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-tasks" aria-hidden="true"></i> Tasks</div>
        <div class="panel-body">
          @if (count($tasks) > 0)
              <table id="datatable" class="table table-hover table-striped table-condensed ">
                  <thead>
                      <tr>
                          {{-- <th>#</th> --}}
                          <th>Name</th>
                          <th class="hidden-xs">Author</th>
                          <th class="hidden-xs">Created At</th>
                          @if (Auth::check())
                              <th data-orderable="false"></th>
                          @endif
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($tasks as $task)
                          <tr>
                            {{-- <th>{{ $task->id }}</th> --}}
                            <td>{{ $task->name }}</td>
                            <td class="hidden-xs">@include('layouts.author', ['model'=>$task, 'field'=>'user'])</td>
                            <td class="hidden-xs">@include('layouts.dateFormat', ['model'=>$task, 'field'=>'created_at'])</td>
                            <td class="text-right">
                              @include('layouts.buttons.duplicate', ['model'=>$task, 'name'=>'tasks', 'id'=>$task->id])
                              @include('layouts.buttons.edit', ['model'=>$task, 'name'=>'tasks', 'id'=>$task->id])
                              @include('layouts.buttons.delete', ['model'=>$task, 'name'=>'tasks', 'id'=>$task->id])
                            </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          @else
              <div class="alert alert-danger">No records found</div>
          @endif
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">New Task</div>
        <div class="panel-body">
            {!! Form::open(['route' => 'tasks.store', 'method'=> 'POST']) !!}
              <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {{ Form::label('name', 'Name', ['class'=>'required']) }}
                {{ Form::text('name', null, ['class' => 'form-control input-sm', 'autofocus'=>'autofocus']) }}
                <span class="text-danger">{{ $errors->first('name') }}</span>
              </div>
              {{ Form::button('<div class="text text-left"><i class="fa fa-save" aria-hidden="true"></i> Save</div>', array('type' => 'submit', 'class' => 'btn btn-success btn-xs btn-block')) }}
            {!! Form::close() !!}
          {{-- @endability --}}
        </div>
        <div class="panel-footer">
          <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
        </div>
      </div>
    </div>
  </div>
@stop

@section ('scripts')
@stop
