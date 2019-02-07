@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/main.css') }}
@stop

@section ('content')
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="/">Home</a></li>
			<li><a href="{{ route('recipes.index','all') }}">Recipes</a></li>
			<li class="active">Recipe Search</li>
		</ol>
	</div>

	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Recipes Search Results</div>
				<div class="panel-body">
					@if (count($recipes) > 0)
						<div class="row">
							<div class="col-md-12">
								<table id="datatable" class="table table-hover table-striped">
									<thead>
										<th>#</th>
										<th>Title</th>
										<th>Views</th>
										<th>Author</th>
										<th>Create Date</th>
									</thead>
									<tbody>
										@foreach ($recipes as $recipe)
											<tr>
												<td>{{ $recipe->id }}</td>
												<td><a href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->title }}</a></td>
												<td>{{ $recipe->views }}</td>
												<td><a href="{{ route('profile.showUser', $recipe->user_id) }}">{{ displayAuthor($recipe) }}</a></td>
												<td>{{ date('M j, Y', strtotime($recipe->created_at)) }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>

								<!-- Display pagination links -->
								<div class="text-center">
									{!! $recipes->render() !!}
								</div>
							</div>
						</div>
					@else
						<div class="row">
							<div class="col-md-12">
								<p class="alert alert-danger">No results found</p>
							</div>
						</div>
					@endif
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
				</div>
			</div>
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