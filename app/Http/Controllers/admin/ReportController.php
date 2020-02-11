<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\TransactionPurchaseLine;

class ReportController extends Controller{

    public function stockreport(){
        return view('admin.reports.stockReport');
    }

    public function stockreportresult(Request $request){
        $to_date   = $request->to_date;
        $form_date = $request->form_date;
        $model = Transaction::where('transactions_date','>=', $to_date)->where('transactions_date','<=', $form_date)->get();
        $tranaction_id =[];
        foreach ($model as $key => $value) {
           $tranaction_id[] = $value->id;
        }
        $models = TransactionPurchaseLine::where('transaction_id',$tranaction_id)->get();
        return view('admin.reports.stockReportList',compact('models'));
    }
}
