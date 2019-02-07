@if($action_name == 'add')
	@if($section_name == 'users')
		{!! Html::script('js/select2.min.js') !!}
		<script type="text/javascript">$('.select2-multi').select2();</script>
	@endif

	@if($section_name == 'posts')
		{!! Html::script('js/select2.min.js') !!}
		<script type="text/javascript">$('.select2-multi').select2();</script>
	@endif

	@if($section_name == 'roles')
		<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	@endif


@endif

@if($action_name == 'edit')
	@if($section_name == 'posts')
		{!! Html::script('js/select2.min.js') !!}

		<script type="text/javascript">
			$('.select2-multi').select2();
			// set the values
			$('.select2-multi').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
		</script>
	@endif

	@if($section_name == 'roles')
		<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	@endif

	@if($section_name == 'users')
		{!! Html::script('js/select2.min.js') !!}

		<script type="text/javascript">
		$('.select2-multi').select2();
			// set the values
			$('.select2-multi').select2().val({!! json_encode($user->roles()->getRelatedIds()) !!}).trigger('change');
		</script>
	@endif

@endif

@if($action_name == 'show')
	@if($section_name == 'users')
		{!! Html::script('js/select2.min.js') !!}

		<script type="text/javascript">
		$('.select2-multi').select2();
			// set the values
			$('.select2-multi').select2().val({!! json_encode($user->roles()->getRelatedIds()) !!}).trigger('change');
		</script>
	@endif

	@if($section_name == 'posts')
		{!! Html::script('js/select2.min.js') !!}

		<script type="text/javascript">
			$('.select2-multi').select2();
			// set the values
			$('.select2-multi').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
		</script>
	@endif
@endif