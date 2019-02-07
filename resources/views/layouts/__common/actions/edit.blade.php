{{--================================================--}}
{{-- EDIT BUTTON                                    --}}
{{--================================================--}}
@if((checkACL('editor')) || (checkOwner($model)))
  <a href="{{ route($name.'.edit', $id) }}" class="btn btn-info btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=Edit' : '' }}>
    {{-- Icons and Text --}}
    @if(Auth::user()->actionButtons == 1) <i class="fa fa-pencil" aria-hidden="true"></i> Edit
    {{-- Icons Only --}}
    @elseif(Auth::user()->actionButtons == 2) <i class="fa fa-pencil" aria-hidden="true"></i>
    {{-- Text Only --}}
    @elseif(Auth::user()->actionButtons == 3) Edit
    @endif
  </a>
@else
	<a href="#" class="btn btn-xs btn-info" disabled="disabled">
   {{-- Icons and Text --}}
    @if(Auth::user()->actionButtons == 1) <i class="fa fa-pencil" aria-hidden="true"></i> Edit
    {{-- Icons Only --}}
    @elseif(Auth::user()->actionButtons == 2) <i class="fa fa-pencil" aria-hidden="true"></i>
    {{-- Text Only --}}
    @elseif(Auth::user()->actionButtons == 3) Edit
    @endif 
  </a>
@endif