@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Orders</li>
@stop

@section('menubar')
  {{-- @include('layouts.actions.import', ['name'=>'orders']) --}}
  @include('layouts.buttons.dashboard')
@stop

@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-money" aria-hidden="true"></i> Orders</div>
        <div class="panel-body">

          <div class="row">
            <div class="col-xs-1">Order ID</div>
            <div class="col-xs-2">Order Name</div>
            <div class="col-xs-2">First Name</div>
            <div class="col-xs-2">Last Name</div>
            <div class="col-xs-2">Order Date</div>
            <div class="col-xs-3">Email Address</div>
          </div>

          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach ($orders as $order)
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{ $order->id }}" aria-expanded="true" aria-controls="{{ $order->id}}">
                    <div class="row">
                      <div class="col-xs-1"><i class="fa fa-plus-circle"></i> {{ $order->id }}</div>
                      <div class="col-xs-2">{{ $order->name }}</div>
                      <div class="col-xs-2">{{ $order->user->first_name }}</div>
                      <div class="col-xs-2">{{ $order->user->last_name }}</div>
                      <div class="col-xs-2">{{ $order->created_at }}</div>
                      <div class="col-xs-3">{{ $order->user->email }}</div>
                    </div>
                  </a>
                </div>
    
                <div id="{{ $order->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
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
                        <tr>
                          <td colspan="6" class="text text-right"><strong>Total Price : ${{ $order->cart->totalPrice}}</strong></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            @endforeach
          </div>

          
        </div>
      </div>
    </div>
  </div>
<div class="col-xs-12 text text-center">
            {{ $orders->render() }}
          </div>


  {{-- <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-money"></i> Orders</div>
        <div class="panel-body">
          @foreach ($orders as $order)
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="col-sm-12">
                  <table class="table table-bordered table-condensed">
                    
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
                        <td colspan="6">
                          <div class="col-sm-12">
                          
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="6" class="text text-right"><strong>Total Price : ${{ $order->cart->totalPrice}}</strong></td>
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
  </div> --}}
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
