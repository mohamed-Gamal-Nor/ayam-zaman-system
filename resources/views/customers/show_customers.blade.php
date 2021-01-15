@extends('layouts.master')
@section('title')
    قائمة العملاء - مصنع ايام زمان
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة العملاء</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
                @if (session()->has('successDestroy'))
                <script>
                    window.onload = function() {
                        notif({
                            msg: " تم حذف العميل بنجاح",
                            type: "error"
                        });
                    }
                </script>
                @endif

                @if (session()->has('successSoft'))
                <script>
                    window.onload = function() {
                        notif({
                            msg: " تم حذف العميل بنجاح",
                            type: "error"
                        });
                    }
                </script>
                @endif

                @if (session()->has('successBackSoft'))
                <script>
                    window.onload = function() {
                        notif({
                            msg: " تم أسترجاع العميل بنجاح",
                            type: "error"
                        });
                    }
                </script>
                @endif
				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-right">
                                    @can('اضافةعميل')
                                    <a class="mx-1 modal-effect btn btn-outline-primary" href="{{ url('/' . $page='customers/create') }}">اضافة عميل</a>
                                    @endcan
                                    @can('تصديرأكسيل')
                                        <a class="mx-1 modal-effect btn btn-outline-primary" href="{{ url('/' . $page ='customers/export') }}"><i class="fas fa-file-download"></i>&nbsp;تصدير اكسيل</a>
                                    @endcan
                                    @can('عملاء محذوفين')
                                    <a class="mx-1 modal-effect btn btn-outline-primary" href="{{ url('/' . $page='customers/trashedCustomers') }}">عملاء محذوفين</a>
                                    @endcan
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example2" class="table key-buttons text-md-nowrap table-hover" data-page-length='50'>
										<thead>
											<tr class="table-secondary text-center">
                                                <th class="border-bottom-0">#</th>
												<th class="border-bottom-0">اسم العميل</th>
                                                <th class="border-bottom-0">البريد الالكتروني</th>
                                                <th class="border-bottom-0">الهاتف</th>
                                                <th class="border-bottom-0">العنوان</th>
                                                <th class="border-bottom-0">النوع</th>
                                                <th class="border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
                                            <?php $i=0;?>
                                            @foreach ($customers  as $key => $customer)
                                                <?php $i++?>
                                                <tr class="text-center">
                                                    <td >{{$i}}</td>
                                                    <td >{{$customer->customers_name}}</td>
                                                    <td >{{$customer->email }}</td>
                                                    <td >{{$customer->customers_phone }}</td>
                                                    <td >{{$customer->customers_address }}</td>
                                                    <td >{{$customer->customers_gender}}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button aria-expanded="false" aria-haspopup="true"
                                                                class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                                type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                            <div class="dropdown-menu tx-13">
                                                                @can('تعديل عميل')
                                                                <a class="dropdown-item" title="تعديل"  href="{{ route('customers.edit', $customer->id) }}"><i class="text-secondary far fa-edit"></i>&nbsp;&nbsp;تعديل</a>
                                                                @endcan
                                                                @can('حذف عميل')
                                                                <a class="dropdown-item" data-effect="effect-scale" data-customer_id="{{ $customer->id }}" data-customer="{{ $customer->customers_name }}" data-toggle="modal" title="حذف" href="#modaldemo8" ><i class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف</a>
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
                        <!-- Modal effects -->
                        <div class="modal" id="modaldemo8">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">حذف المستخدم</h6><button aria-label="Close" class="close"
                                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form action="{{ route('softDelete','test') }}" method="post">
                                        @method('GET')
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                            <input type="hidden" name="customer_id" id="customer_id" value="">
                                            <input class="form-control" name="customer" id="customer" type="text" readonly>
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
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<script>
    $('#modaldemo8').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var customer_id = button.data('customer_id')
        var customer = button.data('customer')
        var modal = $(this)
        modal.find('.modal-body #customer_id').val(customer_id);
        modal.find('.modal-body #customer').val(customer);
    })
</script>
@endsection
