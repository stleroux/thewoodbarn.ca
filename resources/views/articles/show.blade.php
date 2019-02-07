@extends('layouts.main')

@section ('title','View Article')

@section ('stylesheets')
  {{ Html::style('css/articles.css') }}
@stop

@section('breadcrumb')
  <li><a href="{{ url('/') }}">Home</a></li>
  <li><a href="{{ url('articles') }}">Articles</a></li>
  <li>Show</li>
@stop

@section('menubar')
          <!-- Only show this button if coming from the profile page -->
          @if (false !== stripos($_SERVER['HTTP_REFERER'], "/profile/".Auth::user()->id."/show"))
            {{-- <a href="{{ route('profile.show', Auth::user()->id) }}" class="btn btn-default btn-block"> --}}
            <a href="{{URL::route('profile.show', Auth::user()->id) . '#articles' }}" class="btn btn-xs btn-default">
              <div class="text text-left">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Profile
              </div>
            </a>
            {{-- <a href="{{URL::route('profile.show', Auth::user()->id) . '#articles' }}" class="btn btn-xs btn-default">Back</a> --}}
          @endif
  @include('layouts.buttons.print', ['name'=>'articles'])
  @include('layouts.buttons.index', ['model'=>'articles', 'name'=>'articles', 'icon'=>'fa-list'])
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">{{ $article->title }}</div>
        <div class="panel-body">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">Description (En)
                <div class="pull-right">
                  <button class="btn btn-xs btn-default" data-copytarget="#eng">Copy to Clipboard</button>
                </div>
              </div>
              <div class="panel-body">
                {{ Form::hidden('eng', str_replace('<br />', '', $article->description_eng), ['id'=>'eng', 'class'=>'form-control']) }}
                <div class="wel well-sm well-white">
                  {!! $article->description_eng !!}
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">Description (Fr)
                <div class="pull-right">
                  <button class="btn btn-xs btn-default" data-copytarget="#fre">Copy to Clipboard</button>
                </div>
              </div>
              <div class="panel-body">
                {{ Form::hidden('fre', str_replace('<br />','', $article->description_fre), ['id'=>'fre', 'class'=>'form-control']) }}
                <div class="wel well-sm well-white">
                  {!! $article->description_fre !!}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-footer">
          Select the text before hitting the Copy to Clipboard button
        </div>
      </div>
    </div>
  </div>

  {{-- PRINT MODAL --}}
  <div class="modal fade" id="printArticleModal" tabindex="-1" role="dialog" aria-labelledby="printArticleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="printArticleModalLabel">Article Printing Instructions</h4>
        </div>
        <div class="modal-body">
          <p>To print this article, please use your browser's print functionality.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <span class="pull-right">
            <a href="{{ route('articles.print', $article->id) }}" class="btn btn-default btn-block">
              <div class="text text-left">
                  <i class="fa fa-print" aria-hidden="true"></i> Proceed
              </div>
            </a>
          </span>
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