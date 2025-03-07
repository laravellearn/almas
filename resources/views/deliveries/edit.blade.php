@extends('layouts.master')
@section('title', 'ویرایش تحویل کالا')

@section('content')
<div class="main-content">
    <nav aria-label="خرده نان" class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
            <li class="breadcrumb-item active" aria-current="page">ویرایش تحویل کالا</li>
        </ol>
    </nav>
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 box-margin height-card">
                    <div class="card card-body">
                        <h4 class="card-title">ویرایش تحویل کالا</h4>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{ route('deliveries.update', $delivery->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label for="exampleInputEmail12">تحویل گیرنده:</label>
                                        <select class="js-example-basic-single form-control" required name="employee_id" style="width: 100%;">
                                            <option value="">--هیچکدام--</option>
                                            @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}" {{ $employee->id == $delivery->employee_id ? 'selected' : '' }}>
                                                {{ $employee->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail12">نام سازمان:</label>
                                        <select class="js-example-basic-single form-control" required name="organization_id" style="width: 100%;">
                                            <option value="">--هیچکدام--</option>
                                            @if (\Auth::user()->isAdmin == 1)
                                            @foreach ($organizations as $organization)
                                            <option value="{{ $organization->id }}" {{ $organization->id == $delivery->organization_id ? 'selected' : '' }}>
                                                {{ $organization->description }}
                                            </option>
                                            @endforeach
                                            @else
                                            <option value="{{ \Auth::user()->organization_id }}" selected>
                                                {{ \Auth::user()->organization->title }}
                                            </option>
                                            @endif
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail12">انتخاب کالا - انبار - برند - دسته بندی:</label>
                                        <select class="js-example-basic-single form-control" name="product_id" style="width: 100%;">
                                            <option value="">--هیچکدام--</option>
                                            @foreach ($products as $product)
                                            <option value="{{ $product->id }}" {{ $product->id == $delivery->product_id ? 'selected' : '' }}>
                                                {{ $product->title }} - {{ $product->store->title }} -
                                                {{ $product->brand->title }} - {{ $product->parentCategory->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail12">انتخاب کالای دست دوم - انبار - برند - دسته بندی:</label>
                                        <select class="js-example-basic-single form-control" name="stock_id" style="width: 100%;">
                                            <option value="">--هیچکدام--</option>
                                            @foreach ($stocks as $stock)
                                            <option value="{{ $stock->id }}" {{ $stock->id == $delivery->stock_id ? 'selected' : '' }}>
                                                {{ $stock->title }} - {{ $stock->store->title }} -
                                                {{ $stock->brand->title }} - {{ $stock->parentCategory->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">شماره اموال کالا:</label>
                                        <input type="number" class="form-control" name="AmvalCode" value="{{ $delivery->AmvalCode }}" id="exampleInputEmail111">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail111">تعداد تحویل شده:</label>
                                        <input type="number" class="form-control" value="{{ $delivery->number }}" name="number" required id="exampleInputEmail111">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">تاریخ تحویل:</label>
                                        <input type="text" id="observer-example" name="deliverDate" value="{{ $delivery->deliverDate }}" required class="form-control observer-example">

                                        <span id="span1"></span>

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail12">توضیح:</label>
                                        <textarea type="text" class="form-control" name="description" id="exampleInputEmail111">{{ $delivery->description }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-outline-success mb-2 mr-2" style="float:left;"><i class="fa fa-save"></i> ویرایش</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8 box-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-2">تحویل کالا ها</h4>
                            <hr>

                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>نام کالا</th>
                                        <th>پرسنل</th>
                                        <th>واحد</th>
                                        <th>تعداد تحویلی</th>
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
                                        <td>{{ $delivery->deliverDate }}</td>
                                        <td>
                                            <a href="{{ route('deliveries.edit', $delivery->id) }}" style="font-size:20px;float: right;margin-left:5px"><i class="fa fa-edit" style="color:#04a9f5;"></i></a>
                                            <form action="{{ route('deliveries.destroy', $delivery->id) }}" method="POST" onsubmit="return confirm('آیا از حذف رکورد مورد نظر اطمینان دارید؟');">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" style="font-size:20px;border: none;background-color: transparent;float: right;">
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

    });
</script>

@endsection