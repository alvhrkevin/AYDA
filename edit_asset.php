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
  $jns_aset = $API->jaset();
  include "include/function_rupiah.php";

  if (isset($_POST['update'])) {
      $kode_kantor      = $_POST ['kode_kantor'];
      $no_aset          = $_POST ['no_aset'];
      $rekening         = $_POST ['rekening'];
      $jns_aset         = $_POST ['jns_aset'];
      $ket_aset         = $_POST ['ket_aset'];
      $jns_pro          = $_POST ['JNSPRO'];
      // $split            = explode("#", $jns_pro);
      // $JNS_PRO2         = $split[0];
      $ket_pro          = $_POST ['ket_pro'];
      $sutri_aset       = $_POST ['sutri_aset'];
      $nm_aset          = $_POST ['nm_aset'];
      $id_aset          = $_POST ['id_aset'];
      $kepemilikan      = $_POST ['kepemilikan'];
      $tglawal_aset     = $_POST ['tglawal_aset'];
      $tgljth_aset      = $_POST ['tgljth_aset'];
      $alamat_aset      = $_POST ['alamat_aset'];
      $map_lok          = $_POST ['map_lok'];
      $judul_aset       = $_POST ['judul_aset'];
      $nilai_jual       = filter_var($_POST ['nilai_jual'], FILTER_SANITIZE_NUMBER_INT);
      $sutri_aset       = $_POST ['sutri_aset'];
      $memo_aset        = $_POST ['memo_aset'];
      $userid           = $_SESSION ["userId"];  
      $memo_jual        = '0';
      $useroto          = '0';
      $oto_stat         = '0';
      $pil              = '2';
      $hasil = $API -> input_aset($kode_kantor, $no_aset, $rekening, $jns_aset, $ket_aset, $jns_pro, $ket_pro, $nm_aset, $sutri_aset, $alamat_aset, $id_aset , $judul_aset, $memo_aset , $kepemilikan , $tglawal_aset, $tgljth_aset, $map_lok, $nilai_jual ,$memo_jual , $userid, $oto_stat , $useroto, $pil);
      
        if ($hasil['responseCode'] == '00') {
        echo "<script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '".$hasil['data']."'
                }).then(() => {
                    window.location = 'as_peminjam?page=edit&nr=".base64_encode($nmr_aset2[0])."';
                });
            });
        </script>";
    } else {
        echo "<script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '".$hasil['data']."'
                }).then(() => {
                    window.location = 'e_asset?page=edit&na=".base64_encode($no_aset)."';
                });
            });
        </script>";
    }
  }

   include "timeout.php";
   include "include/header.php"
?>

<style >
   .btn{
        margin-right: 10px; width: 20%; color: #483838; 
    }
     #JNSPRO{
        height: 34px;
        width: 535px;
    }
    #button{
        margin-right: 10px; width: 80%; color: #483838;
</style>

<body class="theme-green">
    <!-- Top Bar -->
    <?php include "include/navbar.php"; ?>
    <!-- #Top Bar -->
    <?php $page = 'aset'; include "include/sidebar_ekspeminjam.php"; ?>

    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href=""><i class="material-icons">cottage</i>Asset</a></li>
                <li><a href=""><i class="material-icons">folder</i>Edit Data Asset</a></li> 
            </ol>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                          <center><h1><b>FORM EDIT DATA ASSET</b></h1><b><p>Pastikan data yang diinput sudah benar , periksa kembali sebelum data di simpan ke server</p></b></center>

                          <div class="row clearfix">
                                    <div class="col-sm-3">
                                    <button class="btn btn-warning waves-effect" id="button" value="back" onclick="history.back()" ><b>KEMBALI</b></button> 
                                </div>
                            </div> 
                        </div>
                            <div class="body">
                            <form action="" id="aset" method="POST">
                            <input type="hidden" class="form-control" name="aset">
                                <div class="row clearfix">
                                <div class="col-sm-6">
                                <label class="form-label">Norek Pinjaman</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="rekening" id="rekening" readonly  value="<?php echo $pars['data'][0]['NO_PROD']; ?>" >
                                </div>
                              </div>
                                  <div class="col-sm-6">
                                    <label class="form-label">Nama Pinjaman</label>
                                  <div class="form-line">
                                    
                                    <input type="text" class="form-control" name="" id="nama" value="<?php echo $pars['data'][0]['KET_PROD']; ?>" readonly>
                                  </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                              <div class="col-sm-6">
                               
                                <div class="form-line">
                                    <input type="hidden" class="form-control" name="jns_aset"  value="<?php echo $pars['data'][0]['JNS_ASET']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                               
                                <div class="form-line">
                                    <input type="hidden" class="form-control" name="JNSPRO"  value="<?php echo $pars['data'][0]['JNS_PRO']; ?>" readonly>
                                </div>
                            </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-sm-6">
                                <label class="form-label">Bukti Kepemilikan</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="ket_aset"  value="<?php echo $pars['data'][0]['KET_ASET']; ?>" readonly>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Jenis Property Lama</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="ket_pro"  value="<?php echo $pars['data'][0]['KET_PRO']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                       <!--  <div class="row clearfix">
                            <div class="col-sm-6">
                                <label class="form-label">Jenis Property Baru</label>
                                <br>
                                   <select name="JNSPRO" id="JNSPRO" >
                                   
                                    </select>
                            </div>
                        </div> -->
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <label class="form-label">Deskripsi Asset</label>
                                    <textarea name="memo_aset" id="memo_aset" cols="30" rows="6" class="form-control no-resize" ><?php echo $pars['data'][0]['MEMO_ASET']; ?></textarea>
                                    </div>
                            </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <label class="form-label">Kantor</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="kode_kantor" id="kantor" value="<?php echo $pars['data'][0]['WIL']; ?>" readonly  >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Judul Asset</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="judul_aset" value="<?php echo $pars['data'][0]['JUDUL_ASET']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <label class="form-label">No Asset</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="no_aset" value="<?php echo $pars['data'][0]['NO_ASET']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <label class="form-label">Tgl. Sertifikat</label>
                                  <div class="form-line">
                                    <input type="date" class="form-control" name="tglawal_aset" value="<?php echo $pars['data'][0]['TGL1_ASET']; ?>">
                                  </div>
                            </div>
                          <div class="col-sm-6">
                                <label class="form-label">Tgl. Sertifikat Jatuh Tempo</label>
                                  <div class="form-line">
                                    <?php
                                      if ($pars['data'][0]['KET_ASET'] == "SHM(SERTIFIKAT HAK MILIK)") {
                                        echo '<input type="date" name="tgljth_aset" class="form-control" readonly ?>';
                                      }else{
                                         echo '<input type="date" class="form-control" name="tgljth_aset" value="'.$pars['data'][0]['TGL2_ASET'].'">';
                                      }
                                    ?>
                                  </div>
                          </div>
                      </div>
                      <div class="row clearfix">
                          <div class="col-sm-6">
                              <label class="form-label">Nama Pemilik Sertifikat</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nm_aset" value="<?php echo $pars['data'][0]['NM_ASET']; ?>">
                                </div>
                          </div>
                         
                        <div class="col-sm-6">
                            <label class="form-label">Kepemilikan</label>
                                <select name="kepemilikan" class="form-control show-tick ">
                                  <?php
                                        $selectedAsal = $pars['data'][0]['BUKTI_PEMILIK'];
                                        $statusOptions = array(
                                            "MILIK SENDIRI",
                                            "MILIK ORANG TUA",
                                            "MILIK ANAK KANDUNG",
                                            "PIHAK KETIGA"
                                        );
                                        foreach ($statusOptions as $value) {
                                            $selected = ($selectedAsal == $value) ? 'selected' : '';
                                            echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
                                        }
                                    ?>              
                                </select>
                        </div>
                      </div>
                      <div class="row clearfix">
                          <div class="col-sm-6">
                              <label class="form-label">No Sertifikat</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="id_aset" value="<?php echo $pars['data'][0]['ID_ASET']; ?>">
                                </div>
                          </div>
                      <div class="col-sm-6">
                          <label class="form-label">Nama AYDA (Beserta Nama Suami/Istri)</label>
                            <div class="form-line">
                              <input type="text" class="form-control" name="sutri_aset" value="<?php echo $pars['data'][0]['SUTRI_ASET']; ?>">
                          </div>
                      </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <label class="form-label">Alamat Lengkap Lokasi</label>
                                 <div class="form-line">
                                    <textarea name="alamat_aset"  cols="30" rows="2" class="form-control no-resize"  ><?php echo $pars['data'][0]['ALAMAT_ASET']; ?></textarea>
                                </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <label class="form-label">URL</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="map_lok" value="<?php echo $pars['data'][0]['MAP_LOK']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Taksasi Property</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nilai_jual" id="nilai_jual" value="<?php echo rupiah($pars['data'][0]['NILAI_JUAL']); ?>">
                                </div>
                         </div>
                    </div>
                        <div class="row clearfix">
                          <div class="col-sm-3">
                              <button class="btn btn-warning waves-effect" name="update" type="submit"><b>SIMPAN</b></button> 
                          </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>        
    </section>

    <script src="assets/js/app.js"></script>
    <script src="assets/js/jquery-3.6.1.min.js"></script>
    <script src="assets/js/jquery-2.1.3.min.js"></script>
    <script src="assets/js/jquery-1.9.1.js"></script>
    <script src="assets/js/jquery-maskmoney3.0.2.min.js"></script>
    <script src="assets/js/sweetalert2.min.js" ></script>

    <script>


                          
        // $(document).ready(function(){
        //             $("#bukti").on('change', function postinput(){
        //                 var isipilih = $(this).val(); // this.value
        //                 var split = isipilih.split('#');
        //                 isipilih =split[0];
        //                 $.ajax({ 
        //                 url: 'autofill_bukti.php',
        //                 data: { jnsaset: isipilih },
        //                 type: 'post'
        //                 }).done(function(respon) {
        //                     obj = JSON.parse(respon);
        //                     var size=obj.length;
        //                     $('#JNSPRO').html(respon);
        //                     $('#JNSPRO').append('<option value="" >-Pilih Jenis Property-</option>')
        //                     console.log('HABIS DIRESET!!')
        //                     for(var x=0;x<size;x++){
        //                         console.log('Done: '+obj[x].JNS_PRO+"#"+obj[x].KET_PRO);
        //                         $('#JNSPRO').append("<option value='"+obj[x].JNS_PRO+"#"+obj[x].KET_PRO+"'>"+obj[x].KET_PRO+"</option>")
                                
        //                     }  
        //                     }).fail(function() {
        //                     console.log('Failed');
        //                 });
        //             });
        //         });


        // TAKSASI PROPERTYYY------------------->
            $(document).ready(function(){
            $("#nilai_jual").maskMoney({prefix: 'Rp. ', 
                                        thousands: '.', 
                                        decimal: ',',
                                        precision: 0
            });
        });
    </script>
</body>
</html> 
               
