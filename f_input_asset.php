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
    include "include/function_rupiah.php";
    $API = new API_functions();
    $rek = base64_decode($_GET['nr']);
    $nr = $API -> editnasabah($rek);
    $pars=json_decode($nr,true);
    $jns_aset = $API->jaset();

    if (isset($_POST['submit'])) {
          $kode_kantor      = $_POST ['kode_kantor'];
          $no_aset          = $_POST ['no_aset'];
          $rekening         = $_POST ['rekening'];
          $jns_aset         = $_POST ['jns_aset'];
          $split =explode("#", $jns_aset);
          $jns_aset=$split[0];
          $ket_aset         = $split[1];
          $jns_pro          = $_POST ['JNSPRO'];
          $split =explode("#", $jns_pro);
          $jns_pro=$split[0];
          $ket_pro         = $split[1];
          $sutri_aset       = $_POST ['sutri_aset'];
          $nm_aset          = $_POST ['nm_aset'];
          $id_aset          = $_POST ['id_aset'];
          $kepemilikan      = $_POST ['kepemilikan'];
          $tglawal_aset     = $_POST ['tglawal_aset'];
          $tgljth_aset      = $_POST ['tgljth_aset'];
          $alamat_aset      = $_POST ['alamat_aset'];
          $map_lok          = $_POST ['map_lok'];
          $judul_aset       = $_POST ['judul_aset'];
          $nilai_jual       = $_POST ['nilai_jual'];
          $sutri_aset       = $_POST ['sutri_aset'];
          $memo_aset        = $_POST ['memo_aset'];
          $userid           = $_SESSION ["userId"];  
          $memo_jual        = '0';
          $useroto          = '0';
          $oto_stat         = '0';
          $pil              = '1';
          $hasil = $API -> input_aset($kode_kantor, $no_aset, $rekening, $jns_aset, $ket_aset, $jns_pro, $ket_pro, $nm_aset, $sutri_aset, $alamat_aset, $id_aset, $judul_aset, $memo_aset ,$kepemilikan , $tglawal_aset, $tgljth_aset, $map_lok, $nilai_jual, $memo_jual, $userid, $oto_stat, $useroto, $pil);
        
        if ($hasil['responseCode'] == '00') {
            echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: '".$hasil['data']."'
                    }).then(() => {
                        window.location = 'as_peminjam?page=input&nr=".base64_encode($rek)."';
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
                        window.location = 'f_input_asset?page=input&nr=".base64_encode($rek)."';
                    });
                });
            </script>";
        }
    }
       
       include "timeout.php";
       include "include/header.php";
?>

<style >
    #JNSPRO{
        height: 34px;
        width: 100%;

    }
    #button{
        margin-right: 10px; width: 80%; color: #483838;
    }
</style>

<body class="theme-green">
    <!-- Top Bar -->
    <?php include "include/navbar.php"; ?>
    <!-- #Top Bar -->
    <?php $page = 'aset'; include "include/sidebar_ekspeminjam.php"; ?>
    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="ekspeminjam"><i class="material-icons">widgets</i> Data Eks Peminjam</a></li>
                <li><a href="as_peminjam"><i class="material-icons">library_books</i> Data Aset</a></li>
                <li><a><i class="material-icons">folder</i>Input Asset</a></li>
            </ol>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <center><h1><b>FORM INPUT DATA ASSET</b></h1>
                            <b><p>Pastikan data yang diinput sudah benar , periksa kembali sebelum data di simpan ke server</p></b></center>
                            <div class="row clearfix">
                                    <div class="col-sm-3">
                                    <button class="btn btn-warning waves-effect" id="button" value="back" onclick="history.back()" ><b>KEMBALI</b></button> 
                                </div>
                            </div> 
                        </div>
                        <div class="body" id="data_property">
                         <form action="" id="aset" method="POST">
                         <input type="hidden" class="form-control" name="aset">
                        <div class="row clearfix">
                             <div class="col-sm-6">
                                <label class="form-label">Norek Pinjaman</label>
                                <div class="form-line">
                                
                                    <input type="text" class="form-control" name="rekening" id="rekening"  value="<?php echo $pars['data'][0]['rekening']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Nama Pinjaman</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" id="nama" value="<?php echo $pars['data'][0]['ket_rek']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                                        <div class="form-line">
                                            <input type="hidden" id="kode_kantor" name="kode_kantor" value="<?php echo $pars['data'][0]['kode_kantor']; ?>" readonly>
                                        </div>
                            <div class="col-sm-6">
                                <label class="form-label">Kantor</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="kantor" id="kantor" value="<?php echo $pars['data'][0]['kantor']; ?>" readonly >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Judul Asset</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="judul_aset"  oninput="convertToUppercase(this)" required>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                                <div class="col-sm-6">
                                <label class="form-label">Bukti Asset</label>
                                     <select name="jns_aset" id="bukti" class="form-control" required >
                                        <option value="" >-Pilih Jenis Asset-</option>
                                        <?php
                                        echo $jns_aset;
                                        $pars=json_decode($jns_aset,true);
                                        $size=count($pars['data']);
                                                       
                                        for($x=0;$x<$size;$x++){
                                        ?>   
                                            <option value="<?php echo $pars['data'][$x]['JNS_ASET']."#".$pars['data'][$x]['KET_ASET'] ?>"><?php echo $pars['data'][$x]['KET_ASET']?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                <label class="form-label">Jenis Property</label>
                                <br>
                                   <select name="JNSPRO" id="JNSPRO" >
                                    <option value="" >-Pilih Jenis Property-</option>
                                    </select>
                                </div>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <label class="form-label">Deskripsi Asset</label>
                                    <textarea name="memo_aset" id="memo_aset" cols="30" rows="6" class="form-control no-resize"  oninput="convertToUppercase(this)" required></textarea>
                                    </div>
                            </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <label class="form-label">No Asset</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="no_aset" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-line">
                                    <input type="hidden" class="form-control" name="ket_pro">
                                </div>
                            </div>
                        </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="form-label">Tgl. Sertifikat</label>
                                            <div class="form-line">
                                                <input type="date" class="form-control" name="tglawal_aset" required >
                                            </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Tgl. Sertifikat Jatuh Tempo</label>
                                        <div class="form-line">
                                            <input type="date" class="form-control" name="tgljth_aset" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="form-label">Nama Pemilik Sertifikat</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="nm_aset"  oninput="convertToUppercase(this)" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Kepemilikan</label>
                                            <select name="kepemilikan" class="form-control" >
                                                <option value="1" >-Pilih Jenis Kepemilikan-</option>      
                                                <option value="MILIK SENDIRI">Milik Sendiri</option>
                                                <option value="MILIK ORANG TUA">Milik Orang Tua</option>
                                                <option value="MILIK ANAK KANDUNG">Milik Anak Kandung</option>
                                                <option value="PIHAK KETIGA">Pihak Ketiga</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="form-label">No Sertifikat </label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="id_aset" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Nama AYDA (Beserta Nama Suami/Istri)</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="sutri_aset"  oninput="convertToUppercase(this)" required>
                                            </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <label class="form-label">Alamat Lengkap Lokasi</label>
                                            <div class="form-line">
                                                <textarea name="alamat_aset"  cols="30" rows="2" class="form-control no-resize"  oninput="convertToUppercase(this)" required></textarea>
                                            </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="form-label">URL</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="map_lok">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Taksasi Property</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control"  id="nilai_jual" required>
                                                <input type="hidden" name="nilai_jual" id="harga2">
                                            </div>
                                     </div>
                                </div>
                                
                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                        <button class="btn btn-warning waves-effect" name="submit" type="submit"><b>SIMPAN</b></button> 
                                    </div>
                                </div>
                                </div>
                        </div>
                    </div>
                    </form> 
                </section>

                <script src="assets/js/app.js"></script>
                <script src="assets/js/jquery-3.6.1.min.js"></script> 
                <script src="assets/js/jquery-2.1.3.min.js"></script>
                <script src="assets/js/jquery-1.9.1.js"></script>
				<script src="assets/js/jquery-maskmoney3.0.2.min.js"></script>
                <script src="assets/js/sweetalert2.min.js" ></script>

                <script>
               $(document).ready(function(){
                    $("#bukti").on('change', function postinput(){
                        var isipilih = $(this).val(); // this.value
                        var split = isipilih.split('#');
                        isipilih =split[0];
                        $.ajax({ 
                        url: 'autofill_bukti.php',
                        data: { jnsaset: isipilih },
                        type: 'post'
                        }).done(function(respon) {
                            obj = JSON.parse(respon);
                            var size=obj.length;
                            $('#JNSPRO').html(respon);
                            $('#JNSPRO').append('<option value="" >-Pilih Jenis Property-</option>')
                            console.log('HABIS DIRESET!!')
                            for(var x=0;x<size;x++){
                                console.log('Done: '+obj[x].JNS_PRO+"#"+obj[x].KET_PRO);
                                $('#JNSPRO').append("<option value='"+obj[x].JNS_PRO+"#"+obj[x].KET_PRO+"'>"+obj[x].KET_PRO+"</option>")
                                
                            }  
                            }).fail(function() {
                            console.log('Failed');
                        });
                    });
                });

                
                    // TAKSASI PROPERTYYY------------------->
                        $(document).ready(function(){
                        $("#nilai_jual").maskMoney({prefix: 'Rp. ', 
                                                    thousands: '.', 
                                                    decimal: ',',
                                                    precision: 0
                            });
                        });

                        $("#nilai_jual").keyup(function() {
                            var clone = $(this).val();
                            var cloned = clone.replace(/[A-Za-z$. ,-]/g, "")

                            $("#harga2").val(cloned);
                            console.log('#harga2');
                        });

                 function convertToUppercase(input) {
                    input.value = input.value.toUpperCase();
                }
                
                </script>
</body>
</html>
