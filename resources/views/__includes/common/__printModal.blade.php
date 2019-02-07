{{-- RECIPES PRINT MODAL --}}
@if($section_name == 'recipes')
	<div class="modal fade" id="printRecipeModal" tabindex="-1" role="dialog" aria-labelledby="printRecipeModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="printModalLabel">Recipe Printing Instructions</h4>
				</div>
				<div class="modal-body">
					<p>To print this recipe, please use your browser's print functionality.</p>
					<p>Use the browser's Back button to return to this page</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<span class="pull-right">
						<a href="{{ route('recipes.print', $recipe->id) }}" class="btn btn-default btn-block">
							<div class="text text-left">
	  							<i class="fa fa-print" aria-hidden="true"></i> Proceed
							</div>
						</a>
					</span>
				</div>
			</div>
		</div>
	</div>
@endif

{{-- ARTICLES PRINT MODAL --}}
@if($section_name == 'articles')
	<div class="modal fade" id="printArticleModal" tabindex="-1" role="dialog" aria-labelledby="printArticleModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="printModalLabel">Article Printing Instructions</h4>
				</div>
				<div class="modal-body">
					<p>To print this article, please use your browser's print functionality.</p>
					<p>Use the browser's Back button to return to this page</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<span class="pull-right">
						<a href="{{ route('articles.print', $article->id) }}" class="btn btn-default btn-block">
							<div class="text text-left">
	  							<i class="fa fa-print" aria-hidden="true"></i> Proceed
							</div>
						</a>
					</span>
				</div>
			</div>
		</div>
	</div>
@endif