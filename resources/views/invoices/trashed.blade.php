@extends('layouts.master')
@section('title','سطل زباله کالا ها')

@section('content')
<div class="main-content">
    <nav aria-label="خرده نان" class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
            <li class="breadcrumb-item active" aria-current="page">سطل زباله کالا ها</li>
        </ol>
    </nav>
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-12 box-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-2">کالا های حذف شده</h4>
                            <a href="{{ route('products.index') }}" type="button" class="btn btn-danger mb-2 mr-2" style="float:left;margin-top:-37px;">
                                لیست کالا ها
                           </a>
                           <hr>
                           <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>عنوان کالا</th>
                                    <th>توضیح</th>
                                    <th>دسته بندی</th>
                                    <th>برند</th>
                                    <th>موجودی</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>
                                            @if (isset($product->category->title))
                                                {{ $product->category->title }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($product->brand->title))
                                                {{ $product->brand->title }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $product->entity }}</td>
                                        <td>
                                            @if ($product->isActive == 1 )
                                                <div class='badge badge-success'>فعال</div>
                                            @else
                                                <div class='badge badge-danger'>غیرفعال</div>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('products.restore',$product->id) }}" method="POST" onsubmit="return confirm('آیا از بازگردانی رکورد مورد نظر اطمینان دارید؟');">
                                                @csrf
                                                <button type="submit" style="font-size:20px;border:none;background-color:transparent;float:right">
                                                    <i class="fa fa-refresh" style="color:#04a9f5;"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('products.trashed.post',$product->id) }}" method="POST" onsubmit="return confirm('آیا از حذف رکورد مورد نظر اطمینان دارید؟');">
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
