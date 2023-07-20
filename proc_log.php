<?php
    session_start();
    if (isset($_SESSION["userId"])) {
        header("Location: ./");
        exit;
    } 

    include ('include/API_functions.php');
    $API = new API_functions(); 
?>
<!DOCTYPE html>
<body></body>
<?php
    if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        echo "<script src='assets/js/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='assets/css/sweetalert2.min.css'>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'USERNAME ATAU PASSWORD KOSONG !!'
                }).then(() => {
                    window.location = './';
                });
            });
        </script>";
        exit();
    }
    
    $password = md5($password);
    
    $login = $API->login($username, $password);
    
    if ($login['responseCode'] == "00") {
        if ($login['status'] == 0) {
            echo "<script src='assets/js/sweetalert2.min.js'></script>";
            echo "<link rel='stylesheet' href='assets/css/sweetalert2.min.css'>";
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'USER BELUM DI OTORISASI !'
                }).then(() => {
                    window.location = './';
                });
            });
        </script>";
        exit();
        } else if ($login['status'] == 1) {
            
            $_SESSION['userId'] = $login['userId'];
            $_SESSION['wil'] = $login['wil'];
            $_SESSION['nama'] = $login['nama'];
            $_SESSION['status'] = $login['status'];
            $_SESSION['menu1'] = $login['menu1'];
            $_SESSION['menu2'] = $login['menu2'];
            $_SESSION['menu3'] = $login['menu3'];
            
            $welcomeMessage = '';
            
            if ($_SESSION['menu2'] == 1) {
                $welcomeMessage = "Selamat Datang Bapak/Ibu  ".$_SESSION['nama'];
            } else if ($_SESSION['menu1'] == 1) {
                $welcomeMessage = "Selamat Datang Admin  ".$_SESSION['nama'];
            }else{
                $welcomeMessage = "Selamat Datang Kantor  ".$_SESSION['nama'];
            }

            echo "<script src='assets/js/sweetalert2.min.js'></script>";
            echo "<link rel='stylesheet' href='assets/css/sweetalert2.min.css'>";
            echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login berhasil',
                        text: '".$welcomeMessage."'.toUpperCase()
                    }).then(() => {
                        window.location = 'loading';
                    });
                });
            </script>";
            exit();
        }
    } else {
        echo "<script src='assets/js/sweetalert2.min.js'></script>";
            echo "<link rel='stylesheet' href='assets/css/sweetalert2.min.css'>";
            echo "<script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'USERNAME ATAU PASSWORD SALAH !'
                }).then(() => {
                    window.location = './';
                });
            });
        </script>";
    }
}
?>