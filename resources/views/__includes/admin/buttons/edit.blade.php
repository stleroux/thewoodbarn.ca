{{-- Edit button --}}

@if (Auth::user()->id == $uid)
  @ability('admin', 'admin,'.str_singular($model).'_edit,'.str_singular($model).'_edit_admin')
    <a href="{{ route('admin.'.$model.'.edit', $id) }}" class="btn btn-primary btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=Edit' : '' }}>
      @if(Auth::user()->actionButtons == 1)
        {{-- Icons and Text --}} <i class="glyphicon glyphicon-pencil"></i> Edit
      @elseif(Auth::user()->actionButtons == 2)
        {{-- Icons Only --}} <i class="glyphicon glyphicon-pencil"></i>
      @elseif(Auth::user()->actionButtons == 3)
        {{-- Text Only --}} Edit
      @endif
    </a>
  @endability
@else
  @ability('admin', 'admin,'.$model.'_edit_admin')
    <a href="{{ route('admin.'.$model.'.edit', $id) }}" class="btn btn-primary btn-xs" {{ Auth::user()->actionButtons == 2 ? 'title=Edit' : '' }}>
      @if(Auth::user()->actionButtons == 1)
        {{-- Icons and Text --}} <i class="glyphicon glyphicon-pencil"></i> Edit
      @elseif(Auth::user()->actionButtons == 2)
        {{-- Icons Only --}} <i class="glyphicon glyphicon-pencil"></i>
      @elseif(Auth::user()->actionButtons == 3)
        {{-- Text Only --}} Edit
      @endif
    </a>
  @endability
@endif
