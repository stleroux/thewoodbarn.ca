@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('modules.index') }}">Modules</a></li>
  <li>Edit Module</li>
@stop

@section('menubar')
  {!! Form::model($module, ['route'=>['modules.update', $module->id], 'method' => 'PUT']) !!}
    @include('layouts.buttons.cancel', ['name'=>'modules'])
    @include('layouts.buttons.update', ['name'=>'modules'])
@stop

@section('content')
  @include('layouts.partials.section_top', ['name'=>'Edit Module', 'icon'=>'fa-cubes'])
        <div class="panel-body">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {{ Form::label ('name', 'Name', ['class'=>'required']) }}
                {{ Form::text ('name', null, ['class' => 'form-control', 'autofocus', "onfocus"=>"this.focus();this.select()"]) }}
                <span class="text-danger">{{ $errors->first('name') }}</span>
              </div>
            </div>
          </div>
        </div>
        @include('layouts.create_edit_panel_footer')
        @include('layouts.partials.section_close')
{{ Form::Close() }}
@stop

@section ('scripts')
@stop