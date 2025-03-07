@extends('layouts.master')
@section('title', 'ثبت کالای انتقالی')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">ثبت کالای انتقالی</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 box-margin height-card">
                        <div class="card card-body">
                            <h4 class="card-title">کالای منتقل شده</h4>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form action="{{ route('transfers.store.product', $transfer->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        @include('errors.errors')
                                        @php
                                            $fromOrganization = \App\Models\Organization::where('id', $transfer->fromOrganization)->first();
                                            $toOrganization = \App\Models\Organization::where('id', $transfer->toOrganization)->first();
                                            $approveUser = \App\Models\User::where('id', $transfer->approveUser)->first();
                                        @endphp

                                        <div class="row">
                                            <div class="form-group col-3">
                                                <label for="exampleInputEmail12">از سازمان:
                                                    {{ $fromOrganization->title }}</label>
                                            </div>
                                            <div class="form-group col-3">
                                                <label for="exampleInputEmail12">به سازمان:
                                                    {{ $toOrganization->title }}</label>
                                            </div>

                                            <div class="form-group col-3">
                                                <label for="inputGroupFile02">تاریخ انتقال:
                                                    {{ $transfer->transferDate }}</label>
                                            </div>

                                            <div class="form-group col-3">
                                                <label for="exampleInputEmail12">ارسال کننده:
                                                    {{ $transfer->user->name }}</label>
                                            </div>
                                            <div class="form-group col-3">
                                                <label for="exampleInputEmail111">کالای ارسال شده:
                                                    {{ $transfer->product->title }}</label>
                                            </div>
                                            <div class="form-group col-3">
                                                <label for="exampleInputEmail111">تعداد انتقالی:
                                                    {{ $transfer->number }}</label>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail12">توضیح:
                                                    {{ $transfer->description }}</label>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="exampleInputEmail12">افزودن موجودی به کالا - انبار -
                                                    برند:</label>
                                                <select class="js-example-basic-single form-control" name="product_id"
                                                    style="width: 100%;">
                                                    <option value="">--هیچکدام--</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}"> {{ $product->title }} -
                                                            {{ $product->store->title }} -
                                                            {{ $product->brand->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="exampleInputEmail12">انتخاب کالای دست دوم - انبار -
                                                    برند:</label>
                                                <select class="js-example-basic-single form-control" name="stock_id"
                                                    style="width: 100%;">
                                                    <option value="">--هیچکدام--</option>
                                                    @foreach ($stocks as $stock)
                                                        <option value="{{ $stock->id }}"> {{ $stock->title }} -
                                                            {{ $stock->store->title }} -
                                                            {{ $stock->brand->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group col-4">
                                                <label for="exampleInputEmail111">تعداد دریافتی تائید شده:</label>
                                                <input type="number" class="form-control" name="approvedNumber"
                                                    id="exampleInputEmail111">
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-success mb-2 mr-2" style="float:left;">
                                            تائید</button>
                                        <a href="{{ route('transfers.deny', $transfer->id) }}"
                                            class="btn btn-danger mb-2 mr-2">عدم تائید</a>
                                    </form>
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

        });
    </script>
@endsection
