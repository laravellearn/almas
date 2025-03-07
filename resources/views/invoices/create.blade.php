@extends('layouts.master')
@section('title','فاکتور های خرید')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/persian-datepicker.min.css') }}">
@endsection
@section('content')
<div class="main-content">
    <nav aria-label="خرده نان" class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
            <li class="breadcrumb-item active" aria-current="page">فاکتور های خرید</li>
        </ol>
    </nav>
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 box-margin height-card">
                    <div class="card card-body">
                        <h4 class="card-title">افزودن فاکتور</h4>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">

                                    <form method="post" id="invoice_form" action="{{ route('invoices.store') }}"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="table-responsive" style="overflow: hidden">
                                          <table class="table table-bordered">
                                            <tr>
                                                <td colspan="2">
                                                  <div class="row">
                                                    <div class="col-md-8">
                                                        <input type="text" name="order_receiver_name" id="order_receiver_name" class="form-control input-sm" placeholder="نام فروشگاه" />
                                                        <input name="order_receiver_address" id="order_receiver_address" class="form-control" placeholder="آدرس فروشگاه" style="margin-top: 5px">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="شماره تماس فروشگاه" />

                                                        <input type="text" id="observer-example order_date" name="buyDate"
                                                        class="form-control observer-example input-sm mt-1 order_date" placeholder="تاریخ خرید">
                                                            <span id="span1"></span>

                                                      </div>
                                                      <div class="col-md-2">
                                                        <input type="text" name="order_no" id="order_no" readonly value="INV-{{ $invNum }}" class="form-control input-sm" style="text-align: left" placeholder="شماره فاکتور" />

                                                        <input type="text" id="observer-example order_date" name="inputDate"
                                                        class="form-control observer-example input-sm mt-1 order_date" placeholder="تاریخ ورود به واحد">
                                                            <span id="span1"></span>

                                                      </div>
                                                      </div>
                                                  <br />
                                                  <table id="invoice-item-table" class="table table-bordered">
                                                    <tr>
                                                      <th style="font-weight: bold" width="3%">ردیف</th>
                                                      <th style="font-weight: bold" width="28%">نام کالا - انبار - برند - دسته بندی</th>
                                                      <th style="font-weight: bold" width="5%">تعداد</th>
                                                      <th style="font-weight: bold" width="8%">مبلغ(ریال)</th>
                                                      <th style="font-weight: bold" width="7%">نوع گارانتی</th>
                                                      <th style="font-weight: bold" width="10%">مبلغ کل(ریال)</th>
                                                      <th style="font-weight: bold" width="3%"></th>
                                                    </tr>
                                                    <tr>
                                                      <td align="center"><span id="sr_no">1</span></td>
                                                      <td>
                                                        <select class="js-select2 form-control" name="item_name[]" id="item_name1" style="width: 100%">
                                                            <option value="">--هیچکدام--</option>
                                                            @foreach ($products as $product)
                                                                <option value="{{ $product->id }}">{{ $product->title }} - {{ $product->store->title }} - {{ $product->brand->title }} - {{ $product->parentCategory->title }}</option>
                                                            @endforeach
                                                        </select>
                                                      </td>

                                                      <td><input type="text" name="order_item_quantity[]" id="order_item_quantity1" data-srno="1" class="form-control input-sm order_item_quantity" /></td>
                                                      <td><input type="text" name="order_item_price[]" id="order_item_price1" data-srno="1" class="form-control input-sm number_only order_item_price" /></td>
                                                      <td><input type="text" name="order_item_garanty[]" id="order_item_garanty1" data-srno="1" class="form-control input-sm order_item_garanty" /></td>
                                                      <td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount1" data-srno="1" class="form-control input-sm order_item_actual_amount" readonly /></td>
                                                      <td></td>
                                                    </tr>
                                                  </table>
                                                  <div align="right">
                                                    <button type="button" name="add_row" id="add_row" class="btn btn-success btn-xs" style="font-weight: bold;font-size: 16px;">+</button>
                                                  </div>
                                                </td>
                                              </tr>
                                              <tr>

                                                <td align="left"><b>مبلغ کل:</td>
                                                <td align="right"><b><span id="final_total_amt"></span></b> ریال </td>
                                              </tr>
                                              <tr>
                                                <td colspan="2">
                                                    {{-- <label for="file">تصویر فاکتور:</label>

                                                    <div class="form-group">
                                                        <input type="file" name="file" class="file-upload-default">
                                                        <div class="input-group col-xs-12">
                                                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="اسکن فاکتور">
                                                            <span class="input-group-append">
                                                                    <button class="file-upload-browse btn btn-primary" type="button">بارگذاری</button>
                                                                </span>
                                                        </div>
                                                    </div> --}}

                                                    <textarea name="description" class="form-control" id="" cols="30" rows="5" placeholder="توضیحات فاکتور"></textarea>

                                                </td>

                                              </tr>
                                              <tr>
                                                <td colspan="2" align="center">
                                                  <input type="hidden" name="total_item" id="total_item" value="1" />
                                                  <input type="submit" name="create_invoice" id="create_invoice" style="font-weight: bold;font-size: 14px;" class="btn btn-info" value="ایجاد فاکتور" />
                                                </td>
                                              </tr>
                                          </table>
                                        </div>
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
<script src="{{ asset('js/default-assets/file-upload.js') }}"></script>
<script src="{{ asset('js/default-assets/basic-form.js') }}"></script>
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
                $('.observer-example2').persianDatepicker({
                    observer: true,
                    format: 'YYYY/MM/DD',
                    altField: '.observer-example-alt2',
                    initialValue: false
                });

                $('#order_item_store1').select2();
                $('#item_name1').select2();

            });


        </script>

<script>


    $(document).ready(function(){


      var final_total_amt = $('#final_total_amt').text();
      var count = 1;

      $(document).on('click', '#add_row', function(){

        count++;
        $('#total_item').val(count);
        var html_code = '';
        html_code += '<tr align="center" id="row_id_'+count+'">';
        html_code += '<td><span id="sr_no">'+count+'</span></td>';

        html_code += '<td>';
        html_code += '<select class="js-select2 form-control" name="item_name[]" id="item_name'+count+'" style="width: 100%;">';
        html_code += '<option value="">--هیچکدام--</option>';
        html_code += "@foreach ($products as $product)";
        html_code += '<option value="{{ $product->id }}">{{ $product->title }} - {{ $product->store->title }} - {{ $product->brand->title }} - {{ $product->parentCategory->title }}</option>';
        html_code += "@endforeach";
        html_code += '</select>';
        html_code += '</td>';

        html_code += '<td><input type="text" name="order_item_quantity[]" id="order_item_quantity'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_quantity" /></td>';
        html_code += '<td><input type="text" name="order_item_price[]" id="order_item_price'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_price" /></td>';
        html_code += '<td><input type="text" name="order_item_garanty[]" id="order_item_garanty'+count+'" data-srno="'+count+'" class="form-control input-sm order_item_garanty" /></td>';


        html_code += '<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount'+count+'" data-srno="'+count+'" class="form-control input-sm order_item_actual_amount" readonly /></td>';

        html_code += '<td><button type="button" name="remove_row" style="font-weight:bold" id="'+count+'" class="btn btn-danger btn-xs remove_row">X</button></td>';
        html_code += '</tr>';
        $('#invoice-item-table').append(html_code);



        for( i = 0 ; i < 30 ; i++ ){
            $('#item_name' + i).select2();
            }


      });

      $(document).on('click', '.remove_row', function(){
        var row_id = $(this).attr("id");
        var total_item_amount = $('#order_item_final_amount'+row_id).val();
        var final_amount = $('#final_total_amt').text();
        var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
        $('#final_total_amt').text(result_amount);
        $('#row_id_'+row_id).remove();
        count--;
        $('#total_item').val(count);
      });

      function cal_final_total(count)
      {
        var final_item_total = 0;
        for(j=1; j<=count; j++)
        {
          var quantity = 0;
          var price = 0;
          var actual_amount = 0;
          var tax1_rate = 0;
          var tax1_amount = 0;
          var tax2_rate = 0;
          var tax2_amount = 0;
          var tax3_rate = 0;
          var tax3_amount = 0;
          var item_total = 0;
          quantity = $('#order_item_quantity'+j).val();
          if(quantity > 0)
          {
            price = $('#order_item_price'+j).val();
            if(price > 0)
            {
              actual_amount = parseFloat(quantity) * parseFloat(price);
              $('#order_item_actual_amount'+j).val(actual_amount);

              item_total = parseFloat(actual_amount) + parseFloat(tax1_amount) + parseFloat(tax2_amount) + parseFloat(tax3_amount);
              final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
              $('#order_item_final_amount'+j).val(item_total);
            }
          }
        }
        $('#final_total_amt').text(final_item_total);
      }

      $(document).on('blur', '.order_item_price', function(){
        cal_final_total(count);
      });

      $(document).on('blur', '.order_item_tax2_rate', function(){
        cal_final_total(count);
      });

      $(document).on('blur', '.order_item_tax3_rate', function(){
        cal_final_total(count);
      });

      $('#create_invoice').click(function(){
        if($.trim($('#order_receiver_name').val()).length == 0)
        {
          alert("لطفا نام فروشگاه را وارد کنید");
          return false;
        }

        if($.trim($('.order_date').val()).length == 0)
        {
          alert("لطفا تاریخ را تکمیل نمائید");
          return false;
        }

        for(var no=1; no<=count; no++)
        {
          if($.trim($('#item_name'+no).val()).length == 0)
          {
            alert("آیتم را وارد نمائید");
            $('#item_name'+no).focus();
            return false;
          }

          if($.trim($('#order_item_quantity'+no).val()).length == 0)
          {
            alert("لطفا تعداد را وارد کنید");
            $('#order_item_quantity'+no).focus();
            return false;
          }

          if($.trim($('#order_item_price'+no).val()).length == 0)
          {
            alert("لطفا مبلغ را وارد کنید");
            $('#order_item_price'+no).focus();
            return false;
          }

        }

        $('#invoice_form').submit();

      });

    });
    </script>

@endsection
