@extends('layouts.master')
@section('title')
    مخازن منتجات
@stop
@section('css')
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
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المخازن</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ مخازن منتجات</span>
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
                @if (session()->has('delete'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
				<div class="row row-sm">
                    <!--div-->
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <a class="modal-effect btn btn-outline-primary " data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة مخزن</a>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                                        <thead>
                                            <tr class="text-center">
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">اسم المخزن</th>
                                                <th class="border-bottom-0">عنوان المخزن</th>
                                                <th class="border-bottom-0">أنشأ بواسطة</th>
                                                <th class="border-bottom-0">الوصف</th>
                                                <th class="border-bottom-0">عدد الخامات</th>
                                                <th class="border-bottom-0">العمليات</th>
                                                <th class="border-bottom-0">اخر تعديل</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i=0;?>
                                            @foreach($stores as $store)
                                                <?php $i++?>
                                                <tr class="text-center">
                                                    <td>{{$i}}</td>
                                                    <td>{{$store->stores_name}}</td>
                                                    <td>{{$store->stores_addres}}</td>
                                                    <td>{{$store->created_by}}</td>
                                                    <td>{{$store->descriprion}}</td>
                                                    <td>20</td>

                                                    <td>
                                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                           data-id="{{ $store->id }}" data-stores_name="{{ $store->stores_name }}" data-stores_addres="{{ $store->stores_addres }}"
                                                           data-description="{{ $store->descriprion}}" data-toggle="modal"
                                                           href="#exampleModal2" title="تعديل"><i class="las la-pen"></i></a>
                                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                           data-id="{{ $store->id }}" data-stores_name="{{ $store->stores_name }}"
                                                           data-toggle="modal" href="#modaldemo9" title="حذف"><i
                                                                class="las la-trash"></i></a>
                                                    </td>
                                                    <td>{{$store->updated_at}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/div-->
                    <!-- Basic modal -->
                    <div class="modal" id="modaldemo8">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">اضافة مخزن</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="{{route('storesGoods.store')}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>أسم المخزن</label>
                                            <input type="text" class="form-control" id="stores_name" name="stores_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>عنوان المخزن</label>
                                            <input type="text" class="form-control" id="stores_addres" name="stores_addres" required>
                                        </div>
                                        <div class="form-group">
                                            <label>الوصف</label>
                                            <textarea class="form-control" id="descriprion" name="descriprion" ></textarea>
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
                    <!-- End Basic modal -->
                    <!-- edit -->
                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">تعديل المخزن</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="storesGoods/update" method="post" autocomplete="off">
                                        {{ method_field('patch') }}
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="hidden" name="id" id="id" value="">
                                            <label for="recipient-name" class="col-form-label">اسم المخزن:</label>
                                            <input class="form-control" name="stores_name" id="stores_name" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">عنوان المخزن:</label>
                                            <input class="form-control" name="stores_addres" id="stores_addres" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">ملاحظات:</label>
                                            <textarea class="form-control" id="description" name="descriprion"></textarea>
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
                    <!-- delete -->
                    <div class="modal" id="modaldemo9">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">حذف المخزن</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="storesGoods/destroy" method="post">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                        <input type="hidden" name="id" id="id" value="">
                                        <input class="form-control" name="stores_name" id="stores_name" type="text" readonly>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                        <button type="submit" class="btn btn-danger">تاكيد</button>
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
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var stores_name = button.data('stores_name')
        var stores_addres = button.data('stores_addres')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #stores_name').val(stores_name);
        modal.find('.modal-body #stores_addres').val(stores_addres);
        modal.find('.modal-body #description').val(description);
    })
</script>
<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var stores_name = button.data('stores_name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #stores_name').val(stores_name);
    })
</script>
@endsection
