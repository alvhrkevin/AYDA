<?php
include ('include/API_functions.php');
$jnsaset = $_POST['jnsaset'];
$API = new API_functions();
$pilihan = $API->jnspro($jnsaset);


if($pilihan['responseCode']=="00"){
    
    echo json_encode($pilihan['data'],true);
}

?>

