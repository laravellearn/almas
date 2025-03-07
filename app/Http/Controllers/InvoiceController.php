<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Detail;
use App\Models\Log;
use App\Models\Organization;
use App\Models\Product;
use App\Models\Store;
use App\Models\History;
use Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:invoices,user')->only(['index']);
        $this->middleware('can:invoice-add,user')->only(['create', 'store', 'edit', 'update', 'destroy']);
        $this->middleware('can:invoice-product-list,user')->only(['detailList', 'deleteSubDetail']);
    }

    public function index()
    {
        $invoices = Invoice::latest()->get();
        $subDetails = Detail::all();
        return view('invoices.index', compact('invoices', 'subDetails'));
    }

    public function create()
    {

        //Stores
        $user = \Auth::user();

        if ($user->isAdmin == 1) {
            $products = Product::where('isActive', 1)->get();
        } else {
            foreach ($user->roles as $role) {
                $storesUser = DB::table('role_store')->where('role_id', $role->id)->pluck('store_id');
            }
            $products = Product::whereIn('store_id', $storesUser)->latest()->get();
        }

        $lastNum = Invoice::latest()->first();
        if (!isset($lastNum)) {
            $invNum = 1;
        } else {
            $invNum = ++$lastNum->id;
        }
        return view('invoices.create', compact('products', 'user', 'invNum'));
    }

    public function store(Request $request)
    {
        $user = \Auth::user();

        $request['buyDate'] = $this->to_english_numbers($request['buyDate']);
        $request['inputDate'] = $this->to_english_numbers($request['inputDate']);

        //////Field For Invoice
        $invoiceID   = $request->order_no;
        $user_id     = \Auth::user()->id;
        $shopName    = $request->order_receiver_name;
        $address     = $request->order_receiver_address;
        $phone       = $request->phone;
        $buyDate     = $request->buyDate;
        $inputDate   = $request->inputDate;
        $description = $request->description;

        $price = 0;
        //////Total Price
        for ($i = 0; $i <= ($request->total_item - 1); $i++) {
            $price = $request['order_item_actual_amount'][$i] + $price;
        }

        $invoice = Invoice::create([
            'invoiceID' => $invoiceID,
            'user_id' => $user_id,
            'shopName' => $shopName,
            'address' => $address,
            'phone' => $phone,
            'buyDate' => $buyDate,
            'inputDate' => $inputDate,
            'description' => $description,
            'price' => $price
        ]);

        //Upload File
        if ($request->file()) {
            $file = $request->file;
            $path = time() . $file->getClientOriginalName();
            $path = str_replace(' ', '-', $path);
            $file->move('storage/', $path);
            $path = '/almas/storage/app/public/uploads/' . $path;
            $invoice->update([
                'file' => $path
            ]);
        }

        //////Field For Details
        for ($i = 0; $i <= ($request->total_item - 1); $i++) {
            $detail = Detail::create([
                'invoice_id' => $invoice->id,
                'product_id' => $request['item_name'][$i],
                'garanty' => $request['order_item_garanty'][$i],
                'number' => $request['order_item_quantity'][$i],
                'price' => $request['order_item_price'][$i],
                'totalPrice' => $request['order_item_actual_amount'][$i],
            ]);

            History::create([
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_id' => $user->id,
                'action' => 'increment',
                'store' => $detail->product->store->title,
                'description' => " برای کالای " . $detail->product->title . " افزایش موجودی طی فاکتور شماره: " . $invoice->invoiceID . " تعداد " . $detail->product->entity . " ثبت شد"
            ]);
        }
        //Add Product to Store
        for ($i = 0; $i <= ($request->total_item - 1); $i++) {
            $product = Product::find($request['item_name'][$i]);
            $product->update([
                'entity' => $product->entity + $request['order_item_quantity'][$i]
            ]);
        }
        Alert::success('تشکر', 'رکورد با موفقیت ایجاد شد');

        $user = \Auth::user();
        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'action' => 'create',
            'description' => 'یک فاکتور جدید ایجاد شد' . '-' . $invoice->invoiceID
        ]);

        return back();
    }

    public function edit(Invoice $invoice)
    {
        $products = Product::where('isActive', 1)->get();
        $details = Detail::where('invoice_id', $invoice->id)->get();
        return view('invoices.edit', compact('invoice', 'products', 'details'));
    }

    public function show(Invoice $invoice)
    {
        $products = Product::where('isActive', 1)->get();
        $details = Detail::where('invoice_id', $invoice->id)->get();
        return view('invoices.show', compact('invoice', 'products', 'details'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request['buyDate'] = $this->to_english_numbers($request['buyDate']);
        $request['inputDate'] = $this->to_english_numbers($request['inputDate']);

        //////Field For Invoice
        $invoiceID   = $request->order_no;
        $user_id     = \Auth::user()->id;
        $shopName    = $request->order_receiver_name;
        $address     = $request->order_receiver_address;
        $phone       = $request->phone;
        $buyDate     = $request->buyDate;
        $inputDate   = $request->inputDate;
        $description = $request->description;

        $invoice->update([
            'shopName' => $shopName,
            'address' => $address,
            'phone' => $phone,
            'buyDate' => $buyDate,
            'inputDate' => $inputDate,
            'description' => $description,
        ]);

        //Upload File
        if ($request->file()) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $invoice->update([
                'file' => '/storage/' . $filePath
            ]);
        }

        Alert::success('تشکر', 'رکورد با موفقیت ویرایش شد');

        $user = \Auth::user();
        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'action' => 'create',
            'description' => 'فاکتور ویرایش ایجاد شد' . '-' . $invoice->invoiceID
        ]);

        return back();
    }

    public function destroy(Invoice $invoice)
    {
        $details = Detail::where('invoice_id', $invoice->id)->get();

        foreach ($details as $detail) {
            $detail->product->update([
                'entity' => $detail->product->entity + $detail->number
            ]);
        }

        $user = \Auth::user();
        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'action' => 'delete',
            'description' => 'فاکتور حذف شد' . '-' . $invoice->invoiceID
        ]);

        $invoice->delete();
        Alert::success('تشکر', 'رکورد با موفقیت حذف شد');

        return back();
    }

    //حذف یک ردیف از فاکتور
    public function deleteDetail(Detail $detail)
    {
        //شرط کمتر از صفر شدن موجودی
        if ($detail->product->entity - $detail->number < 0) {
            Alert::error('خطا', 'موجودی غیر مجاز(زیر صفر)');
            return back();
        } else {
            $detail->product->update([
                'entity' => $detail->product->entity - $detail->number
            ]);
            $detail->invoice->update([
                'price' => $detail->invoice->price - $detail->totalPrice
            ]);

            $user = \Auth::user();
            Log::create([
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_id' => $user->id,
                'action' => 'delete',
                'description' => 'یک ردیف از فاکتور حذف شد' . '-' . $detail->product->title
            ]);


            History::create([
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_id' => $user->id,
                'action' => 'decrement',
                'store' => $detail->product->store->title,
                'description' => " برای کالای " . $detail->product->title . " کاهش موجودی طی فاکتور شماره: " . $detail->invoice->invoiceID . " تعداد " . $detail->product->entity . " کاهش یافت"
            ]);

            $detail->delete();
            Alert::success('تشکر', 'رکورد با موفقیت حذف شد');
            return back();
        }
    }

    //ویرایش یک ردیف از فاکتور
    public function editDetail(Detail $detail)
    {
        //Stores
        $user = \Auth::user();

        if ($user->isAdmin == 1) {
            $products = Product::where('isActive', 1)->get();
        } else {
            foreach ($user->roles as $role) {
                $storesUser = DB::table('role_store')->where('role_id', $role->id)->pluck('store_id');
            }
            $products = Product::whereIn('store_id', $storesUser)->latest()->get();
        }


        return view('invoices.edit-detail', compact('detail', 'products'));
    }

    //آپدیت یک ردیف از فاکتور
    public function updateDetail(Detail $detail, Request $request)
    {
        //شرط کمتر از صفر شدن موجودی
        $number = $detail->product->entity - $detail->number;
        if ($number < 0) {
            Alert::error('خطا', 'موجودی کالا به زیر صفر می رسد!');
            return back();
        } else {

            //در صورت تغییر محصول ردیف
            if ($detail->product_id != $request->product_id) {

                $number = $detail->product->entity - $detail->number;
                if ($number < 0) {
                    Alert::error('خطا', 'موجودی کالا به زیر صفر می رسد!');
                    return back();
                }

                $product = Product::findOrFail($detail->product_id);

                $product->update([
                    'entity' => $product->entity - $detail->number
                ]);

                $detail->update([
                    'product_id' => $request->product_id,
                ]);
                $product = Product::findOrFail($detail->product_id);

                $product->update([
                    'entity' => $request->number + $product->entity
                ]);
            } else {
                $detail->product->update([
                    'entity' => $number + $request->number
                ]);
            }
            $entity = $detail->number;

            //ویرایش فیلد های ردیف فاکتور
            $detail->update([
                'number' => $request->number,
                'price' => $request->price,
                'garanty' => $request->garanty,
                'totalPrice' => $request->totalPrice
            ]);

            $user = \Auth::user();
            Log::create([
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_id' => $user->id,
                'action' => 'update',
                'description' => 'یک ردیف از فاکتور ویرایش شد' . '-' . $detail->product->title
            ]);

            if ($entity != $detail->number) {
                History::create([
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'user_id' => $user->id,
                    'action' => 'editEntity',
                    'store' => $detail->product->store->title,
                    'description' => " کالای " . $detail->product->title . " از تعداد " . $entity . " به تعداد " . $detail->number . " تغییر یافت" . " - از طریق ویرایش فاکتور شماره: " . $detail->invoice->invoiceID
                ]);
            }

            Alert::success('تشکر', 'رکورد با موفقیت ویرایش شد');
            return back();
        }
    }


    public function detailList()
    {
        $details = Detail::all();
        return view('invoices.details', compact('details'));
    }

    //Delete SubDetail in Invoice List
    public function deleteSubDetail($id)
    {
        $detail = Detail::find($id);
        $detail->product->update([
            'entity' => $detail->product->entity + $detail->number
        ]);
        $detail->delete();
        Alert::success('تشکر', 'یک قلم از فاکتور با موفقیت حذف شد');

        $user = \Auth::user();
        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'action' => 'delete',
            'description' => 'یک ردیف از فاکتور حذف شد' . '-' . $detail->product->title
        ]);

        History::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'action' => 'decrement',
            'store' => $detail->product->store->title,
            'description' => " کالای " . $detail->product->title . " تعداد " . $detail->number . " کسر شد"
        ]);

        return back();
    }

    public function addDetailGet(Invoice $invoice)
    {
        //Stores
        $user = \Auth::user();

        if ($user->isAdmin == 1) {
            $products = Product::where('isActive', 1)->get();
        } else {
            foreach ($user->roles as $role) {
                $storesUser = DB::table('role_store')->where('role_id', $role->id)->pluck('store_id');
            }
            $products = Product::whereIn('store_id', $storesUser)->latest()->get();
        }

        return view('invoices.create-detail', compact('invoice', 'products'));
    }

    public function addDetailPost(Invoice $invoice, Request $request)
    {

        $invoice->update([
            'price' => $invoice->price + $request['totalPrice']
        ]);

        //////Field For Details
        $detail = Detail::create([
            'invoice_id' => $invoice->id,
            'product_id' => $request['product_id'],
            'garanty' => $request['garanty'],
            'number' => $request['number'],
            'price' => $request['price'],
            'totalPrice' => $request['totalPrice'],
        ]);

        //Add Product to Store
        $product = Product::find($request['product_id']);
        $product->update([
            'entity' => $product->entity + $request['number']
        ]);

        Alert::success('تشکر', 'رکورد با موفقیت ایجاد شد');

        $user = \Auth::user();
        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'action' => 'create',
            'description' => 'یک ردیف جدید ایجاد شد' . '-' . $detail->product->title
        ]);

        History::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'action' => 'increment',
            'store' => $product->store->title,
            'description' => " برای کالای " . $detail->product->title . " افزایش موجودی طی فاکتور شماره: " . $detail->invoice->invoiceID . " تعداد " . $detail->product->entity . " ثبت شد"
        ]);

        return back();
    }

    function to_english_numbers(String $string): String
    {
        $persinaDigits1 = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $persinaDigits2 = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
        $allPersianDigits = array_merge($persinaDigits1, $persinaDigits2);
        $replaces = [...range(0, 9), ...range(0, 9)];

        return str_replace($allPersianDigits, $replaces, $string);
    }
}
