{{-- Delete button --}}

@if (Auth::user()->id == $uid)
  @ability('admin', 'admin,'.str_singular($model).'_delete,'.str_singular($model).'_delete_admin')
    <form method="POST" action="{{ route('admin.'.$model.'.destroy', $id) }}" accept-charset="UTF-8" style="display:inline">
      <input type="hidden" name="_method" value="DELETE">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <button class="btn btn-xs btn-danger"
        {{ Auth::user()->actionButtons == 2 ? 'title=Delete' : '' }}
        type="button"
        data-toggle="modal"
        data-id="{{ $id }}"
        data-target="#confirmDelete"
        data-title="Delete {{ str_singular(ucfirst($model)) }}"
        data-message="Are you sure you want to delete this {{ str_singular($model) }}?">
        @if(Auth::user()->actionButtons == 1)
          {{-- Icons and Text --}} <i class="glyphicon glyphicon-trash"></i> Delete
        @elseif(Auth::user()->actionButtons == 2)
          {{-- Icons Only --}} <i class="glyphicon glyphicon-trash"></i>
        @elseif(Auth::user()->actionButtons == 3)
          {{-- Text Only --}} Delete
        @endif
      </button>
    </form>
  @endability
@else
  @ability('admin', 'admin,'.str_singular($model).'_delete_admin')
    <form method="POST" action="{{ route('admin.'.$model.'.destroy', $id) }}" accept-charset="UTF-8" style="display:inline">
      <input type="hidden" name="_method" value="DELETE">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <button
        class="btn btn-xs btn-danger"
        {{ Auth::user()->actionButtons == 2 ? 'title=Delete' : '' }}
        type="button"
        data-toggle="modal"
        data-id="{{ $id }}"
        data-target="#confirmDelete"
        data-title="Delete {{ str_singular(ucfirst($model)) }}"
        data-message="Are you sure you want to delete this {{ str_singular($model) }}?">
        @if(Auth::user()->actionButtons == 1)
          {{-- Icons and Text --}} <i class="glyphicon glyphicon-trash"></i> Delete
        @elseif(Auth::user()->actionButtons == 2)
          {{-- Icons Only --}} <i class="glyphicon glyphicon-trash"></i>
        @elseif(Auth::user()->actionButtons == 3)
          {{-- Text Only --}} Delete
        @endif
      </button>
    </form>
  @endability
@endif
