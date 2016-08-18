<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers:Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
require_once('../vendor/autoload.php');
use \Firebase\JWT\JWT;

$secretKey = "mykey";
$headers = apache_request_headers();
foreach ($headers as $name => $value) {
    //echo "$name: $value\n";
}

$JWT = null;
 if(isset($headers['Authorization'])){
 	$head = $headers['Authorization'];
 	//echo $head . "<br>";
    $JWT = substr($head,7);
    echo $JWT;
    $decoded = JWT::decode($JWT, $secretKey, array('HS256'));
	print_r($decoded);
	
 } 



/*
 NOTE: This will now be an object instead of an associative array. To get
 an associative array, you will need to cast it as such:
*/

//$decoded_array = (array) $decoded;

/**
 * You can add a leeway to account for when there is a clock skew times between
 * the signing and verifying servers. It is recommended that this leeway should
 * not be bigger than a few minutes.
 *
 * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
 */
//JWT::$leeway = 60; // $leeway in seconds


?>