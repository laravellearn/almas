@extends('layouts.master')
@section('title', 'انبار ها')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">انبار ها</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4 box-margin height-card">
                        <div class="card card-body">
                            <h4 class="card-title">افزودن انبار</h4>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form action="{{ route('stores.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail111">عنوان انبار:</label>
                                            <input type="text" class="form-control" name="title" required
                                                id="exampleInputEmail111">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail111">توضیحات انبار:</label>
                                            <input type="text" class="form-control" name="description" required
                                                id="exampleInputEmail111">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail12">نام سازمان:</label>
                                            <select class="js-example-basic-single form-control" required
                                                name="organization_id" style="width: 100%;">
                                                <option value="">--هیچکدام--</option>
                                                @if (\Auth::user()->isAdmin == 1)
                                                    @foreach ($organizations as $organization)
                                                        <option value="{{ $organization->id }}">
                                                            {{ $organization->description }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="{{ \Auth::user()->organization_id }}">
                                                        {{ \Auth::user()->organization->title }}</option>
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail12">نقش های کاربری مجاز:</label>
                                            <select class="js-example-basic-single form-control" multiple name="roles[]"
                                                style="width: 100%;">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-outline-success mb-2 mr-2"
                                            style="float:left;"><i class="fa fa-save"></i> ذخیره</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-8 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">انبار ها</h4>
                                <hr>

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>عنوان انبار</th>
                                            <th>سازمان</th>
                                            <th>نقش های مجاز</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($stores as $store)
                                            <tr>
                                                <td>{{ $store->title }}</td>
                                                <td>{{ $store->organization->title }}</td>
                                                <td>
                                                    @foreach ($store->roles as $role)
                                                        {{ $role->description }} -
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if ($store->isActive == 1)
                                                        <div class='badge badge-success'>فعال</div>
                                                    @else
                                                        <div class='badge badge-danger'>غیرفعال</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('stores.edit', $store->id) }}"
                                                        style="font-size:20px;float: right;margin-left:5px"><i
                                                            class="fa fa-edit" style="color:#04a9f5;"></i></a>
                                                    {{-- <form action="{{ route('stores.destroy', $store->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('آیا از حذف رکورد مورد نظر اطمینان دارید؟');">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit"
                                                            style="font-size:20px;border: none;background-color: transparent;float: right;">
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
