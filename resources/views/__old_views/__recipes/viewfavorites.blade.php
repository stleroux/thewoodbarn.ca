@extends ('layouts.main')

@section ('title', '| My Favorites')

@section ('stylesheets')
	{{ Html::style('css/recipes.css') }}
@stop

@section ('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('recipes.index','all') }}">Recipes</a></li>
		<li class="active">My Favorites Recipes</li>
	</ol>

	<!-- Left Sidebar -->
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">My Favorite Recipes</div>
				<div class="panel-body">
					@if (count($recipes) > 0)
						<table id="datatable" class="table table-hover table-striped table-condensed">
							<thead>
								<tr>
									<th>Title</th>
									<th>Category</th>
									<th>Views</th>
									<th>Author</th>
									<th>Image</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($recipes as $recipe)
									<tr>
										<td>
											<a href="{{ route('recipes.show', $recipe->id) }}" class="{{ ($recipe->personal)?'text text-danger':''}}">{{ $recipe->title }}</a>
										</td>
										<td>
											<div class="{{ ($recipe->personal)?'text text-danger':''}}">
												{{ $recipe->category->name }}
											</div>
										</td>
										<td>
											<div class="{{ ($recipe->personal)?'text text-danger':''}}">
												{{ $recipe->views }}
											</div>
										</td>
										<td>
											<div class="{{ ($recipe->personal)?'text text-danger':''}}">
												@include('partials._author', ['model'=>$recipe , 'field'=>'user'])
											</div>
										</td>
										<td>
											@if ($recipe->image)
												<div class="{{ ($recipe->personal)?'text text-danger':''}}">
													<i class="fa fa-check" aria-hidden="true"></i>
												</div>
											@else
												<div class="{{ ($recipe->personal)?'text text-danger':''}}">
													<i class="fa fa-ban" aria-hidden="true"></i>
												</div>
											@endif
										</td>
										<td><a href="{{ route('recipes.removefavorite', $recipe->id) }}" class="btn btn-default btn-xs">Remove Favorite</a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<div class="alert alert-danger">No records found</div>
					@endif
				</div>
			</div>

			<div class="row">
				<div class="text-center">
					
				</div>
			</div>

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
						{{-- @if (Auth::user()->hasAnyRole(['author', 'editor', 'admin'])) --}}
							<a href="{{ route('recipes.myrecipes') }}" class="btn btn-default btn-block">
								<div class="text text-left">
									<i class="fa fa-list" aria-hidden="true"></i> My Recipes
								</div>
							</a>
						{{-- @endif --}}

						@if (Auth::check())
							<a href="{{ route('recipes.viewfavorites') }}" class="btn btn-default btn-block">
								<div class="text text-left">
									<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> My Favorites
								</div>
							</a>
						@endif

		      			{{-- @if (Auth::user()->hasAnyRole(['author', 'editor', 'admin'])) --}}
							<hr>
							<a href="{{ route('recipes.create') }}" class="btn btn-primary btn-block">
								<div class="text text-left">
									<i class="fa fa-plus-square-o" aria-hidden="true"></i> Create Recipe
								</div>
							</a>
						{{-- @endif --}}
					@endif
					
	      		</div>
	      	</div>
{{-- 			<div class="panel panel-default">
				@include ('recipes.panels.alphabet')
			</div>

			<div class="panel panel-default">
	      		@include ('recipes.panels.search')
	      	</div> --}}

	    </div>
	</div>
@stop

@section ('scripts')
    <script type="text/javascript">
		$.dynatableSetup({
			// your global default options here
			features: {
				search: false,
			},
			dataset: {
				perPageDefault: 20,
				perPageOptions: [10,15,20,25,50,100],
			},
		});
        $(document).ready( function () {
            $('#datatable').dynatable();
        } );
    </script>
@stop