@ability ('admin','admin,recipes_favorites')

	@if(count($recipe->users) > 0)
		<a href="{{ route('recipes.removefavorite', $recipe->id) }}" class="btn btn-default btn-xs">
			<div class="text text-left">
				<i class="fa fa-thumbs-o-down" aria-hidden="true"></i> Remove Favorite
			</div>
		</a>
	@else
		<a href="{{ route('recipes.addfavorite', $recipe->id) }}" class="btn btn-default btn-xs">
			<div class="text text-left">
				<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Add Favorite
			</div>
		</a>
	@endif
	
@endability