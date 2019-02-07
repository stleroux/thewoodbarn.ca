@if(Auth::check())
  <a href="{{ route('home') }}" class="btn btn-xs btn-default">
    {{-- Icons and Text --}}
    @if(Auth::user()->actionButtons == 1) <i class="fa fa-home" aria-hidden="true"></i> Home
    {{-- Icons Only --}}
    @elseif(Auth::user()->actionButtons == 2) <i class="fa fa-home fa-2x" aria-hidden="true"></i>
    {{-- Text Only --}}
    @elseif(Auth::user()->actionButtons == 3) Home
    @endif
  </a>
@else
  <a href="{{ route('home') }}" class="btn btn-xs btn-default"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
@endif
