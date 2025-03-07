@extends('layouts.master')
@section('title', 'ویرایش پرسنل')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">ویرایش پرسنل</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4 box-margin height-card">
                        <div class="card card-body">
                            <h4 class="card-title">ویرایش پرسنل</h4>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <label for="exampleInputEmail111">نام و نام خانوادگی:</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $employee->name }}" required id="exampleInputEmail111">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail12">کد پرسنلی:</label>
                                            <input type="text" class="form-control" value="{{ $employee->personalID }}"
                                                name="personalID" id="exampleInputEmail111">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail12">نام سازمان:</label>
                                            <select class="js-example-basic-single form-control" required
                                                name="organization_id" id="organization_id" style="width: 100%;">
                                                <option value="">--هیچکدام--</option>
                                                @if (\Auth::user()->isAdmin == 1)
                                                    @foreach ($organizations as $organization)
                                                        <option value="{{ $organization->id }}"
                                                            {{ $organization->id == $employee->organization_id ? 'selected' : '' }}>
                                                            {{ $organization->description }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="{{ \Auth::user()->organization_id }}" selected>
                                                        {{ \Auth::user()->organization->title }}</option>
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail12">انتخاب واحد مادر:</label>
                                            <select class="js-example-basic-single form-control" name="parentUnit_id"
                                                id="parentUnit_id" style="width: 100%;">

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail12">انتخاب واحد فرزند:</label>
                                            <select class="js-example-basic-single form-control" name="childUnit_id"
                                                id="childUnit_id" style="width: 100%;">
                                            </select>
                                        </div>

                                        <!-- <div class="form-group">
                                            <label for="exampleInputEmail12">انتخاب واحد:</label>
                                            <select class="js-example-basic-single form-control" name="unit_id"
                                                style="width: 100%;">
                                                <option value="">--هیچکدام--</option>
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}"
                                                        {{ $unit->id == $employee->unit_id ? 'selected' : '' }}>
                                                        {{ $unit->title }}</option>
                                                @endforeach
                                            </select>
                                        </div> -->

                                        <div class="checkbox checkbox-primary d-inline">
                                            <input type="checkbox" name="isActive" id="checkbox-p-1"
                                                {{ $employee->isActive ? 'checked' : '' }}>
                                            <label for="checkbox-p-1" class="cr">فعال</label>
                                        </div>


                                        <button type="submit" class="btn btn-outline-success mb-2 mr-2"
                                            style="float:left;"><i class="fa fa-save"></i> ویرایش</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-8 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">پرسنل ها</h4>
                                <hr>

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>نام و نام خانوادگی</th>
                                            <th>سازمان</th>
                                            <th>واحد</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($employees as $employee)
                                            @if (\Auth::user()->organization_id == $employee->organization->id || \Auth::user()->isAdmin == 1)
                                                <tr>
                                                    <td>{{ $employee->name }}</td>
                                                    <td>{{ $employee->organization->title }}</td>
                                                    <td>
                                                        {{ isset($employee->parentUnit->title) ? $employee->parentUnit->title : '' }}
                                                        -{{ isset($employee->childUnit->title) ? $employee->childUnit->title : '' }}
                                                    </td>
                                                    <td>
                                                        @if ($employee->isActive == 1)
                                                            <div class='badge badge-success'>فعال</div>
                                                        @else
                                                            <div class='badge badge-danger'>غیرفعال</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('employees.edit', $employee->id) }}"
                                                            style="font-size:20px;float: right;margin-left:5px"><i
                                                                class="fa fa-edit" style="color:#04a9f5;"></i></a>
                                                        {{-- <form action="{{ route('employees.destroy', $employee->id) }}"
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
                                            @endif
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
@section('scripts')

    <script>
        $(document).ready(function() {
            //انتخاب واحد مادر
            $('#organization_id').on('change', function() {
                var organizationID = $(this).val();
                if (organizationID) {
                    $.ajax({
                        url: '/employees/getUnit/' + organizationID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#parentUnit_id').empty();
                                $('#parentUnit_id').append(
                                    '<option value="">انتخاب واحد مادر</option>');
                                $.each(data, function(key, parentUnit_id) {
                                    $('select[name="parentUnit_id"]').append(
                                        '<option value="' + parentUnit_id.id +
                                        '">' + parentUnit_id
                                        .title + '</option>');
                                });
                            } else {
                                $('#parentUnit_id').empty();
                            }
                        }
                    });
                } else {
                    $('#parentUnit_id').empty();
                }
            });

            //انتخاب واحد فرزند
            $('#parentUnit_id').on('change', function() {
                var childUnit_id = $(this).val();
                if (childUnit_id) {
                    $.ajax({
                        url: '/employees/getChildUnit/' + childUnit_id,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#childUnit_id').empty();
                                $('#childUnit_id').append(
                                    '<option value="">انتخاب واحد فرزند</option>');
                                $.each(data, function(key, childUnit_id) {
                                    $('select[name="childUnit_id"]').append(
                                        '<option value="' + childUnit_id.id +
                                        '">' + childUnit_id
                                        .title + '</option>');
                                });
                            } else {
                                $('#childUnit_id').empty();
                            }
                        }
                    });
                } else {
                    $('#childUnit_id').empty();
                }
            });

        });
    </script>
@endsection
