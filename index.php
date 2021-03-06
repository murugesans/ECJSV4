<?php
include('config.php');
?>
<!DOCTYPE html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
</head>

<body>
    <div id="paypal-button-container"></div>

    <script>
        paypal.Button.render({

            env: 'production', // sandbox | production
	locale: 'en_IN',
			
         style: {
            layout: 'vertical',  // horizontal | vertical
            size:   'medium',    // medium | large | responsive
            shape:  'rect',      // pill | rect
            color:  'gold' ,			// gold | blue | silver | black
			label: 'paypal'
        },

        // Specify allowed and disallowed funding sources
        //
        // Options:
        // - paypal.FUNDING.CARD
        // - paypal.FUNDING.CREDIT
        // - paypal.FUNDING.ELV
		/*paypal.FUNDING.BANCONTACT,
               paypal.FUNDING.ELV,
               paypal.FUNDING.EPS,
               paypal.FUNDING.GIROPAY,
               paypal.FUNDING.IDEAL,
               paypal.FUNDING.MYBANK,
               paypal.FUNDING.SOFORT,*/

        funding: {
            allowed: [
               	paypal.FUNDING.CARD
               ],
            disallowed: [paypal.FUNDING.CREDIT]
        },


            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function() {

                // Set up a url on your server to create the payment
                //var CREATE_URL = 'createPaymentAirline.php';
                var CREATE_URL = 'createPayment.php';

                // Make a call to your server to set up the payment
                return paypal.request.post(CREATE_URL)
                    .then(function(res) {
						console.log(res);
                        return res.id;
						//debugger;
                        //return res;
                    });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {
			//console.log(data); //exit;
                // Set up a url on your server to execute the payment
				var EXECUTE_URL = 'executePayment.php';

                // Set up the data you need to pass to your server
				//alert(data.paymentID); exit;
                var data = {
                    paymentID: data.paymentID,
                    payerID: data.payerID
                };

                // Make a call to your server to execute the payment
                return paypal.request.post(EXECUTE_URL, data)
                    .then(function (res) {
						console.log(res);
						if (res.name == "INSTRUMENT_DECLINED"){
							actions.restart();
						}else{
							window.location.href="successPayment.php?id=" + encodeURIComponent(res.id);
							
						}
                    })
					.catch(function(err){
						console.log(err);
					});
            },
			 /*onAuthorize: function(data, actions) {
                    return actions.redirect();
                },
			*/
			onCancel: function(data, actions) {
				  // Set up a url on your server to cancel the payment
				  console.log('cancel-'+data);
                window.location.href = 'cancel.php';
				//exit;
			},
			
			/*onError:function(data, actions) {
				  console.log('error-'+data);
                window.location.href = 'error.php';
				//exit;
			}*/

        }, '#paypal-button-container');
    </script>
</body>
</html>
