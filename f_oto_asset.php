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
    $nmr_aset = base64_decode($_GET['na']);
	$nmr_aset2 = explode(".", $nmr_aset);
	$na = $API -> editasset($nmr_aset);
	$pars=json_decode($na,true);
	
	
	$pars=json_decode($na,true);

    if (isset($_POST['submit'])) {
    $noaset = $_POST['noaset'];
    $status = $_POST['status'];
    $ovdoto = $_SESSION["userId"];
    $otoaset = $API->otoaset($noaset, $status, $ovdoto);

    if ($otoaset['responseCode'] == 00) {
        echo "<script src='assets/js/sweetalert2.min.js'></script>";
        echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses, " . $otoaset['data'] . "',
                        showConfirmButton: true,
                        timer: 5000
                    }).then(() => {
                        window.location='./otorisasi_asset';
                    });
                });
            </script>";
    } else {
        echo "<script src='assets/js/sweetalert2.min.js'></script>";
        echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: '" . $otoaset['responseMessage'] . "',
                        text: '" . $otoaset['data'] . "',
                        showConfirmButton: true,
                        timer: 5000
                    }).then(() => {
                        window.location='./otorisasi_asset';
                    });
                });
            </script>";
    }
}


    
       include "timeout.php";
       include "include/header.php";
       
?>

<body class="theme-green">
    <!-- Top Bar -->
    <?php include "include/navbar.php"; ?>
    <!-- #Top Bar -->
    <?php $page = 'ekspeminjam'; include "include/sidebar_otoaset.php"; ?>

     <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a><i class="material-icons">library_books</i> Form Otorisasi Eks Peminjam</a></li>
            </ol>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <center><h1><b>FORM OTORISASI ASSET</b></h1></center>
                            <div class="row clearfix">
                                    <div class="col-sm-3">
                                </div>
                            </div>  
                        </div>
                        <div class="body">
                            <form action="" id="autocomplete" method="POST">
                            <input type="hidden" class="form-control" name="f_eks_peminjam">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        
                                        <div class="form-line">
                                            <label >Norek Assets</label>
                                            <input type="text" class="form-control" name="noaset"  readonly required  value="<?php echo $pars['data'][0]['NO_ASET']; ?>">
                                        </div>
                                    </div>
                                     
                                        <div class="form-line">
                                            <input type="hidden" id="kode_rek" name="kode_rek" value="<?php echo $pars['data'][0]['kode_rek']; ?>">
                                        
                                    </div>
                                </div>
								<div class="row clearfix">
										<div class="col-sm-6">
											 <label class="form-label">Status</label>
												<select name="status" class="form-control" >
												<?php
													 $selectedStatus = $pars['data'][0]['STATUS'];
														$statusOptions = array(
															0 => 'Input',
															1 => 'Pusat',
															2 => 'Cabang',
															3 => 'Publish',
															4 => 'Terjual',
															5 => 'Sewa'
														);
														foreach ($statusOptions as $value => $label) {
														$selected = ($selectedStatus == $value) ? 'selected' : '';
														echo '<option value="' . $value . '" ' . $selected . '>' . $label . '</option>';
													}
													
												?>
												</select>
										</div>
									</div>
                                <button class="btn btn-warning waves-effect" name="submit" type="submit"><b>OTORISASI</b></button> 
                               </form>     
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </section>  
</body>
</html>


