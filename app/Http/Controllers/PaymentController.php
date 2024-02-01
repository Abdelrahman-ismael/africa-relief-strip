<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment_form');
    }

    public function processPayment(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $token = $request->stripeToken;

        $charge = Stripe\Charge::create([
            'amount' => 1000, // Amount in cents
            'currency' => 'usd',
            'description' => 'Example Charge',
            'source' => $token,
        ]);

        // Handle successful payment
        return redirect()->route('payment.success')->with('success', 'Payment successful!');
    }

    public function paymentSuccess()
    {
        return view('payment_success');
    }
}
