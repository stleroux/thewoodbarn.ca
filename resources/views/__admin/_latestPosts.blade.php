<div class="panel panel-primary">
	<div class="panel-heading">Latest Posts</div>
	<div class="panel-body">
		<table class="table table-hover table-mini">
			<tbody>
				@foreach($latestPosts as $post)
					<tr>
						<td>
							<a href="{{ route('posts.show', $post->id) }}" title="{{ $post->title}}" style="text-decoration: none">
								<div>
									{{ str_limit($post->title, $limit = 25, $end = '...') }}
								</div>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="panel-footer">
		<div class="text-center">
			<a href="{{ route('posts.index') }}" class="btn btn-xs btn-primary">More Posts</a>
		</div>
	</div>
</div>