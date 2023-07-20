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
  $hasil = $API -> cek_user('');
  include "include/function_rupiah.php";

   include "timeout.php";
   include "include/header.php";
?>

<body class="theme-green" onload="myFunction()" style="margin:0;">  
    <!-- Top Bar -->
    <?php include "include/navbar.php"; ?>
    <!-- #Top Bar -->
   <?php $page = 'user'; include "include/sidebar_otorisasi.php"; ?>

    <section class="content">
        <div class="container-fluid" >
            <ol class="breadcrumb breadcrumb-bg-blue">
              <li><a><i class="material-icons">admin_panel_settings</i>Otorisasi User</a></li>
            </ol>
            <div id="loader" class="ring" style="display: flex;justify-content: center;align-items: center;height: 100vh;">
              <span></span>
            </div>
          <div style="display:none;" id="myDiv" class="animate-bottom">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <center><h1><b>OTORISASI USER</b></h1>
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
                                          <table class="table table-bordered table-striped table-hover js-basic-example DataTable">
                                            <thead>
                                              <tr>
                                                <th>No</th>
                                                <th>User ID</th>
                                                <th>Nama </th>
                                                <th>Kantor</th>
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
                                                    if ($value['STATUS'] == 1)  {
                                                          $status = "PROTECT";
                                                        } else {
                                                          $status = "UNPROTECT";
                                                        }
                                                        // $wil_api = $API->cekwil($value['WIL']);
                                                        // $wil_ket = json_decode($wil_api,true);
                                                        // $wil   = $wil_ket['data'][0]['wil_ket'];
                                                          echo "<tr>";
                                                          echo '<td>'.$no. '</td>';
                                                          echo '<td>'.$value['USERID'].'</td>';
                                                          echo '<td>'.$value['NAMA'].'</td>';
                                                          echo '<td>'.$value['WIL_KET'].'</td>';
                                                          echo '<td>'.$status.'</td>';

                                                          if ($value['STATUS'] == 1) {    
                                                            echo '<td>
                                                                  <a type="button" class="btn btn-primary waves-effect" style="width : 100%;" name="tombol" data-toggle="modal" data-target="#exampleModal" onclick=inserts("'.$value["USERID"].'")> <p text-align="left"></p></button><i class="material-icons">security</i></a>
                                                                  </td>';
                                                              }else{
                                                              echo '<td>
                                                                    <a type="button" class="btn btn-warning waves-effect" style="width : 100%;" name="tombol" data-toggle="modal" data-target="#exampleModal" onclick=inserts("'.$value["USERID"].'")> <p text-align="left"></p></button><i class="material-icons">security</i></a>
                                                                    </td>';
                                                              }
                                                              echo '</tr>';
                                                              $no++;
                                                          }
                                                        }else{
                                                          echo '<tr><td colspan = 9><h5>BELUM ADA USER</h5></td>';
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
    $userid = $_POST['userid'];
    $password = '0';
    $nama = '0';
    $wil = '0';
    $status = '1';
    $menu1 = '0';
    $menu2 = '0';
    $menu3 = '0';
    $ovdid = $_SESSION["userId"];
    $hasil = $API->edit_user($userid, $password, $nama, $wil, $status, $menu1, $menu2, $menu3, $ovdid);

    if ($hasil['responseCode'] == 00) {
        echo "<script src='assets/js/sweetalert2.min.js'></script>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses, " . $hasil['data'] . ", Protect!',
                        showConfirmButton: false,
                        timer: 5000
                    }).then(() => {
                        window.location='./otorisasi_user';
                    });
                });
            </script>";
    } else {
        echo "<script src='assets/js/sweetalert2.min.js'></script>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: '" . $hasil['responseMessage'] . "',
                        showConfirmButton: false,
                        timer: 5000
                    }).then(() => {
                        window.location='./otorisasi_user';
                    });
                });
            </script>";
    }
}
?> 

<?php 
  if (isset($_POST['submit2'])) {
    $userid = $_POST['userid'];
    $password = '0';
    $nama = '0';
    $wil = '0';
    $status = '0';
    $menu1 = '0';
    $menu2 = '0';
    $menu3 = '0';
    $ovdid = $_SESSION["userId"];  
    $hasil = $API -> edit_user($userid, $password, $nama, $wil, $status, $menu1, $menu2, $menu3, $ovdid);
      
    if ($hasil['responseCode'] == 00) {
        echo "<script src='assets/js/sweetalert2.min.js'></script>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses, " . $hasil['data'] . ", Unprotect!',
                        showConfirmButton: false,
                        timer: 5000
                    }).then(() => {
                        window.location='./otorisasi_user';
                    });
                });
            </script>";
    } else {
        echo "<script src='assets/js/sweetalert2.min.js'></script>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: '" . $hasil['responseMessage'] . "',
                        showConfirmButton: false,
                        timer: 5000
                    }).then(() => {
                        window.location='./otorisasi_user';
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
        <form action="" id="aset" method="POST">
          <div class="modal-body">
            <div class="row clearfix">
              <div class="col-sm-12">
                <label class="form-label">USER ID</label>
                  <div class="form-line">
                    <input type="text" class="form-control" name="userid" id="inputanModal"   readonly>
                      <br>
                  </div>
              </div>
            </div>

          <div class="row clearfix">
            <button type="submit" class="btn-block btn-primary waves-effect" id="edit" name="submit">PROTECT</button>
              <br><br>
            <button type="submit" class="btn-block btn-warning waves-effect" id="edit" name="submit2">UNPROTECT</button>
          </div>          
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>
</html>

<script>

  function inserts(iki){
  var isi=iki;
  console.log(iki);
  $("#inputanModal").html(iki);
  $("#inputanModal").val(iki);
}

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

