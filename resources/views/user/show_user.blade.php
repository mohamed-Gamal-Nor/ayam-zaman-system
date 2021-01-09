@extends('layouts.master')
@section('title')
    عرض مستخدم - مصنع ايام زمان
@stop
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض مستخدم</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-lg-4">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="pl-0">
									<div class="main-profile-overview">
										<div class="main-img-user profile-user">
                                            <img alt=""
                                                @if(empty($user->user_image) and $user->user_gender === 'ذكر')
                                                    src="{{asset('images/users/avatar.png')}}"
                                                @elseif(empty($user->user_image) and $user->user_gender === 'أنثي')
                                                    src="{{asset('images/users/avtar-female.png')}}"
                                                @else
                                                    src="{{asset('images/users')}}/{{$user->user_image}}"
                                                @endif
                                            >
										</div>
										<div class="d-flex justify-content-between mg-b-20">
											<div>
												<h5 class="main-profile-name">{{ $user->user_fname }} {{ $user->user_lname }}</h5>
												<p class="main-profile-name-text">{{ $user->user_jopName }}</p>
											</div>
										</div>
										<h6>السيرة الذاتية</h6>
										<div class="main-profile-bio">
											{{ $user->user_bio }}
										</div><!-- main-profile-bio -->
										<hr class="mg-y-30">
										<label class="main-content-label tx-13 mg-b-20">التواصل الاجتماعي</label>
										<div class="main-profile-social-list">
											<div class="media">
												<div class="media-icon bg-primary-transparent text-primary">
													<i class="icon ion-logo-github"></i>
												</div>
												<div class="media-body">
													<span>Github</span> <a href="{{ $user->user_Github }}">{{ $user->user_Github }}</a>
												</div>
											</div>
											<div class="media">
												<div class="media-icon bg-success-transparent text-success">
													<i class="icon ion-logo-twitter"></i>
												</div>
												<div class="media-body">
													<span>Twitter</span> <a href="{{ $user->user_Twitter }}">{{ $user->user_Twitter }}</a>
												</div>
											</div>
											<div class="media">
												<div class="media-icon bg-info-transparent text-info">
													<i class="icon ion-logo-linkedin"></i>
												</div>
												<div class="media-body">
													<span>Linkedin</span> <a href="{{ $user->user_Linkedin }}">{{ $user->user_Linkedin }}</a>
												</div>
                                            </div>
                                            <div class="media">
												<div class="media-icon bg-info-transparent text-info">
													<i class="icon ion-logo-facebook"></i>
												</div>
												<div class="media-body">
													<span>FaceBook</span> <a href="{{ $user->user_FaceBook }}">{{ $user->user_FaceBook }}</a>
												</div>
											</div>
											<div class="media">
												<div class="media-icon bg-danger-transparent text-danger">
													<i class="icon ion-md-link"></i>
												</div>
												<div class="media-body">
													<span>My Portfolio</span> <a href="{{ $user->user_Portfolio }}">{{ $user->user_Portfolio }}</a>
												</div>
											</div>
										</div>
									</div><!-- main-profile-overview -->
								</div>
							</div>
                        </div>
                        <div class="card mg-b-20">
							<div class="card-body">
								<div class="main-content-label tx-13 mg-b-25">
									Conatct
								</div>
								<div class="main-profile-contact-list">
									<div class="media">
										<div class="media-icon bg-primary-transparent text-primary">
											<i class="icon ion-md-phone-portrait"></i>
										</div>
										<div class="media-body">
											<span>رقم الهاتف</span>
											<div>
												{{ $user->user_phone  }}
											</div>
										</div>
                                    </div>
                                    @if(!empty($user->user_phoneOther ))
                                    <div class="media">
										<div class="media-icon bg-primary-transparent text-primary">
											<i class="icon ion-md-phone-portrait"></i>
										</div>
										<div class="media-body">
											<span>رقم الهاتف اخر</span>
											<div>
												{{ $user->user_phone  }}
											</div>
										</div>
                                    </div>
                                    @endif
									<div class="media">
										<div class="media-icon bg-success-transparent text-success">
											<i class="icon ion-logo-slack"></i>
										</div>
										<div class="media-body">
											<span>البريدالاليكتروني</span>
											<div>
												{{ $user->email }}
											</div>
										</div>
									</div>
									<div class="media">
										<div class="media-icon bg-info-transparent text-info">
											<i class="icon ion-md-locate"></i>
										</div>
										<div class="media-body">
											<span>عنوان السكن</span>
											<div>
												{{ $user->user_address1 }}
											</div>
										</div>
                                    </div>
                                    @if(!empty($user->user_address2 ))
                                    <div class="media">
										<div class="media-icon bg-info-transparent text-info">
											<i class="icon ion-md-locate"></i>
										</div>
										<div class="media-body">
											<span>رقم الهاتف اخر</span>
											<div>
												{{ $user->user_address2  }}
											</div>
										</div>
                                    </div>
                                    @endif
								</div><!-- main-profile-contact-list -->
							</div>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="card">
							<div class="card-body">
								<div class="tabs-menu ">
									<!-- Tabs -->
									<ul class="nav nav-tabs profile navtab-custom panel-tabs">
										<li class="active">
											<a href="#home" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">معلوماتي</span> </a>
										</li>
									</ul>
								</div>
								<div class="tab-content border-left border-bottom border-right border-top-0 p-4">
									<div class="tab-pane active" id="home">
										<h4 class="tx-15 text-uppercase mb-3">الاسم</h4>
                                        <p class="m-b-5">{{ $user->user_fname }} {{ $user->user_lname }}</p>
                                        <hr>
                                        <h4 class="tx-15 text-uppercase mb-3">البريد الاليكتروني</h4>
                                        <p class="m-b-5">{{ $user->email }}</p>
                                        <hr>
									</div>
								</div>
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
@endsection
