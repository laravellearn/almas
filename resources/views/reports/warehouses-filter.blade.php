@extends('layouts.master')
@section('title', 'گزارش جامع انبار')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">گزارش جامع انبار</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">فیلتر گزارش</h4>
                                <hr>
                                <form action="{{ route('warehouse.filter') }}" method="get">
                                    <div class="row">
                                        <div class="col-12 col-lg-2">
                                            <label for="exampleInputEmail12">انتخاب سازمان:</label>
                                            <select name="organization" id="organization_id"
                                                class="js-example-basic-single form-control">
                                                <option value="all">همه سازمان ها</option>
                                                @foreach ($organizations as $organization)
                                                    <option value="{{ $organization->id }}"
                                                        @if ($organizationField == $organization->id) selected @endif>
                                                        {{ $organization->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-2">
                                            <label for="exampleInputEmail12">انتخاب انبار:</label>
                                            <select name="store" id="store_id"
                                                class="js-example-basic-single form-control">
                                                <option value="all">همه انبار ها</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-2">
                                            <label for="exampleInputEmail12">وضعیت موجودی:</label>
                                            <select name="status" class="js-example-basic-single form-control">
                                                <option value="all">همه وضعیت ها</option>
                                                <option value="off" @if ($statusField == "off") selected @endif>ناموجود</option>
                                                <option value="on" @if ($statusField == "on") selected @endif>موجود</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-2">
                                            <label for="exampleInputEmail12">نوع کالا:</label>
                                            <select name="type" class="js-example-basic-single form-control">
                                                <option value="all" @if ($typeField == "all") selected @endif>همه کالا ها</option>
                                                <option value="products" @if ($typeField == "products") selected @endif>کالاها</option>
                                                <option value="stocks" @if ($typeField == "stocks") selected @endif>کالای دست دوم</option>
                                                <option value="abortions" @if ($typeField == "abortions") selected @endif>کالای اسقاطی</option>
                                                <option value="repairs" @if ($typeField == "repairs") selected @endif>کالای تعمیری</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-1">
                                            <button type="submit" style="font-weight:bold;font-size:14px;margin-top:29px"
                                                class="btn btn-success mb-2 mr-2"> اعمال</button>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">نتیجه گزارش</h4>
                                <hr>
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>نوع کالا</th>
                                            <th>نام کالا</th>
                                            <th>سازمان</th>
                                            <th>انبار</th>
                                            <th>دسته بندی</th>
                                            <th>برند</th>
                                            <th>موجودی</th>
                                            <th>تاریخ ثبت</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @if (isset($all) && $all == 1)
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>کالای دست اول</td>
                                                    <td title="ثبت کننده: {{ $product->user->name }}">{{ $product->title }}
                                                    </td>
                                                    <td>{{ $product->organization->title }}</td>
                                                    <td>{{ $product->store->title }}</td>
                                                    <td>
                                                        {{ $product->parentCategory->title }} /
                                                        {{ isset($product->childCategory->title) ? $product->childCategory->title : '' }}
                                                    </td>
                                                    <td>
                                                        @if (isset($product->brand->title))
                                                            {{ $product->brand->title }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ $product->entity }}</td>
                                                    <td title="تاریخ ویرایش: {{ $product->updated_at }}">
                                                        {{ $product->created_at }}</td>
                                                </tr>
                                            @endforeach
                                            @foreach ($stocks as $stock)
                                                <tr>
                                                    <td>کالای دست دوم</td>
                                                    <td title="ثبت کننده: {{ $stock->user->name }}">{{ $stock->title }}
                                                    </td>
                                                    <td>{{ $stock->organization->title }}</td>
                                                    <td>{{ $stock->store->title }}</td>
                                                    <td>
                                                        {{ $stock->parentCategory->title }} /
                                                        {{ isset($stock->childCategory->title) ? $stock->childCategory->title : '' }}
                                                    </td>
                                                    <td>
                                                        @if (isset($stock->brand->title))
                                                            {{ $stock->brand->title }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ $stock->entity }}</td>
                                                    <td title="تاریخ ویرایش: {{ $stock->updated_at }}">
                                                        {{ $stock->created_at }}</td>
                                                </tr>
                                            @endforeach
                                            @foreach ($abortions as $abortion)
                                                <tr>
                                                    <td>کالای اسقاطی</td>
                                                    <td title="ثبت کننده: {{ $abortion->user->name }}">
                                                        {{ $abortion->title }}
                                                    </td>
                                                    <td>{{ $abortion->organization->title }}</td>
                                                    <td>{{ $abortion->store->title }}</td>
                                                    <td>
                                                        {{ $abortion->parentCategory->title }} /
                                                        {{ isset($abortion->childCategory->title) ? $abortion->childCategory->title : '' }}
                                                    </td>
                                                    <td>
                                                        @if (isset($abortion->brand->title))
                                                            {{ $abortion->brand->title }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ $abortion->entity }}</td>
                                                    <td title="تاریخ ویرایش: {{ $abortion->updated_at }}">
                                                        {{ $abortion->created_at }}</td>
                                                </tr>
                                            @endforeach
                                            @foreach ($repairs as $repair)
                                                <tr>
                                                    <td>کالای تعمیری</td>
                                                    <td title="ثبت کننده: {{ $repair->user->name }}">
                                                        {{ $repair->title }}
                                                    </td>
                                                    <td>{{ $repair->organization->title }}</td>
                                                    <td>{{ $repair->store->title }}</td>
                                                    <td>
                                                        {{ $repair->parentCategory->title }} /
                                                        {{ isset($repair->childCategory->title) ? $repair->childCategory->title : '' }}
                                                    </td>
                                                    <td>
                                                        @if (isset($repair->brand->title))
                                                            {{ $repair->brand->title }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ $repair->entity }}</td>
                                                    <td title="تاریخ ویرایش: {{ $repair->updated_at }}">
                                                        {{ $repair->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        @elseif (isset($products))
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>کالای دست اول</td>
                                                    <td title="ثبت کننده: {{ $product->user->name }}">
                                                        {{ $product->title }}
                                                    </td>
                                                    <td>{{ $product->organization->title }}</td>
                                                    <td>{{ $product->store->title }}</td>
                                                    <td>
                                                        {{ $product->parentCategory->title }} /
                                                        {{ isset($product->childCategory->title) ? $product->childCategory->title : '' }}
                                                    </td>
                                                    <td>
                                                        @if (isset($product->brand->title))
                                                            {{ $product->brand->title }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ $product->entity }}</td>
                                                    <td title="تاریخ ویرایش: {{ $product->updated_at }}">
                                                        {{ $product->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        @elseif (isset($stocks))
                                            @foreach ($stocks as $stock)
                                                <tr>
                                                    <td>کالای دست دوم</td>
                                                    <td title="ثبت کننده: {{ $stock->user->name }}">{{ $stock->title }}
                                                    </td>
                                                    <td>{{ $stock->organization->title }}</td>
                                                    <td>{{ $stock->store->title }}</td>
                                                    <td>
                                                        {{ $stock->parentCategory->title }} /
                                                        {{ isset($stock->childCategory->title) ? $stock->childCategory->title : '' }}
                                                    </td>
                                                    <td>
                                                        @if (isset($stock->brand->title))
                                                            {{ $stock->brand->title }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ $stock->entity }}</td>
                                                    <td title="تاریخ ویرایش: {{ $stock->updated_at }}">
                                                        {{ $stock->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        @elseif (isset($abortions))
                                            @foreach ($abortions as $abortion)
                                                <tr>
                                                    <td>کالای اسقاطی</td>
                                                    <td title="ثبت کننده: {{ $abortion->user->name }}">
                                                        {{ $abortion->title }}
                                                    </td>
                                                    <td>{{ $abortion->organization->title }}</td>
                                                    <td>{{ $abortion->store->title }}</td>
                                                    <td>
                                                        {{ $abortion->parentCategory->title }} /
                                                        {{ isset($abortion->childCategory->title) ? $abortion->childCategory->title : '' }}
                                                    </td>
                                                    <td>
                                                        @if (isset($abortion->brand->title))
                                                            {{ $abortion->brand->title }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ $abortion->entity }}</td>
                                                    <td title="تاریخ ویرایش: {{ $abortion->updated_at }}">
                                                        {{ $abortion->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        @elseif (isset($repairs))
                                            @foreach ($repairs as $repair)
                                                <tr>
                                                    <td>کالای تعمیری</td>
                                                    <td title="ثبت کننده: {{ $repair->user->name }}">
                                                        {{ $repair->title }}
                                                    </td>
                                                    <td>{{ $repair->organization->title }}</td>
                                                    <td>{{ $repair->store->title }}</td>
                                                    <td>
                                                        {{ $repair->parentCategory->title }} /
                                                        {{ isset($repair->childCategory->title) ? $repair->childCategory->title : '' }}
                                                    </td>
                                                    <td>
                                                        @if (isset($repair->brand->title))
                                                            {{ $repair->brand->title }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ $repair->entity }}</td>
                                                    <td title="تاریخ ویرایش: {{ $repair->updated_at }}">
                                                        {{ $repair->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
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

    <script>
        $(document).ready(function() {


            //getStore
            $('#organization_id').on('change', function() {
                var organization_id = $(this).val();
                if (organization_id) {
                    $.ajax({
                        url: '/products/getStore/' + organization_id,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#store_id').empty();
                                $('#store_id').append(
                                    '<option value="all">همه انبار ها</option>');
                                $.each(data, function(key, store) {
                                    $('select[name="store"]').append(
                                        '<option value="' + store.id +
                                        '">' + store
                                        .title + '</option>');
                                });
                            } else {
                                $('#store_id').empty();
                            }
                        }
                    });
                } else {
                    $('#store_id').empty();
                }
            });

        });
    </script>

@endsection
