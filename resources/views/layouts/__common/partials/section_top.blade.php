{{--  --}}
<div class="row">
  <div class="col-xs-12">
    <div class="panel panel-{{ $errors->all() ? 'danger' : 'default' }}">
      <div class="panel-heading">
        @include('layouts.common.commonErrorPanelHeaderFooter')
        <i class="fa {{ $icon }}" aria-hidden="true"></i>
        {{ $name }}
        @include ('layouts.common.messages')
      </div>
    