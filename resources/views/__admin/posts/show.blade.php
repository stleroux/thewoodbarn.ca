@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.posts.index') }}">Posts</a></li>
  <li>Show Post</li>
@stop

@section('page_top_menu')
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- BACK TO CONTROL PANEL BUTTON                                                                                                   --}}
          {{--================================================================================================================================--}}
          @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'admin')
            <a class="btn btn-default btn-xs" href="{{ route('admin') }}">
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
          {{-- INDEX BUTTON                                                                                                                   --}}
          {{--================================================================================================================================--}}
          <a class="btn btn-default btn-xs" href="{{ route('admin.posts.index') }}">
            <div class="text text-left">
              <i class="fa fa-list"></i> Posts List
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
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">{{ ucwords($post->title) }}</div>
				<div class="panel-body">
					<p class="lead">{!! $post->body !!}</p>
					<hr>
					<div class="tags">
						@if($post->tags->count() > 0)
							@foreach ($post->tags as $tag)
								<span class="label label-default">{{ $tag->name }}</span>
							@endforeach
						@else
							N/A
						@endif
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">Comments <small>({{ $post->comments()->count() }} total)</small></div>
				<div class="panel-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Comment</th>
								<th width="70px"></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($post->comments as $comment)
							<tr>
								<td>{{ $comment->name }}</td>
								<td>{{ $comment->email }}</td>
								<td>{{ $comment->comment }}</td>
								<td>
									@ability('admin','posts_edit_comments')
										<a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
									@endability
									@ability('admin','posts_delete_comments')
										<a href="{{ route('admin.comments.delete', $comment->id) }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
									@endability
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			
		</div>

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Details</div>
				<div class="panel-body">
					@if ($post->image)
						<dl class="dl-horizontal">
							<label>Image</label>
								<p>
									<a href="viewImage">
										{{ Html::image("images/posts/" . $post->image, "",array('height'=>'75','width'=>'125')) }}
									</a>
								</p>
						</dl>
					@endif
					
	<!-- 				<dl class="dl-horizontal">
						<label>Url:</label>
						<p><a href="{{ route('blog.single', $post->slug) }}">{{ route('blog.single', $post->slug) }}</a></p>
					</dl> -->

					<dl class="dl-horizontal">
						<label>Category:</label>
						<p>{{ $post->category->name }}</p>
					</dl>

					<dl class="dl-horizontal">
						<label>Created By:</label>
						<br />
						@include('layouts.common.author', ['model'=>$post, 'field'=>'user'])
						
					</dl>

					<dl class="dl-horizontal">
						<label>Created On:</label>
						<p>@include('layouts.common.dateFormat', ['model'=>$post, 'field'=>'created_at'])</p>
					</dl>

					<dl class="dl-horizontal">
						<label>Modified By:</label>
						<br />
						@include('layouts.common.author', ['model'=>$post, 'field'=>'modified_by'])
					</dl>

					<dl class="dl-horizontal">
						<label>Modified On:</label>
						<p>@include('layouts.common.dateFormat', ['model'=>$post, 'field'=>'updated_at'])</p>
					</dl>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade viewImage-modal-lg" id="viewImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Viewing post image</h4>
				</div>
				<div class="modal-body">
					{{ Html::image("images/posts/" . $post->image, "",array('height'=>'100%','width'=>'100%')) }}
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
