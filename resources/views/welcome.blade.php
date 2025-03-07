@extends('layouts.master')
@section('title','داشبورد')
@section('content')
<div class="main-content">
    <nav aria-label="خرده نان" class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
        </ol>
    </nav>

    <div class="dashboard-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-4 height-card box-margin">
                    <div class="card">
                        <div class="card-body py-4">
                            <div class="media align-items-center">
                                <div class="d-inline-block mr-3">
                                    <i class="icon_cart_alt font-30 text-success"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="mb-2 font-24">{{ $products }}</h3>
                                    <div class="mb-0 font-14 font-weight-bold">تعداد کالاهای ثبت شده</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 height-card box-margin">
                    <div class="card">
                        <div class="card-body py-4">
                            <div class="media align-items-center">
                                <div class="d-inline-block mr-3">
                                    <i class="fa fa-user font-30 text-success"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="mb-2 font-24">{{ $employees }}</h3>
                                    <div class="mb-0 font-14 font-weight-bold">تعداد کارمندان</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 height-card box-margin">
                    <div class="card">
                        <div class="card-body py-4">
                            <div class="media align-items-center">
                                <div class="d-inline-block mr-3">
                                    <i class="fa fa-dropbox font-30 text-success"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="mb-2 font-24">{{ $repairs }}</h3>
                                    <div class="mb-0 font-14 font-weight-bold">تعداد کالاهای تعمیری</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12 box-margin">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">گزارشات سیستمی</h5>
                            <div class="product-table-area">
                                <div class="table-responsive" id=" ">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>آیپی کاربر</th>
                                                <th>نام</th>
                                                <th>شرح عملیات</th>
                                                <th>نوع عملیات</th>
                                                <th>تاریخ و ساعت</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($logs as $log)
                                            <tr>
                                                <td>{{ $log->ip }}</td>
                                                <td>{{ $log->user->name }}</td>
                                                <td>{{ $log->description }}</td>
                                                <td>
                                                    @switch($log->action)
                                                        @case('create')
                                                            <span class="badge badge-success">ایجاد</span>
                                                        @break

                                                        @case('update')
                                                            <span class="badge badge-primary">ویرایش</span>
                                                        @break

                                                        @case('delete')
                                                            <span class="badge badge-warning">حذف موقت</span>
                                                        @break

                                                        @case('forceDelete')
                                                            <span class="badge badge-dangar">حذف کامل</span>
                                                        @break

                                                        @case('restore')
                                                            <span class="badge badge-info">بازیابی</span>
                                                        @break

                                                        @case('login')
                                                            <span class="badge badge-info">ورود</span>
                                                        @break

                                                        @case('logout')
                                                            <span class="badge badge-info">خروج</span>
                                                        @break

                                                        @default
                                                    @endswitch
                                                </td>

                                                <td>{{ $log->created_at }}</td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@endsection
