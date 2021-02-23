<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{

    function __construct()
    {

        $this->middleware('permission:قائمةالموردين', ['only' => ['index']]);
        $this->middleware('permission:اضافةمورد', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل مورد', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف مورد', ['only' => ['softDelete']]);
        $this->middleware('permission:عرض مورد', ['only' => ['show']]);
        $this->middleware('permission:تصديرأكسيل', ['only' => ['export']]);
        $this->middleware('permission:تفعيل/ تعطيل مورد', ['only' => ['activeSupplier','supplierActive','supplierDisable','disableSupplier']]);
        $this->middleware('permission:موردين محذوفين', ['only' => ['trashedSupplier','destroy','backSoftDelete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = suppliers::all();
        return view('suppliers.showSupplier',compact('suppliers'));
    }

    public function trashedSupplier()
    {
        $suppliersTrash = suppliers::onlyTrashed()->get();
        return view('suppliers.trash',compact('suppliersTrash'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.add_supplier');
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
            'supplier_name' => "required|string|min:3|max:255",
            'Beneficiary_name' => "required|string|min:3|max:255",
            'supllier_phone' =>'required|unique:suppliers,supllier_phone|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/',
            'supllier_phoneOther ' => 'nullable|unique:suppliers,supllier_phoneOther|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/',
            'supllier_address1' => "required|string|max:255",
            'Commercial_Record'=> "nullable|string|max:50",
            'Tax_card'=> "nullable|string|max:50",
            'Type_of_supply'=> "required|string|max:100",
            "status" => "required|string",
            'Type_of_pay' => 'required|string',
            'start_balance' => 'required|numeric',

        ],[
            'supplier_name.required' => 'يجب ادخال اسم المورد',
            'supplier_name.min' => 'يجب اسم المورد لايقل عن ثلاث حروف',
            'supplier_name.max' => 'يجب اسم المورد لايزيد عن 255 حرف',
            'Beneficiary_name.required' => 'يجب ادخال اسم المستفيد',
            'Beneficiary_name.min' => 'يجب اسم المستفيد لايقل عن ثلاث حروف',
            'Beneficiary_name.max' => 'يجب اسم المستفيد لايزيد عن 255 حرف',
            'supllier_phone.required' => 'يجب ادخال رقم الهاتف',
            'supllier_phone.unique' => 'هذا الرقم مستخدم بالفعل',
            'supllier_phone.digits' => 'يجب رقم الهاتف لايقل او يزيد عن احدي عشر حرف',
            'supllier_phone.regex' => 'هذا الهاتف غير صحيح',
            'supllier_phoneOther.unique' => 'هذا الرقم مستخدم بالفعل',
            'supllier_phoneOther.digits' => 'يجب رقم الهاتف البديل لايقل او يزيد عن احدي عشر حرف',
            'supllier_phoneOther.regex' => 'هذا الهاتف البديل غير صحيح',
            'supllier_address1.required' => 'يجب ادخال العنوان ',
            'supllier_address1.max' => 'هذا العنوان كبير',
            'Commercial_Record.max' => 'سجل تجاري غير صحيح',
            'Tax_card.integer' => 'بطاقة ضريبية غير صحيح',
            'Tax_card.max' => 'بطاقة ضريبية غير صحيح',
            'Type_of_supply.required' => 'يجب اختيار نوع التوريد',
            'status.required' => 'يجب اختيار الحاله ',
            'Type_of_pay.required' => 'يجب اختيار نوع الدفع ',
            'start_balance.required' => 'يجب ادخال رصيد بداية المدة',
            'start_balance.numeric' =>'يجب ان يكون رصيد بداية المدة ارقاما'
        ]);
        $input = $request->all();
        suppliers::create($input);
        session()->flash('Add', 'تم اضافة المورد بنجاح ');
        return redirect('/suppliers/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $suppliers = suppliers::find($id);
        if(!empty($suppliers)){
            return view('suppliers.showData',compact('suppliers'));
        }else{
            return view('errors.noData');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $suppliers = suppliers::find($id);
        if(!empty($suppliers)){
            return view('suppliers.edit_supplier',compact('suppliers'));
        }else{
            return view('errors.noData');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'supplier_name' => "required|string|min:3|max:255",
            'Beneficiary_name' => "required|string|min:3|max:255",
            'supllier_phone' =>'required|unique:suppliers,supllier_phone,'. $id .'|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/',
            'supllier_phoneOther ' => 'nullable|unique:suppliers,supllier_phoneOther,'.$id.'|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/',
            'supllier_address1' => "required|string|max:255",
            'Commercial_Record'=> "nullable|string|max:50",
            'Tax_card'=> "nullable|string|max:50",
            'Type_of_supply'=> "required|string|max:100",
            "status" => "required|string",
            'Type_of_pay' => 'required|string',
            'start_balance' => 'required|numeric',
        ],[
            'supplier_name.required' => 'يجب ادخال اسم المورد',
            'supplier_name.min' => 'يجب اسم المورد لايقل عن ثلاث حروف',
            'supplier_name.max' => 'يجب اسم المورد لايزيد عن 255 حرف',
            'Beneficiary_name.required' => 'يجب ادخال اسم المستفيد',
            'Beneficiary_name.min' => 'يجب اسم المستفيد لايقل عن ثلاث حروف',
            'Beneficiary_name.max' => 'يجب اسم المستفيد لايزيد عن 255 حرف',
            'supllier_phone.required' => 'يجب ادخال رقم الهاتف',
            'supllier_phone.unique' => 'هذا الرقم مستخدم بالفعل',
            'supllier_phone.digits' => 'يجب رقم الهاتف لايقل او يزيد عن احدي عشر حرف',
            'supllier_phone.regex' => 'هذا الهاتف غير صحيح',
            'supllier_phoneOther.unique' => 'هذا الرقم مستخدم بالفعل',
            'supllier_phoneOther.digits' => 'يجب رقم الهاتف البديل لايقل او يزيد عن احدي عشر حرف',
            'supllier_phoneOther.regex' => 'هذا الهاتف البديل غير صحيح',
            'supllier_address1.required' => 'يجب ادخال العنوان ',
            'supllier_address1.max' => 'هذا العنوان كبير',
            'Commercial_Record.max' => 'سجل تجاري غير صحيح',
            'Tax_card.integer' => 'بطاقة ضريبية غير صحيح',
            'Tax_card.max' => 'بطاقة ضريبية غير صحيح',
            'Type_of_supply.required' => 'يجب اختيار نوع التوريد',
            'status.required' => 'يجب اختيار الحاله ',
            'Type_of_pay.required' => 'يجب اختيار نوع الدفع ',
            'start_balance.required' => 'يجب ادخال رصيد بداية المدة',
            'start_balance.numeric' =>'يجب ان يكون رصيد بداية المدة ارقاما'
        ]);
        $input= $request->all();
        $suppliers = suppliers::find($id);
        $suppliers->update($input);
        session()->flash('edit', 'تم تعديل المورد بنجاح ');
        return redirect('/suppliers/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->supplier_id;
        $suppliers = suppliers::onlyTrashed()->where('id',$id)->forceDelete();
        session()->flash('successDestroy','تم حذف المورد بنجاح');
        return redirect('/suppliers');
    }

    public function softDelete(Request $request)
    {
        $id = $request->supplier_id;
        $suppliers= suppliers::find($id)->delete();
        session()->flash('successSoft','تم حذف المورد بنجاح');
        return redirect('/suppliers');
    }

    public function backSoftDelete($id)
    {

        $suppliers= suppliers::onlyTrashed()->where('id',$id)->first()->restore();
        session()->flash('successBackSoft','تم استرجاع المورد بنجاح');
        return redirect('/suppliers');
    }

    public function activeSupplier(Request $request)
    {
        $suppliers = suppliers::where('status', "مفعل")->get();
        return view('suppliers.supplier_active',compact('suppliers'));
    }
    public function supplierActive(Request $request,$id)
    {
        $suppliers = suppliers::find($id);
        $suppliers->update([
            'status' => 'مفعل',
        ]);
        session()->flash('successActive','تم تفعيل المورد بنجاج');
        return redirect('suppliers/active');
    }
    public function supplierDisable(Request $request)
    {
        $suppliers = suppliers::where('status', "غير مفعل")->get();
        return view('suppliers.supplier_active',compact('suppliers'));
    }

    public function disableSupplier(Request $request,$id)
    {
        $suppliers = suppliers::find($id);
        $suppliers->update([
            'status' => 'غير مفعل',
        ]);
        session()->flash('successNotActive','تم تعطيل المورد بنجاج');
        return redirect('suppliers/notactive');
    }
}
