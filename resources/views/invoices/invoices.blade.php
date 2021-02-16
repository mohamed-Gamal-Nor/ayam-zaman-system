@extends('layouts.master')
@section('title')
     قائمة الفواتير - مصنع ايام زمان
@stop
@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">مشتريات الموردين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الفواتير</span>
						</div>
                    </div>
                    <div class="d-flex my-xl-auto right-content">
                        <div>
                            <label class="pr-1 mb-3 mb-xl-0 mx-2">عدد الفواتير</label>
                            <h5 class="text-center text-success">{{ $invoicesCount }}</h5>
                        </div>
                        <div>
                            <label class="pr-1 mb-3 mb-xl-0 mx-2">أجمالي الفواتير</label>
                            <h5 class="text-center text-primary">{{ number_format($invoicesSum,2) }}</h5>
                        </div>
                    </div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
                @if (session()->has('delete'))
                    <script>
                        window.onload = function() {
                            notif({
                                msg: " تم حذف الفاتورة بنجاح",
                                type: "success"
                            });
                        }
                    </script>
                @endif
				<!-- row -->
				<div class="row row-sm">
                <!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-start">
                                    @can("اضافة فاتورة مشتريات")
                                        <a class="mx-1 btn btn-outline-primary" href="{{ route('invoices.create') }}">اضافة فاتورة مشتريات</a>
                                    @endcan
                                    @can("تصديرأكسيل")
                                        <a class="mx-1  btn btn-outline-primary" href="{{ url('/'.$page ='invoices/invoicesExport') }}">تصدير أكسيل للفواتير</a>
                                    @endcan
                                    <a class="mx-1  modal-effect btn btn-primary" data-effect="effect-scale" data-toggle="modal" href="#select2modal">بحث</a>
							    </div>
                                <div class="panel panel-primary tabs-style-2 mg-t-10 mg-b-5">
                                    <div class=" tab-menu-heading">
                                        <div class="tabs-menu1">
                                            <!-- Tabs -->
                                            <ul class="nav panel-tabs main-nav-line">
                                                <li><a href="#tab4" class="nav-link active" data-toggle="tab">رئيسي</a></li>
                                                <li><a href="#tab5" class="nav-link" data-toggle="tab">تفاصيل الفواتير</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body tabs-menu-body main-content-body-right border">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab4">
                                                <div class="table-responsive">
                                                    <table id="example2" class="table key-buttons text-md-nowrap" data-page-length='50'>
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th class="border-bottom-0">#</th>
                                                                <th class="border-bottom-0">رقم الفاتورة</th>
                                                                <th class="border-bottom-0">تاريخ الفاتورة</th>
                                                                <th class="border-bottom-0">اسم المورد</th>
                                                                <th class="border-bottom-0">المخزن</th>
                                                                <th class="border-bottom-0">اجمالي الفاتورة</th>
                                                                <th class="border-bottom-0">أنشأ بواسطة</th>
                                                                <th class="border-bottom-0">العمليات</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i=0;?>
                                                            @foreach ($invoices  as $key => $invoice)
                                                            <?php $i++?>
                                                            <tr class="text-center">
                                                                <td>{{$i}}</td>
                                                                <td>{{$invoice->id}}</td>
                                                                <td>{{$invoice->invoice_Date}}</td>
                                                                <td>{{$invoice->supplier->supplier_name}}</td>
                                                                <td>{{$invoice->store->stores_name}}</td>
                                                                <td>{{number_format($invoice->total,2)}}</td>
                                                                <td>{{$invoice->created_by}}</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button aria-expanded="false" aria-haspopup="true"
                                                                            class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                                            type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                                        <div class="dropdown-menu tx-13">
                                                                            @can("تعديل فاتورة مشتريات")
                                                                            <a class="dropdown-item" title="تعديل" href="{{route("invoices.edit",$invoice->id)}}" ><i class="text-secondary far fa-edit"></i>&nbsp;&nbsp;تعديل</a>
                                                                            @endcan
                                                                            @can("حذف فاتورة مشتريات")
                                                                            <a class="dropdown-item" data-effect="effect-scale"  data-toggle="modal" title="حذف" href="#modaldemo8" data-id="{{$invoice->id}}" data-supplier="{{$invoice->supplier->supplier_name}}" data-total="{{number_format($invoice->total,2)}}"><i class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف</a>
                                                                            @endcan
                                                                            @can("عرض فاتورة مشتريات")
                                                                            <a class="dropdown-item"  title="عرض الملف" href="{{ route("invoices.show",$invoice->id) }}"><i class="text-success far fa-eye"></i>&nbsp;&nbsp;عرض</a>
                                                                            @endcan
                                                                            @can("تصديرأكسيل")
                                                                            <a class="dropdown-item"  title="عرض الملف" href="{{ url('/'.$page ='invoices/export/'. $invoice->id) }}"><i class="text-warning far fa-file-excel"></i>&nbsp;&nbsp;تقرير أكسيل</a>
                                                                            @endcan
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab5">
                                                <div class="table-responsive">
                                                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                                                        <thead>
                                                            <tr>
                                                                <th class="border-bottom-0">#</th>
                                                                <th class="border-bottom-0">رقم الفاتورة</th>
                                                                <th class="border-bottom-0">المجموع قبل الخصم</th>
                                                                <th class="border-bottom-0">الخصم</th>
                                                                <th class="border-bottom-0">المجموع بعد الخصم</th>
                                                                <th class="border-bottom-0">نسبة الضريبة</th>
                                                                <th class="border-bottom-0">قيمة الضريبة</th>
                                                                <th class="border-bottom-0">الاجمالي</th>
                                                                <th class="border-bottom-0">العمليات</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i=0;?>
                                                            @foreach ($invoices  as $key => $invoice)
                                                            <?php $i++?>
                                                            <tr class="text-center">
                                                                <td>{{$i}}</td>
                                                                <td>{{$invoice->id}}</td>
                                                                <td>{{number_format($invoice->sub_total,2)}}</td>
                                                                <td>{{number_format($invoice->discount,2)}}</td>
                                                                <td>{{number_format($invoice->sub_total_disc,2)}}</td>
                                                                <td>%{{number_format($invoice->rate_vat,4)*100}}</td>
                                                                <td>{{number_format($invoice->value_vat,3)}}</td>
                                                                <td>{{number_format($invoice->total,2)}}</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button aria-expanded="false" aria-haspopup="true"
                                                                            class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                                            type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                                        <div class="dropdown-menu tx-13">
                                                                            @can("تعديل فاتورة مشتريات")
                                                                            <a class="dropdown-item" title="تعديل" href="{{route("invoices.edit",$invoice->id)}}" ><i class="text-secondary far fa-edit"></i>&nbsp;&nbsp;تعديل</a>
                                                                            @endcan
                                                                            @can("حذف فاتورة مشتريات")
                                                                            <a class="dropdown-item" data-effect="effect-scale"  data-toggle="modal" title="حذف" href="#modaldemo8" data-id="{{$invoice->id}}" data-supplier="{{$invoice->supplier->supplier_name}}" data-total="{{number_format($invoice->total,2)}}"><i class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف</a>
                                                                            @endcan
                                                                            @can("عرض فاتورة مشتريات")
                                                                            <a class="dropdown-item"  title="عرض الملف" href="{{ route("invoices.show",$invoice->id) }}"><i class="text-success far fa-eye"></i>&nbsp;&nbsp;عرض</a>
                                                                            @endcan
                                                                            @can("تصديرأكسيل")
                                                                            <a class="dropdown-item"  title="عرض الملف" href="{{ url('/'.$page ='invoices/export/'. $invoice->id) }}"><i class="text-warning far fa-file-excel"></i>&nbsp;&nbsp;تقرير أكسيل</a>
                                                                            @endcan
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
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
                                                    <input type="hidden" name="id" id="id" value="">
                                                    <label>فاتورة رقم</label>
                                                    <input class="form-control mg-b-5" name="" id="id_invoice" type="text" readonly>
                                                    <label>اسم المورد</label>
                                                    <input class="form-control  mg-b-5" name="" id="supplier" type="text" readonly>
                                                    <label>قيمة الفاتورة</label>
                                                    <input class="form-control mg-b-5" name="" id="total" type="text" readonly>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                                    <button type="submit" class="btn btn-danger">تاكيد</button>
                                                </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Basic modal -->
                                <div class="modal" id="select2modal">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{url("invoices/search")}}" method="POST">
                                            @method("get")
                                            @csrf
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">بحث عن فواتير</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mg-b-5">
                                                        <h6>اسم المورد</h6>
                                                        <!-- Select2 -->
                                                        <select class="form-control select2-show-search select2-dropdown" name="supplier">
                                                            <option label="Choose one">
                                                            </option>
                                                            @foreach ($suppliers as $supplier)
                                                                <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <!-- Select2 -->
                                                    </div>
                                                    <div class="mg-b-5">
                                                        <h6>من تاريخ</h6>
                                                        <!-- Select2 -->
                                                        <input class="form-control" type="date" name="start">
                                                        <!-- Select2 -->
                                                    </div>
                                                    <div class="mg-b-5">
                                                        <h6>الي تاريخ</h6>
                                                        <!-- Select2 -->
                                                        <input class="form-control" type="date" name="end">
                                                        <!-- Select2 -->
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn ripple btn-primary" type="submit">بحث</button>
                                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">أغلاق</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Basic modal -->
						</div>
					</div>
					<!--/div-->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<script>
    $('#modaldemo8').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var supplier = button.data('supplier')
        var total = button.data('total')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #id_invoice').val(id);
        modal.find('.modal-body #supplier').val(supplier);
        modal.find('.modal-body #total').val(total);
    })
</script>
@endsection
