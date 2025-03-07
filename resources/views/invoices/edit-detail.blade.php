@extends('layouts.master')
@section('title', 'ویرایش یک قلم از فاکتور')

@section('content')
    <div class="main-content">
        <nav aria-label="خرده نان" class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">پیشخوان</a></li>
                <li class="breadcrumb-item active" aria-current="page">ویرایش یک ردیف از فاکتور</li>
            </ol>
        </nav>
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 box-margin height-card">
                        <div class="card card-body">
                            <h4 class="card-title">ویرایش یک ردیف از فاکتور شماره: {{ $detail->invoice->invoiceID }}
                            </h4>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">

                                    <form method="post" id="invoice_form"
                                        action="{{ route('invoices.detail.edit', $detail->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="table-responsive" style="overflow: hidden">
                                            <table class="table table-bordered">




                                                <table id="invoice-item-table" class="table table-bordered">
                                                    <tr>
                                                        <th style="font-weight: bold" width="3%">ردیف</th>
                                                        <th style="font-weight: bold" width="28%">نام کالا - انبار - برند
                                                        </th>
                                                        <th style="font-weight: bold" width="5%">تعداد</th>
                                                        <th style="font-weight: bold" width="8%">مبلغ(ریال)</th>
                                                        <th style="font-weight: bold" width="7%">نوع گارانتی</th>
                                                        <th style="font-weight: bold" width="10%">مبلغ کل(ریال)</th>
                                                        <th style="font-weight: bold" width="3%"></th>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"><span id="sr_no">1</span></td>
                                                        <td>
                                                            <select class="js-select2 form-control" name="product_id"
                                                                id="item_name1" style="width: 100%">
                                                                <option value="">--هیچکدام--</option>
                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}"
                                                                        {{ $product->id == $detail->product->id ? 'selected' : '' }}>
                                                                        {{ $product->title }} -
                                                                        {{ $product->store->title }} -
                                                                        {{ $product->brand->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>

                                                        <td><input type="text" name="number"
                                                                id="order_item_quantity1" data-srno="1" value="{{ $detail->number }}"
                                                                class="form-control input-sm order_item_quantity" /></td>
                                                        <td><input type="text" name="price"
                                                                id="order_item_price1" data-srno="1" value="{{ $detail->price }}"
                                                                class="form-control input-sm number_only order_item_price" />
                                                        </td>
                                                        <td><input type="text" name="garanty"
                                                                id="order_item_garanty1" data-srno="1" value="{{ $detail->garanty }}"
                                                                class="form-control input-sm order_item_garanty" /></td>
                                                        <td><input type="text" name="totalPrice"
                                                                id="order_item_actual_amount1" data-srno="1" value="{{ $detail->totalPrice }}"
                                                                class="form-control input-sm order_item_actual_amount"
                                                                readonly /></td>
                                                        <td></td>
                                                    </tr>
                                                </table>

                                                </td>
                                                </tr>

                                            </table>


                                            <tr>
                                                <td colspan="2" align="center">
                                                    <input type="hidden" name="total_item" id="total_item" value="1" />
                                                    <input type="submit" name="create_invoice" id="create_invoice"
                                                        style="font-weight: bold;font-size: 14px;" class="btn btn-info"
                                                        value="ویرایش" />
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

    <script type="text/javascript">
        $(document).ready(function() {

            $('#item_name1').select2();
            for (i = 0; i < 2; i++) {
                $('#item_name' + i).select2();
            }

        });
    </script>

    <script>
    $(document).ready(function(){


var final_total_amt = $('#final_total_amt').text();
var count = 1;



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


});

</script>

@endsection
