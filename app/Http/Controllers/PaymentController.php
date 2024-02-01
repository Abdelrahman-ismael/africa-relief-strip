<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment_form');
    }

    public function processPayment(Request $request)
    {
        // Set your Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Tokenize the card details using Stripe.js
        $token = $request->input('stripeToken');

        // Charge the card
        $charge = Charge::create([
            'amount' => 999999, // Amount in cents
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
