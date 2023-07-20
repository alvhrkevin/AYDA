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

<body class="theme-green" onload="myFunction()" style="margin:0;" >
	<?php $page = 'aset'; include "include/sidebar.php"; ?>
    <section class="content">
    <div class="container-fluid">
				<ol class="breadcrumb breadcrumb-bg-blue">
					<li><a href=""><i class="material-icons">widgets</i>Data Asset</a></li>
        </ol>
        <div id="loader" class="ring" style="display: flex;justify-content: center;align-items: center;height: 100vh;">
     <span></span>
    </div>
     <div style="display:none;" id="myDiv" class="animate-bottom">
			<div class="body">
				<div class="row clearfix">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">
							<div class="card">
								<div class="header">
									<h2><center>DATA ASSET</center></h2>
								</div>
								<div class="body">
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead>
												<tr>
												<?php
													echo "<th>No</th>";
													echo "<th>Nomor Asset </th>";
													echo "<th>Nama Asset </th>";
													echo "<th>Jenis Asset</th>";
													echo "<th>Jenis Property</th>";
													echo "<th>Lokasi Asset</th>";
													echo "<th>Nilai Jual</th>";
													echo "<th>Status</th>";
												?>
												</tr>
											</thead>
											<tbody>
												
											<?php 
												$pars=json_decode($hasil_aset,true);
												if(isset($pars['data'])){
												// $size=count($pars['data']);
												$no 	= 1;
												foreach ($pars['data'] as $key => $value) {
                                                echo "<tr>";                 
                                                echo '<td>'.$no. '</td>';
                                                $no_aset=$value['NO_ASET'];
                                                echo '<td>'.$no_aset. '</td>';
                                                $nm_aset=$value['NM_ASET'];
                                                echo '<td>'.$nm_aset. '</td>';
                                                $jns_aset=$value['KET_ASET'];
                                                echo '<td>'.$jns_aset. '</td>';
                                                $jns_pro=$value['KET_PRO'];
                                                echo '<td>'.$jns_pro. '</td>';
                                                $alamat_aset=$value['ALAMAT_ASET'];
                                                echo '<td>'.$alamat_aset. '</td>';
                                                $nilai_jual=$value['NILAI_JUAL'];
                                                echo '<td>'.rupiah($nilai_jual). '</td>';
                                                $status=$value['STATUS'];
                                                if ($value['STATUS'] == 0){
                                                $status = "INPUT";
                                                }
                                                if ($value['STATUS'] == 1){
                                                $status = "PUSAT";
                                                }
                                                if ($value['STATUS'] == 2){
                                                $status = "CABANG";
                                                }
                                                if ($value['STATUS'] == 3){
                                                $status = "PUBLISH";
                                                }
                                                if ($value['STATUS'] == 4){
                                                $status = "TERJUAL";
                                                }
                                                if ($value['STATUS'] == 5){
                                                $status = "SEWA";
                                                }
                                                echo '<td>'.$status. '</td>';
                                                $no++;
                                              }

											}else
												echo '<tr><td colspan=8 style="text-align: center"><h5>BELUM ADA DATA ASET</h5></td>';
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

</section>
	
</body>

</html>

<script>
var id = document.getElementById("loader");
var Loading = document.createElement("div");

Loading.textContent = "Loading";
Loading.style.fontSize = "28px";
id.appendChild(Loading);

function myFunction() {
  var isConnected = navigator.onLine;

  if (isConnected) {
    var loaded = setInterval(() => {
      Loading.textContent = Loading.textContent + ".";
    }, 1000);

    loaded = setTimeout(showPage, 4000);
  } else {
    
    Loading.textContent = "No internet connection.";
    setTimeout(showPage, 2000);
  }
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>
