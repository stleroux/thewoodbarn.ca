@extends ('layouts.admin.main')

@section ('title', '| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
  {{-- {{ Html::style('css/star-rating-min.css') }} --}}
@stop 

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.items.index') }}">Items</a></li>
  <li>Show</li>
@stop

@section('page_top_menu')
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- INDEX BUTTON                                                                                                                   --}}
          {{--================================================================================================================================--}}
          <a class="btn btn-default btn-xs btn-block" href="{{ route('admin.items.index') }}">
            <div class="text text-left">
              <i class="fa fa-list"></i> Items List
            </div>
          </a>
          {{--================================================================================================================================--}}
          {{-- END INDEX BUTTON                                                                                                               --}}
          {{--================================================================================================================================--}}
        </div>
      </div>
    </div>
  </div>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class='panel-heading'>{{ $item->title }}</div>
        <div class="panel-body">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <strong>Description:</strong>
              {{ $item->description }}
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <strong>Author:</strong>
              @include('layouts.common.author', ['model'=>$item, 'field'=>'user'])
            </div>
            {{-- <input id="input-id" name="input-name" type="number" class="rating" min=1 max=10 step=2 data-size="lg" data-rtl="true"> --}}
          </div>
        </div> {{-- End Panel Body --}}
      </div> {{-- End Panel --}}
    </div> {{-- End Column --}}
  </div> {{-- End Row --}}
@stop

@section ('scripts')
  {{-- {{ HTML::script('js/star-rating-min.js') }} --}}
@stop