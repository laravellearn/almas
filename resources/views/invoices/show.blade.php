@extends('layouts.master')
@section('title', 'اطلاعات فاکتور')
@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">مشاهده اطلاعات فاکتور</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 box-margin height-card">
                        <div class="card card-body">
                            <h4 class="card-title">اطلاعات فاکتور شماره: {{ $invoice->invoiceID }}</h4>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">

                                    <div class="table-responsive" style="overflow: hidden">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td colspan="2">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label for=""><b>نام فروشگاه:</b></label>
                                                            <label>{{ $invoice->shopName }}</label></br>
                                                            <label for=""><b>آدرس فروشگاه:</b>
                                                                <span>{{ $invoice->address }}</span></label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for=""><b>شماره تماس فروشگاه:</b>
                                                                <span>{{ $invoice->phone }}</span></label>
                                                            <label for=""><b>تاریخ خرید اقلام:</b>
                                                                <span>{{ $invoice->buyDate }}</span></label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for=""><b>شماره فاکتور:</b>
                                                                <span>{{ $invoice->invoiceID }}</span></label>
                                                            <label for=""><b>تاریخ ورود به واحد:</b>
                                                                <span>{{ $invoice->inputDate }}</span></label>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <table id="invoice-item-table" class="table table-bordered">
                                                        <tr>
                                                            <th style="font-weight: bold" width="3%">ردیف</th>
                                                            <th style="font-weight: bold" width="20%">نام کالا</th>
                                                            <th style="font-weight: bold" width="5%">تعداد</th>
                                                            <th style="font-weight: bold" width="8%">مبلغ(ریال)</th>
                                                            <th style="font-weight: bold" width="15%">نوع گارانتی</th>
                                                            <th style="font-weight: bold" width="10%">مبلغ کل(ریال)</th>
                                                        </tr>
                                                        @php
                                                            $i = 0;
                                                        @endphp
                                                        @foreach ($details as $detail)
                                                            @php
                                                                $i++;
                                                            @endphp
                                                            <tr>
                                                                <td align="center"><span
                                                                        id="sr_no">{{ $i }}</span></td>
                                                                <td>
                                                                    <span>{{ $detail->product->title }}</span>
                                                                </td>

                                                                <td>{{ $detail->number }}</td>
                                                                <td>{{ number_format($detail->price) }}</td>
                                                                <td>{{ $detail->garanty }}</td>
                                                                <td>{{ number_format($detail->totalPrice) }}</td>
                                                            </tr>
                                                        @endforeach

                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td align="left"><b>مبلغ کل:</td>
                                                <td align="right"><b><span id="final_total_amt"></span></b> {{ number_format($invoice->price) }} ریال </td>
                                            </tr>

                                        </table>
                                    </div>

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
