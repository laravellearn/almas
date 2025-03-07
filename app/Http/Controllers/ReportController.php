<?php

namespace App\Http\Controllers;

use App\Models\Abortion;
use App\Models\Employee;
use App\Models\Organization;
use App\Models\Product;
use App\Models\Repair;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Unit;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function warehouse()
    {
        $stores = Store::where('isActive', 1)->get();
        $organizations = Organization::where('isActive', 1)->get();
        return view('reports.warehouses', compact('stores', 'organizations'));
    }

    public function warehouseFilter(Request $request)
    {
        $stores = Store::where('isActive', 1)->get();
        $organizations = Organization::where('isActive', 1)->get();

        $organizationField = $request['organization'];
        $storeField = $request['store'];
        $statusField = $request['status'];
        $typeField = $request['type'];


        //products --------------------------------
        if ($request['type'] == "products") {
            $products = Product::where('isActive', 1);

            if ($request->has('organization')) {
                if ($request->organization != "all") {
                    $products->where('organization_id', $request->organization);
                }
            }

            if ($request->has('store')) {
                if ($request->store != "all") {
                    $products->where('store_id', $request->store);
                }
            }

            if ($request->has('status')) {
                if ($request->status != "all") {
                    if ($request->status != "off") {
                        $products->where('entity', 0);
                    } else {
                        $products->where('entity', '>', 0);
                    }
                }
            }
            $products->get();

            $products = collect($products->get());
            return view('reports.warehouses-filter', compact('products', 'stores', 'organizations', 'organizationField', 'typeField', 'statusField', 'storeField'));
        }
        //End Products ---------------------------

        //stocks --------------------------------
        if ($request['type'] == "stocks") {
            $stocks = Stock::where('isActive', 1);

            if ($request->has('organization')) {
                if ($request->organization != "all") {
                    $stocks->where('organization_id', $request->organization);
                }
            }

            if ($request->has('store')) {
                if ($request->store != "all") {
                    $stocks->where('store_id', $request->store);
                }
            }

            if ($request->has('status')) {
                if ($request->status != "all") {
                    if ($request->status != "off") {
                        $stocks->where('entity', 0);
                    } else {
                        $stocks->where('entity', '>', 0);
                    }
                }
            }
            $stocks->get();

            $stocks = collect($stocks->get());
            return view('reports.warehouses-filter', compact('stocks', 'stores', 'organizations', 'organizationField', 'typeField', 'statusField', 'storeField'));
        }
        //End stocks ---------------------------


        //abortions --------------------------------
        if ($request['type'] == "abortions") {
            $abortions = Abortion::where('isActive', 1);

            if ($request->has('organization')) {
                if ($request->organization != "all") {
                    $abortions->where('organization_id', $request->organization);
                }
            }

            if ($request->has('store')) {
                if ($request->store != "all") {
                    $abortions->where('store_id', $request->store);
                }
            }

            if ($request->has('status')) {
                if ($request->status != "all") {
                    if ($request->status != "off") {
                        $abortions->where('entity', 0);
                    } else {
                        $abortions->where('entity', '>', 0);
                    }
                }
            }
            $abortions->get();

            $abortions = collect($abortions->get());
            return view('reports.warehouses-filter', compact('abortions', 'stores', 'organizations', 'organizationField', 'typeField', 'statusField', 'storeField'));
        }
        //End abortions ---------------------------


        //repairs --------------------------------
        if ($request['type'] == "repairs") {
            $repairs = Repair::where('isActive', 1);

            if ($request->has('organization')) {
                if ($request->organization != "all") {
                    $repairs->where('organization_id', $request->organization);
                }
            }

            if ($request->has('store')) {
                if ($request->store != "all") {
                    $repairs->where('store_id', $request->store);
                }
            }

            if ($request->has('status')) {
                if ($request->status != "all") {
                    if ($request->status != "off") {
                        $repairs->where('entity', 0);
                    } else {
                        $repairs->where('entity', '>', 0);
                    }
                }
            }
            $repairs->get();

            $repairs = collect($repairs->get());
            return view('reports.warehouses-filter', compact('repairs', 'stores', 'organizations', 'organizationField', 'typeField', 'statusField', 'storeField'));
        }
        //End repairs ---------------------------


        //all --------------------------------
        if ($request['type'] == "all") {
            $repairs = Repair::where('isActive', 1);
            $abortions = Abortion::where('isActive', 1);
            $stocks = Stock::where('isActive', 1);
            $products = Product::where('isActive', 1);

            if ($request->has('organization')) {
                if ($request->organization != "all") {
                    $repairs->where('organization_id', $request->organization);
                    $abortions->where('organization_id', $request->organization);
                    $stocks->where('organization_id', $request->organization);
                    $products->where('organization_id', $request->organization);
                }
            }

            if ($request->has('store')) {
                if ($request->store != "all") {
                    $repairs->where('store_id', $request->store);
                    $abortions->where('store_id', $request->store);
                    $stocks->where('store_id', $request->store);
                    $products->where('store_id', $request->store);
                }
            }

            if ($request->has('status')) {
                if ($request->status != "all") {
                    if ($request->status != "off") {
                        $repairs->where('entity', 0);
                        $abortions->where('entity', 0);
                        $stocks->where('entity', 0);
                        $products->where('entity', 0);
                    } else {
                        $repairs->where('entity', '>', 0);
                        $abortions->where('entity', '>', 0);
                        $stocks->where('entity', '>', 0);
                        $products->where('entity', '>', 0);
                    }
                }
            }
            $repairs->get();
            $abortions->get();
            $stocks->get();
            $products->get();

            $repairs = collect($repairs->get());
            $abortions = collect($abortions->get());
            $stocks = collect($stocks->get());
            $products = collect($products->get());

            $all = 1;

            return view('reports.warehouses-filter', compact('repairs', 'abortions', 'stocks', 'products', 'all', 'stores', 'organizations', 'organizationField', 'typeField', 'statusField', 'storeField'));
        }
        //End all ---------------------------

    }
}
