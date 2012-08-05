<?php

 
 $api_key = '0d3935a6023d43bcff3b1ac530b8e75e';
 $api_key2 = '127052cb86ebb9f02e5c93548161fa90';
 $secret2 = '589ad710f7885b5b925ef3fb31ab9ecf';
 
 $password = '92a78adc3cf7d88361c41afff2f1fbe0';
 $shop_domain = "howe-morar74.myshopify.com";
	$secret = '58896dcfabab5d9aecfda020e0aa75fb';
	$scope = 'write_products,read_orders';
 
    require 'shopify.php';
	
    if (isset($_GET['code'])) { // if the code param has been sent to this page... we are in Step 2
        // Step 2: do a form POST to get the access token
        $shopifyClient = new ShopifyClient($shop_domain, "",$api_key2 , $secret2);
        session_unset();
	session_start();
        // Now, request the token and store it in your session.
        $_SESSION['token'] = $shopifyClient->getAccessToken($_GET['code']);
        if ($_SESSION['token'] != '')
            $_SESSION['shop'] = $_GET['shop'];

		
        header("Location: process.php");
        exit;       
    }
	
	
    // if they posted the form with the shop name
    else if (isset($_POST['shop']) || isset($_GET['shop'])) {

        // Step 1: get the shopname from the user and redirect the user to the
        // shopify authorization page where they can choose to authorize this app
        $shop = isset($_POST['shop']) ? $_POST['shop'] : $_GET['shop'];
        $shopifyClient = new ShopifyClient($shop, "", $api_key2, $secret2);

        // get the URL to the current page
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") { $pageURL .= "s"; }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
		
	//	echo  $shopifyClient->getAuthorizeUrl($scope, $pageURL);

        // redirect to authorize url
    header("Location: " . $shopifyClient->getAuthorizeUrl($scope, $pageURL));
        exit;
    }

    // first time to the page, show the form below
?>
    <p>Install this app in a shop to get access to its private admin data.</p> 

    <p style="padding-bottom: 1em;">
        <span class="hint">Don&rsquo;t have a shop to install your app in handy? <a href="https://app.shopify.com/services/partners/api_clients/test_shops">Create a test shop.</a></span>
    </p> 

    <form action="test.php" method="post">
      <label for='shop'><strong>The URL of the Shop</strong> 
        <span class="hint">(enter it exactly like this: myshop.myshopify.com)</span> 
      </label> 
      <p> 
        <input id="shop" name="shop" size="45" type="text" value="https://howe-morar74.myshopify.com" /> 
        <input name="commit" type="submit" value="Install" /> 
      </p> 
    </form>
