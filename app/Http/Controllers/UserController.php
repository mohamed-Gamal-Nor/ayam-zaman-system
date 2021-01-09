<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\sectionUSers;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
class UserController extends Controller
{

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $users = User::all();
        return view('user.show_users',compact('users'));
    }
    /**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
    public function create()
    {
        $sections = sectionUSers::select('section_name','id')->get();
        $roles = Role::pluck('name','name')->all();
        return view('user.add_user',compact('roles',"sections"));
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
            'user_fname' => "required|string|min:3|max:15",
            'user_lname' => "required|string|min:3|max:15",
            'email' => "required|email|unique:users,email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$/",
            'user_nationalID' => "required|integer|unique:users,user_nationalID|digits:14",
            'password' => 'required|same:confirm-password|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/',
            'user_phone' =>'required|unique:users,user_phone|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/',
            'user_phoneOther' => 'nullable|unique:users,user_phoneOther|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/',
            'user_address1' => "required|string|max:255",
            'user_address2' => "nullable|string|max:255",
            'user_birth' => "required|date",
            'user_work' => "required|date",
            'user_jopName'=> "required|string|max:255",
            "user_gender" => "required|string",
            "status" => "required|string",
            'roles_name' => 'required',
            'section_id' => 'required',
            "user_image" => "nullable|mimes:jpg,jpeg,png|max:5000"
        ],[
            'user_fname.required' => 'يجب ادخال الاسم الاول',
            'user_fname.min' => 'يجب الاسم الاول لايقل عن ثلاث حروف',
            'user_fname.max' => 'يجب الاسم الاول لايزيد عن خمسةعشر حرف',
            'user_lname.required' => 'يجب ادخال الاسم الاخير',
            'user_lname.min' => 'يجب الاسم الاخير لايقل عن ثلاث حروف',
            'user_lname.max' => 'يجب الاسم الاخير لايزيد عن خمسةعشر حرف',
            'email.required' => 'يجب ادخال البريد الالكتروني',
            'email.email' => 'يجب ان يكون بريدا اليكترونيا',
            'email.unique' => ' هذا البريد الاليكتروني مستخدم بالفعل',
            'email.regex' => 'هذا البريداليكتروني غير صحيح',
            'user_nationalID.required' => 'يجب ادخال الرقم القومي',
            'user_nationalID.integer' => 'يجب ان يكون الرقم القومي صحيحا',
            'user_nationalID.unique' => ' هذا الرقم القومي مستخدم بالفعل',
            'user_nationalID.digits' => 'يجب الرقم القومي لايقل او يزيد عن اربعة عشر حرف',
            'password.required' => 'يجب أدخال كلمة مرور',
            'password.same' => 'كلمة المرور غير مطابقة',
            'password.regex' => 'يجب أن تحتوي كلمة المرور علي حروف كبيرةوصغير وارقام ورموز',
            'user_phone.required' => 'يجب ادخال رقم الهاتف',
            'user_phone.unique' => 'هذا الرقم مستخدم بالفعل',
            'user_phone.digits' => 'يجب رقم الهاتف لايقل او يزيد عن احدي عشر حرف',
            'user_phone.regex' => 'هذا الهاتف غير صحيح',
            'user_phoneOther.unique' => 'هذا الرقم مستخدم بالفعل',
            'user_phoneOther.digits' => 'يجب رقم الهاتف البديل لايقل او يزيد عن احدي عشر حرف',
            'user_phoneOther.regex' => 'هذا الهاتف البديل غير صحيح',
            'user_address1.required' => 'يجب ادخال العنوان ',
            'user_address1.max' => 'هذا العنوان كبير',
            'user_address2.max' => 'هذا العنوان كبير',
            'user_birth.required' => 'يجب ادخال تاريخ الميلاد ',
            'user_birth.date' => 'تاريخ الميلاد غير صحيح',
            'user_work.required' => 'يجب ادخال تاريخ التعيين ',
            'user_work.date' => 'تاريخ التعيين غير صحيح',
            'user_jopName.required' => 'يجب ادخال المسمي الوظيفي ',
            'user_gender.required' => 'يجب اختيار النوع ',
            'status.required' => 'يجب اختيار الحالة ',
            'roles_name.required' => 'يجب اختيار صلاحية ',
            'section_id.required' =>'يجب اختيار القسم',
            'user_image.mimes' => "يجب ان تكون الصورة بصيغة JPG - PNG - JPEG",
            'user_image.max' => "يجب ان لا يزيد حجم الصورة عن خمسة ميجا",
        ]);

        $input = $request->except("confirm-password");

        $image = $request->file('user_image');
        if(!empty($image)){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/users'),$imageName);
            $input['user_image'] = $imageName;
        }

        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles_name'));
        session()->flash('Add', 'تم اضافة المستخدم بنجاح ');
        return redirect('/users/create');
    }
    /**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
    public function show($id)
    {
        $user = User::find($id);
        if(!empty($user)){
            return view('user.show_user',compact('user'));
        }else{
            return view('errors.noData');
        }
    }
    /**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
    public function edit($id)
    {
        $sections = sectionUSers::select('section_name','id')->get();
        $user = User::find($id);
        if(!empty($user)){
            $roles = Role::pluck('name','name')->all();
            $userRole = $user->roles->pluck('name','name')->all();

            return view('user.edit_user',compact('user','roles','userRole','sections'));
        }else{
            return view('errors.noData');
        }
    }
    /**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_fname' => "required|string|min:3|max:15",
            'user_lname' => "required|string|min:3|max:15",
            'email' => "required|email|unique:users,email,".$id."|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$/",
            'user_nationalID' => "required|integer|unique:users,user_nationalID,".$id."|digits:14",
            'password' => 'nullable|same:confirm-password|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/',
            'user_phone' =>'required|unique:users,user_phone,'.$id.'|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/',
            'user_phoneOther' => 'nullable|unique:users,user_phoneOther,'.$id.'|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/',
            'user_address1' => "required|string|max:255",
            'user_address2' => "nullable|string|max:255",
            'user_birth' => "required|date",
            'user_work' => "required|date",
            'user_jopName'=> "required|string|max:255",
            "user_gender" => "required|string",
            'roles_name' => 'required',
            'section_id' => 'required',
            "user_image" => "nullable|mimes:jpg,jpeg,png|max:5000",
            "user_bio" =>"required|max:255",
            "user_Github"=>"nullable|url|regex:/^(https):\/\/(-\.)?([^\s\/?\.#-]+\.?)+(\/[^\s]*)?$/",
            "user_Twitter"=>"nullable|url|regex:/^(https):\/\/(-\.)?([^\s\/?\.#-]+\.?)+(\/[^\s]*)?$/",
            "user_Linkedin"=>"nullable|url|regex:/^(https):\/\/(-\.)?([^\s\/?\.#-]+\.?)+(\/[^\s]*)?$/",
            "user_FaceBook"=>"nullable|url|regex:/^(https):\/\/(-\.)?([^\s\/?\.#-]+\.?)+(\/[^\s]*)?$/",
            "user_Portfolio"=>"nullable|url|regex:/^(https):\/\/(-\.)?([^\s\/?\.#-]+\.?)+(\/[^\s]*)?$/",
        ],[
            'user_fname.required' => 'يجب ادخال الاسم الاول',
            'user_fname.min' => 'يجب الاسم الاول لايقل عن ثلاث حروف',
            'user_fname.max' => 'يجب الاسم الاول لايزيد عن خمسةعشر حرف',
            'user_lname.required' => 'يجب ادخال الاسم الاخير',
            'user_lname.min' => 'يجب الاسم الاخير لايقل عن ثلاث حروف',
            'user_lname.max' => 'يجب الاسم الاخير لايزيد عن خمسةعشر حرف',
            'email.required' => 'يجب ادخال البريد الالكتروني',
            'email.email' => 'يجب ان يكون بريدا اليكترونيا',
            'email.unique' => ' هذا البريد الاليكتروني مستخدم بالفعل',
            'email.regex' => 'هذا البريداليكتروني غير صحيح',
            'user_nationalID.required' => 'يجب ادخال الرقم القومي',
            'user_nationalID.integer' => 'يجب ان يكون الرقم القومي صحيحا',
            'user_nationalID.unique' => ' هذا الرقم القومي مستخدم بالفعل',
            'user_nationalID.digits' => 'يجب الرقم القومي لايقل او يزيد عن اربعة عشر حرف',
            'password.same' => 'كلمة المرور غير مطابقة',
            'password.regex' => 'يجب أن تحتوي كلمة المرور علي حروف كبيرةوصغير وارقام ورموز',
            'user_phone.required' => 'يجب ادخال رقم الهاتف',
            'user_phone.unique' => 'هذا الرقم مستخدم بالفعل',
            'user_phone.digits' => 'يجب رقم الهاتف لايقل او يزيد عن احدي عشر حرف',
            'user_phone.regex' => 'هذا الهاتف غير صحيح',
            'user_phoneOther.unique' => 'هذا الرقم مستخدم بالفعل',
            'user_phoneOther.digits' => 'يجب رقم الهاتف البديل لايقل او يزيد عن احدي عشر حرف',
            'user_phoneOther.regex' => 'هذا الهاتف البديل غير صحيح',
            'user_address1.required' => 'يجب ادخال العنوان ',
            'user_address1.max' => 'هذا العنوان كبير',
            'user_address2.max' => 'هذا العنوان كبير',
            'user_birth.required' => 'يجب ادخال تاريخ الميلاد ',
            'user_birth.date' => 'تاريخ الميلاد غير صحيح',
            'user_work.required' => 'يجب ادخال تاريخ التعيين ',
            'user_work.date' => 'تاريخ التعيين غير صحيح',
            'user_jopName.required' => 'يجب ادخال المسمي الوظيفي ',
            'user_gender.required' => 'يجب اختيار النوع ',
            'roles_name.required' => 'يجب اختيار صلاحية ',
            'user_image.mimes' => "يجب ان تكون الصورة بصيغة JPG - PNG - JPEG",
            'user_image.max' => "يجب ان لا يزيد حجم الصورة عن خمسة ميجا",
            'section_id.required' =>'يجب اختيار القسم',
            "user_bio.required"=>"يجب ادخال سيرة ذاتية عنك",
            "user_Github.url"=>"يجب ان يكون رابط github",
            "user_Github.regex"=>"هذا الرابط ليس صحيح",
            "user_Twitter.url"=>"يجب ان يكون رابط Twitter",
            "user_Twitter.regex"=>"هذا الرابط ليس صحيح",
            "user_Linkedin.url"=>"يجب ان يكون رابط Linkedin",
            "user_Linkedin.regex"=>"هذا الرابط ليس صحيح",
            "user_FaceBook.url"=>"يجب ان يكون رابط FaceBook",
            "user_FaceBook.regex"=>"هذا الرابط ليس صحيح",
            "user_Portfolio.url"=>"يجب ان يكون رابط Portfolio",
            "user_Portfolio.regex"=>"هذا الرابط ليس صحيح",
        ]);

        $user = User::find($id);
        $input = $request->all();

        if(!empty($input['password']) && $input['password'] != null){
            $input['password'] = Hash::make($input['password']);
            if(!empty($input['user_image'])){
                $path = public_path().'/images/users/';
                if($user->user_image != ''  && $user->user_image != null){
                    $file_old = $path.$user->user_image;
                    unlink($file_old);
                }
                $image = $request->file('user_image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/users'),$imageName);
                $input['user_image'] = $imageName;
            }else{
                $input = $request->except('user_image');
            }
        }else{
            if(!empty($input['user_image'])){
                $path = public_path().'/images/users/';
                if($user->user_image != ''  && $user->user_image != null){
                    $file_old = $path.$user->user_image;
                    unlink($file_old);
                }
                $image = $request->file('user_image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/users'),$imageName);
                $input = $request->except('password','confirm-password');
                $input['user_image'] = $imageName;
            }else{
                $input = $request->except('user_image','password','confirm-password');
            }
        }

        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles_name'));
        session()->flash('Edit', 'تم تعديل المستخدم بنجاح ');
        return redirect('/users/'.$id.'/edit');

    }
    /**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
    public function destroy(Request $request)
    {
        $id = $request->user_id;
        $user = User::find($id);
        $path = public_path().'/images/users/';
        if($user->user_image != ''  && $user->user_image != null){
            $file_old = $path.$user->user_image;
            unlink($file_old);
        }
        $user->delete();
        session()->flash('success','تم حذف المستخدم بنجاح');
        return redirect('/users');
    }

    public function activeUsers(Request $request)
    {
        $users = User::where('status', "مفعل")->get();
        return view('user.active_users',compact('users'));
    }
    public function userActive(Request $request,$id)
    {
        $user = User::find($id);
        $user->update([
            'status' => 'مفعل',
        ]);
        session()->flash('edit','تم تفعيل المستخدم بنجاج');
        return redirect('users/active');
    }
    public function activeNotUsers(Request $request)
    {
        $users = User::where('status', "غير مفعل")->get();
        return view('user.active_users',compact('users'));
    }

    public function userdisable(Request $request,$id)
    {
        $user = User::find($id);
        $user->update([
            'status' => 'غير مفعل',
        ]);
        session()->flash('edit','تم تعطيل المستخدم بنجاج');
        return redirect('users/notactive');
    }
}
