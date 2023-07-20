<?php
session_start();
    if( !isset($_SESSION["userId"])){
         header("Location: ./");
       exit;
       }
       
?><!DOCTYPE html>
<html>
<?php
    include ('include/API_functions.php');
    $API = new API_functions();
    $jnsaset = $_GET['pa'];
    $pa = $API ->cekjenisaset($jnsaset);
    $pars=json_decode($pa,true);

    if (isset($_POST['submit'])) {
        $kd_aset    = $_POST['kd_aset'];
        $ket_aset   = $_POST['ket_aset'];
        $jnsaset    = $_POST['ket_jnsaset'];
        $indek      = $_POST['indek'];
        $hasil      = $API->editparameteraset($kd_aset,$ket_aset,$jnsaset,$indek);
        
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
                            window.location='p_asset';
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
                            text: '" . $hasil['data'] . "',
                            showConfirmButton: false,
                            timer: 5000
                        }).then(() => {
                            window.location='edit_p_asset?page=parameter&pa=" . $jnsaset . "';
                        });
                    });
                </script>";
        }
    }

    include "timeout.php";
    include "include/header.php";
?>

<style >
   .btn{
        margin-right: 10px; width: 20%; color: #483838; 
    }
     #button{
        margin-right: 10px; width: 80%; color: #483838;
    }
</style>
<body class="theme-green">
    <!-- Top Bar -->
    <?php include "include/navbar.php"; ?>
    <!-- #Top Bar -->
    <?php $page = 'parameter'; include "include/sidebar_admin.php"; ?>

    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="parameter"><i class="material-icons">list</i>Parameter</a></li>
                <li><a href="p_asset"><i class="material-icons">widgets</i> Parameter Jenis Aset</a></li>
            <?php echo  '<li><a href="./edit_asset?page=parameter&pa='.$pars['data'][0]['jns_pro'].'"><i class="material-icons">add_task</i>Edit Parameter Jenis Asset</a></li>' ?>  
            </ol>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <center><h1><b>EDIT PARAMETER JENIS ASSET</b></h1>
                            <b><p>Pastikan data yang diinput sudah benar , periksa kembali sebelum data di simpan ke server</p></b></center>
                            <div class="row clearfix">
                                    <div class="col-sm-3">
                                    <button class="btn btn-warning waves-effect" id="button" value="back" onclick="history.back()" ><b>KEMBALI</b></button> 
                                </div>
                            </div> 
                        </div>
                        <div class="body" id="data_property">
                         <form action="" id="aset" method="POST">
                         <input type="hidden" class="form-control" name="aset">
                         <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-line">
                                    <input type="hidden" class="form-control" name="indek" required value="<?php echo $pars['data'][0]['indek']; ?>" readonly >
                                </div>
                            </div>
                        </div>

                         <div class="row clearfix">
                                <div class="col-sm-6">
                                <label class="form-label">Kode Property</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" required value="<?php echo $pars['data'][0]['jns_pro']; ?>" readonly >
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                                <div class="col-sm-6">
                                <label class="form-label">Kode Asset</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="kd_aset" required value="<?php echo $pars['data'][0]['jns_aset']; ?>" readonly >
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                                <div class="col-sm-6">
                                <label class="form-label">Keterangan Asset</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="ket_aset" required value="<?php echo $pars['data'][0]['ket_aset']; ?>" readonly >
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix">
                                <div class="col-sm-6">
                                <label class="form-label">Keterangan Property</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="ket_jnsaset" required value="<?php echo $pars['data'][0]['ket_pro']; ?>" >
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
