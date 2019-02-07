@extends('layouts.main')

@section('title','Posts')

@section('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Posts</li>
@stop

@section('menubar')
  @include('layouts.dropdowns.import', ['name'=>'posts'])
  @include('layouts.buttons.dashboard')
  @include('layouts.buttons.add', ['name'=>'posts'])
@stop

@section('content')

@include('layouts.partials.section_top', ['name'=>'Posts', 'icon'=>'fa-newspaper-o'])
        <div class="panel-body">
          <table id="datatable" class="table table-hover table-striped table-condensed">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                {{-- <th>Body</th> --}}
                <th class="hidden-xs hidden-sm">Has Image</th>
                <th class="hidden-xs hidden-sm">Views</th>
                <th class="hidden-xs hidden-sm">Comments</th>
                <th class="hidden-xs">Author</th>
                <th class="hidden-xs">Created At</th>
                @if (Auth::check())
                  <th data-orderable="false"></th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $post)
                <tr>
                  <th>{{ $post->id }}</th>
                  <td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                  <td class="hidden-xs hidden-sm">
                    @if ($post->image)
                      <i class="fa fa-check" aria-hidden="true"></i>
                    @endif
                  </td>
                  <td class="hidden-xs hidden-sm">{{ $post->views }}</td>
                  <td class="hidden-xs hidden-sm">{{ $post->comments()->count() }}</td>
                  <td class="hidden-xs">@include('layouts.author', ['model'=>$post, 'field'=>'user'])</td>
                  <td class="hidden-xs">@include('layouts.dateFormat', ['model'=>$post, 'field'=>'created_at'])</td>
                  {{-- <td>{{ $post->created_at }}</td> --}}
                  <td nowrap="nowrap">
                    {{--================================================================================================================================--}}
                    {{-- EDIT BUTTON                                                                                                                    --}}
                    {{--================================================================================================================================--}}

                    @if((checkACL('editor')) || checkOwner($post))
                      <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=Edit' : '' }}>
                        @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}} <i class="glyphicon glyphicon-pencil"></i> Edit
                        @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}} <i class="glyphicon glyphicon-pencil"></i>
                        @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}} Edit
                        @endif
                      </a>
                    @endif
                    {{--================================================================================================================================--}}
                    {{-- END EDIT BUTTON                                                                                                                --}}
                    {{--================================================================================================================================--}}

                    {{--================================================================================================================================--}}
                    {{-- DELETE BUTTON                                                                                                                  --}}
                    {{--================================================================================================================================--}}
                    @if((checkACL('manager')) || checkOwner($post))
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
                            @endif
                        </button>
                      </form>
                    @endif
                    {{--================================================================================================================================--}}
                    {{-- END DELETE BUTTON                                                                                                              --}}
                    {{--================================================================================================================================--}}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @include('layouts.partials.section_close')
@stop