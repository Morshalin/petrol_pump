<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Salarypayment;
use App\SalaryPay;

class SalaryReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.salaryreport.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function repostlist(Request $request){
        if($request->salary_report == 'advance'){
            $to_date   = $request->to_date;
            $form_date = $request->form_date;
            $models = Salarypayment::where('advance_date','>=', $to_date)->where('advance_date','<=', $form_date)->get();
            return view('admin.salaryreport.advancelist',compact('models'));
        }elseif ($request->salary_report = 'salary') {
            $to_date   = $request->to_date;
            $form_date = $request->form_date;
            $models = SalaryPay::where('salary_pay_month','>=', $to_date)->where('salary_pay_month','<=', $form_date)->get();
            return view('admin.salaryreport.salary',compact('models'));
        }
        
  }

}
