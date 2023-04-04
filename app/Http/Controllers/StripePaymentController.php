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
            "amount" => $order->totalPrice(),
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        $order->update([
            'status' => 5
        ]);

//        Session::flash('success', 'Payment successful!');

        return redirect()->route("index");
    }

}
