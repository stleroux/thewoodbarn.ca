{{-- https://www.youtube.com/watch?v=oc1_DHfL89k - Shopping Cart tutorial --}}
@extends ('layouts.main')

@section('title','Shopping Cart')

@section('stylesheets')
  {{ Html::style('css/shop.css') }}
  {{ Html::style('css/main.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Products</li>
@stop

@section('content')

  {{-- 	@if (Session::has('success'))
    <div class="row">
      <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
        <div id="charge-message" class="alert alert-success">
          {{ Session::get('success') }}
        </div>
      </div>
    </div>
  @endif --}}

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Product Categories</div>
        <div class="panel-body">
          {{-- <div class="list-group list-group-horizontal"> --}}
          {{-- class="{{ Request::is('recipes/myFavorites/*') ? "btn-primary": "btn-default" }} btn btn-xs" --}}
            <a href="/shop/index/all" class="btn btn-sm {{ Request::is('shop/index/all') ? "btn-primary": "btn-default" }}"> All</a>
            @foreach ($productCategories as $productCategory)
              <a href="{{ route('shop.index', $productCategory->id) }}"
                 class=" btn btn-sm {{ Request::is('shop/index/'.$productCategory->id) ? "btn-primary": "btn-default" }}">
                {{ $productCategory->name }}
              </a>
            @endforeach
          {{-- </div> --}}
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Products</div>
        <div class="panel-body">
          <table id="datatable" class="table table-responsive table-striped table-hover">
            <thead>
              <tr>
                <th>Image</th>
                <th>Name</th>
                <th class="hidden-xs">Description</th>
                <th>Price</th>
                <th data-orderable="false"></th>
              </tr>
            </thead>
            @foreach($products as $product)
              <tr>
                <td>
                  <a href="{{ $product->imagePath }}" target="_blank">
                  {!! $product->imagePath ?
                    "<img src='$product->imagePath' alt='...' height='75' width='60'>" :
                    "<img src='images/Not_available.jpg' alt='...' class='img-thumbnail'>"
                  !!}
                  </a>
                </td>
                <td>{{ $product->title }}</td>
                <td width="50%" class="hidden-xs">{{ $product->description }}</td>
                <td>$ {{ $product->price }}</td>
                <td><a href="{{ route('shop.addToCart', ['id' => $product->id]) }}" class="btn btn-success btn-sm pull-right" role="button">Add to Cart</a></td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>

<br />


{{-- 	@foreach($products->chunk(3) as $productChunk)
		<div class="row">
			@foreach($productChunk as $product)
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						@if ($product->imagePath)
							<img src="{{ $product->imagePath }}" alt="..." class="img-responsive">
						@else
							<img src="images/Not_available.jpg" alt="..." class="img-responsive">
						@endif
						<div class="caption">
							<h3>{{ $product->title }}</h3>
							<p>Category : {{ $product->category->name }}</p>
							<p class="description">{{ $product->description }}</p>
							<div class="clearfix">
								<div class="pull-left price">$ {{ $product->price }}</div>
								<a href="{{ route('shop.addToCart', ['id' => $product->id]) }}" class="btn btn-success pull-right" role="button">Add to Cart</a>
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	@endforeach --}}

	
{{-- 
<table id="datatable" class="table table-hover table-condensed">
	<thead>
		<tr>
			<th>Image</th>
			<th>Title</th>
			<th>Description</th>
			
			
			
				<th>Price</th>
				<th data-orderable="false"></th>
			
		</tr>
	</thead>
	<tbody>
	@foreach($products as $product)
		<tr>
			<td class="thumbnail"><img src="{{ $product->imagePath }}" alt="..." class="img-responsive"></td>
			<td>
				<table width="100%">
					<tr>
						<td class="caption"><h3>{{ $product->title }}</h3></td>
					</tr>
					<tr>
						<td class="description">{{ $product->description }}</td>
					</tr>
					<tr>
						<td class="price">{{ $product->price }}</td>
					</tr>
				</table>
			</td>
			<td>
				<a href="{{ route('product.addToCart', ['id' => $product->id]) }}" class="btn btn-success pull-right" role="button">Add to Cart</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
 --}}
@stop

@section('scripts')
@stop