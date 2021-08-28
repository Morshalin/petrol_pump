<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Auth;
use App\ProductItem;
use App\Customer;
use App\Transaction;
use App\Employess;
use App\TransactionPayment;
use App\TransactionSaleLine;
use App\PayMethod;
use Carbon\Carbon;

class SaleController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $models = Transaction::with('saleLine')->where('transaction_status','sale')->get();
        return view('admin.sale.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $models = ProductItem::all();
        $user_id = Auth::user()->id;
        $customer = Customer::all();
        $employee = Employess::all();
        $pay_method = PayMethod::all();
        //Auto generate Invoice Number
        $ym = Carbon::now()->format('Y/m');
        $row = Transaction::count() > 0 ? Transaction::count() + 1 : 1;
        $invoice_no = $ym.'/S-'.ref($row);
        
        return view('admin.sale.create',compact('models','user_id','customer','employee','pay_method','invoice_no'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $validatedData = $request->validate([
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
            'TrxID'=>'unique:transactions|max:255',
            'paid'=>'required',
            'due'=>'required|max:255',
            'additional_notes'=>'max:255',
            'status'=>'',
        ]);
    
       $validatedData['status'] = $request->status? 1 : 0;

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
            $ref_no = $ym.'/S-'.ref($row);
            $validatedData['invoice_no'] = $ref_no;
        }
        $success = $model->create($validatedData);

        if ($success) {
            $count = count($request->product_item_id);
           for ($i=0; $i < $count; $i++) { 
                $line_sale = new TransactionSaleLine;
                $line_sale->transaction_id = $success->id;
                $line_sale->product_item_id = $request->product_item_id[$i];
                $line_sale->vehicle_name = $request->vehicle_name[$i];
                $line_sale->vehicle_no = $request->vehicle_no[$i];
                $line_sale->quantity = $request->quantity[$i];
                $line_sale->unit_price = $request->unit_price[$i];
                $line_sale->total = $request->total[$i];
                $sale_success = $line_sale->save();
                $product = ProductItem::findOrFail($request->product_item_id[$i]);
                if($sale_success && $product->stock > $request->quantity[$i]){
                    $product->stock = $product->stock - $request->quantity[$i];
                    $product->sale_price = $request->unit_price[$i];
                    $product->save();
                }else{
                    return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Product sale must be less than total stock')]);
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

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Product Sale Successfuly'), 'goto' => route('admin.sale.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $model = Transaction::findOrFail($id);
        return view('admin.sale.show',compact('model'));
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
        $customer = Customer::all();
        $pay_method = PayMethod::all();
        return view('admin.sale.edit',compact('model','models','user_id','customer','pay_method'));
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
        $model = Transaction::findOrFail($id);
        $validatedData = $request->validate([
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
            $ref_no = $ym.'/S-'.ref($row);
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
        $sale = TransactionSaleLine::where('transaction_id',$id)->get();
        $product_id = array();
        foreach ($sale as $key => $value) {
           $product_id[] = $value->product_item_id;
        }

        if ($success) {
            $count = count($product_id);
           for ($i=0; $i < $count; $i++) {
                $product = ProductItem::findOrFail($product_id[$i]);
                $line_sale = TransactionSaleLine::where('product_item_id',$product_id[$i])->where('transaction_id', $id)->first();
                    $product->stock = $product->stock + $line_sale->quantity;
                    $minus_product = $product->save();
                }
                $model_success = TransactionSaleLine::where('transaction_id',$id)->delete();
                if ($model_success) {
                $count2 = count($request->product_item_id);
               for ($i=0; $i < $count2; $i++) {
                    $line_sale = new TransactionSaleLine;
                    $line_sale->transaction_id = $id;
                    $line_sale->product_item_id = $request->product_item_id[$i];
                    $line_sale->vehicle_name = $request->vehicle_name[$i];
                    $line_sale->vehicle_no = $request->vehicle_no[$i];
                    $line_sale->quantity = $request->quantity[$i];
                    $line_sale->unit_price = $request->unit_price[$i];
                    $line_sale->total = $request->total[$i];
                    $sale_success = $line_sale->save();
                    if( $sale_success){
                        $product = ProductItem::findOrFail($request->product_item_id[$i]);
                        $product->stock = $product->stock - $request->quantity[$i];
                        $product->cost_price = $request->unit_price[$i];
                        $product->stock_date =$request->transactions_date;
                        $product->save();
                    }
               }
            } 
             return response()->json(['success' => true, 'status' => 'success', 'message' => _lang(' Sale Product Update Successfuly'), 'goto' => route('admin.sale.index')]);   
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
         return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Tranaction  Delete Successfuly'), 'goto' => route('admin.sale.index')]);
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
        return view('admin.sale.append',compact('model','quantity','row'));
    }


    public function saleDue($id,$customer_id=null){
        $pay_method = PayMethod::all();
        $model = Transaction::findOrFail($id);
        return view('admin.sale.sale_due',compact('model','pay_method','customer_id'));
    }

    public function saleDuePay($id, Request $request){

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
            if ($request->customer_id) {
                 return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Due Collect Successfuly'), 'goto' => route('admin.customer.saleView',$request->customer_id)]);
            }else{
                return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Due Collect Successfuly'), 'goto' => route('admin.sale.index')]);
            }
        }

    }

    public function invoice($id){
        $model = Transaction::findOrFail($id);
        return view('admin.sale.invoice',compact('model'));
    }

}
