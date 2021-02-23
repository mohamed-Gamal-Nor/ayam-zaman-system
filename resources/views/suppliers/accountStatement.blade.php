@extends('layouts.master')
@section('title')
    كشف حساب مورد - مصنع ايام زمان
@stop
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">مشتريات الموردين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ كشف حساب مورد</span>
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
                            <form autocomplete="off" action="" method="post" id="form_statment">
                                @method('post')
                                @csrf
                                <div class="card-body">
                                    <div class="mg-b-5">
                                        كشف حساب مورد
                                    </div>
                                    <p class="mg-b-20">يرجي تحديد اسم المورد او الكود</p>
                                    <div>

                                        <section>
                                            <div class="row row-sm mg-b-10">
                                                <div class="col-lg-3">
                                                    <div class="form-group mg-b-0">
                                                        <label class="form-control-label">كود المورد :</label>
                                                        <input class="form-control" disabled id="id" type="number">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label class="form-control-label">اختار اسم المورد: <span class="tx-danger">*</span></label>
                                                    <select class="form-control select2" name="supplier_id" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" data-placeholder="اختار المورد" required>
                                                        <option label="اختار المورد">
                                                        </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div id="slErrorContainer"></div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group mg-b-0">
                                                        <label class="form-control-label">من الفترة:</label>
                                                        <input class="form-control"  name="start" type="date">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group mg-b-0">
                                                        <label class="form-control-label">الي الفترة:</label>
                                                        <input class="form-control"  name="end" type="date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-sm mg-b-10">
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="form-group mg-b-0">
                                                        <label class="form-label">اسم المستفيد:</label>
                                                        <input class="form-control" disabled value="" type="text" id="Beneficiary">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="form-group mg-b-0">
                                                        <label class="form-label">رقم الهاتف:</label>
                                                        <input class="form-control" disabled value="" type="text" id="phone">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="form-group mg-b-0">
                                                        <label class="form-label">نوع التوريد:</label>
                                                        <input class="form-control" disabled value="" type="text" id="supply">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="form-group mg-b-0">
                                                        <label class="form-label">نوع الدفع:</label>
                                                        <input class="form-control" disabled value="" type="text" id="pay">
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <div class="d-flex justify-content-right mg-b-5">
                                            <button type="submit" class="mx-1 btn btn-primary text-right" id="search">بحث</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
						</div>
                        <div class="card" id="card">
                            <div class="example" id="loadingDiv">
                                <div class="spinner-grow" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div class="card-header pb-0">
								<div class="d-flex justify-content-between">
                                    <div class=" col-lg-3">
                                        <p class="invoice-info-row"><span>رصيد بداية المدة </span> <span class="text-right text-success" id='supplier_balance'>3</span></p>
                                        <p class="invoice-info-row"><span>اسم المورد </span> <span class="text-right text-success" id='supplier_name'>3</span></p>
                                        <p class="invoice-info-row"><span>من الفترة </span> <span class="text-right text-success" id='start_date'>3</span></p>
                                        <p class="invoice-info-row"><span>الي الفترة </span> <span class="text-right text-success" id='end_date'>3</span></p>
                                    </div>
									<img class="wd-150" src="{{URL::asset('assets/img/brand/ayamzaman.svg')}}" alt="">
								</div>
							</div>
                            <div class="card-body">
                                <div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>ID</th>
												<th>Name</th>
												<th>Position</th>
												<th>Salary</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th scope="row">1</th>
												<td>Tiger Nixon</td>
												<td>System Architect</td>
												<td>$320,800</td>
											</tr>
											<tr>
												<th scope="row">2</th>
												<td>Garrett Winters</td>
												<td>Accountant</td>
												<td>$170,750</td>
											</tr>
											<tr>
												<th scope="row">3</th>
												<td>Ashton Cox</td>
												<td>Junior Technical Author</td>
												<td>$86,000</td>
											</tr>
											<tr>
												<th scope="row">4</th>
												<td>Cedric Kelly</td>
												<td>Senior Javascript Developer</td>
												<td>$433,060</td>
											</tr>
											<tr>
												<th scope="row">5</th>
												<td>Airi Satou</td>
												<td>Accountant</td>
												<td>$162,700</td>
											</tr>
										</tbody>
									</table>
								</div>
                                <div class="row row-sm mg-t-10">
                                    <div class="col-sm-6 col-lg-4 mg-sm-t-0 text-center">
                                        <ul class="pagination pagination-success mb-0 text-center">
                                            <li class="page-item"><a class="page-link" href="#"><i class="icon ion-ios-arrow-forward"></i></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#"><i class="icon ion-ios-arrow-back"></i></a></li>
                                        </ul>
                                    </div><!-- col-4 -->
                                </div>
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
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
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
                        $('#id').empty();

                        $('#id').val(data[0]['id']);
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
        var $loading = $('#loadingDiv').show();
        $(document).ajaxStart(function () {
                $loading.show();
            }).ajaxStop(function () {
                $loading.hide();
            });
        $("#form_statment").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var supplierId = $('select[name="supplier_id"]').val();
            if (supplierId) {
                $.ajax({
                    type: "POST",
                    url: "{{ URL::to('getStatement') }}/" + supplierId,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        alert(data); // show response from the php script.
                    }
                });
            } else {
                console.log('AJAX load did not work');
            }

        });
    });
</script>
@endsection
