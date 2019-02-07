@extends('layouts.main')

@section ('title','Create Item')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li>Home</li>
  <li><a href="{{ route('items.index') }}">Items</a></li>
  <li>Create Item</li>
@stop

@section('menubar')
  {!! Form::open(['route' => 'items.store']) !!}
    @include('layouts.buttons.cancel', ['name'=>'items'])
    @include('layouts.buttons.save', ['name'=>'items'])
@stop

@section('content')
  @include('layouts.partials.section_top', ['name'=>'Create Item', 'icon'=>'fa-shopping-basket'])
    <div class="panel-body">
      {{-- @include('layouts.common.displayErrorsWarning') --}}
      <div class="col-md-12">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
          {{ Form::label('title', 'Title', ['class'=>'required']) }}
          {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control', 'autofocus')) !!}
           <span class="text-danger">{{ $errors->first('title') }}</span>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
          {{ Form::label('description', 'Description', ['class'=>'required']) }}
          {{ Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control wysiwyg','style'=>'height:100px;')) }}
          <span class="text-danger">{{ $errors->first('description') }}</span>
        </div>
      </div>
    </div>
    @include('layouts.create_edit_panel_footer')
    @include('layouts.partials.section_close')
  {!! Form::close() !!}
@stop

@section ('scripts')
@stop