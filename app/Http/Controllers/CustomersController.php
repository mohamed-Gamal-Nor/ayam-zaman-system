<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use App\Exports\customersExport;
use Maatwebsite\Excel\Facades\Excel;
class CustomersController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:قائمةالعملاء', ['only' => ['index']]);
        $this->middleware('permission:اضافةعميل', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل عميل', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف عميل', ['only' => ['softDelete']]);
        $this->middleware('permission:عملاء محذوفين', ['only' => ['trashedCustomers','destroy','backSoftDelete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $customers = customers::all();
        return view('customers.show_customers',compact('customers'));
    }


    public function trashedCustomers()
    {
        $customersTrash = customers::onlyTrashed()->get();
        return view('customers.trash',compact('customersTrash'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.add_customer');
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
            'customers_name'=> 'required|string|max:255',
            'email' => "nullable|email|unique:customers,email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$/",
            'customers_phone' =>'required|unique:customers,customers_phone|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/',
            'customers_address' => "required|string|max:255",
            "customers_gender" => "required|string",
        ],[
            'customers_name.required' => 'يجب ادخال اسم العمييل',
            'customers_name.max' => 'يجب اسم العميل لايزيد عن 255 حرف',
            'email.email' => 'يجب ان يكون بريدا اليكترونيا',
            'email.unique' => ' هذا البريد الاليكتروني مستخدم بالفعل',
            'email.regex' => 'هذا البريداليكتروني غير صحيح',
            'customers_phone.required' => 'يجب ادخال رقم الهاتف',
            'customers_phone.unique' => 'هذا الرقم مستخدم بالفعل',
            'customers_phone.digits' => 'يجب رقم الهاتف لايقل او يزيد عن احدي عشر حرف',
            'customers_phone.regex' => 'هذا الهاتف غير صحيح',
            'customers_address.required' => 'يجب ادخال العنوان ',
            'customers_address.max' => 'هذا العنوان كبير',
            'customers_gender.required' => 'يجب اختيار النوع ',
        ]);

        $input = $request->all();
        customers::create($input);
        session()->flash('Add', 'تم اضافة العميل بنجاح ');
        return redirect('/customers/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function show(Customers $customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function edit(Customers $customers,$id)
    {
        $customers = customers::find($id);
        if(!empty($customers)){
            return view('customers.edit_customer',compact('customers'));
        }else{
            return view('errors.noData');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customers $customers,$id)
    {
        $this->validate($request,[
            'customers_name'=> 'required|string|max:255',
            'email' => "nullable|email|unique:customers,email,".$id."|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$/",
            'customers_phone' =>'required|unique:customers,customers_phone,'.$id.'|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/',
            'customers_address' => "required|string|max:255",
            "customers_gender" => "required|string",
        ],[
            'customers_name.required' => 'يجب ادخال اسم العمييل',
            'customers_name.max' => 'يجب اسم العميل لايزيد عن 255 حرف',
            'email.email' => 'يجب ان يكون بريدا اليكترونيا',
            'email.unique' => ' هذا البريد الاليكتروني مستخدم بالفعل',
            'email.regex' => 'هذا البريداليكتروني غير صحيح',
            'customers_phone.required' => 'يجب ادخال رقم الهاتف',
            'customers_phone.unique' => 'هذا الرقم مستخدم بالفعل',
            'customers_phone.digits' => 'يجب رقم الهاتف لايقل او يزيد عن احدي عشر حرف',
            'customers_phone.regex' => 'هذا الهاتف غير صحيح',
            'customers_address.required' => 'يجب ادخال العنوان ',
            'customers_address.max' => 'هذا العنوان كبير',
            'customers_gender.required' => 'يجب اختيار النوع ',
        ]);
        $input = $request->all();
        $customers = customers::find($id);
        $customers->update($input);
        session()->flash('Edit', 'تم تعديل العميل بنجاح ');
        return redirect('/customers/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->customer_id;

        $customers= customers::onlyTrashed()->where('id',$id)->forceDelete();
        session()->flash('success','تم حذف العميل بنجاح');
        return redirect('/customers');

    }
    public function softDelete(Request $request)
    {
        $id = $request->customer_id;
        $customers= customers::find($id)->delete();
        session()->flash('success','تم حذف العميل بنجاح');
        return redirect('/customers');
    }

    public function backSoftDelete($id)
    {

        $customers= customers::onlyTrashed()->where('id',$id)->first()->restore();
        session()->flash('success','تم استرجاع العميل بنجاح');
        return redirect('/customers');
    }
    public function export()
    {

        return Excel::download(new customersExport, 'customers.xlsx');
    }
}