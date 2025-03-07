@extends('layouts.master')
@section('title', 'کالاهای تعمیری')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">لیست کالاهای تعمیری</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">لیست کالاهای تعمیری</h4>
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
                                            <th>کاربر</th>
                                            <th>تاریخ دریافت</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($repairs as $repair)
                                            <tr>
                                                <td>{{ $repair->id }}</td>
                                                <td title="ثبت کننده: {{ $repair->user->name }}">{{ $repair->title }}</td>
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
                                                <td>{{ $repair->employee->name }}</td>
                                                <td title="تاریخ ثبت در سیستم: {{ $repair->created_at }}">{{ $repair->inputDate }}</td>
                                                <td>
                                                    @if ($repair->isActive == 1)
                                                        <div class='badge badge-success'>فعال</div>
                                                    @else
                                                        <div class='badge badge-danger'>غیرفعال</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('repairs.edit', $repair->id) }}"
                                                        style="font-size:20px;float: right;margin-left:5px"><i
                                                            class="fa fa-edit" style="color:#04a9f5;"></i></a>
                                                    <form action="{{ route('repairs.destroy',$repair->id) }}" method="POST" onsubmit="return confirm('آیا از حذف رکورد مورد نظر اطمینان دارید؟');">
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
