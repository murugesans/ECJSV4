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
			"email": "musuker@paypal.com",
			"first_name":"murugesh",
			"last_name":"s"
		}
  },
  "application_context" : {
	"shipping_preference":"NO_SHIPPING",
	"user_action":"commit"
},
  "transactions": [
    {
      "amount":{
        "total":"1.00",
        "currency":"INR"
      },
      "payment_options": {
        "allowed_payment_method": "INSTANT_FUNDING_SOURCE"
      },
	  "item_list": {
		 "shipping_phone_number":"+919840592426",
		"items":[  
               {  
                  "name":"Service product",
                  "currency":"INR",
                  "quantity":1,
                  "price":"1.00"
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
