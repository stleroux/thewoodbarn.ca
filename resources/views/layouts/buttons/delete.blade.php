{{--================================================--}}
{{-- DELETE BUTTON                                  --}}
{{--================================================--}}
@if(Auth::check())
  @if((checkACL('manager')) || (checkOwner($model)))
    <form method="POST" action="{{ route($name.'.destroy', $id) }}" accept-charset="UTF-8" style="display:inline">
      <input type="hidden" name="_method" value="DELETE">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <button
        class="btn btn-danger btn-xs"
        {{ Auth::user()->actionButtons == 2 ? 'title=Delete' : '' }}
        type="button"
        data-toggle="modal"
        data-id="{{ $id }}"
        data-target="#confirmDelete"
        data-title="Are you sure you want to delete this {{ str_singular($name) }}?"
        data-message="{{ $model->title }}">
          {{-- Icons and Text --}}
          @if(Auth::user()->actionButtons == 1) <i class="fa fa-trash-o" aria-hidden="true"></i> Trash
          {{-- Icons Only --}}
          @elseif(Auth::user()->actionButtons == 2) <i class="fa fa-trash-o" aria-hidden="true"></i>
          {{-- Text Only --}}
          @elseif(Auth::user()->actionButtons == 3) Trash
          @endif
      </button>
    </form>
  @else
    <a href="#" class="btn btn-xs btn-danger" disabled="disabled">
     {{-- Icons and Text --}}
      @if(Auth::user()->actionButtons == 1) <i class="fa fa-trash-o" aria-hidden="true"></i> Trash
      {{-- Icons Only --}}
      @elseif(Auth::user()->actionButtons == 2) <i class="fa fa-trash-o" aria-hidden="true"></i>
      {{-- Text Only --}}
      @elseif(Auth::user()->actionButtons == 3) Trash
      @endif 
    </a>
  @endif
@endif
