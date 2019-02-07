<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">Tasks</div>
      <div class="panel-body">
        <table id="" class="table table-hover table-striped table-condensed tasks">
          <thead>
            <tr>
              <th>Name</th>
              <th>Created On</th>
            </tr>
          </thead>
          @foreach ($tasks as $key => $task)
            <tr>
              <td>{{ $task->name }}</td>
              <td>@include('layouts.dateFormat', ['model'=>$task, 'field'=>'created_at'])</td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('table.tasks').DataTable( {
      "bPaginate": true,
      "bFilter": false,
      "bInfo": false,
      "bLengthChange": false,
      "pageLength": <?php echo Auth::user()->rowsPerPage; ?>
    });
  } );
</script>