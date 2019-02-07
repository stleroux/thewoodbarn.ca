@extends ('layouts.main')

@section ('title', '| ')

@section ('stylesheets')
    {{-- {{ Html::style('css/main.css') }} --}}
@stop 
 
 @section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('items.index') }}">Items</a></li>
  <li>Show</li>
@stop

@section('menubar')
  {{-- @include('layouts.buttons.delete', ['model'=>$item, 'name'=>'items', 'id'=>$item->id]) --}}
  {{-- @include('layouts.buttons.edit', ['model'=>$item, 'name'=>'items', 'id'=>$item->id]) --}}
  @include('layouts.buttons.cancel', ['name'=>'items'])
@stop

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading">Show Item</div>
        <div class="panel-body">
          <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">Title</div>
              <div class="panel-body">
                {{ $item->title }}
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">Description</div>
              <div class="panel-body">
                {{ $item->description }}
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">Author</div>
              <div class="panel-body">
                {{ $item->user->username }}
              </div>
            </div>
          </div>
        </div>
        <div class="panel-footer"></div>
      </div>
    </div>
{{--     <div class="col-xs-3">
      <div class="panel panel-default">
        <div class="panel-body">
          
        </div>
      </div>
    </div> --}}
  </div>

@stop

@section ('scripts')
@stop