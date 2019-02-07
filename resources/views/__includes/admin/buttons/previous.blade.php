<a href="{{ URL::previous() }}" class="btn btn-default btn-xs btn-block">

  @if(Auth::user()->actionButtons == 1)
    {{-- Icons and Text --}}
    <i class="fa fa-ban" aria-hidden="true"></i> Cancel
  @elseif(Auth::user()->actionButtons == 2)
    {{-- Icons Only --}}
    <i class="fa fa-ban" aria-hidden="true"></i>
  @elseif(Auth::user()->actionButtons == 3)
    {{-- Text Only --}}
    Cancel
  @endif
</a>