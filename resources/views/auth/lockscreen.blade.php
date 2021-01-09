@extends('layouts.master2')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">

				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="mb-5 d-flex mx-auto"> <a href="{{ url('/' . $page='index') }}" class="mx-auto d-flex"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="sign-favicon ht-40 mx-auto" alt="logo"></a></div>
									<div class="main-card-signin d-md-flex bg-white">
										<div class="p-4 wd-100p">
											<div class="main-signin-header">
                                                <div class="avatar avatar-xxl avatar-xxl mx-auto text-center mb-2"><img alt="" class="avatar avatar-xxl rounded-circle  mt-2 mb-2 "
                                                    @if(empty(Auth::user()->user_image) and Auth::user()->user_gender === 'ذكر')
                                                        src="{{asset('images/users/avatar.png')}}"
                                                    @elseif(empty(Auth::user()->user_image) and Auth::user()->user_gender === 'أنثي')
                                                        src="{{asset('images/users/avtar-female.png')}}"
                                                    @else
                                                        src="{{asset('images/users')}}/{{Auth::user()->user_image}}"
                                                    @endif
                                                    ></div>
												<div class="mx-auto text-center mt-4 mg-b-20">
													<h5 class="mg-b-10 tx-16">{{ Auth::user()->user_fname }} {{ Auth::user()->user_lname }}</h5>
													<p class="tx-13 text-muted">ادخل كلمة المرور للدخول مرة اخري</p>
												</div>
                                                <form method="POST" action="{{ route('unlock') }}">
                                                    @csrf
													<div class="form-group">
                                                        <input class="form-control" placeholder="ادخل كلمةالمرور" type="password" name="password" value="" required="">
                                                        @if ($errors->has('password'))
                                                            <span class="invalid-feedback" role="alert" style="display: block">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
													</div>
                                                    <button class="btn btn-main-primary btn-block">فتح القفل</button>

												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
                </div><!-- End -->
                <!-- The image half -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
							<img src="{{URL::asset('assets/img/media/login.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection
@section('js')
@endsection
