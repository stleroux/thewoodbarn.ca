@extends('layouts.main')

@section('title','Items')

@section('stylesheets')
  {{ Html::style('css/main.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  @if (Request::is('*trashed'))
    <li>Trashed Items</li>
  @else
    <li>Items</li>
  @endif
@stop

@section('menubar')
  @include('layouts.buttons.index', ['model'=>'items', 'name'=>'items', 'icon'=>'fa-shopping-basket'])
  @include('layouts.buttons.trashed', ['model'=>'items', 'name'=>'items', 'icon'=>'fa-ban'])
  @include('layouts.buttons.massRestore', ['name'=>'items'])
  @include('layouts.buttons.massDelete', ['name'=>'items'])
  @include('layouts.dropdowns.import', ['name'=>'items'])
  @include('layouts.buttons.dashboard')
  @include('layouts.buttons.add', ['name'=>'items'])
@stop

@section('content')
{{-- <form> --}}
  @include('layouts.partials.section_top', ['name'=>'Items', 'icon'=>'fa-shopping-basket'])
    <div class="panel-body">
      <table id="datatable" class="table table-hover table-mini table-responsive">
        <thead>
          <tr>
            @if((checkACL('admin')))
              <th data-orderable="false"><input type="checkbox" class="checkbox_all"></th>
            @endif
            <th>Title</th>
            <th class="hidden-xs">Description</th>
            <th class="hidden-xs hidden-sm">Author</th>
            @if (Auth::check())
              <th data-orderable="false"></th>
            @endif
          </tr>
        </thead>
        <tbody>
          @foreach ($items as $key => $item)
            <tr>
              {{-- <td>{{ ++$i }}</td> --}}
              
              @if((checkACL('admin')))
                <td><input type="checkbox" class="checkbox_delete" name="entries_to_delete[]" value="{{ $item->id }}" /></td>
              @endif
              <td><a href="{{ route('items.show', $item->id) }}" class="">{{ $item->title }}</a></td>
              <td class="hidden-xs">{!! $item->description !!}</td>
              <td class="hidden-xs hidden-sm">@include('layouts.author', ['model'=>$item, 'field'=>'user'])</td>
              <td class="text-right">
                @if(!$item->deleted_at)
                  @include('layouts.buttons.edit', ['model'=>$item, 'name'=>'items', 'id'=>$item->id])
                  @include('layouts.buttons.delete', ['model'=>$item, 'name'=>'items', 'id'=>$item->id])
                @endif
                @if($item->deleted_at)
                  @include('layouts.buttons.restore', ['model'=>$item, 'name'=>'items', 'id'=>$item->id])
                  @include('layouts.buttons.deleteTrashed', ['model'=>$item, 'name'=>'items', 'id'=>$item->id])
                @endif
              </td>
            
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @include('layouts.partials.section_close')






{{-- </form> --}}

{{-- <form action="{{ route('items.massDestroy') }}" method="post" onsubmit="return confirm('Are you sure?');">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="DELETE">
  <input type="hidden" name="ids" id="ids" value="" />
  <input type="submit" value="Delete Selected" class="btn btn-xs btn-danger" />
</form> --}}
@stop

@section('footer')
	Example of footer specific to this page
@stop

@section('scripts')

{{--   <script src="/js/app.js"></script>
  <script src="https://code.jquery.com/jquery-3.1.1.js"></script> --}}

  <script>
    function getIDs()
    {
      var ids = [];
      $('.checkbox_delete').each(function () {
        if($(this).is(":checked")) {
          ids.push($(this).val());
        }
      });
      $('#ids').val(ids.join());
    }

    $(".checkbox_all").click(function(){
      $('input.checkbox_delete').prop('checked', this.checked);
      getIDs();
    });

    $('.checkbox_delete').change(function() {
      getIDs();
    });
  </script>
@endsection