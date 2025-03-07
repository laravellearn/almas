@extends('layouts.master')
@section('title','لیست تامین کنندگان')

@section('content')
<div class="main-content">
    <nav aria-label="خرده نان" class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
            <li class="breadcrumb-item active" aria-current="page">تامین کنندگان</li>
        </ol>
    </nav>
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 box-margin height-card">
                    <div class="card card-body">
                        <h4 class="card-title">ویرایش تامین کننده</h4>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{ route('suppliers.update',$supplier) }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">نام شرکت: </label>
                                        <input type="text" class="form-control" name="title" required value="{{ $supplier->title }}" id="exampleInputEmail111">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail12">نام و نام خانوادگی:</label>
                                        <input type="text" class="form-control" name="name" required value="{{ $supplier->name }}" id="exampleInputEmail111">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">تلفن شرکت: </label>
                                        <input type="text" class="form-control" name="phone" required value="{{ $supplier->phone }}" id="exampleInputEmail111">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail12">موبایل:</label>
                                        <input type="text" class="form-control" name="mobile" required value="{{ $supplier->mobile }}" id="exampleInputEmail111">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail12">آدرس:</label>
                                        <input type="text" class="form-control" name="address" required value="{{ $supplier->address }}" id="exampleInputEmail111">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail12">توضیح:</label>
                                        <textarea type="text" class="form-control" name="description" id="exampleInputEmail111">{{ $supplier->description }}</textarea>
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
                            <h4 class="card-title mb-2">تامین کنندگان</h4>
                            <hr>

                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>نام شرکت</th>
                                        <th>نام مسئول</th>
                                        <th>موبایل</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($suppliers as $supplier)
                                        <tr>
                                            <td>{{ $supplier->title }}</td>
                                            <td>{{ $supplier->name }}</td>
                                            <td>{{ $supplier->mobile }}</td>
                                            <td>
                                                <a href="{{ route('suppliers.edit',$supplier->id) }}" style="font-size:20px;float: right;margin-left:5px"><i class="fa fa-edit" style="color:#04a9f5;"></i></a>
                                                {{-- <form action="{{ route('permissions.destroy',$permission->id) }}" method="POST" onsubmit="return confirm('آیا از حذف رکورد مورد نظر اطمینان دارید؟');">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" style="font-size:20px;border: none;background-color: transparent;float: right;">
                                                        <i class="fa fa-trash" style="color:#dc3545;"></i>
                                                    </button>
                                                </form> --}}
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
