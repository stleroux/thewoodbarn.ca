<div class="row">
<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">Items</div>
    <div class="panel-body">
      <table id="" class="table table-hover table-striped table-condensed items">
        <thead>
          <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Created On</th>
          </tr>
        </thead>
        @foreach ($items as $key => $item)
          <tr>
            <td><a href="{{ route('items.show', $item->id) }}" class="">{{ $item->title }}</a></td>
            <td>{{ $item->description }}</td>
            <td>@include('layouts.dateFormat', ['model'=>$item, 'field'=>'created_at'])</td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('table.items').DataTable( {
      "bPaginate": true,
      "bFilter": false,
      "bInfo": false,
      "bLengthChange": false,
      "pageLength": <?php echo Auth::user()->rowsPerPage; ?>
    });
  } );
</script>