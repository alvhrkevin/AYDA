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
  include "timeout.php";
  include "include/header.php";
?>

<body class="theme-green" onload="myFunction()" style="margin:0;">  
    <!-- Top Bar -->
    <?php include "include/navbar.php"; ?>
    <!-- #Top Bar -->
   <?php $page = 'oto_internal'; include "include/sidebar_otorisasi.php"; ?>

    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
              <li><a><i class="material-icons">security</i> Otorisasi Ekspeminjam</a></li>
            </ol>
            <div id="loader" class="ring" style="display: flex;justify-content: center;align-items: center;height: 100vh;">
              <span></span>
            </div>
          <div style="display:none;" id="myDiv" class="animate-bottom">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <center><h1><b>OTORISASI EKSPEMINJAM</b></h1>
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
                                                <th>Nomor Produk </th>
                                                <th>Nama</th>
                                                <th>Jenis Pinjaman</th>
                                                <th>Kantor Cabang</th>
                                                <th>Plafond</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                              </tr>
                                            </thead>

                                            <tbody>
                                                <?php 
                                                $pars=json_decode($hasil,true);
                        
                                                if(isset($pars['data'])){
                                                  $no   = 1;
                                                  foreach ($pars['data'] as $key => $value) {
                                                    
                                                  echo "<tr>";
                                                    echo '<td>'.$no. '</td>';
                                                    $no_prod=$value['NO_PROD'];
                                                    echo '<td>'.$no_prod. '</td>';
                                                    $nama=$value['NAMA'];
                                                    echo '<td>'.$nama. '</td>';
                                                    $jns_pin=$value['JNS_PIN'];
                                                    echo '<td>'.$jns_pin. '</td>';
                                                    $wil_ket=$value['WIL_KET'];
                                                    echo '<td>'.$wil_ket. '</td>';
                                                    $plafond=$value['PLAFOND'];
                                                    echo '<td>'.rupiah($plafond). '</td>';
                                                    $status=$value['STATUS'];
                                                    if ($value['STATUS'] == 0){
                                                    $status = "UNPROTECT";
                                                    }
                                                    if ($value['STATUS'] == 1){
                                                    $status = "PROTECT";
                                                    }
                                                    if ($value['STATUS'] == 2){
                                                    $status = "PUBLISH CABANG PROTECT";
                                                    }
                                                    if ($value['STATUS'] == 3){
                                                    $status = "PUBLISH UMUM PROTECT";
                                                    }
                                                    if ($value['STATUS'] == 4){
                                                    $status = "ASSET TERJUAL PROTECT";
                                                    }
                                                    if ($value['STATUS'] == 5){
                                                    $status = "ASSET DISEWAKAN PROTECT";
                                                    }
                                                    echo '<td>'.$status. '</td>';
                                                    if ($value['STATUS']==0) {
                                                      echo '<td>
                                                          <a type="button" class="btn btn-warning waves-effect" style="width : 100%;" name="tombol" data-toggle="modal"data-target="#exampleModal" onclick="insert('.$no_prod.')"> <p text-align="left"></p></button><i class="material-icons">security</i></a>
                                                          </td>';
                                                    }
                                                    if ($value['STATUS']==1) {
                                                      echo '<td>
                                                          <a type="button" class="btn btn-primary waves-effect" style="width : 100%;" name="tombol" data-toggle="modal"data-target="#exampleModal" onclick="insert('.$no_prod.')"> <p text-align="left"></p></button><i class="material-icons">security</i></a>
                                                          </td>';
                                                    }
                                                    if ($value['STATUS']==2) {
                                                      echo '<td>
                                                          <a type="button" class="btn btn-success waves-effect" style="width : 100%;" name="tombol" data-toggle="modal"data-target="#exampleModal" onclick="insert('.$no_prod.')"> <p text-align="left"></p></button><i class="material-icons">security</i></a>
                                                          </td>';
                                                    }
                                                    if ($value['STATUS']==3) {
                                                      echo '<td>
                                                          <a type="button" class="btn btn-info waves-effect" style="width : 100%;" name="tombol" data-toggle="modal"data-target="#exampleModal" onclick="insert('.$no_prod.')"> <p text-align="left"></p></button><i class="material-icons">security</i></a>
                                                          </td>';
                                                    }
                                                    if ($value['STATUS']==4) {
                                                      echo '<td>
                                                          <a type="button" class="btn btn-Danger waves-effect" style="width : 100%;" name="tombol" data-toggle="modal"data-target="#exampleModal" onclick="insert('.$no_prod.')"> <p text-align="left"></p></button><i class="material-icons">security</i></a>
                                                          </td>';
                                                    }
                                                    if ($value['STATUS']==5) {
                                                      echo '<td>
                                                          <a type="button" class="btn btn-secondary waves-effect" style="width : 100%;" name="tombol" data-toggle="modal"data-target="#exampleModal" onclick="insert('.$no_prod.')"> <p text-align="left"></p></button><i class="material-icons">security</i></a>
                                                          </td>';
                                                    }
                                                    echo '</tr>';
                                                    $no++;
                                                  } 
                                                }
                                                else{
                                                  echo '<tr><td colspan = 9><h5>BELUM ADA DATA NASABAH</h5></td>';
                                                  echo "</tr>";
                                                }                                                  
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
    $no_prod = $_POST['no_prod'];
    $status = '1';
    $ovdoto = $_SESSION["userId"];
    $oto = $API->otorisasi($no_prod, $status, $ovdoto);

    if ($oto['responseCode'] == 00) {
        echo "<script src='assets/js/sweetalert2.min.js'></script>";
        echo "<script>
                 document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses, " . $oto['data'] . ", Protect!',
                        showConfirmButton: false,
                        timer: 5000
                    }).then(() => {
                        window.location='./otorisasi_internal';
                    });
                });
            </script>";
    } else {
        echo "<script src='assets/js/sweetalert2.min.js'></script>";
       echo "<script>
                 document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Sukses, " . $oto['data'] . ", Protect!',
                        showConfirmButton: false,
                        timer: 5000
                    }).then(() => {
                        window.location='./otorisasi_internal';
                    });
                });
            </script>";
    }
}

    if (isset($_POST['submit2'])) {
      $no_prod = $_POST ['no_prod'];
      $status = '0';
      $ovdoto = $_SESSION["userId"];
      $oto = $API -> otorisasi($no_prod,$status,$ovdoto); 
      
      if ($oto['responseCode'] == 00) {
        echo "<script src='assets/js/sweetalert2.min.js'></script>";
        echo "<script>
                 document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses, " . $oto['data'] . ", Unprotect!',
                        showConfirmButton: false,
                        timer: 5000
                    }).then(() => {
                        window.location='./otorisasi_internal';
                    });
                });
            </script>";
    } else {
        echo "<script src='assets/js/sweetalert2.min.js'></script>";
       echo "<script>
                 document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Sukses, " . $oto['data'] . ", Unprotect!',
                        showConfirmButton: false,
                        timer: 5000
                    }).then(() => {
                        window.location='./otorisasi_internal';
                    });
                });
            </script>";
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
                                        <label class="form-label">Nomor Produk</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="no_prod" id="inputanModal"   readonly>
                                            <br>
                                      </div>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn-block btn-primary waves-effect" id="edit" name="submit">PROTECT</button>
                                <br><br>
                                <button type="submit" class="btn-block btn-warning waves-effect" id="edit" name="submit2">UNPROTECT</button>
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
    console.log(isi);
    $("#inputanModal").html(isi);
    $("#inputanModal").val(isi);
    }
</script>

<script>
var id = document.getElementById("loader");
var Loading = document.createElement("div");

Loading.textContent = "Loading"
Loading.style.fontSize = "28px"
id.appendChild(Loading)



function myFunction() {
var loaded = setInterval(() => {
  Loading.textContent = Loading.textContent + "."
}, 1000)

  loaded= setTimeout(showPage, 4000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>

