@extends('layouts.app')
@section('title', 'ثبت لایسنس')

@section('content')
    <div class="main-content">
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 box-margin height-card">
                        <div class="card card-body">
                            <h4 class="card-title">ثبت لایسنس</h4>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">

                                    @php
                                        $id = 1;
                                    @endphp
                                    <form action="{{ route('license.update',$id) }}" method="POST">

                                        @method('patch')
                                        @csrf
                                        @if (isset($errors))
                                            {{ $errors }}
                                        @endif
                                        <div class="row">

                                            <div class="form-group col-4">
                                                <label for="exampleInputEmail111">نام کاربری:</label>
                                                <input type="text" class="form-control" name="username" required
                                                    placeholder="نام کاربری شما در راست چین" id="exampleInputEmail111">
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="exampleInputEmail111">شماره سفارش:</label>
                                                <input type="text" class="form-control" name="order_id" required
                                                    placeholder="شماره سفارش" id="exampleInputEmail111">
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="exampleInputEmail111">دامنه:</label>
                                                <input type="text" class="form-control" name="domain" required
                                                    placeholder="لایسنس برای چه دامنه ای است؟" id="exampleInputEmail111">
                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-outline-success mb-2 mr-2"
                                            style="float:left;"><i class="fa fa-save"></i> ثبت لایسنس</button>
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
