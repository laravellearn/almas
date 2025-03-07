@extends('layouts.master')
@section('title', 'تاریخچه موجودی ها')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">تاریخچه موجودی ها</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">تاریخچه موجودی ها</h4>
                                <hr>

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ip System</th>
                                            <th>کاربر</th>
                                            <th>شرح عملیات</th>
                                            <th>انبار</th>
                                            <th>عملیات</th>
                                            <th>تاریخ</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($histories as $history)
                                            <tr>
                                                <td>{{ $history->ip }}</td>
                                                <td>{{ $history->user->name }}</td>
                                                <td>{{ $history->description }}</td>
                                                <td>{{ $history->store }}</td>
                                                <td>
                                                    @switch($history->action)
                                                        @case('increment')
                                                            <span class="badge badge-success">افزایش موجودی</span>
                                                        @break

                                                        @case('decrement')
                                                            <span class="badge badge-primary">کاهش موجودی</span>
                                                        @break

                                                        @case('transfer')
                                                            <span class="badge badge-warning">انتقال</span>
                                                        @break

                                                        @case('delivery')
                                                            <span class="badge badge-dangar">تحویل به کاربر</span>
                                                        @break

                                                        @case('entity')
                                                            <span class="badge badge-info">موجودی اولیه</span>
                                                        @break

                                                        @case('editEntity')
                                                            <span class="badge badge-info">ویرایش تعداد</span>
                                                        @break

                                                        @default
                                                    @endswitch
                                                </td>
                                                <td>{{ $history->created_at }}</td>

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
