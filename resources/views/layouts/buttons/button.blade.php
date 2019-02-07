{{--=============================================--}}
{{-- INDEX BUTTON                                --}}
{{--=============================================--}}
{{-- <a href="{{ route($name.'.index') }}" class="btn btn-default btn-xs" > --}}
  {{-- Icons and Text --}}
  {{-- @if(Auth::user()->actionButtons == 1) <i class="fa {{ $icon }}" aria-hidden="true"></i> {{ ucfirst($name) }} List --}}
   {{-- Icons Only --}}
  {{-- @elseif(Auth::user()->actionButtons == 2) <i class="fa {{ $icon }}" aria-hidden="true"></i> --}}
  {{-- Text Only --}}
  {{-- @elseif(Auth::user()->actionButtons == 3) {{ ucfirst($name) }} List --}}
  {{-- @endif --}}
{{-- </a> --}}


  <a href="{{ route($model) }}" class="btn btn-xs btn-default">
    <div class="text text-left">
      @if(Auth::check())
        {{-- Icons and Text --}}
        @if(Auth::user()->actionButtons == 1) <i class="fa {{ $icon }}" aria-hidden="true"></i>  {{ ucfirst($name) }}
        {{-- Icons Only --}}
        @elseif(Auth::user()->actionButtons == 2) <i class="fa {{ $icon }} fa-2x" aria-hidden="true"></i>
        {{-- Text Only --}}
        @elseif(Auth::user()->actionButtons == 3)  {{ ucfirst($name) }}
        @endif
      @else
         <i class="fa {{ $icon }}" aria-hidden="true"></i>  {{ ucfirst($name) }}
      @endif
    </div>
  </a>