<?php 
session_start();
    if( !isset($_SESSION["userId"])){
         header("Location: ./");
       exit;
       }
       include "timeout.php";
       include "include/header.php";
       ?>
<!DOCTYPE html>
<html>

<?php
    include ('include/API_functions.php');
    $API = new API_functions();
    $no_aset = base64_decode($_GET['na']);
    $no_aset2 = explode(".", $no_aset);
    $na = $API -> editasset($no_aset);
    $cekfasilitas = $API->cekfasilitas($no_aset);
    $pars=json_decode($na,true);

      if (isset($_POST['submit'])) {
        $no_aset = $_POST['no_aset'];
        $keamanan = $_POST ['keamanan'];
        $jln_tol = $_POST ['jln_tol'];
        $pasar_lama = $_POST ['pasar_lama'];
        $sekolah = $_POST ['sekolah'];
        $b_banjir = $_POST ['b_banjir'];
        $kebugaran = $_POST ['kebugaran'];
        $masuk_mobil = $_POST ['masuk_mobil'];
        $pst_belanja = $_POST ['pst_belanja'];
        $r_sakit = $_POST ['r_sakit'];
        $mini_market = $_POST ['mini_market'];
        $pst_kota = $_POST ['pst_kota'];
        $jln_raya = $_POST ['jln_raya'];
        $stasiun_trm_bnd = $_POST ['stasiun_trm_bnd'];
        $masjid = $_POST ['masjid']; 
        $tmpt_ibadahlain = $_POST ["tmpt_ibadahlain"];
        $hasil = $API -> input_fasilitas($no_aset, $keamanan, $jln_tol, $pasar_lama, $sekolah, $b_banjir, $kebugaran, $masuk_mobil,
            $pst_belanja, $r_sakit, $mini_market, $pst_kota, $jln_raya, $stasiun_trm_bnd, $masjid, $tmpt_ibadahlain);
        
        if ($hasil['responseCode'] == '00') {
            echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: '".$hasil['responseMessage']."',
                        text: '".$hasil['data']."',
                        input: 'none'
                    }).then(() => {
                        window.location = 'as_peminjam?page=edit&nr=".base64_encode($no_aset2[0])."';
                    });
                });
            </script>";
        } else {
            echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: '".$hasil['data']." !',
                        input: 'none'
                    }).then(() => {
                        window.location = 'fasilitas?page=input&na=".base64_encode($no_aset)."';
                    });
                });
            </script>";
        }
    }
    
?>

<style >
    .btn{
        margin-right: 10px; width: 20%; color: #483838; 
    }
    #button{
        margin-right: 10px; width: 80%; color: #483838;
    }
</style>

<body class="theme-green">
    <!-- Top Bar -->
    <?php include "include/navbar.php"; ?>
    <!-- #Top Bar -->
    <?php $page = 'ekspeminjam'; include "include/sidebar_form.php"; ?>

     <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="ekspeminjam"><i class="material-icons">widgets</i> Data Eks Peminjam</a></li>
                <li><a href="aset_peminjam"><i class="material-icons">library_books</i> Data Aset</a></li>
                <li><a><i class="material-icons">beenhere</i>Cheklist Fasilitas</a></li>
            </ol>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <center><h1><b>FORM FASILITAS</b></h1>
                            <b><p>Pastikan data yang diinput sudah benar , periksa kembali sebelum data di simpan ke server</p></b></center>
                            <div class="row clearfix">
                                    <div class="col-sm-3">
                                    <button class="btn btn-warning waves-effect" id="button" value="back" onclick="history.back()" ><b>KEMBALI</b></button> 
                                </div>
                            </div> 
                        </div>
                         <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">   
                        <div class="body">
                              <form action="" id="fasilitas" method="POST">
                              <input type="hidden" class="form-control" name="fasilitas">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <label class="form-label">No Asset</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="no_aset" readonly value="<?php echo $pars['data'][0]['NO_ASET']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php $pars=json_decode($cekfasilitas,true); ?>
                                <div class="row clearfix">
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                              <input  type="hidden" name="keamanan" value="0" >
                                              <input  type="checkbox" name="keamanan" value="1" id="keamanan" 
                                        <?php
                                            if ($pars['data'][0]['KEAMANAN'] == 1) {
                                                echo 'checked="checked"';
                                            } 
                                        ?>  >
                                                <label class="form-check-label" for="keamanan">
                                                    Keamanan 24 Jam
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                              <div class="form-check">
                                                <input  type="hidden" name="kebugaran" value="0" >
                                              <input  type="checkbox" name="kebugaran" value="1"  id="pusat_kebugaran" 
                                        <?php
                                            if ($pars['data'][0]['KEBUGARAN'] == 1) {
                                                echo 'checked="checked"';
                                            } 
                                        ?>    >
                                                <label class="form-check-label" for="pusat_kebugaran">
                                                    Pusat Kebugaran 
                                                </label>
                                            </div> 
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                              <input  type="hidden" name="pst_kota" value="0" >
                                              <input  type="checkbox" name="pst_kota" value="1" id="pst_kota" 
                                        <?php
                                            if ($pars['data'][0]['PST_KOTA'] == 1) {
                                                echo 'checked="checked"';
                                            } 
                                        ?> >
                                                <label class="form-check-label" for="pst_kota">
                                                    Dekat Pusat Kota / Perkantoran 
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                              <input  type="hidden" name="jln_tol" value="0" >
                                              <input  type="checkbox" name="jln_tol" value="1" id="jln_tol"
                                        <?php
                                            if ($pars['data'][0]['JLN_TOL'] == 1) {
                                                echo 'checked="checked"';
                                            } 
                                        ?> >
                                                <label class="form-check-label" for="jln_tol">
                                                    Akses Jalan Tol
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                              <div class="form-check">
                                                <input  type="hidden" name="masuk_mobil" value="0" >
                                              <input  type="checkbox" name="masuk_mobil" value="1" id="masuk_mobil"
                                        <?php
                                            if ($pars['data'][0]['MASUK_MOBIL'] == 1) {
                                                echo 'checked="checked"';
                                            } 
                                        ?> >
                                                <label class="form-check-label" for="masuk_mobil">
                                                  Masuk Mobil
                                                </label>
                                            </div> 
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                              <input  type="hidden" name="jln_raya" value="0" >
                                              <input  type="checkbox" name="jln_raya" value="1" id="jln_raya"
                                      <?php
                                            if ($pars['data'][0]['JLN_RAYA'] == 1) {
                                                echo 'checked="checked"';
                                            } 
                                        ?> >
                                                <label class="form-check-label" for="jln_raya">
                                                  Dekat Jalan Raya
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                              <input  type="hidden" name="pasar_lama" value="0" >
                                              <input  type="checkbox" name="pasar_lama" value="1" id="pasar_lama"
                                        <?php
                                            if ($pars['data'][0]['PASAR_LAMA'] == 1) {
                                                echo 'checked="checked"';
                                            } 
                                        ?> >
                                                <label class="form-check-label" for="pasar_lama">
                                                   Dekat Pasar Tradisional
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                              <div class="form-check">
                                                <input  type="hidden" name="pst_belanja" value="0" >
                                              <input  type="checkbox" name="pst_belanja" value="1"  id="pst_belanja"
                                        <?php
                                            if ($pars['data'][0]['PST_BELANJA'] == 1) {
                                                echo 'checked="checked"';
                                            } 
                                        ?> >
                                                <label class="form-check-label" for="pst_belanja">
                                                    Dekat Pusat Perbelanjaan
                                                </label>
                                            </div> 
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                              <input  type="hidden" name="stasiun_trm_bnd" value="0" >
                                              <input  type="checkbox" name="stasiun_trm_bnd" value="1" id="stasiun_trm_bnd"
                                        <?php
                                            if ($pars['data'][0]['STASIUN_TRM_BND'] == 1) {
                                                echo 'checked="checked"';
                                            } 
                                        ?> >
                                                <label class="form-check-label" for="stasiun_trm_bnd">
                                                  Dekat Stasiun / Terminal / Bandara
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                              <input  type="hidden" name="sekolah" value="0" >
                                              <input  type="checkbox" name="sekolah" value="1" id="sekolah"
                                        <?php
                                            if ($pars['data'][0]['SEKOLAH'] == 1) {
                                                echo 'checked="checked"';
                                            } 
                                        ?> >
                                                <label class="form-check-label" for="sekolah">
                                                  Dekat Sekolah
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                              <div class="form-check">
                                                <input  type="hidden" name="r_sakit" value="0" >
                                              <input  type="checkbox" name="r_sakit" value="1" id="r_sakit"
                                        <?php
                                            if ($pars['data'][0]['R_SAKIT'] == 1) {
                                                echo 'checked="checked"';
                                            } 
                                        ?> >
                                                <label class="form-check-label" for="r_sakit">
                                                  Dekat Rumah Sakit
                                                </label>
                                            </div> 
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                              <input  type="hidden" name="masjid" value="0" >
                                              <input  type="checkbox" name="masjid" value="1" id="masjid"
                                        <?php
                                            if ($pars['data'][0]['MASJID'] == 1) {
                                                echo 'checked="checked"';
                                            } 
                                        ?> >
                                                <label class="form-check-label" for="masjid">
                                                  Dekat Masjid
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                              <input  type="hidden" name="b_banjir" value="0" >
                                              <input  type="checkbox" name="b_banjir" value="1" id="b_banjir"
                                        <?php
                                            if ($pars['data'][0]['B_BANJIR'] == 1) {
                                                echo 'checked="checked"';
                                            } 
                                        ?> >
                                                <label class="form-check-label" for="b_banjir">
                                                    Bebas Banjir
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                              <div class="form-check">
                                                <input  type="hidden" name="mini_market" value="0" >
                                                <input  type="checkbox" name="mini_market" value="1" id="mini_market"
                                        <?php
                                            if ($pars['data'][0]['MINI_MARKET'] == 1) {
                                                echo 'checked="checked"';
                                            } 
                                        ?> >
                                                  <label class="form-check-label" for="mini_market">
                                                  Dekat Pertokoan atau Mini Market
                                                  </label>
                                            </div> 
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                              <input  type="hidden" name="tmpt_ibadahlain" value="0" >
                                                <input  type="checkbox" name="tmpt_ibadahlain" value="1" id="tmpt_ibadahlain"
                                        <?php
                                            if ($pars['data'][0]['TMPT_IBADAHLAIN'] == 1) {
                                                echo 'checked="checked"';
                                            } 
                                        ?> >
                                                  <label class="form-check-label" for="tmpt_ibadahlain">
                                                  Dekat Tempat Ibadah Non Muslim
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                            <button class="btn btn-warning waves-effect" name="submit" type="submit"><b>SIMPAN</b></button>
                          </form>
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

<script src="assets/js/sweetalert2.min.js" ></script>
