<div class="panel panel-primary">
	<div class="panel-heading">Latest Articles</div>
	<div class="panel-body">
		<table class="table table-hover table-mini">
			<tbody>
				@foreach($latestArticles as $article)
					<tr>
						<td>
							<a href="{{ route('articles.show', $article->id) }}" title="{{ $article->title}}" style="text-decoration: none">
								<div>
									{{ str_limit($article->title, $limit = 25, $end = '...') }}
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
			<a href="{{ route('articles.index') }}" class="btn btn-xs btn-primary">More Articles</a>
		</div>
	</div>
</div>
