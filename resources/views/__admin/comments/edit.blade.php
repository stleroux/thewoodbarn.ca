@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.posts.index') }}">Posts</a></li>
  <li>Edit Comment</li>
@stop

@section('page_top_menu')
{!! Form::model($comment, ['route'=>['admin.comments.update', $comment->id], 'method' => 'PUT']) !!}
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- CANCEL BUTTON                                                                                                                  --}}
          {{--================================================================================================================================--}}
          <a href="{{ route('admin.posts.show', $comment->post->id) }}" class="btn btn-default btn-xs">
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
          {{ Form::button('<i class="fa fa-save"></i> Update Comment', array('type' => 'submit', 'class' => 'btn btn-primary btn-xs')) }}
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
        <div class="panel-heading">Edit Comment</div>
        <div class="panel-body">
          @include('layouts.common.displayErrorsWarning')
          {{ Form::label('name', 'Name:') }}
          {{ Form::text('name', null, ['class' => 'form-control', 'disabled' => 'disabled']) }}

          {{ Form::label('email', 'Email:') }}
          {{ Form::text('email', null, ['class' => 'form-control', 'disabled' => 'disabled']) }}

          {{ Form::label('comment', 'Comment:') }}
          {{ Form::textarea('comment', null, ['class' => 'form-control']) }}
        </div>
      </div>
    </div>
  </div>
{{ Form::close() }}
@stop

@section ('scripts')
@stop