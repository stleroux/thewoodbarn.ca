@extends ('layouts.main')

@section ('title', 'View Recipe')

@section ('stylesheets')
	{{ Html::style('css/recipes.css') }}
@stop

@section('breadcrumb')
	<li><a href="/">Home</a></li>
	<li><a href="{{ route('recipes.index','all') }}">Recipes</a></li>
	<li class="active">View Recipe</li>
@stop

@section ('content')
	

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
										<a href="" data-toggle="modal" data-target="#viewImageModal">
											{{ Html::image("images/recipes/" . $recipe->image, "", array('height'=>'150','width'=>'175')) }}</a>
										</a>
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

          {{--================================================================================================================================--}}
          {{-- BACK TO CONTROL PANEL BUTTON (will only show if coming from the admin page)                                                    --}}
          {{--================================================================================================================================--}}
          @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'home')
            <a href="{{ route('home') }}" class="btn btn-default btn-sm btn-block">
              @if(Auth::check())
	              <div class="text text-left">
    	            @if(Auth::user()->actionButtons == 1){{-- Icons and Text --}}<i class="fa fa-arrow-left" aria-hidden="true"></i> Home
        	        @elseif(Auth::user()->actionButtons == 2){{-- Icons Only --}}<i class="fa fa-arrow-left" aria-hidden="true"></i>
            	    @elseif(Auth::user()->actionButtons == 3){{-- Text Only --}}Home
                	@endif
              	</div>
			  @else
			  	<div class="text text-left">
			  		<i class="fa fa-arrow-left" aria-hidden="true"></i> Home
			  	</div>
              @endif
            </a>
          @endif
          {{--================================================================================================================================--}}
          {{-- END BACK TO CONTROL PANEL BUTTON                                                                                               --}}
          {{--================================================================================================================================--}}
          
					<!-- Only show this button if coming from the myRecipes page -->
					@if (false !== stripos($_SERVER['HTTP_REFERER'], "/recipes/myRecipes"))
						<a href="{{ URL::previous() }}" class="btn btn-default btn-sm btn-block">
							<div class="text text-left">
								<i class="fa fa-arrow-left" aria-hidden="true"></i>	Back
							</div>
						</a>
					@endif

					<!-- Only show this button if coming from the myFavorites page -->
					@if (false !== stripos($_SERVER['HTTP_REFERER'], "/recipes/myFavorites"))
						<a href="{{ URL::previous() }}" class="btn btn-default btn-sm btn-block">
							<div class="text text-left">
								<i class="fa fa-arrow-left" aria-hidden="true"></i>	Back
							</div>
						</a>
					@endif

					<!-- Only show this button if coming from the search results page -->
					@if (false !== stripos($_SERVER['HTTP_REFERER'], "/search/recipes"))
						<a href="{{ URL::previous() }}" class="btn btn-default btn-sm btn-block">
							<div class="text text-left">
								<i class="fa fa-arrow-left" aria-hidden="true"></i>	Back to Search Results
							</div>
						</a>
					@endif

					<!-- Only show the Back to Archives List button if coming from the archive page -->
					@if ($url = Session::get('backUrl'))
						<a href="{{ $url }}" class="btn btn-default btn-sm btn-block">
							<div class="text text-left">
								<i class="fa fa-arrow-left" aria-hidden="true"></i>
								Back to Archives List
							</div>
						</a>
					@endif
					<!-- Only show this button if coming from the recipes admin list page -->
					@if (false !== stripos($_SERVER['HTTP_REFERER'], "/admin/recipes"))
						<a href="{{ URL::previous() }}" class="btn btn-default btn-sm btn-block">
							<div class="text text-left">
								<i class="fa fa-arrow-left" aria-hidden="true"></i>	Back
							</div>
						</a>
					@endif

					<a href="{{ route('recipes.index','all') }}" class="btn btn-default btn-sm btn-block">
						<div class="text text-left">
							<i class="fa fa-list-alt" aria-hidden="true"></i> Recipes List
						</div>
					</a>

					@if (Auth::check())

						@if(checkACL('author'))
							@if(($recipe->published == 1) AND ($recipe->published_at <= Carbon\Carbon::Now()))
								@if(count($recipe->users))
									<a href="{{ route('recipes.removefavorite', $recipe->id) }}" class="btn btn-default btn-sm btn-block">
										<div class="text text-left">
											<i class="fa fa-thumbs-o-down pull-left" aria-hidden="true"></i> Remove Favorite
										</div>
									</a>
								@else
									<a href="{{ route('recipes.addfavorite', $recipe->id) }}" class="btn btn-default btn-sm btn-block">
										<div class="text text-left">
											<i class="fa fa-thumbs-o-up pull-left" aria-hidden="true"></i> Add To My Favorites
										</div>
									</a>
								@endif
							@endif							
						@endif

						@if(checkACL('author'))
							<a href="" type="button" class="btn btn-default btn-sm btn-block" data-toggle="modal" data-target="#printRecipeModal">
								<div class="text text-left">
									<i class="fa fa-print" aria-hidden="true"></i> Print Recipe
								</div>
							</a>
						@endif
						

						@if(checkACL('editor', $recipe))
							<a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-info btn-sm btn-block">
								<div class="text text-left">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Recipe
								</div>
							</a>
						@endif

						@if(checkACL('manager', $recipe))
							<a href="{{ route('recipes.delete', $recipe->id) }}" class="btn btn-danger btn-sm btn-block">
								<div class="text text-left">
									<i class="glyphicon glyphicon-list"></i>
									Delete Recipe
								</div>
							</a>
						@endif

						{{-- @if(checkACL('author', $recipe)) --}}
						@if((checkACL('admin', $recipe)) || checkOwner($recipe))
							@if(!$recipe->personal)
							<a href="{{ route('recipes.makeprivate', $recipe->id) }}" class="btn btn-default btn-sm btn-block">
								<div class="text text-left">
									<i class="fa fa-trash-o" aria-hidden="true"></i> Make Private
								</div>
							</a>
							@else
							<a href="{{ route('recipes.removeprivate', $recipe->id) }}" class="btn btn-default btn-sm btn-block">
								<div class="text text-left">
									<i class="fa fa-trash-o" aria-hidden="true"></i> Remove Private
								</div>
							</a>
							@endif
						@endif

					@endif
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Information</div>
				<div class="panel-body">

					Created By : @include('layouts.author', ['model'=>$recipe, 'field'=>'user']) <br />
					Created On : @include('layouts.dateFormat', ['model'=>$recipe, 'field'=>'created_at']) <br />

					@if ($recipe->modified_by_id)
						<br />
						Modified By : @include('layouts.author', ['model'=>$recipe, 'field'=>'modified_by']) <br />
						Modified On : @include('layouts.dateFormat', ['model'=>$recipe, 'field'=>'updated_at']) <br />
					@endif

					@if ($recipe->last_viewed_by)
						<br />
						Last Viewed By : @include('layouts.author', ['model'=>$recipe, 'field'=>'last_viewed_by']) <br />
						Last Viewed On : @include('layouts.dateFormat', ['model'=>$recipe, 'field'=>'last_viewed_on']) <br />
					@endif

				</div>
			</div>
		</div>
	</div>


  {{-- PRINT MODAL --}}
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
				<button type="button" class="btn-default" data-dismiss="modal">Cancel</button>
				<span class="pull-right">
					<a href="{{ route('recipes.print', $recipe->id) }}" class="btn-default btn-block">
						<div class="text text-left">
								<i class="fa fa-print" aria-hidden="true"></i> Proceed
						</div>
					</a>
				</span>
			</div>
		</div>
	</div>
  </div>

  {{-- IMAGE MODAL --}}
  <div class="modal fade" id="viewImageModal" tabindex="-1" role="dialog" aria-labelledby="viewImageModalLabel">
	<div class="modal-dialog modal-lg" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		  <h4 class="modal-title" id="printArticleModalLabel">Recipe Image</h4>
		</div>
		<div class="modal-body">
		  <p>{{ Html::image("images/recipes/" . $recipe->image, "", array('height'=>'100%','width'=>'100%')) }}</a></p>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div>
	</div>
  </div>
@stop

@section ('scripts')
@stop