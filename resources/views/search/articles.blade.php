@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/main.css') }}
@stop

@section ('title', '| Articles Search')

@section ('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('articles.index') }}">Articles</a></li>
		<li class="active">Article Search</li>
	</ol>

	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Articles Search Results</div>
				<div class="panel-body">
					@if (count($articles) > 0)
						<div class="row">
							<div class="col-md-12">
								<table id="datatable" class="table table-hover table-striped table-condensed">
									<thead>
										<th>Title</th>
										<!-- <th>Description</th> -->
										<th>Created At</th>
									</thead>
									<tbody>
										@foreach ($articles as $article)
											<tr>
												<td><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></td>
												<!--
												<td>
													{!! substr($article->description_eng, 0, 50) !!} {{ strlen($article->description_eng) > 50 ? " ..." : "" }}
												</td>
												-->
												<td>{{ date('M j, Y', strtotime($article->created_at)) }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>

								<!-- Display pagination links -->
								<div class="text-center">
									{!! $articles->render() !!}
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
					<!-- Only show the Search Results button if coming from the search results page -->
					<a href="{{ route('articles.index') }}" class="btn btn-default btn-block">
						<div class="text text-left">
							<i class="fa fa-list" aria-hidden="true"></i> Articles List
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
@stop

@section ('scripts')
{{--     <script type="text/javascript">
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
    </script> --}}
@stop