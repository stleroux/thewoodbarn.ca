@if (Session::has('cart'))
	<ul class="list-group">
		<li class="list-group-item clearfix">
			<a href="{{ route('shop.shoppingCart') }}" class="btn btn-success btn-xs pull-right">
				<i class="fa fa-shopping-cart"></i> Shopping Cart
				<span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
			</a>
		</li>
	</ul>
@endif
