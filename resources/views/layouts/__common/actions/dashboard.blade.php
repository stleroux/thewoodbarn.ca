<!-- Only show the Dashboard button if coming from the Dashboard page -->
{{-- @if (false !== stripos($_SERVER['HTTP_REFERER'], "/dashboard"))
<a href="{{ URL::previous() }}" class="btn btn-xs btn-default">
  <div class="text text-left">
    <i class="fa fa-arrow-left" aria-hidden="true"></i>
    Dashboard
  </div>
</a>
@endif --}}


<a href="{{ route('dashboard') }}" class="btn btn-xs btn-default">
  {{-- Icons and Text --}}
  @if(Auth::user()->actionButtons == 1) <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
  {{-- Icons Only --}}
  @elseif(Auth::user()->actionButtons == 2) <i class="fa fa-tachometer fa-2x" aria-hidden="true"></i>
  {{-- Text Only --}}
  @elseif(Auth::user()->actionButtons == 3) Dashboard
  @endif
</a>