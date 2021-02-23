@extends('layouts.master')
@section('title')
    أضافة مستخدم - مصنع ايام زمان
@stop
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ أضافة مستخدم</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
                @if ($errors->any())
                <div class="card bd-0 mg-b-20 bg-danger-transparent alert p-0">
                    <div class="card-header text-danger font-weight-bold">
                        <i class="far fa-times-circle"></i> رسالة خطأ
                        <button aria-label="Close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                @if (session()->has('Add'))
                    <script>
                        window.onload = function() {
                            notif({
                                msg: " تم أضافة المستخدم بنجاح",
                                type: "success"
                            });
                        }
                    </script>
                @endif

				<!-- row -->
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									أضافة مستخدم جديد
								</div>
								<p class="mg-b-20">يجب ملئ جميع الخانات المؤشرة اليها بنجمه</p>
                                <form class="parsley-style-1" id="selectForm2" name="selectForm2"  action="{{ route('users.store') }}" enctype="multipart/form-data" autocomplete="off" method="POST">

                                    @csrf
									<div class="">
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>الاسم الاول: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="user_fname" placeholder="ادخل الاسم الاول" required="" type="text" >
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>الاسم الاخير: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="user_lname" placeholder="ادخل الاسم الاخير" required="" type="text">
											</div>
                                        </div>
                                        <div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label> البريد الالكتروني: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="email" placeholder="ادخل البريد الالكتروني" required="" type="email">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label> الرقم القومي: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="user_nationalID" placeholder="ادخل الرقم القومي" required="" type="number" min="0" maxlength="14" minlength="14">
											</div>
                                        </div>
                                        <div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>كلمة المرور: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="password" placeholder="ادخل كلمة المرور" required="" type="password">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>تاكيد كلمة المرور: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="confirm-password" placeholder="اعد ادخال كلمة المرور" required="" type="password">
											</div>
                                        </div>
                                        <div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>رقم الهاتف: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="user_phone" placeholder="ادخل رقم الهاتف" required="" type="phone">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>رقم هاتف بديل:</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="user_phoneOther" placeholder=" ادخل رقم الهاتف بديل" type="phone">
											</div>
                                        </div>
                                        <div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>عنوان السكن: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="user_address1" placeholder="ادخل عنوان السكن" required="" type="text">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>عنوان سكن بديل: </label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="user_address2" placeholder="ادخل عنوان سكن بديل"  type="text">
											</div>
                                        </div>
                                        <div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>تاريخ الميلاد: <span class="tx-danger">*</span></label>
												<div class="input-group ">
                                                    <input class="form-control" placeholder="MM/DD/YYYY" name="user_birth" type="date" required="">
                                                </div>
											</div>
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>تاريخ التعيين: <span class="tx-danger">*</span></label>
												<div class="input-group ">
                                                    <input class="form-control" placeholder="MM/DD/YYYY" name="user_work" type="date" required="">
                                                </div>
											</div>
                                        </div>
                                    </div>
                                    <div class="row mg-b-20">
                                        <div class="parsley-input col-md-6" id="fnWrapper">
                                            <label>المسمي الوظيفي: <span class="tx-danger">*</span></label>
                                            <input class="form-control" data-parsley-class-handler="#fnWrapper" name="user_jopName" placeholder="ادخل اسم الوظيفة" required="" type="text">
                                        </div>
                                        <div class="parsley-input col-md-6 " id="lnWrapper">
                                            <label>النوع: <span class="tx-danger">*</span></label>
                                            <select class="form-control select2-no-search"  name="user_gender" required="">
                                                <option label="اختار النوع">
                                                </option>
                                                <option value="ذكر">
                                                    ذكر
                                                </option>
                                                <option value="أنثي">
                                                    أنثي
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mg-b-20">
                                        <div class="parsley-input col-md-6 " id="lnWrapper">
                                            <label>الحالة: <span class="tx-danger">*</span></label>
                                            <select class="form-control select2-no-search" required="" name="status">
                                                <option label="اختار الحالة">
                                                </option>
                                                <option value="مفعل">
                                                    مفعل
                                                </option>
                                                <option value="غير مفعل">
                                                    غير مفعل
                                                </option>
                                            </select>
                                        </div>
                                        <div class="parsley-input col-md-6 col-sm-3" id="lnWrapper">
                                            <label>الصلاحيات: <span class="tx-danger">*</span></label>
                                            {!!  Form::select('roles_name[]',$roles,[],array('class'=>'form-control select2','multiple','required')) !!}
                                        </div>
                                    </div>
                                    <div class="row mg-b-20">
                                        <div class="parsley-input col-md-6 " id="lnWrapper">
                                            <label>اختر القسم بالبحث</label>
                                            <select class="form-control select2" name="section_id" required="">
                                                <option label="اختار واحدا">
                                                </option>
                                                @foreach ($sections as $section)
                                                    <option value="{{$section->id}}">
                                                        {{$section->section_name}}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="parsley-input col-md-6 col-sm-3" id="lnWrapper">
                                            <label>صورة شخصية: </label>
                                            <div class="col-sm-12 col-md-12">
                                                <input type="file" class="dropify" data-height="200" name="user_image"/>
                                            </div>
                                        </div>
                                    </div>
									<div class="mg-t-30">
										<button class="btn btn-main-primary pd-x-20" type="submit">تسجيل</button>
										<a class="btn btn-outline-danger pd-x-20" href="{{ url('/' . $page='users') }}">إلغاء</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
<!--Internal  pickerjs js -->
<script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
<!--Internal Fileuploads js-->
<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
