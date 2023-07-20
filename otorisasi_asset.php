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
  $hasil_aset = $API -> data_aset('');
  include "include/function_rupiah.php";

    include "timeout.php"; 
    include "include/header.php";
?>

<body class="theme-green" onload="myFunction()" style="margin:0;"> 
    <!-- Top Bar -->
    <?php include "include/navbar.php"; ?>
    <!-- #Top Bar -->
    <?php $page = 'asset'; include "include/sidebar_otorisasi.php"; ?>
    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a><i class="material-icons">security</i> Otorisasi AYDA</a></li>
            </ol>
            <div id="loader" class="ring" style="display: flex;justify-content: center;align-items: center;height: 100vh;">
            <span></span>
            </div>
      <div style="display:none;" id="myDiv" class="animate-bottom">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <center><h1><b>OTORISASI AYDA</b></h1>
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
                                                    <th>Nomor Asset </th>
                                                    <th>Nama Asset </th>
                                                    <th>Jenis Asset</th>
                                                    <th>Jenis property</th>
                                                    <th>Lokasi</th>
                                                    <th>Nilai Jual</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $pars = json_decode($hasil_aset, true);
                                                if (isset($pars['data'])) {
                                                  $no = 1;
                                                  foreach ($pars['data'] as $key => $value) {
                                                    echo "<tr>";
                                                    echo '<td>'.$no.'</td>';
                                                    $no_aset = $value['NO_ASET'];
                                                    echo '<td>'.$no_aset.'</td>';
                                                    $nm_aset = $value['NM_ASET'];
                                                    echo '<td>'.$nm_aset.'</td>';
                                                    $jns_aset = $value['KET_ASET'];
                                                    echo '<td>'.$jns_aset.'</td>';
                                                    $jns_pro = $value['KET_PRO'];
                                                    echo '<td>'.$jns_pro.'</td>';
                                                    $alamat_aset = $value['ALAMAT_ASET'];
                                                    echo '<td>'.$alamat_aset.'</td>';
                                                    $nilai_jual = $value['NILAI_JUAL'];
                                                    echo '<td>'.rupiah($nilai_jual).'</td>';
                                                    $status = $value['STATUS'];
                                                    
                                                    if ($status == 0) {
                                                      $status = "INPUT";
                                                      $buttonClass = "btn-warning";
                                                    } elseif ($status == 1) {
                                                      $status = "PUSAT";
                                                      $buttonClass = "btn-primary";
                                                    } elseif ($status == 2) {
                                                      $status = "CABANG";
                                                      $buttonClass = "btn-success";
                                                    } elseif ($status == 3) {
                                                      $status = "PUBLISH";
                                                      $buttonClass = "btn-info";
                                                    } elseif ($status == 4) {
                                                      $status = "TERJUAL";
                                                      $buttonClass = "btn-danger";
                                                    } elseif ($status == 5) {
                                                      $status = "SEWA";
                                                      $buttonClass = "btn-secondary";
                                                    }
                                                    
                                                    echo '<td>'.$status.'</td>';
                                                    
                                                    echo '<td>
                                                            <a type="button" class="btn '.$buttonClass.' waves-effect" style="width: 100%;" name="tombol" data-toggle="modal" data-target="#exampleModal" onclick="inserts('.$no_aset.')">
                                                              <p text-align="left"></p>
                                                              <i class="material-icons">security</i>
                                                            </a>
                                                          </td>';
														 
                                                    
                                                    echo '</tr>';
                                                    $no++;
                                                  }
                                                } else {
                                                  echo '<tr><td colspan="9"><h5>BELUM ADA DATA AYDA</h5></td></tr>';
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

   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">    
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelId">NO ASSET</h5>
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                    </div>

                    <div class="modal-body">
                        <div class="row clearfix">
                                <button class="btn-block btn-warning waves-effect" id="oto">FORM OTORISASI</button>
                        </div>                  
          
                </div>
            </div>
        </div>
    </div>
</body>
</html>



<script type="text/javascript">
        $("#oto").click(function () {
            var noaset = $("#exampleModalLabel").val();
            window.location="f_oto_asset?page=oto&na="+btoa(noaset);
        });
</script>

<script>
	    function inserts(iki){
			var isi=iki;
			console.log(iki);
			$("#exampleModalLabel").html(iki);
			$("#exampleModalLabel").val(iki);
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

