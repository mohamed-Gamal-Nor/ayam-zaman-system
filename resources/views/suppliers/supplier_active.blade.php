@extends('layouts.master')
@section('title')
    قائمة الموردين المفعلين / غير مفعلين - سنتر ايام زمان
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الموردين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الموردين المفعلين / غير مفعلين</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
                @if (session()->has('edit'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('edit') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-right">
									<a class="mx-1 modal-effect btn btn-outline-primary" href="{{ url('/' . $page='suppliers/create') }}">اضافة مورد</a>
									<a class="mx-1 modal-effect btn btn-outline-primary" href="{{ url('/' . $page='suppliers/active') }}">موردين فعالين</a>
									<a class="mx-1 modal-effect btn btn-outline-primary" href="{{ url('/' . $page='suppliers/notactive') }}">موردين موقوفين</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example2" class="table key-buttons text-md-nowrap table-hover" data-page-length='50'>
										<thead>
											<tr class="table-secondary">
                                                <th class="border-bottom-0">#</th>
												<th class="border-bottom-0">اسم المورد</th>
                                                <th class="border-bottom-0">الهاتف</th>
                                                <th class="border-bottom-0">اسم المستفيد</th>
                                                <th class="border-bottom-0">الحالة</th>
                                                <th class="border-bottom-0"> العمليات</th>
											</tr>
										</thead>
										<tbody>
                                            <?php $i=0;?>
                                            @foreach ($suppliers  as $key => $supplier)
                                                <?php $i++?>
                                                <tr class="text-center">
                                                    <td >{{$i}}</td>
                                                    <td >{{$supplier->supplier_name}}</td>
                                                    <td >{{$supplier->supllier_phone }}</td>
                                                    <td >{{$supplier->Beneficiary_name }}</td>
                                                    <td >
                                                        @if($supplier->status == 'مفعل')
                                                            <span class="label text-success d-flex"><div class="dot-label bg-success ml-1"></div>{{$supplier->status }}</span>
                                                        @elseif($supplier->status == 'غير مفعل')
                                                            <span class="label text-danger d-flex"><div class="dot-label bg-danger ml-1"></div>{{$supplier->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="modal-effect btn btn-sm btn-info" title="تعديل"  href="{{ route('suppliers.edit', $supplier->id) }}">تعديل</a>
                                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-supplier_id="{{ $supplier->id }}" data-supplier_name="{{$supplier->supplier_name}}" data-toggle="modal" title="حذف" href="#modaldemo8" >حذف</a>
                                                        <a class="modal-effect btn btn-sm btn-success"  title="عرض الملف" href="{{ route('suppliers.show', $supplier->id) }}">عرض</a>
                                                        @if($supplier->status == 'مفعل')
                                                            <a class="modal-effect btn btn-sm btn-warning"  title="تعطيل" href="{{ url('suppliers/suppliersDisable/'.$supplier->id) }}">تعطيل</a>
                                                        @elseif($supplier->status == 'غير مفعل')
                                                            <a class="modal-effect btn btn-sm btn-secondary"  title="تفعيل" href="{{ url('suppliers/suppliersActive/'.$supplier->id)}}">تفعيل</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

										</tbody>
									</table>
								</div>
							</div>
						</div>
                    </div>
                        <!-- Modal effects -->
                        <div class="modal" id="modaldemo8">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">حذف المستخدم</h6><button aria-label="Close" class="close"
                                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form action="{{ route('suppliers.destroy','test') }}" method="post">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                            <input type="hidden" name="supplier_id" id="supplier_id" value="">
                                            <input class="form-control" name="supplier_name" id="supplier_name" type="text" readonly>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                            <button type="submit" class="btn btn-danger">تاكيد</button>
                                        </div>
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
<!-- Internal Data tables -->
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
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script>
    $('#modaldemo8').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var supplier_id = button.data('supplier_id')
        var supplier_name = button.data('supplier_name')
        var modal = $(this)
        modal.find('.modal-body #supplier_id').val(supplier_id);
        modal.find('.modal-body #supplier_name').val(supplier_name);
    })
</script>
@endsection
