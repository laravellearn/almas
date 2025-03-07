<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Organization;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users,user')->only(['index', 'store', 'edit', 'update', 'destroy', 'trashGet', 'trashPost', 'restore']);
    }

    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        $organizations = Organization::all();
        return view('users.index', compact('users', 'roles', 'organizations'));
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'personalID' => $request->password,
            'email' => $request->email,
            'organization_id' => $request->organization_id,
            'password' => bcrypt($request->password)
        ]);
        $user->roles()->sync($request->role_id);

        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => \Auth::user()->id,
            'action' => 'create',
            'description' => 'یک کاربر ایجاد شد' . '-' . $user->name
        ]);

        Alert::success('تشکر', 'رکورد با موفقیت ایجاد شد');
        return back();
    }

    public function edit(User $user)
    {
        $users = User::all();
        $roles = Role::all();
        $userEdit = $user;
        $organizations = Organization::all();
        return view('users.edit', compact('users', 'userEdit', 'roles', 'organizations'));
    }

    public function update(Request $request, User $user)
    {
        $request->isActive == "on" ? $request->isActive = 1 : $request->isActive = 0;
        $user->update([
            'name' => $request->name,
            'personalID' => $request->password,
            'email' => $request->email,
            'oraganization_id' => $request->organization_id,
            'isActive' => $request->isActive,
            'password' => bcrypt($request->password)
        ]);
        // $userEdit->roles()->sync($request->role_id,$userEdit->id);
        DB::table('role_user')
            ->where('user_id', $user->id)
            ->update(['role_id' => $request['role_id']]);


        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => \Auth::user()->id,
            'action' => 'update',
            'description' => 'کاربر ویرایش شد' . '-' . $user->name
        ]);

        Alert::success('تشکر', 'رکورد با موفقیت ویرایش شد');
        return back();
    }



    public function profile()
    {
    }

    public function profileUpdate()
    {
    }
}
