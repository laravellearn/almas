<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Employee;
use App\Models\Delivery;
use App\Models\History;
use App\Models\Log;
use App\Models\Organization;
use App\Models\Role;
use App\Models\Stock;
use Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:deliveries,user')->only(['index', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $user = \Auth::user();
        $roles = Role::all();

        foreach ($user->roles as $role) {
            $storesUser = DB::table('role_store')->where('role_id', $role->id)->pluck('store_id');
        }

        if ($user->isAdmin == 1) {
            $products = Product::latest()->get();
            $stocks = Stock::latest()->get();
            $deliveries = Delivery::latest()->get();
            $employees = Employee::where('isActive', 1)->get();
        } else {
            $products = Product::whereIn('store_id', $storesUser)->latest()->get();
            $stocks = Stock::whereIn('store_id', $storesUser)->latest()->get();
            $deliveries = Delivery::where('organization_id', $user->organization_id)->latest()->get();
            $employees = Employee::where('organization_id', $user->organization_id)->latest()->get();
        }
        $organizations = Organization::all();


        return view('deliveries.index', compact('products', 'employees', 'deliveries', 'stocks', 'organizations'));
    }

    public function create()
    {
        $user = \Auth::user();
        $roles = Role::all();

        foreach ($user->roles as $role) {
            $storesUser = DB::table('role_store')->where('role_id', $role->id)->pluck('store_id');
        }

        if ($user->isAdmin == 1) {
            $products = Product::latest()->get();
            $stocks = Stock::latest()->get();
            $employees = Employee::where('isActive', 1)->get();
        } else {
            $products = Product::whereIn('store_id', $storesUser)->latest()->get();
            $stocks = Stock::whereIn('store_id', $storesUser)->latest()->get();
            $employees = Employee::where('organization_id', $user->organization_id)->latest()->get();
        }
        $organizations = Organization::all();

        return view('deliveries.create', compact('products', 'employees', 'stocks', 'organizations'));
    }

    public function store(Request $request)
    {
        for ($i = 0; $i <= ($request->total_item - 1); $i++) {
            if ((isset($request['item_name'][$i])) && (isset($request['stock_name'][$i])) && ($request['item_name'][$i] == '') && ($request['stock_name'][$i] = '')) {
                Alert::error('خطا', 'امکان انتخاب کالای نو و دست دوم در یک سطر وجود ندارد');
                return back();
            }
        }

        //شرط کمتر از صفر شدن موجودی
        for ($i = 0; $i <= ($request->total_item - 1); $i++) {
            if (isset($request['item_name'][$i])) {
                $product = Product::where('id', $request['item_name'][$i])->first();
                $productEntity = $product->entity - $request['order_item_quantity'][$i];
                if ($productEntity < 0) {
                    Alert::error('خطا', 'موجودی کالای ' . $product->title . ' به زیر صفر می رسد');
                    return back();
                }
            } elseif (isset($request['stock_name'][$i])) {
                $stock = Stock::where('id', $request['stock_name'][$i])->first();
                $stockEntity = $stock->entity - $request['order_item_quantity'][$i];
                if ($stockEntity < 0) {
                    Alert::error('خطا', 'موجودی کالای ' . $stock->title . ' به زیر صفر می رسد');
                    return back();
                }
            }
        }


        $request['user_id'] = \Auth::user()->id;
        $request['deliverDate'] = $this->to_english_numbers($request['deliverDate']);

        //ثبت کالا در دیتابیس
        for ($i = 0; $i <= ($request->total_item - 1); $i++) {
            if (isset($request['item_name'][$i])) {
                $delivery = Delivery::create([
                    'organization_id' => $request['organization_id'],
                    'user_id' => $request['user_id'],
                    'employee_id' => $request['employee_id'],
                    'deliverDate' => $request['deliverDate'],
                    'description' => $request['description'],
                    'product_id' => $request['item_name'][$i],
                    'AmvalCode' => $request['order_item_amval'][$i],
                    'number' => $request['order_item_quantity'][$i]
                ]);
            } elseif (isset($request['stock_name'][$i])) {
                $delivery = Delivery::create([
                    'organization_id' => $request['organization_id'],
                    'user_id' => $request['user_id'],
                    'employee_id' => $request['employee_id'],
                    'deliverDate' => $request['deliverDate'],
                    'description' => $request['description'],
                    'stock_id' => $request['stock_name'][$i],
                    'AmvalCode' => $request['order_item_amval'][$i],
                    'number' => $request['order_item_quantity'][$i]
                ]);
            }


            //Entity
            if ($delivery->product_id != null) {
                $entity = $delivery->product->entity;
                $delivery->product->update([
                    'entity' => $entity - $request['order_item_quantity'][$i]
                ]);

                History::create([
                    'delivery_id' => $delivery->id,
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'user_id' => $request['user_id'],
                    'action' => 'delivery',
                    'store' => $delivery->product->store->title,
                    'description' => "تعداد " . $request['order_item_quantity'][$i] . " از کالای " . $delivery->product->title . " تحویل شخص " . $delivery->employee->name . " داده شد"
                ]);
            } else {
                $entity = $delivery->stock->entity;
                $delivery->stock->update([
                    'entity' => $entity - $request['order_item_quantity'][$i]
                ]);

                History::create([
                    'delivery_id' => $delivery->id,
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'user_id' => $request['user_id'],
                    'action' => 'delivery',
                    'store' => $delivery->stock->store->title,
                    'description' => "تعداد " . $request['order_item_quantity'][$i] . " از کالای " . $delivery->stock->title . " تحویل شخص " . $delivery->employee->name . " داده شد"
                ]);
            }
            Log::create([
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_id' => \Auth::user()->id,
                'action' => 'create',
                'description' => 'تحویل کالا انجام شد' . '-' . $delivery->employee->name
            ]);
        }

        Alert::success('تشکر', 'رکورد با موفقیت ایجاد شد');
        return back();
    }

    public function edit(Delivery $delivery)
    {
        $user = \Auth::user();
        $roles = Role::all();

        foreach ($user->roles as $role) {
            $storesUser = DB::table('role_store')->where('role_id', $role->id)->pluck('store_id');
        }

        if ($user->isAdmin == 1) {
            $products = Product::latest()->get();
            $stocks = Stock::latest()->get();
            $deliveries = Delivery::latest()->get();
            $employees = Employee::where('isActive', 1)->get();
        } else {
            $products = Product::whereIn('store_id', $storesUser)->latest()->get();
            $stocks = Stock::whereIn('store_id', $storesUser)->latest()->get();
            $deliveries = Delivery::where('organization_id', $user->organization_id)->latest()->get();
            $employees = Employee::where('organization_id', $user->organization_id)->latest()->get();
        }
        $organizations = Organization::all();

        return view('deliveries.edit', compact('products', 'employees', 'deliveries', 'delivery', 'organizations', 'stocks'));
    }

    public function update(Request $request, Delivery $delivery)
    {
        $user = \Auth::user();
        $request['deliverDate'] = $this->to_english_numbers($request['deliverDate']);
        //شرط کمتر از صفر شدن موجودی
        if (isset($request['product_id'])) {
            $productEntity = Product::where('id', $request['product_id'])->first();
            $productEntity = $productEntity->entity - $request['number'];
            if ($productEntity < 0) {
                Alert::error('خطا', 'موجودی کالا به زیر صفر می رسد!');
                return back();
            }
        } elseif (isset($request['stock_id'])) {
            $stockEntity = Stock::where('id', $request['stock_id'])->first();
            $stockEntity = $stockEntity->entity - $request['number'];
            if ($stockEntity < 0) {
                Alert::error('خطا', 'موجودی کالا به زیر صفر می رسد!');
                return back();
            }
        }

        //Entity
        if ($delivery->product_id != null) {
            $entity = $delivery->product->entity + $delivery->number;
            $delivery->product->update([
                'entity' => $entity
            ]);

            $entity = $delivery->product->entity;
            $delivery->product->update([
                'entity' => $entity - $request['number']
            ]);

            History::create([
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_id' => $user->id,
                'action' => 'delivery',
                'store' => $delivery->product->store->title,
                'description' => " تعداد کالای " . $delivery->product->title . " از " . $entity . " به " . $request['number'] . " که تحویل شخص " . $delivery->employee->name . " داده شده بود، تغییر کرد"
            ]);
        } else {
            $entity = $delivery->stock->entity + $delivery->number;
            $delivery->stock->update([
                'entity' => $entity
            ]);

            $entity = $delivery->stock->entity;
            $delivery->stock->update([
                'entity' => $entity - $request['number']
            ]);

            History::create([
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_id' => $user->id,
                'action' => 'delivery',
                'store' => $delivery->stock->store->title,
                'description' => " تعداد کالای " . $delivery->stock->title . " از " . $entity . " به " . $request['number'] . " که تحویل شخص " . $delivery->employee->name . " داده شده بود، تغییر کرد"
            ]);
        }

        //

        if ($request['product_id'] != $delivery->product_id) {
            $delivery->product->update([
                'entity' => $delivery->product->entity + $delivery->number
            ]);
            $product = Product::where('id', $request['product_id'])->first();
            $product->update([
                'entity' => $product->entity - $request['number']
            ]);

            $delivery->update([
                'product_id' => $request->product_id,
                'number' => $request->number,
                'employee_id' => $request->employee_id,
                'description' => $request->description,
                'deliverDate' => $request->deliverDate,
                'AmvalCode' => $request->AmvalCode
            ]);
            Alert::success('تشکر', 'رکورد با موفقیت ویرایش شد');
            return back();
        } elseif ($request['stock_id'] != $delivery->stock_id) {
            $delivery->stock->update([
                'entity' => $delivery->stock->entity + $delivery->number
            ]);
            $stock = Stock::where('id', $request['stock_id'])->first();
            $stock->update([
                'entity' => $stock->entity - $request['number']
            ]);

            $delivery->update([
                'stock_id' => $request->stock_id,
                'number' => $request->number,
                'employee_id' => $request->employee_id,
                'description' => $request->description,
                'deliverDate' => $request->deliverDate,
                'AmvalCode' => $request->AmvalCode
            ]);
            Alert::success('تشکر', 'رکورد با موفقیت ویرایش شد');
            return back();
        } else {
            $delivery->update([
                'number' => $request->number,
                'employee_id' => $request->employee_id,
                'description' => $request->description,
                'deliverDate' => $request->deliverDate,
                'AmvalCode' => $request->AmvalCode
            ]);
            Log::create([
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_id' => \Auth::user()->id,
                'action' => 'update',
                'description' => 'تحویل کالا ویرایش شد' . '-' . $delivery->employee->name
            ]);

            Alert::success('تشکر', 'رکورد با موفقیت ویرایش شد');
            return back();
        }
    }

    public function destroy(Delivery $delivery)
    {

        //Entity
        if ($delivery->product_id != null) {
            $entity = $delivery->product->entity;
            $delivery->product->update([
                'entity' => $entity + $delivery['number']
            ]);
        } else {
            $entity = $delivery->stock->entity;
            $delivery->stock->update([
                'entity' => $entity + $delivery['number']
            ]);
        }

        $history = History::where('delivery_id', $delivery->id)->first();
        $history->delete();
        $delivery->delete();
        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => \Auth::user()->id,
            'action' => 'create',
            'description' => 'تحویل کالا حذف شد' . '-' . $delivery->employee->name
        ]);

        Alert::success('تشکر', 'رکورد با موفقیت حذف شد');
        return back();
    }

    public function getEmployee($id)
    {
        $employee_id = Employee::where('organization_id', $id)
            ->where('isActive', 1)->get();
        return response()->json($employee_id);
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
