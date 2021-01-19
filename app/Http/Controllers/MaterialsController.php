<?php

namespace App\Http\Controllers;

use App\Models\materials;
use Illuminate\Http\Request;
use App\Models\materialsUnit;
use Illuminate\Support\Facades\Auth;
class MaterialsController extends Controller
{



    function __construct()
    {

        $this->middleware('permission:قائمة الخامات', ['only' => ['index']]);
        $this->middleware('permission:اضافة خامة', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل خامة', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف خامة', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MaterialsUnit = materialsUnit::all();
        $materials = materials::all();
        return view("materials.index",compact('materials','MaterialsUnit'));
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
        $validatedData = $request->validate([
            'materials_name' => 'required|unique:materials|max:255',
            'unit_id' => 'required|integer|max:255',
        ],[

            'materials_name.required' =>'يرجي ادخال اسم الخامه',
            'materials_name.unique' =>'اسم الخامه مسجل مسبقا',
            'unit_id.required' =>'يرجي اختيار الوحدة',
        ]);

        materials::create([
            'materials_name' => $request->materials_name,
            'unit_id' => $request->unit_id,
            'created_by' => (Auth::user()->user_fname . " " .  Auth::user()->user_lname),
        ]);
        session()->flash('Add', 'تم اضافة المخزن بنجاح ');
        return redirect('/materials');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\materials  $materials
     * @return \Illuminate\Http\Response
     */
    public function show(materials $materials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\materials  $materials
     * @return \Illuminate\Http\Response
     */
    public function edit(materials $materials)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\materials  $materials
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $validatedData = $request->validate([
            'materials_name' => 'required|unique:materials,materials_name,'.$id.'|max:255',
            'unit_id' => 'required|integer|max:255',
        ],[

            'materials_name.required' =>'يرجي ادخال اسم الخامه',
            'materials_name.unique' =>'اسم الخامه مسجل مسبقا',
            'unit_id.required' =>'يرجي اختيار الوحدة',
        ]);
        $materials = materials::find($id);
        $materials->update([
            'materials_name' => $request->materials_name,
            'unit_id' => $request->unit_id,
        ]);

        session()->flash('edit','تم تعديل المخزن بنجاج');
        return redirect('/materials');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\materials  $materials
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        materials::find($id)->delete();
        session()->flash('delete','تم حذف المخزن بنجاح');
        return redirect('/materials');
    }
}