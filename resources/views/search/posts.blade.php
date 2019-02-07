@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('blog.index') }}">Blog</a></li>
  <li class="active">Blog Search</li>
@stop

@section ('content')
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">Blog Search Results</div>
        <div class="panel-body">
          @if (count($posts) > 0)
            <div class="row">
              <div class="col-md-12">
                <table class="table table-hover table-responsive">
                  <thead>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Created At</th>
                  </thead>
                  <tbody>
                    @foreach ($posts as $post)
                      <tr>
                        <td><a href="{{ route('blog.single', $post->slug) }}">{{ $post->title }}</a></td>
                        <td>{!! substr($post->body, 0, 75) !!} {{ strlen($post->body) > 75 ? " ..." : "" }}</td>
                        <td>{{ date('M j, Y', strtotime($post->created_at)) }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- Display pagination links -->
                <div class="text-center">{!! $posts->render() !!}</div>
              </div>
            </div>
          @else
            <div class="row">
              <div class="col-md-12">
                <p class="text text-danger">No results found</p>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">Options</div>
        <div class="panel-body">
          <!-- Only show the Search Results button if coming from the search results page -->
          @if (false !== stripos($_SERVER['HTTP_REFERER'], "/search/posts"))
            <a href="{{ URL::previous() }}" class="btn btn-default btn-block">
              <div class="text text-left">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back to Search Results
              </div>
            </a>
          @endif
          @if (true !== stripos($_SERVER['HTTP_REFERER'], "/search/posts"))
            <a href="{{ route('blog.index') }}" class="btn btn-default btn-block">
              <div class="text text-left">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back to Blog
              </div>
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>
@stop

@section ('scripts')
@stop
