<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Checkout\Session;

class SessionPaymentController extends Controller
{
    public function showSessionPaymentForm()
    {
        return view('payment.session.session_payment_form');
    }

    public function processSessionPayment(Request $request)
    {
        // Set your Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Generate a session for Checkout
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Example Product',
                    ],
                    'unit_amount' => 1000, // Amount in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('session.payment.success'),
            'cancel_url' => route('session.payment.cancel'),
        ]);

        // Redirect customer to Checkout page
        return redirect()->to($session->url);
    }

    public function sessionPaymentSuccess()
    {
        return view('payment.payment_success');
    }
}
