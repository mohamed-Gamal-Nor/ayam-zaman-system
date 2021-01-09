@extends('layouts.master')
@section('title')
    قائمة السلف - مصنع ايام زمان
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
							<h4 class="content-title mb-0 my-auto">رواتب و سلف الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة السلف</span>
                        </div>
                    </div>
                    <div class="d-flex my-xl-auto right-content">
                        <div>
                            <label class="pr-1 mb-3 mb-xl-0 mx-2">عدد الحركات</label>
                            <h5 class="text-center text-success">{{ $advancePaymentCount }}</h5>
                        </div>
                        <div>
                            <label class="pr-1 mb-3 mb-xl-0">الاجمالي</label>
                            <h5 class="text-center text-success">{{number_format($advancePaymentSum, 2) }}</h5>
                        </div>
                    </div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('delete'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('delete') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

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
                                    <a class="mx-1 modal-effect btn btn-outline-primary" href="{{ url('/' . $page='advancePayment/create') }}">اضافة سلفة</a>
                                    <a class="mx-1 modal-effect btn btn-success" data-target="#select2modal" data-toggle="modal" href="">بحث</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example2" class="table key-buttons text-md-nowrap table-hover" data-page-length='50'>
										<thead>
											<tr class="table-secondary text-center">
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">كود البصمة</th>
												<th class="border-bottom-0">اسم الموظف</th>
                                                <th class="border-bottom-0">قيمة السلفة</th>
                                                <th class="border-bottom-0">تاريخ السلفة</th>
                                                <th class="border-bottom-0">أنشا بواسطه</th>
                                                <th class="border-bottom-0">الحاله</th>
                                                <th class="border-bottom-0">العمليات</th>
											</tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=0;?>
                                            @foreach ($advancePayment  as $key => $ap)
                                                <?php $i++?>
                                                <tr class="text-center">
                                                    <td >{{$i}}</td>
                                                    <td >{{$ap->employees->employees_finger}}</td>
                                                    <td >{{$ap->employees->employees_name}}</td>
                                                    <td >{{ number_format($ap->ap_value, 2) }}</td>
                                                    <td >{{$ap->ap_date }} </td>
                                                    <td >{{$ap->created_by }}</td>
                                                    <td >
                                                        @if($ap->stauts == 0)
                                                            <span class="label text-danger d-flex"><div class="dot-label bg-danger ml-1"></div>لم تخصم</span>
                                                        @elseif($ap->stauts == 1)
                                                            <span class="label text-success d-flex"><div class="dot-label bg-success ml-1"></div>تم الخصم</span>
                                                        @endif
                                                    </td>
                                                    <td style="width: 23%">
                                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                        data-ap_id="{{ $ap->id }}" data-employees_name="{{ $ap->employees->employees_name }}"
                                                        data-ap_value="{{ $ap->ap_value }}" data-toggle="modal"
                                                        title="تعديل"   href="#exampleModal2" >تعديل</a>
                                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-ap_id="{{ $ap->id }}" data-ap_name="{{ $ap->ap_value }}" data-toggle="modal" title="حذف" href="#modaldemo8" >حذف</a>

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
                                    <form action="{{ route('advancePayment.destroy','test') }}" method="post">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                            <input type="hidden" name="ap_id" id="ap_id" value="">
                                            <input class="form-control" name="ap_name" id="ap_name" type="text" readonly>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                            <button type="submit" class="btn btn-danger">تاكيد</button>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <!-- edit -->
                        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل السلفة</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="advancePayment/update" method="post" autocomplete="off">
                                            {{ method_field('patch') }}
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <input type="hidden" name="ap_id" id="ap_id" value="">
                                                <label for="recipient-name" class="col-form-label">اسم الموظف:</label>
                                                <input class="form-control" name="employees_name" id="employees_name" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">قيمة السلفة:</label>
                                                <input type="number" min="1" class="form-control" id="ap_value" name="ap_value" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">تاكيد</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Basic modal -->
                        <div class="modal" id="select2modal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">بحث عن سلفة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form action="{{ url('advancePayment/search') }}" method="POST" autocomplete="off">
                                        <div class="modal-body">
                                            <h6>املاء البيانات الاتية</h6>
                                            @method('get')
                                            @csrf
                                            <div class="card-header">
                                                <div class="form-group">
                                                    <p class="mg-b-10">اختار الموظف</p>
                                                    <select class="form-control select2 d-block" name="employees_id">
                                                        <option label="اسم الموظف">
                                                        </option>
                                                        @foreach ($employees  as $key => $employee)
                                                        <option value="{{ $employee->id }}">
                                                            {{ $employee->employees_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">اختار حالة الخصم</p>
                                                    <select class="form-control select2-no-search d-block" name="status">
                                                        <option label="حالة الخصم">
                                                        </option>
                                                        <option value="1">تم خصمها</option>
                                                        <option value="0">لم يتم خصمها</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>من تاريخ</label>
                                                    <input class="form-control" placeholder="MM-DD-YYYY" type="date" name="data_start" value="{{ $data_start ?? '' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>الي تاريخ</label>
                                                    <input class="form-control" placeholder="MM/DD/YYYY" type="date" name="data_end" value="{{ $data_end ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn ripple btn-primary" type="submit">بحث</button>
                                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Basic modal -->
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
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
<!--Internal  pickerjs js -->
<script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
<script>
    $('#modaldemo8').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var ap_id = button.data('ap_id')
        var ap_name = button.data('ap_name')
        var modal = $(this)
        modal.find('.modal-body #ap_id').val(ap_id);
        modal.find('.modal-body #ap_name').val(ap_name);
    })
</script>
<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var ap_id = button.data('ap_id')
        var employees_name = button.data('employees_name')
        var ap_value = button.data('ap_value')
        var modal = $(this)
        modal.find('.modal-body #ap_id').val(ap_id);
        modal.find('.modal-body #employees_name').val(employees_name);
        modal.find('.modal-body #ap_value').val(ap_value);
    })
</script>
@endsection
