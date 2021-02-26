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
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
<style>
    @media print{
        @page{
            margin: 0;
        }
        #buttons{
            display: none;
        }
    }
    </style>
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
                                            <div class="spinner-border " role="status" id="supplier_loading">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
						</div>
                        <div id="card">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="d-flex justify-content-between">
                                        <div class=" col-lg-3">
                                            <p class="invoice-info-row"><span>رصيد بداية المدة </span> <span class="text-right text-success" id='supplierbalance'></span></p>
                                            <p class="invoice-info-row"><span>اسم المورد </span> <span class="text-right text-primary" id='supplier_name'></span></p>
                                            <p class="invoice-info-row"><span>من الفترة </span> <span class="text-right text-warning" id='start_date'></span></p>
                                            <p class="invoice-info-row"><span>الي الفترة </span> <span class="text-right text-warning" id='end_date'></span></p>
                                        </div>
                                        <div class=" col-lg-3">
                                            <p class="invoice-info-row"><span>اجمالي مشتريات خلال الفترة</span> <span class="text-right text-success" id='totalInvoices'></span></p>
                                            <p class="invoice-info-row"><span>اجمالي مرتجعات خلال الفترة</span> <span class="text-right text-danger" id='totalReturn'></span></p>
                                            <p class="invoice-info-row"><span>اجمالي السداد خلال الفترة</span> <span class="text-right text-danger" id='totalPay'></span></p>
                                            <p class="invoice-info-row"><span>صافي الرصيد </span> <span class="text-right text-success" id='balance'></span></p>
                                        </div>
                                        <div class="col-lg-6 text-left">
                                            <img class="wd-150" src="{{URL::asset('assets/img/brand/ayamzaman.svg')}}" alt="">
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0 text-md-nowrap">
                                            <thead>
                                                <tr class="text-center">
                                                    <th class="border-bottom-0">التاريخ</th>
                                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                                    <th class="border-bottom-0">الحالة</th>
                                                    <th class="border-bottom-0">مدين</th>
                                                    <th class="border-bottom-0">دائن</th>
                                                    <th class="border-bottom-0">الرصيد</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr class="mg-b-40" >
                                    <div id="buttons">
                                        <a class="btn btn-pink float-left mt-3 mr-2" href="">
                                            <i class="fas fa-file-excel"></i>  تقرير أكسيل
                                        </a>
                                        <a href="#" id="printDiv" class="btn btn-warning float-left mt-3 mr-2">
                                            <i class="mdi mdi-printer ml-1"></i>طباعة الكشف
                                        </a>
                                    </div>
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
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<script>
    $(document).ready(function() {
        var $loading = $('#supplier_loading').hide();
        $('select[name="supplier_id"]').on('change', function() {
            $(document).ajaxStart(function () {
                $loading.show();
                }).ajaxStop(function () {
                    $loading.hide();
                });
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
        var $card = $('#card').hide();
        $("#form_statment").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var supplierId = $('select[name="supplier_id"]').val();
            var start = $('input[name="start"]').val();
            var end = $('input[name="end"]').val();
            if(end < start){
                notif({
                    msg: " خطأ لايجب ان يكون تاريخ النهاية اقدم من تاريخ البداية",
                    type: "error"
                });
            }else{
                if (supplierId) {
                $.ajax({
                    type: "POST",
                    url: "{{ URL::to('getStatement') }}/" + supplierId,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        
                        var sumInvoicesBalance = data['sumInvoicesBalance'];
                        var sumInvoicesReturnsBalance = data['sumInvoicesReturnsBalance'];
                        var supplierBalance = data['supplierBalance'];
                        var startBalance;
                        if(start == ''){
                            startBalance = data['supplier'][0]['start_balance'];
                        }else{
                            startBalance = (supplierBalance + sumInvoicesBalance) - sumInvoicesReturnsBalance;
                        }
                        

                        $('#supplierbalance').empty();
                        $('#supplierbalance').text(startBalance);
                        $('#supplier_name').empty();
                        $('#supplier_name').text(data['supplier'][0]['supplier_name']);
                        $('#start_date').empty();
                        $('#start_date').text(data['start']);
                        $('#end_date').empty();
                        $('#end_date').text(data['end']);
                        $('#totalInvoices').empty();
                        $('#totalInvoices').text(data['invoicesSum']);
                        $('#totalReturn').empty();
                        $('#totalReturn').text(data['invoicesReturns']);
                        $("tbody").empty();
                        var statment;
                        var Debit;
                        var Credite;
                        var classNotif;
                        $.each(data['statment'],function(index){
                            if(data['statment'][index]['statment'] === 1)
                            {
                                statment = "فاتورة مشتريات";
                                Debit = 0;
                                Credite = data['statment'][index]['total'];
                                startBalance +=Credite;
                                classNotif = "text-success";
                            }else if(data['statment'][index]['statment'] === 0){
                                statment = "فاتورة مرتجع";
                                Credite = 0;
                                Debit = data['statment'][index]['total'];
                                startBalance -=Debit;
                                classNotif = "text-danger";
                            }
                            var tr =
                                '<tr class="text-center">'+
                                    '<td>'+data['statment'][index]['invoice_Date']+'</td>'+
                                    '<td>'+data['statment'][index]['id']+'</td>'+
                                    '<td>'+ statment +'</td>'+
                                    '<td>'+ Debit +'</td>'+
                                    '<td>'+ Credite +'</td>'+
                                    '<td class="'+ classNotif +'">'+ startBalance +'</td>'+
                                '</tr>';
                            $("tbody").append(tr);
                        });
                        $("#balance").text(startBalance);
                        $card.show();
                        console.log(data);
                    },
                    error : function(err) {
                        console.log('Error!', err);
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
            }
        });
        $("#printDiv").on('click',function(){
            var printContents = document.getElementById("card").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        });
    });
</script>
@endsection
