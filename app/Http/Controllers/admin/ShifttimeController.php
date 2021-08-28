<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Shifttime;
use App\Employess;

class ShifttimeController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       $models =Shifttime::all();
       return view('admin.shift.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.shift.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'shift_time'=>'required|unique:shifttimes|max:255',
            'status'=>'',

        ]);
        $validatedData['status'] = $request->status? 1 : 0;

        $model = new Shifttime();
        $model->create($validatedData);
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Shift Time  Added Successfuly'), 'goto' => route('admin.shift.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
       $models = Shifttime::with('employess')->where('id',$id)->first();
       //dd($models);
       return view('admin.shift.show',compact('models'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $model = Shifttime::findOrFail($id);
        return view('admin.shift.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $model = Shifttime::findOrFail($id);
        $validatedData = $request->validate([
            'shift_time'=>['required',Rule::unique('shifttimes')->ignore($model->id)],
            'status'=>'',
        ]);
        $validatedData['status'] = $request->status? 1 : 0;
        $model->update($validatedData);
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Shift Time update Successfuly'), 'goto' => route('admin.shift.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
       $model = Shifttime::findOrFail($id);
        $model->delete();
       return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Shift Time Delete  Successfuly'), 'goto' => route('admin.shift.index')]);
    }

     /**
     * Display employert list this shift time.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function employerList($id){
        $models = Shifttime::with('employess')->findOrFail($id);
       return view('admin.shift.employerList',compact('models'));
    }
}
