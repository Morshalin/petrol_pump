<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\SalesCustomer;
use App\Customer;
use App\ProductItem;
use App\ProductStock;
use App\ProductSale;
use App\Product;
use App\Calculation;
use Auth;

class SalesCustomerController extends Controller{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       $models = SalesCustomer::all();
       $total = $models->sum('oil_total_price');
       return view('admin.sales_customer.index', compact('models','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $user_id = Auth::user()->id;
        $oil_name = ProductItem::all();
        return view('admin.sales_customer.create',compact('user_id','oil_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $product_id = $request->product_id;
        $total_oil = ProductStock::where('product_item_id','=',$product_id)->first();
        if(($request->oil_sale) > ($total_oil->oil_stack)){
            return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Oil Sales must be less than of oil Stock.')]);
        }else if ($total_oil->oil_stack > 0 ) {
          $validatedData = $request->validate([
            'user_id'=>'',
            'customer_id'=>'',
            'customer_name'=>'required|max:255',
            'customer_number'=>'required|max:255',
            'product_id'=>'required|max:255',
            'vehicle_name'=>'',
            'vehicle_number'=>'',
            'oil_sale'=>'required|max:255',
            'oil_price'=>'required',
            'oil_total_price'=>'required',
            'sale_date'=>'required|max:255',
            'cus_description'=>'',
            'status'=>'',
        ]);

        if ($request->status) {
                $validatedData['status'] = 1;
            }else{
                $validatedData['status'] = 0;
            }

            if($request->oil_total_price){
                $saveing = Calculation::where('income_id','=',1)->first();
                $total_saveing = $saveing->total_income + $request->oil_total_price;
                $saveing->total_income = $total_saveing;
                $balances = $saveing->save();
            }
            $model = new SalesCustomer();
            $oil_sale = $model->create($validatedData);
            if($oil_sale){
                $oil_total_sale = ProductSale::where('product_id','=',$request->product_id)->first();
                if($oil_total_sale){
                    $total_sale = $oil_total_sale->oil_sale + $request->oil_sale;
                    $model = ProductSale::where('product_id','=',$request->product_id)->first();
                    $model->oil_sale = $total_sale;
                    $model->save();
                }else{
                        $validatedData = $request->validate([
                        'product_id'=>'required',
                        'oil_sale'=>'required|max:255',
                        'sale_date'=>'required|max:255'
                    ]);

                    $model = new ProductSale();
                    $model->create($validatedData);
                }
                
                $total_oil = ProductStock::where('product_item_id','=',$product_id)->first();
                $sale = $total_oil->oil_stack - $request->oil_sale;
                $total_oil->oil_stack = $sale;
                $total_oil->save();
                if($total_oil->oil_stack <= 20){
                     return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Oil Sale Successfuly.Small amount of stock oil'), 'tab' => route('admin.salescustomers.invoice')]);
                }else{
                     return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Oil Sale Successfuly'), 'tab' => route('admin.salescustomers.invoice',$oil_sale->id)]);
                }
            }
        }else {
           return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Oil Stack Empry.Please Stock Oil')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $model = SalesCustomer::findOrFail($id);
       return view('admin.sales_customer.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $model = SalesCustomer::findOrFail($id);
        $models = ProductItem::all();
        $customer = Customer::all();
        $user_id = Auth::user()->id;
        return view('admin.sales_customer.edit', compact('model','models','customer','user_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        
          $validatedData = $request->validate([
            'user_id'=>'',
            'customer_id'=>'',
            'customer_name'=>'required|max:255',
            'customer_number'=>'required|max:255',
            'product_id'=>'required|max:255',
            'vehicle_name'=>'',
            'vehicle_number'=>'',
            'oil_sale'=>'required|max:255',
            'oil_price'=>'required',
            'oil_total_price'=>'required',
            'sale_date'=>'required|max:255',
            'cus_description'=>'',
            'status'=>'',
        ]);

       if ($request->status) {
            $validatedData['status'] = 1;
        }else{
              $validatedData['status'] = 0;
        }

        $model =SalesCustomer::findOrFail($id);
        $model->update($validatedData);
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('
       Pay Bile Update Successfuly'), 'goto' => route('admin.salescustomers.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, $id){
        $minus_stock = ProductStock::where('product_item_id','=',$request->slug)->first();
        $model = SalesCustomer::findOrFail($id);
        $total_stock = $minus_stock->oil_stack + $model->oil_sale;
        $minus_stock->oil_stack = $total_stock;
        $result = $minus_stock->save();
        if($result){
            $stock_minus = ProductSale::where('product_id','=',$request->slug)->first();
            $model = SalesCustomer::findOrFail($id);
            $stock_total = $stock_minus->oil_sale - $model->oil_sale;
            $stock_minus->oil_sale = $stock_total;
            $resul2 = $stock_minus->save();
            if($resul2){
                $models = SalesCustomer::findOrFail($id);
                $saveing = Calculation::where('income_id','=',1)->first();
                $total_saveing = $saveing->total_income - $models->oil_total_price;
                $saveing->total_income = $total_saveing;
                $balances = $saveing->save();
                if($balances){
                    $models->delete();
                    return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Order Delete Successfuly'), 'goto' => route('admin.salescustomers.index')]);
                }
                
            }
        }
    }

    public function ourcustomer(){
       $model = Customer::all();
      //dd($model);
      /*  foreach ($model as $data) {
            $all = $data->customer_name;  
       }
       dd($all); */
       $option = '';
       $option .="<option value=''>Select One</option>";
        foreach ($model as $data) {
            $option .="<option value='".$data->id."'>".$data->customer_name."</option>";
       }
       return $option;
    }

    public function customertype(Request $request){
        $id = $request->customer_id;
        $model = Customer::findOrFail($id);
         return response()->json(["model"=>$model]);
        
    }


    public function invoice($id){
        $cus_info = SalesCustomer::findOrFail($id);
        $mytime = Carbon::now();
        $date_time = $mytime->toDateTimeString();
        $time_date = explode(" ",$date_time);
        $date = $time_date[0];
        $time = $time_date[1];
        return view('admin.sales_customer.invoice', compact('cus_info','date','time'));
    }

     public function productreport(){
        return view('admin.sales_customer.sale_product_report');
    }

    public function salereport(Request $request){
        $to_date   = $request->to_date;
        $form_date = $request->form_date;
	    $models = SalesCustomer::where('sale_date','>=', $to_date)->where('sale_date','<=', $form_date)->get();
        return view('admin.sales_customer.sales_report',compact('models'));
    }

}
