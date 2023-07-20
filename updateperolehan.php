<?php
include ('include/API_functions.php');
$rekening = $_POST['rekening'];
$nilai = $_POST['nilai'];
$memo = $_POST['memo'];
$API = new API_functions();
$update = $API->inputPerolehan($rekening,$nilai,$memo);
sleep(5);
echo $update;

?>