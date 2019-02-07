@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.products.index') }}">Products</a></li>
  <li>Edit Product</li>
@stop

@section('page_top_menu')
{!! Form::model($product, ['route'=>['admin.products.update', $product->id], 'method' => 'PUT']) !!}
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- INDEX BUTTON                                                                                                                   --}}
          {{--================================================================================================================================--}}
          <a href="{{ route('admin.products.index') }}" class="btn btn-default btn-xs">
            <div class="text text-left">
              {{-- 1 -> Icons and text :: 2 -> Icons Only :: 3 -> Text Only --}}
              @if(Auth::user()->actionButtons == 1)<i class="fa fa-ban" aria-hidden="true"></i> Cancel
              @elseif(Auth::user()->actionButtons == 2)<i class="fa fa-ban" aria-hidden="true"></i>
              @elseif(Auth::user()->actionButtons == 3)Cancel
              @endif
            </div>
          </a>
          {{--================================================================================================================================--}}
          {{-- END INDEX BUTTON                                                                                                               --}}
          {{--================================================================================================================================--}}

          {{--================================================================================================================================--}}
          {{-- UPDATE BUTTON                                                                                                                  --}}
          {{--================================================================================================================================--}}
          {{ Form::button('<i class="fa fa-save"></i> Update Product', array('type' => 'submit', 'class' => 'btn btn-primary btn-xs')) }}
          {{--================================================================================================================================--}}
          {{-- END UPDATE BUTTON                                                                                                              --}}
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
        <div class="panel-heading">Edit Product</div>
        <div class="panel-body">
          @include('layouts.common.displayErrorsWarning')
          <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-10">
              <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                {{ Form::label('title', 'Title', ['class'=>'required']) }}
                {!! Form::text('title', null, array('placeholder' => 'Title','class'=>'form-control', 'autofocus', "onfocus"=>"this.focus();this.select()")) !!}
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
        <div class="panel-footer">
          <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
        </div>
      </div>
    </div>
  </div>
{!! Form::close() !!} 
@stop

@section ('scripts')
@stop