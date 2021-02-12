<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\Suppliers;
use App\Models\materials;
use App\Models\purchases;
use App\Models\stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\SupplierInvoiceExport;
use App\Exports\SupplierInvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoices::all();
        $invoicesCount = $invoices->count();
        return view("invoices.invoices",compact("invoices","invoicesCount"));
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
        $stores = stores::all();
        $dateDay =  date('Y/m/d');
        return view("invoices.create",compact('suppliers','materials','dateDay','stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "supplier_id"=>"required|integer|exists:Suppliers,id",
            "store_id"=>"required|integer|exists:stores,id",
            "sub_total"=>"required|numeric",
            "discount"=>"nullable|numeric",
            "sub_total_disc"=>"required|numeric",
            "rate_vat"=>"nullable|numeric",
            "value_vat"=>"nullable|numeric",
            "total"=>"required|numeric",
            "note"=>"nullable|string",
            'material_id.*'=>"required|integer|exists:materials,id",
            'price.*'=>"required|numeric",
            'Quantity.*'=>"required|numeric",
            'matarial_total.*'=>"required|numeric",
        ],[
            "supplier_id.required"=>'يجب اختيار المورد',
            "supplier_id.exists"=>"هذا المورد غير موجود",
            "store_id.required"=>'يجب اختيار المخزن',
            "store_id.exists"=>"هذا المخزن غير موجود",
            "sub_total.required"=>"يجب ان يوجد مجموع",
            "sub_total.numeric"=>"يجب ان يكون المجموع رقمي فقط",
            "sub_total_disc.required"=>"يجب ان يوجد مجموع",
            "sub_total_disc.numeric"=>"يجب ان يكون المجموع رقمي فقط",
            "total.required"=>"يجب ان يوجد مجموع",
            "total.numeric"=>"يجب ان يكون المجموع رقمي فقط",
            'material_id.*.required'=>"يجب اختيار الخامات لا يجب ان يكون هناك خامة فاضية",
            'material_id.*.exists'=>"هذة الخامة غير مسجلة علي السيستم",
            'price.*.required'=>"يجب ادخال السعر لا يجب ان يكون هناك سعر فاضي",
            'price.*.numeric'=>"السعر لازم يكون رقم ",
            'Quantity.*.required'=>"يجب ادخال الكمية لا يجب ان يكون هناك كمية فاضية",
            'Quantity.*.numeric'=>"الكمية لازم يكون رقم ",
            'matarial_total.*.required'=>"يجب ان تكون جميع الاجماليات متاحة",
            'matarial_total.*.numeric'=>"الاجماليات لازم يكون رقم ",
        ]);
        $created_by=Auth::user()->user_fname . " " .Auth::user()->user_lname;
        $lastId =invoices::create([
            'invoice_Date'=>date("Y-m-d"),
            'supplier_id'=>$request->supplier_id,
            "store_id"=>$request->store_id,
            'sub_total'=> $request->sub_total,
            'discount'=> $request->discount,
            'sub_total_disc'=>$request->sub_total_disc,
            'rate_vat'=>$request->rate_vat,
            'value_vat'=> $request->value_vat,
            "total"=> $request->total,
            "note"=>$request->note,
            "created_by"=>$created_by
        ])->id;
        if(count($request->material_id) > 0){
            foreach($request->material_id as $mataeial=>$v){
                $data2 = array(
                    'invoice_id'=>$lastId,
                    "material_id"=>$request->material_id[$mataeial],
                    "supplier_id"=>$request->supplier_id,
                    "store_id"=> $request->store_id,
                    'price'=>$request->price[$mataeial],
                    "Quantity"=>$request->Quantity[$mataeial],
                    "matarial_total"=>$request->matarial_total[$mataeial],
                    "purche_data"=>date("Y-m-d")
                );
                purchases::insert($data2);
            }
        }
        session()->flash('Add', 'تم اضافة المستخدم بنجاح ');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = invoices::find($id);

        if(!empty($invoice)){
            return view('invoices.invoice',compact('invoice'));
        }else{
            return view('errors.noData');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $invoice = invoices::find($id);
        if(!empty($invoice)){
            $suppliers =Suppliers::where('status', "مفعل")->get();
            $materials = materials::all();
            $stores = stores::all();
            return view("invoices.edit",compact('suppliers','materials','stores','invoice'));
        }else{
            return view('errors.noData');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            "supplier_id"=>"required|integer|exists:Suppliers,id",
            "store_id"=>"required|integer|exists:stores,id",
            "sub_total"=>"required|numeric",
            "discount"=>"nullable|numeric",
            "sub_total_disc"=>"required|numeric",
            "rate_vat"=>"nullable|numeric",
            "value_vat"=>"nullable|numeric",
            "total"=>"required|numeric",
            "note"=>"nullable|string",
            'material_id.*'=>"required|integer|exists:materials,id",
            'price.*'=>"required|numeric",
            'Quantity.*'=>"required|numeric",
            'matarial_total.*'=>"required|numeric",
        ],[
            "supplier_id.required"=>'يجب اختيار المورد',
            "supplier_id.exists"=>"هذا المورد غير موجود",
            "store_id.required"=>'يجب اختيار المخزن',
            "store_id.exists"=>"هذا المخزن غير موجود",
            "sub_total.required"=>"يجب ان يوجد مجموع",
            "sub_total.numeric"=>"يجب ان يكون المجموع رقمي فقط",
            "sub_total_disc.required"=>"يجب ان يوجد مجموع",
            "sub_total_disc.numeric"=>"يجب ان يكون المجموع بعد الخصم رقمي فقط",
            "total.required"=>"يجب ان يوجد مجموع",
            "total.numeric"=>"يجب ان يكون اجمالي الفاتورة رقمي فقط",
            'material_id.*.required'=>"يجب اختيار الخامات لا يجب ان يكون هناك خامة فاضية",
            'material_id.*.exists'=>"هذة الخامة غير مسجلة علي السيستم",
            'price.*.required'=>"يجب ادخال السعر لا يجب ان يكون هناك سعر فاضي",
            'price.*.numeric'=>"السعر لازم يكون رقم ",
            'Quantity.*.required'=>"يجب ادخال الكمية لا يجب ان يكون هناك كمية فاضية",
            'Quantity.*.numeric'=>"الكمية لازم يكون رقم ",
            'matarial_total.*.required'=>"يجب ان تكون جميع الاجماليات متاحة",
            'matarial_total.*.numeric'=>"الاجماليات لازم يكون رقم ",
        ]);
        $invoice = invoices::find($id);
        $invoice ->update([
            'supplier_id'=>$request->supplier_id,
            "store_id"=>$request->store_id,
            'sub_total'=> $request->sub_total,
            'discount'=> $request->discount,
            'sub_total_disc'=>$request->sub_total_disc,
            'rate_vat'=>$request->rate_vat,
            'value_vat'=> $request->value_vat,
            "total"=> $request->total,
            "note"=>$request->note,
        ]);
        $items = purchases::where('invoice_id',$id)->get();
        
        if(count($request->material_id) > 0){
            foreach($request->material_id as $mataeial=>$v){
                $item_id=$request->id[$mataeial];
                if(!empty($item_id)){
                    $mat = purchases::find($item_id);
                    $data1 = array(
                        "material_id"=>$request->material_id[$mataeial],
                        "supplier_id"=>$request->supplier_id,
                        "store_id"=> $request->store_id,
                        'price'=>$request->price[$mataeial],
                        "Quantity"=>$request->Quantity[$mataeial],
                        "matarial_total"=>$request->matarial_total[$mataeial]
                    );
                    $mat->update($data1);
                }else{
                    $data2 = array(
                        'invoice_id'=>$id,
                        "material_id"=>$request->material_id[$mataeial],
                        "supplier_id"=>$request->supplier_id,
                        "store_id"=> $request->store_id,
                        'price'=>$request->price[$mataeial],
                        "Quantity"=>$request->Quantity[$mataeial],
                        "matarial_total"=>$request->matarial_total[$mataeial],
                        "purche_data"=>date("Y-m-d")
                    );
                    purchases::insert($data2);
                }
            }
        }
        session()->flash('Edit', 'تم اضافة المستخدم بنجاح ');
        return redirect("./invoices/".$id."/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id =  $request->id;
        invoices::find($id)->delete();
        session()->flash('delete','تم حذف السلفة بنجاح');
        return redirect('/invoices');
    }
    public function getSupplierData($id)
    {
        $suppliers =Suppliers::where('id', $id)->get();
        return json_encode($suppliers);
    }
    public function export($id)
    {
        return Excel::download(new SupplierInvoiceExport($id), 'invoices No - '.$id.'.xlsx');

    }
    public function invoicesExport()
    {
        return Excel::download(new SupplierInvoicesExport, 'all invoices.xlsx');

    }
}