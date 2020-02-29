<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BankAccount;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $models = BankAccount::all();
        return view('admin.bankaccount.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.bankaccount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $validatedData = $request->validate([
            'acc_name'=>'required|max:255',
            'acc_no'=>'required|max:255',
            'contact_persion'=>'required|max:255',
            'opening_balance'=>'required|max:255',
            'note'=>'',
        ]);

        if ($request->status) {
            $validatedData['status'] = 1;
        }else{
            $validatedData['status'] = 0;
        }

        $model = new BankAccount;
        $model->create($validatedData);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Bank Account Added Successfuly'), 'goto' => route('admin.bankaccount.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = BankAccount::findOrFail($id);
       return view('admin.bankaccount.show',compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
         $model = BankAccount::findOrFail($id);
         return view('admin.bankaccount.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
         $model =  BankAccount::findOrFail($id);
        $validatedData = $request->validate([
            'acc_name'=>'required|max:255',
            'acc_no'=>'required|max:255',
            'contact_persion'=>'required|max:255',
            'opening_balance'=>'required|max:255',
            'note'=>'',
        ]);

        if ($request->status) {
            $validatedData['status'] = 1;
        }else{
            $validatedData['status'] = 0;
        }
        $model->update($validatedData);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Bank Account Update Successfuly'), 'goto' => route('admin.bankaccount.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $model = BankAccount::findOrFail($id);
        $model->delete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Bank Account Delete Successfuly'), 'goto' => route('admin.bankaccount.index')]);
    }
}
