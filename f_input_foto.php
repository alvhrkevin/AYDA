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
  include "timeout.php";
  include "include/header.php";
?>

<style >
   .btn{
        margin-right: 10px; width: 20%; color: #483838; 
    }

  #display-image{
  width: 400px;
  height: 225px;
  border: 1px solid black;
  background-position: center;
  background-size: cover;
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
                <li><a href="as_peminjam"><i class="material-icons">library_books</i> Data Aset</a></li>
                <li><a><i class="material-icons">insert_photo</i>Data Foto</a></li>
                <li><a href="f_input_foto.php"><i class="material-icons">add_a_photo</i>Input Foto</a></li>
            </ol>
            <div class="body">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                       <div class="header">
                            <center><h1><b>FORM INPUT FOTO</b></h1>
                            <b><p>Pastikan data yang diinput sudah benar , periksa kembali sebelum data di simpan ke server</p></b></center>
                            <div class="row clearfix">
                                    <div class="col-sm-3">
                                    <button class="btn btn-warning waves-effect" id="button" value="back" onclick="history.back()" ><b>KEMBALI</b></button> 
                                </div>
                            </div> 
                        </div>
                         <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                          </div>
                              <div class="body">
                                <div class="row clearfix">
                                  <div class="col-xs-8 col-xs-offset-2 well" >
                                    <form action="upload" method="POST" enctype="multipart/form-data">
                                      <div class="row clearfix">
                                        <?php 
                                          $no_aset = base64_decode($_GET['na']);
                                          $no_aset2 = explode(".", $no_aset);
                                          $na = $API -> editasset($no_aset);
                                          $pars=json_decode($na,true); ?>
                                          <div class="col-sm-12">
                                            <label class="form-label">No Asset</label>
                                              <div class="form-line">
                                                <input type="text" class="form-control" name="no_aset" readonly value="<?php echo $pars['data'][0]['NO_ASET']; ?>">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row clearfix">
                                          <div class="col-sm-12">
                                              <label class="form-label">Pilih Gambar</label>
                                                  <div class="form-line">
                                                      <input class="form-control" type="file" name="url" id="url" placeholder="URL..." required onchange="javascript:upload(this,'preview')">
                                                  </div>
                                          </div>
                                      </div>
                                      <div id="display-image"></div>
                                      <br>
                                      <div class="row clearfix">
                                          <div class="col-sm-12">
                                                  <div class="form-line">
                                                      <input type="text" class="form-control" id="link" name="link"  >
                                                  </div>
                                          </div>
                                      </div>
                                  
                                      <div class="row clearfix">
                                          <div class="col-sm-12">
                                              <label class="form-label">Keterangan</label>
                                                  <div class="form-line">
                                                    <input type="text" placeholder="Keterangan" name="keterangan" id="filename" class="form-control" required />
                                                  </div>
                                          </div>
                                      </div>
                                      <div class="row clearfix">
                                        <div class="col-sm-3">
                                          <p><button class="btn btn-warning waves-effect" name="submit" type="submit"><b>SIMPAN</b></button><b>Ekstensi file *.jpg | file tidak boleh panjang dan spasi (spasi diganti [ _ ] )</b></p> 
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
function upload(userfile,idpreview) {
  var input = document.getElementById('url');
  // var link  = "http://jasakoe.kospinjasa.com:3333/ccc/FOTO_C3/";
   var link  = "https://ayda.kospinjasa.com/ccc/FOTO_C3/";
  //var link  = "http://localhost:8080/ccc/FOTO_C3/";
  var output = document.getElementById('link');
  
  var gb = userfile.files;

  for (var i = 0; i < input.files.length; ++i) {
    output.value = link+input.files.item(i).name; 
  }
  
  for (var i = 0; i < gb.length; i++)
  {
    var gbPreview = gb[i];
    var imageType = /image.*/;
    console.log(imageType);
    var preview=document.getElementById(idpreview);
    var reader = new FileReader();
    if (gbPreview.type.match(imageType))
    {
      //jika tipe data sesuai
      preview.file = gbPreview;
      reader.onload = (function(element)
      {
        return function(e)
        {
          element.src = e.target.result;
        };
      })(preview);
      //membaca data URL gambar
      reader.readAsDataURL(gbPreview);
    }
      else
      {
        //jika tipe data tidak sesuai
        alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
      }
  }
}

const image_input = document.querySelector("#url");
image_input.addEventListener("change", function() {
  const reader = new FileReader();
  reader.addEventListener("load", () => {
    const uploaded_image = reader.result;
    document.querySelector("#display-image").style.backgroundImage = `url(${uploaded_image})`;
  });
  reader.readAsDataURL(this.files[0]);
}); 

function getFilePath(){
     $('input[type=file]').change(function () {
         var filePath=$('#fileUpload').val(); 
     });
}
</script>


