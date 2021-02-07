@extends('layouts.master')
@section('title')
     فاتورة المشتريات - مصنع ايام زمان
@stop
@section('css')
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-md-12 col-xl-12">
						<div class=" main-content-body-invoice" id="print">
							<div class="card card-invoice">
								<div class="card-body">
									<div class="invoice-header">
                                        <div class="col-md text-left">
                                            <img class="wd-200" src="{{URL::asset('assets/img/brand/ayamzaman.svg')}}" alt="">
                                        </div>
										<div class="col-md">
											<label class="tx-gray-600">معلومات الفاتورة</label>
											<p class="invoice-info-row"><span>فاتورة رقم</span> <span>{{ $invoice->id }}</span></p>
											<p class="invoice-info-row"><span>كود المورد</span> <span>{{ $invoice->supplier->id }}</span></p>
											<p class="invoice-info-row"><span>اسم المورد</span> <span>{{ $invoice->supplier->supplier_name }}</span></p>
											<p class="invoice-info-row"><span>تاريخ الفاتورة</span> <span>{{ $invoice->invoice_Date }}</span></p>
											<p class="invoice-info-row"><span>المخزن</span> <span>{{ $invoice->store->stores_name }}</span></p>
										</div>
									</div>
									<div class="table-responsive mg-t-40">
										<table class="table table-invoice border text-md-nowrap mb-0">
											<thead>
												<tr class="text-center">
                                                    <th class="wd-5p">#</th>
                                                    <th class="wd-25p">اسم الخامة</th>
                                                    <th class="wd-5p">وحدة القياس</th>
													<th class="wd-5p">الكمية</th>
													<th class="wd-5p">سعر الوحدة</th>
													<th class="wd-5p">المجموع</th>

												</tr>
											</thead>
											<tbody>
                                                <?php $i=0;?>
                                                @foreach ($invoice->purches  as $key => $item)
                                                <?php $i++?>
                                                <tr class="text-center">
													<td>{{ $i }}</td>
                                                    <td>{{ $item->material->materials_name }}</td>
                                                    <td>{{ $item->material->unit->unit_name}}</td>
													<td>{{ number_format($item->Quantity,2) }}</td>
													<td>{{ number_format($item->price,2) }} ج.م</td>
													<td>{{ number_format($item->matarial_total,2) }} ج.م</td>
												</tr>
                                                @endforeach
												<tr>
													<td class="valign-middle" colspan="3" rowspan="5">
														<div class="invoice-notes">
															<label class="main-content-label tx-13">ملاحظات علي الفاتورة</label>
															<p class="text-bold text-success">{{ $invoice->note }}</p>
														</div><!-- invoice-notes -->
													</td>
													<td  class="tx-right" colspan="2">أجمالي المجموع</td>
													<td class="tx-left" colspan="1">{{number_format($invoice->sub_total,2)}} ج.م</td>
                                                </tr>
                                                <tr>
													<td class="tx-right" colspan="2">خصم</td>
													<td class="tx-left" colspan="1">-{{number_format($invoice->discount,2)}} ج.م</td>
                                                </tr>
                                                <tr>
													<td class="tx-right" colspan="2">الاجمالي بعد الخصم</td>
													<td class="tx-left" colspan="1">{{number_format($invoice->sub_total_disc,2)}} ج.م</td>
												</tr>
												<tr>
													<td class="tx-right" colspan="2">ضريبة ({{ $invoice->rate_vat * 100 }}%)</td>
													<td class="tx-left" colspan="1">{{number_format($invoice->value_vat,2)}} ج.م</td>
												</tr>
												<tr>
													<td class="tx-right tx-uppercase tx-bold tx-inverse" colspan="2">اجمالي الفاتورة</td>
													<td class="tx-left" colspan="1">
														<h4 class="tx-primary tx-bold">{{number_format($invoice->total,2)}} ج.م</h4>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
                                    <hr class="mg-b-40" >
                                    <div id="buttons">
                                        <a class="btn btn-purple float-left mt-3 mr-2" href="{{ route("invoices.edit",$invoice->id) }}">
                                            <i class="fas fa-edit ml-1"></i>تعديل الفاتورة
                                        </a>
                                        <a class="btn btn-danger float-left mt-3 mr-2" data-effect="effect-scale"  data-toggle="modal" title="حذف" href="#modaldemo8">
                                            <i class="fas fa-trash-alt ml-1"></i>حذف الفاتورة
                                        </a>
                                        <a href="#" id="printDiv" class="btn btn-warning float-left mt-3 mr-2">
                                            <i class="mdi mdi-printer ml-1"></i>طباعة الفاتورة
                                        </a>
                                        <a href="{{ route("invoices.index") }}" class="btn btn-success float-left mt-3">
                                            <i class="fas fa-undo ml-1"></i>الرجوع للقائمة
                                        </a>
                                    </div>
								</div>
							</div>
						</div>
                        <!-- Modal effects -->
                        <div class="modal" id="modaldemo8">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">حذف فاتورة</h6><button aria-label="Close" class="close"
                                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form action="{{ route('invoices.destroy','test') }}" method="post">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                            <input type="hidden" name="id" value="{{$invoice->id}}">
                                            <label>فاتورة رقم</label>
                                            <input class="form-control mg-b-5" value="{{$invoice->id}}" type="text" readonly>
                                            <label>اسم المورد</label>
                                            <input class="form-control  mg-b-5" value="{{$invoice->supplier->supplier_name}}" type="text" readonly>
                                            <label>قيمة الفاتورة</label>
                                            <input class="form-control mg-b-5" value="{{number_format($invoice->total,2)}}" type="text" readonly>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                            <button type="submit" class="btn btn-danger">تاكيد</button>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
					</div><!-- COL-END -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script>
	$(document).ready(function() {
        $("#printDiv").on('click',function(){
            var printContents = document.getElementById("print").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        });
    });
</script>
@endsection
