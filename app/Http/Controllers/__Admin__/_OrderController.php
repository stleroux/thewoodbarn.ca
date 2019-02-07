<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Order;
use Log;
use Auth;

class OrderController extends Controller
{

  // ================================================================================================================================
  // CONSTRUCT ::
  // ================================================================================================================================
  public function __construct() {
    // only allow authenticated users to access these pages
    $this->middleware('auth');

    Log::useFiles(storage_path().'/logs/Admin_Orders.log');
  }

  // ================================================================================================================================
  // INDEX :: Display a listing of the resource.
  // ================================================================================================================================
	public function index()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }

		// $orders = Order::paginate(5);
    $orders = Order::with('user')->paginate(5);
      $orders->transform(function($order, $key) {
        $order->cart = unserialize($order->cart);
        return $order;
      });

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") ACCESSED Admin\Orders module");

		return view ('admin.orders.index', compact('orders'));
	}

  // ================================================================================================================================
  // 
  // ================================================================================================================================
	public function test1()
  {
		return view('admin.test1');
	}

 }