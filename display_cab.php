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
    $display = $API->display('');
        
    
    include "include/function_rupiah.php";
    include "timeout.php";
    include "include/header.php";
?>
<head>
    <style>
        #searchInput{
            padding: 3px;
        }
    </style>
</head>
<body class="theme-green" onload="myFunction()" style="margin:0;" >
    <!-- Top Bar -->
    <?php include "include/navbar.php"; ?>
    <!-- #Top Bar -->
    <?php $page = 'display' ; include "include/sidebar.php"; ?>

     <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a><i class="material-icons">insert_photo</i>Display</a></li>
            </ol>
            <div id="loader" class="ring" style="display: flex;justify-content: center;align-items: center;height: 100vh;">
                <span></span>
            </div>
        <div style="display:none;" id="myDiv" class="animate-bottom">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><center>DAFTAR DISPLAY ASSET</center></h2>
                            <div class="row clearfix">
                                    <div class="col-sm-3">
                                    
                                </div>
                            </div> 
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="dataTable">
								<thead>
									<tr>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
                                        $pars1 = json_decode($display, true);
                                        if (isset($pars1['data']) && is_array($pars1['data'])) {
                                            $assets = $pars1['data'];
                                            $assetsCount = count($assets);
                                            $z = 1;
                                            $foundData = false; // Flag to track if any data is found
                                            
                                            foreach ($assets as $key => $value) {
                                                if ($z == 1 || ($z - 1) % 3 == 0) {
                                                    echo "<tr>";
                                                }
                                                
                                                $np = $API->property($key, 'harga penawaran');
                                                $na = $API->editasset($key);
                                                $nparray = json_decode($np, true);
                                                $naarray = json_decode($na, true);
                                                $nilai_penawaran = isset($nparray['data'][0]['NILAI']) ? $nparray['data'][0]['NILAI'] : "";
                                                
                                                if ($nparray && $naarray && isset($naarray['data'][0]['STATUS'])) {
                                                    $status = $naarray['data'][0]['STATUS'];
                                                    
                                                    if ($status == 2) {
                                                        $status = "<span class='badge bg-green'><b>LELANG</b></span>";
                                                    } else if ($status == 4) {
                                                        $status = "<span class='badge bg-red'><b>TERJUAL</b></span>";
                                                    } else if ($status == 5) {
                                                        $status = "<span class='badge bg-gery'><b>DISEWAKAN</b></span>";
                                                    } else {
                                                        continue; // Skip the entry if the status is not 2, 4, or 5
                                                    }
                                                    
                                                    if (isset($naarray['data'])) {
                                                        $naData = $naarray['data'];
                                                        $naDataCount = count($naData);
                                                        
                                                        for ($x = 0; $x < $naDataCount; $x++) {
                                                            if (isset($nparray['data'][0]['NILAI']) && isset($naarray['data'][0]['STATUS'])) {
                                                                $KET_PRO = isset($naarray['data'][$x]['KET_PRO']) ? $naarray['data'][$x]['KET_PRO'] : "";
                                                                $ALAMAT_ASET = isset($naarray['data'][$x]['ALAMAT_ASET']) ? $naarray['data'][$x]['ALAMAT_ASET'] : "";
                                                                $memo_aset = isset($naarray['data'][$x]['MEMO_ASET']) ? $naarray['data'][$x]['MEMO_ASET'] : "";
                                                                
                                                                if (strlen($ALAMAT_ASET) > 45) {
                                                                    $ALAMAT_ASET = substr($ALAMAT_ASET, 0, 60) . "...";
                                                                }
                                                                if (strlen($memo_aset) > 40) {
                                                                    $memo_aset = substr($memo_aset, 0, 60) . "...";
                                                                } else {
                                                                    $memo_aset = substr($memo_aset, 0, 50) . "<br>";
                                                                }
                                                                
                                                                $url = isset($naarray['data'][$x]['MAP_LOK']) ? $naarray['data'][$x]['MAP_LOK'] : "";
                                                                
                                                                echo '<td width="350">
                                                                        <div class="card mr-2 ml-2">
                                                                            <img src="' . $value[0]['LINK'] . '" width="300px" height="200px" />
                                                                            <div class="card body" style="max-height:270px">
                                                                                <p style="text-align: left;">' . $KET_PRO . '</p>
                                                                                <p style="text-align: left;">' . $status . '</p>
                                                                                <p><font color="#FFDE00">' . rupiah($nilai_penawaran) . '</font></p>
                                                                                <p style="text-align: justify;">' . $memo_aset . '</p>
                                                                                <p style="text-align: justify;">' . $ALAMAT_ASET . '</p>
                                                                                <hr style="margin-top:2px;margin-bottom:5px;">
                                                                                <div class="row clearfix" style="text-align:center">
                                                                                    <div class="col-sm-2">
                                                                                        <a href="dis_asset?page=display&na=' . $key . '"><i class="material-icons" style="margin-left:5px">info</i><p>Detail</p></a>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <a href="https://api.whatsapp.com/send?phone=6285963052212&text=Asset:%20' . $KET_PRO . ',%20Alamat:%20' . $ALAMAT_ASET . '"><i class="material-icons" style="margin-left:6px"><font color="#54B435">phone</font></i><p>Kontak</p></a>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <a href="' . $url . '"><i class="material-icons"><font color="#CF0A0A" style="margin-left:6px">location_on</font></i><p>Lokasi</p></a>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <a href="cetak_dis?page=cetak&na=' . $key . '"><i class="material-icons" style="margin-left:4px"><font color="#4D455D">local_printshop</font></i><p>Print</p></a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>';
                                                                
                                                                $foundData = true; // Set the flag to true as data is found
                                                            }
                                                        }
                                                    }
                                                }
                                                
                                                if ($z % 3 == 0 || $z == $assetsCount) {
                                                    echo "</tr>";
                                                }
                                                $z++;
                                            }
                                            
                                            if (!$foundData) {
                                                echo '<tr><td colspan="8" style="text-align: center"><h5>Belum ada data yang sudah di Otorisasi</h5></td></tr>';
                                            } else {
                                                if (($z + 1) % 3 == 0) {
                                                    echo '<td></td>';
                                                    echo '<td></td>';
                                                    echo "</tr>";
                                                } else if ($z % 3 == 0) {
                                                    echo '<td></td>';
                                                    echo "</tr>";
                                                }
                                                
                                                if (($z + 1) % 3 == 0) {
                                                    echo '<td></td>';
                                                    echo '<td></td>';
                                                    echo "</tr>";
                                                } else if ($z % 3 == 0) {
                                                    echo '<td></td>';
                                                    echo "</tr>";
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
    </section>
</body>
</html>

<script>
var id = document.getElementById("loader");
var Loading = document.createElement("div");

Loading.textContent = "Loading";
Loading.style.fontSize = "28px";
id.appendChild(Loading);

function myFunction() {
  var isConnected = navigator.onLine;

  if (isConnected) {
    var loaded = setInterval(() => {
      Loading.textContent = Loading.textContent + ".";
    }, 1000);

    loaded = setTimeout(showPage, 4000);
  } else {
    
    Loading.textContent = "No internet connection.";
    setTimeout(showPage, 2000);
  }
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>


