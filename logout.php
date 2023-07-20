<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<body></body>
<?php 
//remove sid-login from server storage
echo "<script src='assets/js/sweetalert2.min.js'></script>";
echo "<link rel='stylesheet' href='assets/css/sweetalert2.min.css'>";
echo "<script>
   document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Anda Berhasil Logout !!!',
        icon: 'success',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        },
        willClose: () => {
          window.location.href = './';
        }
      });
    });
</script>";
?>