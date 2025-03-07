@extends('layouts.master')
@section('title', 'لیست انتقال انبار به انبار')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">لیست انتقال انبار به انبار</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">لیست انتقالی ها</h4>
                                {{-- <a href="{{ route('products.trashed.get') }}" type="button"
                                    class="btn btn-danger mb-2 mr-2" style="float:left;margin-top:-37px;"><i
                                        class="fa fa-refresh"></i>
                                    سطل زباله
                                    ({{ $productCount }})
                                </a> --}}
                                <hr>

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>از سازمان</th>
                                            <th>به سازمان</th>
                                            <th>نام کالا</th>
                                            <th>تعداد</th>
                                            <th>تحویل دهنده</th>
                                            <th>تحویل گیرنده</th>
                                            <th>تاریخ انتقال</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($transfers as $transfer)
                                            <tr>
                                                @php
                                                    $fromOrganization = \App\Models\Organization::where('id', $transfer->fromOrganization)->first();
                                                    $toOrganization = \App\Models\Organization::where('id', $transfer->toOrganization)->first();
                                                    $approveUser = \App\Models\User::where('id', $transfer->approveUser)->first();
                                                @endphp
                                                <td>{{ $fromOrganization->title }}</td>
                                                <td>{{ $toOrganization->title }}</td>
                                                <td>{{ $transfer->product->title }}</td>
                                                <td>{{ $transfer->number }}</td>
                                                <td>{{ $transfer->user->name }}</td>
                                                <td>{{ $approveUser->name }}</td>
                                                <td>{{ $transfer->transferDate }}</td>

                                                <td>
                                                    @if ($transfer->isApproved == 1)
                                                        <span class="badge badge-success" style="border: none">تائید
                                                            شده</span>
                                                    @elseif ($transfer->isDenied == 0)
                                                        <span class="badge badge-danger" style="border: none">منتظر تائید
                                                        </span>
                                                    @endif

                                                    @if ($transfer->isDenied == 1)
                                                        <span class="badge badge-danger" style="border: none">رد شده
                                                        </span>
                                                    @endif

                                                    @if ($transfer->isRead == 1)
                                                        <span class="badge badge-success" style="border: none">توسط گیرنده خوانده شده</span>
                                                    @else
                                                        <span class="badge badge-danger" style="border: none">توسط گیرنده خوانده نشده</span>
                                                    @endif

                                                </td>

                                                <td>
                                                    @if ($transfer->isDenied == 0 && $transfer->isApproved == 0)
                                                        <a href="{{ route('transfers.add.product', $transfer->id) }}"
                                                            style="font-size:20px;float: right;margin-left:5px"><i
                                                                class="fa fa-eye" style="color:#04a9f5;"></i></a>
                                                    @endif
                                                    {{-- <form action="{{ route('products.destroy', $product->id) }}"
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
