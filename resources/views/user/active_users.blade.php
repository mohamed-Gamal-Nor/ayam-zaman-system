@extends('layouts.master')
@section('title')
    قائمة المتسخدمين المفعلين / الموقوفين - مصنع ايام زمان
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
							<h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المستخدمين المفعلين</span>
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

							<div class="card-body">
								<div class="table-responsive">
									<table id="example2" class="table key-buttons text-md-nowrap table-hover" data-page-length='50'>
										<thead>
											<tr class="table-secondary">
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">صورة</th>
												<th class="border-bottom-0">اسم المستخدم</th>
                                                <th class="border-bottom-0">البريد الالكتروني</th>
                                                <th class="border-bottom-0">الهاتف</th>
                                                <th class="border-bottom-0">الوظيفة</th>
                                                <th class="border-bottom-0">الحالة</th>
                                                <th class="border-bottom-0">الصلاحيات</th>
                                                <th class="border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
                                            <?php $i=0;?>
                                            @foreach ($users  as $key => $user)
                                                <?php $i++?>
                                                <tr class="text-center">
                                                    <td >{{$i}}</td>
                                                    <td ><img alt="user-img" class="avatar avatar-md brround"
                                                        @if(empty($user->user_image) and $user->user_gender === 'ذكر')
                                                            src="{{asset('images/users/avatar.png')}}"
                                                        @elseif(empty($user->user_image) and $user->user_gender === 'أنثي')
                                                            src="{{asset('images/users/avtar-female.png')}}"
                                                        @else
                                                            src="{{asset('images/users')}}/{{$user->user_image}}"
                                                        @endif
                                                    /></td>
                                                    <td >{{$user->user_fname}} {{ $user->user_lname }}</td>
                                                    <td >{{$user->email }}</td>
                                                    <td >{{$user->user_phone }}</td>
                                                    <td >{{$user->user_jopName }}</td>
                                                    <td >
                                                        @if($user->status == 'مفعل')
                                                            <span class="label text-success d-flex"><div class="dot-label bg-success ml-1"></div>{{$user->status }}</span>
                                                        @elseif($user->status == 'غير مفعل')
                                                            <span class="label text-danger d-flex"><div class="dot-label bg-danger ml-1"></div>{{$user->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!empty($user->getRoleNames()))
                                                            @foreach ($user->getRoleNames() as $v)
                                                                <label class="badge badge-success">{{ $v }}</label>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td style="width: 30%">
                                                        <a class="modal-effect btn btn-sm btn-info" title="تعديل"  href="{{ route('users.edit', $user->id) }}">تعديل</a>
                                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-user_id="{{ $user->id }}" data-username="{{ $user->user_fname }} {{ $user->user_lname }}" data-toggle="modal" title="حذف" href="#modaldemo8" >حذف</a>
                                                        <a class="modal-effect btn btn-sm btn-success"  title="عرض الملف" href="{{ route('users.show', $user->id) }}">عرض</a>
                                                        @if($user->status == 'مفعل')
                                                            <a class="modal-effect btn btn-sm btn-warning"  title="تعطيل" href="{{ url('users/userdisable/'.$user->id) }}">تعطيل</a>
                                                        @elseif($user->status == 'غير مفعل')
                                                            <a class="modal-effect btn btn-sm btn-secondary"  title="تفعيل" href="{{ url('users/userActive/'.$user->id)}}">تفعيل</a>
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
                                    <form action="{{ route('users.destroy','test') }}" method="post">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                            <input type="hidden" name="user_id" id="user_id" value="">
                                            <input class="form-control" name="username" id="username" type="text" readonly>
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
        var user_id = button.data('user_id')
        var username = button.data('username')
        var modal = $(this)
        modal.find('.modal-body #user_id').val(user_id);
        modal.find('.modal-body #username').val(username);
    })
</script>
@endsection
