@extends('layouts.master')
@section('title')
    أضافة سلف - مصنع ايام زمان
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">رواتب و سلف الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ أضافة سلفة</span>
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
                @if (session()->has('Add'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('Add') }}</strong>
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
									<a class="mx-1 modal-effect btn btn-outline-primary" href="{{ url('/' . $page='advancePayment') }}">قائمة السلف</a>
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
                                                <th class="border-bottom-0">أضافة السلفة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=0;?>
                                            @foreach ($employees  as $key => $employee)
                                                <?php $i++?>
                                                <tr class="text-center">
                                                    <td >{{$i}}</td>
                                                    <td >{{$employee->employees_finger}}</td>
                                                    <td >{{$employee->employees_name}}</td>
                                                    <td >
                                                        <a title="أضافة" class="modal-effect btn btn-sm btn-success"  data-effect="effect-slide-in-right" data-toggle="modal" href="#modaldemo8" data-employees_id ="{{ $employee->id  }}" data-employees_name="{{ $employee->employees_name }}">أضافة</a>
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
                <div class="modal" id="modaldemo8">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">أضافة سلفة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="{{route('advancePayment.store')}}" method="POST" autocomplete="off">
                                {{csrf_field()}}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>أسم الموظف</label>
                                        <input type="hidden" class="form-control" id="employees_id" name="employees_id" >
                                        <input type="text" class="form-control" id="employees_name" disabled >
                                    </div>
                                    <div class="form-group">
                                        <label>قيمة السلفة</label>
                                        <input type="number" class="form-control" name="ap_value" min="1">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn ripple btn-primary" type="submit">حفظ</button>
                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">أغلاق</button>
                                </div>
                            </form>
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
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script>
    $('#modaldemo8').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var employees_id = button.data('employees_id')
        var employees_name = button.data('employees_name')
        var modal = $(this)
        modal.find('.modal-body #employees_id').val(employees_id);
        modal.find('.modal-body #employees_name').val(employees_name);
    })
</script>
@endsection
