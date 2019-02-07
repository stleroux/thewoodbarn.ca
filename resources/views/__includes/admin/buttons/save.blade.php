<button type="submit" name="submit" class="btn btn-success btn-xs btn-block">
	<div class="text text-left">
		<i class="fa fa-save"></i> Save {{ str_singular(ucfirst($model)) }}
	</div>
</button>

{{ Form::button('<i class="fa fa-save"></i> Save Article', array('type' => 'submit', 'class' => 'btn btn-success btn-xs')) }}