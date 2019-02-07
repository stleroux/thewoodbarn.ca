@extends ('layouts.main')

@section ('title', '| Edit Tweet')

@section ('stylesheets')
    {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('tweets.index') }}">Tweets</a></li>
  <li>Edit Tweet</li>
@stop

@section('menubar')
  {!! Form::model($tweet, ['route'=>['tweets.update', $tweet->id], 'method' => 'PUT']) !!}
    @include('layouts.buttons.cancel', ['name'=>'tweets'])
    @include('layouts.buttons.update', ['name'=>'tweets'])
@stop

@section('content')
    @include('layouts.partials.section_top', ['name'=>'Edit Tweet', 'icon'=>'fa-retweet'])
      <div class="panel-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
              {!! Form::label("title", "Title", ['class'=>'required']) !!}
              {!! Form::text("title", null, ["class" => "form-control", "autofocus", 'onfocus' => 'this.focus();this.select()']) !!}
              <span class="text-danger">{{ $errors->first('title') }}</span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12">
            <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
              {!! Form::label("body", "Body", ['class'=>'required']) !!}
              {!! Form::textarea('body', null, ["class" => "form-control simple"]) !!}
              <span class="text-danger">{{ $errors->first('body') }}</span>
            </div>
          </div>
        </div>
      </div>

    @include('layouts.create_edit_panel_footer')
    @include('layouts.partials.section_close')

{!! Form::close() !!}

@stop

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('.date-picker').datepicker({
        });
    </script>
@stop
