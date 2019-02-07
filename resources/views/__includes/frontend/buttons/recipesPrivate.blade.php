@ability ('admin','recipes_private')
	@if ((Auth::user()->id == $recipe->user_id) && (!$recipe->personal))
		
		<a href="{{ route('recipes.makeprivate', $recipe->id) }}" class="btn btn-default btn-xs">
			<div class="text text-left">
				<i class="fa fa-trash-o" aria-hidden="true"></i> Make Private
			</div>
		</a>
	@endif

	@if ((Auth::user()->id == $recipe->user_id) && ($recipe->personal))
		
		<a href="{{ route('recipes.removeprivate', $recipe->id) }}" class="btn btn-default btn-xs">
			<div class="text text-left">
				<i class="fa fa-trash-o" aria-hidden="true"></i> Remove Private
			</div>
		</a>
	@endif
@endability