{{--================================================================================================================================================
== Menu displayed in panelHeader if action is Show
================================================================================================================================================--}}
@if($action_name == 'show')
	{{--================================================================================================================================================
	== Display BACK buttons on Show pages
	================================================================================================================================================--}}
{{-- 	@if(!Auth::check())
		@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name, 'actions'=>['back']])
	@endif --}}

	{{--================================================================================================================================================
	== 
	================================================================================================================================================--}}
	@if($section_name == 'articles')
{{-- 		@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name,
			'actions'=>[
				'back',
				'edit',
				'delete'
			]
		]) --}}
	@endif

	@if($section_name == 'recipes')
{{-- 		@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name,
			'actions'=>[
				'print',
				'recipesPrivate',
				'recipesAddRemoveFav',
				'back',
				'edit',
				'deleteImage',
				'delete'
			]
		]) --}}
	@endif
	{{-- @endability --}}

	{{--================================================================================================================================================
	== Items related to Recipes Show page
	================================================================================================================================================--}}
	@if($section_name == 'recipes')
{{-- 		@ability ('admin','recipes_favorites')
			@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name, 'actions'=>['recipesAddRemoveFav']])
		@endability
		@ability ('admin','recipes_private')
			@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name, 'actions'=>['recipesPrivate']])
		@endability
		@ability ('admin','recipes_print')
			@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name, 'actions'=>['print']])
		@endability --}}
{{-- 		@if($$model_name->image)
			@ability ('admin','admin,recipes_delete,recipes_delete_admin')
				@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name, 'actions'=>['deleteImage']])
			@endability
		@endif --}}
	@endif

	@if($section_name == 'posts')
{{-- 		@if($$model_name->image)
			@ability ('admin','admin,recipes_delete,recipes_delete_admin')
				@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name, 'actions'=>['deleteImage']])
			@endability
		@endif --}}
	@endif
@endif

{{--================================================================================================================================================
== Menu displayed in panelHeader if action is Add
================================================================================================================================================--}}
{{-- @if($action_name == 'add')
	@include('includes.frontend.buttons', ['model'=>$model_name, 'field'=>$section_name, 'primer'=>$section_name, 'actions'=>['cancel','save']])
@endif --}}

{{--================================================================================================================================================
== Menu displayed in panelHeader if action is Edit
================================================================================================================================================--}}
{{-- @if($action_name == 'edit')
	@include('includes.frontend.buttons', ['model'=>$$model_name, 'field'=>$section_name, 'primer'=>$section_name, 'actions'=>['cancel','update']])
@endif --}}

