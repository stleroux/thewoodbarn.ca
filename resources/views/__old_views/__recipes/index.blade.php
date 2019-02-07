@extends ('layouts.main')

@section ('title', '| All Recipes')

@section ('stylesheets')
	{{ Html::style('css/recipes.css') }}
@stop

@section ('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li class="active">Recipes</li>
	</ol>

	<!-- Left Sidebar -->
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Recipes</div>
				<div class="panel-body">
					@if (count($recipes) > 0)
						<table id="datatable" class="table table-hover table-striped table-condensed">
							<thead>
								<tr>
									<th>Title</th>
									<th>Category</th>
									<th>Views</th>
									<th>Author</th>
									{{-- <th>Has Image</th> --}}
									@if (Auth::check())
										<th data-orderable="false"></th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach ($recipes as $recipe)
									<tr>
										<td>
											<a href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->title }}</a>
										</td>
										<td>{{ $recipe->category->name }}</td>
										<td>{{ $recipe->views }}</td>
										<td>@include('partials._author', ['model'=>$recipe, 'field'=>'user'])</td>
										{{-- <td>
											@if ($recipe->image)
												<div class="{{ ($recipe->personal)?'text text-danger':''}}">
													<i class="fa fa-check" aria-hidden="true"></i>
												</div>
											@else
												<div class="{{ ($recipe->personal)?'text text-danger':''}}">
													<i class="fa fa-ban" aria-hidden="true"></i>
												</div>
											@endif
										</td> --}}
										@if(Auth::check())
											<td>@include('includes.frontend.buttons', ['model'=>$recipe, 'field'=>'recipes', 'primer'=>'recipes', 'actions'=>['edit','delete']])</td>
										@endif
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<div class="alert alert-danger">No records found</div>
					@endif
				</div>
			</div>

			{{-- <div class="row">
				<div class="text-center">
					{!! $recipes->links(); !!}
				</div>
			</div> --}}

		</div>

		<div class="col-md-3">
			<div class="panel panel-default">
	      		<div class="panel-heading">Options</div>
	      		<div class="panel-body">
					<a href="{{ route('recipes.index','all') }}" class="btn btn-default btn-block">
						<div class="text text-left">
							<i class="fa fa-list-alt" aria-hidden="true"></i> Recipes List
						</div>
					</a>

					@if (Auth::check())
						@ability ('admin','recipes_list')
							<a href="{{ route('recipes.myrecipes') }}" class="btn btn-default btn-block">
								<div class="text text-left">
									<i class="fa fa-list" aria-hidden="true"></i> My Recipes
								</div>
							</a>
						@endability
						@ability ('admin','recipes_favorites')
							<a href="{{ route('recipes.viewfavorites') }}" class="btn btn-default btn-block">
								<div class="text text-left">
									<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> My Favorites
								</div>
							</a>
		      			@endability
		      			@ability ('admin','recipes_create')
							<hr>
							<a href="{{ route('recipes.create') }}" class="btn btn-primary btn-block">
								<div class="text text-left">
									<i class="fa fa-plus-square-o" aria-hidden="true"></i> Create Recipe
								</div>
							</a>
						@endability
					@endif
	      		</div>
	      	</div>

			<div class="panel panel-default">
				@include ('recipes.panels.alphabet')
			</div>
			
{{--
Replaced by datatable builtin search
 			<div class="panel panel-default">
	      		@include ('recipes.panels.search')
	      	</div>
--}}

	    </div>
	</div>




@stop

@section ('scripts')

@stop
