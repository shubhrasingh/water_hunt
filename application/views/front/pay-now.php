
<?php
// Merchant key here as provided by Payu
//$MERCHANT_KEY = "rjQUPktU";   /****  TEST KEY ***/

$MERCHANT_KEY = "rjQUPktU";


// Merchant Salt as provided by Payu
//$SALT = "e5iIg1jwi8";  /****  TEST SALT ***/

$SALT = "e5iIg1jwi8";

// End point - change to https://secure.payu.in for LIVE mode
//$PAYU_BASE_URL = "https://test.payu.in";   /****  TEST URL ***/


$PAYU_BASE_URL = "https://test.payu.in";

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>
  <head>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onload="submitPayuForm()">

	<?php 
     
     $amouttoal =   $getOrders[0]->final_amount;
     $name = $getOrders[0]->name;
	 $email = $getOrders[0]->email;
	 $contact = $getOrders[0]->mobile;
	 $billing_address = $getOrders[0]->address;
	 $order_id = $getOrders[0]->id;
	 

	 $failurl = base_url().'paymentfailure';
	 $success = base_url().'paymentsuccess';
	 
	?>
	 
     <form action="<?php echo $action; ?>" id="payuForm" method="post" name="payuForm">
	
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $order_id ?>" />
	  <input type="hidden" name="amount" value="<?php echo (empty($posted['amount'])) ? $amouttoal : $posted['amount'] ?>" />
	  <input type="hidden" name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? $name : $posted['firstname']; ?>" />
	  <input type="hidden" name="email" id="email" value="<?php echo (empty($posted['email'])) ? $email : $posted['email']; ?>" />
	  <input type="hidden" name="phone" value="<?php echo (empty($posted['phone'])) ? $contact : $posted['phone']; ?>" />
	  <input type="hidden" name="productinfo" value="<?php echo (empty($posted['productinfo'])) ? $order_id : $posted['productinfo'] ?>">
	  <input type="hidden" name="surl" value="<?php echo (empty($posted['surl'])) ? $success : $posted['surl'] ?>" size="64" />
	  <input type="hidden" name="furl" value="<?php echo (empty($posted['furl'])) ? $failurl : $posted['furl'] ?>" size="64" />
	  <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
	   <?php if(!$hash) { ?>
           <input type="submit" value="Submit" style="display:none;">
          <?php } ?>
   
   </form>
	
	<script>
	  
	window.onload = function(){
     document.forms['payuForm'].submit();
    }
	
	</script>
  </body>
</html>
