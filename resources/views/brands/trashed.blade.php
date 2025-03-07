@extends('layouts.master')
@section('title','سطل زباله برند ها')

@section('content')
<div class="main-content">
    <nav aria-label="خرده نان" class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
            <li class="breadcrumb-item active" aria-current="page">سطل زباله برند ها</li>
        </ol>
    </nav>
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-12 box-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-2">برند های حذف شده</h4>
                            <a href="{{ route('brands.index') }}" type="button" class="btn btn-danger mb-2 mr-2" style="float:left;margin-top:-37px;">
                                لیست برند ها
                           </a>
                           <hr>

                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>عنوان برند</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>{{ $brand->title }}</td>
                                            <td>
                                                @if ($brand->isActive == 1 )
                                                    <div class='badge badge-success'>فعال</div>
                                                @else
                                                    <div class='badge badge-danger'>غیرفعال</div>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('brands.restore',$brand->id) }}" method="POST" onsubmit="return confirm('آیا از بازگردانی رکورد مورد نظر اطمینان دارید؟');">
                                                    @csrf
                                                    <button type="submit" style="font-size:20px;border:none;background-color:transparent;float:right">
                                                        <i class="fa fa-refresh" style="color:#04a9f5;"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('brands.trashed.post',$brand->id) }}" method="POST" onsubmit="return confirm('آیا از حذف رکورد مورد نظر اطمینان دارید؟');">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" style="font-size:20px;border:none;background-color:transparent;float:right">
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
