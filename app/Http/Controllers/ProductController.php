<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\History;
use App\Models\Log;
use App\Models\Organization;
use App\Models\Store;
use Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:products,user')->only(['index', 'destroy', 'trashGet', 'trashPost', 'restore']);
        $this->middleware('can:product-add,user')->only(['create', 'store', 'edit', 'update']);
    }

    public function index()
    {

        $categories = Category::where('isActive', 1)->where('parent_id', '')->get();
        $brands = Brand::where('isActive', 1)->get();

        //Stores
        $user = \Auth::user();

        if ($user->isAdmin == 1) {
            $organizations = Organization::all();
            $products = Product::latest()->get();
            $productCount = Product::onlyTrashed()->count();
            $stores = Store::all();
        } else {
            $productCount = Product::where('organization_id', $user->organization_id)->onlyTrashed()->count();
            $organizations = Organization::where('id', $user->organization_id)->get();
            foreach ($user->roles as $role) {
                $storesUser = DB::table('role_store')->where('role_id', $role->id)->pluck('store_id');
            }
            $products = Product::whereIn('store_id',$storesUser)->latest()->get();

            $stores = Store::whereIn('id',$storesUser)->where('isActive',1)->get();

        }

        return view('products.index', compact('products','stores', 'categories', 'brands', 'organizations', 'productCount'));
    }

    public function create()
    {
        $products = Product::all();
        $categories = Category::where('isActive', 1)->where('parent_id', Null)->get();
        $brands = Brand::where('isActive', 1)->get();

        //Stores
        $user = \Auth::user();
        if ($user->isAdmin == 1) {
            $organizations = Organization::where('isActive',1)->get();
            $stores = Store::where('isActive',1)->get();

        } else {
            $organizations = Organization::where('id', $user->organization_id)->where('isActive',1)->get();
            foreach ($user->roles as $role) {
                $storesUser = DB::table('role_store')->where('role_id', $role->id)->pluck('store_id');
            }
            $stores = Store::whereIn('id',$storesUser)->where('isActive',1)->get();
        }

        return view('products.create', compact('products','stores', 'categories', 'brands', 'organizations'));
    }

    public function store(ProductRequest $request)
    {
        $request['user_id'] = \Auth::user()->id;
        $product = Product::create($request->all());
        $user = \Auth::user();

        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'action' => 'create',
            'description' => 'یک محصول ایجاد شد' . '-' . $product->title
        ]);

        History::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'action' => 'entity',
            'store' => $product->store->title,
            'description' => " برای کالای " . $product->title . " موجودی اولیه " . $product->entity . " ثبت شد"
        ]);

        Alert::success('تشکر', 'رکورد با موفقیت ایجاد شد');
        return back();
    }

    public function edit(Product $product)
    {
        $categories = Category::where('isActive', 1)->where('parent_id', Null)->get();
        $brands = Brand::where('isActive', 1)->get();
        $parents = Category::where('isActive', 1)->where('parent_id', '!=', Null)->get();
        //Stores
        $user = \Auth::user();
        if ($user->isAdmin == 1) {
            $organizations = Organization::where('isActive',1)->get();
            $stores = Store::where('isActive',1)->get();

        } else {
            $organizations = Organization::where('id', $user->organization_id)->where('isActive',1)->get();
            foreach ($user->roles as $role) {
                $storesUser = DB::table('role_store')->where('role_id', $role->id)->pluck('store_id');
            }
            $stores = Store::whereIn('id',$storesUser)->where('isActive',1)->get();
        }

        return view('products.edit', compact('product', 'categories', 'brands', 'parents', 'organizations','stores'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $entity = $product->entity;
        $request->isActive == "on" ? $request->isActive = 1 : $request->isActive = 0;
        $product->update([
            'orderLimit' => $request->orderLimit,
            'title' => $request->title,
            'description' => $request->description,
            'entity' => $request->entity,
            'brand_id' => $request->brand_id,
            'parentCategory_id' => $request->parentCategory_id,
            'chaildCategory_id' => isset($request->chaildCategory_id) ? $request->chaildCategory_id : $product->chaildCategory_id,
            'isActive' => $request->isActive,
            'organization_id' => $request->organization_id,
            'store_id' => isset($request->store_id) ? $request->store_id : $product->store_id,
            'updated_at' => now()
        ]);
        //Stores
        $user = \Auth::user();
        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'action' => 'update',
            'description' => 'محصول ویرایش شد' . '-' . $product->title
        ]);

        if ($entity != $product->entity) {
            History::create([
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_id' => $user->id,
                'action' => 'editEntity',
                'store' => $product->store->title,
                'description' => " کالای " . $product->title . " از تعداد " . $entity . " به تعداد " . $product->entity . " تغییر یافت"
            ]);
        }


        Alert::success('تشکر', 'رکورد با موفقیت ویرایش شد');
        return back();
    }

    public function notify(Product $product)
    {
        $product->update([
            'isNotify' => 0
        ]);
        return back();
    }

    public function getCategory($id)
    {
        $childCategory_id = Category::where('parent_id', $id)
            ->where('isActive', 1)->get();
        return response()->json($childCategory_id);
    }

    public function getStore($id)
    {
        $store_id = Store::where('organization_id', $id)
            ->where('isActive', 1)->get();
        return response()->json($store_id);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back();
    }
}
