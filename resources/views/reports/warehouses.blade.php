@extends('layouts.master')
@section('title', 'گزارش جامع انبار')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">گزارش جامع انبار</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">فیلتر گزارش</h4>
                                <hr>
                                <form action="{{ route('warehouse.filter') }}" method="get">
                                    <div class="row">
                                        <div class="col-12 col-lg-2">
                                            <label for="exampleInputEmail12">انتخاب سازمان:</label>
                                            <select name="organization" id="organization_id"
                                                class="js-example-basic-single form-control">
                                                <option value="all">همه سازمان ها</option>
                                                @foreach ($organizations as $organization)
                                                    <option value="{{ $organization->id }}">{{ $organization->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-2">
                                            <label for="exampleInputEmail12">انتخاب انبار:</label>
                                            <select name="store" id="store_id"
                                                class="js-example-basic-single form-control">
                                                <option value="all">همه انبار ها</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-2">
                                            <label for="exampleInputEmail12">وضعیت موجودی:</label>
                                            <select name="status" class="js-example-basic-single form-control">
                                                <option value="all">همه وضعیت ها</option>
                                                <option value="off">ناموجود</option>
                                                <option value="on">موجود</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-2">
                                            <label for="exampleInputEmail12">نوع کالا:</label>
                                            <select name="type" class="js-example-basic-single form-control">
                                                <option value="all">همه کالا ها</option>
                                                <option value="products">کالاها</option>
                                                <option value="stocks">کالای دست دوم</option>
                                                <option value="abortions">کالای اسقاطی</option>
                                                <option value="repairs">کالای تعمیری</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-1">
                                            <button type="submit" style="font-weight:bold;font-size:14px;margin-top:29px"
                                                class="btn btn-success mb-2 mr-2"> اعمال</button>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">نتیجه گزارش</h4>
                                <hr>

                                <h5 style="text-align: center">داده ها فیلتر نشده است ....</h5>


                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {


            //getStore
            $('#organization_id').on('change', function() {
                var organization_id = $(this).val();
                if (organization_id) {
                    $.ajax({
                        url: '/products/getStore/' + organization_id,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#store_id').empty();
                                $('#store_id').append(
                                    '<option value="all">همه انبار ها</option>');
                                $.each(data, function(key, store) {
                                    $('select[name="store"]').append(
                                        '<option value="' + store.id +
                                        '">' + store
                                        .title + '</option>');
                                });
                            } else {
                                $('#store_id').empty();
                            }
                        }
                    });
                } else {
                    $('#store_id').empty();
                }
            });

        });
    </script>

@endsection
