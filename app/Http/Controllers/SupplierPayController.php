<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use App\Models\supplierPay;
use Facade\FlareClient\Http\Response;
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
        $suppliers =Suppliers::where('status', "مفعل")->get(['id','supplier_name']);
        $payReicept =supplierPay::where("pay_taype","0")->get();
        $RecipetSum =supplierPay::where("pay_taype","0")->sum('value');
        $RecipetCount = $payReicept->count();
        $payCheck =supplierPay::where("pay_taype","1")->get();
        $checkSum =supplierPay::where("pay_taype","1")->sum('value');
        $checkCount = $payCheck->count();
        return view('supplier_pay.index',compact("payReicept",'RecipetCount','RecipetSum','payCheck','checkSum','checkCount','suppliers'));
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
        if($request->type_pay == 1){
            $this->validate($request, [
                'supplier_id' => "required|integer|exists:Suppliers,id",
                'value_recipet' => "required|integer",
                'number_recipet' =>'nullable|integer|unique:supplier_pays,number_recipet',
                'note'=> "nullable|String|max:255",
                "document" => "nullable|mimes:pdf|max:10000"

            ],[
                'supplier_id.required' => 'يجب اختيار اسم المورد',
                'supplier_id.exists' => 'هذا المورد غير موجود',
                'value_recipet.required' => 'يجب أدخال قيمة السداد',
                'value_recipet.integer' => 'يجب ان تكون قيمة السداد رقما',
                'number_recipet.integer' => 'يجب ان يكون رقم الايصال رقما',
                'number_recipet.unique' => 'رقم ايصال السداد  موجود بالفعل',
                'document.mimes' => 'يجب ان يكون الملف PDF ',
            ]);
            if(!empty($request->document)){
                $uniqueFileName = uniqid() . '.' . $request->document->getClientOriginalExtension();
                $request->document->move(public_path('images/supllierPay'),$uniqueFileName);
            }else{
                $uniqueFileName = null;
            }
            supplierPay::create([
                'date_pay'=>date("Y-m-d"),
                'supplier_id'=>$request->supplier_id,
                "value"=>$request->value_recipet,
                'number_recipet'=> $request->number_recipet,
                'note'=> $request->note,
                'document' => $uniqueFileName,
                'pay_taype'=>"0"
            ]);
            session()->flash('AddReicpet', 'تم اضافة المستخدم بنجاح ');
            return redirect()->back();
        }else if($request->type_pay == 0){
            $this->validate($request, [
                'supplier_id' => "required|integer|exists:Suppliers,id",
                'value_check' => "required|integer",
                'number_check' => 'required|integer|unique:supplier_pays,number_check',
                'date_check' => "required|date",
                'note'=> "nullable|String|max:255",
                "document" => "required|mimes:pdf|max:10000"

            ],[
                'supplier_id.required' => 'يجب اختيار اسم المورد',
                'supplier_id.exists' => 'هذا المورد غير موجود',
                'value_check.required' => 'يجب أدخال قيمة السداد',
                'value_check.integer' => 'يجب ان تكون قيمة السداد رقما',
                'number_check.required' => 'يجب أدخال رقم الشيك',
                'number_check.integer' => 'يجب ان يكون رقم الشيك رقما',
                'number_check.unique' => 'رقم شيك السداد  موجود بالفعل',
                'date_check.required' => 'يجب أدخال تاريخ الشيك',
                'date_check.date' => 'يجب ان يكون تاريخ الشيك بصيغة التاريخ',
                'document.required' => 'يجب أرفاق صور الشيك وجميع مرفقاته',
                'document.mimes' => 'يجب ان يكون الملف PDF ',
            ]);
            if(!empty($request->document)){
                $uniqueFileName = uniqid() . '.' . $request->document->getClientOriginalExtension();
                $request->document->move(public_path('images/supllierPay'),$uniqueFileName);
            }else{
                $uniqueFileName = null;
            }
            supplierPay::create([
                'date_pay'=>date("Y-m-d"),
                'supplier_id'=>$request->supplier_id,
                "value"=>$request->value_check,
                'number_check'=> $request->number_check,
                'date_check'=> $request->date_check,
                'note'=> $request->note,
                'document' => $uniqueFileName,
                'pay_taype'=>"1"
            ]);
            session()->flash('AddCheck', 'تم اضافة المستخدم بنجاح ');
            return redirect()->back();
        }else{
            session()->flash('erorr', 'تم اضافة المستخدم بنجاح ');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\supplierPay  $supplierPay
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\supplierPay  $supplierPay
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payData = supplierPay::find($id);
        return view('supplier_pay.edit',compact('payData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\supplierPay  $supplierPay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if($request->type_pay == 1){
            $this->validate($request, [
                'supplier_id' => "required|integer|exists:Suppliers,id",
                'value_recipet' => "required|integer",
                'number_recipet' =>'nullable|integer|unique:supplier_pays,number_recipet,'. $id,
                'note'=> "nullable|String|max:255",
                "document" => "nullable|mimes:pdf|max:10000"

            ],[
                'supplier_id.required' => 'يجب اختيار اسم المورد',
                'supplier_id.exists' => 'هذا المورد غير موجود',
                'value_recipet.required' => 'يجب أدخال قيمة السداد',
                'value_recipet.integer' => 'يجب ان تكون قيمة السداد رقما',
                'number_recipet.integer' => 'يجب ان يكون رقم الايصال رقما',
                'number_recipet.unique' => 'رقم ايصال السداد  موجود بالفعل',
                'document.mimes' => 'يجب ان يكون الملف PDF ',
            ]);
            $payid = supplierPay::find($id);
            if(!empty($request->document)){
                $path = public_path().'/images/users/';
                $file_old = $path.$payid->document;
                unlink($file_old);
                $uniqueFileName = uniqid() . '.' . $request->document->getClientOriginalExtension();
                $request->document->move(public_path('images/supllierPay'),$uniqueFileName);
            }else{
                $uniqueFileName = $payid->document;
            }
            $payid->update([
                "value"=>$request->value_recipet,
                'number_recipet'=> $request->number_recipet,
                'note'=> $request->note,
                'document' => $uniqueFileName,
            ]);
            session()->flash('editReicpet', 'تم اضافة المستخدم بنجاح ');
            return redirect()->back();
        }else if($request->type_pay == 0){
            $this->validate($request, [
                'supplier_id' => "required|integer|exists:Suppliers,id",
                'value_check' => "required|integer",
                'number_check' => 'required|integer|unique:supplier_pays,number_check',
                'date_check' => "required|date",
                'note'=> "nullable|String|max:255",
                "document" => "required|mimes:pdf|max:10000"

            ],[
                'supplier_id.required' => 'يجب اختيار اسم المورد',
                'supplier_id.exists' => 'هذا المورد غير موجود',
                'value_check.required' => 'يجب أدخال قيمة السداد',
                'value_check.integer' => 'يجب ان تكون قيمة السداد رقما',
                'number_check.required' => 'يجب أدخال رقم الشيك',
                'number_check.integer' => 'يجب ان يكون رقم الشيك رقما',
                'number_check.unique' => 'رقم شيك السداد  موجود بالفعل',
                'date_check.required' => 'يجب أدخال تاريخ الشيك',
                'date_check.date' => 'يجب ان يكون تاريخ الشيك بصيغة التاريخ',
                'document.required' => 'يجب أرفاق صور الشيك وجميع مرفقاته',
                'document.mimes' => 'يجب ان يكون الملف PDF ',
            ]);
            if(!empty($request->document)){
                $uniqueFileName = uniqid() . '.' . $request->document->getClientOriginalExtension();
                $request->document->move(public_path('images/supllierPay'),$uniqueFileName);
            }else{
                $uniqueFileName = null;
            }
            supplierPay::create([
                'date_pay'=>date("Y-m-d"),
                'supplier_id'=>$request->supplier_id,
                "value"=>$request->value_check,
                'number_check'=> $request->number_check,
                'date_check'=> $request->date_check,
                'note'=> $request->note,
                'document' => $uniqueFileName,
                'pay_taype'=>"1"
            ]);
            session()->flash('AddCheck', 'تم اضافة المستخدم بنجاح ');
            return redirect()->back();
        }else{
            session()->flash('erorr', 'تم اضافة المستخدم بنجاح ');
            return redirect()->back();
        }
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
    public function getDownload($id)
    {
        $payfile = supplierPay::where('id',$id)->get('document');
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "\images\supllierPay/" . $payfile[0]->document;

        $headers = array(
                'Content-Type: application/pdf',
                );

        return response()->download($file,'Pay Document.pdf', $headers);

    }

}