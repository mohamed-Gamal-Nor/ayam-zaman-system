<?php

namespace App\Http\Controllers;
use App\Models\invoices;
use App\Models\invoicesReturns;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class accountStatement extends Controller
{
    function __construct()
    {

        $this->middleware('permission:كشف حساب مورد', ['only' => ['index','getStatement']]);
    }
    public function index(){

        $suppliers =Suppliers::where('status', "مفعل")->get(['id','supplier_name']);
        return view('suppliers.accountStatement',compact('suppliers'));

    }
    public  function getStatement(Request $request, $id )
    {

        $suppliers = $request->supplier_id;

        $data_start = date_create($request->start);
        $date_start_format = date_format($data_start,"Y-m-d");
        if($request->start == null){
            $date_start_format = "2020-01-01";
        }
        $data_end = date_create($request->end);
        $date_end_format = date_format($data_end,"Y-m-d");

        //get data before this date and calcuate tha balance
        $dateModify = date_create($request->start)->modify('-1 days');
        $supplierBalance =Suppliers::where('id', $suppliers)->pluck('start_balance');
        $sumInvoicesBalance = invoices::whereBetween('invoice_Date',["1990-01-01",$dateModify])->where('supplier_id',$suppliers)->sum('total');
        $sumInvoicesReturnsBalance = invoicesReturns::whereBetween('invoice_Date',['1990-01-01',$dateModify])->where('supplier_id',$suppliers)->sum('total');
        // get data for user show and send it by ajax request
        $supplier =Suppliers::where('id', $suppliers)->get();
        $invoices = invoices::whereBetween('invoice_Date',[$date_start_format,$date_end_format])->where('supplier_id',$suppliers)->get()->toArray();
        $invoicesSum = invoices::whereBetween('invoice_Date',[$date_start_format,$date_end_format])->where('supplier_id',$suppliers)->sum('total');
        $invoicesReturns = invoicesReturns::whereBetween('invoice_Date',[$date_start_format,$date_end_format])->where('supplier_id',$suppliers)->get()->toArray();
        $invoicesReturnsSum = invoicesReturns::whereBetween('invoice_Date',[$date_start_format,$date_end_format])->where('supplier_id',$suppliers)->sum('total');
        $results = array_merge($invoices, $invoicesReturns);
        usort($results, function($a,$b) {
            return $a['created_at'] > $b['created_at'];
        });
        //return json_encode($results);
        return response()->json([
            'statment'=>$results,
            'supplier'=>$supplier,
            'invoicesSum'=>$invoicesSum,
            'invoicesReturns'=>$invoicesReturnsSum,
            'start'=>$date_start_format,
            'end'=>$date_end_format,
            'supplierBalance'=>$supplierBalance[0],
            'sumInvoicesBalance'=>$sumInvoicesBalance,
            'sumInvoicesReturnsBalance'=>$sumInvoicesReturnsBalance,
            ]);

    }
}