<!-- Only show the Dashboard button if coming from the Dashboard page -->
{{-- @if (false !== stripos($_SERVER['HTTP_REFERER'], "/dashboard")) --}}
@if(Auth::check())
  <a href="{{ route('dashboard') }}" class="btn btn-xs btn-default">
    {{-- Icons and Text --}}
    @if(Auth::user()->actionButtons == 1) <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
    {{-- Icons Only --}}
    @elseif(Auth::user()->actionButtons == 2) <i class="fa fa-tachometer fa-2x" aria-hidden="true"></i>
    {{-- Text Only --}}
    @elseif(Auth::user()->actionButtons == 3) Dashboard
    @endif
  </a>
{{-- @else
  <a href="{{ route('dashboard') }}" class="btn btn-xs btn-default"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a> --}}
@endif
