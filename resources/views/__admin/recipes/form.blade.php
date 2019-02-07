<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Name</div>
								<div class="panel-body">
									@if($action_name == 'show')
										{!! htmlspecialchars_decode($recipe->title) !!}
									@else
										<div class="{{ $errors->has('title') ? 'has-error' : '' }}" >
											{{ Form::text ('title', null, array('class' => 'form-control', 'autofocus'=>'autofocus')) }}
											<span class="text-danger">{{ $errors->first('title') }}</span>
										</div>
									@endif
								</div>
							</div>
				    	</div>
				    </div>
			    	
					<div class="row">
						<div class="col-md-9">
							<div class="panel panel-default">
								<div class="panel-heading">Ingredients <small>(One per line)</small></div>
								<div class="panel-body">
									@if($action_name == 'show')
		    							{!! htmlspecialchars_decode($recipe->ingredients) !!}
		    						@else
		    							<div class="{{ $errors->has('ingredients') ? 'has-error' : '' }}" >
			    							{{ Form::textarea ('ingredients', null, array('class' => 'form-control simple', 'rows'=>'5')) }}
			    							<span class="text-danger">{{ $errors->first('ingredients') }}</span>
			    						</div>
			    					@endif
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">Methodology <small>(One per line)</small></div>
								<div class="panel-body">
									@if($action_name == 'show')
										{!! htmlspecialchars_decode($recipe->methodology) !!}
									@else
										<div class="{{ $errors->has('methodology') ? 'has-error' : '' }}" >
											{{ Form::textarea ('methodology', null, array('class' => 'form-control simple', 'rows'=>'5')) }}
											<span class="text-danger">{{ $errors->first('methodology') }}</span>
										</div>
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">Image</div>
								<div class="panel-body">
									@if($action_name == 'show')
										<div class="text text-center">
											@if($recipe->image)
		    									{{ Html::image("images/recipes/" . $recipe->image, "",array('height'=>'115','width'=>'115')) }}
		    								@else
		    									<i class="fa fa-5x fa-picture-o" aria-hidden="true"></i>
		    								@endif
	    								</div>
	    							@else
	    								{{ Form::file('image', ['class'=>'form-control']) }}
	    							@endif
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">Source</div>
								<div class="panel-body">
									@if($action_name == 'show')
										{!! htmlspecialchars_decode($recipe->source) !!}
									@else
										{{ Form::text ('source', null, array('class' => 'form-control')) }}
									@endif
								</div>
							</div>
						
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">Category</div>
								<div class="panel-body">
									@if($action_name == 'show')
										{!! htmlspecialchars_decode($recipe->category->name) !!}
									@else
										{{ Form::select('category_id', $categories, null, ['class'=>'form-control']) }}
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="panel panel-default">
								<div class="panel-heading">Servings</div>
								<div class="panel-body">
									@if($action_name == 'show')
										{!! htmlspecialchars_decode($recipe->servings) !!}
									@else
										<div class="{{ $errors->has('servings') ? 'has-error' : '' }}" >
											{{ Form::text ('servings', null, array('class' => 'form-control')) }}
											<span class="text-danger">{{ $errors->first('servings') }}</span>
										</div>
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="panel panel-default">
								<div class="panel-heading">Prep Time</div>
								<div class="panel-body">
									@if($action_name == 'show')
										{!! htmlspecialchars_decode($recipe->prep_time) !!}
									@else
										<div class="{{ $errors->has('prep_time') ? 'has-error' : '' }}" >
											{{ Form::text ('prep_time', null, array('class' => 'form-control', 'placeholder'=>'minutes')) }}
											<span class="text-danger">{{ $errors->first('prep_time') }}</span>
										</div>
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="panel panel-default">
								<div class="panel-heading">Cook Time</div>
								<div class="panel-body">
									@if($action_name == 'show')
										{!! htmlspecialchars_decode($recipe->cook_time) !!}
									@else
										<div class="{{ $errors->has('cook_time') ? 'has-error' : '' }}" >
											{{ Form::text ('cook_time', null, array('class' => 'form-control', 'placeholder'=>'minutes')) }}
											<span class="text-danger">{{ $errors->first('cook_time') }}</span>
										</div>
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">Make Private</div>
								<div class="panel-body text-center">
									@if($action_name == 'show')
										{!! htmlspecialchars_decode($recipe->private) !!}
									@else
										{{ Form::select('personal', array('0' => 'No', '1' => 'Yes'), 0, ['class'=>'form-control']) }}
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
									@if($action_name == 'show')
										{!! htmlspecialchars_decode($recipe->public_notes) !!}
									@else
										{{ Form::textarea ('public_notes', null, array('class' => 'form-control', 'rows'=>'2')) }}
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Author's Personal Notes <small>(not shown to public)</small></div>
								<div class="panel-body">
									@if($action_name == 'show')
										{!! htmlspecialchars_decode($recipe->author_notes) !!}
									@else
										{{ Form::textarea ('author_notes', null, array('class' => 'form-control simple', 'rows'=>'2')) }}
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">Source</div>
								<div class="panel-body">
									@if($action_name == 'show')
										{!! htmlspecialchars_decode($recipe->source) !!}
									@else
										{{ Form::text ('source', null, array('class' => 'form-control')) }}
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>