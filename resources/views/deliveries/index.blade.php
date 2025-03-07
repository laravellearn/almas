@extends('layouts.master')
@section('title', 'لیست تحویل کالا')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">لیست تحویل کالا</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 col-lg-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">تحویل کالا</h4>
                                <a href="{{ route('deliveries.create') }}" style="font-weight:bold;float:left;font-size:14px" class="btn btn-success mb-2 mr-2"><i class="fa fa-plus"></i> ثبت تحویل کالا</a>
                                <hr>

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>نام کالا</th>
                                            <th>تحویل گیرنده</th>
                                            <th>واحد</th>
                                            <th>تعداد تحویلی</th>
                                            <th>کد اموال</th>
                                            <th>تاریخ تحویل</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($deliveries as $delivery)
                                            <tr>
                                                <td>
                                                    @if ($delivery->product_id != null)
                                                        {{ $delivery->product->title }} / {{ $delivery->product->parentCategory->title }}
                                                    @else
                                                        {{ $delivery->stock->title }} / {{ $delivery->stock->parentCategory->title }}
                                                    @endif
                                                </td>
                                                <td>{{ $delivery->employee->name }}</td>
                                                <td>{{ isset($delivery->employee->parentUnit->title) ? $delivery->employee->parentUnit->title : '' }}
                                                    -
                                                    {{ isset($delivery->employee->childUnit->title) ? $delivery->employee->childUnit->title : '' }}
                                                </td>
                                                <td>{{ $delivery->number }}</td>
                                                <td>{{ $delivery->AmvalCode }}</td>
                                                <td>{{ $delivery->deliverDate }}</td>
                                                <td>
                                                    <a href="{{ route('deliveries.edit', $delivery->id) }}"
                                                        style="font-size:20px;float: right;margin-left:5px"><i
                                                            class="fa fa-edit" style="color:#04a9f5;"></i></a>
                                                    <form action="{{ route('deliveries.destroy', $delivery->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('آیا از حذف رکورد مورد نظر اطمینان دارید؟');">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit"
                                                            style="font-size:20px;border: none;background-color: transparent;float: right;">
                                                            <i class="fa fa-trash" style="color:#dc3545;"></i>
                                                        </button>
                                                    </form>
                                                </td>
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
