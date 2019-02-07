@if(Auth::check())
  @if((checkACL('admin')))
    @if (Request::is('*trashed'))
      <form action="{{ route($name.'.massDestroyTrashed') }}" method="post" onsubmit="return confirm('This action cannot be undone!\nAre you sure you want to delete these records?');" style="display: inline;">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="ids" id="ids" value="" />
        <button id="delete" class="btn btn-xs btn-danger" type="submit" style="display:none;"><i class="fa fa-trash"></i> Delete Selected</button>
      </form>
    @else
      <form action="{{ route($name.'.massDestroy') }}" method="post" onsubmit="return confirm('Are you sure?');" style="display: inline;">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="ids" id="ids" value="" />
        <button id="delete" class="btn btn-xs btn-danger" type="submit" style="display:none;"><i class="fa fa-trash"></i> Trash Selected</button>
      </form>
    @endif
  @endif
@endif

<script>
$(function(){
    $('[type=checkbox]').click(function ()
    {
        var checkedChbx = $('[type=checkbox]:checked');

        if (checkedChbx.length > 0)
        {
            $('#delete').show();
        }
        else
        {
            $('#delete').hide();
        }
    });
});
</script>
