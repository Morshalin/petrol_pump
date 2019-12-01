<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Post;
use App\Employess;
use App\Shifttime;
use App\SalarySetup;
use App\Salarypayment;

class SalarySetupController extends Controller{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       $models = SalarySetup::all();
       return view('admin.salarysetup.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $models = Post::all();
        $shift_time = Shifttime::all();
        $employ_info = Employess::all();
        return view('admin.salarysetup.create',compact('models','shift_time','employ_info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'employesse_id'=>'required',
            'employe_id_no'=>'required|max:255|unique:salary_setups',
            'post_name'=>'required|max:255',
            'employe_sallary'=>'required|max:255',
            'status'=>'',
        ]);

        if ($request->status) {
            $validatedData['status'] = 1;
        }else{
              $validatedData['status'] = 0;
        }

    

        $model = new SalarySetup();
        SalarySetup::create($validatedData);
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('
      Salary Setup Successfuly'), 'goto' => route('admin.salarysetup.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $model = Employess::find($id);
       return view('admin.employees.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $model = Employess::findOrFail($id);
        $models = Post::all();
        $shift_times = Shifttime::all();
        return view('admin.employees.edit', compact('model','models','shift_times'));
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
            'employe_id_no'=>'required|max:255|unique:employesses',
            'employe_name'=>'required|max:255',
            'employe_number'=>'required|max:255|unique:employesses',
            'alter_number'=>'',
            'employe_email'=>'sometimes|nullable|unique:employesses',
            'employe_age'=>'required',
            'post_id'=>'required',
            'employe_gender'=>'required',
            'employe_join_date'=>'required',
            'shift_id'=>'',
            'employe_sallary'=>'required',
            'image'=>'',
            'employe_address'=>'',
            'status'=>'',

        ]);

        if ($request->status) {
            $validatedData['status'] = 1;
        }else{
              $validatedData['status'] = 0;
        }

        $model =Employess::findOrFail($id);
        $image =$request->file('image');
        $slug = str_slug($request->employe_name);
        if (isset($image)) {
         $curentdatetime = Carbon::now()->toDateString();
         $validatedData['image'] = $slug.'_'.$curentdatetime.'_'.uniqid().'.'.$image->getClientOriginalExtension();
          if(!file_exists('uploads/employer')){
               mkdir('uploads/employer',0777,true);
          }
          $image->move('uploads/employer',$validatedData['image']);
       }else{
           $validatedData['image'] =  $model->image;
       }

        $model->update($validatedData);
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('
      Employer Update Successfuly'), 'goto' => route('admin.employees.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
       $model = SalarySetup::findOrFail($id);
        $model->delete();
       return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Employees Delete  Successfuly'), 'goto' => route('admin.salarysetup.index')]);
    }

    public function addAdsence($id){
        $model = Employess::find($id);
        return view('admin.employees.adsence', compact('model'));
    }

    public function insertAdsence(Request $request){
        $model = new Attendees();
       $validatedData = $request->validate([
            'employe_id'=>'',
            'employe_id_no'=>'',
            'shift_time'=>'',
            'resion'=>'required|max:255',
            'present_date'=>'',
            'start_date'=>'required',
            'end_date'=>'required',
            'description'=>'',
            'status'=>'',
        ]);
       $model->create($validatedData);

       if($request->employe_id){
          $id =  $request->employe_id; 
          $update = Employess::findOrFail($id);
          $update->status = '0';
          $update->save();
          return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('
      Adsence Added Successfuly'), 'goto' => route('admin.employees.index')]);
       }

    }

    public function list(){
        $models = Attendees::all();
        return view('admin.employees.adsencelist', compact('models'));
    }

    public function delete($id, $cus_id){
      $update = Employess::findOrFail($cus_id);
      $update->status = '1';
      $update->save();

      if ($id) {
       $model = Attendees::findOrFail($id);
        $model->delete();
       return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Absence Delete  Successfuly'), 'goto' => route('admin.employees.index')]);
      }

    }

    public function setup(Request $request){ 
        $employe_id = $request->employer_name;
        $model = Employess::with('post')->findOrFail($employe_id);
        $advance = Salarypayment::where('employesse_id','=',$employe_id)->first();
        return response()->json(['model'=>$model, 'advance'=>$advance]);
    }



}