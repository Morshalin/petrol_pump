<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\TransactionPurchaseLine;
use App\TransactionSaleLine;
use App\CompanyInfo;
use App\Customer;
use App\ProductItem;
use App\Expense;
use App\AccountTransaction;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class ReportController extends Controller{

    public function stockreport(){
        $models = ProductItem::all();
        return view('admin.reports.stockReport',compact('models'));
    }

    public function stockreportresult(Request $request){
        $to_date   = $request->to_date;
        $form_date = $request->form_date;
        $product_id = $request->product_id;
         $model = Transaction::where('transactions_date','>=', $to_date)->where('transactions_date','<=', $form_date)->get();
        $tranaction_id =[];
        foreach ($model as $key => $value) {
           $tranaction_id[] = $value->id;
        }
        if($product_id == 0){
            $models = TransactionPurchaseLine::whereIn('transaction_id', $tranaction_id)->get();
        }else{
            $models = TransactionPurchaseLine::whereIn('transaction_id', $tranaction_id)->where('product_item_id',$product_id)->get();
        }
        return view('admin.reports.stockReportList',compact('models','product_id','to_date','form_date'));
        
    }

    public function salesreport(){
        $models = ProductItem::all();
        return view('admin.reports.saleReport',compact('models'));
    }

    public function salereportresilt(Request $request){
        $to_date   = $request->to_date;
        $form_date = $request->form_date;
        $product_id = $request->product_id;
        //dd($product_id);
        $model = Transaction::where('transactions_date','>=', $to_date)->where('transactions_date','<=', $form_date)->get();
        $tranaction_id =[];
        foreach ($model as $key => $value) {
           $tranaction_id[] = $value->id;
        }
        if($product_id == 0){
            $models = TransactionSaleLine::whereIn('transaction_id',$tranaction_id)->get();
        }else{
            $models = TransactionSaleLine::whereIn('transaction_id',$tranaction_id)->where('product_item_id',$product_id)->get();
        }
        return view('admin.reports.salesReportList',compact('models','product_id','to_date','form_date'));
    }

    public function companyReport(){
        $models = CompanyInfo::all();
        $product = ProductItem::all();
        return view('admin.reports.companyReport',compact('models','product'));
    }

  
    public function companyReportResult(Request $request){
        $to_date   = $request->to_date;
        $form_date = $request->form_date;
        $company_id = $request->company_id;
        $product_id = $request->product_id;
        
        if($company_id == 0){
             $model = Transaction::where('transactions_date','>=', $to_date)->where('transactions_date','<=', $form_date)->where('transaction_status','purchase')->get();
        }else{
            $model = Transaction::where('transactions_date','>=', $to_date)->where('transactions_date','<=', $form_date)->where('company_info_id',$company_id)->get();
        }
        $tranaction_id =[];
        foreach ($model as $key => $value) {
           $tranaction_id[] = $value->id;
        }
        if($product_id == 0){
            $models = TransactionPurchaseLine::whereIn('transaction_id',$tranaction_id)->get();
        }else{
            $models = TransactionPurchaseLine::whereIn('transaction_id',$tranaction_id)->where('product_item_id',$product_id)->get();
        }
        return view('admin.reports.companyReportList',compact('models','product_id','company_id','to_date','form_date'));
    }

    public function customerReport(){
        $models = Customer::all();
        $product = ProductItem::all();
        return view('admin.reports.customerReport',compact('models','product'));
    }

  
    public function customerReportResult(Request $request){
        $to_date   = $request->to_date;
        $form_date = $request->form_date;
        $customer_id = $request->customer_id;
        $product_id = $request->product_id;
        
        if($customer_id == 0){
            $model = Transaction::where('transactions_date','>=', $to_date)->where('transactions_date','<=', $form_date)->where('transaction_status','sale')->whereNull('customer_id')->get();
        }else{
            $model = Transaction::where('transactions_date','>=', $to_date)->where('transactions_date','<=', $form_date)->where('customer_id',$customer_id)->get();
        }
        $tranaction_id =[];
            foreach ($model as $key => $value) {
                $tranaction_id[] = $value->id;
            }
        if($product_id == 0){
            $models = TransactionSaleLine::whereIn('transaction_id',$tranaction_id)->get();
        }else{
            $models = TransactionSaleLine::whereIn('transaction_id',$tranaction_id)->where('product_item_id',$product_id)->get();
        }
        return view('admin.reports.customerReportList',compact('models','product_id','to_date','form_date','customer_id'));
    }

    public function profitLossReport(){
        $purchase = Transaction::where('transaction_status','purchase')->get();
        $sale = Transaction::where('transaction_status','sale')->get();
        $expence = Expense::sum('amount') + AccountTransaction::where('type','Withdraw')->sum('amount');
        $income = AccountTransaction::where('type','Deposite')->sum('amount');
        return view('admin.reports.profitLossReport',compact('purchase','sale','expence','income'));
    }

    public function dayBydayReport(){
        $product = ProductItem::all();
        return view('admin.reports.dayBydayReport',compact('product'));
    }

    public function daybydayreportlist(Request $request){
       
        $month = $request->select_month;
        $expolde =explode('-',$month);
        $report_year =$expolde[0];
        $report_month =$expolde[1];
        $product = $request->product_id;


       $d = new DateTime($month, new DateTimeZone('UTC')); 
        $d->modify('first day of previous month');
        $month = $d->format('m');
        if ($month ==01) {
            $year = $d->format('Y'); 
        }
        else {
            $year =date('y');
        }
        $pervious_purcahse =TransactionPurchaseLine::where('product_item_id',$product)->whereMonth('created_at',$month)->whereYear('created_at',$year)->sum('quantity');
        $pervious_sale =TransactionSaleLine::where('product_item_id',$product)->whereMonth('created_at',$month)->whereYear('created_at',$year)->sum('quantity');
        $previous_total =$pervious_purcahse-$pervious_sale;
        $day =days_in_month($report_month,$report_year);
        return view('admin.reports.day_report',compact('pervious_purcahse','pervious_sale','day','report_year','report_month','previous_total','product'));
    
    }
}
