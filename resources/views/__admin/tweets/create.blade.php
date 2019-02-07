@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.tweets.index') }}">Tweets</a></li>
  <li>Add Tweet</li>
@stop

@section('page_top_menu')
{!! Form::open(['route' => 'admin.tweets.store']) !!}
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- CANCEL BUTTON                                                                                                                  --}}
          {{--================================================================================================================================--}}
          <a href="{{ route('admin.tweets.index') }}" class="btn btn-default btn-xs">
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
          {{ Form::button('<i class="fa fa-save"></i> Save Tweet', array('type' => 'submit', 'class' => 'btn btn-success btn-xs')) }}
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
        <div class="panel-heading">Add Tweet</div>
        <div class="panel-body">
          @include('layouts.common.displayErrorsWarning')
          <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6">
              <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                {{ Form::label('title', 'Title', ['class'=>'required']) }}
                {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control', 'autofocus')) !!}
                <span class="text-danger">{{ $errors->first('title') }}</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8">
              <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                {{ Form::label('body', 'Body', ['class'=>'required']) }}
                {!! Form::textarea('body', null, array('placeholder' => 'Body','class' => 'form-control','style'=>'height:100px')) !!}
                <span class="text-danger">{{ $errors->first('body') }}</span>
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