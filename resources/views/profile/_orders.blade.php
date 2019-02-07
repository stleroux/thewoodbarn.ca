<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">Orders</div>
      <div class="panel-body">
        @foreach ($orders as $order)
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="list-group">
                @foreach ($order->cart->items as $item)
                  <li class="list-group-item">
                    <span class="badge">${{ $item['price'] }}</span>
                    {{ $item['item']['title'] }} | {{ $item['qty'] }} Units
                  </li>
                @endforeach
              </div>
            </div>
            <div class="panel-footer">
              <strong>Total Price : ${{ $order->cart->totalPrice}}</strong>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('table.orders').DataTable( {
      "bPaginate": true,
      "bFilter": false,
      "bInfo": false,
      "bLengthChange": false,
      "pageLength": <?php echo Auth::user()->rowsPerPage; ?>
    });
  } );
</script>