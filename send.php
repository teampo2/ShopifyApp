<?php
/* Send an SMS using Twilio. You can run this file 3 different ways:
*
* - Save it as sendnotifications.php and at the command line, run
* php sendnotifications.php
*
* - Upload it to a web host and load mywebhost.com/sendnotifications.php
* in a web browser.
* - Download a local server like WAMP, MAMP or XAMPP. Point the web root
* directory to the folder containing this file, and load
* localhost:8888/sendnotifications.php in a web browser.
*/
// Step 1: Download the Twilio-PHP library from twilio.com/docs/libraries,
// and move it into the folder containing this file.

$number = $_POST["number"];
$orderid = $_POST["orderid"];

require "twilio/Services/Twilio.php";
// Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
$AccountSid = "ACfb6872d3fbd08f920e69858053268b08";
$AuthToken = "69c7695f0ea7ef196d877078b174dafc";
// Step 3: instantiate a new Twilio Rest Client
$client = new Services_Twilio($AccountSid, $AuthToken);
// Step 4: make an array of people we know, to send them a message.
// Feel free to change/add your own phone number and name here.



$sms = $client->account->sms_messages->create(
// Step 6: Change the 'From' number below to be a valid Twilio number
// that you've purchased, or the (deprecated) Sandbox number
"613-706-0944",
// the number we are sending to - Any phone number
$number,
// the sms body
"You just made an order: Order #".$orderid
);

// Display a confirmation message on the screen



?>
