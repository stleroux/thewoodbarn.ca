@extends ('layouts.main')

@section ('title', '| View Recipe')

@section ('stylesheets')
	{{ Html::style('css/recipes.css') }}
@stop

@section ('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('recipes.index','all') }}">Recipes</a></li>
		<li class="active">{{ ucwords($recipe->title) }}</li>
	</ol>

	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="{{ ($recipe->personal)?'text text-danger':''}}">
						{{ ucwords($recipe->title) }}
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						@if ($recipe->image)
						<div class="col-md-8">
						@else
						<div class="col-md-12">
						@endif
							<div class="panel panel-default">
								<div class="panel-heading">Ingredients</div>
								<div class="panel-body">
									{!! $recipe->ingredients !!}
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">Methodology</div>
								<div class="panel-body">
									{!! $recipe->methodology !!}
								</div>
							</div>
						</div>
						@if ($recipe->image)
							<div class="col-md-4">
								<div class="panel panel-default">
									<div class="panel-heading">Image</div>
									<div class="panel-body text text-center">
										<a href="viewImage">
										{{ Html::image("images/recipes/" . $recipe->image, "", array('height'=>'150','width'=>'175')) }}</a>
									</div>
								</div>
							</div>
						@endif
					</div>
					
					<div class="row">
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">Category</div>
								<div class="panel-body text-center">{{ $recipe->category->name }}</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">Servings</div>
								<div class="panel-body text-center">{{ $recipe->servings }}</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">Prep Time (Minutes)</div>
								<div class="panel-body text-center">{{ $recipe->prep_time }}</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">Cook Time (Minutes)</div>
								<div class="panel-body text-center">{{ $recipe->cook_time }}</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">Personal</div>
								<div class="panel-body text-center">
									@if ($recipe->personal)
										<i class="fa fa-check" aria-hidden="true"></i>
									@else
										<i class="fa fa-ban" aria-hidden="true"></i>
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">Views</div>
								<div class="panel-body text-center">{{ $recipe->views }}</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">Source</div>
								<div class="panel-body text-center">
									@if ($recipe->source)
										{{ $recipe->source }}
									@else
										N/A
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Author's Notes</div>
								<div class="panel-body">
									@if ($recipe->public_notes) 
										{!! $recipe->public_notes !!}
									@else
										N/A
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Options</div>
				<div class="panel-body text">

					<!-- Only show this button if coming from the search results page -->
					@if (false !== stripos($_SERVER['HTTP_REFERER'], "/search/recipes"))
						<a href="{{ URL::previous() }}" class="btn btn-default btn-block">
							<div class="text text-left">
								<i class="fa fa-arrow-left" aria-hidden="true"></i>	Back to Search Results
							</div>
						</a>
					@endif

					<!-- Only show this button if coming from the recipes admin list page -->
					@if (false !== stripos($_SERVER['HTTP_REFERER'], "/admin/recipes"))
						<a href="{{ URL::previous() }}" class="btn btn-default btn-block">
							<div class="text text-left">
								<i class="fa fa-arrow-left" aria-hidden="true"></i>	Back
							</div>
						</a>
					@endif

					<a href="{{ route('recipes.index','all') }}" class="btn btn-default btn-block">
						<div class="text text-left">
							<i class="fa fa-list-alt" aria-hidden="true"></i> Recipes List
						</div>
					</a>

					@if (Auth::check())
						@ability ('admin','recipes_favorites')
							<a href="{{ route('recipes.addfavorite', $recipe->id) }}" class="btn btn-default btn-block">
								<div class="text text-left">
									<i class="fa fa-thumbs-o-up pull-left" aria-hidden="true"></i> Add To My Favorites
								</div>
							</a>
						@endability
						@ability ('admin','recipes_print')
							{{-- <a href="{{ route('recipes.print', $recipe->id) }}" class="btn btn-default btn-block">
								<div class="text text-left">
									<i class="fa fa-print" aria-hidden="true"></i> Print Recipe
								</div>
							</a> --}}
							<a href="" type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#printRecipeModal">
								<div class="text text-left">
									<i class="fa fa-print" aria-hidden="true"></i> Print Recipe
								</div>
							</a>
						@endability
						
						@ability ('admin','recipes_create')
							<hr>
							<a href="{{ route('recipes.create') }}" class="btn btn-primary btn-block">
								<div class="text text-left">
									<i class="fa fa-plus-square-o" aria-hidden="true"></i> Create New Recipe
								</div>
							</a>
						@endability

						@if (Auth::user()->id == $recipe->user_id)
							@ability ('admin','recipes_edit_own')
								<a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-primary btn-block">
									<div class="text text-left">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit This Recipe
									</div>
								</a>
							@endability
						@else
							@ability ('admin','recipes_edit')
								<a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-primary btn-block">
									<div class="text text-left">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit This Recipe
									</div>
								</a>
							@endability
						@endif

						@if (Auth::user()->id == $recipe->user_id)
							@ability('admin','recipes_delete_own')
								<a href="{{ route('recipes.delete', $recipe->id) }}" class="btn btn-danger btn-block">
									<div class="text text-left">
										<i class="glyphicon glyphicon-list"></i>
										Delete
									</div>
								</a>
             				@endability
						@else
							@ability('admin','recipes_delete')
								<a href="{{ route('recipes.delete', $recipe->id) }}" class="btn btn-danger btn-block">
									<div class="text text-left">
										<i class="glyphicon glyphicon-list"></i>
										Delete
									</div>
								</a>
							@endability
						@endif

						@ability ('admin','recipes_private')
							@if ((Auth::user()->id == $recipe->user_id) && (!$recipe->personal))
								<hr>
								<a href="{{ route('recipes.makeprivate', $recipe->id) }}" class="btn btn-default btn-block">
									<div class="text text-left">
										<i class="fa fa-trash-o" aria-hidden="true"></i> Make Private
									</div>
								</a>
							@endif

							@if ((Auth::user()->id == $recipe->user_id) && ($recipe->personal))
								<hr>
								<a href="{{ route('recipes.removeprivate', $recipe->id) }}" class="btn btn-default btn-block">
									<div class="text text-left">
										<i class="fa fa-trash-o" aria-hidden="true"></i> Remove Private
									</div>
								</a>
							@endif
						@endability
					@endif



				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Information</div>
				<div class="panel-body">

					Created By : @include('partials._author', ['model'=>$recipe, 'field'=>'user']) <br />
					Created On : @include('partials._dateFormat', ['model'=>$recipe, 'field'=>'created_at']) <br />

					@if ($recipe->modified_by_id)
						<br />
						Modified By : @include('partials._author', ['model'=>$recipe, 'field'=>'modified_by']) <br />
						Modified On : @include('partials._dateFormat', ['model'=>$recipe, 'field'=>'updated_at']) <br />
					@endif

					@if ($recipe->last_viewed_by)
						<br />
						Last Viewed By : @include('partials._author', ['model'=>$recipe, 'field'=>'last_viewed_by']) <br />
						Last Viewed On : @include('partials._dateFormat', ['model'=>$recipe, 'field'=>'last_viewed_on']) <br />
					@endif

				</div>
			</div>
		</div>
	</div>


{{-- MODAL --}}
<div class="modal fade" id="printRecipeModal" tabindex="-1" role="dialog" aria-labelledby="printRecipeModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="favoritesModalLabel">Recipe Printing Instructions</h4>
			</div>
			<div class="modal-body">
				<p>To print this recipe, please use your browser's print functionality.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<span class="pull-right">
					<a href="{{ route('recipes.print', $recipe->id) }}" class="btn btn-default btn-block">
						<div class="text text-left">
  							<i class="fa fa-print" aria-hidden="true"></i> Proceed
						</div>
					</a>
				</span>
			</div>
		</div>
	</div>
</div>
@stop

@section ('scripts')
@stop