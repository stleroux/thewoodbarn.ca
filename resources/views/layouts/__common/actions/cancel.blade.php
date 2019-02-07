<a href="{{ route($name.'.index') }}" class="btn btn-default btn-xs">
  <div class="text text-left">
    {{-- Icons and Text --}}
    @if(Auth::user()->actionButtons == 1) <i class="fa fa-ban" aria-hidden="true"></i> Cancel
    {{-- Icons Only --}}
    @elseif(Auth::user()->actionButtons == 2) <i class="fa fa-ban fa-2x" aria-hidden="true"></i>
    {{-- Text Only --}}
    @elseif(Auth::user()->actionButtons == 3) Cancel
    @endif
  </div>
</a>