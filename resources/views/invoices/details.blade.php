@extends('layouts.master')
@section('title', 'لیست اقلام')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">اقلام خریداری شده</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">لیست اقلام خریداری شده</h4>
                                <hr>

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>شماره فاکتور</th>
                                            <th>نام تامین کننده</th>
                                            <th>نام کالا</th>
                                            <th>تعداد</th>
                                            <th>تاریخ ورود به واحد</th>
                                            <th>تاریخ خرید</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($details as $detail)
                                            <tr>
                                                <td><a target="_blank" href="/invoices/{{ $detail->invoice->id }}">{{ $detail->invoice->invoiceID }}</a></td>
                                                <td>{{ $detail->invoice->shopName }}</td>
                                                <td>{{ $detail->product->title }}</td>
                                                <td>{{ $detail->number }}</td>
                                                <td>{{ $detail->invoice->inputDate }}</td>
                                                <td>{{ $detail->invoice->buyDate }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->

            </div>
        </div>
    </div>



@endsection
