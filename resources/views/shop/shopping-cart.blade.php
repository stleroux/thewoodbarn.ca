@extends ('layouts.main')

@section('title','Shopping Cart')

@section('stylesheets')
	{{ Html::style('css/main.css') }}
	{{ Html::style('css/shop.css') }}
@stop

@section('breadcrumb')
	<li><a href="/">Home</a></li>
	<li><a href="{{ route('shop.index','all') }}">Shop</a></li>
	<li>Shopping Cart</li>
@stop

@section('content')

	@if (Session::has('cart'))
		<div class="row">
			<div class="col-sm-8 col-sm-offset-1">
{{-- 				<ul class="list-group">
					@foreach ($products as $product)
						<li class="list-group-item">
							<span class="badge">{{ $product['qty'] }}</span>
							<strong>{{ $product['item']['title'] }}</strong>
							<span class="label label-success">{{ $product['price'] }}</span>
							<div class="btn-group">
								<button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">Action
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="{{ route('product.reduceByOne', ['id' => $product['item']['id']]) }}">Reduce by 1</a></li>
									<li><a href="{{ route('product.removeItem', ['id' => $product['item']['id']]) }}">Remove Item</a></li>
								</ul>
							</div>
						</li>
					@endforeach
				</ul> --}}

				<table class="table table-striped">
					<thead>
						<tr>
							<th>Qty</th>
							<th>Title</th>
							<th></th>
							<th class="text text-right">Each</th>
							<th class="text text-right">Total</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="3">
								{{-- <a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a>
								<a href="{{ route('product.index') }}" type="button" class="btn btn-info">Continue Shopping</a>
								<a href="{{ route('product.clearCart') }}" type="button" class="btn btn-warning">Empty Cart</a> --}}
							</td>
							<td colspan="2">
								<ul class="list-group">

									@php
										$taxes = $totalPrice * 0.13;
										$shipping = 0;
										$total = $totalPrice + $shipping + $taxes;
									@endphp

									<li class="list-group-item clearfix">
										<div class="pull-right">
											<span>SubTotal : </span>
											<span style="display:inline-block; width:75px; text-align: right;">$ {{ number_format($totalPrice, 2, '.', ',') }}</span>
										</div>
									</li>
									<li class="list-group-item clearfix">
										<div class="pull-right">
											<span>Shipping : </span>
											<span style="display:inline-block; width:75px; text-align: right;">$ {{ number_format($shipping, 2, '.', ',') }} </span>
										</div>
									</li>
									<li class="list-group-item clearfix">
										<div class="pull-right">
											<span>Taxes : </span>
											<span style="display:inline-block; width:75px; text-align: right;">$ {{ number_format($taxes, 2, '.', ',') }}</span>
										</div>
									</li>
									<li class="list-group-item clearfix">
										<div class="pull-right">
											<span>Total : </span>
											<span style="display:inline-block; width:75px; text-align: right;">$ {{ number_format($total, 2, '.', ',') }}</span>
										</div>
									</li>
								</ul>
							</td>
						</tr>
					</tfoot>
					<tbody>
						@foreach ($products as $product)
						<tr>
							<td>{{ $product['qty'] }}</td>
							<td>{{ $product['item']['title'] }}</td>
							<td>
								<a href="{{ route('shop.increaseByOne', ['id' => $product['item']['id']]) }}" class="btn btn-default btn-sm" aria-label="Increase By One">
									<i class="fa fa-plus-square text text-success" aria-hidden="true"></i>
								</a>
								<a href="{{ route('shop.reduceByOne', ['id' => $product['item']['id']]) }}" class="btn btn-default btn-sm" aria-label="Reduce By One">
									<i class="fa fa-minus-square text text-warning" aria-hidden="true"></i>
								</a>
								<a href="{{ route('shop.removeItem', ['id' => $product['item']['id']]) }}" class="btn btn-default btn-sm" aria-label="Remove Item">
									<i class="fa fa-trash text text-danger" aria-hidden="true"></i>
								</a>
							</td>
							<td><div class="pull-right">$ {{ number_format($product['item']['price'], 2, '.', ',') }}</div></td>
							<td><div class="pull-right">$ {{ number_format($product['price'], 2, '.', ',') }}</div></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="col-sm-2 col-sm-offset-1">
				<a href="{{ route('checkout') }}" type="button" class="btn btn-success btn-sm btn-block">Checkout</a>
				<a href="{{ route('shop.index','all') }}" type="button" class="btn btn-info btn-sm btn-block">Continue Shopping</a>
				<a href="{{ route('shop.clearCart') }}" type="button" class="btn btn-warning btn-sm btn-block">Empty Cart</a>
			</div>
		</div>

{{-- 		<div class="row">
			<div class="col-sm-6 col-md-6 col-sm-offset-3 col-md-offset-3">
				<strong>Total : $ {{ $totalPrice}} </strong>
			</div>
		</div> --}}

	@else
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<h2>No items in cart!</h2>
			</div>
		</div>
	@endif

@stop