@extends('layouts.main')

<?php
  $titleTag = htmlspecialchars($post->title);
  $titleTag = '| ' . $titleTag;
?>

@section('title', "$titleTag")

@section ('stylesheets')
    {{ Html::style('css/main.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Blog</li>
@stop

@section('content')
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">{{ ucwords($post->title) }}</div>
        <div class="panel-body">
          @if ($post->image)
            <label>Image</label>
            <p>
              <a href="" data-toggle="modal" data-target="#viewImageModal">
                {{ Html::image("images/posts/" . $post->image, "", array('height'=>'150','width'=>'175')) }}
              </a>
            </p>
          @endif
          <p style="white-space: pre-wrap;">{!! $post->body !!}</p>
          <hr>
          <p>Posted In: {{ $post->category->name }}</p>
        </div>
      </div>
    
      <div class="panel panel-default">
        <div class="panel-heading"><span class="glyphicon glyphicon-comment"></span>  {{ $post->comments()->count() }} Comments</div>
        <div class="panel-body">
          @foreach($post->comments as $comment)
            <div class="comment">
              <div class="author-info">
                <img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?s=50&d=monsterid" }}" class="author-image">
                <div class="author-name">
                  <h4>{{ $comment->name }}</h4>
                  <p class="author-time">{{ date('F jS, Y - g:iA' ,strtotime($comment->created_at)) }}</p>
                </div>
              </div>
              <div class="comment-content">
                {{ $comment->comment }}
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">Options</div>
            <div class="panel-body">

          {{--================================================================================================================================--}}
          {{-- BACK TO CONTROL PANEL BUTTON (will only show if coming from the admin page)                                                    --}}
          {{--================================================================================================================================--}}
          @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'home')
            <a href="{{ route('home') }}" class="btn btn-default btn-block">
              @if(Auth::check())
                <div class="text text-left">
                  @if(Auth::user()->actionButtons == 1){{-- Icons and Text --}}<i class="fa fa-arrow-left" aria-hidden="true"></i> Home
                  @elseif(Auth::user()->actionButtons == 2){{-- Icons Only --}}<i class="fa fa-arrow-left" aria-hidden="true"></i>
                  @elseif(Auth::user()->actionButtons == 3){{-- Text Only --}}Home
                  @endif
                </div>
              @else
                <div class="text text-left">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i> Home
                </div>
              @endif
            </a>
          @endif
          {{--================================================================================================================================--}}
          {{-- END BACK TO CONTROL PANEL BUTTON                                                                                               --}}
          {{--================================================================================================================================--}}

              <!-- Only show the Search Results button if coming from the search results page -->
              @if (false !== stripos($_SERVER['HTTP_REFERER'], "/search/posts"))
                <a href="{{ URL::previous() }}" class="btn btn-default btn-block">
                  <div class="text text-left">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Back to Search Results
                  </div>
                </a>
              @endif
              <!-- Only show the Back to Homepage button if coming from the homepage -->
{{--               @if (false !== stripos($_SERVER['HTTP_REFERER'], "/"))
                <a href="{{ URL::previous() }}" class="btn btn-default btn-block">
                  <div class="text text-left">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Home
                  </div>
                </a>
              @endif --}}
              <!-- Only show the Back to Archives List button if coming from the archive page -->
              @if ($url = Session::get('backUrl'))
                <a href="{{ $url }}" class="btn btn-default btn-block">
                  <div class="text text-left">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Back to Archives List
                  </div>
                </a>
              @endif
              <a href="{{ route('blog.index') }}" class="btn btn-default btn-block">
                <div class="text text-left">
                  <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Blog
                </div>
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">Leave a comment</div>
            <div class="panel-body">
              {{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}
                <div class="row">
                  <div class="col-md-12">
                    {{ Form::label('name', "Name:") }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    {{ Form::label('email', 'Email:') }}
                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                  </div>
                  <div class="col-md-12">
                    {{ Form::label('comment', "Comment:") }}
                    {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}
                    {{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:15px;']) }}
                  </div>
                </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- IMAGE MODAL --}}
  <div class="modal fade" id="viewImageModal" tabindex="-1" role="dialog" aria-labelledby="viewImageModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="printPostModalLabel">Post Image</h4>
        </div>
        <div class="modal-body">
          <p>{{ Html::image("images/posts/" . $post->image, "", array('height'=>'100%','width'=>'100%')) }}</a></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@stop

@section ('scripts')

@stop