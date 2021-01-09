@extends('layouts.master')
@section('title')
    عرض مورد - سنتر ايام زمان
@stop
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الموردين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض مورد</span>
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
											<h5>{{ $suppliers->supplier_name}}</h5>
											<p>كود : {{ $suppliers->id }} </p>
										</div>
									</div>
									<div class="main-contact-action btn-list pt-3 pr-3">
                                        <a href="{{ url('/' . $page='suppliers')}}" class="btn ripple btn-danger text-white btn-icon" data-placement="top" data-toggle="tooltip" title=" رجوع للقائمة"><i class="fas fa-arrow-left"></i></a>
										<a href="{{ route("suppliers.edit",$suppliers->id)}}" class="btn ripple btn-primary text-white btn-icon" data-placement="top" data-toggle="tooltip" title=" تعديل"><i class="fe fe-edit"></i></a>
                                        <a href="tel:{{ $suppliers->supllier_phone }}" class="btn ripple btn-warning text-white btn-icon" data-placement="top" data-toggle="tooltip" title="اتصل بالمورد الرقم الاول"><i class="fas fa-phone-volume"></i></a>
                                        @if(!empty( $suppliers->supllier_phoneOther))
                                            <a href="tel:{{ $suppliers->supllier_phoneOther }}" class="btn ripple btn-success text-white btn-icon" data-placement="top" data-toggle="tooltip" title="اتصل بالمورد الرقم الثاني"><i class="fas fa-phone-volume"></i></a>
                                        @endif
									</div>
								</div>
								<div class="main-contact-info-body p-4">
									<div class="media-list pb-0">
										<div class="media">
											<div class="media-body">
												<div>
													<label>اسم المورد</label> <span class="tx-medium">{{ $suppliers->supplier_name }}</span>
												</div>
												<div>
													<label>اسم المستفيد</label> <span class="tx-medium">{{ $suppliers->Beneficiary_name }}</span>
												</div>
											</div>
										</div>
										<div class="media">
											<div class="media-body">
												<div>
													<label>رقم الهاتف</label> <span class="tx-medium">{{ $suppliers->supllier_phone }}</span>
												</div>
												<div>
													<label>رقم هاتف بديل</label> <span class="tx-medium">{{ $suppliers->supllier_phoneOther  }}</span>
												</div>
											</div>
										</div>
										<div class="media">
											<div class="media-body">
												<div>
													<label>عنوان المورد</label> <span class="tx-medium">{{ $suppliers->supllier_address1}}</span>
                                                </div>
                                                <div>
													<label>طريقة الدفع</label> <span class="tx-medium">{{ $suppliers->Type_of_pay}}</span>
												</div>
											</div>
										</div>
										<div class="media">
											<div class="media-body">
												<div>
													<label>السجل التجاري رقم</label> <span class="tx-medium">{{ $suppliers->Commercial_Record }}</span>
												</div>
                                            </div>
                                            <div class="media-body">
												<div>
													<label>بطاقة ضريبية رقم</label> <span class="tx-medium">{{ $suppliers->Tax_card  }}</span>
												</div>
											</div>
                                        </div>
                                        <div class="media">
											<div class="media-body">
												<div>
													<label>نوع التوريد</label> <span class="tx-medium">{{ $suppliers->Type_of_supply }}</span>
												</div>
                                            </div>
                                            <div class="media-body">
												<div>
													<label>الحاله</label> <span class="tx-medium">{{ $suppliers->status  }}</span>
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
