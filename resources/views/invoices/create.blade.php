@extends('layouts.master')
@section('title')
أضافة فاتورة مشتريات - مصنع ايام زمان
@stop
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
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
                                msg: " تم أنشاء الفاتورة بنجاح",
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
									اضافة فاتورة مشتريات
								</div>
                                <p class="mg-b-20">برجاء ملئ جميع البيانات المطلوبة حتي يتم تسجيل الفاتورة.</p>
                                <p class="mg-b-20">بيانات المورد</p>
								<form action="{{ route("invoices.store") }}" id="selectForm" name="matarial" autocomplete="off" method="POST">
                                    @method('post')
                                    @csrf
                                    <div class="row row-sm mg-b-10">
                                        <div class="col-lg-3">
											<div class="form-group mg-b-0">
												<label class="form-label">كود المورد :</label>
												<input class="form-control" disabled id="code" type="text">
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group mg-b-0">
												<label class="form-label">التاريخ:</label>
												<input class="form-control" disabled value="{{$dateDay}}" type="text">
											</div>
										</div>
										<div class="col-lg-3">
                                            <label class="form-label">اختار اسم المورد: <span class="tx-danger">*</span></label>
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
                                            <label class="form-label">اختار المخزن اللي اتخزن فيه: <span class="tx-danger">*</span></label>
											<select class="form-control select2" name="store_id" data-placeholder="اختار المورد" required>
												<option label="اختار المورد">
												</option>
												@foreach ($stores as $store)
                                                    <option value="{{$store->id}}">{{$store->stores_name}}</option>
                                                @endforeach
											</select>
											<div id="slErrorContainer"></div>
										</div>
                                    </div>
                                    <div class="row row-sm">
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
                                    <hr>
                                    <div class="main-content-label mg-b-20">
                                        اضافة الخامات
                                    </div>
                                    <div class="table-responsive">
                                        <table name='matarial' class="table table-bordered mg-b-0 text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2%" class="text-center"><a href="#" class="btn btn-sm btn-light" id="add">+</a></th>
                                                    <th>اختار الخامة</th>
                                                    <th>السعر</th>
                                                    <th>الكمية طبقا للوحدة</th>
                                                    <th>الاجمالي</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr name="line_items">
                                                    <td style="width: 2%"  class="text-center"><a href="#" class="btn btn-sm btn-danger remove">x</a></td>
                                                    <td scope="row">
                                                        <div class="form-group mg-b-0">
                                                            <select class="form-control select2" name="material_id[]" required>
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
                                                        <div class="form-group mg-b-0 ">
                                                            <input class="form-control price" name="price[]" value="" type="text" placeholder="0.0 " required min="0">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group mg-b-0 ">
                                                            <input class="form-control Quantity" name="Quantity[]" value="" type="text" placeholder=" 0.0" required min="0">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group mg-b-0 ">
                                                            <input class="form-control matarial_total" name="matarial_total[]" value="" type="text" placeholder=" 0.0" required readonly="readonly">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4" class="text-left">المجموع</td>
                                                    <td>
                                                        <input class="form-control sub_total" name="sub_total" required type="text" placeholder=" 0.0" readonly="readonly">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-left">خصم</td>
                                                    <td>
                                                        <input class="form-control discount" name="discount"  type="text" placeholder=" 0.0">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-left">المجموع بعد الخصم</td>
                                                    <td>
                                                        <input class="form-control sub_total_disc" name="sub_total_disc" required type="text" placeholder=" 0.0" readonly="readonly">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-left">نسبة الضريبة</td>
                                                    <td>
                                                        <input class="form-control rate_vat" name="rate_vat" type="text" placeholder=" 0.0">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-left">قيمة الضريبة</td>
                                                    <td>
                                                        <input class="form-control value_vat" name="value_vat"  type="text" placeholder=" 0.0" readonly="readonly">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-left">أجمالي الفاتورة</td>
                                                    <td>
                                                        <input class="form-control total"  name="total" required type="text" placeholder=" 0.0" readonly="readonly">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="text-left">ملاحظات الفاتورة</td>
                                                    <td colspan="3">
                                                        <textarea name="note" cols="100" spellcheck="true" rows="2"></textarea>
                                                    </td>
                                                </tr>
                                            </tfoot>
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
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
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
        $("tbody").delegate(".price,.Quantity",'keyup',function(){
            var tr = $(this).parent().parent().parent();
            var quantity = tr.find('.Quantity').val();
            var price = tr.find('.price').val();
            var matarialTotal = (quantity * price);
            tr.find(".matarial_total").val(matarialTotal);
            subTotal();
            discount();
            vat();
            total();
        });
        $(".discount").on("keyup",function(){
            discount();
            vat();
            total();
        });
        $(".rate_vat").on("keyup",function(){
            vat();
            total();
        });
        function subTotal(){
            var total = 0;
            $(".matarial_total").each(function(i,e){
                var subtotal = $(this).val()-0;
                total += subtotal;
            });
            $(".sub_total").val(total);
        }

        function discount(){
            var disc = ($('.sub_total').val()-0) - ($(".discount").val()-0);
            $(".sub_total_disc").val(disc);
        }

        function vat(){
            var vat = ($('.sub_total_disc').val()-0) * ($(".rate_vat").val()-0);

            $(".value_vat").val(vat);
        }

        function total(){
            var total = ($(".sub_total_disc").val()-0) + ($(".value_vat").val()-0);
            $(".total").val(total);
        }
        $('body').on('click','.remove',function(e){
            e.preventDefault();
            var last = $("tbody tr").length;
            if(last == 1){
                notif({
                    msg: " خطأ يجب ان يوجد عدد واحد من الخامة",
                    type: "error"
                });
            }else{
                $(this).parent().parent().remove();
                subTotal();
                discount();
                vat();
                total();
            }
        });


        $('#add').on('click',function(e){
            e.preventDefault();
            addRow();
        });
        function addRow(){
            var tr = '<tr>' +
            '<td style="width: 2%"  class="text-center"><a href="#" class="btn btn-sm btn-danger remove">x</a></td>'+
            '<td scope="row"><div class="form-group mg-b-0"><select class="form-control select2" name="material_id[]" required=""><option label="أختار الخامة"></option>@foreach ($materials as $material)<option value="{{$material->id}}">{{$material->materials_name}} - > {{$material->unit->unit_name}}</option>@endforeach</select><div id="slErrorContainer"></div></div></td>'+
            '<td><div class="form-group mg-b-0 "><input class="form-control price" name="price[]" value="" type="text" placeholder="0.0 " required min="0"></div></td>'+
            '<td><div class="form-group mg-b-0 "><input class="form-control Quantity" name="Quantity[]" value="" type="text" placeholder=" 0.0" required min="0"></div></td>'+
            '<td><div class="form-group mg-b-0 "><input class="form-control matarial_total" name="matarial_total[]" value="" type="text" placeholder=" 0.0" readonly="readonly"></div></td>'+
            '</tr>';
            $("tbody").append(tr);
        }
    });
</script>
@endsection
