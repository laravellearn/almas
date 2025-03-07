@extends('layouts.master')
@section('title','لیست نقش ها')

@section('content')
<div class="main-content">
    <nav aria-label="خرده نان" class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
            <li class="breadcrumb-item active" aria-current="page">نقش های کاربری</li>
        </ol>
    </nav>
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 box-margin height-card">
                    <div class="card card-body">
                        <h4 class="card-title">افزودن نقش کاربری</h4>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{ route('roles.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">عنوان نقش(انگلیسی):</label>
                                        <input type="text" class="form-control" name="title" required id="exampleInputEmail111">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail12">توضیح(فارسی):</label>
                                        <input type="text" class="form-control" name="description" required id="exampleInputEmail111">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail12">انتخاب دسترسی:</label>
                                        <select class="js-example-basic-single form-control" name="permissions[]" multiple style="width: 100%;">
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->id }}">{{ $permission->description }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-outline-success mb-2 mr-2" style="float:left;"><i class="fa fa-save"></i> ذخیره</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8 box-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-2">نقش های کاربری</h4>
                            <hr>

                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>عنوان نقش</th>
                                        <th>توضیح</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->title }}</td>
                                            <td>{{ $role->description }}</td>
                                            <td>
                                                @if ($role->isActive == 1 )
                                                    <div class='badge badge-success'>فعال</div>
                                                @else
                                                    <div class='badge badge-danger'>غیرفعال</div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('roles.edit',$role->id) }}" style="font-size:20px;float: right;margin-left:5px"><i class="fa fa-edit" style="color:#04a9f5;"></i></a>
                                                {{-- <form action="{{ route('roles.destroy',$role->id) }}" method="POST" onsubmit="return confirm('آیا از حذف رکورد مورد نظر اطمینان دارید؟');">
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
