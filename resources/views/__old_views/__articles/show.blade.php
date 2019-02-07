@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/articles.css') }}
@stop

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('articles') }}">Articles</a></li>
        <li>Show</li>
    </ol>

    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $article->title }}</div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Description (En)
                                <div class="pull-right">
                                    <button class="btn btn-xs btn-default" data-copytarget="#eng">Copy to Clipboard</button>
                                </div>
                            </div>
                            <div class="panel-body">
                                {{ Form::textarea('eng', str_replace('<br />', '', $article->description_eng), ['id'=>'eng', 'class'=>'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Description (Fr)
                                <div class="pull-right">
                                    <button class="btn btn-xs btn-default" data-copytarget="#fre">Copy to Clipboard</button>
                                </div>
                            </div>
                            <div class="panel-body">
                                {{ Form::textarea('fre', str_replace('<br />','', $article->description_fre), ['id'=>'fre', 'class'=>'form-control']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Options</div>
                <div class="panel-body">
                    <!-- Only show this button if coming from the search results page -->
                    @if (false !== stripos($_SERVER['HTTP_REFERER'], "/search/articles"))
                        <a href="{{ URL::previous() }}" class="btn btn-default btn-block">
                            <div class="text text-left">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Search Results
                            </div>
                        </a>
                    @endif

                    <a class="btn btn-info btn-block" href="{{ action('ArticleController@index') }}">
                        <div class="text text-left">
                            <i class="fa fa-list"></i> Articles List
                        </div>
                    </a>

                    <!-- Only show this button if coming from the profile page -->
                    @if (false !== stripos($_SERVER['HTTP_REFERER'], "/profile/".Auth::user()->id."/show"))
                        {{-- <a href="{{ route('profile.show', Auth::user()->id) }}" class="btn btn-default btn-block">
                            <div class="text text-left">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Profile
                            </div>
                        </a> --}}
                        <a href="{{URL::route('profile.show', Auth::user()->id) . '#articles' }}">Back</a>
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section ('scripts')

    <script type="text/javascript">
        (function() {

      'use strict';

      // click events
      document.body.addEventListener('click', copy, true);

      // event handler
      function copy(e) {

        // find target element
        var
          t = e.target,
          c = t.dataset.copytarget,
          inp = (c ? document.querySelector(c) : null);

        // is element selectable?
        if (inp && inp.select) {

          // select text
          inp.select();

          try {
            // copy text
            document.execCommand('copy');
            inp.blur();
          }
          catch (err) {
            alert('please press Ctrl/Cmd+C to copy');
          }
        }
      }
    })();
    </script>
@stop