{{--================================================================================================================================--}}
{{-- ADD BUTTON                                                                                                                     --}}
{{--================================================================================================================================--}}
@if (checkACL('author'))
  <a href="{{ route($name.'.create') }}" class="btn btn-success btn-xs">
    {{-- Icons and Text --}}
    @if(Auth::user()->actionButtons == 1) <i class="fa fa-plus-square" aria-hidden="true"></i> New {{ str_singular(ucfirst($name)) }}
     {{-- Icons Only --}}
    @elseif(Auth::user()->actionButtons == 2) <i class="fa fa-plus-square fa-2x" aria-hidden="true"></i>
    {{-- Text Only --}}
    @elseif(Auth::user()->actionButtons == 3) New {{ str_singular(ucfirst($name)) }}
    @endif
  </a>
@endif
