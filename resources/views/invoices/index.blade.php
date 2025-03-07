@extends('layouts.master')
@section('title', 'لیست فاکتور ها')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">فاکتور ها</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">کالا ها</h4>
                                <hr>

                                <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>شماره</th>
                                            <th class="w-25">نام فروشگاه</th>
                                            <th>تعداد اقلام</th>
                                            <th>شماره تماس</th>
                                            <th>تاریخ ورود به واحد</th>
                                            <th>تاریخ خرید</th>
                                            <th>مبلغ فاکتور(ریال)</th>
                                            <th>عملیات</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td>{{ $invoice->invoiceID }}</td>
                                                <td title="ثبت کننده: {{ $invoice->user->name }}">
                                                    {{ $invoice->shopName }}</td>
                                                <td>
                                                    @php
                                                        $details = App\Models\Detail::where('invoice_id', $invoice->id)->count();
                                                    @endphp

                                                    {{ $details }} قلم
                                                </td>
                                                <td>{{ $invoice->phone }}</td>
                                                <td>{{ $invoice->inputDate }}</td>
                                                <td>{{ $invoice->buyDate }}</td>
                                                <td>{{ number_format($invoice->price) }}</td>
                                                <td>
                                                    <a href="{{ route('detail.add.get', $invoice->id) }}"
                                                        style="font-size:20px;float: right;margin-left:5px"><i
                                                            class="zmdi zmdi-plus-circle" style="color:green;"></i></a>
                                                    <a href="{{ route('invoices.show', $invoice->id) }}"
                                                        style="font-size:20px;float: right;margin-left:5px"><i
                                                            class="fa fa-eye" style="color:#04a9f5;"></i></a>

                                                    <a href="{{ route('invoices.edit', $invoice->id) }}"
                                                        style="font-size:20px;float: right;margin-left:5px"><i
                                                            class="fa fa-edit" style="color:#04a9f5;"></i></a>

                                                    @if (App\Models\Detail::where('invoice_id', $invoice->id)->count() == 0)
                                                        <form action="{{ route('invoices.destroy', $invoice->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('آیا از حذف رکورد مورد نظر اطمینان دارید؟');">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit"
                                                                style="font-size:20px;border: none;background-color: transparent;float: right;">
                                                                <i class="fa fa-trash" style="color:#dc3545;"></i>
                                                            </button>
                                                        </form>
                                                    @endif

                                                </td>
                                                <td>
                                                    <div class="row ">
                                                        @foreach ($subDetails as $detail)
                                                            @if ($detail->invoice_id == $invoice->id)
                                                                نام کالا: {{ $detail->product->title }} |
                                                                تعداد: {{ $detail->number }} |
                                                                مبلغ: {{ number_format($detail->price) }} ریال |
                                                                گارانتی: {{ $detail->garanty }} |
                                                                <a href="{{ route('invoices.detail.edit', $detail->id) }}"
                                                                    style="font-size:20px;float: right;margin-left:5px"><i
                                                                        class="fa fa-edit"
                                                                        style="color:#04a9f5;"></i></a>

                                                                <form
                                                                    action="{{ route('invoices.detail.delete', $detail->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('آیا از حذف رکورد مورد نظر اطمینان دارید؟');">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        style="font-size:20px;border: none;background-color: transparent;float: right;">
                                                                        <i class="fa fa-trash"
                                                                            style="color:#dc3545;"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        @endforeach
                                                        @php
                                                            $details = App\Models\Detail::where('invoice_id', $invoice->id)->count();
                                                        @endphp

                                                        {{-- @if ($details == 0)
                                                            <a href="{{ route('invoices.create.sub', $invoice->id) }}"
                                                                style="font-size:20px;float: right;margin-left:5px;"><i
                                                                    class="zmdi zmdi-plus-circle"
                                                                    style="color:green;"></i></a>
                                                        @endif --}}
                                                    </div>

                                                </td>
                                                <br>
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
