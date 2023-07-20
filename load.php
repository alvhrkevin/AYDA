<?php

session_start();
if( !isset($_SESSION["userId"])){
     header("Location: ./");
   exit;
   }

include ('include/API_functions.php');
$API = new API_functions();
 
if(isset($_POST['submit'])){
  $no_aset    = $_POST['no_aset'];
  $no_aset2 = explode(".", $no_aset);
  $keterangan = $_POST['keterangan']; 
  $userid     = $_SESSION["userId"];
  $filedata   = $_FILES['url']['tmp_name'];
  $size     =  $_FILES['url']['size'];
  $pil        = '1';
  $indek      = '0';

  $target_directory = "FOTO_C3/".$no_aset;
  $target_file = $target_directory.basename($_FILES["url"]["name"]);    
  $filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $newfilename = $target_directory."/".$_FILES["url"]["name"];

  if (!is_dir($target_directory)) {
    $folder = mkdir($target_directory, 0777, true);
  }

  if ($size > 1000000) {
    echo "<script src='assets/js/sweetalert2.min.js'></script>";
    echo "<link rel='stylesheet' href='assets/css/sweetalert2.min.css'>";
    echo "<script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'warning',
                title: 'Ukuran File Terlalu Besar',
                text: 'Ukuran file harus kurang dari 1MB!',
                confirmButtonText: 'OK',
                allowOutsideClick: false
            }).then(() => {
                window.location = 'f_foto?page=input&na=".base64_encode($no_aset)."';
            });
        });
    </script>";
    die();
}

  // $link   = "http://jasakoe.kospinjasa.com:3333/ccc/".$newfilename;
   $link   = "https://ayda.kospinjasa.com/ccc/".$newfilename;
  //$link   = "http://localhost:8080/ccc/".$newfilename;

    if (file_exists($newfilename)) {
      echo "<script src='assets/js/sweetalert2.min.js'></script>";
      echo "<link rel='stylesheet' href='assets/css/sweetalert2.min.css'>";
      echo "<script type='text/javascript'>
          document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                  icon: 'error',
                  title: 'File Sudah Ada',
                  text: 'File dengan nama yang sama sudah ada!',
                  confirmButtonText: 'OK',
                  allowOutsideClick: false
              }).then(() => {
                  window.location = 'd_foto?page=display&na=".base64_encode($no_aset)."';
              });
          });
      </script>";
      } else {
      $terupload = move_uploaded_file($filedata, $newfilename); 
      $hasil = $API->input_foto($no_aset, $indek, $link, $userid, $pil, $keterangan);
      if ($hasil['responseCode'] == 00) {
          echo "<script src='assets/js/sweetalert2.min.js'></script>";
          echo "<link rel='stylesheet' href='assets/css/sweetalert2.min.css'>";
          echo "<script type='text/javascript'>
              document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                      icon: 'success',
                      title: 'Sukses',
                      text: '".$hasil['data']."',
                      confirmButtonText: 'OK',
                      allowOutsideClick: false
                  }).then(() => {
                      window.location = 'd_foto?page=display&na=".base64_encode($no_aset)."';
                  });
              });
          </script>";
      } else {
          echo "<script src='assets/js/sweetalert2.min.js'></script>";
          echo "<link rel='stylesheet' href='assets/css/sweetalert2.min.css'>";
          echo "<script type='text/javascript'>
              document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                      icon: 'error',
                      title: 'Proses Upload Gagal',
                      text: 'Proses upload file gagal. Silahkan coba lagi!',
                      confirmButtonText: 'OK',
                      allowOutsideClick: false
                  }).then(() => {
                      window.location = 'f_foto?page=input&na=".base64_encode($no_aset)."';
                  });
              });
          </script>";
      }
} 

}

?>