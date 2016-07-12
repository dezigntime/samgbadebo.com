<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

include_once('../lib/mailchimp.php');
//dwd
//$mc = new MailChimp('72096264afc77f930a03b8d31ec79aa5-us3');
//samgbadebo
$mc = new MailChimp('491845fd35a61dcde1dc6c95dad62c2e-us13');




if(isset($_GET['EMAIL']))
{
    //dwd list id = 329aa1aa6e
    //gbadebo list id = 7c379a39e5
    $result = $mc->post('/lists/7c379a39e5/members', array(
        'email_address' => $_GET['EMAIL'],
        //'merge_fields' => array('FNAME'=>$_GET['FNAME'], 'LNAME'=>$_GET['LNAME']),
        'status' => 'subscribed'
    ));

    $response = array("result" => "success" ,"msg" => $result , "dataSent" => $_GET);
    $json = json_encode($response);
//    echo  json_encode($response);
    echo isset($_GET['c'])
        ? "{$_GET['c']}($json)"
        : $json;
    return;
}else{

if(isset ($_GET['c']))
{
    header("Content-Type: application/json");

    $response = array(
                	 "msg" => "Almost finished... We need to confirm your email address. To complete the subscription process, please click the link in the email we just sent you.",
                	 "result" => "success"
                	);

    echo $_GET['c']."(".json_encode($response).")";

}

}

?>