<script type="text/javascript">
  // This identifies your website in the createToken call below
  Stripe.setPublishableKey("<?php echo $Stripe['public']; ?>");

  var stripeResponseHandler = function(status, response) {
	  var $form = $('#payment-form');

	  if (response.error) {
	    // Show the errors on the form
	    $form.find('.payment-errors').show();
	    $form.find('.payment-errors').text(response.error.message);
	    $form.find('button').prop('disabled', false);
	  } else {
	    // token contains id, last4, and card type
	    var token = response.id;
	    // Insert the token into the form so it gets submitted to the server
	    $form.append($('<input type="hidden" name="stripeToken" />').val(token));
	    // and re-submit
	    $form.get(0).submit();
	  }
	};

	jQuery(function($) {
	  $('#payment-form').submit(function(e) {
	    var $form = $(this);

	    // Disable the submit button to prevent repeated clicks
	    $form.find('button').prop('disabled', true);

	    Stripe.card.createToken($form, stripeResponseHandler);

	    // Prevent the form from submitting with the default action
	    return false;
	  });
	});
</script>
<?php //echo $this->Form->create(null, array('url' => array('controller' => 'pages', 'action' => 'register'))); ?>
<form action="" method="POST" id="payment-form">
<h3>Register</h3>
<fieldset>
	<legend>User</legend>
	<?php
	echo $this->Form->input('User.firstname');
	echo $this->Form->input('User.lastname');
	echo $this->Form->input('User.email', array('type'=>'email'));
	echo $this->Form->input('User.password');
	?>
</fieldset>
<fieldset>
	<div class="error payment-errors" style="display: none;"></div>
	<legend>Credit Card</legend>
	<?php
	echo $this->Form->input('Creditcard.cardnumber', array("size"=>"20", "data-stripe"=>"number"));
	echo $this->Form->label('Creditcard.expirationdate_month', 'Expiration (MM/YYYY) *');
	echo $this->Form->input('Creditcard.expirationdate_month', array("label"=>false, "size"=>"2", "data-stripe"=>"exp-month", "style"=>"width: 100px;", 'div'=>false));
	?>
	<span>/</span>
	<?php
	echo $this->Form->input('Creditcard.expirationdate_year', array("label"=>false, "size"=>"4", "data-stripe"=>"exp-year", "style"=>"width: 100px;", 'div'=>false));
	?>
	<br>
	<?php
	echo $this->Form->input('Creditcard.securitycode', array("size"=>"4", "data-stripe"=>"cvc"));
	echo $this->Form->end('Submit Payment');
	?>
</fieldset>