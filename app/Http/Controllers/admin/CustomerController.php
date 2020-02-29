<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Customer;
use App\Transaction;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       $models = Customer::all();
       return view('admin.customer.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'customer_name'=>'required|max:255',
            'customer_number'=>'required|max:255',
            'alter_number'=>'',
            'customer_email'=>'',
            'vehicle_name'=>'required',
            'vehicle_number'=>'required',
            'image'=>'',
            'customer_address'=>'',
            'status'=>'',

        ]);

        if ($request->status) {
            $validatedData['status'] = 1;
        }else{
              $validatedData['status'] = 0;
        }

        $image =$request->file('image');
        $slug = str_slug($request->customer_name);
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
        $model = new Customer();
        $model->create($validatedData);
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Customer Information Added Successfuly'), 'goto' => route('admin.customer.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $model = Customer::find($id);
       return view('admin.customer.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $model = Customer::findOrFail($id);
        return view('admin.customer.edit', compact('model'));
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
            'customer_name'=>'required|max:255',
            'customer_number'=>'required|max:255',
            'alter_number'=>'',
            'customer_email'=>'',
            'vehicle_name'=>'required',
            'vehicle_number'=>'required',
            'image'=>'',
            'customer_address'=>'',
            'status'=>'',

        ]);

        if ($request->status) {
            $validatedData['status'] = 1;
        }else{
              $validatedData['status'] = 0;
        }

        $model = Customer::findOrFail($id);
        $image =$request->file('image');
        $slug = str_slug($request->customer_name);
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
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Customer Information Update Successfuly'), 'goto' => route('admin.customer.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
       $model = Customer::findOrFail($id);
        $model->delete();
       return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Customer All Information Delete  Successfuly'), 'goto' => route('admin.customer.index')]);
    }

    /**
     * Display the Customet  total Sale.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saleView($id){
        $models = Transaction::with('customer')->where('customer_id',$id)->get();
        return view('admin.customer.saleReport', compact('models'));
    }
}
