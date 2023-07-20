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
  $hasil = $API -> data_eksnasabah();
  include "include/function_rupiah.php";

    include "timeout.php" 
    include "include/header.php";
?>

<style >
    .btn{
        margin-right: 10px; width: 20%; color: #483838; 
    }
</style>
<body class="theme-green">
    <!-- Top Bar -->
    <?php include "include/navbar.php"; ?>
    <!-- #Top Bar -->
    <?php $page = 'oto_eksternal'; include "include/sidebar_otorisasi.php"; ?>

    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="javascript:void(0);"><i class="material-icons">security</i> Otorisasi AYDA Internal</a></li>
            </ol>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <center><h1><b>OTORISASI</b></h1>
                            <b><p>Pastikan data yang akan di protect sudah di koreksi untuk menghindari kesalahan</p></b></center>
                        </div>
                        <div class="body">
                <div class="row clearfix">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">
                            <div class="card">
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No Prod </th>
                                                    <th>Nama</th>
                                                    <th>Jns Pin</th>
                                                    <th>Kntr Cab</th>
                                                    <th>Plafond</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $pars=json_decode($hasil,true);
                        
                                                if(isset($pars['data'])){
                                                
                                                  $size=count($pars['data']);
                                                  //echo "<tr>";
                                                  $no   = 1;
                                                  for($x=0;$x<$size;$x++){
                                                    
                                                  echo "<tr>";
                                    
                                                    echo '<td>'.$no. '</td>';
                                                    $no_prod=$pars['data'][$x]['NO_PROD'];
                                                    echo '<td>'.$no_prod. '</td>';
                                                    $nama=$pars['data'][$x]['NAMA'];
                                                    echo '<td>'.$nama. '</td>';
                                                    $jns_pin=$pars['data'][$x]['JNS_PIN'];
                                                    echo '<td>'.$jns_pin. '</td>';
                                                    $wil_ket=$pars['data'][$x]['WIL_KET'];
                                                    echo '<td>'.$wil_ket. '</td>';
                                                    $plafond=$pars['data'][$x]['PLAFOND'];
                                                    echo '<td>'.rupiah($plafond). '</td>';
                                                    $tgl_jth=$pars['data'][$x]['TGL_JTH'];
                                                    echo '<td>'.$tgl_jth. '</td>';
                                                    $status=$pars['data'][$x]['STATUS'];
                                                    echo '<td>'.$status. '</td>';
                                                    echo '<td>
                                                        <a type="button" class="btn btn-primary waves-effect" style="width : 100%;" name="tombol" data-toggle="modal"
                                                            data-target="#exampleModal" onclick="insert('.$no_prod.')"> <p text-align="left"></p></button><i class="material-icons">description</i></a>
                                                          </td>';
                                                    echo '</tr>';
                                                    $no++;
                                                    
                                                  } 
                                                }
                                                else 
                                                  echo '<tr><td colspan = 9><h5>BELUM ADA DATA NASABAH</h5></td>';
                                                  echo "</tr>";
                                                  
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>                        
    </section>

   <?php 
   if (isset($_POST['submit'])) {
      $no_prod  = $_POST ['no_prod'];
      $ovdoto   = $_SESSION["userId"];
      $status   = '1';
      $oto      = $API -> otorisasi($no_prod,$status,$ovdoto); 
      
      if($oto['responseCode'] == 00){
          echo  "<script type = 'text/javascript'>alert('".$oto['responseMessage'].", ".$oto['data']."');window.location='./otorisasi_internal'</script>";
       }else {
            echo  "<script type = 'text/javascript'>alert('".$oto['responseMessage']."');window.location='./otorisasi_internal'</script>";
      }
    }
?>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">    
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix">
                             <form action="" method="POST" >
                                <div class="row clearfix">
                                          <div class="col-sm-12">
                                              <label class="form-label">No Prod</label>
                                                  <div class="form-line">
                                              
                                                      <input type="text" class="form-control" name="no_prod" id="inputanModal"   readonly>
                                                      <br><br>

                                                  </div>
                                          </div>
                                      </div>
                                <button type="submit" class="btn-block btn-warning waves-effect" name="submit" >Otorisasi</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    function insert(iki){
        var isi=iki;
        //window.alert("You click insert button"+isi);
        $("#inputanModal").html(isi);
        $("#inputanModal").val(isi);
    }
</script>

