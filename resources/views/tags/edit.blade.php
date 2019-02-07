@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('tags.index') }}">Tags</a></li>
  <li>Edit Tag</li>
@stop

@section('menubar')
  {!! Form::model($tag, ['route'=>['tags.update', $tag->id], 'method' => 'PUT']) !!}
    @include('layouts.buttons.cancel', ['name'=>'tags'])
    @include('layouts.buttons.update', ['name'=>'tags'])
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Edit Tag</div>
        <div class="panel-body">
          {{-- @include('layouts.common.displayErrorsWarning') --}}
          <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6">
              <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {{ Form::label ('name', 'Name') }}
                {{ Form::text ('name', null, ['class' => 'form-control', 'autofocus', "onfocus"=>"this.focus();this.select()"]) }}
                <span class="text-danger">{{ $errors->first('name') }}</span>
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
{{ Form::close() }}
@stop

@section ('scripts')
@stop