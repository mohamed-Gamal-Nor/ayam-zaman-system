@extends('layouts.master')
@section('title')
    تعديل عميل - مصنع ايام زمان
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
							<h4 class="content-title mb-0 my-auto">العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل عميل</span>
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
									تعديل عميل حالي
								</div>
								<p class="mg-b-20">يجب ملئ جميع الخانات المؤشرة اليها بنجمه</p>
                                <form class="parsley-style-1" id="selectForm2" name="selectForm2"  action="{{ route('customers.update',$customers->id) }}" autocomplete="off" method="POST">
                                    @method('put')
                                    @csrf
									<div class="">
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>اسم العميل: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="customers_name" placeholder="ادخل اسم العميل" required="" type="text" value="{{ $customers->customers_name }}">
											</div>
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label> البريد الالكتروني: </label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="email" placeholder="ادخل البريد الالكتروني" type="email" value="{{ $customers->email }}">
											</div>
                                        </div>
                                        <div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>رقم الهاتف: <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="customers_phone" placeholder="ادخل رقم الهاتف" required="" type="phone" value="{{ $customers->customers_phone }}">
											</div>
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>العنوان : <span class="tx-danger">*</span></label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="customers_address" placeholder="ادخل عنوان " required="" type="text" value="{{ $customers->customers_address }}">
											</div>
                                        </div>
                                    </div>
                                    <div class="row mg-b-20">
                                        <div class="parsley-input col-md-6 " id="lnWrapper">
                                            <label>النوع: <span class="tx-danger">*</span></label>
                                            <select class="form-control select2-no-search"  name="customers_gender" required="">
                                                    <option label="اختار النوع">
                                                    </option>
                                                    <option  value="ذكر"
                                                        @if($customers->customers_gender == "ذكر")
                                                            selected="selected"
                                                        @endif
                                                    >
                                                        ذكر
                                                    </option>
                                                    <option value="أنثي"
                                                        @if($customers->customers_gender == "أنثي")
                                                            selected="selected"
                                                        @endif
                                                    >
                                                        أنثي
                                                    </option>
                                                </select>
                                        </div>
                                    </div>
									<div class="mg-t-30">
										<button class="btn btn-main-primary pd-x-20" type="submit">تحديث</button>
										<a class="btn btn-outline-danger pd-x-20" href="{{ url('/' . $page='customers') }}">إلغاء</a>
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
