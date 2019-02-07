@extends('layouts.admin.main')

@section ('title','Edit Article')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.articles.index') }}">Articles</a></li>
  <li>Edit Article</li>
@stop

@section('page_top_menu')
{!! Form::model($article, ['route'=>['admin.articles.update', $article->id], 'method' => 'PUT']) !!}
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- CANCEL BUTTON                                                                                                                  --}}
          {{--================================================================================================================================--}}
          <a href="{{ route('admin.articles.index') }}" class="btn btn-default btn-xs">
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
          {{ Form::button('<i class="fa fa-save"></i> Update Article', array('type' => 'submit', 'class' => 'btn btn-primary btn-xs')) }}
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
        <div class="panel-heading">Edit Article</div>
        <div class="panel-body">
          @include('layouts.common.displayErrorsWarning')
          <div class="row">
            <div class="col-xs-9 col-sm-9 col-md-9">
              <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                {!! Form::label("title", "Title", ['class'=>'required']) !!}
                {!! Form::text("title", null, ["class" => "form-control", "autofocus", "onfocus"=>"this.focus();this.select()"]) !!}
                <span class="text-danger">{{ $errors->first('title') }}</span>
              </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
              <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                {{ Form::label('category_id', 'Category', ['class'=>'required']) }}
                {{ Form::select('category_id', array(''=>'Select a category') + $categories, null, ['class'=>'form-control']) }}
                <span class="text-danger">{{ $errors->first('category_id') }}</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group {{ $errors->has('description_eng') ? 'has-error' : '' }}">
                {!! Form::label("description_eng", "Description (En)", ['class'=>'required']) !!}
                {!! Form::textarea("description_eng", null, ["class" => "form-control wysiwyg"]) !!}
                <span class="text-danger">{{ $errors->first('description_eng') }}</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group {{ $errors->has('description_fre') ? 'has-error' : '' }}">
                {!! Form::label("description_fre", "Description (Fr)") !!}
                {!! Form::textarea("description_fre", null, ["class" => "form-control wysiwyg"]) !!}
                <span class="text-danger">{{ $errors->first('description_fre') }}</span>
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