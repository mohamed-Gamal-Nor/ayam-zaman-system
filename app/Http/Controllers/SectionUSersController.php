<?php

namespace App\Http\Controllers;

use App\Models\sectionUSers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class SectionUSersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectionsUsers = sectionUSers::all();
        return view("sectionUsers.sectionUsers",compact('sectionsUsers'));
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
            'section_name' => 'required|unique:sections|max:255',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',

        ]);

        sectionUSers::create([
            'section_name' => $request->section_name,
            'descriprion' => $request->descriprion,
            'created_by' => (Auth::user()->user_lname ),

        ]);
        session()->flash('Add', 'تم اضافة القسم بنجاح ');
        return redirect('/sectionUsers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sectionUSers  $sectionUSers
     * @return \Illuminate\Http\Response
     */
    public function show(sectionUSers $sectionUSers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sectionUSers  $sectionUSers
     * @return \Illuminate\Http\Response
     */
    public function edit(sectionUSers $sectionUSers)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sectionUSers  $sectionUSers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $validatedData = $request->validate([
            'section_name' => 'required|unique:sections,section_name,'.$id.'|max:255',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',

        ]);
        $sectionUSers = sectionUSers::find($id);
        $sectionUSers->update([
            'section_name'=>$request->section_name,
            'descriprion'=>$request->descriprion
        ]);
        session()->flash('Edit', 'تم تعديل القسم بنجاح ');
        return redirect('/sectionUsers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sectionUSers  $sectionUSers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->id;
        sectionUSers::find($id)->delete();
        session()->flash('delete', 'تم حذف القسم بنجاح ');
        return redirect('/sectionUsers');
    }
}
