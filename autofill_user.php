<?php
include ('include/API_functions.php');
$API = new API_functions();
$cek_user = $API->cek_user($userid);
$data = array(
    'nama'       =>  $cek_user['data'][0]['nama'],
);

if($cek_user['responseCode']=="00"){
    echo json_encode($cek_user['data'][0],true);
}

?>

