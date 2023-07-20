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
    $rek = base64_decode($_GET['nr']);
    $nr = $API -> editnasabah($rek);
    // die($nr);
    $pars=json_decode($nr,true);
    include "include/function_rupiah.php";

    if (isset($_POST['update'])) {
        $rekening    = $_POST['rekening'];
        $kode_rek    = $_POST['kode_rek'];
        $ket_rek     = $_POST['ket_rek'];
        $kode_kantor = $_POST['kode_kantor'];
        $nama        = $_POST['nama'];
        $alamat      = $_POST['alamat'];
        $plafond     = filter_var($_POST['plafond'], FILTER_SANITIZE_NUMBER_INT);
        $saldo       = filter_var($_POST['saldo'],FILTER_SANITIZE_NUMBER_INT);
        $tgl_akad    = $_POST['tgl_akad'];
        $tgl_jth     = $_POST['tgl_jth'];
        $tgk_bunga   = filter_var($_POST['tgk_bunga'], FILTER_SANITIZE_NUMBER_INT);
        $jml_aset    = $_POST['jml_aset'];
        $tgk_lain    = filter_var($_POST['tgk_lain'], FILTER_SANITIZE_NUMBER_INT);
        $ket_tgklain = filter_var($_POST['ket_tgklain'],FILTER_SANITIZE_NUMBER_INT);
        $tgk_denda   =filter_var($_POST['TGK_DENDA'], FILTER_SANITIZE_NUMBER_INT);
        $asal_perolehan    = $_POST ['asal_perolehan'];
        $tgl_perolehan    = $_POST ['tgl_perolehan'];
        $userid     = $_SESSION["userId"];
        $status     = '0';
        $useroto    = '0';
        $pil        = '2';
        $hasil = $API -> f_eks_peminjam($kode_kantor,$nama,$kode_rek,$alamat,$rekening,$ket_rek,$plafond,$saldo,$tgl_akad,$tgl_jth,$tgk_bunga,$tgk_denda,$tgk_lain,$ket_tgklain,$status,$userid,$useroto,$pil,$jml_aset,$asal_perolehan,$tgl_perolehan);
        
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
        } else {
            
            echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: ' ".$hasil['data']."'
                    }).then(() => {
                        window.location = 'e_ekspeminjam?page=edit&nr=".base64_encode($rek)."';
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
    <?php $page = 'ekspeminjam'; include "include/sidebar_ekspeminjam.php"; ?>

     <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="ekspeminjam"><i class="material-icons">widgets</i> Data Eks Peminjam</a></li>
                <li><a><i class="material-icons">library_books</i> Form Edit Eks Peminjam</a></li>
            </ol>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <center><h1><b>FORM EDIT DATA EKS PEMINJAM</b></h1></center>
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
                                            <label >Norek Pinjaman</label>
                                            <input type="text" class="form-control" name="rekening" id="rekening"  readonly required  value="<?php echo $pars['data'][0]['rekening']; ?>">
                                        </div>
                                    </div>
                                     
                                        <div class="form-line">
                                            <input type="hidden" id="kode_rek" name="kode_rek" value="<?php echo $pars['data'][0]['kode_rek']; ?>">
                                        
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Jenis Pinjaman</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="ket_rek" id="ket_rek" value="<?php echo $pars['data'][0]['ket_rek']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                        <div class="form-line">
                                            <input type="hidden" id="kode_kantor" name="kode_kantor" value="<?php echo $pars['data'][0]['kode_kantor']; ?>">
                                        </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Kantor Cabang</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="kantor" value="<?php echo $pars['data'][0]['kantor']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="form-label">Nama Eks Peminjam</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $pars['data'][0]['nama']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <label class="form-label">Alamat</label>
                                        <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control no-resize"><?php echo $pars['data'][0]['alamat']; ?></textarea>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="form-label">Plafond Awal</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="plafond" id="decimal" value="<?php echo rupiah($pars['data'][0]['plafond']); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Outstanding</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="saldo" name="saldo" value="<?php echo rupiah($pars['data'][0]['saldo']); ?>" >
                                            <input type="hidden" class="form-control"  id="saldod" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="form-label">Tanggal Akad</label>
                                        <div class="form-line">
                                            <input type="date" data-date="" data-date-format="DD MMMM YYYY" class="form-control" name="tgl_akad" id="tgl_akad" 
                                            value="<?php echo $pars['data'][0]['tgl_akad']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Tanggal jatuh Tempo</label>
                                        <div class="form-line">
                                            <input type="date" data-date="" data-date-format="DD MMMM YYYY" class="form-control" name="tgl_jth" id="tgl_jth" value="<?php echo $pars['data'][0]['tgl_jth']; ?>">
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label class="form-label">Bunga Tertunggak</label>
                                    <div class="form-line">
                                         <div class="form-line">
                                            <input type="text" class="form-control" name="tgk_bunga"  id="bunga_tgk" required value="<?php echo rupiah($pars['data'][0]['tgk_bunga']); ?>">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Bunga Grace Period</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="tgk_lain" id="tgk_lain" required value="<?php echo rupiah($pars['data'][0]['TGK_LAIN']); ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                        <label class="form-label">Denda Keterlambatan</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="tgk_denda" name="TGK_DENDA" required  value="<?php echo rupiah($pars['data'][0]['TGK_DENDA']); ?>">
                                            
                                        </div>
                                    </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Tunggakan Lain - Lain</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="ket_lain" name="ket_tgklain" required value="<?php echo rupiah($pars['data'][0]['KET_TGKLAIN']); ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                    <div class="col-sm-2">
                                        <label class="form-label">Jumlah Asset</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <input type="" class="form-control" name="jml_aset" id="jml_aset" required value="<?php echo $pars['data'][0]['jml_aset']; ?>" 
                                                style="width: 50%; text-align: center;" >
                                                <span class="input-group-text" style="padding: 6px;"><b>Unit</b></span>
                                            </div>
                                        </div>
                                       
                                    </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label class="form-label">Tanggal Perolehan</label>
                                    <div class="form-line">
                                        <input type="date" data-date="" data-date-format="DD MMMM YYYY" class="form-control" name="tgl_perolehan" id="tgl_perolehan" required value="<?php echo $pars['data'][0]['tgl_perolehan']; ?>" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label ">Asal Perolehan</label>
                                    <select class="form-control show-tick" name="asal_perolehan" >
                                    <?php
                                        $selectedAsal = $pars['data'][0]['asal_perolehan'];
                                        $statusOptions = array(
                                            "LELANG",
                                            "PENYERAHAN",
                                            "SITA JAMINAN"
                                        );
                                        foreach ($statusOptions as $value) {
                                            $selected = ($selectedAsal == $value) ? 'selected' : '';
                                            echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div> 
                                <button class="btn btn-warning waves-effect" name="update" type="submit"><b>SIMPAN</b></button> 
                               </form>     
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </section>  
</body>
</html>


    <script src="assets/js/jquery-3.6.1.min.js"></script>
    <script src="assets/js/jquery-2.1.3.min.js"></script>
    <script src="assets/js/jquery-1.9.1.js"></script>
    <script src="assets/js/moment-2.10.3-moment.min.js"></script>
    <script src="assets/js/jquery-maskmoney3.0.2.min.js"></script>
    <script src="assets/js/sweetalert2.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
          var input = $('#decimal');
          var currentValue = input.val();
          var isValueChanged = false;

          input.on('input', function() {
            isValueChanged = true;
          });

          // Simpan nilai input saat ini sebagai 0 jika tidak ada perubahan yang terjadi setelah diklik
          input.on('blur', function() {
            if (!isValueChanged) {
              input.val('0');
            }
          });

          // Terapkan maskMoney hanya jika nilai saat ini tidak sama dengan nilai yang tersimpan
          if (currentValue === '0' && !isValueChanged) {
            input.maskMoney({
              prefix: 'Rp. ',
              thousands: '.',
              decimal: ','
            });
          } else if (currentValue === '0') {
            // Jika nilai saat ini adalah 0, nilai input tetap tidak berubah
            input.val('0');
          }
        });

        $(document).ready(function() {
          var input = $('#saldo');
          var currentValue = input.val();
          var isValueChanged = false;

          input.on('input', function() {
            isValueChanged = true;
          });

          // Simpan nilai input saat ini sebagai 0 jika tidak ada perubahan yang terjadi setelah diklik
          input.on('blur', function() {
            if (!isValueChanged) {
              input.val('0');
            }
          });

          // Terapkan maskMoney hanya jika nilai saat ini tidak sama dengan nilai yang tersimpan
          if (currentValue === '0' && !isValueChanged) {
            input.maskMoney({
              prefix: 'Rp. ',
              thousands: '.',
              decimal: ','
            });
          } else if (currentValue === '0') {
            // Jika nilai saat ini adalah 0, nilai input tetap tidak berubah
            input.val('0');
          }
        });

        $(document).ready(function() {
          var input = $('#tgk_bunga');
          var currentValue = input.val();
          var isValueChanged = false;

          input.on('input', function() {
            isValueChanged = true;
          });

          // Simpan nilai input saat ini sebagai 0 jika tidak ada perubahan yang terjadi setelah diklik
          input.on('blur', function() {
            if (!isValueChanged) {
              input.val('0');
            } else if (currentValue === '0') {
            // Jika nilai saat ini adalah 0, nilai input tetap tidak berubah
            input.val('0');
          }
          });

          // Terapkan maskMoney hanya jika nilai saat ini tidak sama dengan nilai yang tersimpan
          if (currentValue === '0' && !isValueChanged) {
            input.maskMoney({
              prefix: 'Rp. ',
              thousands: '.',
              decimal: ','
            });
          } else if (currentValue === '0') {
            // Jika nilai saat ini adalah 0, nilai input tetap tidak berubah
            input.val('0');
          }
        });

        $(document).ready(function() {
          var input = $('#tgk_denda');
          var currentValue = input.val();
          var isValueChanged = false;

          input.on('input', function() {
            isValueChanged = true;
          });

          // Simpan nilai input saat ini sebagai 0 jika tidak ada perubahan yang terjadi setelah diklik
          input.on('blur', function() {
            if (!isValueChanged) {
              input.val('0');
            } else if (currentValue === '0') {
            // Jika nilai saat ini adalah 0, nilai input tetap tidak berubah
            input.val('0');
          }
          });

          // Terapkan maskMoney hanya jika nilai saat ini tidak sama dengan nilai yang tersimpan
          if (currentValue === '0' && !isValueChanged) {
            input.maskMoney({
              prefix: 'Rp. ',
              thousands: '.',
              decimal: ','
            });
          } else if (currentValue === '0') {
            // Jika nilai saat ini adalah 0, nilai input tetap tidak berubah
            input.val('0');
          }
        });

        $(document).ready(function() {
          var input = $('#tgk_lain');
          var currentValue = input.val();
          var isValueChanged = false;

          input.on('input', function() {
            isValueChanged = true;
          });

          // Simpan nilai input saat ini sebagai 0 jika tidak ada perubahan yang terjadi setelah diklik
          input.on('blur', function() {
            if (!isValueChanged) {
              input.val('0');
            } else if (currentValue === '0') {
            // Jika nilai saat ini adalah 0, nilai input tetap tidak berubah
            input.val('0');
          }
          });

          // Terapkan maskMoney hanya jika nilai saat ini tidak sama dengan nilai yang tersimpan
          if (currentValue === '0' && !isValueChanged) {
            input.maskMoney({
              prefix: 'Rp. ',
              thousands: '.',
              decimal: ','
            });
          }
        });


        $(document).ready(function() {
          var input = $('#ket_lain');
          var currentValue = input.val();
          var isValueChanged = false;

          input.on('input', function() {
            isValueChanged = true;
          });

          // Simpan nilai input saat ini sebagai 0 jika tidak ada perubahan yang terjadi setelah diklik
          input.on('blur', function() {
            if (!isValueChanged) {
              input.val('0');
            }
          });

          // Terapkan maskMoney hanya jika nilai saat ini tidak sama dengan nilai yang tersimpan
          if (currentValue !== '0' && !isValueChanged) {
            input.maskMoney({
              prefix: 'Rp. ',
              thousands: '.',
              decimal: ','
            });
          } else if (currentValue === '0') {
            // Jika nilai saat ini adalah 0, nilai input tetap tidak berubah
            input.val('0');
          }
        });





    $("input").on("change", function() {
    this.setAttribute(
        "data-date",
        moment(this.value, "YYYY-MM-DD")
        .format( this.getAttribute("data-date-format") )
    )
}).trigger("change")       
</script>
