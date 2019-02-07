{{-- {{ Form::button('<i class="fa fa-save"></i> Update ' . str_singular(ucfirst($name)), array('type' => 'submit', 'class' => 'btn btn-info btn-xs')) }} --}}

<button type="submit" class="btn btn-xs btn-info">
    {{-- Icons and Text --}}
  @if(Auth::user()->actionButtons == 1)
     <i class="fa fa-floppy-o" aria-hidden="true"></i> Update {{ str_singular(ucfirst($name)) }}
  {{-- Icons Only --}}
  @elseif(Auth::user()->actionButtons == 2)
     <i class="fa fa-floppy-o fa-2x" aria-hidden="true"></i>
  {{-- Text Only --}}
  @elseif(Auth::user()->actionButtons == 3)
     Update {{ str_singular(ucfirst($name)) }}
  @endif
</button>