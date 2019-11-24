<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employess;
use App\Customer;
use App\Product;
use App\ProductItem;
use App\SalesCustomer;
use App\ProductStock;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $product =ProductItem::all();
        $employer = Employess::count();
        $customer = Customer::count();
        $sale = SalesCustomer::all();
        $sale_in_stock = ProductStock::all();
        return view('home',compact('employer','customer','sale','product','sale_in_stock'));
    }
}
