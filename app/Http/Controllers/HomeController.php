<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Employee;
use App\Models\Delivery;
use App\Models\Log;
use App\Models\Repair;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $products = Product::count();
        $employees = Employee::count();
        $repairs = Repair::count();
        $logs = Log::paginate('10');
        return view('welcome', compact('user','products','employees','repairs','logs'));
    }

    public function changeInfoGet()
    {
        $user = \Auth::user();
        return view('auth.changeInfo', compact('user'));
    }

    public function changeInfoPost(Request $request)
    {
        $user = \Auth::user();
        $user->update([
            'name' => $request->name
        ]);
        if (isset($request->password)) {
            $validator = Validator::make($request->all(), [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user->update([
                'password' => Hash::make($request['password']),
            ]);

        }
        Alert::success('تشکر', 'رکورد با موفقیت ویرایش شد');

        return back();
    }
}
