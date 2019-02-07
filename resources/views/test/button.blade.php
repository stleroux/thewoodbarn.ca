  <a href="{{ route($model) }}" class="btn btn-xs btn-default {{ $loc=='side' ? 'btn-block' : '' }}">
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