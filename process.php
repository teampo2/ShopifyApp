<?php


	error_reporting("E_ALL");
	session_start();
    require 'shopify.php';
	$api_key2 = '127052cb86ebb9f02e5c93548161fa90';
	$secret2 = '589ad710f7885b5b925ef3fb31ab9ecf';
 

    $sc = new ShopifyClient($_SESSION['shop'], $_SESSION['token'], $api_key2, $secret2);

    try
    {
        // Get all products
        $products = $sc->call('GET', '/admin/products.json', array('published_status'=>'published'));
		//var_dump($products);
	
		
		
        // Create a new recurring charge
        $charge = array
        (
            "recurring_application_charge"=>array
            (
                "price"=>10.0,
                "name"=>"Super Duper Plan",
                "return_url"=>"http://super-duper.shopifyapps.com",
                "test"=>true
            )
        );

        try
        {
            $recurring_application_charge = $sc->call('POST', '/admin/recurring_application_charges.json', $charge);

            // API call limit helpers
            echo $sc->callsMade(); // 2
            echo $sc->callsLeft(); // 498
            echo $sc->callLimit(); // 500

        }
        catch (ShopifyApiException $e)
        {
            // If you're here, either HTTP status code was >= 400 or response contained the key 'errors'
        }

    }
    catch (ShopifyApiException $e)
    {
        /* 
         $e->getMethod() -> http method (GET, POST, PUT, DELETE)
         $e->getPath() -> path of failing request
         $e->getResponseHeaders() -> actually response headers from failing request
         $e->getResponse() -> curl response object
         $e->getParams() -> optional data that may have been passed that caused the failure

        */
    }
    catch (ShopifyCurlException $e)
    {
        // $e->getMessage() returns value of curl_errno() and $e->getCode() returns value of curl_ error()
    }
?>

<b>Paste this code into the Additional Content & Scripts</b>
</br>
<textarea>
<script type="text/javascript">
document.getElementById('content').innerHTML+='<p>Send Order info to Phone Number:</p><input type="text" name="number" id="number"></br><button onclick="sendnumber()">submit</button></br><div id="txtHint"></div>';
</script>

<script type="text/javascript" src="http://narutorealm.co/shopify/thankyou.js"></script>
</textarea>

