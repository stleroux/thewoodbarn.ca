@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/articles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li>Orders</li>
@stop

@section('content')

  <div class="row">
    <div class="col-md-12">

      <div class="panel panel-default">
      <div class="panel-heading">Orders</div>
      	<div class="panel-body">
      		@foreach ($orders as $order)
      			<div class="panel panel-default">
      				<div class="panel-body">
      					<div class="col-sm-12">
      						<table class="table table-condensed">
      							<thead>
      								<tr>
      									<th>Irder ID</th>
      									<th>Order Name</th>
      									<th>First Name</th>
      									<th>Last Name</th>
      									<th>Order Address</th>
      									<th>Email Address</th>
      								</tr>
      							</thead>
      							<tbody>
      								<tr>
      									<td>{{ $order->id }}</td>
      									<td>{{ $order->name }}</td>
      									<td>{{ $order->user->first_name }}</td>
      									<td>{{ $order->user->last_name }}</td>
      									<td>{{ $order->address }}</td>
      									<td>{{ $order->user->email }}</td>
      								</tr>
      								<tr>
      									<td colspan="5">
      										<div class="col-sm-8">
      										<table class="table table-condensed table-hover table-bordered">
      											<thead>
      												<tr>
      													<th>Qty</th>
      													<th>Item Description</th>
      													<th>Price</th>
      												</tr>
      											</thead>
      											<tbody>
      												@foreach ($order->cart->items as $item)
      													<tr>
      														<td>{{ $item['qty'] }}</td>
      														<td>{{ $item['item']['title'] }}</td>
      														<td>${{ $item['price'] }}</td>
      													</tr>
      												@endforeach
      											</tbody>
      										</table>
      										</div>
      									</td>
      								</tr>
      								<tr>
      									<td colspan="4" class="text text-right"><strong>Total Price : ${{ $order->cart->totalPrice}}</strong></td>
      								</tr>
      							</tbody>
      						</table>
      					</div>
      				</div>
      			</div>
      		@endforeach
      		<div class="col-sm-12 text text-center">
      			{{ $orders->render() }}
      		</div>
      	</div>
      </div>
    </div>
  </div>
@stop

@section ('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('table.orders').DataTable( {
				"bPaginate": true,
				"bFilter": false,
				"bInfo": false,
				"bLengthChange": false,
				"pageLength": <?php echo Auth::user()->rowsPerPage; ?>
			});
		});
	</script>
@stop
