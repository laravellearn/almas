@extends('layouts.master')
@section('title', 'کالاها')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">کالا ها</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">کالا ها</h4>
                                {{-- <a href="{{ route('products.trashed.get') }}" type="button"
                                    class="btn btn-danger mb-2 mr-2" style="float:left;margin-top:-37px;"><i
                                        class="fa fa-refresh"></i>
                                    سطل زباله
                                    ({{ $productCount }})
                                </a> --}}
                                <hr>

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ردیف</th>
                                            <th>عنوان کالا</th>
                                            <th>سازمان</th>
                                            <th>انبار</th>
                                            <th>دسته بندی</th>
                                            <th>برند</th>
                                            <th>حد سفارش</th>
                                            <th>موجودی</th>
                                            <th>تاریخ ثبت</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
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
                                                <td>{{ $product->orderLimit }}</td>
                                                <td>{{ $product->entity }}</td>
                                                <td title="تاریخ ویرایش: {{ $product->updated_at }}">
                                                    {{ $product->created_at }}</td>
                                                <td>
                                                    @if ($product->isActive == 1)
                                                        <div class='badge badge-success'>فعال</div>
                                                    @else
                                                        <div class='badge badge-danger'>غیرفعال</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        style="font-size:20px;float: right;margin-left:5px"><i
                                                            class="fa fa-edit" style="color:#04a9f5;"></i></a>
                                                    <form action="{{ route('products.destroy', $product->id) }}"
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
