Stripe.setPublishableKey('pk_test_Cd02VPh2wFRg4bnQKT2fkzjm');

var $form = $('#checkout-form');

$form.submit(function(event) {
	$('#charge-error').addClass('hidden');
	$form.find('button').prop('disabled', true);
	Stripe.card.createToken({
		name: $('#card-name').val(),
		number: $('#card-number').val(),
		exp_month: $('#card-expiry-month').val(),
		exp_year: $('#card-expiry-year').val(),
		cvc: $('#card-cvc').val()
	}, stripeResponseHandler);
	return false;
});

function stripeResponseHandler(status, response)
{
	if (response.error) {
		$('#charge-error').removeClass('hidden');
		$('#charge-error').text(response.error.message);
		// Show the error messages on the form
		$form.find('button').prop('disabled', false);
	} else{
		// Get the token ID
		var token = response.id;

		// Insert the token into the form so it gets submitted to the server:
		$form.append($('<input type="hidden" name="stripeToken" />').val(token));

		// Submit the form:
		$form.get(0).submit();
	}
}