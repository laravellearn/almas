@extends('layouts.master')
@section('title','ویرایش دسته بندی')

@section('content')
<div class="main-content">
    <nav aria-label="خرده نان" class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
            <li class="breadcrumb-item active" aria-current="page">ویرایش دسته بندی</li>
        </ol>
    </nav>
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 box-margin height-card">
                    <div class="card card-body">
                        <h4 class="card-title">ویرایش دسته بندی</h4>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{ route('categories.update',$category->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">عنوان دسته بندی:</label>
                                        <input type="text" class="form-control" name="title" value="{{ $category->title }}" required id="exampleInputEmail111">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail12">توضیح:</label>
                                        <input type="text" class="form-control" value="{{ $category->description }}" name="description" id="exampleInputEmail111">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail12">انتخاب دسته بندی مادر:</label>
                                        <select class="js-example-basic-single form-control" name="parent_id" style="width: 100%;">
                                            <option value="">--هیچکدام--</option>
                                            @foreach ($parents as $parent)
                                                <option value="{{ $parent->id }}" {{ $parent->id == $category->parent_id ? 'selected' : ''}}>{{ $parent->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="checkbox checkbox-primary d-inline">
                                        <input type="checkbox" name="isActive" id="checkbox-p-1" {{ $category->isActive ? 'checked' : '' }}>
                                        <label for="checkbox-p-1" class="cr">فعال</label>
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
                            <h4 class="card-title mb-2">دسته بندی ها</h4>
                            <hr>

                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>عنوان دسته بندی</th>
                                        <th>توضیح</th>
                                        <th>دسته بندی مادر</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->title }}</td>
                                            <td>{{ $category->description }}</td>
                                            <td>
                                                @if (isset($category->parent->title))
                                                    {{ $category->parent->title }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($category->isActive == 1 )
                                                    <div class='badge badge-success'>فعال</div>
                                                @else
                                                    <div class='badge badge-danger'>غیرفعال</div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('categories.edit',$category->id) }}" style="font-size:20px;float: right;margin-left:5px"><i class="fa fa-edit" style="color:#04a9f5;"></i></a>
                                                {{-- <form action="{{ route('categories.destroy',$category->id) }}" method="POST" onsubmit="return confirm('آیا از حذف رکورد مورد نظر اطمینان دارید؟');">
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
