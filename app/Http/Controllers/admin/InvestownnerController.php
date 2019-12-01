<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Investowner;

class InvestownnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $models = Investowner::all();
       return view('admin.invest_owner.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.invest_owner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $validatedData = $request->validate([
            'owner_name'=>'required|max:255',
            'owner_number'=>'required|max:255',
            'owner_email'=>'',
            'image'=>'',
        ]);

        if ($request->status) {
            $validatedData['status'] = 1;
        }else{
              $validatedData['status'] = 0;
        }

        $model = new Investowner();
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
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Owner Added Successfuly'), 'goto' => route('admin.investowner.index')]);
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
    public function edit($id){
        $model = Investowner::findOrFail($id);
        return view('admin.invest_owner.edit',compact('model'));
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
            'owner_name'=>'required|max:255',
            'owner_number'=>'required|max:255',
            'owner_email'=>'',
            'image'=>'',
        ]);

        if ($request->status) {
            $validatedData['status'] = 1;
        }else{
              $validatedData['status'] = 0;
        }

        $model = Investowner::findOrFail($id);
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
        $model->update($validatedData);
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Owner Update Successfuly'), 'goto' => route('admin.investowner.index')]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Investowner::findOrFail($id);
        $model->delete();
        return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Owner Delete Successfuly'), 'goto' => route('admin.investowner.index')]);
    }
}
