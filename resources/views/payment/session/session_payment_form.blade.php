
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
        <form id="payment-form" action="{{ route('session.payment.process') }}" method="POST">
            <h1>Payment Compeleted</h1>
            @csrf
            <!-- Include any fields or information you need for the payment -->
            <button type="submit" id="submit-button">Submit Payment</button>
        </form>
    </div>
</body>
</html>

