@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.products.index') }}">Products</a></li>
  <li>Show Product</li>
@stop

@section('page_top_menu')
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- INDEX BUTTON                                                                                                                   --}}
          {{--================================================================================================================================--}}
          <a class="btn btn-default btn-xs btn-block" href="{{ route('admin.products.index') }}">
            <div class="text text-left">
              <i class="fa fa-list"></i> Products List
            </div>
          </a>
          {{--================================================================================================================================--}}
          {{-- END INDEX BUTTON                                                                                                               --}}
          {{--================================================================================================================================--}}
        </div>
      </div>
    </div>
  </div>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Show Product</div>
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