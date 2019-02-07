@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.tweets.index') }}">Tweets</a></li>
  <li>Show Tweet</li>
@stop

@section('page_top_menu')
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- INDEX BUTTON                                                                                                                   --}}
          {{--================================================================================================================================--}}
          <a class="btn btn-default btn-xs btn-block" href="{{ route('admin.tweets.index') }}">
            <div class="text text-left">
              <i class="fa fa-list"></i> Tweets List
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
    <div class="col-xs-12 col-sm-8 col-md-6">
      <div class="form-group">
        {{ Form::label('title', 'Title') }}
        <div class="well well-sm">{{ $tweet->title }}</div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-8">
      <div class="form-group">
        {{ Form::label('body', 'Body') }}
        <div class="well well-sm">{{ $tweet->body }}</div>
      </div>
    </div>
  </div>
@stop
