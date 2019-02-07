@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  {{-- <li><a href="/admin">Control Panel</a></li> --}}
  <li><a href="{{ route('products.index') }}">Products</a></li>
  <li>Add Products</li>
@stop

@section('menubar')
  {!! Form::open(['route' => 'products.store']) !!}
    @include('layouts.buttons.cancel', ['name'=>'products', 'param1'=>''])
    @include('layouts.buttons.save', ['name'=>'products'])
@stop

@section('content')
@include('layouts.partials.section_top', ['name'=>'Create Product', 'icon'=>'fa-wpforms'])
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-12 col-sm-10 col-md-10">
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                  {{ Form::label('title', 'Title', ['class'=>'required']) }}
                  {!! Form::text('title', null, array('placeholder' => 'Title','class'=>'form-control', 'autofocus')) !!}
                  <span class="text-danger">{{ $errors->first('title') }}</span>
                </div>
              </div>
              <div class="col-xs-12 col-sm-2 col-md-2">
                <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                  {{ Form::label('category_id', 'Category', ['class'=>'required']) }}
                  {{ Form::select('category_id', array(''=>'Select a category') + $categories, null, ['class'=>'form-control']) }}
                  <span class="text-danger">{{ $errors->first('category_id') }}</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-10 col-md-10">
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                  {{ Form::label('description', 'Description', ['class'=>'required']) }}
                  {!! Form::textarea('description', null, array('placeholder' => 'Description','class'=>'form-control','style'=>'height:100px')) !!}
                  <span class="text-danger">{{ $errors->first('description') }}</span>
                </div>
              </div>
              <div class="col-xs-12 col-sm-2 col-md-2">
                <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                  {{ Form::label('price', 'Price', ['class'=>'required']) }}
                  {!! Form::text('price', null, array('placeholder' => 'Price','class'=>'form-control')) !!}
                  <span class="text-danger">{{ $errors->first('price') }}</span>
                </div>
              </div>
            </div>
          </div>
          @include('layouts.create_edit_panel_footer')
          @include('layouts.partials.section_close')
  {{ Form::close() }}
@stop

@section ('scripts')
@stop