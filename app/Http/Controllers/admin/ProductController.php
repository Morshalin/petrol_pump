<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductItem;
use App\CompanyInfo;
use Auth;

class ProductController extends Controller{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       $models = Product::all();
       $total = $models->sum('oil_total_price');
       return view('admin.product.index', compact('models','total'));
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
        return view('admin.product.create',compact('models', 'user_id','company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'product_item_id'=>'',
            'company_id'=>'required|max:255',
            'user_id'=>'',
            'vehicle_name'=>'required|max:255',
            'vehicle_number'=>'required|max:255',
            'oil_stack'=>'required|max:255',
            'oil_price'=>'required',
            'oil_total_price'=>'required',
            'stack_date'=>'required|max:255',
            'oil_description'=>'required',
            'status'=>'',
        ]);

       if ($request->status) {
            $validatedData['status'] = 1;
        }else{
              $validatedData['status'] = 0;
        }

      $model = new Product();
      $model->create($validatedData);
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('
      Product Added Successfuly'), 'goto' => route('admin.product.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $model = Product::findOrFail($id);
       return view('admin.product.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $model = Product::findOrFail($id);
        $models = ProductItem::all();
        $company = CompanyInfo::all();
        $user_id = Auth::user()->id;
        return view('admin.product.edit', compact('model','models','company','user_id'));
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
            'product_item_id'=>'',
            'company_id'=>'required|max:255',
            'user_id'=>'',
            'vehicle_name'=>'required|max:255',
            'vehicle_number'=>'required|max:255',
            'oil_stack'=>'required|max:255',
            'oil_price'=>'required',
            'oil_total_price'=>'required',
            'stack_date'=>'required|max:255',
            'oil_description'=>'required',
            'status'=>'',
        ]);

        if ($request->status) {
            $validatedData['status'] = 1;
        }else{
              $validatedData['status'] = 0;
        }

        $model =Product::findOrFail($id);
        $model->update($validatedData);
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('
      Product Update Successfuly'), 'goto' => route('admin.product.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
       $model = Product::findOrFail($id);
        $model->delete();
       return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Product Delete  Successfuly'), 'goto' => route('admin.product.index')]);
    }




}
