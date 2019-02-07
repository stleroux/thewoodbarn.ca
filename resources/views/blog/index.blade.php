@extends ('layouts.main')

@section ('title', '| Blog')

@section ('stylesheets')
	{{ Html::style('css/main.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Blog</li>
@stop

@section ('content')
  <div class="row">
    <div class="col-md-9">
      @foreach ($posts as $post)
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">{{ $post->title }}
                <div class="pull-right">
                  {{--================================================================================================================================--}}
                  {{-- EDIT BUTTON                                                                                                                    --}}
                  {{--================================================================================================================================--}}
                  @if((checkACL('editor')) || (checkOwner($post)))
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=Edit' : '' }}>
                      @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}} <i class="glyphicon glyphicon-pencil"></i> Edit
                      @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}} <i class="glyphicon glyphicon-pencil"></i>
                      @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}} Edit
                      @else Edit
                      @endif
                    </a>
                  @endif
                    {{--================================================================================================================================--}}
                    {{-- END EDIT BUTTON                                                                                                                --}}
                    {{--================================================================================================================================--}}


      
                    {{--================================================================================================================================--}}
                    {{-- DELETE BUTTON                                                                                                                  --}}
                    {{--================================================================================================================================--}}
                     @if((checkACL('manager')) || (checkOwner($post)))
                      <form method="POST" action="{{ route('posts.destroy', $post->id) }}" accept-charset="UTF-8" style="display:inline">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button
                          class="btn btn-danger btn-xs"
                          {{ Auth::user()->actionButtons == 2 ? 'title=Delete' : '' }}
                          type="button"
                          data-toggle="modal"
                          data-id="{{ $post->id }}"
                          data-target="#confirmDelete"
                          data-title="Delete Post"
                          data-message="Are you sure you want to delete this post?">
                            @if(Auth::user()->actionButtons == 1){{-- Icons and Text --}}<i class="glyphicon glyphicon-trash"></i> Delete
                            @elseif(Auth::user()->actionButtons == 2){{-- Icons Only --}}<i class="glyphicon glyphicon-trash"></i>
                            @elseif(Auth::user()->actionButtons == 3){{-- Text Only --}}Delete
                            @else Delete
                            @endif
                        </button>
                      </form>
                    @endif
                  {{-- @endif --}}
                  {{--================================================================================================================================--}}
                  {{-- END DELETE BUTTON                                                                                                              --}}
                  {{--================================================================================================================================--}}
                </div>
              </div>
              <div class="panel-body">
                <div class="col-md-1">
                  @if ($post->user->image)
                    {{ Html::image("images/profiles/" . $post->user->image, "",array('height'=>'60','width'=>'60')) }}
                  @else
                    <i class="fa fa-5x fa-user" aria-hidden="true"></i>
                  @endif                  
                </div>
                <div class="col-md-9">
                  <p>{!! substr(strip_tags($post->body), 0, 250) !!} {{ strlen(strip_tags($post->body)) > 250 ? ' ...' : '' }}</p>
                </div>
                <div class="col-md-2">
                  <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-primary">
                    <div class="text text-left">
                      <i class="fa fa-chevron-right" aria-hidden="true"></i> Read More
                    </div>
                  </a>
                </div>
              </div>
              <div class="panel-footer">
                Created by @include('layouts.author', ['model'=>$post, 'field'=>'user'])
                <div class="pull-right">
                  Published on @include('layouts.dateFormat', ['model'=>$post, 'field'=>'created_at'])
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">Search Posts</div>
        <div class="panel-body">
          {!! Form::open(['route' => 'search.posts', 'method'=> 'GET']) !!}
            {{ Form::text('search', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) }}
            {{Form::button('<div class="text text-left"><i class="fa fa-search" aria-hidden="true"></i> Search</div>', array('type' => 'submit', 'class' => 'btn btn-primary btn-block'))}}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

@stop

@section ('scripts')
@stop
