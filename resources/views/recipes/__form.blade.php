{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'add')

	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading required">Name</div>
				<div class="panel-body">
					<div class="{{ $errors->has('title') ? 'has-error' : '' }}" >
						{{ Form::text ('title', null, array('class' => 'form-control', 'autofocus'=>'autofocus')) }}
						<span class="text-danger">{{ $errors->first('title') }}</span>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading required">Ingredients <small>(One per line)</small></div>
				<div class="panel-body">
					<div class="{{ $errors->has('ingredients') ? 'has-error' : '' }}" >
						{{ Form::textarea ('ingredients', null, array('class' => 'form-control simple', 'rows'=>'5')) }}
						<span class="text-danger">{{ $errors->first('ingredients') }}</span>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading required">Methodology <small>(One per line)</small></div>
				<div class="panel-body">
					<div class="{{ $errors->has('methodology') ? 'has-error' : '' }}" >
						{{ Form::textarea ('methodology', null, array('class' => 'form-control simple', 'rows'=>'5')) }}
						<span class="text-danger">{{ $errors->first('methodology') }}</span>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-2">
			<div class="panel panel-default">
				<div class="panel-heading required">Category</div>
				<div class="panel-body">
					{{ Form::select('category_id', array('' => 'Select a category') + $categories, null , ['class' => 'form-control']) }}
					<span class="text-danger">{{ $errors->first('category_id') }}</span>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading required">Servings</div>
				<div class="panel-body">
					<div class="{{ $errors->has('servings') ? 'has-error' : '' }}" >
						{{ Form::text ('servings', null, array('class' => 'form-control')) }}
						<span class="text-danger">{{ $errors->first('servings') }}</span>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-2">
			<div class="panel panel-default">
				<div class="panel-heading required">Prep Time</div>
				<div class="panel-body">
					<div class="{{ $errors->has('prep_time') ? 'has-error' : '' }}" >
						{{ Form::text ('prep_time', null, array('class' => 'form-control', 'placeholder'=>'minutes')) }}
						<span class="text-danger">{{ $errors->first('prep_time') }}</span>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading required">Cook Time</div>
				<div class="panel-body">
					<div class="{{ $errors->has('cook_time') ? 'has-error' : '' }}" >
						{{ Form::text ('cook_time', null, array('class' => 'form-control', 'placeholder'=>'minutes')) }}
						<span class="text-danger">{{ $errors->first('cook_time') }}</span>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">Image</div>
				<div class="panel-body">
					{{ Form::file('image', ['class'=>'form-control']) }}
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">Source</div>
				<div class="panel-body">
					{{ Form::text ('source', null, array('class' => 'form-control')) }}
				</div>
			</div>
		</div>

		<div class="col-md-2">
			<div class="panel panel-default">
				<div class="panel-heading">Make Private</div>
				<div class="panel-body text-center">
					{{ Form::select('personal', array('0' => 'No', '1' => 'Yes'), 0, ['class'=>'form-control']) }}
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Public Notes</div>
				<div class="panel-body">
					{{ Form::textarea ('public_notes', null, array('class' => 'form-control simple', 'rows'=>'2')) }}
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Author's Personal Notes <small>(not shown to public)</small></div>
				<div class="panel-body">
					{{ Form::textarea ('author_notes', null, array('class' => 'form-control simple', 'rows'=>'2')) }}
				</div>
			</div>
		</div>
	</div>

@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'edit')

	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading required">Name</div>
				<div class="panel-body">
					<div class="{{ $errors->has('title') ? 'has-error' : '' }}" >
						{{ Form::text ('title', null, array('class' => 'form-control', 'autofocus'=>'autofocus')) }}
						<span class="text-danger">{{ $errors->first('title') }}</span>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading required">Ingredients <small>(One per line)</small></div>
				<div class="panel-body">
					<div class="{{ $errors->has('ingredients') ? 'has-error' : '' }}" >
						{{ Form::textarea ('ingredients', null, array('class' => 'form-control simple', 'rows'=>'5')) }}
						<span class="text-danger">{{ $errors->first('ingredients') }}</span>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading required">Methodology <small>(One per line)</small></div>
				<div class="panel-body">
					<div class="{{ $errors->has('methodology') ? 'has-error' : '' }}" >
						{{ Form::textarea ('methodology', null, array('class' => 'form-control simple', 'rows'=>'5')) }}
						<span class="text-danger">{{ $errors->first('methodology') }}</span>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-2">
			<div class="panel panel-default">
				<div class="panel-heading required">Category</div>
				<div class="panel-body">
					{{-- {{ Form::select('category_id', array('' => 'Select a category') + $categories, null , ['class' => 'form-control']) }} --}}
					{{ Form::select('category_id', $categories, null, ['class'=>'form-control']) }}
					<span class="text-danger">{{ $errors->first('category_id') }}</span>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading required">Servings</div>
				<div class="panel-body">
					<div class="{{ $errors->has('servings') ? 'has-error' : '' }}" >
						{{ Form::text ('servings', null, array('class' => 'form-control')) }}
						<span class="text-danger">{{ $errors->first('servings') }}</span>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Image</div>
				<div class="panel-body">
					@if ($recipe->image)
						{{ Html::image("images/recipes/" . $recipe->image, "", array('height'=>'100%','width'=>'100%')) }}
					@else
						<i class="fa fa-5x fa-ban" aria-hidden="true"></i>
					@endif
					<br /><br />
					{{ Form::file('image', ['class'=>'form-control']) }}
				</div>
			</div>
		</div>

		<div class="col-md-2">
			<div class="panel panel-default">
				<div class="panel-heading required">Prep Time</div>
				<div class="panel-body">
					<div class="{{ $errors->has('prep_time') ? 'has-error' : '' }}" >
						{{ Form::text ('prep_time', null, array('class' => 'form-control', 'placeholder'=>'minutes')) }}
						<span class="text-danger">{{ $errors->first('prep_time') }}</span>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading required">Cook Time</div>
				<div class="panel-body">
					<div class="{{ $errors->has('cook_time') ? 'has-error' : '' }}" >
						{{ Form::text ('cook_time', null, array('class' => 'form-control', 'placeholder'=>'minutes')) }}
						<span class="text-danger">{{ $errors->first('cook_time') }}</span>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Make Private</div>
				<div class="panel-body text-center">
					{{ Form::select('personal', array('0' => 'No', '1' => 'Yes'), 0, ['class'=>'form-control']) }}
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">Source</div>
				<div class="panel-body">
					{{ Form::text ('source', null, array('class' => 'form-control')) }}
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Public Notes</div>
				<div class="panel-body">
					{{ Form::textarea ('public_notes', null, array('class' => 'form-control simple', 'rows'=>'2')) }}
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Author's Personal Notes <small>(not shown to public)</small></div>
				<div class="panel-body">
					{{ Form::textarea ('author_notes', null, array('class' => 'form-control simple', 'rows'=>'2')) }}
				</div>
			</div>
		</div>
	</div>

@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'show')
	<div class="row">
		<div class="col-md-12">
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
											
											@if ($recipe->image)
											{{-- Open larger image in modal window  --}}
												{{-- <a href="{{ route('recipes.viewImage', $recipe->id) }}" data-toggle="modal" data-target="viewImageModal"> --}}
												<a href="" data-toggle="modal" data-target="#viewImageModal">

												{{ Html::image("images/recipes/" . $recipe->image, "",array('height'=>'175','width'=>'175')) }}</a>
											@else
												<i class="fa fa-5x fa-ban" aria-hidden="true"></i>
											@endif
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
									<div class="panel-heading">Public Notes</div>
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
						
						@if(Auth::check())
							@if(Auth::user()->id == $recipe->user_id)
								<div class="row">
									<div class="col-md-12">
										<div class="panel panel-default">
											<div class="panel-heading">Author's Notes</div>
											<div class="panel-body">
												@if ($recipe->author_notes) 
													{!! $recipe->public_notes !!}
												@else
													N/A
												@endif
											</div>
										</div>
									</div>
								</div>
							@endif
						@endif

						<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Information</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-sm-4">
											<div class="panel panel-default">
												<div class="panel-heading">Created</div>
												<div class="panel-body">
													By : @include('layouts.common.author', ['model'=>$recipe, 'field'=>'user']) <br />
													On : @include('layouts.common.dateFormat', ['model'=>$recipe, 'field'=>'created_at']) <br />
												</div>
											</div>
										</div>

										{{-- Created By : @include('partials._author', ['model'=>$recipe, 'field'=>'user']) <br />
										Created On : @include('partials._dateFormat', ['model'=>$recipe, 'field'=>'created_at']) <br /> --}}

										@if ($recipe->modified_by_id)
											<div class="col-sm-4">
												<div class="panel panel-default">
													<div class="panel-heading">Modified</div>
													<div class="panel-body">
														By : @include('layouts.common.author', ['model'=>$recipe, 'field'=>'modified_by']) <br />
														On : @include('layouts.common.dateFormat', ['model'=>$recipe, 'field'=>'updated_at']) <br />
													</div>
												</div>
											</div>
										@endif

										@if ($recipe->last_viewed_by)
											<div class="col-sm-4">
												<div class="panel panel-default">
													<div class="panel-heading">Last Viewed</div>
													<div class="panel-body">
														By : @include('layouts.common.author', ['model'=>$recipe, 'field'=>'last_viewed_by']) <br />
														On : @include('layouts.common.dateFormat', ['model'=>$recipe, 'field'=>'last_viewed_on']) <br />
													</div>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
{{-- 
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
						@endif

					</div>
				</div>
			</div> --}}

			
		</div>
	</div>
	@include('includes.common.viewImageModal')
	@include('includes.common.printModal')
	@include('includes.common.confirmDeleteImageModal')
	@include('includes.common.confirmDele')

	
@endif

