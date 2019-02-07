{{--================================================--}}
{{-- RESTORE BUTTON                                 --}}
{{--================================================--}}
@if(Auth::check())
  @if((checkACL('admin')))
    @if (Request::is('*trashed'))
      <form action="{{ route($name.'.massRestore') }}" method="post" style="display: inline;">
        {{ csrf_field() }}
        <input type="hidden" name="ids" id="ids" value="" />
        <button id="restore" class="btn btn-xs btn-primary" type="submit" style="display:none;"><i class="fa fa-check"></i> Restore Selected</button>
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
            $('#restore').show();
        }
        else
        {
            $('#restore').hide();
        }
    });
});
</script>