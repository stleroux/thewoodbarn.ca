{{--================================================--}}
{{-- RESTORE BUTTON                                 --}}
{{--================================================--}}
@if(Auth::check())
  @if((checkACL('manager')) || (checkOwner($model)))
    <a href="{{ route($name.'.restore', $id) }}" class="btn btn-primary btn-xs" {{ (Auth::user()->actionButtons == 2) ? 'title=Restore' : '' }}>
      {{-- Icons and Text --}}
      @if(Auth::user()->actionButtons == 1) <i class="fa fa-window-restore" aria-hidden="true"></i> Restore
      {{-- Icons Only --}}
      @elseif(Auth::user()->actionButtons == 2) <i class="fa fa-window-restore" aria-hidden="true"></i>
      {{-- Text Only --}}
      @elseif(Auth::user()->actionButtons == 3) Restore
      @endif
    </a>
{{--   @else
  	<a href="#" class="btn btn-xs btn-primary" disabled="disabled">
      @if(Auth::user()->actionButtons == 1) <i class="fa fa-window-restore" aria-hidden="true"></i> Restore
      @elseif(Auth::user()->actionButtons == 2) <i class="fa fa-window-restore" aria-hidden="true"></i>
      @elseif(Auth::user()->actionButtons == 3) Restore
      @endif 
    </a> --}}
  @endif
@endif
