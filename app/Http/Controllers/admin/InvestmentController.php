<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Investment;
use App\Investowner;
use App\Calculation;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $models = Investment::all();
        return view('admin.investment.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $models = Investowner::all();
        return view('admin.investment.create', compact('models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $validatedData = $request->validate([
            'investowner_id'=>'required|max:255',
            'amount'=>'required|max:255',
            'invest_date'=>'required|max:255',
        ]);
        $model = new Investment();
        $data = $model->create($validatedData);
        if($data){
            $invest = Calculation::where('invest_id','=',1)->first();
            if($invest){
                $total_amount = $invest->total_invest + $request->amount;
                $invest->total_invest = $total_amount;
                $invest->save();
            }else{
               $model = new Calculation();
               $model->invest_id = 1;
               $model->income_id = 1;
               $model->total_invest = $request->amount;
               $model->total_income = 0;
               $model->save();
            }
        }
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Investment Successfully'), 'goto' => route('admin.investment.index')]);
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
        $model = Investment::findOrFail($id);
        $models = Investowner::all();
        return view('admin.investment.edit', compact('model','models'));
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
            'investowner_id'=>'required|max:255',
            'amount'=>'required|max:255',
            'invest_date'=>'required|max:255',
        ]);
        $model = Investment::findOrFail($id);
        $data = $model->update($validatedData);
        if($data){
            $invest = Calculation::where('invest_id','=',1)->first();
            if($invest){
                $total_amount = $invest->total_invest - $request->amount;
                $update_amount = $total_amount+$request->amount;
                $invest->total_invest = $update_amount;
                $invest->save();
            }
        }
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Investment Update Successfully'), 'goto' => route('admin.investment.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
         $model = Investment::findOrFail($id);
         if($model){
            $invest = Calculation::where('invest_id','=',1)->first();
            if($invest){
                $total_amount = $invest->total_invest - $model->amount;
                $invest->total_invest = $total_amount;
                $message = $invest->save();
                if($message){
                    $model->delete();
                    return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Investment Delete Successfully'), 'goto' => route('admin.investment.index')]);
                }
            }
        }
        
    }
}
