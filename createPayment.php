<?php
include('config.php');
$access_token = getAccessToken(); //echo $access_token;

/********** Create payment Pay Load ****/
$postData = '{
  "intent": "sale",
  "redirect_urls": {
    "return_url": "executePayment.php",
    "cancel_url": "http://www.paypal.com"
  },
  "payer": {
    "payment_method":"paypal",
	   "payer_info":{
			"email": "muru@pp.com",
			"first_name":"muru",
			"last_name":"ss"
		}
  },
  "application_context" : {
	"shipping_preference":"NO_SHIPPING",
	"user_action":"commit"
},
  "transactions": [
    {
      "amount":{
        "total":"0.01",
        "currency":"USD"
      },
	  "invoice_number": "Inline-001",
      "payment_options": {
        "allowed_payment_method": "INSTANT_FUNDING_SOURCE"
      },
	  "item_list": {
		 "shipping_phone_number":"+91 9840123456",
		"items":[  
               {  
                  "name":"2500 Gold Coins",
                  "currency":"USD",
                  "quantity":1,
                  "price":"0.01"
               }
            ]
	  }

    }
  ]
}';
//Create Payment method

$res = getApprovalURL($access_token, $postData);
print json_encode($res);
/*$approval_url = $res['links']['1']['href'];
$token = substr($approval_url, -20);
print json_encode($token); */
//var_dump($res); exit;
?>