<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    public function stripe(Order $order)
    {
        return view('stripes.stripe',compact("order"));
    }


    public function stripePost(Request $request,Order $order)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
            "amount" => $order->totalPrice() * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "payment"
        ]);

        $order->update([
            'status' => 5
        ]);

        session()->flash('success', 'Payment successful!');

        return redirect()->back();
    }

}
