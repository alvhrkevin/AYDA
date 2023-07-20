<?php 
session_start();
if(	!isset($_SESSION["userId"])){
     header("Location: ./");
   	exit;
   }
?>

<!DOCTYPE html>
<html>

<?php
include ('include/API_functions.php');
$API = new API_functions();
$rek = base64_decode($_GET['nr']);
$hasil = $API -> asetPeminjam($rek);



include "timeout.php";
include "include/header.php"; 
?>

<style>
    p{text-align: left;}
</style>

<body class="theme-green">
	<?php $page = 'ekspeminjam'; include "include/sidebar_asset.php"; ?>
    <section class="content">
        <div class="container-fluid">
			<ol class="breadcrumb breadcrumb-bg-blue">
				<li><a href="ekspeminjam"><i class="material-icons">widgets</i> Data Eks Peminjam</a></li>
				<li><a><i class="material-icons">library_books</i> Data Aset</a></li>
            </ol>
			<div class="body">
				<div class="row clearfix">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">
							<div class="card">
								<div class="header">
									<h2><center>DATA ASET</center></h2>
								</div>
								<div class="body">
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead>
												<tr>
													<?php echo '<th><a type="button" class="btn btn-block btn-lg btn-success waves-effect" href="f_input_asset?page=input&nr='.base64_encode($rek).'" style="width: 100%;"><b>TAMBAH DATA</b></a>' ?>
													</th>
												</tr>
											</thead>
											<tbody>
											
												<?php 
												$pars=json_decode($hasil,true);
												if(isset($pars['data'])){
													$size=count($pars['data']);
													//echo "<tr>";
													$z=1;
													for($x=0;$x<$size;$x++){
													echo "<tr>";
													
													$NO_ASET=$pars['data'][$x]['NO_ASET'];
													$NO_ASET=strval("$NO_ASET");
													$KET_ASET=$pars['data'][$x]['KET_ASET'];
													$NM_ASET=$pars['data'][$x]['NM_ASET'];
													$ALAMAT_ASET=$pars['data'][$x]['ALAMAT_ASET'];
													$JUDUL_ASET=$pars['data'][$x]['JUDUL_ASET'];
														
													echo '<td><button  class="btn-block" name="tombol"'.$x.'value="'.$NO_ASET.'"  data-toggle="modal"
														data-target="#exampleModal" onclick="insert('.$NO_ASET.')"> <p text-align="left" style="margin-left:20px;margin-top:10px">'.$NO_ASET.'</br>'. $KET_ASET.'</br>'.$NM_ASET.'</br>'.$ALAMAT_ASET.'</br>'.$JUDUL_ASET.'</p></button> </td>';
													echo "</tr>";
													} 
												}
												else
													echo '<tr><td><h5>BELUM ADA DATA ASET</h5></td>';
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
    </section>
	
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">	
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabelId">NO ASSET</h5>
					<h5 class="modal-title"id="exampleModalLabel"></h5>            
				</div>
					<div class="modal-body">
						<div class="row clearfix">
								<button class="btn-block btn-warning waves-effect" id="edit">EDIT ASSET</button> 
						</div>
						<div class="row clearfix">
								</br>
						</div>
						<div class="row clearfix">
								<button class="btn-block btn-warning waves-effect" id="properti">DATA PROPERTI</button>	 
						</div>
						<div class="row clearfix">
								</br>
						</div>
						<div class="row clearfix">
								<button class="btn-block btn-warning waves-effect" id="fasilitas">DATA FASILITAS</button>	 
						</div>
						<div class="row clearfix">
								</br>
						</div>
						<div class="row clearfix">
								<button class="btn-block btn-warning waves-effect" id="foto">DATA FOTO</button>	 
						</div>
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
			///var marks = $("#marks").val();
			var str = "You Have Entered "
				+ "Name: " + name;
			$("#modal_body").html(str);
		});
	</script>
	
	<script type="text/javascript">
		$("#edit").click(function () {
			var no_aset = $("#exampleModalLabel").val();
			window.location="./e_asset?page=edit&na="+btoa(no_aset);
			
		});
	</script>


	<script type="text/javascript">
		$("#properti").click(function () {
			var no_aset = $("#exampleModalLabel").val();
			window.location="det_property?page=input&na="+btoa(no_aset);
		});
	</script>

	<script type="text/javascript">
		$("#fasilitas").click(function () {
			var no_aset = $("#exampleModalLabel").val();
			window.location="fasilitas?page=input&na="+btoa(no_aset);
	
		});
	</script>

	<script type="text/javascript">
		$("#foto").click(function () {
			var no_aset = $("#exampleModalLabel").val();
			window.location="d_foto?page=display&na="+btoa(no_aset);
			
		});
	</script>
	
</body>

</html>
<script>

    function insert(iki){
		
		var isi=iki+"";
        //window.alert("You click insert button"+isi);
		$("#exampleModalLabel").html(isi);
		$("#exampleModalLabel").val(isi);
		$("#noaset").val(iki);
		
    }
</script>
