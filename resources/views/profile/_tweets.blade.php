<div class="row">
<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">Tweets</div>
    <div class="panel-body">
      <table id="" class="table table-hover table-striped table-condensed tweets">
        <thead>
          <tr>
            <th>Title</th>
            <th>Body</th>
            <th>Created On</th>
          </tr>
        </thead>
        @foreach ($tweets as $key => $tweet)
          <tr>
            <td><a href="{{ route('tweets.show', $tweet->id) }}" class="">{{ $tweet->title }}</a></td>
            <td>{{ $tweet->body }}</td>
            <td>@include('layouts.dateFormat', ['model'=>$tweet, 'field'=>'created_at'])</td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    $('table.tweets').DataTable( {
      "bPaginate": true,
      "bFilter": false,
      "bInfo": false,
      "bLengthChange": false,
      "pageLength": <?php echo Auth::user()->rowsPerPage; ?>
    });
  } );
</script>