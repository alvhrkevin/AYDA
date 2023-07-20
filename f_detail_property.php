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
include "include/function_rupiah.php";
include ('include/API_functions.php');
$API = new API_functions();
$no_aset = base64_decode($_GET['na']);
$no_aset2 = explode(".", $no_aset);
$na = $API -> editasset($no_aset);
$pars=json_decode($na,true);
$property = $API->property($no_aset,'');


include "timeout.php";

if (isset($_POST['submit'])) {
    
    $pars=json_decode($property,true);
    $size=count($pars['data']);
    
    for($x=0;$x<$size;$x++){
        $NO_ASET2   = $pars['data'][$x]['NO_ASET'];
        $JNS_PRO2   = $pars['data'][$x]['JNS_PRO'];
        $INDEK_PRO2 = $pars['data'][$x]['INDEK_PRO'];
        $KET_PRO2   = $pars['data'][$x]['KET_PRO'];

        $name2      = "$JNS_PRO2#$INDEK_PRO2";
        // $name = "$NO_ASET#$JNS_PRO#$INDEK_PRO";
        
        $isi      = $_POST [$name2];
        $kirim  = "$NO_ASET2#$name2#$isi";
        $hasil = $API -> input_pro($kirim);
        
    }

    if ($hasil['responseCode'] == '00') {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: '".$hasil['responseMessage']."',
                    text: '".$hasil['data']."'
                }).then(() => {
                    window.location = 'as_peminjam?page=edit&nr=".base64_encode($no_aset2[0])."';
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'DATA PROPERTY GAGAL DI SIMPAN !'
                }).then(() => {
                    window.location = 'det_property?page=input&na=".base64_encode($NO_ASET2)."';
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
</style>
<body class="theme-green">
    <!-- Top Bar -->
    <?php include "include/navbar.php"; ?>
    <!-- #Top Bar -->
    <?php $page = 'ekspeminjam'; include "include/sidebar_form.php"; ?>

     <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="ekspeminjam"><i class="material-icons">widgets</i> Data Eks Peminjam</a></li>
                <li><a href="as_peminjam"><i class="material-icons">library_books</i> Data Aset</a></li>
                <li><a><i class="material-icons">feed</i>Form Detail Property</a></li>
            </ol>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <center><h1><b>FORM DETAIL PROPERTY </b></h1>
                            <b><p>Pastikan data yang diinput sudah benar , periksa kembali sebelum data di simpan ke server</p></b></center>
                            <div class="row clearfix">
                                    <div class="col-sm-3">
                                    <button class="btn btn-warning waves-effect" id="button" value="back" onclick="history.back()" ><b>KEMBALI</b></button> 
                                </div>
                            </div> 
                        </div>
                         <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                
                        <div class="body">
                            <form action="" id="form_validation" method="POST">
                            <input type="hidden" class="form-control" name="xpil">
                                <div class="row clearfix">
                                 <div class="col-sm-6">
                                    <label class="form-label">No Asset</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="no_aset" readonly value="<?php echo $pars['data'][0]['NO_ASET']; ?>">
                                    </div>
                                </div>
                                <div class="crow clearfix">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <?php 
                                            $no     = 1;

                                            $pars=json_decode($property,true);
                                            if(isset($pars['data'])){
                                            $size=count($pars['data']);
                                            
                                            for($x=0;$x<$size;$x++){
                                                
                                                $NO_ASET    = $pars['data'][$x]['NO_ASET'];
                                                $JNS_PRO    = $pars['data'][$x]['JNS_PRO'];
                                                $INDEK_PRO  = $pars['data'][$x]['INDEK_PRO'];
                                                $KET_PRO    = $pars['data'][$x]['KET_PRO'];
                                                $NILAI      = $pars['data'][$x]['NILAI'];

                                                $name = "$JNS_PRO#$INDEK_PRO";
                                                echo "<tr>";

                                                echo '<td><label class="form-label" id="' . $x . '" name="' . $x . '">' . $KET_PRO . '</label></td>';
                                                
                                                 if ($KET_PRO === "HARGA PENAWARAN") {
                                                    $nilaiWithSeparator = number_format((float) $NILAI, 0, ',', '.');
                                                    echo '<td><input type="text" class="form-control nmbr" id="pro' . $name . '" name="' . $name . '" value="' . $nilaiWithSeparator . '"></td>';
                                                } else {
                                                    echo '<td><input type="text" class="form-control nmbr" id="pro' . $name . '" name="' . $name . '" value="' . $NILAI . '"></td>';
                                                }
                                                echo '</tr>';
                                                $no++;
                                            }
                                        }  ?>
                                    </table>
                                </div>
                                   
                             </div>
                                
                               <br>
                                
                                <button class="btn btn-warning waves-effect" name="submit" type="submit"><b>SIMPAN</b></button>
                            </form>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
    </section>
</body>
</html>

<script src="assets/js/sweetalert2.min.js" ></script>


    
    

