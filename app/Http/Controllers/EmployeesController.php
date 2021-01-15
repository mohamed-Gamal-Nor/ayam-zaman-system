<?php

namespace App\Http\Controllers;

use App\Models\employees;
use App\Models\sectionUSers;
use Illuminate\Http\Request;
use App\Exports\employeesExport;
use Maatwebsite\Excel\Facades\Excel;

class EmployeesController extends Controller
{
    function __construct()
    {

        $this->middleware('permission:قائمةالموظفين', ['only' => ['index']]);
        $this->middleware('permission:أضافة موظف', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل موظف', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف موظف', ['only' => ['softDelete']]);
        $this->middleware('permission:عرض موظف', ['only' => ['show']]);
        $this->middleware('permission:تصديرأكسيل', ['only' => ['export']]);
        $this->middleware('permission:موظفين محذوفين', ['only' => ['trashedEmployees','destroy','backSoftDelete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeesActive = employees::where('stauts','مفعل')->get();
        $employeesActiveCount = $employeesActive->count();
        $employeesDisable = employees::where('stauts','غير مفعل')->get();
        $employeesDisableCount = $employeesDisable->count();
        $employees = employees::all();
        return view('employees.show_employees',compact('employees','employeesActiveCount','employeesDisableCount'));
    }


    public function trashedEmployees()
    {
        $employeesTrash = employees::onlyTrashed()->get();
        $employeesCount = $employeesTrash->count();
        return view('employees.trash',compact('employeesTrash','employeesCount'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = sectionUSers::select('section_name','id')->get();
        return view('employees.add_employee',compact('sections'));
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
            'employees_finger'=>'required|integer|min:1',
            'employees_name'=>'required|string|max:255',
            'email' => "nullable|email|unique:employees,email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$/",
            'employees_phone' =>'required|unique:employees,employees_phone|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/',
            'employees_nationalID' => "required|integer|unique:employees,employees_nationalID|digits:14",
            'employees_address' => "required|string|max:255",
            "employees_gender" => "required|string",
            'employees_jopName'=> "required|string|max:255",
            'employees_salary'=> "required|numeric",
            'date_salary'=> "required|string|max:255",
            'employees_birth' => "required|date",
            'employees_work' => "required|date",
            "stauts" => "required|string",
            'section_id' => 'required',
        ],[
            'employees_finger.required'=>'يجب ادخال كود البصمة',
            'employees_finger.integer'=>'يجب ان يكون كود البصمة رقما',
            'employees_finger.min'=>'يجب ان يكون كود البصمة لا يقل عن رقم واحد',
            'employees_name.required' => 'يجب ادخال الاسم الاول',
            'employees_name.string' => 'يجب الاسم الاول لايقل عن ثلاث حروف',
            'employees_name.max' => 'يجب الاسم الاول لايزيد عن خمسةعشر حرف',
            'email.email' => 'يجب ان يكون بريدا اليكترونيا',
            'email.unique' => ' هذا البريد الاليكتروني مستخدم بالفعل',
            'email.regex' => 'هذا البريداليكتروني غير صحيح',
            'employees_phone.required' => 'يجب ادخال رقم الهاتف',
            'employees_phone.unique' => 'هذا الرقم مستخدم بالفعل',
            'employees_phone.digits' => 'يجب رقم الهاتف لايقل او يزيد عن احدي عشر حرف',
            'employees_phone.regex' => 'هذا الهاتف غير صحيح',
            'employees_nationalID.required' => 'يجب ادخال الرقم القومي',
            'employees_nationalID.integer' => 'يجب ان يكون الرقم القومي صحيحا',
            'employees_nationalID.unique' => ' هذا الرقم القومي مستخدم بالفعل',
            'employees_nationalID.digits' => 'يجب الرقم القومي لايقل او يزيد عن اربعة عشر حرف',
            'employees_address.required' => 'يجب ادخال العنوان ',
            'employees_address.max' => 'هذا العنوان كبير',
            'employees_gender.required' => 'يجب اختيار النوع ',
            'employees_jopName.required' => 'يجب ادخال المسمي الوظيفي ',
            'employees_salary.required' => 'يجب ادخال الراتب',
            'date_salary.required' => 'يجب اختيار صرف الراتب ',
            'employees_birth.required' => 'يجب ادخال تاريخ الميلاد ',
            'employees_birth.date' => 'تاريخ الميلاد غير صحيح',
            'employees_work.required' => 'يجب ادخال تاريخ التعيين ',
            'employees_work.date' => 'تاريخ التعيين غير صحيح',
            'stauts.required' => 'يجب اختيار الحالة ',
            'section_id.required' =>'يجب اختيار القسم',
        ]);
        $input = $request->all();
        employees::create($input);
        session()->flash('Add', 'تم اضافة الموظف بنجاح ');
        return redirect('/employees/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(employees $employees,$id)
    {
        $employees = employees::find($id);

        if(!empty($employees)){
            return  view('employees.showData',compact('employees'));
        }else{
            return view('errors.noData');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit(employees $employees,$id)
    {
        $sections = sectionUSers::select('section_name','id')->get();
        $employees = employees::find($id);
        if(!empty($employees)){
            return view('employees.edit_employee',compact('employees','sections'));
        }else{
            return view('errors.noData');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employees $employees,$id)
    {
        $this->validate($request,[
            'employees_finger'=>'required|integer|min:1',
            'employees_name'=>'required|string|max:255',
            'email' => "nullable|email|unique:employees,email,".$id."|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$/",
            'employees_phone' =>'required|unique:employees,employees_phone,'.$id.'|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/',
            'employees_nationalID' => "required|integer|unique:employees,employees_nationalID,".$id."|digits:14",
            'employees_address' => "required|string|max:255",
            "employees_gender" => "required|string",
            'employees_jopName'=> "required|string|max:255",
            'employees_salary'=> "required|numeric",
            'date_salary'=> "required|string|max:255",
            'employees_birth' => "required|date",
            'employees_work' => "required|date",
            "stauts" => "required|string",
            'section_id' => 'required',
        ],[
            'employees_finger.required'=>'يجب ادخال كود البصمة',
            'employees_finger.integer'=>'يجب ان يكون كود البصمة رقما',
            'employees_finger.min'=>'يجب ان يكون كود البصمة لا يقل عن رقم واحد',
            'employees_name.required' => 'يجب ادخال الاسم الاول',
            'employees_name.string' => 'يجب الاسم الاول لايقل عن ثلاث حروف',
            'employees_name.max' => 'يجب الاسم الاول لايزيد عن خمسةعشر حرف',
            'email.email' => 'يجب ان يكون بريدا اليكترونيا',
            'email.unique' => ' هذا البريد الاليكتروني مستخدم بالفعل',
            'email.regex' => 'هذا البريداليكتروني غير صحيح',
            'employees_phone.required' => 'يجب ادخال رقم الهاتف',
            'employees_phone.unique' => 'هذا الرقم مستخدم بالفعل',
            'employees_phone.digits' => 'يجب رقم الهاتف لايقل او يزيد عن احدي عشر حرف',
            'employees_phone.regex' => 'هذا الهاتف غير صحيح',
            'employees_nationalID.required' => 'يجب ادخال الرقم القومي',
            'employees_nationalID.integer' => 'يجب ان يكون الرقم القومي صحيحا',
            'employees_nationalID.unique' => ' هذا الرقم القومي مستخدم بالفعل',
            'employees_nationalID.digits' => 'يجب الرقم القومي لايقل او يزيد عن اربعة عشر حرف',
            'employees_address.required' => 'يجب ادخال العنوان ',
            'employees_address.max' => 'هذا العنوان كبير',
            'employees_gender.required' => 'يجب اختيار النوع ',
            'employees_jopName.required' => 'يجب ادخال المسمي الوظيفي ',
            'employees_salary.required' => 'يجب ادخال الراتب',
            'date_salary.required' => 'يجب اختيار صرف الراتب ',
            'employees_birth.required' => 'يجب ادخال تاريخ الميلاد ',
            'employees_birth.date' => 'تاريخ الميلاد غير صحيح',
            'employees_work.required' => 'يجب ادخال تاريخ التعيين ',
            'employees_work.date' => 'تاريخ التعيين غير صحيح',
            'stauts.required' => 'يجب اختيار الحالة ',
            'section_id.required' =>'يجب اختيار القسم',
        ]);
        $input = $request->all();
        $employees = employees::find($id);
        $employees->update($input);
        session()->flash('Edit', 'تم تعديل الموظف بنجاح ');
        return redirect('/employees/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $id = $request->employee_id;
        $employees= employees::onlyTrashed()->where('id',$id)->forceDelete();
        session()->flash('successDestroy','تم حذف الموظف بنجاح');
        return redirect('/employees');

    }
    public function softDelete(Request $request)
    {
        $id = $request->employee_id;
        $employees= employees::find($id);

        $employees->delete();
        session()->flash('successSoft','تم حذف الموظف بنجاح');
        return redirect('/employees');
    }

    public function backSoftDelete($id)
    {

        $employees= employees::onlyTrashed()->where('id',$id)->first()->restore();
        session()->flash('successBackSoft','تم استرجاع الموظف بنجاح');
        return redirect('/employees');
    }
    public function activeEmployee (Request $request)
    {
        $employees = employees::where('stauts', "مفعل")->get();
        return view('employees.active_employee',compact('employees'));
    }
    public function employeeActive(Request $request,$id)
    {
        $employees = employees::find($id);
        $employees->update([
            'stauts' => 'مفعل',
        ]);
        session()->flash('successActive','تم تفعيل الموظف بنجاج');
        return redirect('employees/active');
    }
    public function employeeDisable(Request $request)
    {
        $employees = employees::where('stauts', "غير مفعل")->get();
        return view('employees.active_employee',compact('employees'));
    }

    public function disableEmployee(Request $request,$id)
    {
        $employees = employees::find($id);
        $employees->update([
            'stauts' => 'غير مفعل',
        ]);
        session()->flash('successNotActive','تم تعطيل الموظف بنجاج');
        return redirect('employees/notactive');
    }
    public function export()
    {

        return Excel::download(new employeesExport, 'employees.xlsx');
    }

}
