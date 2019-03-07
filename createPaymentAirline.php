<?php
include('config.php');
$access_token = getAccessToken(); //echo $access_token;
$randomnumber=mt_rand();
$profileData='{
  "name": "Muru'.$randomnumber.'",
  "presentation": {
    "brand_name":"Muru Testing ECJSv4",
    "logo_image": "https://static.e-junkie.com/sslpic/176445.447063fea884c4e0a5a1c00284ce1ef9.jpg"
  },
  "input_fields": {
    "no_shipping": "1"
  }
}';
$webprofileid = getWebProfileID($access_token, $profileData);
$postData = '{
  "intent": "sale",
  "experience_profile_id":"'.$webprofileid.'",
  "redirect_urls": {
    "return_url": "http://example.com/your_redirect_url.html",
    "cancel_url": "http://localhost/ECJSv4/cancel.php"
  },
  "payer": {
    "payment_method":"paypal"
  },
  "transactions": [
    {
      "amount":{
        "total":"10.00",
        "currency":"USD"
      },
	  "item_list": {
"items": [{
"name": "Adult Ticket", "quantity": "1",
"price": "10.00",
"sku": "1",
"currency": "USD"
}]
},
	"airline_itineraries": [{
			"passenger_name": "Mark Yang",
			"issued_date": "2017-05-04",
			"travel_agency_name": "TA Agencies",
			"travel_agency_code": "TA001",
			"ticket_number": "123456789001",
			"issuing_carrier_code": "SG",
			"customer_code": "C12345",
			"total_fare": {
				"value": "100.00",
				"currency": "USD"
			},
			"total_tax": {
				"value": "0.00",
				"currency": "USD"
			},
			"total_fee": {
				"value": "100.00",
				"currency": "USD"
			},
			"clearing_sequence": "1",
			"clearing_count": "2",
			"restricted_ticket": "",
			"flight_details": [{
				"conjunction_ticket": "",
				"exchange_ticket": "",
				"coupon_number": "",
				"service_class": "T",
				"travel_date": "2017-05-29",
				"carrier_code": "SG",
				"stopover_permitted": "false",
				"departure_airport": "SFO",
				"arrival_airport": "DXB",
				"flight_number": "EK231",
				"departure_time": "15:30",
				"arrival_time": "07:22",
				"fare_basis_code": "TLDISX2",
				"fare": {
					"value": "2.00",
					"currency": "USD"
				},
				"tax": {
					"value": "2.00",
					"currency": "USD"
				},
				"fee": {
					"value": "2.00",
					"currency": "USD"
				},
				"endorsement_or_restrictions": ""
			}, {
				"conjunction_ticket": "",
				"exchange_ticket": "",
				"coupon_number": "",
				"service_class": "T",
				"travel_date": "2017-06-12",
				"carrier_code": "US",
				"stopover_permitted": "false",
				"departure_airport": "DXB",
				"arrival_airport": "SFO",
				"flight_number": "EK232",
				"departure_time": "08:30",
				"arrival_time": "12:22",
				"fare_basis_code": "",
				"fare": {
					"value": "2.00",
					"currency": "USD"
				},
				"tax": {
					"value": "2.00",
					"currency": "USD"
				},
				"fee": {
					"value": "2.00",
					"currency": "USD"
				},
				"endorsement_or_restrictions": ""
			}]
		}]
    }
  ]
}';
//print $postData;
$res = getApprovalURL($access_token, $postData);
print json_encode($res);
//var_dump($res); exit;
?>