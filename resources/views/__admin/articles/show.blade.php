@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.articles.index') }}">Articles</a></li>
  <li>Show Article</li>
@stop

@section('page_top_menu')
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- BACK TO CONTROL PANEL BUTTON (will only show if coming from the admin page)                                                    --}}
          {{--================================================================================================================================--}}
          @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'admin')
            <a href="{{ route('admin') }}" class="btn btn-default btn-xs">
              @if(Auth::user()->actionButtons == 1){{-- Icons and Text --}}<i class="glyphicon glyphicon-cog"></i> Control Panel
              @elseif(Auth::user()->actionButtons == 2){{-- Icons Only --}}<i class="glyphicon glyphicon-cog"></i>
              @elseif(Auth::user()->actionButtons == 3){{-- Text Only --}}Control Panel
              @endif
            </a>
          @endif
          {{--================================================================================================================================--}}
          {{-- END BACK TO CONTROL PANEL BUTTON                                                                                               --}}
          {{--================================================================================================================================--}}
          
          {{--================================================================================================================================--}}
          {{-- EDIT BUTTON                                                                                                                    --}}
          {{--================================================================================================================================--}}
          {{-- @ability('admin', 'articles_edit_admin') --}}
            <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-primary btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=Edit' : '' }}>
              @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}} <i class="glyphicon glyphicon-pencil"></i> Edit
              @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}} <i class="glyphicon glyphicon-pencil"></i>
              @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}} Edit
              @endif
            </a>
          {{-- @endability --}}
          {{--================================================================================================================================--}}
          {{-- END EDIT BUTTON                                                                                                                --}}
          {{--================================================================================================================================--}}

          {{--================================================================================================================================--}}
          {{-- INDEX BUTTON                                                                                                                   --}}
          {{--================================================================================================================================--}}
          <a href="{{ route('admin.articles.index') }}" class="btn btn-default btn-xs" >
            <div class="text text-left">
              <i class="fa fa-list"></i> Articles List
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