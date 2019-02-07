@if($action_name == 'show')

	@if($_SERVER['HTTP_REFERER'] == Request::root() . "/admin")
		<a href="{{ URL::previous() }}" class="btn btn-default btn-xs">
			<div class="text text-left">
				<i class="fa fa-arrow-left" aria-hidden="true"></i>	Back
			</div>
		</a>
		<a href="{{ route('admin.'.$section_name.'.index') }}" class="btn btn-default btn-xs">
			<div class="text text-left">
				<i class="fa fa-undo" aria-hidden="true"></i> All {{ ucfirst($section_name) }}
			</div>
		</a>
	@else
		<a href="{{ route('admin.'.$section_name.'.index') }}" class="btn btn-default btn-xs">
			<div class="text text-left">
				<i class="fa fa-undo" aria-hidden="true"></i> All {{ ucfirst($section_name) }}
			</div>
		</a>
	@endif

@endif

@if(($action_name == 'add') || ($action_name == 'edit'))
	<a href="{{ route('admin.'.$section_name.'.index') }}" class="btn btn-default btn-xs">
		<div class="text text-left">
			<i class="fa fa-ban" aria-hidden="true"></i> Cancel
		</div>
	</a>
@endif

@if($action_name == 'add')
	<button type="submit" name="submit" class="btn btn-success btn-xs">
		<div class="text text-left">
			<i class="fa fa-save"></i> Save
		</div>
	</button>
@endif

@if($action_name == 'edit')
	<button type="submit" name="submit" class="btn btn-primary btn-xs">
		<div class="text text-left">
			<i class="fa fa-save"></i> Update
		</div>
	</button>
@endif