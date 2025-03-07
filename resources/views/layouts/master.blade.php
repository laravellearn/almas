<?php

use Hekmatinasser\Verta\Verta; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->
    <title>مدیریت کالا | @yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/core-img/favicon.png') }}">
    <!-- These plugins only need for the run this page -->
    <link rel="stylesheet" href="{{ asset('css/default-assets/datatables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default-assets/responsive.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default-assets/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default-assets/select.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('style.css') }}">


    @yield('styles')

</head>

<body>
    @include('sweetalert::alert')


    <!-- ======================================
    ******* Page Wrapper Area Start **********
    ======================================= -->
    <div class="ecaps-page-wrapper">
        <!-- Sidemenu Area -->
        <div class="ecaps-sidemenu-area">
            <!-- Desktop Logo -->
            <div class="ecaps-logo">
                <a href="/"><img class="desktop-logo" src="{{ asset('img/core-img/logo.png') }}"
                        alt="لوگوی دسک تاپ">
                    <img class="small-logo" src="{{ asset('img/core-img/small-logo.png') }}" alt="آرم موبایل"></a>
            </div>

            <!-- Side Nav -->
            <div class="ecaps-sidenav" id="ecapsSideNav">
                <!-- Side Menu Area -->
                <div class="side-menu-area">
                    <!-- Sidebar Menu -->

                    <nav>
                        <ul class="sidebar-menu" data-widget="tree">

                            <li class=" {{ Request::routeIs(['index']) ? 'active' : '' }}">
                                <a href="{{ route('index') }}"><i
                                        class="zmdi zmdi-view-dashboard"></i><span>داشبورد</span></a>
                            </li>

                            {{-- <li class=" {{ Request::routeIs('index') ? 'active' : '' }}"><a href="/"><i class="zmdi zmdi-view-dashboard"></i><span>داشبورد</span></a></li> --}}
                            <li
                                class="treeview {{ Request::routeIs(['products.index', 'products.edit', 'products.update', 'products.trashed', 'products.create']) ? 'menu-open' : '' }}">
                                @canany(['product-add', 'products'])
                                    <a href="javascript:void(0)"><i class="fa fa-cubes"></i> <span>کالاها</span> <i
                                            class="fa fa-angle-left"></i></a>
                                @endcanany
                                <ul class="treeview-menu"
                                    style="{{ Request::routeIs(['products.index', 'products.edit', 'products.update', 'products.trashed', 'products.create']) ? 'display:block' : '' }}">
                                    @can('product-add')
                                        <li
                                            class="{{ Request::routeIs(['products.edit', 'products.create']) ? 'active' : '' }}">
                                            <a href="{{ route('products.create') }}">ثبت کالا</a>
                                        </li>
                                    @endcan
                                    @can('products')
                                        <li
                                            class="{{ Request::routeIs(['products.index', 'products.trashed.get']) ? 'active' : '' }}">
                                            <a href="{{ route('products.index') }}">لیست کالاها</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            @can('stocks')
                                <li
                                    class="treeview {{ Request::routeIs(['stocks.create', 'stocks.index']) ? 'menu-open' : '' }}">
                                    <a href="javascript:void(0)"><i class="fa fa-cubes"></i> <span>کالاهای دست
                                            دوم</span> <i class="fa fa-angle-left"></i></a>
                                    <ul class="treeview-menu"
                                        style="{{ Request::routeIs(['stocks.index', 'stocks.create']) ? 'display:block' : '' }}">
                                        <li class="{{ Request::routeIs(['stocks.create']) ? 'active' : '' }}"><a
                                                href="{{ route('stocks.create') }}">ثبت کالای دست دوم</a></li>
                                        <li class="{{ Request::routeIs(['stocks.index']) ? 'active' : '' }}"><a
                                                href="{{ route('stocks.index') }}">لیست کالای دست دوم</a></li>
                                    </ul>
                                </li>
                            @endcan

                            @can('abortions')
                                <li
                                    class="treeview {{ Request::routeIs(['abortions.create', 'abortions.index']) ? 'menu-open' : '' }}">
                                    <a href="javascript:void(0)"><i class="zmdi zmdi-codepen"></i> <span>کالاهای
                                            اسقاطی</span> <i class="fa fa-angle-left"></i></a>
                                    <ul class="treeview-menu"
                                        style="{{ Request::routeIs(['abortions.index', 'abortions.create']) ? 'display:block' : '' }}">
                                        <li class="{{ Request::routeIs(['abortions.create']) ? 'active' : '' }}"><a
                                                href="{{ route('abortions.create') }}">ثبت کالای اسقاطی</a></li>
                                        <li class="{{ Request::routeIs(['abortions.index']) ? 'active' : '' }}"><a
                                                href="{{ route('abortions.index') }}">لیست کالاهای اسقاطی</a></li>
                                    </ul>
                                </li>
                            @endcan

                            <li
                                class="treeview {{ Request::routeIs(['invoices.index', 'invoices.edit', 'invoices.update', 'invoices.trashed', 'invoices.create', 'details.list']) ? 'menu-open' : '' }}">
                                @canany(['invoice-add', 'invoice-product-list', 'product-add'])
                                    <a href="javascript:void(0)"><i class="zmdi zmdi-shopping-basket"></i>
                                        <span>فاکتورها</span> <i class="fa fa-angle-left"></i></a>
                                @endcanany

                                <ul class="treeview-menu"
                                    style="{{ Request::routeIs(['invoices.index', 'invoices.edit', 'invoices.update', 'invoices.create', 'invoices.detail.list']) ? 'display:block' : '' }}">
                                    @can('invoice-add')
                                        <li
                                            class="{{ Request::routeIs(['invoices.edit', 'invoices.create']) ? 'active' : '' }}">
                                            <a href="{{ route('invoices.create') }}">ثبت فاکتور</a>
                                        </li>
                                    @endcan
                                    @can('invoices')
                                        <li class="{{ Request::routeIs(['invoices.index']) ? 'active' : '' }}"><a
                                                href="{{ route('invoices.index') }}">لیست فاکتور ها</a></li>
                                    @endcan
                                    @can('invoice-product-list')
                                        <li class="{{ Request::routeIs(['invoices.detail.list']) ? 'active' : '' }}"><a
                                                href="{{ route('invoices.detail.list') }}">لیست اقلام خریداری شده</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>

                            {{-- <li
                                class="treeview {{ Request::routeIs(['reports.deliveries.index']) ? 'menu-open' : '' }}">
                            @canany(['reports'])
                            <a href="javascript:void(0)"><i class="zmdi zmdi-chart"></i> <span>گزارشات مدیر</span>
                                <i class="fa fa-angle-left"></i></a>
                            <ul class="treeview-menu" style="{{ Request::routeIs(['reports.deliveries.index']) ? 'display:block' : '' }}">
                                <li class="{{ Request::routeIs(['reports.deliveries.index']) ? 'active' : '' }}">
                                    <a href="{{ route('reports.deliveries.index') }}">گزارش تحویل کالا</a>
                                </li>
                            </ul>
                            @endcan
                            </li> --}}


                            @can('deliveries')
                                <li
                                    class=" {{ Request::routeIs(['deliveries.index', 'deliveries.edit']) ? 'active' : '' }}">
                                    <a href="{{ route('deliveries.index') }}"><i
                                            class="zmdi zmdi-view-dashboard"></i><span>تحویل کالا</span></a>
                                </li>
                            @endcan

                            @can('transfers')
                                <li
                                    class="treeview {{ Request::routeIs(['transfers.create', 'transfers.index']) ? 'menu-open' : '' }}">
                                    <a href="javascript:void(0)"><i class="zmdi zmdi-widgets"></i> <span>انتقال انبار به
                                            انبار</span> <i class="fa fa-angle-left"></i></a>
                                    <ul class="treeview-menu"
                                        style="{{ Request::routeIs(['transfers.index', 'transfers.create']) ? 'display:block' : '' }}">
                                        @can('transfers')
                                            <li class="{{ Request::routeIs(['transfers.create']) ? 'active' : '' }}"><a
                                                    href="{{ route('transfers.create') }}">ثبت انتقالی</a></li>
                                        @endcan
                                        <li class="{{ Request::routeIs(['transfers.index']) ? 'active' : '' }}"><a
                                                href="{{ route('transfers.index') }}">لیست انتقالی ها</a></li>
                                    </ul>
                                </li>
                            @endcan

                            @can('repairs')
                                <li
                                    class="treeview {{ Request::routeIs(['repairs.create', 'repairs.index']) ? 'menu-open' : '' }}">
                                    <a href="javascript:void(0)"><i class="fa fa-cubes"></i> <span>کالاهای تعمیری</span> <i
                                            class="fa fa-angle-left"></i></a>
                                    <ul class="treeview-menu"
                                        style="{{ Request::routeIs(['repairs.index', 'repairs.create']) ? 'display:block' : '' }}">
                                        <li class="{{ Request::routeIs(['repairs.create']) ? 'active' : '' }}"><a
                                                href="{{ route('repairs.create') }}">ثبت کالای تعمیری</a></li>
                                        <li class="{{ Request::routeIs(['repairs.index']) ? 'active' : '' }}"><a
                                                href="{{ route('repairs.index') }}">لیست کالای تعمیری</a></li>
                                    </ul>
                                </li>
                            @endcan

                            @canany(['logs', 'histories', 'report-warehouse'])
                                <li
                                    class="treeview {{ Request::routeIs(['logs.index', 'history.index', 'warehouse.index']) ? 'menu-open' : '' }}">
                                    <a href="javascript:void(0)"><i class="zmdi zmdi-chart"></i> <span>گزارشات</span> <i
                                            class="fa fa-angle-left"></i></a>
                                    <ul class="treeview-menu"
                                        style="{{ Request::routeIs(['logs.index', 'history.index', 'warehouse.index','warehouse.filter']) ? 'display:block' : '' }}">
                                        @can('report-warehouse')
                                            <li class=" {{ Request::routeIs(['warehouse.index','warehouse.filter']) ? 'active' : '' }}">
                                                <a href="{{ route('warehouse.index') }}"><span>گزارش جامع انبار</span></a>
                                            </li>
                                        @endcan
                                        {{-- @can('report-warehouse')
                                            <li class=" {{ Request::routeIs('warehouse.index') ? 'active' : '' }}">
                                                <a href="{{ route('warehouse.index') }}"><span>ردیابی کالا</span></a>
                                            </li>
                                        @endcan --}}
                                        @can('logs')
                                            <li class=" {{ Request::routeIs('logs.index') ? 'active' : '' }}">
                                                <a href="{{ route('logs.index') }}"><span>گزارشات
                                                        سیستم</span></a>
                                            </li>
                                        @endcan
                                        @can('histories')
                                            <li class=" {{ Request::routeIs('history.index') ? 'active' : '' }}">
                                                <a href="{{ route('history.index') }}"><span>تاریخچه
                                                        موجودی ها</span></a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan


                            <li
                                class="treeview {{ Request::routeIs(['employees.index', 'employees.edit', 'employees.update', 'employees.trashed.get']) ? 'menu-open' : '' }}">
                                @canany(['users', 'employees'])
                                    <a href="javascript:void(0)"><i class="zmdi zmdi-accounts-alt"></i>
                                        <span>کاربران</span>
                                        <i class="fa fa-angle-left"></i></a>
                                @endcan
                                <ul class="treeview-menu"
                                    style="{{ Request::routeIs(['employees.index', 'employees.edit', 'employees.update', 'employees.trashed.get', 'users.index', 'users.edit', 'users.update', 'users.trashed.get']) ? 'display:block' : '' }}">
                                    @can('users')
                                        <li
                                            class="{{ Request::routeIs(['users.index', 'users.edit', 'users.update', 'users.trashed.get']) ? 'active' : '' }}">
                                            <a href="{{ route('users.index') }}">کاربران سیستم</a>
                                        </li>
                                    @endcan
                                    @can('employees')
                                        <li
                                            class="{{ Request::routeIs(['employees.index', 'employees.edit', 'employees.update', 'employees.trashed.get']) ? 'active' : '' }}">
                                            <a href="{{ route('employees.index') }}">پرسنل سازمان</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li
                                class="treeview {{ Request::routeIs(['roles.index', 'roles.edit', 'roles.update', 'roles.trashed', 'permissions.index', 'permissions.edit', 'permissions.update', 'permissions.trashed']) ? 'menu-open' : '' }}">
                                @canany(['roles', 'permissions'])
                                    <a href="javascript:void(0)"><i class="fa fa-user-secret"></i> <span>سطوح
                                            دسترسی</span>
                                        <i class="fa fa-angle-left"></i></a>
                                @endcan
                                <ul class="treeview-menu"
                                    style="{{ Request::routeIs(['roles.index', 'roles.edit', 'roles.update', 'roles.trashed', 'permissions.index', 'permissions.edit', 'permissions.update', 'permissions.trashed']) ? 'display:block' : '' }}">
                                    @can('roles')
                                        <li
                                            class="{{ Request::routeIs(['roles.index', 'roles.edit', 'roles.update', 'roles.trashed']) ? 'active' : '' }}">
                                            <a href="{{ route('roles.index') }}">نقش ها</a>
                                        </li>
                                    @endcan
                                    @can('permissions')
                                        <li
                                            class="{{ Request::routeIs(['permissions.index', 'permissions.edit', 'permissions.update', 'permissions.trashed']) ? 'active' : '' }}">
                                            <a href="{{ route('permissions.index') }}">سطح دسترسی</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>

                            <li
                                class="treeview {{ Request::routeIs(['brands.index', 'brands.edit', 'brands.trashed.get', 'units.index', 'units.edit', 'units.trashed.get', 'categories.index', 'categories.edit', 'categories.trashed.get', 'stores.index', 'stores.edit', 'stores.trashed.get', 'organizations.index', 'organizations.edit']) ? 'menu-open' : '' }}">
                                @canany(['brands', 'stores', 'categories', 'units'])
                                    <a href="javascript:void(0)"><i class="zmdi zmdi-info"></i> <span>اطلاعات
                                            پایه</span> <i class="fa fa-angle-left"></i></a>
                                @endcan
                                <ul class="treeview-menu"
                                    style="{{ Request::routeIs(['brands.index', 'brands.edit', 'brands.trashed.get', 'units.index', 'units.edit', 'units.trashed.get', 'categories.index', 'categories.edit', 'categories.trashed.get', 'stores.index', 'stores.edit', 'stores.trashed.get', 'organizations.index', 'organizations.edit']) ? 'display:block' : '' }}">
                                    @can('units')
                                        <li
                                            class="{{ Request::routeIs(['units.index', 'units.edit', 'units.trashed.get']) ? 'active' : '' }}">
                                            <a href="{{ route('units.index') }}">واحدها</a>
                                        </li>
                                    @endcan
                                    @can('categories')
                                        <li
                                            class="{{ Request::routeIs(['categories.index', 'categories.edit', 'categories.trashed.get']) ? 'active' : '' }}">
                                            <a href="{{ route('categories.index') }}">دسته بندی ها</a>
                                        </li>
                                    @endcan

                                    @can('brands')
                                        <li
                                            class="{{ Request::routeIs(['brands.index', 'brands.edit', 'brands.trashed.get']) ? 'active' : '' }}">
                                            <a href="{{ route('brands.index') }}">برند ها</a>
                                        </li>
                                    @endcan
                                    @can('stores')
                                        <li
                                            class="{{ Request::routeIs(['stores.index', 'stores.edit', 'stores.trashed.get']) ? 'active' : '' }}">
                                            <a href="{{ route('stores.index') }}">انبار ها</a>
                                        </li>
                                    @endcan
                                    @can('organizations')
                                        <li
                                            class="{{ Request::routeIs(['organizations.index', 'organizations.edit']) ? 'active' : '' }}">
                                            <a href="{{ route('organizations.index') }}">سازمان ها</a>
                                        </li>
                                    @endcan

                                </ul>
                            </li>

                            {{-- @can('settings')
                                <li class=" {{ Request::routeIs(['settings.index']) ? 'active' : '' }}">
                                    <a href="{{ route('settings.index') }}"><i
                                            class="zmdi zmdi-settings"></i><span>تنظیمات</span></a>
                                </li>
                            @endcan --}}

                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="ecaps-page-content">
            <!-- Top Header Area -->
            <header class="top-header-area d-flex align-items-center justify-content-between">
                <div class="left-side-content-area d-flex align-items-center">
                    <!-- Mobile Logo -->
                    <div class="mobile-logo mr-3 mr-sm-4">
                        <a href="index.html"><img src="{{ asset('img/core-img/small-logo.png') }}"
                                alt="آرم موبایل"></a>
                    </div>

                    <!-- Triggers -->
                    <div class="ecaps-triggers mr-1 mr-sm-3">
                        <div class="menu-collasped" id="menuCollasped">
                            <i class="zmdi zmdi-menu"></i>
                        </div>
                        <div class="mobile-menu-open" id="mobileMenuOpen">
                            <i class="zmdi zmdi-menu"></i>
                        </div>
                    </div>

                    <!-- Left Side Nav -->
                    <ul class="left-side-navbar d-flex align-items-center">
                        <li class="hide-phone app-search">
                            <div class="dashboard-clock ltr">
                                <span>
                                    @php
                                        $v = new Verta(); //1396-02-02 15:32:08
                                        $v = verta(); //1396-02-02 15:32:08
                                        $v = $v->format('Y/n/j');
                                        echo $v;
                                    @endphp
                                </span><br>
                                <ul class="d-flex align-items-center justify-content-end">
                                    <li id="hours">12</li>
                                    <li>:</li>
                                    <li id="min">10</li>
                                    <li>:</li>
                                    <li id="sec">14</li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="right-side-navbar d-flex align-items-center justify-content-end">
                    <!-- Mobile Trigger -->
                    <div class="right-side-trigger" id="rightSideTrigger">
                        <i class="ti-align-left"></i>
                    </div>

                    <!-- Top Bar Nav -->
                    <ul class="right-side-content d-flex align-items-center">
                        @if (\App\Models\Transfer::where('approveUser', \Auth::user()->id)->where('isApproved', 0)->where('isRead', 0)->count() > 0)
                            <li class="nav-item dropdown">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="zmdi zmdi-volume-up"
                                        aria-hidden="true"></i>
                                    <span class="active-status"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- Top Notifications Area -->
                                    <div class="top-notifications-area">
                                        <!-- Heading -->
                                        <div class="notifications-heading">
                                            <div class="heading-title">
                                                <h6>تائید ها</h6>
                                            </div>
                                            <span>{{ \App\Models\Transfer::where('approveUser', \Auth::user()->id)->where('isApproved', 0)->where('isRead', 0)->count() }}
                                                جدید</span>
                                        </div>
                                        <div class="notifications-box" id="notificationsBox">

                                            @foreach (\App\Models\Transfer::where('approveUser', \Auth::user()->id)->where('isApproved', 0)->where('isRead', 0)->get() as $transfer)
                                                <a href="{{ route('transfers.add.product', $transfer->id) }}"
                                                    class="dropdown-item">
                                                    <i class="ti-bell"></i>
                                                    <span>
                                                        یک تائیدیه از طرف {{ $transfer->user->name }} دارید.
                                                    </span>
                                                </a>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </li>
                        @endif
                        @php
                            $notify = 0;
                        @endphp

                        <li class="nav-item dropdown">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                @foreach (\App\Models\Product::where('organization_id', \Auth::user()->organization_id)->where('isActive', 1)->get() as $product)
                                    @if ($product->entity <= $product->orderLimit && $product->isNotify == 1)
                                        @php
                                            $notify = $notify + 1;
                                        @endphp
                                    @endif
                                @endforeach
                                <span class="badge badge-pill badge-danger"
                                    style="font-size:9px;left: -10px;
                                    padding: 4px;">{{ $notify }}</span>
                                <i class="fa fa-bell-o" aria-hidden="true"></i>

                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- Top Notifications Area -->
                                <div class="top-notifications-area">
                                    <!-- Heading -->
                                    <div class="notifications-heading">
                                        <div class="heading-title">
                                            <h6>اطلاعیه ها</h6> </br> <span> جهت مخفی سازی پیام بر روی آیکن ردیف مورد
                                                نظر کلیک کنید</span>
                                        </div>
                                        <span></span>
                                    </div>
                                    <div class="notifications-box" id="notificationsBox">
                                        @foreach (\App\Models\Product::where('organization_id', \Auth::user()->organization_id)->where('isActive', 1)->get() as $product)
                                            @if ($product->entity <= $product->orderLimit && $product->isNotify == 1)
                                                <a class="dropdown-item">
                                                    <form action="{{ route('product.notify', $product->id) }}"
                                                        method="post">
                                                        @CSRF
                                                        <button type="submit"
                                                            style="background:transparent;border:none">
                                                            <i class="ti-bell"
                                                                style="padding-left:10px;color:red;font-size:20px"></i>
                                                        </button>
                                                    </form>
                                                    <span style="line-height:1.7">
                                                        کالا با مشخصات زیر به حد سفارش خود رسیده است. </br>
                                                        کالا: {{ $product->title }} </br>
                                                        انبار: {{ $product->store->title }} </br>
                                                        دسته بندی: {{ $product->parentCategory->title }} </br>
                                                        برند: {{ $product->brand->title }}
                                                        </br>
                                                        <span style="font-size:10px">حد سفارش:
                                                            {{ $product->orderLimit }} - موجودی:
                                                            {{ $product->entity }}</span>
                                                    </span>
                                                </a>
                                            @endif
                                        @endforeach


                                    </div>

                                </div>
                            </div>
                        </li>


                        <li class="nav-item dropdown">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><img
                                    src="{{ asset('img/member-img/3.png') }}" alt=""></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- User Profile Area -->
                                <div class="user-profile-area">
                                    <div class="user-profile-heading">
                                        <!-- Thumb -->
                                        <div class="profile-img">
                                            <img class="chat-img mr-2" src="{{ asset('img/member-img/3.png') }}"
                                                alt="">
                                        </div>
                                        <!-- Profile Text -->
                                        <div class="profile-text">
                                            <h6>{{ $user->name }}</h6>
                                            <span>
                                                @foreach ($user->roles as $role)
                                                    {{ $role->description }} -
                                                @endforeach
                                            </span>
                                        </div>
                                    </div>
                                    <a href="{{ route('profile.change.get') }}" class="dropdown-item"> <i
                                            class="zmdi zmdi-account profile-icon bg-primary" aria-hidden="true"></i>
                                        تغییر اطلاعات</a>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i
                                                class="fa fa-sign-out profile-icon bg-danger" aria-hidden="true"></i>
                                            خروج از سیستم</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </header>

            <!-- Main Content Area -->
            @yield('content')
        </div>
    </div>

    <!-- ======================================
********* Page Wrapper Area End ***********
======================================= -->

    <!-- Must needed plugins to the run this Template -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bundle.js') }}"></script>
    <script src="{{ asset('js/default-assets/date-time.js') }}"></script>
    <script src="{{ asset('js/default-assets/setting.js') }}"></script>
    <script src="{{ asset('js/default-assets/bootstrap-growl.js') }}"></script>

    <!-- Active JS -->
    <script src="{{ asset('js/default-assets/active.js') }}"></script>

    <!-- These plugins only need for the run this page -->
    <script src="{{ asset('js/default-assets/peity.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/peity-demo.js') }}"></script>
    <!-- These plugins only need for the run this page -->
    <script src="{{ asset('js/default-assets/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/datatables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/default-assets/datatable-responsive.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/datatable-button.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/button.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/button.html5.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/button.flash.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/button.print.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/datatables.keytable.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/datatables.select.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/demo.datatable-init.js') }}"></script>
    <script src="{{ asset('js/default-assets/bootstrap-growl.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

        });
    </script>
    @yield('scripts')
</body>

</html>
