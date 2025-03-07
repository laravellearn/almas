@extends('layouts.master')
@section('title', 'ویرایش واحد')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">ویرایش واحد</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4 box-margin height-card">
                        <div class="card card-body">
                            <h4 class="card-title">ویرایش واحد</h4>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form action="{{ route('units.update', $unit->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <label for="exampleInputEmail12">نام سازمان:</label>
                                            <select class="js-example-basic-single form-control" required
                                                name="organization_id" id="organization_id" style="width: 100%;">
                                                <option value="">--هیچکدام--</option>
                                                @if (\Auth::user()->isAdmin == 1)
                                                    @foreach ($organizations as $organization)
                                                        <option value="{{ $organization->id }}"
                                                            {{ $organization->id == $unit->organization_id ? 'selected' : '' }}>
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
                                            <select class="js-example-basic-single form-control" name="parent_id"
                                                id="parent_id" style="width: 100%;">
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail111">عنوان واحد:</label>
                                            <input type="text" class="form-control" name="title"
                                                value="{{ $unit->title }}" required id="exampleInputEmail111">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail12">توضیح:</label>
                                            <input type="text" class="form-control" value="{{ $unit->description }}"
                                                name="description" id="exampleInputEmail111">
                                        </div>
                                        <div class="checkbox checkbox-primary d-inline">
                                            <input type="checkbox" name="isActive" id="checkbox-p-1"
                                                {{ $unit->isActive ? 'checked' : '' }}>
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
                                <h4 class="card-title mb-2">واحد ها</h4>
                                <hr>

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>عنوان واحد</th>
                                            <th>واحد مادر</th>
                                            <th>سازمان</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($units as $unit)
                                            @if (\Auth::user()->organization_id == $unit->organization->id || \Auth::user()->isAdmin == 1)
                                                <tr>
                                                    <td>{{ $unit->title }}</td>
                                                    <td>
                                                        @if (isset($unit->parent->title))
                                                            {{ $unit->parent->title }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ $unit->organization->title }}</td>

                                                    <td>
                                                        @if ($unit->isActive == 1)
                                                            <div class='badge badge-success'>فعال</div>
                                                        @else
                                                            <div class='badge badge-danger'>غیرفعال</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('units.edit', $unit->id) }}"
                                                            style="font-size:20px;float: right;margin-left:5px"><i
                                                                class="fa fa-edit" style="color:#04a9f5;"></i></a>
                                                        {{-- <form action="{{ route('units.destroy', $unit->id) }}"
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
            $('#organization_id').on('change', function() {
                var organizationID = $(this).val();
                if (organizationID) {
                    $.ajax({
                        url: '/index.php/units/getParent/' + organizationID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#parent_id').empty();
                                $('#parent_id').append(
                                    '<option value="">انتخاب واحد مادر</option>');
                                $.each(data, function(key, parent_id) {
                                    $('select[name="parent_id"]').append(
                                        '<option value="' + parent_id.id + '">' +
                                        parent_id
                                        .title + '</option>');
                                });
                            } else {
                                $('#parent_id').empty();
                            }
                        }
                    });
                } else {
                    $('#parent_id').empty();
                }
            });
        });
    </script>
@endsection
