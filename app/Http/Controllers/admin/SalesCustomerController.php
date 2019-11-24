<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\SalesCustomer;
use App\Customer;
use App\ProductItem;
use App\ProductStock;
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
            return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Oil Sales must be less than of oil Stock.')]);
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
            $model = new SalesCustomer();
            $oil_sale = $model->create($validatedData);
            if($oil_sale){
                $total_oil = ProductStock::where('product_item_id','=',$product_id)->first();
                $sale = $total_oil->oil_stack - $request->oil_sale;
                $total_oil->oil_stack = $sale;
                $total_oil->save();
                if($total_oil->oil_stack <= 20){
                     return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Oil Sale Successfuly.Small amount of stock oil'), 'goto' => route('admin.salescustomers.invoice')]);
                }else{
                     return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Oil Sale Successfuly'), 'goto' => route('admin.salescustomers.invoice',$oil_sale->id)]);
                     //$this->invoice();
                    //  return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Oil Sale Successfuly')]);
                    
                }

            }
        }else {
           return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Oil Stack Empry.Please Stock Oil')]);
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
    /* public function destroy($id){
       $model = SalesCustomer::findOrFail($id);
        $model->delete();
       return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Report Delete  Successfuly'), 'goto' => route('admin.salescustomers.index')]);
    } */

    public function destroy(Request $request, $id){
        //dd($request->slug);
        $minus_stock = ProductStock::where('product_item_id','=',$request->slug)->first();
        $model = SalesCustomer::findOrFail($id);
        $total_stock = $minus_stock->oil_stack + $model->oil_sale;
        $minus_stock->oil_stack = $total_stock;
        $result = $minus_stock->save();
        if($result){
            $models = SalesCustomer::findOrFail($id);
            $models->delete();
            return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Order Delete Successfuly'), 'goto' => route('admin.salescustomers.index')]);
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

}
