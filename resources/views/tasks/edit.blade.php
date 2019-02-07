@extends ('layouts.main')

@section ('title', '| Edit Task')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('tasks.index') }}">Tasks</a></li>
  <li>Edit Task</li>
@stop

@section('menubar')
  {!! Form::model($task, ['route'=>['tasks.update', $task->id], 'method' => 'PUT']) !!}
    @include('layouts.buttons.cancel', ['name'=>'tasks'])
    @include('layouts.buttons.update', ['name'=>'tasks'])
@stop

@section ('content')
  @include('layouts.partials.section_top', ['name'=>'Edit Task', 'icon'=>'fa-tasks'])
        <div class="panel-body">
          <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {{ Form::label ('name', 'Name:') }}
            {{ Form::text ('name', null, ['class' => 'form-control', 'autofocus'=>'autofocus']) }}
            <span class="text-danger">{{ $errors->first('name') }}</span>
          </div>
        </div>
      @include('layouts.create_edit_panel_footer')
      @include('layouts.partials.section_close')
  {!! Form::close() !!}
@stop

@section ('scripts')
@stop
