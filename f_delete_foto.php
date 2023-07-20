<?php 

session_start();
  if( !isset($_SESSION["userId"])){
     header("Location: index.php");
   exit;
   }

include ('include/API_functions.php');
$API = new API_functions();
$noaset = base64_decode($_GET['na']);
$na = $API -> cekfoto($noaset);

if(isset($_POST['update'])){
  $no_aset    = $_POST['no_aset'];
  $keterangan = $_POST['keterangan']; 
  $userid     = $_SESSION["userId"];
  $link   = "http://jasakoe.kospinjasa.com:3333/ccc/";
  $pil        = '2';
  $indek      = $_POST['indek'];
  $hasil = $API->input_foto($no_aset, $indek, $link, $userid, $pil, $keterangan);
    
    if($hasil['responseCode'] == 00){
        echo  "<script type = 'text/javascript'>alert('".$hasil['responseMessage'].", ".$hasil['data']."');window.location='./data_ekspeminjam'</script>";
    }else {
        echo  "<script type = 'text/javascript'>alert('".$hasil['responseMessage']."');window.location='./data_ekspeminjam'</script>";
    }
 }
   
?>

<?php
 
// include "timeout.php";

?>

<!DOCTYPE html>
<html>

<?php include "include/header.php"; ?>

<style >

   .btn{
        margin-right: 10px; width: 20%; color: #483838; 
    }
  
</style>
<body class="theme-green">
    <!-- Top Bar -->
    <?php include "include/navbar.php"; ?>
    <!-- #Top Bar -->
    <?php $page = 'ekspeminjam'; include "include/sidebar.php"; ?>

     <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="./asset"><i class="material-icons">home</i>Asset</a></li>
                 <li><a href="f_input_foto.php"><i class="material-icons">add_a_photo</i> Foto / Delete Foto</a></li>
            </ol>
            <div class="body">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                         <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                          </div>
                              <div class="body">
                                <div class="row clearfix">
                                  <div class="col-xs-8 col-xs-offset-2 well" >
                                    <form action="" method="POST" enctype="multipart/form-data">
                                      <div class="row clearfix">
                                        <?php 
                                          
                                          $pars=json_decode($na,true); ?>
                                          <div class="col-sm-12">
                                            <label class="form-label">No Asset</label>
                                              <div class="form-line">
                                                <input type="text" class="form-control" name="no_aset" readonly value="<?php echo $pars['data'][0]['NO_ASET']; ?>">
                                              </div>
                                          </div>
                                      </div>
                                    <div class="form-group">
								
									<?php  
									$LINK=$pars['data'][0]['LINK'];
									if ($LINK == 1 ){
										echo '<img src='.$pars['data'][0]['LINK'].' width="100%" id="preview"/>';
									}else{
										echo '<img src='.$pars['data'][0]['LINK'].' width="50%" id="preview"/>';
									} 
									?>
									
									<br>
						   			</div>
                                      <div id="display-image"></div>
                                      <br>
                                       <div class="row clearfix">
                                          <div class="col-sm-12">
                                              
                                                  <div class="form-line">
                                                      <input type="hidden" class="form-control" name="indek" value="<?php echo $pars['data'][0]['INDEK']; ?>" >
                                                  </div>
                                          </div>
                                      </div>
                                      <div class="row clearfix">
                                          <div class="col-sm-12">
                                              
                                                  <div class="form-line">
                                                      <input type="text" class="form-control" id="link" name="link" value="<?php echo $pars['data'][0]['LINK']; ?>" >
                                                  </div>
                                          </div>
                                      </div>
                                      <div class="row clearfix">
                                          <div class="col-sm-12">
                                              
                                                  <div class="form-line">
                                                    <input type="hidden" placeholder="Keterangan" name="keterangan" value="<?php echo $pars['data'][0]['KETERANGAN']; ?>" class="form-control"/>
                                                  </div>
                                          </div>
                                      </div>
                                     <div class="row clearfix">
                                    <div class="col-sm-3">
                                    <button class="btn btn-danger waves-effect" name="update" type="submit"><b>DELETE</b></button> 
                                </div>
                            </div>  
                                    </form>
                                </div>
                          </div>
                    </div> 
                </div>         
        </section>
    </body>
</html>




