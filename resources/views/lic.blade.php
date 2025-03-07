<?php
function send($api,$username,$order_id,$domain,$productId="new Product"){
	$url = 'https://www.rtl-theme.com/oauth/';
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,"api=$api&username=$username&order_id=$order_id&domain=$domain&pid=$productId");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$res = curl_exec($ch);
	curl_close($ch);
	return $res;
}
$api = 'rtlead27bc21537fdcb11b3b340a53242'; // API اختصاصی فروشنده
$username = $_POST['username']; //نام کاربری خریدار
$order_id = $_POST['orderid']; // شماره سفارش 
$domain = $_POST['domain']; //دامنه
$productId = $_POST['productId']; // شناسه محصول
$result = send($api,$username,$order_id,$domain,$productId);
switch ($result) {
	case '1':
		$error = NULL;
		break;
	case '-1':
		$error = 'API اشتباه است';
	break;
	case '-2':
		$error = 'نام کاربری اشتباه است';
	break;
	case '-3':
		$error = 'کد سفارش اشتباه است';
	break;
	case '-4':
		$error = 'کد سفارش قبلاً ثبت شده است';
	break;
	case '-5':
		$error = 'کد سفارش مربوطه به این نام کاربری نمیباشد.';
	break;
	case '-6':
		$error = 'اطلاعات وارد شده  در فرمت صحیح نمیباشند!';
	break;
	case '-7':
		$error = 'کد سفارش مربوط به این محصول نیست';
		break;
	case '-8':
		$error = 'کد سفارش مربوطه به این نام کاربری نمیباشد.';
		break;
	default:
		$error = 'خطای غیرمنتظره رخ داده است';
	break;
}
?>

@extends('layouts.master')
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
                                    <form action="{{ route('products.store') }}" method="POST">
                                        @csrf
                                        @include('errors.errors')
                                        <div class="row">

                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail111">نام کاربری:</label>
                                                <input type="text" class="form-control" name="username" required placeholder="نام کاربری شما در راست چین"
                                                    id="exampleInputEmail111">
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail111">شماره سفارش:</label>
                                                <input type="text" class="form-control" name="orderid" required placeholder="شماره سفارش"
                                                    id="exampleInputEmail111">
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail111">دامنه:</label>
                                                <input type="text" class="form-control" name="domain" required placeholder="لایسنس برای چه دامنه ای است؟"
                                                    id="exampleInputEmail111">
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="exampleInputEmail111">نام کاربری:</label>
                                                <input type="text" class="form-control" name="username" required placeholder="نام کاربری شما در راست چین"
                                                    id="exampleInputEmail111">
                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-outline-success mb-2 mr-2"
                                            style="float:left;"><i class="fa fa-save"></i> ثبت</button>
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