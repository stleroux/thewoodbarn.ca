@ability ('admin','recipes_favorites')
	<a href="{{ route('recipes.index','myFavorites') }}" class="{{ Request::is('recipes/index/myFavorites') ? "btn-primary": "btn-default" }} btn btn-xs">
		<div class="text text-left">
			<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> My Favorites
		</div>
	</a>
@endability