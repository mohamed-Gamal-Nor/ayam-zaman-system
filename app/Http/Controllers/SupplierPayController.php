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
        $this->validate($request, [
            'supplier_id' => "required|integer|exists:Suppliers,id",
            'value' => "required|integer",
            'number_recipet' =>'nullable|integer|unique:supplier_pays,number_recipet',
            'number_check' => 'required|integer|unique:supplier_pays,number_check',
            'date_check' => "required|date",
            'note'=> "nullable|String|max:255",
            'document'=> "nullable|string",

        ],[
            'supplier_id.required' => 'يجب اختيار اسم المورد',
            'supplier_id.exists' => 'هذا المورد غير موجود',
            'value.required' => 'يجب أدخال قيمة السداد',
            'value.integer' => 'يجب ان تكون قيمة السداد رقما',
            'number_recipet.integer' => 'يجب ان يكون رقم الايصال رقما',
            'number_recipet.unique' => 'رقم ايصال السداد  موجود بالفعل',
            'number_check.required' => 'يجب أدخال رقم الشيك',
            'number_check.integer' => 'يجب ان يكون رقم الشيك رقما',
            'number_check.unique' => 'رقم شيك السداد  موجود بالفعل',
            'date_check.required' => 'يجب أدخال تاريخ الشيك',
            'date_check.date' => 'يجب ان يكون تاريخ الشيك بصيغة التاريخ',
        ]);
        session()->flash('Add', 'تم اضافة المستخدم بنجاح ');
        return redirect()->back();
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