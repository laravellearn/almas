@extends('layouts.master')
@section('title', 'کالاهای دست دوم')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">لیست کالاهای دست دوم</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">لیست کالاهای دست دوم</h4>
                                {{-- <a href="{{ route('stocks.trashed.get') }}" type="button" class="btn btn-danger mb-2 mr-2" style="float:left;margin-top:-37px;"><i class="fa fa-refresh"></i>
                                 سطل زباله
                                 ({{ $stockCount }})
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
                                            <th>تعداد</th>
                                            <th>تاریخ دریافت</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($stocks as $stock)
                                            <tr>
                                                <td>{{ $stock->id }}</td>
                                                <td title="ثبت کننده: {{ $stock->user->name }}">{{ $stock->title }}</td>
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
                                                <td title="تاریخ ثبت در سیستم: {{ $stock->created_at }}">
                                                    {{ $stock->inputDate }}</td>
                                                <td>
                                                    @if ($stock->isActive == 1)
                                                        <div class='badge badge-success'>فعال</div>
                                                    @else
                                                        <div class='badge badge-danger'>غیرفعال</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('stocks.edit', $stock->id) }}"
                                                        style="font-size:20px;float: right;margin-left:5px"><i
                                                            class="fa fa-edit" style="color:#04a9f5;"></i></a>
                                                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST"
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
