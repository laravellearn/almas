@extends('layouts.master')
@section('title', 'ویرایش فاکتور')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/persian-datepicker.min.css') }}">
@endsection
@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">ویرایش فاکتور</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 box-margin height-card">
                        <div class="card card-body">
                            <h4 class="card-title">ویرایش فاکتور</h4>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">

                                    <form method="post" id="invoice_form" action="{{ route('invoices.update',$invoice->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="table-responsive" style="overflow: hidden">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <label for="">نام فروشگاه:</label>
                                                                <input type="text" name="order_receiver_name"
                                                                    id="order_receiver_name" class="form-control input-sm"
                                                                    value="{{ $invoice->shopName }}" />
                                                                <label for="">آدرس فروشگاه:</label>
                                                                <input name="order_receiver_address"
                                                                    id="order_receiver_address" class="form-control"
                                                                    value="{{ $invoice->address }}"
                                                                    style="margin-top: 5px">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label for="">شماره تماس فروشگاه:</label>
                                                                <input type="text" name="phone" id="phone"
                                                                    class="form-control input-sm"
                                                                    value="{{ $invoice->phone }}"
                                                                    placeholder="شماره تماس فروشگاه" />
                                                                <label for="">تاریخ خرید اقلام:</label>
                                                                <input type="text" id="observer-example order_date"
                                                                    name="buyDate" value="{{ $invoice->buyDate }}"
                                                                    class="form-control observer-example input-sm mt-1 order_date">
                                                                <span id="span1"></span>

                                                            </div>
                                                            <div class="col-md-2">
                                                                <label for="">شماره فاکتور:</label>
                                                                <input type="text" name="order_no" id="order_no" readonly
                                                                    value="{{ $invoice->invoiceID }}"
                                                                    class="form-control input-sm" style="text-align: left"
                                                                    placeholder="شماره فاکتور" />
                                                                <label for="">تاریخ ورود به واحد:</label>
                                                                <input type="text" id="observer-example order_date"
                                                                    name="inputDate" value="{{ $invoice->inputDate }}"
                                                                    class="form-control observer-example input-sm mt-1 order_date">
                                                                <span id="span1"></span>

                                                            </div>
                                                        </div>
                                                        <br />

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2">
                                                        <textarea name="description" class="form-control" id="" cols="30" rows="5" placeholder="توضیحات فاکتور">{{ $invoice->description }}</textarea>
                                                        <label for="file">تصویر فاکتور:</label>
                                                        <input type="file" id="file" name="file" class="form-control"
                                                            style="border: 0">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" align="center">
                                                        <input type="hidden" name="total_item" id="total_item" value="1" />
                                                        <input type="submit" name="create_invoice" id="create_invoice"
                                                            style="font-weight: bold;font-size: 14px;"
                                                            class="btn btn-info" value="ویرایش فاکتور" />
                                                    </td>
                                                </tr>

                                            </table>
                                        </div>
                                    </form>

                                    <img src="{{ $invoice->file }}" style="display: block">


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end row-->

            </div>
        </div>
    </div>
@endsection




@section('scripts')
<script src="{{ asset('js/default-assets/file-upload.js') }}"></script>
<script src="{{ asset('js/default-assets/basic-form.js') }}"></script>
        <!-- تاریخ شمسی  -->
        <script type="text/javascript" src="{{ asset('js/persian-date.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/persian-datepicker.min.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.observer-example').persianDatepicker({
                    observer: true,
                    format: 'YYYY/MM/DD',
                    altField: '.observer-example-alt',
                    initialValue: false
                });
                $('.observer-example2').persianDatepicker({
                    observer: true,
                    format: 'YYYY/MM/DD',
                    altField: '.observer-example-alt2',
                    initialValue: false
                });

                $('#order_item_store1').select2();
                $('#item_name1').select2();

            });


        </script>



@endsection
