<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">Articles</div>
      <div class="panel-body">
        <table id="" class="table table-hover table-striped table-condensed articles">
          <thead>
            <tr>
              <th>Title</th>
              <th>Category</th>
              <th>Created On</th>
            </tr>
          </thead>
          @foreach ($articles as $key => $article)
            <tr>
              <td><a href="{{ route('articles.show', $article->id) }}" class="">{{ $article->title }}</a></td>
              <td>{{ $article->category->name }}</td>
              <td>@include('layouts.dateFormat', ['model'=>$article, 'field'=>'created_at'])</td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('table.articles').DataTable( {
      "bPaginate": true,
      "bFilter": false,
      "bInfo": false,
      "bLengthChange": false,
      "pageLength": <?php echo Auth::user()->rowsPerPage; ?>
    });
  } );
</script>