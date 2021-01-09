@extends('layouts.master')
@section('title')
    تعديل موظف - مصنع ايام زمان
@stop
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل موظف</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session()->has('Edit'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('Edit') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
				<!-- row -->
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									تعديل موظف
								</div>
								<p class="mg-b-20">يجب ملئ جميع الخانات المؤشرة اليها بنجمه</p>
                                <form class="parsley-style-1" id="selectForm2" name="selectForm2"  action="{{ route('employees.update',$employees->id) }}" enctype="multipart/form-data" autocomplete="off" method="POST">
                                    @method('put')
                                    @csrf
									<div class="">
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>كود البصمة: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="employees_finger" placeholder="ادخل كود البصمة" required="" type="number" min="1" value="{{ $employees->employees_finger }}">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>اسم الموظف: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="employees_name" placeholder="ادخل اسم الموظف" required="" type="text" value="{{ $employees->employees_name }}">
											</div>
                                        </div>
                                        <div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label> البريد الالكتروني:</label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="email" placeholder="ادخل البريد الالكتروني" type="email" value="{{ $employees->email }}">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label> الرقم القومي: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="employees_nationalID" placeholder="ادخل الرقم القومي" required="" type="number" min="0" maxlength="14" minlength="14" value="{{ $employees->employees_nationalID }}">
											</div>
                                        </div>
                                        <div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>رقم الهاتف: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="employees_phone" placeholder="ادخل رقم الهاتف" required="" type="phone" value="{{ $employees->employees_phone }}">
											</div>
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>عنوان السكن: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="employees_address" placeholder="ادخل عنوان السكن" required="" type="text" value="{{ $employees->employees_address }}">
											</div>
                                        </div>
                                        <div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
                                                <label>المسمي الوظيفي: <span class="tx-danger">*</span></label>
                                                <input class="form-control" data-parsley-class-handler="#fnWrapper" name="employees_jopName" placeholder="ادخل اسم الوظيفة" required="" type="text" value="{{ $employees->employees_jopName }}">
                                            </div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>الراتب : <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="employees_salary" placeholder="ادخل الراتب" required="" type="number" min="1"value="{{ $employees->employees_salary }}">
											</div>
                                        </div>
                                        <div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>تاريخ الميلاد: <span class="tx-danger">*</span></label>
												<div class="input-group ">
                                                    <input class="form-control" placeholder="MM/DD/YYYY" name="employees_birth" type="date" required="" value="{{ $employees->employees_birth }}">
                                                </div>
											</div>
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>تاريخ التعيين: <span class="tx-danger">*</span></label>
												<div class="input-group ">
                                                    <input class="form-control" placeholder="MM/DD/YYYY" name="employees_work" type="date" required="" value="{{ $employees->employees_work }}">
                                                </div>
											</div>
                                        </div>
                                        <div class="row mg-b-20">
                                            <div class="parsley-input col-md-6 " id="lnWrapper">
                                                <label>النوع: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2-no-search"  name="employees_gender" required="">
                                                    <option label="اختار النوع">
                                                    </option>
                                                    <option  value="ذكر"
                                                        @if($employees->employees_gender == "ذكر")
                                                            selected="selected"
                                                        @endif
                                                    >
                                                        ذكر
                                                    </option>
                                                    <option value="أنثي"
                                                        @if($employees->employees_gender == "أنثي")
                                                            selected="selected"
                                                        @endif
                                                    >
                                                        أنثي
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="parsley-input col-md-6 " id="lnWrapper">
                                                <label>صرف الراتب: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2-no-search"  name="date_salary" required="">
                                                    <option label="اختار النوع">
                                                    </option>
                                                    <option  value="شهري"
                                                        @if($employees->date_salary == "شهري")
                                                            selected="selected"
                                                        @endif
                                                    >
                                                    شهري
                                                    </option>
                                                    <option value="اسبوعي"
                                                        @if($employees->date_salary == "اسبوعي")
                                                            selected="selected"
                                                        @endif
                                                    >
                                                    اسبوعي
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mg-b-20">
                                            <div class="parsley-input col-md-6 " id="lnWrapper">
                                                <label>الحالة: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2-no-search"  name="stauts" required="">
                                                    <option label="اختار الحاله">
                                                    </option>
                                                    <option  value="مفعل"
                                                        @if($employees->stauts == "مفعل")
                                                            selected="selected"
                                                        @endif
                                                    >
                                                    مفعل
                                                    </option>
                                                    <option value="غير مفعل"
                                                        @if($employees->stauts == "غير مفعل")
                                                            selected="selected"
                                                        @endif
                                                    >
                                                    غير مفعل
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="parsley-input col-md-6 " id="lnWrapper">
                                                <label>اختر القسم بالبحث</label>
                                                <select class="form-control select2" name="section_id" required="">
                                                    <option label="اختار واحدا">
                                                    </option>
                                                    @foreach ($sections as $section)
                                                        <option value="{{$section->id}}" @if ($section->id == old('section_id', $employees->section_id ))
                                                            selected="selected"
                                                            @endif>
                                                            {{$section->section_name}}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>

									<div class="mg-t-30">
										<button class="btn btn-main-primary pd-x-20" type="submit">تسجيل</button>
										<a class="btn btn-outline-danger pd-x-20" href="{{ url('/' . $page='employees') }}">إلغاء</a>
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
@endsection
