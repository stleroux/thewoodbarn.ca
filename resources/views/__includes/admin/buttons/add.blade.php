{{-- Add button --}}

@ability('admin', 'admin,'.$model.'_create,'.$model.'_create_admin')
  <a href="{{ route('admin.'.$model.'.create') }}" class="btn btn-success btn-xs btn-block">
    @if(Auth::user()->actionButtons == 1)
      {{-- Icons and Text --}} <i class="fa fa-plus-square" aria-hidden="true"></i> New {{ str_singular(ucfirst($model)) }}
    @elseif(Auth::user()->actionButtons == 2)
      {{-- Icons Only --}} <i class="fa fa-plus-square" aria-hidden="true"></i>
    @elseif(Auth::user()->actionButtons == 3)
      {{-- Text Only --}} New {{ str_singular(ucfirst($model)) }}
    @endif
  </a>
@endability