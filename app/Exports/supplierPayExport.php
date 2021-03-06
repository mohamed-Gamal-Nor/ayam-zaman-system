<?php

namespace App\Exports;

use App\Models\invoices;
use App\Models\invoicesReturns;
use App\Models\Suppliers;
use App\Models\supplierPay;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class supplierPayExport implements FromView,WithDrawings
{
    protected $id,$start,$end;
    public function __construct($id,$start,$end)
    {
        $this->id = $id;
        $this->start = $start;
        $this->end = $end;
    }
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/assets/img/brand/ayamzaman.png'));
        $drawing->setHeight(150);
        $drawing->setWidth(150);
        $drawing->setCoordinates('A1');

        return $drawing;
    }
    public function view(): View
    {

        $data_start = date_create($this->start);
        $date_start_format = date_format($data_start,"Y-m-d");
        if($this->start == null){
            $date_start_format = "2020-01-01";
        }
        $data_end = date_create($this->end);
        $date_end_format = date_format($data_end,"Y-m-d");
        $dateModify = date_create($this->start)->modify('-1 days');
        
        // get data for user show and send it by ajax request
        $invoices = invoices::whereBetween('invoice_Date',[$date_start_format,$date_end_format])->where('supplier_id',$this->id)->get()->toArray();
        $invoicesSum = invoices::whereBetween('invoice_Date',[$date_start_format,$date_end_format])->where('supplier_id',$this->id)->sum('total');
        $invoicesReturns = invoicesReturns::whereBetween('invoice_Date',[$date_start_format,$date_end_format])->where('supplier_id',$this->id)->get()->toArray();
        $invoicesReturnsSum = invoicesReturns::whereBetween('invoice_Date',[$date_start_format,$date_end_format])->where('supplier_id',$this->id)->sum('total');
        $supllierPays = supplierPay::whereBetween('date_pay',[$date_start_format,$date_end_format])->where('supplier_id',$this->id)->get()->toArray();
        $supllierPaysSum = supplierPay::whereBetween('date_pay',[$date_start_format,$date_end_format])->where('supplier_id',$this->id)->sum('value');
        $results = array_merge($invoices, $invoicesReturns,$supllierPays);
        usort($results, function($a,$b) {
            return $a['created_at'] > $b['created_at'];
        });
        return view('suppliers.accountStatement_excel', [
            'start'=>$date_start_format,
            'end'=>$date_end_format,
            'supplierName'=> Suppliers::where('id', $this->id)->pluck('supplier_name'),
            'supplierBalance' =>Suppliers::where('id', $this->id)->pluck('start_balance'),
            'sumInvoicesBalance' => invoices::whereBetween('invoice_Date',["1990-01-01",$dateModify])->where('supplier_id',$this->id)->sum('total'),
            'sumInvoicesReturnsBalance' => invoicesReturns::whereBetween('invoice_Date',['1990-01-01',$dateModify])->where('supplier_id',$this->id)->sum('total'),
            'sumPayBalance' => supplierPay::whereBetween('date_pay',['1990-01-01',$dateModify])->where('supplier_id',$this->id)->sum('value'),
            'invoicesSum'=>$invoicesSum,
            'invoicesReturnsSum'=>$invoicesReturnsSum,
            'supllierPaysSum'=>$supllierPaysSum,
            'results'=>$results
        ]);
    }

}