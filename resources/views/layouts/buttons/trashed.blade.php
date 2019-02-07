{{--=============================================--}}
{{-- INDEX BUTTON                                --}}
{{--=============================================--}}
{{--
    @include('layouts.buttons.trashed', ['model'=>'items', 'name'=>'items', 'icon'=>'fa-trash'])
--}}

@if(Auth::check())
  @if(checkACL('manager'))
    <a href="{{ route($name.'.trashed') }}" class="btn btn-xs btn-warning" {{ (Auth::user()->actionButtons == 2) ? 'title=Trashed' : '' }}>
      {{-- Icons and Text --}}
      @if(Auth::user()->actionButtons == 1) <i class="fa {{ $icon }}" aria-hidden="true"></i> Trashed {{ ucfirst($name) }}
      {{-- Icons Only --}}
      @elseif(Auth::user()->actionButtons == 2) <i class="fa {{ $icon }}" aria-hidden="true"></i>
      {{-- Text Only --}}
      @elseif(Auth::user()->actionButtons == 3) Trashed {{ ucfirst($name) }}
      @endif
    </a>
  {{-- @else
    <a href="#" class="btn btn-xs btn-default" disabled="disabled">
      @if(Auth::user()->actionButtons == 1) <i class="fa {{ $icon }}" aria-hidden="true"></i> Trashed {{ ucfirst($name) }}
      @elseif(Auth::user()->actionButtons == 2) <i class="fa {{ $icon }}" aria-hidden="true"></i>
      @elseif(Auth::user()->actionButtons == 3) Trashed {{ ucfirst($name) }}
      @endif 
    </a> --}}
  @endif
@endif