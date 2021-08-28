<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\CompanyInfo;

class CompanyInfoController extends Controller{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       $models = CompanyInfo::all();
       return view('admin.companyinfo.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.companyinfo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'company_name'=>'required|unique:company_infos|max:255',
            'number'=>'max:255|nullable|sometimes|unique:company_infos',
            'email'=>'max:255|nullable|sometimes|unique:company_infos',
            'city'=>'max:255',
            'address'=>'max:255',
        ]);
 
        $validatedData['status'] = 1;
        $model = new CompanyInfo();
        $model->create($validatedData);
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Company Information Added  Successfuly'), 'goto' => route('admin.companyinfo.index')]);
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
        $model = CompanyInfo::findOrFail($id);
        return view('admin.companyinfo.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $model = CompanyInfo::findOrFail($id);
        $validatedData = $request->validate([
            'company_name'=>['required','max:255',Rule::unique('company_infos')->ignore($model->id)],
            'number'=> ['nullable','max:255',Rule::unique('company_infos')->ignore($model->id)],
            'email' => ['nullable','max:255',Rule::unique('company_infos')->ignore($model->id)],
            'city'=>'max:255',
            'address'=>'max:255',
        ]);
 
        $validatedData['status'] = 1;
        $model->update($validatedData);
      return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Company Information update Successfuly'), 'goto' => route('admin.companyinfo.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
       $model = CompanyInfo::findOrFail($id);
        $model->delete();
       return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Company Delete  Successfuly'), 'goto' => route('admin.companyinfo.index')]);
    }
}
