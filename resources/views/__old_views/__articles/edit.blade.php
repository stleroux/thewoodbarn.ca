@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/articles.css') }}
@stop

@section('content')
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ url('articles') }}">Articles</a></li>
    <li>Edit</li>
  </ol>

  {!! Form::model($article, ['method' => 'PUT', 'action' => ['ArticleController@update', $article->id]]) !!}
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">Edit Article</div>
        <div class="panel-body">
          @include('partials._displayErrorsWarning')
          @include('articles.form', ['submitText' => '<i class="fa fa-check"></i> Update'])
        </div>
      </div>
      <!--
      <div class="panel panel-default">
        <div class="panel-heading">9 columns</div>
        <div class="panel-body"></div>
      </div>
      -->
    </div>
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">Options</div>
        <div class="panel-body">
          <button type="submit" name="submit" class="btn btn-primary btn-block">
            <div class="text text-left">
              <i class="fa fa-save"></i> Update Article
            </div>
          </button>
          <a href="{{ route('articles.index') }}" class="btn btn-default btn-block">
            <div class="text text-left">
              <i class="fa fa-ban" aria-hidden="true"></i> Cancel
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
@stop

@section ('scripts')
@stop