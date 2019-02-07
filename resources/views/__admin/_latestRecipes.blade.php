<div class="panel panel-primary">
	<div class="panel-heading">Latest Recipes</div>
	<div class="panel-body">
		<table class="table table-hover table-mini">
{{-- 			<thead>
				<tr>
					<th>Name</th>
					<th>Author</th>
					<th>Created</th>
				</tr>
			</thead> --}}
			<tbody>
				@foreach($latestRecipes as $recipe)
					<tr>
						<td>
							<a href="{{ route('recipes.show', $recipe->id) }}">
								<div>{{ str_limit($recipe->title, $limit = 24, $end = '...') }}</div>
							</a>
						</td>
						{{-- <td>@include('partials._author', ['model'=>$recipe, 'field'=>'user'])</td>
						<td>@include('partials._dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td> --}}
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="panel-footer">
		<div class="text-center">
			<a href="{{ route('admin.recipes.index') }}" class="btn btn-xs btn-primary">More Recipes</a>
		</div>
	</div>
</div>