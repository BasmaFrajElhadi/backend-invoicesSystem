@extends('layouts.master')
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto"> الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الفواتير/التفاصيل </span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
    {{--show error message  --}}
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    {{--show success message of adding new section  --}}
        @if(session()->has('successful'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session()->get('successful') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
            <!-- row -->
            <div class="row">
                <div class="col-xl-12">
                    <!-- div -->
                    <div class="card mg-b-20" id="tabs-style3">
                        <div class="card-body">
                            <div class="main-content-label mg-b-5">
                                الفاتورة  9
                            </div>
                            <div class="text-wrap">
                                <div class="example">
                                    <div class="panel panel-primary tabs-style-3">
                                        <div class="tab-menu-heading">
                                            <div class="tabs-menu ">
                                                <!-- Tabs -->
                                                <ul class="nav panel-tabs">
                                                    <li class=""><a href="#tab11" class="active" data-toggle="tab"><i class="fa fa-laptop"></i> معلومات الفاتورة</a></li>
                                                    <li><a href="#tab12" data-toggle="tab"><i class="fa fa-cube"></i> حالات الدفع</a></li>
                                                    <li><a href="#tab13" data-toggle="tab"><i class="fa fa-cogs"></i> المرفقات</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body tabs-menu-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab11">
                                                    <div class="table-responsive">
                                                        <table id="example1" class="table key-buttons text-md-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                                                    <th class="border-bottom-0">تاريخ الفاتورة</th>
                                                                    <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                                                    <th class="border-bottom-0">المنتج</th>
                                                                    <th class="border-bottom-0">القسم</th>
                                                                    <th class="border-bottom-0">الخصم</th>
                                                                    <th class="border-bottom-0">نسبة الضريبه</th>
                                                                    <th class="border-bottom-0">قيمة الضريبه</th>
                                                                    <th class="border-bottom-0">الاجمالي</th>
                                                                    <th class="border-bottom-0">الحالة</th>
                                                                    <th class="border-bottom-0">الملاحظات</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                    <tr>
                                                                        <td>{{$invoice->invoice_number}}</td>
                                                                        <td>{{$invoice->invoice_Date}}</td>
                                                                        <td>{{$invoice->due_Date}}</td>
                                                                        <td>{{$invoice->product}}</td>
                                                                        <td>{{$invoice->section->section_name}}</td>
                                                                        <td>{{$invoice->discount}}</td>
                                                                        <td>{{$invoice->rate_vat}}</td>
                                                                        <td>{{$invoice->value_vat}}</td>
                                                                        <td>{{$invoice->total}}</td>
                                                                        <td>
                                                                            @if ($invoice->value_status == 1)
                                                                                <span class="text-success">{{$invoice->status}}</span>
                                                                            @elseif ($invoice->value_status == 2)
                                                                                <span class="text-danger">{{$invoice->status}}</span>
                                                                            @else
                                                                                <span class="text-warning">{{$invoice->status}}</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{$invoice->note}}</td>
                                                                    </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab12">
                                                    <div class="table-responsive">
                                                        <table id="example1" class="table key-buttons text-md-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                                                    <th class="border-bottom-0">المنتج</th>
                                                                    <th class="border-bottom-0">القسم</th>
                                                                    <th class="border-bottom-0">المستخدم</th>
                                                                    <th class="border-bottom-0">تاريخ الاصدار </th>
                                                                    <th class="border-bottom-0">الحالة</th>
                                                                    <th class="border-bottom-0">تاريخ الدفع</th>
                                                                    <th class="border-bottom-0">الملاحظات</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($invoiceDetails as $invoiceDetail)
                                                                    <tr>
                                                                        <td>{{$invoiceDetail->invoice_number}}</td>
                                                                        <td>{{$invoiceDetail->product}}</td>
                                                                        <td>{{$invoice->section->section_name}}</td>
                                                                        <td>{{$invoiceDetail->user}}</td>
                                                                        <td>{{$invoiceDetail->created_at}}</td>
                                                                        <td>
                                                                            @if ($invoiceDetail->value_Status == 1)
                                                                                <span class="text-success">{{$invoiceDetail->status}}</span>
                                                                            @elseif ($invoiceDetail->value_Status == 2)
                                                                                <span class="text-danger">{{$invoiceDetail->status}}</span>
                                                                            @else
                                                                                <span class="text-warning">{{$invoiceDetail->status}}</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{$invoice->Payment_Date}}</td>
                                                                        <td>{{$invoiceDetail->note}}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                @if (isset($invoices_attachment))
                                                    <div class="tab-pane" id="tab13">
                                                        <div class="card card-statistics">
                                                    <div class="card-body">
                                                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                        <h5 class="card-title">اضافة مرفقات</h5>
                                                        <form method="post" action="{{ url('/InvoiceAttachments') }}"
                                                            enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile"
                                                                    name="file_name" required>
                                                                <input type="hidden" id="customFile" name="invoice_number"
                                                                    value="{{ $invoice->invoice_number }}">
                                                                <input type="hidden" id="invoice_id" name="invoice_id"
                                                                    value="{{ $invoice->id }}">
                                                                <label class="custom-file-label" for="customFile">حدد
                                                                    المرفق</label>
                                                            </div><br><br>
                                                            <button type="submit" class="btn btn-primary btn-sm "
                                                                name="uploadedFile">تاكيد</button>
                                                        </form>
                                                    </div>
                                                        <div class="tab-pane" id="tab12">
                                                            <div class="table-responsive">
                                                                <table id="example1" class="table key-buttons text-md-nowrap">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="border-bottom-0"> #</th>
                                                                            <th class="border-bottom-0">اسم الملف</th>
                                                                            <th class="border-bottom-0">قام بالاضافة</th>
                                                                            <th class="border-bottom-0">تاريخ الاصدار </th>
                                                                            <th class="border-bottom-0">العمليات </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($invoices_attachment as $attachment)
                                                                            <tr>
                                                                                <td>{{ $loop->iteration }}</td>
                                                                                <td>{{ $attachment->file_name }}</td>
                                                                                <td>{{ $attachment->created_by }}</td>
                                                                                <td>{{ $attachment->created_at }}</td>
                                                                                <td colspan="2">

                                                                                    <a class="btn btn-outline-success btn-sm"
                                                                                        href="{{ url('View_file') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                                                                        role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                                        عرض</a>

                                                                                    <a class="btn btn-outline-info btn-sm"
                                                                                        href="{{ url('download') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                                                                        role="button"><i
                                                                                            class="fas fa-download"></i>&nbsp;
                                                                                        تحميل</a>
                                                                                        @can('حذف المرفق')
                                                                                        <button class="btn btn-outline-danger btn-sm"
                                                                                            data-toggle="modal"
                                                                                            data-file_name="{{ $attachment->file_name }}"
                                                                                            data-invoice_number="{{ $attachment->invoice_number }}"
                                                                                            data-id_file="{{ $attachment->id }}"
                                                                                            data-target="#delete_file">حذف</button>
                                                                                        @endcan
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="tab-pane" id="tab13">
                                                        <p>لا يوجد مرفقات</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- delete -->
                                <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{route('delete_file')}}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <p class="text-center">
                                                <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                                                </p>

                                                <input type="hidden" name="id_file" id="id_file" value="">
                                                <input type="hidden" name="file_name" id="file_name" value="">
                                                <input type="hidden" name="invoice_number" id="invoice_number" value="">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                                <button type="submit" class="btn btn-danger">تاكيد</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                    <!---Prism Pre code-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /div -->
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
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
<script>
    $('#delete_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id_file = button.data('id_file')
        var file_name = button.data('file_name')
        var invoice_number = button.data('invoice_number')
        var modal = $(this)
        modal.find('.modal-body #id_file').val(id_file);
        modal.find('.modal-body #file_name').val(file_name);
        modal.find('.modal-body #invoice_number').val(invoice_number);
    })
</script>
@endsection
