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
    $userid = $_POST['userid'];
    $password = md5($_POST['password']);
    $nama = $_POST['nama'];
    $wil = $_POST['wil'];
    $menu1 = $_POST['menu1'];
    $menu2 = $_POST['menu2'];
    $menu3 = $_POST['menu3'];
    $status = '0';
    $ovdid = $_SESSION["userId"];
    
    $hasil = $API->input_user($userid, $password, $nama, $wil, $status, $menu1, $menu2, $menu3, $ovdid);
    
    if ($hasil['responseCode'] == 00) {
        echo "<script src='assets/js/sweetalert2.min.js'></script>";
        echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses, " . $hasil['data'] . "',
                        showConfirmButton: false,
                        timer: 5000
                    }).then(() => {
                        window.location='./data_user';
                    });
                });
            </script>";
    } else {
        echo "<script src='assets/js/sweetalert2.min.js'></script>";
        echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: '" . $hasil['data'] . "',
                        showConfirmButton: false,
                        timer: 5000
                    }).then(() => {
                        window.location='./register';
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
    <?php $page = 'register'; include "include/sidebar_edituser.php"; ?>

    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="user"><i class="material-icons">widgets</i> Data User</a></li>
                <li><a><i class="material-icons">person</i>Pendaftaran Akun</a></li>    
            </ol>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <center><h1><b>FORM PENDAFTARAN AKUN</b></h1>
                            <b><p>Pastikan data yang diinput sudah benar , periksa kembali sebelum data di simpan ke server</p></b></center>
                            <div class="row clearfix">
                                    <div class="col-sm-3">
                                      
                                </div>
                            </div> 
                        </div>
                        <div class="body" id="data_property">
                            <form action="" id="aset" method="POST">
                            <input type="hidden" class="form-control" name="aset">
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label class="form-label">User Id</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="userid" maxlength="6"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required="TIDAK BOLEH KOSONG !!">
                                        </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label class="form-label">Nama </label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nama" oninput="convertToUppercase(this)" required="TIDAK BOLEH KOSONG !!"  >
                                    </div>
                            </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label class="form-label">Kantor</label>
                                        <select name="wil" class="form-control show-tick" required >
                                            <option value="" >-Pilih Lokasi Kantor-</option>
                                            <?php
                                            $cekwil = $API->cekwil('');
                                            $pars=json_decode($cekwil,true);
                                            
                                            foreach ($pars['data'] as $key => $value) {
                                            echo '<option value="'.$value['wil_code'].'" >'.$value['wil_ket'].'</option>';
                                            }                                        
                                            ?>    
                                        </select>
                                </div>    
                            </div>
                            
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label class="form-label"> Password</label>
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="password" minlength="6" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Harus mengandung setidaknya satu angka dan satu huruf besar dan kecil, dan setidaknya 6 karakter atau lebih" required >
                                        </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label class="form-label">Menu</label>
                                    <div class="form-group options">
                                        <input  type="hidden" name="menu1" value="0" >
                                        <input  type="checkbox" name="menu1" value="1" id="menu1" class="sev_check" required>
                                        <label class="form-check-label" for="menu1">Admin</label>
                                   
                                        <input  type="hidden" name="menu2" value="0" >
                                        <input  type="checkbox" name="menu2" value="1" id="menu2" class="sev_check" required>
                                        <label class="form-check-label" for="menu2">Pejabat</label>
                                   
                                        <input  type="hidden" name="menu3" value="0" >
                                        <input  type="checkbox" name="menu3" value="1" id="menu3" class="sev_check" required>
                                        <label class="form-check-label" for="menu3">Cabang</label>
                                    </div>
                                </div>
                            </div>     
                        <div class="row clearfix">
                            <div class="col-sm-3">
                                <button class="btn btn-warning waves-effect" name="submit" type="submit" ><b>SIMPAN</b></button> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>                
    </section>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $('.sev_check').each(function() {
    $(this).addClass('unselected');
  });
  $('.sev_check').on('click', function() {
    $(this).toggleClass('unselected');
    $(this).toggleClass('selected');
    $('.sev_check').not(this).prop('checked', false);
    $('.sev_check').not(this).removeClass('selected');
    $('.sev_check').not(this).addClass('unselected');
  });
});

$(function(){
    var requiredCheckboxes = $('.options :checkbox[required]');
    requiredCheckboxes.change(function(){
        if(requiredCheckboxes.is(':checked')) {
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });
});

function convertToUppercase(input) {
    input.value = input.value.toUpperCase();
}
</script>