@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/style.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('categories.index') }}">Categories</a></li>
  <li>Edit Category</li>
@stop

@section('menubar')
  {!! Form::model($category, ['route'=>['categories.update', $category->id], 'method' => 'PUT']) !!}
    @include('layouts.buttons.cancel', ['name'=>'categories'])
    @include('layouts.buttons.update', ['name'=>'categories'])
@stop

@section('content')
  @include('layouts.partials.section_top', ['name'=>'Edit Article', 'icon'=>'fa-list'])
        <div class="panel-body">
          {{-- @include('layouts.common.displayErrorsWarning') --}}
          <div class="row">
            <div class="col-xs-12 col-sm-6">
              <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {{ Form::label('name', 'Name', ['class'=>'required']) }}
                {{ Form::text('name', null, ['class' => 'form-control', 'autofocus', "onfocus"=>"this.focus();this.select()"]) }}
                <span class="text-danger">{{ $errors->first('name') }}</span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-sm-6">
              <div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
                {{ Form::label('module_id', 'Module', ['class'=>'required']) }}
                {{ Form::select('module_id', array(''=>'Select a module') + $modules, null, ['class'=>'form-control']) }}
                <span class="text-danger">{{ $errors->first('module_id') }} </span>
              </div>
            </div>
          </div>
        </div>
        @include('layouts.create_edit_panel_footer')
        @include('layouts.partials.section_close')
{!! Form::close() !!}
@stop

@section ('scripts')
@stop