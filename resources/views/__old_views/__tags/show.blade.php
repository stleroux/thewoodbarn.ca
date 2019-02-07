@extends ('layouts.main')

@section ('title', "| $tag->name Tag")

@section ('stylesheets')
	{{ Html::style('css/admin.css') }}
@stop

@section ('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('admin.tags.index') }}">Tags</a></li>
		<li class="active">{{ ucwords($tag->name) }}</li>
	</ol>

	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $tag->name }} Tag <small>({{ $tag->posts()->count() }} Posts)</small></div>
				<div class="panel-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Tags</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($tag->posts as $post)
								<tr>
									<th>{{ $post->id }}</th>
									<td>{{ $post->title }}</td>
									<td>
										@foreach ($post->tags as $tag)
											<span class="label label-default">{{ $tag->name }}</span>
										@endforeach
									</td>
									<td>
										@ability('admin','posts_list')
											<a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-default btn-xs pull-right">View Post</a></td>
										@endability
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Options</div>
				<div class="panel-body">
					<div>
						<div class"col-md-12">
							<a href="{{ route ('admin.tags.index') }}" class="btn btn-default btn-block">Tags List</a>
						</div>
						<div class"col-md-12">
							@ability('admin','tags_edit')
								<a href="{{ route ('admin.tags.edit', $tag->id) }}" class="btn btn-primary btn-block">
									<i class="glyphicon glyphicon-pencil"></i>
									Edit Tag
								</a>
							@endability
						</div>
						<div class"col-md-12">
							@ability('admin','tags_delete')
								{!! Form::open(['method' => 'DELETE', 'route' => ['admin.tags.destroy', $tag->id], 'style' => 'display:inline']) !!}
									<button
										class="btn btn-block btn-danger"
										type="button"
										data-toggle="modal"
										data-target="#confirmDelete"
										data-title="Delete Tag"
										data-message="Are you sure you want to delete this tag?">
											<i class="glyphicon glyphicon-trash"></i>
											Delete Tag
									</button>
								{!! Form::close() !!}
							@endability
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section ('scripts')
@stop