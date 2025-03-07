@extends('layouts.master')
@section('title', 'ویرایش کالا')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">ویرایش کالا</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 box-margin height-card">
                        <div class="card card-body">
                            <h4 class="card-title">ویرایش کالا</h4>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        @include('errors.errors')

                                        <div class="row">

                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail12">دسته بندی اصلی:</label>
                                                <select class="js-example-basic-single form-control"
                                                    name="parentCategory_id" id="parentCategoryId" style="width: 100%;">
                                                    <option value="">--هیچکدام--</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $category->id == $product->parentCategory_id ? 'selected' : '' }}>
                                                            {{ $category->title }}
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
                                                    value="{{ $product->title }}" id="exampleInputEmail111">
                                            </div>


                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail12">موجودی اولیه:</label>
                                                <input type="number" class="form-control" name="entity"
                                                    value="{{ $product->entity }}" id="exampleInputEmail111">
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail12">سازمان:</label>
                                                <select class="js-example-basic-single form-control" name="organization_id"
                                                    id="organization_id" style="width: 100%;">
                                                    <option value="">--هیچکدام--</option>
                                                    @foreach ($organizations as $organization)
                                                        <option value="{{ $organization->id }}"
                                                            {{ $organization->id == $product->organization_id ? 'selected' : '' }}>
                                                            {{ $organization->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>



                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail12">انبار:</label>
                                                <select class="js-example-basic-single form-control" name="store_id" id="store_id"
                                                    style="width: 100%;">
                                                </select>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail12">برند:</label>
                                                <select class="js-example-basic-single form-control" name="brand_id"
                                                    style="width: 100%;">
                                                    <option value="">--هیچکدام--</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}"
                                                            {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                                            {{ $brand->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail12">حد سفارش:</label>
                                                <input type="number" class="form-control" name="orderLimit" value="{{ $product->orderLimit }}"
                                                    id="exampleInputEmail111">
                                            </div>

                                            <div class="form-group col-12">
                                                <label for="exampleInputEmail12">توضیح:</label>
                                                <textarea class="form-control" name="description" id="exampleInputEmail111"> {{ $product->description }}</textarea>
                                            </div>



                                        </div>



                                        <div class="checkbox checkbox-primary d-inline">
                                            <input type="checkbox" name="isActive" id="checkbox-p-1"
                                                {{ $product->isActive ? 'checked' : '' }}>
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

    <script>
        $(document).ready(function() {
            //انتخاب دسته بندی فرزند
            $('#parentCategoryId').on('change', function() {
                var parentCategoryId = $(this).val();
                if (parentCategoryId) {
                    $.ajax({
                        url: '/index.php/products/getCategory/' + parentCategoryId,
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
