<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">Posts</div>
      <div class="panel-body">
        <table id="" class="table table-hover table-striped table-condensed posts">
          <thead>
            <tr>
              <th>Title</th>
              <th>Category</th>
              <th>Views</th>
              <th>Created On</th>
            </tr>
          </thead>
          @foreach ($posts as $key => $post)
            <tr>
              <td><a href="{{ route('posts.show', $post->id) }}" class="">{{ $post->title }}</a></td>
              <td>{{ $post->category->name }}</td>
              <td>{{ $post->views }}</td>
              <td>@include('layouts.dateFormat', ['model'=>$post, 'field'=>'created_at'])</td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('table.posts').DataTable( {
      "bPaginate": true,
      "bFilter": false,
      "bInfo": false,
      "bLengthChange": false,
      "pageLength": <?php echo Auth::user()->rowsPerPage; ?>
    });
  } );
</script>