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
                    </div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
                <!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
                                    <a class="mx-1 modal-effect btn btn-outline-primary" href="{{ url('/' . $page='invoices/create') }}">اضافة فاتورة مشتريات</a>
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
                                                            <tr>
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
                                                                            <a class="dropdown-item" title="تعديل"  ><i class="text-secondary far fa-edit"></i>&nbsp;&nbsp;تعديل</a>
                                                                            <a class="dropdown-item" data-effect="effect-scale"  data-toggle="modal" title="حذف" href="#modaldemo8" ><i class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف</a>
                                                                            <a class="dropdown-item"  title="عرض الملف" href="{{ route("invoices.show",$invoice->id) }}"><i class="text-success far fa-eye"></i>&nbsp;&nbsp;عرض</a>
                                                                            <a class="dropdown-item"  title="عرض الملف" ><i class="text-warning fas fa-print"></i>&nbsp;&nbsp;طباعة</a>
                                                                            <a class="dropdown-item"  title="عرض الملف" ><i class="text-success far fa-file-excel"></i>&nbsp;&nbsp;تقرير</a>
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
                                                                <td>{{number_format($invoice->rate_vat,4)}}</td>
                                                                <td>{{number_format($invoice->value_vat,3)}}</td>
                                                                <td>{{number_format($invoice->total,2)}}</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button aria-expanded="false" aria-haspopup="true"
                                                                            class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                                            type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                                        <div class="dropdown-menu tx-13">
                                                                            <a class="dropdown-item" title="تعديل"  ><i class="text-secondary far fa-edit"></i>&nbsp;&nbsp;تعديل</a>
                                                                            <a class="dropdown-item" data-effect="effect-scale"  data-toggle="modal" title="حذف" href="#modaldemo8" ><i class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف</a>
                                                                            <a class="dropdown-item"  title="عرض الملف" href="{{ route("invoices.show",$invoice->id) }}"><i class="text-success far fa-eye"></i>&nbsp;&nbsp;عرض</a>
                                                                            <a class="dropdown-item"  title="عرض الملف" ><i class="text-warning fas fa-print"></i>&nbsp;&nbsp;طباعة</a>
                                                                            <a class="dropdown-item"  title="عرض الملف" ><i class="text-success far fa-file-excel"></i>&nbsp;&nbsp;تقرير</a>
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
@endsection
