<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\Organization;
use RealRashid\SweetAlert\Facades\Alert;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:organizations,user')->only(['index','store','edit','update']);
    }

    public function index()
    {
        $organizations = Organization::all();
        return view('organizations.index', compact('organizations'));
    }

    public function store(Request $request)
    {
        $organization = Organization::create($request->all());
        $user = \Auth::user();
        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'action' => 'create',
            'description' => 'سازمان ایجاد شد' . '-' . $organization->title
        ]);

        Alert::success('تشکر', 'رکورد با موفقیت ایجاد شد');
        return back();
    }

    public function edit(Organization $organization)
    {
        $organizations = Organization::all();
        return view('organizations.edit', compact('organization', 'organizations'));
    }

    public function update(Request $request, Organization $organization)
    {
        $request->isActive == "on" ? $request->isActive = 1 : $request->isActive = 0;
        $organization->update([
            'title' => $request->title,
            'description' => $request->description,
            'isActive' => $request->isActive
        ]);
        $organizations = Organization::all();
        $user = \Auth::user();
        Log::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'action' => 'update',
            'description' => 'سازمان ویرایش شد' . '-' . $organization->title
        ]);

        Alert::success('تشکر', 'رکورد با موفقیت ویرایش شد');
        return redirect()->route('organizations.edit', compact('organization', 'organizations'));
    }

}
