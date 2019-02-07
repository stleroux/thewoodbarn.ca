@extends ('layouts.main')

@section ('title', '| All Teets')

@section ('stylesheets')
    {{ Html::style('css/style.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Tweets</li>
@stop

@section('menubar')
  @include('layouts.dropdowns.import', ['name'=>'tweets'])
  @include('layouts.buttons.dashboard')
  @include('layouts.buttons.add', ['name'=>'tweets'])
@stop

@section('content')
@include('layouts.partials.section_top', ['name'=>'Tweets', 'icon'=>'fa-retweet'])
        <div class="panel-body">
          @if($tweets->count())
            <table id="datatable" class="table table-condensed table-hover">
              <thead>
                <tr>
                  <th>Title</th>
                  <th class="hidden-xs">Body</th>
                  <th>Author</th>
                  @if (Auth::check())
                    <th data-orderable="false"></th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach($tweets as $tweet)
                  <tr>
                    <td><a href="{{ route('tweets.show', $tweet->id) }}">{{ $tweet->title }}</a></td>
                    <td class="hidden-xs">{!! $tweet->body !!}</td>
                    <td>@include('layouts.author', ['model'=>$tweet, 'field'=>'user'])</td>
                    @if (Auth::check())
                      <td class="text-right">
                        @include('layouts.buttons.edit', ['model'=>$tweet, 'name'=>'tweets', 'id'=>$tweet->id])
                        @include('layouts.buttons.delete', ['model'=>$tweet, 'name'=>'tweets', 'id'=>$tweet->id])
                      </td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <h3 class="text-center alert alert-info">Empty!</h3>
          @endif
        </div>
      @include('layouts.partials.section_close')
@stop

@section ('scripts')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#datatable').dynatable();
        } );
    </script>
@stop