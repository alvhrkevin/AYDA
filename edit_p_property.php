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
  $jns_aset = $_GET['jnsaset'];
  $indek2= $_GET['indek'];
  $pro = $API ->cekproperty($jns_aset,$indek2);
  $pars=json_decode($pro,true);

  if (isset($_POST['submit'])) {
      $jnsaset    = $_POST['jns_aset'];
      $ket        = $_POST['keterangan'];
      $indek      = $_POST['indek'];
      $hasil      = $API->editparameterproperty($jnsaset,$ket,$indek);
      
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
                        text: '" . $hasil['data'] . "',
                        showConfirmButton: false,
                        timer: 5000
                    }).then(() => {
                        window.location='edit_p_property?jnsaset=" . $jns_aset . "&indek=" . $indek2 . "';
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
                <?php echo '<li><a href="./edit_p_property?jnsaset='.$pars['data'][0]['JNS_ASET'].'&indek='.$pars['data'][0]['INDEK'].'"><i class="material-icons">add_task</i>Edit Parameter Property</a></li>' ?>   
            </ol>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                      <div class="header">
                            <center><h1><b>FORM EDIT PARAMETER JENIS PROPERTY</b></h1>
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
                                    <input type="hidden" class="form-control" name="indek" required value="<?php echo $pars['data'][0]['INDEK']; ?>" readonly >
                                </div>
                            </div>
                        </div>

                         <div class="row clearfix">
                                 <div class="col-sm-6">
                                <label class="form-label">Nomor Asset</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="jns_aset" required value="<?php echo $pars['data'][0]['JNS_ASET']; ?>" readonly >
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                                 <div class="col-sm-6">
                                <label class="form-label">Jenis Property</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="keterangan" required value="<?php echo $pars['data'][0]['KETERANGAN']; ?>" >
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

