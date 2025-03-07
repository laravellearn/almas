@extends('layouts.app')

@section('content')
<div class="main-content- h-100vh">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-12">
                <!-- Middle Box -->
                <div class="middle-box">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="xs-d-none mb-50-xs break-320-576-none">
                                        <img src="{{ asset('img/bg-img/1.png') }}" alt="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Logo -->
                                    <h4 class="font-18 mb-30">ورود به پنل مدیریت</h4>

                                    @include('errors.errors')
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="float-left" for="emailaddress">نام کاربری:</label>
                                            <input class="form-control" type="email" name="email" id="emailaddress" required="" placeholder="">
                                        </div>

                                        <div class="form-group">
                                            <a href="forget-password.html" class="text-dark float-right"></a>
                                            <label class="float-left" for="password">رمز عبور:</label>
                                            <input class="form-control" type="password" required="" name="password" id="password" placeholder="">
                                        </div>

                                        <div class="form-group d-flex justify-content-between align-items-center mb-3">
                                            <div class="checkbox d-inline mb-0">
                                                <input type="checkbox" name="checkbox-1" id="checkbox-8">
                                                <label for="checkbox-8" class="cr mb-0">مرا بخاطر بسپار</label>
                                            </div>
                                        </div>

                                        <div class="form-group mb-0">
                                            <button class="btn btn-primary btn-block" type="submit" style="font-weight:bold;font-size:17px;">ورود </button>
                                        </div>

                                    </form>
                                </div> <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
