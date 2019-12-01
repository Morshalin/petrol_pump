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
use App\Calculation;

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
        if($request->payment_option =='investment'){
            $data = Calculation::where('invest_id','=',1)->first();
            $result = Salarypayment::where('employesse_id','=',$request->employesse_id)->first();
            $pay_advance_update = $data->total_invest + $result->advance_pay;
            $data->total_invest = $pay_advance_update;
            $success = $data->save();
            if($success){
                $advance = $data->total_invest - $request->advance_pay;
                $data->total_invest = $advance;
                $result = $data->save();
                if($result){
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

                            return response()->json(['success' => true, 'status' => 'Error', 'message' => _lang('Salary Advance Update successfuly'),'goto' => route('admin.salarypayment.index')]);
                        }else{
                            $validatedData = $request->validate([
                                'employesse_id'=>'required|max:255',
                                'employe_id_no'=>'required|max:255',
                                'payment_option'=>'required|max:255',
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
            } 
        }else  if($request->payment_option =='savings'){
           $data = Calculation::where('income_id','=',1)->first();
           $result = Salarypayment::where('employesse_id','=',$request->employesse_id)->first();
            $pay_advance_update = $data->total_income + $result->advance_pay;
            $data->total_income = $pay_advance_update;
            $success = $data->save();
            if($success){
                $advance = $data->total_income - $request->advance_pay;
             $data->total_income = $advance;
             $result = $data->save();
             if($result){
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
                            'payment_option'=>'required|max:255',
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
            }
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

         if($request->payment_option =='investment'){
            $data = Calculation::where('invest_id','=',1)->first();
            $advance = $data->total_invest - $request->payable_salary;
             $data->total_invest = $advance;
             $result = $data->save();
             if($result){
            $check_salary_date = SalaryPay::where('employe_id_no','=',$request->employe_id_no)->where('salary_pay_month','=',$request->salary_pay_month)->first();
                if($check_salary_date){
                return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('This Employer Already Taske Salary')]);
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
        }else if($request->payment_option =='savings'){
            $data = Calculation::where('invest_id','=',1)->first();
            $payable_salary = $data->total_income - $request->payable_salary;
             $data->total_income = $payable_salary;
             $result = $data->save();
             if($result){
            $check_salary_date = SalaryPay::where('employe_id_no','=',$request->employe_id_no)->where('salary_pay_month','=',$request->salary_pay_month)->first();
                if($check_salary_date){
                return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('This Employer Already Taske Salary')]);
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
    }

    public function salarysetups(Request $request){ 
        $employe_id = $request->employer_name;
        $month = $request->paymonth;
        $model = Employess::with('post')->findOrFail($employe_id);
        $advance = Salarypayment::where('employesse_id','=',$employe_id)->where('advance_date','=',$month)->first();
        //dd($advance);
        return response()->json(['model'=>$model, 'advance'=>$advance]);
    }
}
