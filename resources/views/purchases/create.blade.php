@extends('layouts.master')
@section('title')
أضافة فاتورة مشتريات - مصنع ايام زمان
@stop
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">مشتريات الموردين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ أضافة فاتورة مشتريات</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									اضافة فاتورة مشتريات
								</div>
                                <p class="mg-b-20">برجاء ملئ جميع البيانات المطلوبة حتي يتم تسجيل الفاتورة.</p>
                                <p class="mg-b-20">بيانات المورد</p>
								<form action="form-validation.html" id="selectForm" name="selectForm" autocomplete="off">
									<div class="row row-sm mg-b-10">
                                        <div class="col-3">
											<div class="form-group mg-b-0">
												<label class="form-label">كود المورد :</label>
												<input class="form-control" disabled id="code" type="text">
											</div>
										</div>
										<div class="col-3">
											<div class="form-group mg-b-0">
												<label class="form-label">التاريخ:</label>
												<input class="form-control" disabled value="{{$dateDay}}" type="text">
											</div>
										</div>
										<div class="col-6">
                                            <label class="form-label">اختار اسم المورد: <span class="tx-danger">*</span></label>
											<select class="form-control select2" name="supplier_id" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" data-placeholder="اختار المورد" required="">
												<option label="اختار المورد">
												</option>
												@foreach ($suppliers as $supplier)
                                                    <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                                @endforeach
											</select>
											<div id="slErrorContainer"></div>
										</div>
                                    </div>
                                    <div class="row row-sm">
										<div class="col-3">
											<div class="form-group mg-b-0">
												<label class="form-label">اسم المستفيد:</label>
												<input class="form-control" disabled value="" type="text" id="Beneficiary">
											</div>
                                        </div>
                                        <div class="col-3">
											<div class="form-group mg-b-0">
												<label class="form-label">رقم الهاتف:</label>
												<input class="form-control" disabled value="" type="text" id="phone">
											</div>
                                        </div>
                                        <div class="col-3">
											<div class="form-group mg-b-0">
												<label class="form-label">نوع التوريد:</label>
												<input class="form-control" disabled value="" type="text" id="supply">
											</div>
                                        </div>
                                        <div class="col-3">
											<div class="form-group mg-b-0">
												<label class="form-label">نوع الدفع:</label>
												<input class="form-control" disabled value="" type="text" id="pay">
											</div>
										</div>
                                    </div>
                                    <hr>
                                    <div class="main-content-label mg-b-20">
                                        اضافة الخامات
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered mg-b-0 text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2%" class="text-center"><a class="btn btn-sm btn-light">+</a></th>
                                                    <th>اختار الخامة</th>
                                                    <th>السعر</th>
                                                    <th>الكمية طبقا للوحدة</th>
                                                    <th>الاجمالي</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width: 2%" class="text-center"><a class="btn btn-sm btn-danger">x</a></td>
                                                    <td scope="row">
                                                        <div class="form-group mg-b-0">
                                                            <select class="form-control select2" name="material_id" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" data-placeholder="أختار الخامة" required="">
                                                                <option label="أختار الخامة">
                                                                </option>
                                                                @foreach ($materials as $material)
                                                                    <option value="{{$material->id}}">{{$material->materials_name}} - > {{$material->unit->unit_name}}</option>
                                                                @endforeach
                                                                
                                                            </select>
                                                            <div id="slErrorContainer"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group mg-b-0">
                                                            <input class="form-control" name="price" value="" type="number" placeholder="0.0 " required min="0">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group mg-b-0">
                                                            <input class="form-control" name="Quantity" value="" type="number" placeholder=" 0.0" required min="0">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group mg-b-0">
                                                            <input class="form-control" disabled name="vat_value" value="" type="number" placeholder=" 0.0" min="0">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-left">خصم</td>
                                                    <td>
                                                        <input class="form-control" name="vat_value" value="" type="number" placeholder=" 0.0" min="0">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-left">نسبة الضريبة</td>
                                                    <td>
                                                        <input class="form-control" name="vat_value" value="" type="number" placeholder=" 0.0" min="0">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-left">قيمة الضريبة</td>
                                                    <td>
                                                        <input class="form-control" name="vat_value" disabled value="" type="number" placeholder=" 0.0" min="0">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-left">أجمالي الفاتورة</td>
                                                    <td>
                                                        <input class="form-control" disabled name="vat_value" value="" type="number" placeholder=" 0.0" min="0">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-main-primary pd-x-20 mg-t-10" type="submit">حفظ</button>
                                        <button class="btn btn-danger pd-x-20 mg-t-10">الغاء</button>
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
<!--Internal  Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>

<script>
    $(document).ready(function() {
        $('select[name="supplier_id"]').on('change', function() {
            var supplierId = $(this).val();
            if (supplierId) {
                $.ajax({
                    url: "{{ URL::to('supplier') }}/" + supplierId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#Beneficiary').empty();
                        $('#phone').empty();
                        $('#supply').empty();
                        $('#pay').empty();
                        $('#code').empty();

                        $('#code').val(data[0]['id']);
                        $('#Beneficiary').val(data[0]['Beneficiary_name']);
                        $('#phone').val(data[0]['supllier_phone']);
                        $('#supply').val(data[0]['Type_of_supply']);
                        $('#pay').val(data[0]['Type_of_pay']);
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
@endsection
