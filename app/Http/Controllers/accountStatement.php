<?php

namespace App\Http\Controllers;
use App\Models\invoices;
use App\Models\invoicesReturns;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class accountStatement extends Controller
{
    public function index(){
        $suppliers =Suppliers::where('status', "مفعل")->get(['id','supplier_name']);
        return view('suppliers.accountStatement',compact('suppliers'));
    }
    public  function getStatement(Request $request, $id )
    {
        /*
        $suppliers =Suppliers::where('id', $id)->get();
        return json_encode($suppliers);
        */
        $suppliers = $request->supplier_id;
        return json_encode($suppliers);
    }
}