<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Subscription;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        // Set your Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Get the authenticated user
        $user = $request->user();

        // Create a subscription in Stripe
        $stripeSubscription = Subscription::create([
            'customer' => $user->stripe_id,
            'items' => [
                [
                    'price' => 'your_price_id', // Replace with your price ID
                ],
            ],
        ]);

        // Update user's subscription status in your database
        $user->update([
            'subscription_id' => $stripeSubscription->id,
            'subscription_status' => 'active',
        ]);

        return redirect()->back()->with('success', 'Subscription successful!');
    }

    public function cancelSubscription(Request $request)
    {
        // Set your Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Get the authenticated user
        $user = $request->user();

        // Cancel the subscription in Stripe
        $subscription = Subscription::retrieve($user->subscription_id);
        $subscription->cancel();

        // Update user's subscription status in your database
        $user->update([
            'subscription_status' => 'canceled',
        ]);

        return redirect()->back()->with('success', 'Subscription canceled!');
    }
}
