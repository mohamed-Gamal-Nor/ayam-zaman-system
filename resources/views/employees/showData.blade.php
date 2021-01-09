@extends('layouts.master')
@section('title')
    عرض بيانات موظف - سنتر ايام زمان
@stop
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض موظف</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">

					<div class="col-sm-12 col-lg-12 col-xl-12">
						<div class="">
							<a class="main-header-arrow" href="" id="ChatBodyHide"><i class="icon ion-md-arrow-back"></i></a>
							<div class="main-content-body main-content-body-contacts card custom-card">
								<div class="main-contact-info-header pt-3">
									<div class="media">
										<div class="media-body">
											<h5>اسم الموظف : {{ $employees->employees_name}} </h5>
											<p>كود البصمة : {{ $employees->employees_finger }} </p>
										</div>
									</div>
									<div class="main-contact-action btn-list pt-3 pr-3">
                                        <a href="{{ url('/' . $page='employees')}}" class="btn ripple btn-danger text-white btn-icon" data-placement="top" data-toggle="tooltip" title=" رجوع للقائمة"><i class="fas fa-arrow-left"></i></a>
                                        @can('تعديل موظف')
										<a href="{{ route("employees.edit",$employees->id)}}" class="btn ripple btn-primary text-white btn-icon" data-placement="top" data-toggle="tooltip" title=" تعديل"><i class="fe fe-edit"></i></a>
                                        @endcan
                                        <a href="tel:{{ $employees->employees_phone  }}" class="btn ripple btn-warning text-white btn-icon" data-placement="top" data-toggle="tooltip" title="اتصل بالموظف"><i class="fas fa-phone-volume"></i></a>
									</div>
								</div>
								<div class="main-contact-info-body p-4">
									<div class="media-list pb-0">
										<div class="media">
											<div class="media-body">
												<div>
													<label>اسم الموظف</label> <span class="tx-medium">{{ $employees->employees_name }}</span>
												</div>
												<div>
													<label>البريد الاليكتروني</label> <span class="tx-medium">{{ $employees->email }}</span>
												</div>
											</div>
										</div>
										<div class="media">
											<div class="media-body">
												<div>
													<label>رقم الهاتف</label> <span class="tx-medium">{{ $employees->employees_phone }}</span>
												</div>
												<div>
													<label>الرقم القومي</label> <span class="tx-medium">{{ $employees->employees_nationalID  }}</span>
												</div>
											</div>
										</div>
										<div class="media">
											<div class="media-body">
												<div>
													<label>عنوان الموظف</label> <span class="tx-medium">{{ $employees->employees_address}}</span>
                                                </div>
                                                <div>
													<label>النوع</label> <span class="tx-medium">{{ $employees->employees_gender}}</span>
												</div>
											</div>
										</div>
										<div class="media">
											<div class="media-body">
												<div>
													<label>المسمي الوظيفي</label> <span class="tx-medium">{{ $employees->employees_jopName }}</span>
												</div>
                                            </div>
                                            <div class="media-body">
												<div>
													<label>الراتب</label> <span class="tx-medium">{{ $employees->employees_salary  }}</span>
												</div>
											</div>
                                        </div>
                                        <div class="media">
											<div class="media-body">
												<div>
													<label>تاريخ الميلاد</label> <span class="tx-medium">{{ $employees->employees_birth }}</span>
												</div>
                                            </div>
                                            <div class="media-body">
												<div>
													<label>تاريخ التعيين</label> <span class="tx-medium">{{ $employees->employees_work}}</span>
												</div>
											</div>
                                        </div>
                                        <div class="media">
											<div class="media-body">
												<div>
													<label>صرف الراتب</label> <span class="tx-medium">{{ $employees->date_salary }}</span>
												</div>
                                            </div>
                                            <div class="media-body">
												<div>
													<label>الحاله</label> <span class="tx-medium">{{ $employees->stauts}}</span>
												</div>
											</div>
                                        </div>
                                        <div class="media">
											<div class="media-body">
												<div>
													<label>القسم</label> <span class="tx-medium">{{ $employees->section->section_name }}</span>
												</div>
                                            </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Contact js -->
<script src="{{URL::asset('assets/js/contact.js')}}"></script>
@endsection
