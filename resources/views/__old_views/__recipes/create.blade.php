@extends ('layouts.main')

@section ('title', '| Create New Recipe')

@section ('stylesheets')
	{{ Html::style('css/recipes.css') }}
@stop

@section ('content')

	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('recipes.index','all') }}">Recipes</a></li>
		<li class="active">New Recipe</li>
	</ol>

	{!! Form::open(array('route'=>'recipes.store', 'files'=>'true')) !!}
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">New Recipe</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Name</div>
								<div class="panel-body">
									<div class="{{ $errors->has('title') ? 'has-error' : '' }}" >
										{{ Form::text ('title', null, array('class' => 'form-control', 'autofocus'=>'autofocus')) }}
										<span class="text-danger">{{ $errors->first('title') }}</span>
									</div>
								</div>
							</div>
				    	</div>
				    </div>
			    	
					<div class="row">
						<div class="col-md-8">
							<div class="panel panel-default">
								<div class="panel-heading">Ingredients <small>(One per line)</small></div>
								<div class="panel-body">
									<div class="{{ $errors->has('ingredients') ? 'has-error' : '' }}" >
		    							{{ Form::textarea ('ingredients', null, array('class' => 'form-control simple', 'rows'=>'5')) }}
		    							<span class="text-danger">{{ $errors->first('ingredients') }}</span>
		    						</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">Methodology <small>(One per line)</small></div>
								<div class="panel-body">
									<div class="{{ $errors->has('methodology') ? 'has-error' : '' }}" >
										{{ Form::textarea ('methodology', null, array('class' => 'form-control simple', 'rows'=>'5')) }}
										<span class="text-danger">{{ $errors->first('methodology') }}</span>
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
					</div>
					
					<div class="row">
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">Category</div>
								<div class="panel-body">
									{{ Form::select('category_id', $categories, null, ['class'=>'form-control']) }}
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="panel panel-default">
								<div class="panel-heading">Servings</div>
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
								<div class="panel-heading">Prep Time</div>
								<div class="panel-body">
									<div class="{{ $errors->has('prep_time') ? 'has-error' : '' }}" >
										{{ Form::text ('prep_time', null, array('class' => 'form-control', 'placeholder'=>'minutes')) }}
										<span class="text-danger">{{ $errors->first('prep_time') }}</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="panel panel-default">
								<div class="panel-heading">Cook Time</div>
								<div class="panel-body">
									<div class="{{ $errors->has('cook_time') ? 'has-error' : '' }}" >
										{{ Form::text ('cook_time', null, array('class' => 'form-control', 'placeholder'=>'minutes')) }}
										<span class="text-danger">{{ $errors->first('cook_time') }}</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
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
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">Source</div>
								<div class="panel-body">
									{{ Form::text ('source', null, array('class' => 'form-control')) }}
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
				<div class="panel-body">
					
					{{Form::button('<div class="text text-left"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Recipe</div>', array('type' => 'submit', 'class' => 'btn btn-success btn-block'))}}

					<a href="{{ route('recipes.index','all') }}" class="btn btn-default btn-block">
						<div class="text text-left">
							<i class="fa fa-ban" aria-hidden="true"></i> Cancel
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
@stop

@section ('scripts')
@stop