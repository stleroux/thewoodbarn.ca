<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Cart;
use App\Order;
use App\Product;
use Auth;
use Session;
use Stripe\Charge;
use Stripe\Stripe;
use Log;

class CartController extends Controller
{

  // ================================================================================================================================
  // CONSTRUCT ::
  // ================================================================================================================================
  public function __construct() {
    Log::useFiles(storage_path().'/logs/shop.log');
  }

    public function getIndex($key)
    {
    	$productCategories = Category::where('module_id','=',4)->get();
    	//dd($categories);

   //  	$products = Product::where('price','>',0)
			// ->orderBy('title','asc')
			// ->get();

    	if ($key == 'all') {
			$products = Product::where('price','>',0)
				->orderBy('title','asc')
				->get();
    	} else {
			$products = Product::where('price','>',0)
				->where('category_id','=', $key)
				->orderBy('title','asc')
				->get();
    	}
    	//return view('shop.index', ['products' => $products]);
    	return view('shop.index', ['products' => $products, 'productCategories' => $productCategories]);
    }

    public function getAddToCart (Request $request, $id) {
		$product = Product::find($id);
		$oldCart = Session::has('cart') ? Session::get('cart') : null;
		$cart = new Cart($oldCart);
		$cart->add($product, $product->id);

		$request->session()->put('cart', $cart);
		//dd($request->session()->get('cart'));
		return redirect()->route('shop.index','all');
	}

	public function getReduceByOne($id)
	{
		$oldCart = Session::has('cart') ? Session::get('cart') : null;
		$cart = new Cart($oldCart);
		$cart->reduceByOne($id);

		if (count($cart->items) > 0) {
			Session::put('cart', $cart);
		} else {
			Session::forget('cart');
		}
		
		return redirect()->route('shop.shoppingCart');
	}

	public function getIncreaseByOne(Request $request, $id)
	{
		$product = Product::find($id);
		$oldCart = Session::has('cart') ? Session::get('cart') : null;
		$cart = new Cart($oldCart);
		$cart->add($product, $product->id);

		$request->session()->put('cart', $cart);
		//dd($request->session()->get('cart'));
		return redirect()->route('shop.shoppingCart');
	}

	public function getRemoveItem($id)
	{
		$oldCart = Session::has('cart') ? Session::get('cart') : null;
		$cart = new Cart($oldCart);
		$cart->removeItem($id);

		if (count($cart->items) > 0) {
			Session::put('cart', $cart);
		} else {
			Session::forget('cart');
		}

		return redirect()->route('shop.shoppingCart');
    }

    public function getClearCart()
    {
    	Session::forget('cart');
		//return redirect()->route('shop.shoppingCart');
		return redirect()->route('shop.index','all');
    }

    public function getCart()
    {
    	if (!Session::has('cart')) {
			return view('shop.shopping-cart');
		}
    	$oldCart = Session::get('cart');
    	$cart = new Cart($oldCart);
    	return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout()
    {
		if (!Session::has('cart')) {
			return view('shop.shopping-cart');
		}
		$oldCart = Session::get('cart');
		$cart = new Cart($oldCart);
		$total = $cart->totalPrice;
		return view('shop.checkout', ['total' => $total]);
	}

	public function postCheckout(Request $request)
	{
		if (!Session::has('cart')) {
			return redirect()->route('shop.shoppingCart');
		}

		$oldCart = Session::get('cart');
		$cart = new Cart($oldCart);

		Stripe::setApiKey('sk_test_tN1dbKbnlbjeikSqpoCWtH4v');
		try {
			$charge = Charge::create(array(
				"amount" => $cart->totalPrice * 100,
				"currency" => "cad",
				"source" => $request->input('stripeToken'),
				"description" => "Test charge"
			));
			
			$order = new Order();
				$order->cart = serialize($cart);
				$order->name = $request->input('name');
				$order->address = $request->input('address');
				$order->payment_id = $charge->id;
			Auth::user()->orders()->save($order);

		} catch (\Exception $e) {
			return redirect()->route('checkout')->with('error', $e->getMessage());
		}

		Session::forget('cart');
		return redirect()->route('shop.index','all')->with('success', 'Successfully purchased products!');
	}
}
