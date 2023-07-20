<?php
$timeout = 1; // setting timeout dalam menit
$logout = "./"; // redirect halaman logout

$timeout = $timeout * 3000; // menit ke detik
if (isset($_SESSION['start_session'])) {
    $elapsed_time = time() - $_SESSION['start_session'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
		echo "<script src='assets/js/sweetalert2.min.js'></script>";
		echo "<link rel='stylesheet' href='assets/css/sweetalert2.min.css'>";
        echo "<script type='text/javascript'>
			document.addEventListener('DOMContentLoaded', function() {
				Swal.fire({
					title: 'Sesi telah berakhir',
					icon: 'warning',
					timer: 3000,
					showConfirmButton: false
				}).then(function() {
					window.location = './';
				});
			});
		</script>";
    }
}

$_SESSION['start_session'] = time();
?>