<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use DateTime;
use App\Post;
use App\Employess;
use App\Shifttime;
use App\Attendees;
use App\Transaction;

class EmployeesController extends Controller{
	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       $models = Employess::all();
       return view('admin.employees.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $models = Post::all();
        $shift_time = Shifttime::all();
        return view('admin.employees.create',compact('models','shift_time'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'employe_id_no'=>'required|max:255|unique:employesses',
            'employe_name'=>'required|max:255',
            'employe_number'=>'required|max:255|unique:employesses',
            'alter_number'=>'sometimes|nullable|unique:employesses',
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

        $model = new Employess();
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
           $validatedData['image'] ='photo.jpg';
       }
        $model->create($validatedData);
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('
      Employer Added Successfuly'), 'goto' => route('admin.employees.index')]);
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
        $model =Employess::findOrFail($id);
         $validatedData = $request->validate([
            'employe_id_no'=>['required', Rule::unique('employesses')->ignore($model->id)],
            'employe_name'=>'required|max:255',
            'employe_number'=>['required', Rule::unique('employesses')->ignore($model->id)],
            'alter_number'=>'',
            'employe_email'=>['required', Rule::unique('employesses')->ignore($model->id)],
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
       $model = Employess::findOrFail($id);
        $model->delete();
       return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Employees Delete  Successfuly'), 'goto' => route('admin.employees.index')]);
    }

    public function addAdsence($id){
        $model = Employess::find($id);
        return view('admin.employees.adsence', compact('model'));
    }

    public function insertAdsence(Request $request){

        $id = $request->employe_id;
        $data = Attendees::where('employe_id',$id)->first();
        $start_date = $request->start_date;
        $end_date = $request->end_date;
       
       if($data->present_date >= $start_date && $data->present_date <= $end_date){
          return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Present Already Taken')]);
       } 
       else{
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
         if ($request->status) {
            $validatedData['status'] = 0;
        }
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

    }

    public function list(){
        $models = Attendees::where('status','=','0')->get();
        return view('admin.employees.adsencelist', compact('models'));
	}
	
	public function absenceview($id){
		$model = Attendees::findOrFail($id);
		return view('admin.employees.absenceShow', compact('model'));
	}

	public function absenceedit($id){
		$model =  Attendees::findOrFail($id);
		return view('admin.employees.adsencedit', compact('model'));

	}


	public function absenceupdate(Request $request, $id){
		$validatedData = $request->validate([
		'start_date' => 'required',
		'end_date' => 'required',
		]);

		$model = Attendees::findOrFail($id);
		$model->update($validatedData);
		return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('
			Absence Date Change Successfuly'), 'goto' => route('admin.adsence.list')]);
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

    public function allattendes(){
      $models = Employess::all();
      return view('admin.employees.attendes', compact('models'));
    }

    public function present(Request $request){
      $id = $request->id;
      $data = Employess::with('shift')->find($id);
      return $data;
    }

    public function attendees(Request $request){

        $validatedData = $request->validate([
            'employe_id'=>'required',
            'employe_id_no'=>'required',
            'shift_time'=>'required',
            'present_date'=>'required',
            'status'=>'',
        ]);
      $employee   = Attendees::where('employe_id','=', $request->employe_id)->where('present_date','=',$request->present_date)->first();
       $start_date = '';
       $end_date = '';
      $att = Attendees::where('employe_id', $request->employe_id)->first();
      
      if($att){
        $start_date = $att->start_date;
      }

      $att_end = Attendees::where('employe_id', $request->employe_id)->first(); 
      if ($att_end) {
       $end_date = $att_end->end_date;
      }
      
      if($request->present_date >=$start_date  && $request->present_date <= $end_date){
        return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Employees Absence')]);
    }else if($employee){
      return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Attendees Already Taken')]);
    }else{
      $model = new Attendees();
      $model->create($validatedData);
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Attendees Taken Successfuly')]);
    }
  }

  public function atendenslist(Request $request){
    $to_date   = $request->to_date;
    $form_date = $request->form_date;
	  $models = Attendees::where('present_date','>=', $to_date)->where('present_date','<=', $form_date)->orWhere('start_date','>=',$to_date)->get();
   return view('admin.employees.attendeslist',compact('models'));
  }

    /**
     * Display the employer purchase list.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function purchaseView($id){
    $models = Transaction::with('customer')->where('employess_id',$id)->get();
    return view('admin.employees.purchaseReport',compact('models'));
  }



}
