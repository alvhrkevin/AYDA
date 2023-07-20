<?php
include ('include/API_functions.php');
$rekening = $_POST['rekening'];
$API = new API_functions();
$cek_eksnasabah = $API->editnasabah($rekening);
$cek_eksnasabah=json_decode($cek_eksnasabah,true);
$data = array(//Parse Array Jadi Object
    'kantor'     =>  $cek_eksnasabah['data'][0]['kantor'],
    'nama'       =>  $cek_eksnasabah['data'][0]['nama'],      
);

if($cek_eksnasabah['responseCode']=="00"){
    echo json_encode($cek_eksnasabah['data'][0],true);
}

?>

