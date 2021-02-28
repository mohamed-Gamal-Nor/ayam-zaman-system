<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use App\Models\supplierPay;
use Illuminate\Http\Request;

class SupplierPayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers =Suppliers::where('status', "مفعل")->get(['id','supplier_name']);
        return view('supplier_pay.create',compact("suppliers"));
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
     * @param  \App\Models\supplierPay  $supplierPay
     * @return \Illuminate\Http\Response
     */
    public function show(supplierPay $supplierPay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\supplierPay  $supplierPay
     * @return \Illuminate\Http\Response
     */
    public function edit(supplierPay $supplierPay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\supplierPay  $supplierPay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, supplierPay $supplierPay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\supplierPay  $supplierPay
     * @return \Illuminate\Http\Response
     */
    public function destroy(supplierPay $supplierPay)
    {
        //
    }
}