@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.items.index') }}">Items</a></li>
  <li>Edit Category</li>
@stop

@section('page_top_menu')
{!! Form::model($item, ['route'=>['admin.items.update', $item->id], 'method' => 'PUT']) !!}
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- CANCEL BUTTON                                                                                                                  --}}
          {{--================================================================================================================================--}}
          <a href="{{ route('admin.items.index') }}" class="btn btn-default btn-xs">
            <div class="text text-left">
              @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-ban" aria-hidden="true"></i> Cancel
              @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-ban" aria-hidden="true"></i>
              @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}Cancel
              @endif
            </div>
          </a>
          {{--================================================================================================================================--}}
          {{-- END CANCEL BUTTON                                                                                                              --}}
          {{--================================================================================================================================--}}

          {{--================================================================================================================================--}}
          {{-- UPDATE BUTTON                                                                                                                  --}}
          {{--================================================================================================================================--}}
          {{ Form::button('<i class="fa fa-save"></i> Update Item', array('type' => 'submit', 'class' => 'btn btn-primary btn-xs')) }}
          {{--================================================================================================================================--}}
          {{-- END UPDATE BUTTON                                                                                                              --}}
          {{--================================================================================================================================--}}
        </div>
      </div>
    </div>
  </div>
@stop

@section('content')
  {!! Form::model($item, ['route'=>['admin.items.update', $item->id], 'method' => 'PUT']) !!}
    <div class="row">
      <div class="col-md-10">
        <div class="panel panel-default">
          <div class="panel-heading">Edit Item</div>
          <div class="panel-body">
            @include('layouts.common.displayErrorsWarning')
            <div class="row">
              <div class="col-xs-12 col-sm-6">
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                  {!! Form::label("title", "Title", ['class'=>'required']) !!}
                  {!! Form::text("title", null, ["class" => "form-control", "autofocus", "onfocus" => "this.focus();this.select()"]) !!}
                  <span class="text-danger">{{ $errors->first('title') }}</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-8">
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                  {{ Form::label('description', 'Description', ['class'=>'required']) }}
                  {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
                  <span class="text-danger">{{ $errors->first('description') }}</span>
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