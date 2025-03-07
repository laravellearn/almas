@extends('layouts.master')
@section('title', 'ویرایش کالای اسقاطی')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">ویرایش کالای اسقاطی</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 box-margin height-card">
                        <div class="card card-body">
                            <h4 class="card-title">ویرایش کالای اسقاطی</h4>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form action="{{ route('abortions.update', $abortion->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail12">دسته بندی اصلی:</label>
                                                <select class="js-example-basic-single form-control"
                                                    name="parentCategory_id" id="parentCategoryId" style="width: 100%;">
                                                    <option value="">--هیچکدام--</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ $category->id == $abortion->parentCategory_id ? 'selected' : '' }}>{{ $category->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail12">دسته بندی فرعی:</label>
                                                <select class="js-example-basic-single form-control" name="childCategory_id"
                                                    id="childCategory_id" style="width: 100%;">
                                                </select>
                                            </div>




                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail111">عنوان کالا:</label>
                                                <input type="text" class="form-control" name="title" required
                                                    value="{{ $abortion->title }}" id="exampleInputEmail111">
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail12">تعداد:</label>
                                                <input type="number" class="form-control" name="entity"
                                                    value="{{ $abortion->entity }}" id="exampleInputEmail111">
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail12">برند:</label>
                                                <select class="js-example-basic-single form-control" name="brand_id"
                                                    style="width: 100%;">
                                                    <option value="">--هیچکدام--</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}"
                                                            {{ $brand->id == $abortion->brand_id ? 'selected' : '' }}>
                                                            {{ $brand->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="inputGroupFile02">تاریخ دریافت:</label>

                                                <input type="text" id="observer-example" name="inputDate" required value="{{ $abortion->inputDate }}"
                                                    class="form-control observer-example">
                                                <span id="span1"></span>

                                            </div>



                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail12">سازمان:</label>
                                                <select class="js-example-basic-single form-control" name="organization_id"
                                                    style="width: 100%;">
                                                    <option value="">--هیچکدام--</option>
                                                    @foreach ($organizations as $organization)
                                                        <option value="{{ $organization->id }}"
                                                            {{ $organization->id == $abortion->organization_id ? 'selected' : '' }}>
                                                            {{ $organization->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail12">انبار:</label>
                                                <select class="js-example-basic-single form-control" name="store_id"
                                                    id="store_id" style="width: 100%;">
                                                </select>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail12">مربوط به کاربر:</label>
                                                <select class="js-example-basic-single form-control" name="employee_id"
                                                    id="employee_id" style="width: 100%;">
                                                </select>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail12">توضیح:</label>
                                                <textarea class="form-control" name="description" id="exampleInputEmail111">{{ $abortion->description }}</textarea>
                                            </div>


                                        <div class="checkbox checkbox-primary d-inline">
                                            <input type="checkbox" name="isActive" id="checkbox-p-1"
                                                {{ $abortion->isActive ? 'checked' : '' }}>
                                            <label for="checkbox-p-1" class="cr">فعال</label>
                                        </div>

                                        <button type="submit" class="btn btn-outline-success mb-2 mr-2"
                                            style="float:left;"><i class="fa fa-save"></i> ویرایش</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end row-->

            </div>
        </div>
    </div>



@endsection
@section('scripts')
    <!-- تاریخ شمسی  -->
    <script type="text/javascript" src="{{ asset('js/persian-date.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/persian-datepicker.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.observer-example').persianDatepicker({
                observer: true,
                format: 'YYYY/MM/DD',
                altField: '.observer-example-alt',
                initialValue: false
            });

        });


        $(document).ready(function() {
            //انتخاب واحد مادر
            $('#organization_id').on('change', function() {
                var organization_id = $(this).val();
                if (organization_id) {
                    $.ajax({
                        url: '/stocks/getEmployee/' + organization_id,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#employee_id').empty();
                                $('#employee_id').append(
                                    '<option value="">انتخاب پرسنل</option>');
                                $.each(data, function(key, employee_id) {
                                    $('select[name="employee_id"]').append(
                                        '<option value="' + employee_id.id +
                                        '">' + employee_id
                                        .name  + ' / ' + employee_id
                                        .personalID  + '</option>');
                                });
                            } else {
                                $('#employee_id').empty();
                            }
                        }
                    });
                } else {
                    $('#employee_id').empty();
                }
            });


        });

        $(document).ready(function() {
            //انتخاب دسته بندی فرزند
            $('#parentCategoryId').on('change', function() {
                var parentCategoryId = $(this).val();
                if (parentCategoryId) {
                    $.ajax({
                        url: '/stocks/getCategory/' + parentCategoryId,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#childCategory_id').empty();
                                $('#childCategory_id').append(
                                    '<option value="">انتخاب دسته بندی فرعی</option>');
                                $.each(data, function(key, childCategory_id) {
                                    $('select[name="childCategory_id"]').append(
                                        '<option value="' + childCategory_id.id +
                                        '">' + childCategory_id
                                        .title + '</option>');
                                });
                            } else {
                                $('#childCategory_id').empty();
                            }
                        }
                    });
                } else {
                    $('#childCategory_id').empty();
                }
            });

            //getStore
            $('#organization_id').on('change', function() {
                var organization_id = $(this).val();
                if (organization_id) {
                    $.ajax({
                        url: '/stocks/getStore/' + organization_id,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#store_id').empty();
                                $('#store_id').append(
                                    '<option value="">انتخاب انبار</option>');
                                $.each(data, function(key, store_id) {
                                    $('select[name="store_id"]').append(
                                        '<option value="' + store_id.id +
                                        '">' + store_id
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
