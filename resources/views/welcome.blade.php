<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="container">
            <form action="{{ route('create-payment') }}" method="post">
                @csrf
                <input type="submit" value="Pay Now"/>
            </form>
        </div>
    </body>
</html>


<!-- Client side create payment -->
<!--
<div id="paypal-button"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
            sandbox: 'AQ5NNAcWpe3vtXkkrT962g4tqK5E5LyRF0G4-BN7inKmeTPLF7-zKObSwfedMLD6Sc6wWGOduY20I244',
            production: 'demo_production_client_id'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
            size: 'medium',
            color: 'gold',
            shape: 'pill',
        },

        // Enable Pay Now checkout flow (optional)
        commit: true,

        // Set up a payment
        payment: function(data, actions) {
            return actions.payment.create({
                redirect_urls:{
                    return_url: 'http://localhost:8000/execute-payment'
                },
                transactions: [{
                    amount: {
                        total: '1',
                        currency: 'USD'
                    }
                }]
            });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
            //Processing payment on the client side!!

            // return actions.payment.execute().then(function() {
            //     // Show a confirmation message to the buyer
            //     window.alert('Thank you for your purchase!');
            // });


            //Processing payment on the server side!!

            return actions.redirect();
        }
    }, '#paypal-button');

</script>
-->