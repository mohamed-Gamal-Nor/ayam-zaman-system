@extends('layouts.master')
@section('title')
    أضافة سداد مديونية مورد - مصنع ايام زمان
@stop
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
<!---Internal Fileupload css-->
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
<!---Internal Fancy uploader css-->
<link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">مشتريات الموردين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ أضافة سداد مديونية موردين</span>
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
                @if (session()->has('erorr'))
                    <script>
                        window.onload = function() {
                            notif({
                                msg: " خطأ في النظام",
                                type: "error"
                            });
                        }
                    </script>
                @endif
                @if (session()->has('AddReicpet'))
                    <script>
                        window.onload = function() {
                            notif({
                                msg: " تم أضافة السداد بايصال بنجاح",
                                type: "success"
                            });
                        }
                    </script>
                @endif
                @if (session()->has('AddCheck'))
                    <script>
                        window.onload = function() {
                            notif({
                                msg: " تم أضافة السداد بشيك بنجاح",
                                type: "success"
                            });
                        }
                    </script>
                @endif
				<!-- row -->
				<div class="row">
                    <div class="col-lg-12 col-md-12">

                            <div class="card">
                                <div class="card-body">
                                    <div class="mg-b-5">
                                        أضافة سداد مديونية لمورد
                                    </div>
                                    <p class="mg-b-20">يرجي ملئ البيانات الاتية</p>
                                    <div>
                                        <section>
                                            <div class="row row-sm mg-b-10">
                                                <div class="col-lg-3">
                                                    <div class="form-group mg-b-0">
                                                        <label class="form-control-label">كود المورد :</label>
                                                        <input class="form-control" disabled id="id" type="number">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label class="form-control-label">اختار اسم المورد: <span class="tx-danger">*</span></label>
                                                    <select class="form-control select2" name="supplier_id" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" data-placeholder="اختار المورد" required>
                                                        <option label="اختار المورد">
                                                        </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div id="slErrorContainer"></div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="form-group mg-b-0">
                                                        <label class="form-label">اسم المستفيد:</label>
                                                        <input class="form-control" disabled value="" type="text" id="Beneficiary">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="form-group mg-b-0">
                                                        <label class="form-label">نوع الدفع:</label>
                                                        <input class="form-control" disabled value="" type="text" id="pay">
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <div class="d-flex justify-content-right mg-b-5">
                                            <div class="spinner-border " role="status" id="supplier_loading">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mg-b-10">
                                        <div class="col-lg-3">
                                            <label class="rdiobox"><input name="rdio" type="radio" data-id="recipet"> <span>سداد نقدي</span></label>
                                        </div>
                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                            <label class="rdiobox"><input name="rdio" type="radio" data-id="check"> <span>سداد بشيك</span></label>
                                        </div>
                                    </div>


                                    <div id="recipet">
                                        <form autocomplete="off" action="{{route("supplierPays.store")}}" method="post" class="parsley-style-1" id="selectForm2" name="selectForm2" enctype="multipart/form-data">
                                            @method('post')
                                            @csrf
                                            <input type="hidden" name="type_pay" value="1">
                                            <input type="hidden" name="supplier_id">
                                            <div class="row mg-b-20">
                                                <div class="parsley-input col-md-6" id="fnWrapper">
                                                    <label>رقم الايصال: </label>
                                                    <input class="form-control" data-parsley-class-handler="#fnWrapper" name="number_recipet" placeholder="رقم الايصال" type="number">
                                                </div>
                                                <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                                    <label>قيمة الدفعة: <span class="tx-danger">*</span></label>
                                                    <input class="form-control" data-parsley-class-handler="#lnWrapper" name="value_recipet" placeholder="قيمة الدفعة" required="" type="number">
                                                </div>
                                            </div>
                                            <div class="row mg-b-20">
                                                <div class="parsley-input col-md-6" id="fnWrapper">
                                                    <label>ملاحظات: </label>
                                                    <textarea class="form-control" placeholder="ادخل ملاحظاتك" rows="9" name="note"></textarea>
                                                </div>
                                                <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                                    <label>مرفقات للدفع - PDF : </label>
                                                    <input type="file" class="dropify" data-height="200" name="document" accept="application/pdf"/>
                                                </div>
                                            </div>
                                            <div class="mg-t-30">
                                                <button class="btn btn-main-primary pd-x-20" type="submit">حفظ</button>

                                            </div>
                                        </form>
									</div>


                                    <div id="check">
										<form autocomplete="off" action="{{route("supplierPays.store")}}" method="post" class="parsley-style-1" id="selectForm" name="selectForm" enctype="multipart/form-data">
                                            @method('post')
                                            @csrf
                                            <input type="hidden" name="type_pay" value="0">
                                            <input type="hidden" name="supplier_id">
                                            <div class="row mg-b-20">
                                                <div class="parsley-input col-md-6" id="fnWrapper">
                                                    <label>رقم الشيك: <span class="tx-danger">*</span></label>
                                                    <input class="form-control" data-parsley-class-handler="#fnWrapper" name="number_check" placeholder="رقم الشيك" required="" type="number">
                                                </div>
                                                <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                                    <label>قيمة الدفعة: <span class="tx-danger">*</span></label>
                                                    <input class="form-control" data-parsley-class-handler="#lnWrapper" name="value_check" placeholder="قيمة الدفعة" required="" type="number">
                                                </div>
                                            </div>
                                            <div class="row mg-b-20">
                                                <div class="parsley-input col-md-6" id="fnWrapper">
                                                    <label>تاريخ الشيك : <span class="tx-danger">*</span></label>
                                                    <input class="form-control" placeholder="MM/DD/YYYY" name="date_check" type="date" required="">
                                                </div>
                                            </div>
                                            <div class="row mg-b-20">
                                                <div class="parsley-input col-md-6" id="fnWrapper">
                                                    <label>ملاحظات: </label>
                                                    <textarea class="form-control" placeholder="ادخل ملاحظاتك" rows="9" name="note"></textarea>
                                                </div>
                                                <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                                    <label>مرفقات للدفع - PDF : </label>
                                                    <input type="file" class="dropify" data-height="200" name="document" accept="application/pdf"/>
                                                </div>
                                            </div>
                                            <div class="mg-t-30">
                                                <button class="btn btn-main-primary pd-x-20" type="submit">حفظ</button>
                                            </div>
                                        </form>
									</div>

                                </div>
                            </div>
                        </form>

					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
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
<!--Internal Sumoselect js-->
<script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
<script>
    $(document).ready(function() {
        var $loading = $('#supplier_loading').hide();
        $('select[name="supplier_id"]').on('change', function() {
            $(document).ajaxStart(function () {
                $loading.show();
                }).ajaxStop(function () {
                    $loading.hide();
                });
            var supplierId = $(this).val();
            $("input[name='supplier_id']").val(supplierId);
            if (supplierId) {

                $.ajax({
                    url: "{{ URL::to('supplier') }}/" + supplierId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        $('#Beneficiary').empty();
                        $('#pay').empty();
                        $('#id').empty();

                        $('#id').val(data[0]['id']);
                        $('#Beneficiary').val(data[0]['Beneficiary_name']);
                        $('#pay').val(data[0]['Type_of_pay']);
                    },
                });

            } else {
                console.log('AJAX load did not work');
            }

        });
        var $recipet = $("#recipet").hide();
        var $check = $("#check").hide();
        $("input[name='rdio']").on('click',function(){
            if($(this).data("id") == "recipet"){
                $recipet.show();
                $check.hide();
            }else if($(this).data("id") == "check"){
                $recipet.hide();
                $check.show();
            }
        });
    });
</script>
@endsection
