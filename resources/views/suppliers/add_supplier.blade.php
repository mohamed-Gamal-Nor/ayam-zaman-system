@extends('layouts.master')
@section('title')
    أضافة مورد - سنتر ايام زمان
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
							<h4 class="content-title mb-0 my-auto">الموردين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ أضافة مورد</span>
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
                @if (session()->has('Add'))
                    <script>
                        window.onload = function() {
                            notif({
                                msg: " تم أضافة المورد بنجاح",
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
									أضافة مورد جديد
								</div>
								<p class="mg-b-20">يجب ملئ جميع الخانات المؤشرة اليها بنجمه</p>
                                <form class="parsley-style-1" id="selectForm2" name="selectForm2"  action="{{ route('suppliers.store') }}" autocomplete="off" method="POST">
                                    @csrf
									<div class="">
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>اسم المورد: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="supplier_name" placeholder="ادخل اسم المورد" required="" type="text" >
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>اسم المستفيد: </label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="Beneficiary_name" placeholder="ادخل اسم المستفيد" type="text">
											</div>
                                        </div>
                                        <div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>رقم الهاتف: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="supllier_phone" placeholder="ادخل رقم الهاتف" required="" type="phone">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>رقم هاتف بديل:</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="supllier_phoneOther" placeholder=" ادخل رقم الهاتف بديل" type="phone">
											</div>
                                        </div>
                                        <div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>عنوان المورد: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="supllier_address1" placeholder="ادخل عنوان المورد" required="" type="text">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>سجل تجاري: </label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="Commercial_Record" placeholder="ادخل السجل التجاري"  type="text">
											</div>
                                        </div>
                                        <div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>البطاقة الضريبية: </label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="Tax_card" placeholder="ادخل البطاقة الضريبية"  type="text">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>نوع التوريد: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="Type_of_supply" placeholder="ادخل نوع التوريد" required="" type="text">
											</div>
                                        </div>
                                    </div>
                                    <div class="row mg-b-20">
                                        <div class="parsley-input col-md-6 " id="lnWrapper">
                                            <label>نوع الدفع: <span class="tx-danger">*</span></label>
                                            <select class="form-control select2-no-search"  name="Type_of_pay" required="">
                                                <option label="اختار النوع">
                                                </option>
                                                <option value="شيك">
                                                    شيك
                                                </option>
                                                <option value="كاش">
                                                    كاش
                                                </option>
                                                <option value="متنوع">
                                                    متنوع
                                                </option>
                                            </select>
                                        </div>
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
                                    </div>
									<div class="mg-t-30">
										<button class="btn btn-main-primary pd-x-20" type="submit">تسجيل</button>
										<a class="btn btn-outline-danger pd-x-20" href="{{ url('/' . $page='suppliers') }}">إلغاء</a>
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
