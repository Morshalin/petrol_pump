<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Shifttime;

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
            'shift_time'=>'required|max:255',
            'status'=>'',

        ]);

        if ($request->status) {
            $validatedData['status'] = 1;
        }else{
              $validatedData['status'] = 0;
        }

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
        
   $validatedData = $request->validate([
            'shift_time'=>'required|max:255',
            'status'=>'',
        ]);

        if ($request->status) {
            $validatedData['status'] = 1;
        }else{
              $validatedData['status'] = 0;
        }

        $model = Shifttime::findOrFail($id);
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
       return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Shift Time Delete  Successfuly'), 'goto' => route('admin.shift.index')]);
    }
}
