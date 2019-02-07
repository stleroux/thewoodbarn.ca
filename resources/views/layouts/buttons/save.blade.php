<button type="submit" class="btn btn-xs btn-success">
    {{-- Icons and Text --}}
  @if(Auth::user()->actionButtons == 1)
     <i class="fa fa-floppy-o" aria-hidden="true"></i> Save {{ str_singular(ucfirst($name)) }}
  {{-- Icons Only --}}
  @elseif(Auth::user()->actionButtons == 2)
     <i class="fa fa-floppy-o fa-2x" aria-hidden="true"></i>
  {{-- Text Only --}}
  @elseif(Auth::user()->actionButtons == 3)
     Save {{ str_singular(ucfirst($name)) }}
  @endif
</button>
