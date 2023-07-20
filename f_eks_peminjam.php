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

    if (isset($_POST['submit'])) {
        if(empty($_POST["f_eks_peminjam"])) {
        $kode_kantor = $_POST ['kode_kantor'];
        $rekening    = $_POST ['rekening'];
        $nama        = $_POST ['nama'];
        $alamat      = $_POST ['alamat'];
        $kode_rek    = $_POST ['kode_rek'];
        $ket_rek     = $_POST ['ket_rek'];
        $plafond     = $_POST ['plafond'];
        $saldo       = $_POST ['saldo'];
        $tgl_akad    = $_POST ['tgl_akad'];
        $tgk_bunga   = $_POST ['tgk_bunga'];
        $tgl_jth     = $_POST ['tgl_jth'];
        $jml_aset    = $_POST ['jml_aset'];
        $tgk_lain    = filter_var($_POST ['tgk_lain'], FILTER_SANITIZE_NUMBER_INT);
        $ket_tgklain = filter_var($_POST ['ket_tgklain'], FILTER_SANITIZE_NUMBER_INT);
        $tgk_denda   = filter_var($_POST ['TGK_DENDA'], FILTER_SANITIZE_NUMBER_INT);
        $asal_perolehan   = $_POST['asal_perolehan']; 
        $tgl_perolehan    = $_POST ['tgl_perolehan'];
        $userid     = $_SESSION["userId"];
        $status     = '0';
        $useroto    = '0';
        $pil        = '1';
        $hasil = $API -> f_eks_peminjam($kode_kantor,$nama,$kode_rek,$alamat,$rekening,$ket_rek,$plafond,$saldo,$tgl_akad,$tgl_jth,$tgk_bunga,$tgk_denda,$tgk_lain,$ket_tgklain,$status,$userid,$useroto,$pil,$jml_aset,$asal_perolehan,$tgl_perolehan);
        }

        if ($hasil['responseCode'] == '00') {
            echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: ' ".$hasil['data']."'
                        }).then(() => {
                            window.location = 'ekspeminjam';
                        });
                    });
            </script>";
        } else if ($hasil['responseCode'] == '03') {
            echo "<script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: ' ".$hasil['data']."'
                        }).then(() => {
                            window.location = 'f_ekspeminjam';
                        });
                    });
            </script>";
        } else {
            echo "<script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Data Gagal Di input !'
                        }).then(() => {
                            window.location = 'f_ekspeminjam';
                        });
                    });
            </script>";
        }
    } 
    
    include "timeout.php";
    include "include/header.php"; 
?>
<body class="theme-green">
    <?php $page = 'ekspeminjam'; include "include/sidebar_ekspeminjam.php"; ?> 
    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-cyan">
                <li><a href="ekspeminjam"><i class="material-icons">widgets</i> Data Eks Peminjam</a></li>
                <li><a><i class="material-icons">library_books</i> Form Eks Peminjam</a></li>
            </ol>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><center>FORM INPUT DATA EKS PEMINJAM</center></h2>
                        </div>
                        <div class="body">
                            <form action="" id="autocomplete" method="POST">
                            <input type="hidden" class="form-control" name="f_eks_peminjam">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="form-label">Norek Pinjaman</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="rekening" placeholder="Masukkan No Pinjaman" id="rekening" required>
                                        </div>
                                    </div>
                                    <div class="form-line">
                                        <input type="hidden" id="kode_rek" name="kode_rek"> 
                                    </div>
                                    <div id="loader" style="display: none; margin-top: 20px;">
                                        <img src="assets/img/loading.png"><b>Loading...</b>
                                    </div>
                                   <div id="error-message" style="display: none; margin-top: 33px; color: red;"></div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="form-label">Jenis Pinjaman</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="ket_rek" id="ket_rek" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-line">
                                        <input type="hidden" id="kode_kantor" name="kode_kantor">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Kantor Cabang</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="kantor" id="kantor" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="form-label">Nama Eks Peminjam</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="nama" id="nama" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <label class="form-label">Alamat</label>
                                        <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control no-resize" readonly required ></textarea>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="form-label">Plafond Awal</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="plafond" id="plafond"  required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Outstanding</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="saldo" id="saldo" r required >
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="form-label">Tanggal Akad</label>
                                        <div class="form-line">
                                            <input type="text"  class="form-control" name="tgl_akad" id="tgl_akad" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Tanggal Jatuh Tempo</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="tgl_jth" id="tgl_jth" readonly required >
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="form-label">Bunga Tunggakan</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="tgk_bunga" id="tgk_bunga" required>
                                            </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Bunga Grace Period</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="tgk_lain" id="tgk_lain" value="0" required  >
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                            <label class="form-label">Denda Keterlambatan</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="TGK_DENDA" id="TGK_DENDA" value="0"  required>
                                            </div>
                                        </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Tunggakan Lain - Lain</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="ket_tgklain" id="tg_lain" value="0" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-2">
                                        <label class="form-label">Jumlah Asset</label>
                                        <div class="form-line">
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="input-group-text" style="padding: 6px;"><b>Unit</b></span>
                                                    <input type="text" class="form-control" name="jml_aset" id="jml_aset" value="0" required style="width: 50%; text-align: center;">
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="form-label">Tanggal Perolehan</label>
                                        <div class="form-line">
                                            <input type="date" data-date="" data-date-format="DD MMMM YYYY" class="form-control" name="tgl_perolehan" id="tgl_perolehan" required >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Asal Perolehan</label>
										<select class="form-control" name="asal_perolehan" required>
										  <option disabled selected value>-Pilih Asal Perolehan-</option>      
										  <option value="Lelang">Lelang</option>
										  <option value="Penyerahan">Penyerahan</option>
										  <option value="Sita Jaminan">Sita Jaminan</option>
										</select>
                                    </div>
                                </div>
                                <button class="btn btn-warning waves-effect" name="submit" type="submit"><b>SIMPAN</b></button> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</body>
</html>

<script src="assets/js/jquery-1.9.1.js"></script>
<script src="assets/js/moment-2.10.3-moment.min.js"></script>
<script src="assets/js/sweetalert2.min.js"></script>
<script src="assets/js/jquery.autocomplete.min.js"></script>
<script src="assets/js/jquery-maskmoney3.0.2.min.js"></script>

    <script>
        $(document).ready(function() {
          $("#rekening").on('change', function postinput() {
            var matchvalue = $(this).val();
            $.ajax({
              url: 'autofill_ekspeminjam.php',
              type: 'post',
              data: { rekening: matchvalue },
              beforeSend: function() {
                $("#loader").show();
                console.log("Loading muncul!!");
                $("#error-message").hide();
                console.log("Error message hilang !");
              },
            }).done(function(response) {
              console.log('Done: ' + response);
              var data = JSON.parse(response);
              if (data.error) {
                $("#error-message").text(data.error).show();
                setTimeout(function() {
                  $("#error-message").hide();
                }, 5000);
              } else {
                $("#kantor").val(data.kantor);
                $("#kode_kantor").val(data.kode_kantor);
                $("#kode_rek").val(data.kode_rek);
                $("#ket_rek").val(data.ket_rek);
                $("#nama").val(data.nama);
                $("#alamat").val(data.alamat);
                $("#plafond").val(data.plafond);
                $("#saldo").val(data.saldo);
                $("#tgl_akad").val(data.tgl_akad);
                $("#tgl_jth").val(data.tgl_jth);
                $("#tgk_bunga").val(data.bungatgk);
                $("#TGK_DENDA").val(data.TGK_DENDA);
              }
            }).fail(function(jqXHR, textStatus) {
              $("#loader").hide();
              console.log("Terjadi kesalahan: " + textStatus);
              // Display error message
              $("#error-message").text("Terjadi kesalahan: " + textStatus).show();
              setTimeout(function() {
                $("#error-message").hide();
              }, 3000);
            }).always(function() {
              // Additional code to handle the response
              console.log("Response received.");
              $("#loader").hide();
            });
          });
        });

            $(document).ready(function(){
                $("#tgk_lain").maskMoney({
                                    thousands: '.', 
                                    allowZero:true   
                });
                $("#tgk_lain").keyup(function() {
                    var clone = $(this).val();
                    var cloned = clone.replace(/[A-Za-z$. ,-]/g, "")
                $("#").val(cloned);
                    console.log('#harga2');
                });
                $("#TGK_DENDA").maskMoney({ 
                                    thousands: '.', 
                                    allowZero:true
                });
                $("#tg_lain").maskMoney({ 
                                    thousands: '.', 
                                    allowZero:true
                });
				$("#tgk_bunga").maskMoney({ 
                                    thousands: '.', 
                                    allowZero:true
                });
                $("#nilai_jual").keyup(function() {
                var clone = $(this).val();
                var cloned = clone.replace(/[A-Za-z$. ,-]/g, "")
                $("#harga2").val(cloned);
                console.log('#harga2');
            });
        });

        $("input").on("change", function() {
        this.setAttribute(
        "data-date",
        moment(this.value, "YYYY-MM-DD")
        .format( this.getAttribute("data-date-format") )
            )
        }).trigger("change")

    </script>
	

	

