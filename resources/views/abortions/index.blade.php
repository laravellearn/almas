@extends('layouts.master')
@section('title', 'کالاهای اسقاطی')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">کالاهای اسقاطی</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">کالاهای اسقاطی</h4>
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
                                            <th>تعداد</th>
                                            <th>تاریخ دریافت</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($abortions as $abortion)
                                            <tr>
                                                <td>{{ $abortion->id }}</td>
                                                <td title="ثبت کننده: {{ $abortion->user->name }}">{{ $abortion->title }}</td>
                                                <td>{{ $abortion->organization->title }}</td>
                                                <td>{{ $abortion->store->title }}</td>
                                                <td>
                                                    {{ $abortion->parentCategory->title }} / {{ isset($abortion->childCategory->title) ? $abortion->childCategory->title : '' }}
                                                </td>
                                                <td>
                                                    @if (isset($abortion->brand->title))
                                                        {{ $abortion->brand->title }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $abortion->entity }}</td>
                                                <td title="تاریخ ثبت در سیستم: {{ $abortion->created_at }}">{{ $abortion->inputDate }}</td>
                                                <td>
                                                    @if ($abortion->isActive == 1)
                                                        <div class='badge badge-success'>فعال</div>
                                                    @else
                                                        <div class='badge badge-danger'>غیرفعال</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('abortions.edit', $abortion->id) }}"
                                                        style="font-size:20px;float: right;margin-left:5px"><i
                                                            class="fa fa-edit" style="color:#04a9f5;"></i></a>
                                                    <form action="{{ route('abortions.destroy', $abortion->id) }}"
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
