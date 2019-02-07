@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/style.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  {{-- <li><a href="/admin">Control Panel</a></li> --}}
  <li>Products</li>
@stop

@section('menubar')
  @include('layouts.dropdowns.import', ['name'=>'products'])
  @include('layouts.buttons.dashboard')
  @include('layouts.buttons.add', ['name'=>'products'])
@stop

@section('content')
@include('layouts.partials.section_top', ['name'=>'Products', 'icon'=>'fa-wpforms'])
        <div class="panel-body">
          <table id="datatable" class="table table-hover table-striped table-condensed">
            <thead>
              <tr>
                <th>Title</th>
                <th>Category</th>
                <th class="hidden-sm hidden-xs">Description</th>
                <th>Price</th>
                <th class="hidden-xs">Author</th>
                <th data-orderable="false"></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($products as $key => $product)
                <tr>
                  <td><a href="{{ route('products.show', $product->id) }}" class="">{{ $product->title }}</a></td>
                  <td>{{ $product->category->name }}</td>
                  <td class="hidden-sm hidden-xs">{!! str_limit($product->description, $limit = 50, $end = '...') !!}</td>
                  <td style="text-align: right;">
                    @if ($product->price > 0)
                      $ {{ number_format($product->price, 2, '.', ',') }}
                    @else
                      N/A
                    @endif
                  </td>
                  <td class="hidden-xs">@include('layouts.author', ['model'=>$product, 'field'=>'user'])</td> 
                  <td class="text-rigth" nowrap="nowrap">
                    @include('layouts.buttons.edit', ['model'=>$product, 'name'=>'products', 'id'=>$product->id])
                    @include('layouts.buttons.delete', ['model'=>$product, 'name'=>'products', 'id'=>$product->id])
                  </td>
                </tr>
              @empty
                <p class="alert alert-danger">No records found</p>
              @endforelse
            </tbody>
          </table>
        </div>
      @include('layouts.partials.section_close')
@stop
