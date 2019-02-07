<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">Recipes</div>
      <div class="panel-body">
        <table id="" class="table table-hover table-striped table-condensed recipes">
          <thead>
            <tr>
              <th>Title</th>
              <th>Category</th>
              <th>Created On</th>
            </tr>
          </thead>
          @foreach ($recipes as $key => $recipe)
            <tr>
              <td>
                <a href="{{ route('recipes.show', $recipe->id) }}" class="{{ ($recipe->personal)?'text text-danger':''}}">{{ $recipe->title }}</a>
              </td>
              <td>
                <div class="{{ ($recipe->personal)?'text text-danger':''}}">
                  {{ $recipe->category->name }}
                </div>
              </td>
              <td>
                <div class="{{ ($recipe->personal)?'text text-danger':''}}">
                  @include('layouts.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])
                </div>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('table.recipes').DataTable( {
      "bPaginate": true,
      "bFilter": false,
      "bInfo": false,
      "bLengthChange": false,
      "pageLength": <?php echo Auth::user()->rowsPerPage; ?>
    });
  } );
</script>