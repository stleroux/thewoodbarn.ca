@if($section_name == 'recipes')
	@ability ('admin','admin,recipes_print')
		<a href="" type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#printRecipeModal">
			<div class="text text-left">
				<i class="fa fa-print" aria-hidden="true"></i> Print {{ ucfirst(str_singular($section_name)) }}
			</div>
		</a>
	@endability
@endif

@if($section_name == 'articles')
	@ability ('admin','admin,articles_print')
		<a href="" type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#printArticleModal">
			<div class="text text-left">
				<i class="fa fa-print" aria-hidden="true"></i> Print {{ ucfirst(str_singular($section_name)) }}
			</div>
		</a>
	@endability
@endif