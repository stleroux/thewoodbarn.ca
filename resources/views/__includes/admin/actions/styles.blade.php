@if($action_name == 'add')
	@if($section_name == 'users')
		{!! Html::style('css/select2.min.css') !!}
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	@endif

	@if($section_name == 'posts')
		{!! Html::style('css/select2.min.css') !!}
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	@endif

	@if($section_name == 'roles')
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	@endif

@endif

@if($action_name == 'edit')
	@if($section_name == 'users')
		{!! Html::style('css/select2.min.css') !!}
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	@endif

	@if($section_name == 'posts')
		{!! Html::style('css/select2.min.css') !!}
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	@endif

	@if($section_name == 'roles')
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	@endif

@endif

@if($action_name == 'show')
	@if($section_name == 'users')
		{!! Html::style('css/select2.min.css') !!}
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	@endif

	@if($section_name == 'posts')
		{!! Html::style('css/select2.min.css') !!}
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	@endif
@endif