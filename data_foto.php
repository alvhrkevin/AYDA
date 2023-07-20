<?php
	error_reporting(0);
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
    $noaset = base64_decode($_GET['na']);
    $cekfoto = $API -> cekfoto($noaset);

    
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
    <?php $page = 'ekspeminjam' ; include "include/sidebar_form.php"; ?>

    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="ekspeminjam"><i class="material-icons">widgets</i> Data Eks Peminjam</a></li>
                <li><a href="as_peminjam"><i class="material-icons">library_books</i> Data Aset</a></li>
                <li><a><i class="material-icons">insert_photo</i>Data Foto</a></li>
            </ol>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><center>DAFTAR DATA FOTO</center></h2>
                            <div class="row clearfix">
                                    <div class="col-sm-3">
                                    <button class="btn btn-warning waves-effect" id="button" value="back" onclick="history.back()" ><b>KEMBALI</b></button> 
                                </div>
                            </div> 
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                            <?php echo '<a type="button" class="btn btn-block btn-lg btn-success waves-effect" href="f_foto?page=input&na='.base64_encode($noaset).'" style="width: 100%;"><b>TAMBAH FOTO</b></a>' ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                            $pars=json_decode($cekfoto,true);
                                            if(isset($pars['data'])){
                                            
                                            $z=1;
                                            foreach ($pars['data'] as $key => $value){
                                            // die(json_encode($pars['data']));
                                            if ( $z==1|| ($z-1)%2==0){
                                                echo "<tr>";
                                            }      
                                                $NO_ASET=$value['NO_ASET'];
                                                $KETERANGAN=$value['KETERANGAN'];
                                                $LINK=$value['LINK'];
                                                $INDEK=$value['INDEK'];

                                                  
                                                echo '<td >
                                                <div class="card"><img src='.$LINK.' width="450px" height="200px"/><br><div class="card body"" <p text-align="left">'.$NO_ASET.'</p><p text-align="left">'.$KETERANGAN.'</p>
                                                <form method="post" action="delete">
                                                <input type="hidden" class="form-control" name="no_aset" value="'.$NO_ASET.'" >
                                                <input type="hidden" class="form-control" name="link" value="'.$LINK.'" >
                                                <input type="hidden" class="form-control" name="keterangan" value="'.$KETERANGAN.'" >
                                                <input type="hidden" class="form-control" name="indek" value="'.$INDEK.'" >

                                                <button type="submit" name="delete" class="btn btn-block btn-lg btn-danger waves-effect" style="margin-left:170px" style="width: 30%;" onclick="return deleletconfig()"><b>HAPUS</b></button></form></div></td>';
                                                
                                                    if ( $z%2==0){
                                                    echo "</tr>";
                                                }
                                                $z++;
                                                } 
                                                
                                                if ( ($z+1)%3==0){
                                                    echo '<td></td>';
                                                    echo '<td></td>';
                                                    echo "</tr>";
                                                }
                                                else if ( $z%3==0){
                                                    echo '<td></td>';
                                                    echo "</tr>";
                                                }
                                                        
                                            } 
                                            else
                                                echo '<tr><td colspan = 9><h5>BELUM ADA FOTO ASSET</h5></td>';
                                                echo "</tr>";
                                        ?>
                                            <!-- <?php if (file_exists($filepath)) {
                                                        echo "photo has found"; // Check if the photo exists
                                                    if (unlink($filepath)) { // Try to delete the photo
                                                      echo "Photo deleted successfully";
                                                    } else {
                                                      echo "Failed to delete photo";
                                                    }
                                                  } else {
                                                    echo "Photo not found";
                                                  }
                                                  ?> -->
                                            </div>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                        
    </section>
</body>
</html>

<script>
function deleletconfig(){
    var del=confirm("Apakah anda yakin akan menghapus file ini?");
        if (del==true){
        }
    return del;
}
</script>