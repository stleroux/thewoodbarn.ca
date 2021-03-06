{{-- Used to display recipe list when user clicks on links in the recipe archives block on the main page --}}

@extends ('layouts.main')

@section ('title', '| Recipes Archive')

@section ('stylesheets')
	{{ Html::style('css/recipes.css') }}
@stop

@section ('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="#">Recipes</a></li>
		<li class="active">Archives</li>
	</ol>

	<div class="row">
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							Recipe Archives for 
								@if ($month == 01) January @endif
								@if ($month == 02) February @endif
								@if ($month == 03) March @endif
								@if ($month == 04) April @endif
								@if ($month == 05) May @endif
								@if ($month == 06) June @endif
								@if ($month == 07) July @endif
								@if ($month == 08) August @endif
								@if ($month == 09) September @endif
								@if ($month == 10) October @endif
								@if ($month == 11) November @endif
								@if ($month == 12) December @endif
							{{ $year }}
						</div>
						<div class="panel-body">
							<table class="table">
								<thead>
									<tr>
										<th>Title</th>
										<th>Author</th>
										<th>Created At</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($archives as $archive)
										<tr>
											<td><a href="{{ route('blog.single', $archive->slug) }}">{{ $archive->title }}</a></td>
											<td>@include('partials._author', ['model'=>$archive, 'field'=>'user'])</td>
											<td>@include('partials._dateFormat', ['model'=>$archive, 'field'=>'created_at'])</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">Options</div>
						<div class="panel-body">
							<a href="/" class="btn btn-default btn-block">
								<div class="text text-left">
									<span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section ('scripts')
@stop
