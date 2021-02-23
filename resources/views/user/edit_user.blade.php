@extends('layouts.master')
@section('title')
    تعديل مستخدم - مصنع ايام زمان
@stop
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
<!--Internal  Font Awesome -->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل مستخدم</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
                @if ($errors->any())
                <div class="card bd-0 mg-b-20 bg-danger-transparent alert p-0">
                    <div class="card-header text-danger font-weight-bold">
                        <i class="far fa-times-circle"></i> رسالة خطأ
                        <button aria-label="Close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                @if (session()->has('Edit'))
                    <script>
                        window.onload = function() {
                            notif({
                                msg: " تم تعديل المستخدم بنجاح",
                                type: "success"
                            });
                        }
                    </script>
                @endif
				<!-- row -->
				<div class="row row-sm">
					<!-- Col -->
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

					<!-- Col -->
					<div class="col-lg-8">
						<div class="card">
							<div class="card-body">
								<div class="mb-4 main-content-label">معلومات شخصية</div>

                                {!! Form::model($user, ["class"=>" parsley-style-1" ,"id"=>"selectForm2" ,"name"=>"selectForm2","enctype"=>"multipart/form-data",'method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
									<div class="form-group ">
										<div class="row parsley-input" id="fnWrapper">
											<div class="col-md-3">
												<label>الاسم الاول: <span class="tx-danger">*</span></label>
											</div>
											<div class="col-md-9">
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="user_fname" placeholder="ادخل الاسم الاول" required="" type="text" value="{{ $user->user_fname }}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row parsley-input" id="fnWrapper">
											<div class="col-md-3">
												<label>الاسم الاخير: <span class="tx-danger">*</span></label>
											</div>
											<div class="col-md-9">
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="user_lname" placeholder="ادخل الاسم الاخير" required="" type="text" value="{{ $user->user_lname }}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label> البريد الالكتروني: <span class="tx-danger">*</span></label>
											</div>
											<div class="col-md-9">
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="email" placeholder="ادخل البريد الالكتروني" required="" type="email" value="{{ $user->email }}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label> الرقم القومي: <span class="tx-danger">*</span></label>
											</div>
											<div class="col-md-9">
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="user_nationalID" placeholder="ادخل الرقم القومي" required="" type="number" min="0" maxlength="14" minlength="14" value="{{ $user->user_nationalID  }}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>كلمة المرور: <span class="tx-danger">*</span></label>
											</div>
											<div class="col-md-9">
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="password" placeholder="ادخل كلمة المرور" type="password">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>تاكيد كلمة المرور: <span class="tx-danger">*</span></label>
											</div>
											<div class="col-md-9">
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="confirm-password" placeholder="اعد ادخال كلمة المرور" type="password">
											</div>
										</div>
                                    </div>
                                    <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>السيرةالذتية: <span class="tx-danger">*</span></label>
											</div>
											<div class="col-md-9">
												<textarea class="form-control" data-parsley-class-handler="#lnWrapper" name="user_bio" placeholder="اكتب السيرة الذاتية" required="" >{{ $user->user_bio}}</textarea>
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>رقم الهاتف: <span class="tx-danger">*</span></label>
											</div>
											<div class="col-md-9">
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="user_phone" placeholder="ادخل رقم الهاتف" required="" type="phone" value="{{ $user->user_phone }}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>رقم هاتف بديل:</label>
											</div>
											<div class="col-md-9">
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="user_phoneOther" placeholder=" ادخل رقم الهاتف بديل" type="phone" value="{{ $user->user_phoneOther  }}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>عنوان السكن: <span class="tx-danger">*</span></label>
											</div>
											<div class="col-md-9">
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="user_address1" placeholder="ادخل عنوان السكن" required="" type="text" value="{{ $user->user_address1 }}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>عنوان سكن بديل: </label>
											</div>
											<div class="col-md-9">
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="user_address2" placeholder="ادخل عنوان سكن بديل"  type="text" value="{{ $user->user_address2 }}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>تاريخ الميلاد: <span class="tx-danger">*</span></label>
											</div>
											<div class="col-md-9">
												<input class="form-control" placeholder="MM/DD/YYYY" name="user_birth" type="date" required="" value="{{ $user->user_birth }}">
											</div>
										</div>
                                    </div>
                                    <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>تاريخ التعيين: <span class="tx-danger">*</span></label>
											</div>
											<div class="col-md-9">
												<input class="form-control" placeholder="MM/DD/YYYY" name="user_work" type="date" required="" value="{{ $user->user_work }}">
											</div>
										</div>
                                    </div>
                                    <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>المسمي الوظيفي: <span class="tx-danger">*</span></label>
											</div>
											<div class="col-md-9">
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="user_jopName" placeholder="ادخل اسم الوظيفة" required="" type="text" value="{{ $user->user_jopName }}">
											</div>
										</div>
                                    </div>
                                    <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>رابط Github: </label>
											</div>
											<div class="col-md-9">
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="user_Github" placeholder="رابط Github"  type="text" value="{{ $user->user_Github }}">
											</div>
										</div>
                                    </div>
                                    <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>رابط Twitter: </label>
											</div>
											<div class="col-md-9">
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="user_Twitter" placeholder="رابط Twitter"  type="text" value="{{ $user->user_Twitter }}">
											</div>
										</div>
                                    </div>
                                    <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>رابط Linkedin: </label>
											</div>
											<div class="col-md-9">
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="user_Linkedin" placeholder="رابط Linkedin" type="text" value="{{ $user->user_Linkedin }}">
											</div>
										</div>
                                    </div>
                                    <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>رابط FaceBook: </label>
											</div>
											<div class="col-md-9">
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="user_FaceBook" placeholder="رابط FaceBook" type="text" value="{{ $user->user_FaceBook }}">
											</div>
										</div>
                                    </div>
                                    <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>رابط Portfolio: </label>
											</div>
											<div class="col-md-9">
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="user_Portfolio" placeholder="رابط Portfolio" type="text" value="{{ $user->user_Portfolio }}">
											</div>
										</div>
                                    </div>
                                    <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>النوع: <span class="tx-danger">*</span></label>
											</div>
											<div class="col-md-9">
												<select class="form-control select2-no-search"  name="user_gender" required="">
                                                    <option label="اختار النوع">
                                                    </option>
                                                    <option  value="ذكر"
                                                        @if($user->user_gender == "ذكر")
                                                            selected="selected"
                                                        @endif
                                                    >
                                                        ذكر
                                                    </option>
                                                    <option value="أنثي"
                                                        @if($user->user_gender == "أنثي")
                                                            selected="selected"
                                                        @endif
                                                    >
                                                        أنثي
                                                    </option>
                                                </select>
											</div>
										</div>
                                    </div>
                                    <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>القسم: <span class="tx-danger">*</span></label>
											</div>
											<div class="col-md-9">
												<select class="form-control select2" name="section_id" required="">
                                                    <option label="اختار واحدا">
                                                    </option>
                                                    @foreach ($sections as $section)
                                                        <option value="{{$section->id}}" @if ($section->id == old('section_id', $user->section_id ))
                                                            selected="selected"
                                                            @endif>
                                                            {{$section->section_name}}
                                                        </option>
                                                    @endforeach

                                                </select>
											</div>
										</div>
                                    </div>
                                    <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label>الصلاحيات: <span class="tx-danger">*</span></label>
											</div>
											<div class="col-md-9">
												{!!  Form::select('roles_name[]',$roles,$userRole,array('class'=>'form-control select2','multiple','required')) !!}
											</div>
										</div>
                                    </div>
                                    <div class="form-group ">
										<div class="row">

                                            <input type="file" class="dropify" data-height="200" name="user_image"/>
										</div>
									</div>
                                    <div class="card-footer text-left">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">تحديث</button>
                                        <a class="btn btn-danger pd-x-20" href="{{ url('/' . $page='users') }}">إلغاء</a>
                                    </div>
                                {!! Form::close() !!}
							</div>

						</div>
					</div>
					<!-- /Col -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
<!--Internal  pickerjs js -->
<script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
<!--Internal Fileuploads js-->
<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
