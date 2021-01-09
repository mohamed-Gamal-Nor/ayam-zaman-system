@extends('layouts.master')
@section('title')
    تعديل منتج
@stop
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal  Datetimepicker-slider css -->
<link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
<!-- Internal Spectrum-colorpicker css -->
<link href="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">

<!---Internal Fileupload css-->
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
<!---Internal Fancy uploader css-->
<link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css')}}">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المنتجات والاقسام</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل منتج</span>
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

                @if (session()->has('Edit'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('Edit') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
				<!-- row-->
				<div class="row">
                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
						<div class="card  box-shadow-0 ">
							<div class="card-header">
								<h4 class="card-title mb-1">تعديل منتجات رئيسية</h4>
								<p class="mb-2">تعديل المنتجات هنا مع ربطها بالقسم لكي تظهر في المخازن وعمليات البيع</p>
                            </div>


							<div class="card-body pt-0">
                                <form class="needs-validation was-validated " method="POST" action="{{route('products.update',$product->id)}}" enctype="multipart/form-data" >
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
									<div class="col-lg-12">
										<div class="form-group">
											<label for="productname">اسم المنتج</label>
											<div class="form-group has-danger mg-b-0">
												<input class="form-control" id="productname" name="product_name" placeholder="ادخل اسم منتج صحيح" required="" type="text" value="{{ $product->product_name }}">
											</div>
										</div>
										<div class="form-group">
											<label for="markercode">كود الماركر</label>
											<div class="form-group has-danger mg-b-0">
												<input class="form-control" id="markercode" name="code_marker" placeholder="ادخل كود الماركر" required="" type="text" value="{{ $product->code_marker }}">
											</div>
										</div>
										<div class="form-group">
											<label for="markercode">البار كود</label>
											<div class="form-group has-danger mg-b-0">
												<input class="form-control" id="markercode" name="barcode" placeholder="ادخل البار كود من خلال المسدس" required="" type="text" value="{{ $product->barcode }}">
											</div>
                                        </div>
                                        <div class="form-group">
											<label for="desc">ملاحظات</label>
											<div class="form-group has-danger mg-b-0">
                                                <textarea class="form-control mg-t-20" id='desc' name="descriprion" placeholder="ادخل ملاحظاتك هنا"  rows="3">{{ $product->descriprion }}</textarea>
											</div>
                                        </div>
                                        <div class="col-lg-6 col-ms-6 ">
                                            <label>اختر القسم بالبحث</label>
                                            <select class="form-control select2" name="section_id" required="">
                                                <option label="اختار واحدا">
                                                </option>
                                                @foreach ($sections as $section)
                                                    <option value="{{$section->id}}" @if ($section->id == old('section_id', $product->section_id ))
                                                        selected="selected"
                                                        @endif>
                                                        {{$section->section_name}}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="form-group">
											<label >ارفق صورة المنتج </label>
                                            <div class="form-group mg-b-0">
                                                <input type="file" class="dropify" data-height="200" name="product_image" value="{{asset('images/product')}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
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
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
<!--Internal  pickerjs js -->
<script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>

<!--Internal Fileuploads js-->
<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
<!--Internal Fancy uploader js-->
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
<!--Internal  Form-elements js-->
<script src="{{URL::asset('assets/js/advanced-form-elements.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
@endsection
