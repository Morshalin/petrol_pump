<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\ProductItem;
use App\TransactionPurchaseLine;
use App\TransactionSaleLine;

class ProductItemController extends Controller{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       $models =ProductItem::all();
       return view('admin.items.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){        
        $validatedData = $request->validate([
            'product_name'=>'required|unique:product_items|max:255',
            'opening_qty'=>'required|max:255',
            'stock'=>'required|max:255',
            'cost_price'=>'required|max:255',
            'sale_price'=>'required|max:255',
            'stock_date'=>'required|max:255',
            'status'=>'',
        ]);

        $validatedData['status'] = $request->status? 1 : 0;

        $model = new ProductItem();
        $success = $model->create($validatedData);
        if ($success) {
            $obj =  new TransactionPurchaseLine;
            $obj->product_item_id = $success->id;
            $obj->quantity = $request->opening_qty;
            $obj->unit_price = $request->cost_price;
            $obj->total = $request->opening_qty * $request->cost_price;
            $obj->save();
            return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Items Added Successfuly'), 'goto' => route('admin.items.index')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $model = ProductItem::findOrFail($id);
        return view('admin.items.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //dd($request->all());
         $model = ProductItem::findOrFail($id);
        $validatedData = $request->validate([
            'product_name'=>['required',Rule::unique('product_items')->ignore($model->id)],
            'opening_qty'=>'max:255',
            'stock'=>'max:255',
            'cost_price'=>'required|max:255',
            'sale_price'=>'required|max:255',
            'stock_date'=>'required|max:255',
            'status'=>'',
        ]);

        $validatedData['status'] = $request->status? 1 : 0;

        $success = $model->update($validatedData);
        if ($success) {
            $obj =  TransactionPurchaseLine::where('product_item_id',$id)->first();
            $obj->quantity = $request->opening_qty;
            $obj->unit_price = $request->cost_price;
            $obj->total = $request->opening_qty * $request->cost_price;
            $obj->save();
            return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Items update Successfuly'), 'goto' => route('admin.items.index')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
       $model = ProductItem::findOrFail($id);
        $model->delete();
       return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Items Delete  Successfuly'), 'goto' => route('admin.items.index')]);
    }

    public function puchaseReport($id){
        $models = TransactionPurchaseLine::where('product_item_id',$id)->get();
        return view('admin.items.purchaseReport', compact('models'));
    }

    public function saleReport($id){
        $models = TransactionSaleLine::where('product_item_id',$id)->get();
        return view('admin.items.saleReport', compact('models'));
    }
}
