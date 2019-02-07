@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('products.index') }}">Products</a></li>
  <li>Show Product</li>
@stop

@section('menubar')
  {{-- @include('layouts.buttons.print', ['name'=>'products']) --}}
  @include('layouts.buttons.index', ['name'=>'products', 'icon'=>'fa-wpforms'])
@stop

@section('content')
@include('layouts.partials.section_top', ['name'=>'Product Details', 'icon'=>'fa-wpforms'])
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-10">
              <div class="form-group">
                {{ Form::label('title', 'Title') }}
                <div class="well well-sm">{!! $product->title !!}</div>
              </div>
            </div>

            <div class="col-xs-12 col-sm-2 col-md-2">
              {!! Form::label("category", "Category") !!}
              <div class="well well-sm">{!! $product->category->name !!}</div>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-10">
              <div class="form-group">
                {{ Form::label('description', 'Description') }}
                <div class="well well-sm">{!! $product->description !!}</div>
              </div>
            </div>

            <div class="col-xs-12 col-sm-2 col-md-2">
              <div class="form-group">
                {{ Form::label('price', 'Price') }}
                <div class="well well-sm">{!! $product->price !!}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section ('scripts')
@stop