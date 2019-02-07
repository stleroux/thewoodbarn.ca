@extends('layouts.main')

@section ('title','Create Article')

@section ('stylesheets')
  {{ Html::style('css/articles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('articles.index') }}">Articles</a></li>
  <li>Create Article</li>
@stop

@section('menubar')
  {!! Form::open(['route' => 'articles.store']) !!}
    @include('layouts.buttons.cancel', ['name'=>'articles', 'param1'=>''])
    @include('layouts.buttons.save', ['name'=>'articles'])
@stop

@section('content')
 
    @include('layouts.partials.section_top', ['name'=>'Create Article', 'icon'=>'fa-list'])
      <div class="panel-body">
        <div class="row">
          <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
              {!! Form::label("title", "Title", ['class'=>'required']) !!}
              {!! Form::text("title", null, ["class" => "form-control", "autofocus", 'onfocus' => 'this.focus();this.select()']) !!}
              <span class="text-danger">{{ $errors->first('title') }}</span>
            </div>
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
              {{ Form::label('category_id', 'Category', ['class'=>'required']) }}
              @if(Route::getCurrentRoute()->getActionName('create'))
                {{ Form::select('category_id', array('' => 'Select a category') + $categories, null , ['class' => 'form-control']) }}
              @else
                {{ Form::select('category_id', $categories, null, ['class'=>'form-control']) }}
              @endif
              <span class="text-danger">{{ $errors->first('category_id') }}</span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group {{ $errors->has('description_eng') ? 'has-error' : '' }}">
              {!! Form::label('description_eng', 'Description (En)', ['class'=>'required']) !!}
              {!! Form::textarea('description_eng', null, ["class" => "form-control simple"]) !!}
              <span class="text-danger">{{ $errors->first('description_eng') }}</span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group {{ $errors->has('description_fre') ? 'has-error' : '' }}">
              {!! Form::label('description_fre', 'Description (Fr)') !!}
              {!! Form::textarea('description_fre', null, ["class" => "form-control simple"]) !!}
              <span class="text-danger">{{ $errors->first('description_fre') }}</span>
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