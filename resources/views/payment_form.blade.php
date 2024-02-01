
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>payment</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body>

    <div class="payment-form-container">
        <form id="payment-form" action="{{ route('payment.process') }}" method="POST">
            @csrf
            <div class="form-row">
                <label for="card-element">Credit or Debit Card</label>
                <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>
            </div>

            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>

            <button id="submit-button">Submit Payment</button>
        </form>
    </div>

    <!-- Assign Stripe public key to a JavaScript variable -->
    <script>
        var stripePublicKey = '{{ env('STRIPE_KEY') }}';
    </script>

    <!-- Include Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>

    <!-- Include the separated JavaScript file -->
    <script src="{{ asset('js/payment_form.js') }}"></script>
</body>
</html>

