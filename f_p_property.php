<?php
session_start();
    if( !isset($_SESSION["userId"])){
         header("Location: ./");
       exit;
       }
       
?>
<!DOCTYPE html>
<html>

<?php
    include ('include/API_functions.php');
    $API = new API_functions();

    if (isset($_POST['submit'])) {
        $jnsaset = $_POST['jns_aset'];
        $ket = $_POST['keterangan'];
        $hasil = $API->inputparameterproperty($jnsaset,$ket);
        
        if ($hasil['responseCode'] == 00) {
            echo "<script src='assets/js/sweetalert2.min.js'></script>";
            echo "<script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses, " . $hasil['data'] . "',
                            showConfirmButton: false,
                            timer: 5000
                        }).then(() => {
                            window.location='p_property';
                        });
                    });
                </script>";
        } else {
            echo "<script src='assets/js/sweetalert2.min.js'></script>";
            echo "<script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: '" . $hasil['responseMessage'] . "',
                            showConfirmButton: false,
                            timer: 5000
                        }).then(() => {
                            window.location='f_p_property';
                        });
                    });
                </script>";
        }
    }
    
       include "timeout.php";
       include "include/header.php";
?>

<body class="theme-green">
    <!-- Top Bar -->
    <?php include "include/navbar.php"; ?>
    <!-- #Top Bar -->
    <?php $page = 'parameter'; include "include/sidebar_admin.php"; ?>

    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="./asset"><i class="material-icons">add_task</i>Parameter Property</a></li>     
            </ol>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <center><h1><b>FORM INPUT PARAMETER JENIS PROPERTY</b></h1>
                            <b><p>Pastikan data yang diinput sudah benar , periksa kembali sebelum data di simpan ke server</p></b></center>  
                            <button class="btn btn-warning waves-effect" id="button" value="back" onclick="history.back()" ><b>KEMBALI</b></button>    
                        </div>
                        <div class="body">
                         <form action="" method="POST">
                         <div class="row clearfix">
                                 <div class="col-sm-6">
                                <label class="form-label">Nomor Asset</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="jns_aset" required >
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix">
                                 <div class="col-sm-6">
                                <label class="form-label">Keterangan Property</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="keterangan" required >
                                </div>
                            </div>
                        </div>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <button class="btn btn-warning waves-effect" name="submit" type="submit"><b>SIMPAN</b></button> 
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
    </section>
</body>
</html>

