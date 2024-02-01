<?php
namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Stripe;
use Stripe\Charge;

class FormPaymentController extends Controller
{
    // Method to show the payment form
    public function showPaymentForm()
    {
        return view('payment.form.payment_form');
    }

    // Method to process the payment
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

    // Method to display the payment success page
    public function paymentSuccess()
    {
        return view('payment.payment_success');
    }
}
