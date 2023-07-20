<?php
session_start();
if( !isset($_SESSION["userId"])){
     header("Location: ./");
   exit;
   }

include ('include/API_functions.php');
$API = new API_functions();
$hasil = $API -> data_eksnasabah('');
include "include/function_rupiah.php";

include "timeout.php";

?>

<!DOCTYPE html>
<html>
<?php
include "include/header.php"; 
?>

<body class="theme-green" onload="myFunction()" style="margin:0;">	
	<?php $page = 'ekspeminjam'; include "include/sidebar.php"; ?>
    <section class="content">
     <div class="container-fluid">
			<ol class="breadcrumb breadcrumb-bg-blue">
				<li><a href=""><i class="material-icons">widgets</i> Data Eks Peminjam</a></li>
      		</ol>
      	<div id="loader" class="ring" style="display: flex;justify-content: center;align-items: center;height: 100vh;">
		 	<span></span>
		</div>
      <div style="display:none;" id="myDiv" class="animate-bottom">
			<div class="body">
				<div class="row clearfix">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
					<a type="button" class="btn btn-block btn-lg btn-success waves-effect" href="f_ekspeminjam" style="width: 100%;"><b>TAMBAH DATA</b></a>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">
							<div class="card">
								<div class="header">
									<h2><center>DATA EKS PEMINJAM</center></h2>
								</div>
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
													<th>Tanggl Jatuh</th>
													<th>Status</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>

												<?php 

												$pars=json_decode($hasil,true);
												if(isset($pars['data'])){
													$size=count($pars['data']);
													$no 	= 1;
													foreach ($pars['data'] as $key => $value) {
														echo '<tr>';
														echo '<td>'.$no. '</td>';
	                                                    $no_prod=$value['NO_PROD'];
	                                                    echo '<td>'.$no_prod.'</td>';
	                                                    $nama=$value['NAMA'];
	                                                    echo '<td>'.$nama.'</td>';
	                                                    $jns_pin=$value['JNS_PIN'];
	                                                    echo '<td>'.$jns_pin.'</td>';
	                                                    $wil_ket=$value['WIL_KET'];
	                                                    echo '<td>'.$wil_ket.'</td>';
	                                                    $plafond=$value['PLAFOND'];
	                                                    echo '<td>'.rupiah($plafond).'</td>';
	                                                    $tgl=date("d/m/Y", strtotime($value['TGL_JTH']));
	                                                    echo '<td>'.$tgl.'</td>';
	                                                    $status=$value['STATUS'];
	                                                    if ($value['STATUS'] == 0){
	                                                    	$status = "UNPROTECT";
	                                                    }else if ($value['STATUS'] == 1) {
	                                                    	$status = "PROTECT";
	                                                    }else if ($value['STATUS'] == 2) {
	                                                    	$status = "PUBLISH CABANG";
	                                                    }else if ($value['STATUS'] == 3) {
	                                                    	$status = "PUBLISH UMUM";
	                                                    }else if ($value['STATUS'] == 4) {
	                                                    	$status = "TERJUAL";
	                                                    }else if ($value['STATUS'] == 5) {
	                                                    	$status = "ASSET DISEWAKAN";
	                                                    }
	                                                    echo '<td>'.$status. '</td>';
                                                    	if ($value['STATUS']==0) {
                                                    	echo '<td>
															<a type="button" class="btn btn-warning waves-effect" style="width : 100%;" name="tombol" data-toggle="modal"
																data-target="#exampleModal"  onclick="insert('.$no_prod.')"> <p text-align="left"></p></button><i class="material-icons">description</i></a>
															</td>';
                                                    	}else if ($value['STATUS']==1) {
                                                    		echo '<td>
															<a type="button" class="btn btn-primary waves-effect" style="width : 100%;" disabled ><p text-align="left"></p></button><i class="material-icons">description</i></a>
																  </td>';
                                                    	}else if ($value['STATUS']==2) {
                                                    		echo '<td>
															<a type="button" class="btn btn-success waves-effect" style="width : 100%;" disabled ><p text-align="left"></p></button><i class="material-icons">description</i></a>
																  </td>';
                                                    	}else if ($value['STATUS']==3) {
                                                    		echo '<td>
															<a type="button" class="btn btn-info waves-effect" style="width : 100%;" disabled ><p text-align="left"></p></button><i class="material-icons">description</i></a>
																  </td>';
                                                    	}else if ($value['STATUS']==4) {
                                                    		echo '<td>
															<a type="button" class="btn btn-danger waves-effect" style="width : 100%;" disabled ><p text-align="left"></p></button><i class="material-icons">description</i></a>
																  </td>';
                                                    	}else if ($value['STATUS']==5) {
                                                    		echo '<td>
															<a type="button" class="btn btn-secondary waves-effect" style="width : 100%;" disabled ><p text-align="left"></p></button><i class="material-icons">description</i></a>
																  </td>';
                                                    	}
														echo '</tr>';
														$no++;
													}
													
												} else 
													echo '<tr><td colspan = 9 style="text-align: center"><h5>BELUM ADA DATA NASABAH</h5></td>';
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
</section>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabelId">NO PRODUK</h5>
					<h5 class="modal-title" id="exampleModalLabel"></h5>
				</div>

				<div class="modal-body">
					<div class="row clearfix">
						<button class="btn-block btn-warning waves-effect" id="edit">EDIT DATA</button>	 
					</div>
					<div class="row clearfix">
						</br>
					</div>
					<div class="row clearfix">
						<button class="btn-block btn-warning waves-effect" id="perolehan">NILAI PEROLEHAN</button>
					</div>
					<div class="row clearfix">
					</br>
					</div>
					<div class="row clearfix">
						<button class="btn-block btn-warning waves-effect" id="aset">DATA ASET</button>	 
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$("#submit").click(function () {
			var name = this.name();
			var marks = $("#marks").val();
			var str = "You Have Entered "
				+ "Name: " + name;
			$("#modal_body").html(str);
		});
	</script>
	
	<script type="text/javascript">
		$("#edit").click(function () {
			var norek = $("#exampleModalLabel").val();
			window.location="e_ekspeminjam?page=edit&nr="+btoa(norek);
		});
	</script>

	<script type="text/javascript">
		$("#perolehan").click(function () {
			var norek = $("#exampleModalLabel").val();
			window.location="n_perolehan?nr=nilai&nr="+btoa(norek);
		});	
	</script>
	
	<script type="text/javascript">
		$("#aset").click(function () {
			var norek = $("#exampleModalLabel").val();
			window.location="as_peminjam?page=data&nr="+btoa(norek);
			
		});
	</script>
	
</body>

</html>

<script>
    function insert(iki){
		var isi=iki;
		console.log(isi);
		$("#exampleModalLabel").html(isi);
		$("#exampleModalLabel").val(isi);
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
