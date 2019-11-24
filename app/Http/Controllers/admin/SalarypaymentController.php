<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Post;
use App\Employess;
use App\Shifttime;
use App\Salarypayment;
use App\SalaryPay;

class SalarypaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $employ_info = Employess::all();
        return view('admin.salarypayment.index',compact('employ_info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Requsest $request){
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $check_advance_date = Salarypayment::where('employe_id_no','=',$request->employe_id_no)->where('advance_date','=',$request->advance_date)->first();
            if($check_advance_date){
                $validatedData = $request->validate([
                    'employesse_id'=>'required|max:255',
                    'employe_id_no'=>'required|max:255',
                    'post_name'=>'required|max:255',
                    'employe_sallary'=>'required|max:255',
                    'advance_pay'=>'required|max:255',
                    'payable_salary'=>'required|max:255',
                    'advance_date'=>'required|max:255',
                    'pay_date'=>'required|max:255',
                    'advance_resion'=>'',
                    'status'=>'',

                ]);

                if ($request->status) {
                    $validatedData['status'] = 1;
                }else{
                    $validatedData['status'] = 0;
                }
                $check_advance_date->update($validatedData);

                return response()->json(['success' => true, 'status' => 'Error', 'message' => _lang('Salary Advance Update successfuly')]);
            }else{
                $validatedData = $request->validate([
                    'employesse_id'=>'required|max:255',
                    'employe_id_no'=>'required|max:255',
                    'post_name'=>'required|max:255',
                    'employe_sallary'=>'required|max:255',
                    'advance_pay'=>'required|max:255',
                    'payable_salary'=>'required|max:255',
                    'advance_date'=>'required|max:255',
                    'pay_date'=>'required|max:255',
                    'advance_resion'=>'',
                    'status'=>'',

                ]);

                if ($request->status) {
                    $validatedData['status'] = 1;
                }else{
                    $validatedData['status'] = 0;
                }

                $model = new Salarypayment();
                $model->create($validatedData);
            return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Advance Pay Successfuly'), 'goto' => route('admin.salarypayment.index')]);
        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function insert(Request $request){

        $check_salary_date = SalaryPay::where('employe_id_no','=',$request->employe_id_no)->where('salary_pay_month','=',$request->salary_pay_month)->first();
            if($check_salary_date){
               return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('This Employer Already Taske Salary')]);
            }else{
                $validatedData = $request->validate([
                    'employesse_id'=>'required|max:255',
                    'employe_id_no'=>'required|max:255',
                    'post_name'=>'required|max:255',
                    'employe_sallary'=>'required|max:255',
                    'advance_pay'=>'required|max:255',
                    'payable_salary'=>'required|max:255',
                    'salary_pay_month'=>'required|max:255',
                    'pay_date'=>'required|max:255',
                    'status'=>'',

                ]);

                if ($request->status) {
                    $validatedData['status'] = 1;
                }else{
                    $validatedData['status'] = 0;
                }

                $model = new SalaryPay();
                $model->create($validatedData);
            return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Salary Pay Successfuly'), 'goto' => route('admin.salarypayment.index')]);
        }
    }
}
