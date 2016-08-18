<?php 
//ini_set('session.save_path',getcwd(). '/tmp');
//session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers:Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");

if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
die();
}
require_once('../connection/dbconn.php');
require_once('../crud/crud.php');
require_once('../crud/authService.php');
require_once('../vendor/autoload.php');
use \Firebase\JWT\JWT;

//SECRET KEY
//*it's better to get Secret key from another file and call it.
$secretKey = "mykey";
$issuedAt   = time();

//PREPARE THE TOKEN 
//TO BE SENT BACK AFTER SUCCESSFUL LOGIN
$token = array(
    "iss" => "http://example.org", //issuer
    "aud" => "http://example.com", //
    "iat" => $issuedAt, // Issued at: time when the token was generated
    "nbf" => $issuedAt, // Not before
    "exp" => $issuedAt + 60
);
//PREPARE JWT
$jwt = JWT::encode($token, $secretKey, 'HS256');
$unencodedArray = ['jwt' => $jwt];

//$decoded = JWT::decode($jwt, $secretKey, array('HS256'));
//echo json_encode($decoded);

$db = new dbconn();
$dbconn = $db->getConnection();
$crud = new crud($dbconn);
$authServices = new AuthServices($crud);


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
@$user = $request->email;
@$pass = $request->pass;
//print_r(time());
$authServices->authUserPass($user,$pass);
//echo json_encode($unencodedArray);

?>