<?php
session_start();
  if( !isset($_SESSION["userId"])){
     header("Location: ./index");
   exit;
   }

    include ('include/API_functions.php');

    $API = new API_functions();
    $display = $API->display('');

    include "include/function_rupiah.php";
?>

<!DOCTYPE html>
<html>
<?php
// include "timeout.php";
include "include/header.php"; 
?>

<body class="theme-green" onload="myFunction()" style="margin:0;" >	
	<?php $page = 'display'; include "include/sidebar.php"; ?>
	 <section class="content">
	 	 <div class="container-fluid">
	 	 	<ol class="breadcrumb breadcrumb-bg-blue">
	 	 		<li><a href="javascript:void(0);"><i class="material-icons">insert_photo</i>Display</a></li>
	 	 	</ol>
	 	 	<div id="loader" class="ring">Loading...
		 		<span></span>
			</div>
				<div style="display:none;" id="myDiv" class="animate-bottom">
					 <div class="row clearfix">
					 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					 		<div class="body">
					 			<div class="card">
					 				<div class="header">
					 					<h2><center>DAFTAR DISPLAY ASSET</center></h2>
					 					<div class="body">
					 						<div class="table-responsive">
					 							 <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
					 							 	<thead>
					 							 		<tr>
					 							 			<th>Asset</th>
					 							 			<th>Harga</th>
					 							 			<th>Keterangan</th>
					 							 			<th>Alamat</th>
					 							 			<th>Status</th>
					 							 			<th>Aksi</th>
					 							 		</tr>
					 							 	</thead>
					 							 	<tbody>
					 							 		<?php
					 							 			$pars=json_decode($display,true);
					 							 			
					 							 			$size=count($pars['data']);
                                    						$z=1;

                                    						foreach ($pars['data'] as $key => $value) {

                                    							$np = $API -> property($key,'harga penawaran');
							                                    $na = $API -> editasset($key);
							                                    $nparray = json_decode($np,true);
							                                    $pars=json_decode($na,true);
							                                    $nilai_penawaran = $nparray['data'][0]['NILAI'];

							                                     if ($pars['data'][0]['STATUS']==0) {
							                                     	 if(isset($pars['data'])){
							                                     	 	$size=count($pars['data']);
                                        								for($x=0;$x<$size;$x++){
                                        									echo '<tr>';
                                        									$KET_PRO=$pars['data'][$x]['KET_PRO'];
                                        									echo '<td>'.$KET_PRO.'</td>';
                                        									echo '<td>'.rupiah($nilai_penawaran).'</td>';
                                        									$memo=$pars['data'][$x]['MEMO_ASET'];
                                        									echo '<td>'.$memo.'</td>';
                                        									$alamat=$pars['data'][$x]['ALAMAT_ASET'];
                                        									echo '<td>'.$alamat.'</td>';
                                        									echo '</tr>';
                                        								}
							                                     	 }
							                                     }
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
</body>
</html>

<script>
var Loading;

function myFunction() {
  Loading = setTimeout(showPage, 3000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>