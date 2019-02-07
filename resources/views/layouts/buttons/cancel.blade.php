@if(isset($param1))
  <a href="{{ route($name.'.index', $param1) }}" class="btn btn-xs btn-default">
@else
  <a href="{{ route($name.'.index') }}" class="btn btn-xs btn-default">
@endif
    <div class="text text-left">
      @if(Auth::check())
        {{-- Icons and Text --}}
        @if(Auth::user()->actionButtons == 1) <i class="fa fa-ban" aria-hidden="true"></i> Cancel
        {{-- Icons Only --}}
        @elseif(Auth::user()->actionButtons == 2) <i class="fa fa-ban fa-2x" aria-hidden="true"></i>
        {{-- Text Only --}}
        @elseif(Auth::user()->actionButtons == 3) Cancel
        @endif
      @else
         <i class="fa fa-ban" aria-hidden="true"></i> Cancel
      @endif
    </div>
  </a>