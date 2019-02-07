{{--  --}}
<div class="row">
  <div class="col-xs-{{ isset($cols) ? $cols : '12'}}">
    <div class="panel panel-{{ $errors->all() ? 'danger' : 'default' }}">
      <div class="panel-heading">
        @include('layouts.commonErrorPanelHeaderFooter')
        <i class="fa {{ $icon }}" aria-hidden="true"></i>
          @if (Request::is('*trashed'))
            Trashed {{ $name }}
          @else
            {{ $name }}
          @endif
        @include ('layouts.messages')
      </div>
    