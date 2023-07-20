<?php
echo "<script src='assets/js/sweetalert2.min.js'></script>";
echo "<link rel='stylesheet' href='assets/css/sweetalert2.min.css'>";
echo  "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'info',
                        title: 'Halaman ini',
                        text: 'masih maintenance !!'.toUpperCase()
                    }).then(() => {
                        window.location = 'beranda';
                    });
                });
            </script>";
?>
