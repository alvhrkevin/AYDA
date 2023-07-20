<?php
	echo "<script src='assets/js/sweetalert2.min.js'></script>";
	echo "<link rel='stylesheet' href='assets/css/sweetalert2.min.css'>";
	echo "<script>";
	echo "document.addEventListener('DOMContentLoaded', function() {";
	echo "  Swal.fire({";
	echo "    title: 'BELUM ADA TITIK LOKASI',";
	echo "    icon: 'warning',";
	echo "  }).then(() => {";
	echo "    window.location = 'display';";
	echo "  });";
	echo "});";
	echo "</script>";
?>