<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\ProductItem;
use App\CompanyInfo;
use App\Transaction;
use App\Employess;
use App\TransactionPayment;
use App\TransactionPurchaseLine;
use App\PayMethod;
use Carbon\Carbon;
use Auth;


class PurchesController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $models = Transaction::with('purchase_line')->where('transaction_status','purchase')->get();
        return view('admin.purchase.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $models = ProductItem::all();
        $user_id = Auth::user()->id;
        $company = CompanyInfo::all();
        $employee = Employess::all();
        $pay_method = PayMethod::all();
        //Auto generate Invoice Number
        $ym = Carbon::now()->format('Y/m');
        $row = Transaction::count() > 0 ? Transaction::count() + 1 : 1;
        $invoice_no = $ym.'/S-'.ref($row);
        return view('admin.purchase.create',compact('models','user_id','company','employee','pay_method','invoice_no'));
    }


    public function item(Request $request){
        $model =ProductItem::find($request->product_id);
        return response()->json($model);
    }

    public function append(Request $request){
        $product =$request->product;
        $quantity =$request->quantity;
        $row =$request->row;
        $model =ProductItem::find($product);
        return view('admin.purchase.append',compact('model','quantity','row'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        dd($request->paid);
        $validatedData = $request->validate([
            'company_info_id'=>'required|max:255',
            'employess_id'=>'required',
            'customer_id'=>'',
            'user_id'=>'required',
            'transaction_status'=>'required|max:255',
            'transactions_date'=>'required|max:255',
            'pay_type'=>'required|max:255',
            'invoice_no'=>'unique:transactions|max:255',
            'sub_total'=>'required|max:255',
            'discount_type'=>'max:255',
            'discount_amount'=>'max:255',
            'discount'=>'max:255',
            'net_total'=>'required|max:255',
            'pay_method'=>'required|max:255',
            'TrxID'=>'max:255|nullable|sometimes|unique:transactions',
            'paid'=>'required',
            'due'=>'required|max:255',
            'additional_notes'=>'max:255',
            'status'=>'',
        ]);
    
       if ($request->status) {
            $validatedData['status'] = 1;
        }else{
            $validatedData['status'] = 0;
        }

        if ($request->pay_type == 'paid') {
            if ($request->paid != $request->net_total) {
               return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Oops, Paid Amount not full pay.'), 'goto' => route('admin.purchase.index')]);
            }
        }

        $model = new Transaction;
        if ($request->invoice_no) {
            $validatedData['invoice_no'] = $request->invoice_no;
        }else{
            $ym = Carbon::now()->format('Y/m');
            $row = Transaction::count() > 0 ? Transaction::count() + 1 : 1;
            $ref_no = $ym.'/P-'.ref($row);
            $validatedData['invoice_no'] = $ref_no;
        }
        $success = $model->create($validatedData);
        if ($success) {
            $count = count($request->product_item_id);
           for ($i=0; $i < $count; $i++) {
                $line_purchase = new TransactionPurchaseLine;
                $line_purchase->transaction_id = $success->id;
                $line_purchase->product_item_id = $request->product_item_id[$i];
                $line_purchase->vehicle_name = $request->vehicle_name[$i];
                $line_purchase->vehicle_no = $request->vehicle_no[$i];
                $line_purchase->quantity = $request->quantity[$i];
                $line_purchase->unit_price = $request->unit_price[$i];
                $line_purchase->total = $request->total[$i];
                $purchase_success = $line_purchase->save();
                if( $purchase_success){
                    $product = ProductItem::findOrFail($request->product_item_id[$i]);
                    $product->stock = $product->stock + $request->quantity[$i];
                    $product->cost_price = $request->unit_price[$i];
                    $product->stock_date =$request->transactions_date;
                    $product->save();
                }
           }
        }

        if($request->paid > 0){
            $transaction_pay = new TransactionPayment;
            $transaction_pay->transaction_id = $success->id;
            $transaction_pay->pay_method = $request->pay_method;
            $transaction_pay->amount = $request->paid;
            $transaction_pay->pay_date = $request->transactions_date;
            $transaction_pay->save(); 
        }

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Product Purchase Successfuly'), 'goto' => route('admin.purchase.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $model = Transaction::findOrFail($id);
        return view('admin.purchase.show',compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $model = Transaction::findOrFail($id);
        $models = ProductItem::all();
        $user_id = Auth::user()->id;
        $company = CompanyInfo::all();
        $employee = Employess::all();
        $pay_method = PayMethod::all();
        return view('admin.purchase.edit',compact('model','models','user_id','company','employee','pay_method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $model = Transaction::findOrFail($id);
        $validatedData = $request->validate([
            'company_info_id'=>'required|max:255',
            'employess_id'=>'required',
            'customer_id'=>'',
            'user_id'=>'required',
            'transaction_status'=>'required|max:255',
            'transactions_date'=>'required|max:255',
            'pay_type'=>'required|max:255',
            'invoice_no'=>['required', Rule::unique('transactions')->ignore($model->id)],
            'sub_total'=>'required|max:255',
            'discount_type'=>'max:255',
            'discount_amount'=>'max:255',
            'discount'=>'max:255',
            'net_total'=>'required|max:255',
            'pay_method'=>'required|max:255',
            'TrxID'=>[Rule::unique('transactions')->ignore($model->id)],
            'paid'=>'required',
            'due'=>'required|max:255',
            'additional_notes'=>'max:255',
            'status'=>'',
        ]);
    
        if ($request->status) {
            $validatedData['status'] = 1;
        }else{
            $validatedData['status'] = 0;
        }

        if ($request->pay_type == 'paid') {
            if ($request->due != 0) {
               return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Oops, Paid Amount not full pay.'), 'goto' => route('admin.purchase.index')]);
            }
        }

        if($request->paid < 0){
            $validatedData['paid'] = $model->paid + $request->paid;
            $validatedData['due'] = 0;
        }elseif($request->paid > 0){
            $due_pay = $model->paid + $request->paid;
            $validatedData['paid'] = $due_pay;
            $validatedData['due'] = $request->net_total - $due_pay;
        }else{
            $validatedData['paid'] = $model->paid;
        }


        if ($request->invoice_no) {
            $validatedData['invoice_no'] = $request->invoice_no;
        }else{
            $ym = Carbon::now()->format('Y/m');
            $row = Transaction::count() > 0 ? Transaction::count() + 1 : 1;
            $ref_no = $ym.'/P-'.ref($row);
            $validatedData['invoice_no'] = $ref_no;
        }
        $transaction_pay = new TransactionPayment;
        $pay_transaction = TransactionPayment::where('transaction_id',$id)->first();
        if($request->paid < 0 ){
            $transaction_pay->transaction_id = $id;
            $transaction_pay->pay_method = $request->pay_method;
            $transaction_pay->amount = $request->paid;
            $transaction_pay->pay_date = $request->transactions_date;
            $transaction_pay->save();
        }else if($request->paid > 0 ){
            $transaction_pay->transaction_id = $id;
            $transaction_pay->pay_method = $request->pay_method;
            $transaction_pay->amount = $request->paid;
            $transaction_pay->pay_date = $request->transactions_date;
            $transaction_pay->save();
        }
        $success = $model->update($validatedData);
        $purchase = TransactionPurchaseLine::where('transaction_id',$id)->get();
        $product_id = array();
        foreach ($purchase as $key => $value) {
           $product_id[] = $value->product_item_id;
        }
        if ($success) {
            $count = count($product_id);
           for ($i=0; $i < $count; $i++) {
                $product = ProductItem::findOrFail($product_id[$i]);
                $line_purchase = TransactionPurchaseLine::where('product_item_id',$product_id[$i])->where('transaction_id', $id)->first();
                $product->stock = $product->stock - $line_purchase->quantity;
                $minus_product = $product->save();    
           }
           
            $model_success = TransactionPurchaseLine::where('transaction_id',$id)->delete();
            if ($model_success) {
            $count2 = count($request->product_item_id);
           for ($i=0; $i < $count2; $i++) {
                $line_purchase = new TransactionPurchaseLine;
                $line_purchase->transaction_id = $id;
                $line_purchase->product_item_id = $request->product_item_id[$i];
                $line_purchase->vehicle_name = $request->vehicle_name[$i];
                $line_purchase->vehicle_no = $request->vehicle_no[$i];
                $line_purchase->quantity = $request->quantity[$i];
                $line_purchase->unit_price = $request->unit_price[$i];
                $line_purchase->total = $request->total[$i];
                $purchase_success = $line_purchase->save();
                if( $purchase_success){
                    $product = ProductItem::findOrFail($request->product_item_id[$i]);
                    $product->stock = $product->stock + $request->quantity[$i];
                    $product->cost_price = $request->unit_price[$i];
                    $product->stock_date =$request->transactions_date;
                    $product->save();
                }
           }
        }

            return response()->json(['success' => true, 'status' => 'success', 'message' => _lang(' Purchase Product Update Successfuly'), 'goto' => route('admin.purchase.index')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $model = Transaction::findOrFail($id);
        $model->delete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Delete Successfuly'), 'goto' => route('admin.purchase.index')]);
    }

    public function purchaseDue($id, $employe_id=null){
        $pay_method = PayMethod::all();
        $model = Transaction::findOrFail($id);
        return view('admin.purchase.purchase_due',compact('model','pay_method','employe_id'));
    }

    public function purchaseDuePay($id, Request $request){
       $model = Transaction::findOrFail($id);
       $validatedData = $request->validate([
            'paid'=>'required|max:255',
            'due'=>'required',
            'pay_due'=>'required|max:255',
            'pay_date'=>'required|max:255',
            'pay_method'=>'required|max:255',
        ]);
        if ($request->pay_due > $model->due) {
           return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Due Collect must be less than or equal total due.')]);
        }
        if ($request->pay_due < 0) {
           return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Due Collect should be greater than zero(0)')]);
        }
        $model->paid = $request->paid;
        $model->due = $request->due;
        $success = $model->save();
        if ($success) {
            $pay = new TransactionPayment;
            $pay->transaction_id = $id;
            $pay->pay_method = $request->pay_method;
            $pay->amount = $request->pay_due;
            $pay->pay_date = $request->pay_date;
            $pay->save();
            if($request->employe_id){
                return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Due Collect Successfuly'), 'goto' => route('admin.employer.purchase.show', $request->employe_id)]);
            }else{

                return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Due Collect Successfuly'), 'goto' => route('admin.purchase.index')]);
            }
        }

    }

    public function invoice($id){
        $model = Transaction::findOrFail($id);
        return view('admin.purchase.invoice',compact('model'));
    }
}
