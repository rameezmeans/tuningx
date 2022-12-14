<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingController extends Controller
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
    public function shopProduct()
    {
        $price = Price::where('label', 'credit_price')->first();

        $customer = Auth::user();

        $factor = 0;
        $tax = 0;

        if($customer->group->tax > 0){
            $tax = (float) $customer->group->tax;
        }

        if($customer->group->raise > 0){
            $factor = (float)  ($customer->group->raise / 100) * $price->value;
        }

        if($customer->group->discount > 0){
            $factor =  -1* (float) ($customer->group->discount / 100) * $price->value;
        }
        
        return view('shop-product', ['price' => $price, 'tax' => $tax, 'factor' => $factor, 'group' => $customer->group]);
    }
}
