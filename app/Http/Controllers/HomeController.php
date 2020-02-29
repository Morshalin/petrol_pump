<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Transaction;
use Charts;
use DB;


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
        $total_purchase = Transaction::where('transaction_status','purchase')->sum('net_total');
        $total_sale = Transaction::where('transaction_status','sale')->sum('net_total');
        $total_purchase_due = Transaction::where('transaction_status','purchase')->sum('due');
        $total_sale_due = Transaction::where('transaction_status','sale')->sum('due');

        $transaction_purchase = Transaction::where('transaction_status','purchase')->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
  
        $purhcase = Charts::database($transaction_purchase, 'bar', 'highcharts')
			      ->title("Monthly Purchase Product")
			      ->elementLabel("Total Purchase")
			      ->dimensions(1000, 500)
			      ->responsive(false)
                  ->groupByMonth(date('Y'), true);

        $transaction_sale = Transaction::where('transaction_status','sale')->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $sale = Charts::database($transaction_sale, 'bar', 'highcharts')
			      ->title("Monthly Sale Product")
			      ->elementLabel("Total Sale")
			      ->dimensions(1000, 500)
			      ->responsive(false)
                  ->groupByMonth(date('Y'), true);
                  
        return view('home',compact('total_purchase','total_sale','total_purchase_due','total_sale_due','purhcase','sale'));
    }
}
