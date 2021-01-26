<?php

namespace App\Http\Controllers;

use App\Models\purchases;
use App\Models\Suppliers;
use App\Models\materials;
use App\Models\materialsUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("purchases.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers =Suppliers::where('status', "مفعل")->get();
        $materials = materials::all();
        $dateDay =  date('Y/m/d');
        return view("purchases.create",compact('suppliers','materials','dateDay'));
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
     * @param  \App\Models\purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function show(purchases $purchases)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function edit(purchases $purchases)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, purchases $purchases)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function destroy(purchases $purchases)
    {
        //
    }
    public function getSupplierData($id)
    {
        $suppliers =Suppliers::where('id', $id)->get();
        return json_encode($suppliers);
    }
}