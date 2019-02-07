{{-- model name requires $$model_name when a model object needs to be passed along --}}

<div class="panel-heading">{{ ucfirst($section_name) }}
	<div class="pull-right">

		@if($section_name == 'articles')
			@if($action_name == 'list')
				@include('includes.frontend.buttons', ['model'=>$model_name, 'field'=>$section_name, 'primer'=>$section_name,
					'actions'=>['add']])
			@endif
			@if($action_name == 'show')
				@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name,
					'actions'=>['edit','delete','print','list']])
			@endif
			@if($action_name == 'add')
				@include('includes.frontend.buttons', ['model'=>$model_name, 'field'=>$section_name, 'primer'=>$section_name,
					'actions'=>['cancel','save']])
			@endif
			@if($action_name == 'edit')
				@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name,
					'actions'=>['cancel','update']])
			@endif
		@endif

		@if($section_name == 'items')
			@if($action_name == 'list')
				@include('includes.frontend.buttons', ['model'=>$model_name, 'field'=>$section_name, 'primer'=>$section_name,
					'actions'=>['add']])
			@endif
			@if($action_name == 'show')
				@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name,
					'actions'=>['edit','delete','print','list']])
			@endif
			@if($action_name == 'add')
				@include('includes.frontend.buttons', ['model'=>$model_name, 'field'=>$section_name, 'primer'=>$section_name,
					'actions'=>['cancel','save']])
			@endif
			@if($action_name == 'edit')
				@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name,
					'actions'=>['cancel','update']])
			@endif
		@endif

		@if($section_name == 'posts')
			@if($action_name == 'list')
				@include('includes.frontend.buttons', ['model'=>$model_name, 'field'=>$section_name, 'primer'=>$section_name,
					'actions'=>['add']])
			@endif
			@if($action_name == 'show')
				@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name,
					'actions'=>['edit','delete','deleteImage','print','list']])
			@endif
			@if($action_name == 'add')
				@include('includes.frontend.buttons', ['model'=>$model_name, 'field'=>$section_name, 'primer'=>$section_name,
					'actions'=>['cancel','save']])
			@endif
			@if($action_name == 'edit')
				@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name,
					'actions'=>['cancel','update','deleteImage']])
			@endif
		@endif

		@if($section_name == 'recipes')
			@if($action_name == 'list')
				@include('includes.frontend.buttons', ['model'=>$model_name, 'field'=>$section_name, 'primer'=>$section_name,
					'actions'=>['add','recipesMyRecipes','recipesMyFavorites','recipes']])
			@endif
			@if($action_name == 'show')
				@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name,
					'actions'=>['print','recipesPrivate','recipesAddRemoveFav','edit','deleteImage','delete','list']])
			@endif
			@if($action_name == 'add')
				@include('includes.frontend.buttons', ['model'=>$model_name, 'field'=>$section_name, 'primer'=>$section_name,
					'actions'=>['cancel','save']])
			@endif
			@if($action_name == 'edit')
				@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name,
					'actions'=>['cancel','update']])
			@endif
		@endif

	</div>
</div>

