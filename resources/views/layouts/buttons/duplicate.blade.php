{{--================================================--}}
{{-- EDIT BUTTON                                    --}}
{{--================================================--}}
@if((checkACL('author')) || (checkOwner($model)))
  <a href="{{ route($name.'.duplicate', $id) }}" class="btn btn-default btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=Copy' : '' }}>
    {{-- Icons and Text --}}
    @if(Auth::user()->actionButtons == 1) <i class="fa fa-files-o" aria-hidden="true"></i> Copy
    {{-- Icons Only --}}
    @elseif(Auth::user()->actionButtons == 2) <i class="fa fa-files-o" aria-hidden="true"></i>
    {{-- Text Only --}}
    @elseif(Auth::user()->actionButtons == 3) Copy
    @endif
  </a>
@else
	<a href="#" class="btn btn-xs btn-default" disabled="disabled">
   {{-- Icons and Text --}}
    @if(Auth::user()->actionButtons == 1) <i class="fa fa-files-o" aria-hidden="true"></i> Copy
    {{-- Icons Only --}}
    @elseif(Auth::user()->actionButtons == 2) <i class="fa fa-files-o" aria-hidden="true"></i>
    {{-- Text Only --}}
    @elseif(Auth::user()->actionButtons == 3) Copy
    @endif 
  </a>
@endif