<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ExpenseCategory;
use App\Expense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Expense::all();
        return view('admin.expense.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $models = ExpenseCategory::all();
        return view('admin.expense.create',compact('models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'expense_category_id'=>'required|max:255',
            'amount'=>'required|max:255',
            'reson'=>'max:255',
            'date'=>'required|max:255',
            'note'=>'',
            'status'=>'',
        ]);

        if ($request->status) {
            $validatedData['status'] = 1;
        }else{
              $validatedData['status'] = 0;
        }

        $model = new Expense();
        $model->create($validatedData);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Expense Added Successfuly'), 'goto' => route('admin.expenseall.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $model = Expense::findOrFail($id);
        return view('admin.expense.show',compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $models = ExpenseCategory::all();
        $model = Expense::findOrFail($id);
        return view('admin.expense.edit',compact('models','model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $model = Expense::findOrFail($id);
        $validatedData = $request->validate([
            'expense_category_id'=>'required|max:255',
            'amount'=>'required|max:255',
            'reson'=>'max:255',
            'date'=>'required|max:255',
            'note'=>'',
            'status'=>'',
        ]);

        if ($request->status) {
            $validatedData['status'] = 1;
        }else{
              $validatedData['status'] = 0;
        }
        $model->update($validatedData);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Expense Update Successfuly'), 'goto' => route('admin.expenseall.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Expense::findOrFail($id);
        $model->delete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Expense Delete Successfuly'), 'goto' => route('admin.expenseall.index')]);
    }
}
