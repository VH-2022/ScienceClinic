<body style="text-align:center;" onLoad="document.forms['paypal_form'].submit();">'
    <!--<form  action='https://www.paypal.com/cgi-bin/webscr' name='paypal_form' style='display:none'>-->
    <form action='https://www.sandbox.paypal.com/cgi-bin/webscr' name='paypal_form' style='display:none'>

        <input type='text' name='item_name' value='{{$total_commision}}'>
        <input type='text' name='custom' value='custom'>
        <input type='text' name='item_number' value='<?php echo $user_inquiry_id;?>'>
        <input type='text' name='amount' value='<?php echo $paypalNew; ?>'>
        <input type='text' name='currency_code' value='USD'>
        <input type='text' name='cmd' value='_xclick'>
        <input type='text' name='return' value='<?php echo URL::to('/'); ?>/payment_script_status?id=<?php echo $user_id; ?>'>
        <input type='text' name='cancel_return' value='<?php echo URL::to('/'); ?>'>
        
        <input type='text' name='notify_url' value='<?php echo URL::to('/'); ?>/ipn?user_id=<?php echo $user_id; ?>'>
        <input type='text' name='quantity' value='1'>
        <input type='text' name='rm' value='2'>
        <input type='text' name='business' value='sb-c6ygs17143316@business.example.com'>
        <!--<input type='text' name='business' value='eventrrworld@gmail.com'>-->
        <?php /*
		payment Detail Hide from user
		
		*/ ?>
        <input type="hidden" name="landing_page" value="billing">

        <input id="testme" type='submit' name='' value=''>

    </form>
</body>
We are redirecting to paypal website.
<script>
</script>