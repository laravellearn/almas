@extends('layouts.master')
@section('title', 'گزارشات سیستم')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">گزارشات سیستم</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">گزارشات سیستم</h4>
                                <hr>

                                <table id="" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ip System</th>
                                            <th>کاربر</th>
                                            <th>شرح عملیات</th>
                                            <th>عملیات</th>
                                            <th>تاریخ</th>
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

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>



@endsection
