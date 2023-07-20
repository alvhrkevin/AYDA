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
        $kd_aset    = $_POST['kd_aset'];
        $ket_aset   = $_POST['ket_aset'];
        $jnsaset    = $_POST['ket_jnsaset'];
        $hasil      = $API->inputparameteraset($kd_aset,$ket_aset,$jnsaset);
        
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
                            showConfirmButton: false,
                            timer: 5000
                        }).then(() => {
                            window.location='f_p_asset';
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
        width: 20%; color: #483838; 
    }
</style>

<body class="theme-green">
    <!-- Top Bar -->
    <?php include "include/navbar.php"; ?>
    <!-- #Top Bar -->
    <?php $page = 'parameter'; include "include/sidebar_form.php"; ?>

    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="parameter"><i class="material-icons">list</i>Parameter</a></li>
                <li><a href="p_asset"><i class="material-icons">widgets</i> Parameter Jenis Aset</a></li>
                <li><a><i class="material-icons">add_task</i>Parameter Jenis Asset</a></li> 
            </ol>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <center><h1><b>FORM INPUT PARAMETER JENIS ASSET</b></h1>
                            <b><p>Pastikan data yang diinput sudah benar , periksa kembali sebelum data di simpan ke server</p></b></center>
                            
                            <button class="btn btn-warning waves-effect" id="button" value="back" onclick="history.back()" ><b>KEMBALI</b></button>  
                        </div>
                        <div class="body" id="data_property">
                             <form action="" id="aset" method="POST">
                             <input type="hidden" class="form-control" name="aset">
                        <div class="row clearfix">
                             <div class="col-sm-6">
                                <label class="form-label">Kepemilikan</label>
                                <select name="kd_aset" class="form-control show-tick selectpicker" required >
                                    <option value="1" >-Kode Asset-</option>      
                                    <option value="101">101</option>
                                    <option value="102">102</option>
                                    <option value="103">103</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row clearfix">
                                <div class="col-sm-6">
                                <label class="form-label">Janis Asset</label>
                                     <select name="ket_aset" id="bukti" class="form-control show-tick selectpicker" required >
                                        <option value="1" >-Pilih Jenis Asset-</option>
                                        <?php
                                        $jns_aset = $API->jaset();
                                        $pars=json_decode($jns_aset,true);
                                        $size=count($pars['data']);
                                                       
                                        for($x=0;$x<$size;$x++){
                                        ?>   
                                            <option value="<?php echo $pars['data'][$x]['KET_ASET'] ?>"><?php echo $pars['data'][$x]['KET_ASET']?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <label class="form-label">Keterangan Property</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="ket_jnsaset" required>
                                </div>
                            </div>
                        </div>
                            <button class="btn btn-warning waves-effect" name="submit" type="submit"><b>SIMPAN</b></button>   
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
    </section>
</body>
</html>
