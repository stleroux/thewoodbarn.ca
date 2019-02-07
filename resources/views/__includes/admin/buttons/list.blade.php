<a href="{{ route($model.'.index') }}" class="btn btn-default btn-xs" {{ $model->user->actionButtons == 2 ? 'title=List' : '' }}>
  {{-- Icons and Text --}}
  @if($model->user->actionButtons == 1)
  <i class="glyphicon glyphicon-list"></i> All {{ ucfirst($primer) }}
  @endif

  {{-- Icons Only --}}
  @if($model->user->actionButtons == 2)
  <i class="glyphicon glyphicon-list"></i>
  @endif

  {{-- Text Only --}}
  @if($model->user->actionButtons == 3)
  All {{ ucfirst($primer) }}
  @endif
</a>