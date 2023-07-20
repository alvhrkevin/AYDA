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
	$cek_property = $API->cekproperty('','');
	

	include "timeout.php";
	include "include/header.php"; 
?>

<body class="theme-green" onload="myFunction()" style="margin:0;">
	<?php $page = 'parameter'; include "include/sidebar_admin.php"; ?>
    <section class="content">
        <div class="container-fluid">
			<ol class="breadcrumb breadcrumb-bg-blue">
				<li><a href="parameter"><i class="material-icons">list</i>Parameter</a></li>
				<li><a href=""><i class="material-icons">widgets</i> Parameter Jenis Property</a></li>
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
									<h2><center>PARAMETER JENIS PROPERTY</center></h2>
									<a href="parameter"><button class="btn btn-warning waves-effect"><b>KEMBALI</b></button> 
									<a href="f_p_property"><button class="btn btn-warning waves-effect"><b>INPUT</b></button></a>
								</div>
								<div class="body">
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead>
												<tr>
													<th>No</th>
													<th>Nomor Asset</th>
													<th>Jenis Property</th> 
													<th>Status</th>
													<th>Aksi</th>  
												</tr>
											</thead>

											<tbody>
											<?php 
												$pars=json_decode($cek_property,true);
												$no=1;
												foreach ($pars['data'] as $key => $value){
													echo "<tr>";
													echo '<td>'.$no. '</td>';
													echo '<td>'.$value['INDEK']. '</td>';
													echo '<td>'.$value['JNS_ASET']. '</td>';
													echo '<td>'.$value['KETERANGAN']. '</td>';
													
													echo '<td>
	                                                    <a type="button" class="btn btn-primary waves-effect" style="width : 100%;" name="tombol" href="edit_p_property?jnsaset='.$value['JNS_ASET'].'&indek='.$value['INDEK'].'";> <p text-align="left"></p></button><i class="material-icons">edit</i></a>
	                                                </td>';
													echo '</tr>';
													$no++;
	                                                $no++;
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
    </section>

     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabelId">User ID</h5>
						<h5 class="modal-title" id="exampleModalLabel"></h5>
					</div>

					<div class="modal-body">
						<div class="row clearfix">
								<button class="btn-block btn-warning waves-effect" id="edit">EDIT USER</button>
						</div>					
					<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
		  
				</div>
			</div>
		</div>
	</div>
	</body>
</html>

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




