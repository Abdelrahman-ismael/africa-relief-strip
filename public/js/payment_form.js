var stripe = Stripe(stripePublicKey);
var elements = stripe.elements();

var card = elements.create('card');
card.mount('#card-element');

card.on('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

var form = document.getElementById('payment-form');
var submitButton = document.getElementById('submit-button');

form.addEventListener('submit', function(event) {
    event.preventDefault();
    submitButton.disabled = true;

    stripe.createToken(card).then(function(result) {
        if (result.error) {
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            submitButton.disabled = false;
        } else {
            // Insert the token ID into the form so it gets submitted to the server
            var tokenInput = document.createElement('input');
            tokenInput.setAttribute('type', 'hidden');
            tokenInput.setAttribute('name', 'stripeToken');
            tokenInput.setAttribute('value', result.token.id);
            form.appendChild(tokenInput);

            // Submit the form
            form.submit();
        }
    });
});
