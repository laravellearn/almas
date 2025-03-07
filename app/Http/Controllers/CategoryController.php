<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Log;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:categories,user')->only(['index','store','edit','update']);
    }

    public function index()
    {
        $categories = Category::all();
        $parents = Category::where('parent_id' , Null)->where('isActive',1)->get();
        return view('categories.index',compact('categories','parents'));
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());
        $user = \Auth::user();
        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'action' => 'create',
            'description' => 'دسته بندی ایجاد شد' . '-' . $category->title
        ]);

        Alert::success('تشکر', 'رکورد با موفقیت ایجاد شد');
        return back();
    }

    public function edit(Category $category)
    {
        $categories = Category::all();
        $parents = Category::where('parent_id' , Null)->where('id','!=',$category->id)
                    ->where('isActive',1)->get();

        return view('categories.edit',compact('category','categories','parents'));
    }

    public function update(Request $request, Category $category)
    {
        $request->isActive == "on" ? $request->isActive = 1 : $request->isActive = 0;
        $category->update([
            'title' => $request->title,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'isActive' => $request->isActive,
            'organization_id' => $request->organization_id
        ]);
        $categories = Category::all();
        $parents = Category::where('parent_id' , Null)->get();
        $user = \Auth::user();
        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'action' => 'update',
            'description' => 'دسته بندی ویرایش شد' . '-' . $category->title
        ]);

        Alert::success('تشکر', 'رکورد با موفقیت ویرایش شد');
        return redirect()->route('categories.edit',compact('category','categories','parents'));
    }


}
