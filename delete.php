<?php
session_start();
if( !isset($_SESSION["userId"])){
     header("Location: ./");
   exit;
   }

include ('include/API_functions.php');
$API = new API_functions();

if(isset($_POST['delete'])){
  $no_aset    = $_POST['no_aset'];
  $keterangan = $_POST['keterangan']; 
  $userid     = $_SESSION["userId"];
  $link       = $_POST['link'];
  $pil        = '2';
  $indek      = $_POST['indek'];

  $split = explode("/",$link);
  $filename = $split[0];
  $filename2 = $split[1];
  $filename3 = $split[2];
  $filename4 = $split[3];
  $filename5 = $split[4];
  $filename6 = $split[5];
  $filename7 = $split[6];
  $filepath = "FOTO_C3/$no_aset/".$split[6];
 
     if (unlink($filepath)) {
      $hasil = $API->input_foto($no_aset, $indek, $link, $userid, $pil, $keterangan);
      if ($hasil['responseCode'] == 00) {
        echo "<link rel='stylesheet' href='assets/css/sweetalert2.min.css'>";
        echo "
          <script src='assets/js/sweetalert2.min.js'></script>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                title: 'Sukses',
                text: '" . $hasil['data'] . "',
                icon: 'success'
              }).then(function() {
                window.location = 'd_foto?page=display&na=" . base64_encode($no_aset) . "';
              });
            });
          </script>";
      } else {
        echo "<link rel='stylesheet' href='assets/css/sweetalert2.min.css'>";
        echo "
          <script src='assets/js/sweetalert2.min.js'></script>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                title: 'Error',
                text: '" . $hasil['responseMessage'] . "',
                icon: 'error'
              }).then(function() {
                window.location = 'd_foto?page=display&na=" . base64_encode($no_aset) . "';
              });
            });
          </script>";
      }
    }
}
?>
