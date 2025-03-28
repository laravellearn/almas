@section('title', 'Database Import')
@extends('vendor.InstallerEragViews.app-layout')
@section('content')
    <section class="mt-4">
        <div class="container">
            <form action="{{ route('saveWizard') }}" method="post" class="card">
                @csrf
                <div class="card-body">
                    <div class="tab">
                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <x-install-input label="نام اپلیکیشن" required="ture" name="app_name" type="text"
                                    value="{{ old('app_name') }}" />
                                <x-install-error for="app_name" />
                            </div>

                            <div class="col-md-4 mb-3">
                                <x-install-select label="محیط برنامه" class="form-control" required="ture" name="environment">
                                    <option value="">--Select--</option>
                                    <option value="local" selected>Local</option>
                                    <option value="development">Development</option>
                                    <option value="qa">Qa</option>
                                    <option value="production">Production</option>
                                    <option value="other">Other</option>
                                </x-install-select>
                            </div>

                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="app_debug" class="mr-8">
                                        اشکال زدایی برنامه
                                    </label>
                                    <label for="app_debug_true">
                                        <input type="radio" name="app_debug" id="app_debug_true" value="true"
                                            checked="">
                                        بله
                                    </label>
                                    <label for="app_debug_false">
                                        <input type="radio" name="app_debug" id="app_debug_false" value="false">
                                        خیر
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <x-install-select label="سطح گزارش برنامه" class="form-control" required="ture" name="app_log_level">
                                    <option value="debug" selected>debug</option>
                                    <option value="info">info</option>
                                    <option value="notice">notice</option>
                                    <option value="warning">warning</option>
                                    <option value="error">error</option>
                                    <option value="critical">critical</option>
                                    <option value="alert">alert</option>
                                    <option value="emergency">emergency</option>
                                    </select>
                                </x-install-select>
                            </div>

                            @php
                                $isHttps = app('request')->isSecure();
                                $protocol = $isHttps ? 'https://' : 'http://';
                                $base_url = $protocol . app('request')->getHttpHost();
                            @endphp

                            <div class="col-md-4 mb-3">
                                <x-install-input label="آدرس(URL)" required="ture" name="app_url" type="url"
                                    value="{{ old('app_url', $base_url) }}" />
                                <x-install-error for="app_url" />
                            </div>

                            <div class="col-md-4 mb-3"></div>


                            <div class="col-md-4 mb-3">
                                <x-install-select label="نوع دیتابیس" class="form-control" required="ture"
                                    name="database_connection">
                                    <option value="mysql" selected>mysql</option>
                                    <option value="sqlite">sqlite</option>
                                    <option value="pgsql">pgsql</option>
                                    <option value="sqlsrv">sqlsrv</option>
                                </x-install-select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <x-install-input label="هاست دیتابیس" required="ture" name="database_hostname" type="text"
                                    value="{{ old('database_hostname', '127.0.0.1') }}" />
                                <x-install-error for="database_hostname" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <x-install-input label="پورت دیتابیس" required="ture" name="database_port" type="text"
                                    value="{{ old('database_port', '3306') }}" />
                                <x-install-error for="database_port" />

                            </div>
                            <div class="col-md-4 mb-3">
                                <x-install-input label="نام دیتابیس" required="ture" name="database_name" type="text"
                                    value="{{ old('database_name') }}" />
                                <x-install-error for="database_name" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <x-install-input label="نام کاربری دیتابیس" required="ture" name="database_username" type="text"
                                    value="{{ old('database_username') }}" />
                                <x-install-error for="database_username" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <x-install-input label="رمز عبور دیتابیس" name="database_password"
                                    type="text" value="{{ old('database_password') }}" />
                                <x-install-error for="database_password" />
                            </div>

                        </div>

                    </div>
                </div>

                <div class="card-footer text-end">
                    <div class="d-flex">
                        <button type="submit" id="next_button" class="btn btn-primary ms-auto">مرحله بعدی</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
