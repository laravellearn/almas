<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LicenseController extends Controller
{
    

    public function update($id,Request $request)
    {
        dd($id);
        $license = License::where('id', "1")->first();
        $license->update([
            'username' => $request['username'],
            'order_id' => $request['order_id'],
            'domain' => $request['domain']
        ]);

        Alert::success('تشکر', 'لایسنس با موفقیت ثبت شد');
        return view('welcome');

    }
}