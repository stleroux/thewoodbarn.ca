@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/articles.css') }}
@stop

@section('content')
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ url('articles') }}">Articles</a></li>
    <li>Create</li>
  </ol>

  <div class="row">
  {!! Form::open(['route' => 'articles.store']) !!}
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">Create Article</div>
        <div class="panel-body">
          @include('partials._displayErrorsWarning')
          @include('articles.form')
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
          <div class="form-actions">
            <button type="submit" name="submit" class="btn btn-primary btn-block">
              <div class="text text-left">
                <i class="fa fa-save"></i> Save Article
              </div>
            </button>
            <a href="{{ route('articles.index') }}" class="btn btn-default btn-block">
              <div class="text text-left">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  </div>
@stop

@section ('scripts')
@stop