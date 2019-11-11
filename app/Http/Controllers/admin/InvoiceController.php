<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Invoice;
use App\Customer;


class InvoiceController extends Controller{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       $models =Invoice::all();
       $cus_name = Customer::all();
       return view('admin.invoice.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $cus_name = Customer::all();
        return view('admin.Invoice.create', compact('cus_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request){
        $validatedData = $request->validate([
            'customer_name'=>'required|max:255',
            'customer_number'=>'required|max:255',
            'alter_number'=>'',
            'customer_email'=>'',
            'vehicle_number'=>'required',
            'image'=>'',
            'customer_address'=>'',
            'status'=>'',

        ]);

        $model = new Customer();
        $image =$request->file('image');
        $slug = str_slug($request->name);
        if (isset($image)) {
         $curentdatetime = Carbon::now()->toDateString();
         $validatedData['image'] = $slug.'_'.$curentdatetime.'_'.uniqid().'.'.$image->getClientOriginalExtension();
          if(!file_exists('uploads/customers')){
               mkdir('uploads/customers',0777,true);
          }
          $image->move('uploads/customers',$validatedData['image']);
       }else{
           $validatedData['image'] ='photo.jpg';
       }
        $model->create($validatedData);
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Customer Information Added Successfuly'), 'goto' => route('admin.customer.index')]);
    }*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /* public function show($id){
        $model = Customer::find($id);
       return view('admin.Invoice.show', compact('model'));
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function edit($id){
        $model = Customer::findOrFail($id);
        return view('admin.Invoice.edit', compact('model'));
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function update(Request $request, $id){
        
   $validatedData = $request->validate([
            'customer_name'=>'required|max:255',
            'customer_number'=>'required|max:255',
            'alter_number'=>'',
            'customer_email'=>'',
            'vehicle_number'=>'required',
            'image'=>'',
            'customer_address'=>'',
            'status'=>'',

        ]);

        $model = Customer::findOrFail($id);
        $image =$request->file('image');
        $slug = str_slug($request->name);
        if (isset($image)) {
         $curentdatetime = Carbon::now()->toDateString();
         $validatedData['image'] = $slug.'_'.$curentdatetime.'_'.uniqid().'.'.$image->getClientOriginalExtension();
          if(!file_exists('uploads/customers')){
               mkdir('uploads/customers',0777,true);
          }
          $image->move('uploads/customers',$validatedData['image']);
       }else{
           $validatedData['image'] = $model->image;
       }
        $model->update($validatedData);
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Customer Information Successfuly'), 'goto' => route('admin.Invoice.index')]);
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /* public function destroy($id){
       $model = Customer::findOrFail($id);
        $model->delete();
       return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Customer Delete  Successfuly'), 'goto' => route('admin.Invoice.index')]);
    }*/
}
