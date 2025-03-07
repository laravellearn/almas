<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:permissions,user')->only(['index','store','edit','update']);
    }

    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::where('isActive',1)->get();
        return view('permissions.index',compact('permissions','roles'));
    }

    public function store(Request $request)
    {
        $permission = Permission::create($request->all());
        $permission->roles()->sync($request['roles']);
        $user = \Auth::user();
        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'action' => 'create',
            'description' => 'سطح دسترسی ایجاد شد' . '-' . $permission->description
        ]);

        Alert::success('تشکر', 'رکورد با موفقیت ایجاد شد');

        return back();
    }

    public function edit(Permission $permission)
    {
        $permissions = Permission::all();
        $roles = Role::where('isActive',1)->get();

        return view('permissions.edit',compact('permission','permissions','roles'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->isActive == "on" ? $request->isActive = 1 : $request->isActive = 0;
        $permission->update([
            'isActive' => $request->isActive
        ]);
        $permission->roles()->sync($request['roles']);
        $roles = Role::where('isActive',1)->get();

        $permissions = Permission::all();
        $user = \Auth::user();
        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'action' => 'update',
            'description' => 'سطح دسترسی ویرایش شد' . '-' . $permission->description
        ]);

        Alert::success('تشکر', 'رکورد با موفقیت ویرایش شد');

        return redirect()->route('permissions.edit',compact('permission','permissions','roles'));
    }
}
