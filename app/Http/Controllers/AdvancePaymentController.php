<?php

namespace App\Http\Controllers;
use App\Models\employees;
use App\Models\advancePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdvancePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employees = employees::all();
        $advancePayment = advancePayment::all();
        $advancePaymentCount = $advancePayment->count();
        $advancePaymentSum = $advancePayment->sum('ap_value');
        return view('Advance_payment.index',compact('advancePayment','employees','advancePaymentCount','advancePaymentSum'));
    }
    public function search(Request $request)
    {
        $data_start = date_create($request->data_start);
        $date_start_format = date_format($data_start,"Y-m-d");
        $data_end = date_create($request->data_end);
        $date_end_format = date_format($data_end,"Y-m-d");
        $employees_id = $request->employees_id;
        $employees = employees::all();
        if($request->employees_id && $request->data_start =="" && $request->data_end ==""){
            $advancePayment = advancePayment::select('*')->where('employees_id','=',$request->employees_id)->get();
            $advancePaymentCount = $advancePayment->count();
            $advancePaymentSum = $advancePayment->sum('ap_value');
            return view('Advance_payment.index',compact('advancePayment','employees','advancePaymentCount','advancePaymentSum'));
        }else if(empty($request->employees_id) && !empty($request->data_start) && !empty($request->data_end)){
            $advancePayment = advancePayment::whereBetween('ap_date',[$date_start_format,$date_end_format])->get();
            $advancePaymentCount = $advancePayment->count();
            $advancePaymentSum = $advancePayment->sum('ap_value');
            return view('Advance_payment.index',compact('advancePayment','employees','advancePaymentCount','advancePaymentSum'));
        }else{
            $advancePayment = advancePayment::whereBetween('ap_date',[$date_start_format,$date_end_format])->where('employees_id','=',$request->employees_id)->get();
            $advancePaymentCount = $advancePayment->count();
            $advancePaymentSum = $advancePayment->sum('ap_value');
            return view('Advance_payment.index',compact('advancePayment','employees','advancePaymentCount','advancePaymentSum'));

        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = employees::where('stauts', "مفعل")->get();
        return view('Advance_payment.create',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employees_id' => 'required|numeric',
            'ap_value'=>'required|numeric',
        ],[

            'employees_id.required' =>'يرجي ادخال كود ألموظف',
            'employees_id.numeric' =>'كود الموظف ليس صحيحا',
            'ap_value.required' =>'يرجي ادخال قيمة السلفة',
            'ap_value.numeric' =>'يجب ان تكون ارقام',

        ]);
        $input =$request->all();
        $input['ap_date'] = date("Y-m-d");
        $input['created_by']=Auth::user()->user_fname . " " .Auth::user()->user_lname;
        $input['status'] = 0;
        advancePayment::create($input);
        session()->flash('Add', 'تم اضافة السلفة بنجاح ');
        return redirect('/advancePayment/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\advancePayment  $advancePayment
     * @return \Illuminate\Http\Response
     */
    public function show(advancePayment $advancePayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\advancePayment  $advancePayment
     * @return \Illuminate\Http\Response
     */
    public function edit(advancePayment $advancePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\advancePayment  $advancePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->ap_id;
        $validatedData = $request->validate([
            'ap_value'=>'required|numeric',
        ],[
            'ap_value.required' =>'يرجي ادخال قيمة السلفة',
            'ap_value.numeric' =>'يجب ان تكون ارقام',
        ]);

        $advancePayment = advancePayment::find($id);
        $advancePayment->update([
            'ap_value' => $request->ap_value,
        ]);
        session()->flash('edit','تم تعديل السلفة بنجاج');
        return redirect('/advancePayment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\advancePayment  $advancePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->ap_id;
        advancePayment::find($id)->delete();
        session()->flash('delete','تم حذف السلفة بنجاح');
        return redirect('/advancePayment');
    }
}