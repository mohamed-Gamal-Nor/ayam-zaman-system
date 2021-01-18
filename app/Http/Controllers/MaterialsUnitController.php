<?php

namespace App\Http\Controllers;

use App\Models\materialsUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MaterialsUnitController extends Controller
{
    function __construct()
    {

        $this->middleware('permission:وحدة الخامات', ['only' => ['index']]);
        $this->middleware('permission:اضافة وحدة الخامات', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل وحدة الخامات', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف وحدة الخامات', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MaterialsUnit = materialsUnit::all();
        return view("materials.materials_unit",compact('MaterialsUnit'));
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
            'unit_name' => 'required|unique:materials_units|max:255',
        ],[

            'unit_name.required' =>'يرجي ادخال اسم الوحدة',
            'unit_name.unique' =>'اسم الوحدة مسجل مسبقا',
        ]);

        materialsUnit::create([
            'unit_name' => $request->unit_name,
            'created_by' => (Auth::user()->user_fname . " " .  Auth::user()->user_lname),
        ]);
        session()->flash('Add', 'تم اضافة المخزن بنجاح ');
        return redirect('/materialsUnit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\materialsUnit  $materialsUnit
     * @return \Illuminate\Http\Response
     */
    public function show(materialsUnit $materialsUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\materialsUnit  $materialsUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(materialsUnit $materialsUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\materialsUnit  $materialsUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id = $request->id;
        $validatedData = $request->validate([
            'unit_name' => 'required|unique:materials_units,unit_name,'.$id.'|max:255',
        ],[
            'unit_name.required' =>'يرجي ادخال اسم الوحدة',
            'unit_name.unique' =>'اسم الوحدة مسجل مسبقا',
        ]);

        $materialsUnit = materialsUnit::find($id);
        $materialsUnit->update([
            'unit_name' => $request->unit_name,
        ]);

        session()->flash('edit','تم تعديل المخزن بنجاج');
        return redirect('/materialsUnit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\materialsUnit  $materialsUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        materialsUnit::find($id)->delete();
        session()->flash('delete','تم حذف المخزن بنجاح');
        return redirect('/materialsUnit');


    }
}