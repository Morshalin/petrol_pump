<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BankAccount;
use App\IncomeSource;
use App\AccountTransaction;
use App\ExpenseCategory;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = AccountTransaction::all();
        return view('admin.transaction.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
       $bavk_acc =  BankAccount::all();
       $income_sourse = IncomeSource::all();
        return view('admin.transaction.deposite',compact('bavk_acc','income_sourse'));
    }

    public function moneyDeposite($id=null){
       $bavk_acc =  BankAccount::all();
       $income_sourse = IncomeSource::all();
        return view('admin.transaction.deposite',compact('bavk_acc','income_sourse','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

       $validatedData = $request->validate([
            'bank_account_id'=>'required',
            'income_source_id'=>'required',
            'invo_id'=>'',
            'type'=>'required',
            'acc_type'=>'required',
            'about'=>'required',
            'amount'=>'required',
            'balance'=>'',
            'note'=>'',
        ]);
         
        $model = AccountTransaction::orderBy('id','desc')->first();
        if(isset($model->balance) && $model->balance > 0){
            $balance = $model->balance + $request->amount;
        }else{
            $balance=$request->amount;
        }
        //dd($balance);
        $validatedData['balance'] = $balance;

        $ym = Carbon::now()->format('Y/m');
        $row = AccountTransaction::where('type', 'Deposite')->get()->count() > 0 ? AccountTransaction::where('type', 'Deposite')->get()->count() + 1 : 1;
        $ref_no = $ym.'/D-'.ref($row);

        $validatedData['invo_id'] = $ref_no;

        $model = new AccountTransaction();
        $model->create($validatedData);
        
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Amount Deposite Successfuly'), 'goto' => route('admin.transaction.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function moneyWithdraw($id=null){
       $bavk_acc =  BankAccount::all();
       $expense_type = ExpenseCategory::all();
        return view('admin.transaction.withdraw',compact('bavk_acc','expense_type','id'));
    }

    public function withdraw(Request $request){
       $validatedData = $request->validate([
            'bank_account_id'=>'required',
            'expense_category_id'=>'required',
            'invo_id'=>'',
            'type'=>'required',
            'acc_type'=>'required',
            'about'=>'required',
            'amount'=>'required',
            'balance'=>'',
            'note'=>'',
        ]);
         
        $model = AccountTransaction::orderBy('id','desc')->first();
        if(isset($model->balance) && $model->balance > 0){
            $balance = $model->balance - $request->amount;
        }else{
            $balance =0-$request->amount;
        }
        //dd($balance);
        $validatedData['balance'] = $balance;

        $ym = Carbon::now()->format('Y/m');
        $row = AccountTransaction::where('type', 'Deposite')->get()->count() > 0 ? AccountTransaction::where('type', 'Deposite')->get()->count() + 1 : 1;
        $ref_no = $ym.'/D-'.ref($row);

        $validatedData['invo_id'] = $ref_no;

        $model = new AccountTransaction();
        $model->create($validatedData);
        
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Amount Deposite Successfuly'), 'goto' => route('admin.transaction.index')]);
    }

    public function accountBalance(){
        $models = BankAccount::all();
        $model = AccountTransaction::all();
        return view('admin.transaction.account',compact('models','model'));
    }

}
