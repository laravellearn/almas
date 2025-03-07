@extends('layouts.master')
@section('title', 'کاربران سیستم')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">کاربران سیستم</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4 box-margin height-card">
                        <div class="card card-body">
                            <h4 class="card-title">افزودن کاربر سیستم</h4>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form action="{{ route('users.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail111">نام و نام خانوادگی:</label>
                                            <input type="text" class="form-control" name="name" required
                                                id="exampleInputEmail111">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail12">رمز عبور:</label>
                                            <input type="text" class="form-control" name="password"
                                                id="exampleInputEmail111">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail12">ایمیل سازمانی:</label>
                                            <input type="text" class="form-control" name="email"
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
                                            <label for="exampleInputEmail12">انتخاب نقش کاربری:</label>
                                            <select class="js-example-basic-single form-control" name="role_id"
                                                style="width: 100%;">
                                                <option value="">--هیچکدام--</option>
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
                                <h4 class="card-title mb-2">لیست کاربران سیستم</h4>
                                <hr>

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>نام و نام خانوادگی</th>
                                            <th>ایمیل سازمانی</th>
                                            <th>سازمان</th>
                                            <th>نقش کاربری</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($users as $user)
                                            @if (\Auth::user()->organization_id == $user->organization->id || \Auth::user()->isAdmin==1)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->organization->title }}</td>
                                                    <td>
                                                        @foreach ($user->roles as $role)
                                                            {{ $role->description }} -
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @if ($user->isActive == 1)
                                                            <div class='badge badge-success'>فعال</div>
                                                        @else
                                                            <div class='badge badge-danger'>غیرفعال</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('users.edit', $user->id) }}"
                                                            style="font-size:20px;float: right;margin-left:5px"><i
                                                                class="fa fa-edit" style="color:#04a9f5;"></i></a>
                                                        {{-- <form action="{{ route('users.destroy', $user->id) }}"
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
                                            @endif
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
