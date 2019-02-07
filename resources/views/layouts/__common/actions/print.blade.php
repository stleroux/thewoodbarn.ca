{{--================================================================================================================================--}}
{{-- PRINT BUTTON                                                                                                                   --}}
{{--================================================================================================================================--}}
@if(checkACL('author'))
  <a href="" type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#printArticleModal">
    {{-- Icons and Text --}}
    @if(Auth::user()->actionButtons == 1) <i class="fa fa-print" aria-hidden="true"></i> Print {{ str_singular(ucfirst($name)) }}
     {{-- Icons Only --}}
    @elseif(Auth::user()->actionButtons == 2) <i class="fa fa-print" aria-hidden="true"></i>
    {{-- Text Only --}}
    @elseif(Auth::user()->actionButtons == 3) Print {{ ucfirst($name) }}
    @endif
  </a>
@endif
