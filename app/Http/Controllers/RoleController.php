<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:roles,user')->only(['index','store','edit','update','destroy','trashGet','trashPost','restore']);
    }

    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('roles.index',compact('roles','permissions'));
    }

    public function store(Request $request)
    {
        $role = Role::create($request->all());
        $role->permissions()->sync($request['permissions']);
        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => \Auth::user()->id,
            'action' => 'create',
            'description' => 'نقش جدید ایجاد شد' . '-' . $role->description
        ]);

        Alert::success('تشکر', 'رکورد با موفقیت ایجاد شد');

        return back();
    }

    public function edit(Role $role)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('roles.edit',compact('role','roles','permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->isActive == "on" ? $request->isActive = 1 : $request->isActive = 0;
        $role->update([
            'title' => $request->title,
            'description' => $request->description,
            'isActive' => $request->isActive
        ]);
        $roles = Role::all();
        $role->permissions()->sync($request['permissions']);
        $permissions = Permission::all();
        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => \Auth::user()->id,
            'action' => 'update',
            'description' => 'نقش ویرایش شد' . '-' . $role->description
        ]);

        Alert::success('تشکر', 'رکورد با موفقیت ویرایش شد');

        return redirect()->route('roles.edit',compact('role','roles','permissions'));
    }
}
