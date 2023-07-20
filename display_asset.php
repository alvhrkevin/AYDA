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
    $noaset = $_GET['na'];
    $API = new API_functions();
    $cekfoto = $API->cekfoto($noaset);
    include "include/function_rupiah.php";
    include "timeout.php";
    include "include/header.php";
?>

<head>
    <link rel="stylesheet"  href="assets/css/print.css" media="print">
</head>

<body class="theme-green" >
    <!-- Top Bar -->
    <?php include "include/navbar.php"; ?>
    <!-- #Top Bar -->
    
    <?php $page = 'display' ; include "include/sidebar_display.php";  ?>
    
   
<div class="container">
    <div class="image-container">
    <?php
    $pars=json_decode($cekfoto,true);
    $size=count($pars['data']);
    $z=0;
    foreach ($pars['data'] as $key => $value) {
    echo '<div class="card body"<p><b><center>'.$value['KETERANGAN'].'</center></b></p><div class="image"><img src="'.$value['LINK'].'"></div></div>';
    $z++;
}

?>
    </div>

    <div class="popup-image">
        <span>&times;</span>
        <img src="'.$value[0]['LINK'].'">
    </div>

    <div class="card">
        <div class="header">
            <h2><center>Deskripsi Property</center></h2>
            <div class="text-right">
            <!-- <button onclick="window.print();" class="btn btn-primary" id="print-btn" ><i class="material-icons">local_printshop</i></button> -->
        </div>
        </div>
        <div class="body"> 
            <?php    
                $aset = $API->editasset($noaset); 
                $pars=json_decode($aset,true);
                $size=count($pars['data']);
                foreach ($pars['data'] as $key => $value){
                    
                    $np = $API -> property($noaset,'harga penawaran');
                    $nparray = json_decode($np,true);
                    $nilai_penawaran = $nparray['data'][0]['NILAI'];

                    if(isset($pars['data'])){ 
                    $size=count($pars['data']);                    
                    for($x=0;$x<$size;$x++){
                                                
                        $KET_PRO=$pars['data'][$x]['KET_PRO'];
                        $ALAMAT_ASET=$pars['data'][$x]['ALAMAT_ASET'];

                        $memo_aset=$pars['data'][$x]['MEMO_ASET'];

                                          
                        echo '<div class="card body" ><p text-align="left">'.rupiah($nilai_penawaran).'</p><p text-align="left">'.$KET_PRO.'</p><p text-align="left">'.$memo_aset.'</p><p text-align="left">'.$ALAMAT_ASET.'</p>';
                        
                        
                        }
                    }
                }
            ?>
        </div>                      
    </div>
    
     <div class="card">
        <div class="header" id="detail">
            <h2><center>Detail Property</center></h2>
            
        </div>
        <div class="body" id="body-property">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable"  > 
				<thead>
					<tr>
						<th></th>
						<th></th> 
					</tr>
				</thead>
				<tbody>
                <?php
                    $no     = 1;
                    $property = $API->property($noaset,''); 
                    $pars=json_decode($property,true);
                                            
                    if(isset($pars['data'])){
                    $size=count($pars['data']);
                                            
                    for($x=0;$x<$size;$x++){
                                                
                        $NO_ASET    = $pars['data'][$x]['NO_ASET'];
                        $JNS_PRO    = $pars['data'][$x]['JNS_PRO'];
                        $INDEK_PRO  = $pars['data'][$x]['INDEK_PRO'];
                        $KET_PRO    = $pars['data'][$x]['KET_PRO'];
                        $NILAI      = $pars['data'][$x]['NILAI'];
                        $name = "$JNS_PRO#$INDEK_PRO";
                        echo "<tr>";

                         echo '<td><label class="form-label" id="' . $x . '" name="' . $x . '">' . $KET_PRO . '</label></td>';
                                                
                        if ($KET_PRO === "HARGA PENAWARAN") {
                            $nilaiWithSeparator = number_format((float) $NILAI, 0, '.', ','); // Convert to float and format the number
                            echo '<td><input type="text" class="form-control nmbr" id="pro' . $name . '" name="' . $name . '" value="' . $nilaiWithSeparator . '" readonly></td>';
                            } else {
                            echo '<td><input type="text" class="form-control nmbr" id="pro' . $name . '" name="' . $name . '" value="' . $NILAI . '" readonly></td>';
                                                }
                        echo '</tr>';
                        $no++;
                    }
                }else
                        echo '<tr><td><h5>BELUM ADA DATA ASET</h5></td>';
                        echo "</tr>";
                    ?>
				</tbody>
            </table>
        </div>                      
    </div>

    <div class="card">
        <div class="header" >
            <h2><center>Fasilitas Property</center></h2>
        </div>
        <div class="body">
        <?php
         $cekfasilitas = $API->cekfasilitas($noaset); 
            $pars=json_decode($cekfasilitas,true); 
            $size=count($pars['data']);
            $z=0;
            foreach ($pars['data'] as $value) {
            if ($value['KEAMANAN'] == 1) { 
               $value['KEAMANAN']  = '<i class="material-icons col-green">check</i>';
            } else if($value['KEAMANAN'] == 0){
                $value['KEAMANAN']  = '<i class="material-icons col-red">close</i>';
            }

            if ($value['KEBUGARAN'] == 1) { 
               $value['KEBUGARAN']  = '<i class="material-icons col-green">check</i>';
            } else if($value['KEBUGARAN'] == 0){
                $value['KEBUGARAN']  = '<i class="material-icons col-red">close</i>';
            }

            if ($value['PST_KOTA'] == 1) { 
               $value['PST_KOTA']  = '<i class="material-icons col-green">check</i>';
            } else if($value['PST_KOTA'] == 0){
                $value['PST_KOTA']  = '<i class="material-icons col-red">close</i>';
            }

             if ($value['JLN_TOL'] == 1) { 
               $value['JLN_TOL']  = '<i class="material-icons col-green">check</i>';
            } else if($value['JLN_TOL'] == 0){
                $value['JLN_TOL']  = '<i class="material-icons col-red">close</i>';
            }

            if ($value['MASUK_MOBIL'] == 1) { 
               $value['MASUK_MOBIL']  = '<i class="material-icons col-green">check</i>';
            } else if($value['MASUK_MOBIL'] == 0){
                $value['MASUK_MOBIL']  = '<i class="material-icons col-red">close</i>';
            }

            if ($value['JLN_RAYA'] == 1) { 
               $value['JLN_RAYA']  = '<i class="material-icons col-green">check</i>';
            } else if($value['JLN_RAYA'] == 0){
                $value['JLN_RAYA']  = '<i class="material-icons col-red">close</i>';
            }

             if ($value['PASAR_LAMA'] == 1) { 
               $value['PASAR_LAMA']  = '<i class="material-icons col-green">check</i>';
            } else if($value['PASAR_LAMA'] == 0){
                $value['PASAR_LAMA']  = '<i class="material-icons col-red">close</i>';
            }

            if ($value['PST_BELANJA'] == 1) { 
               $value['PST_BELANJA']  = '<i class="material-icons col-green">check</i>';
            } else if($value['PST_BELANJA'] == 0){
                $value['PST_BELANJA']  = '<i class="material-icons col-red">close</i>';
            }

            if ($value['STASIUN_TRM_BND'] == 1) { 
               $value['STASIUN_TRM_BND']  = '<i class="material-icons col-green">check</i>';
            } else if($value['STASIUN_TRM_BND'] == 0){
                $value['STASIUN_TRM_BND']  = '<i class="material-icons col-red">close</i>';
            }

            if ($value['SEKOLAH'] == 1) { 
               $value['SEKOLAH']  = '<i class="material-icons col-green">check</i>';
            } else if($value['SEKOLAH'] == 0){
                $value['SEKOLAH']  = '<i class="material-icons col-red">close</i>';
            }

            if ($value['R_SAKIT'] == 1) { 
               $value['R_SAKIT']  = '<i class="material-icons col-green">check</i>';
            } else if($value['R_SAKIT'] == 0){
                $value['R_SAKIT']  = '<i class="material-icons col-red">close</i>';
            }

            if ($value['MASJID'] == 1) { 
               $value['MASJID']  = '<i class="material-icons col-green">check</i>';
            } else if($value['MASJID'] == 0){
                $value['MASJID']  = '<i class="material-icons col-red">close</i>';
            }

            if ($value['B_BANJIR'] == 1) { 
               $value['B_BANJIR']  = '<i class="material-icons col-green">check</i>';
            } else if($value['B_BANJIR'] == 0){
                $value['B_BANJIR']  = '<i class="material-icons col-red">close</i>';
            }

            if ($value['MINI_MARKET'] == 1) { 
               $value['MINI_MARKET']  = '<i class="material-icons col-green">check</i>';
            } else if($value['MINI_MARKET'] == 0){
                $value['MINI_MARKET']  = '<i class="material-icons col-red">close</i>';
            }

            if ($value['TMPT_IBADAHLAIN'] == 1) { 
               $value['TMPT_IBADAHLAIN']  = '<i class="material-icons col-green">check</i>';
            } else if($value['TMPT_IBADAHLAIN'] == 0){
                $value['TMPT_IBADAHLAIN']  = '<i class="material-icons col-red">close</i>';
            }
            
            echo '<div class="row clearfix" >
                        <div class="col-sm-2" id="keamanan">
                            <center><i class="material-icons">local_police</i>
                            <p>Keamanan 24 Jam </p> '.$value['KEAMANAN'].'
                        </div>
                        <div class="col-sm-2" id="keamanan">
                            <center><i class="material-icons">sports_football</i>
                            <p>Pusat Kebugaran </p>'.$value['KEBUGARAN'].'
                        </div>
                        <div class="col-sm-2" id="keamanan">
                            <center><i class="material-icons">apartment</i>
                            <p>Dekat Pusat Kota </p>'.$value['PST_KOTA'].'
                        </div>
                        <div class="col-sm-2" id="keamanan">
                            <center><i class="material-icons">add_road</i>
                            <p>Akses Jalan Tol </p>'.$value['JLN_TOL'].'
                        </div>
                        <div class="col-sm-2" id="keamanan">
                            <center><i class="material-icons">garage</i>
                            <p>Masuk Mobil </p>'.$value['MASUK_MOBIL'].'
                        </div>
                         <div class="col-sm-2" id="keamanan">
                            <center><i class="material-icons">add_road</i>
                            <p>Dekat Jalan Raya </p>'.$value['JLN_RAYA'].'
                        </div>
                    </div>
                        <div class="row clearfix">
                            <div class="col-sm-2" id="pasar">
                            <center><i class="material-icons">storefront</i>
                            <p>Dekat Pasar </p>'.$value['PASAR_LAMA'].'
                        </div>
                        <div class="col-sm-2" id="pasar">
                            <center><i class="material-icons">local_grocery_store</i>
                            <p>Dekat Supermarket</p>'.$value['PST_BELANJA'].'
                        </div>
                        <div class="col-sm-2" id="pasar">
                            <center><i class="material-icons">flood</i>
                            <p>Bebas Banjir</p>'.$value['B_BANJIR'].'
                            </div>
                        <div class="col-sm-2" id="pasar">
                            <center><i class="material-icons">school</i>
                            <p>Dekat Sekolah</p>'.$value['SEKOLAH'].'
                        </div>
                        <div class="col-sm-2" id="pasar">
                            <center><i class="material-icons">local_hospital</i>
                            <p>Dekat Rumah Sakit</p>'.$value['R_SAKIT'].'
                        </div>
                        <div class="col-sm-2" id="pasar">
                             <center><i class="material-icons">mosque</i>
                            <p>Dekat Masjid</p>'.$value['MASJID'].'
                        </div>
                    </div>
                        <div class="row clearfix">
                            <div class="col-sm-2" id="mini">
                            <center><i class="material-icons">store</i>
                            <p>Dekat Mini Market</p>'.$value['MINI_MARKET'].'
                            </div>
                            <div class="col-sm-2" id="mini">
                            <center><i class="material-icons">church</i>
                            <p>Ibadah Non Muslim</p>'.$value['TMPT_IBADAHLAIN'].'
                            </div>
                            <div class="col-sm-2" id="mini">
                            <center><i class="material-icons">commuter</i>
                            <p>Dekat Stasiun / Terminal / Bandara</p>'.$value['STASIUN_TRM_BND'].'
                        </div>
                        </div>';
            $z++;
            }
        ?>
        </div>
    </div> 
</div>
       
</body>

</html>

<script>
        
document.querySelectorAll('.image-container img').forEach(image =>{
    image.onclick = () =>{
    document.querySelector('.popup-image').style.display = 'block';
    document.querySelector('.popup-image img').src = image.getAttribute('src');
    }
    });

    document.querySelector('.popup-image span').onclick = () =>{
        document.querySelector('.popup-image').style.display = 'none';
    }

</script>

<!-- <script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=300,height=300');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
 </script>




<div id="divToPrint" style="display:none;">
  <div style="width:200px;height:300px;background-color:teal;">
           <?php echo $html; ?>      
  </div>
</div>
<div>
  <input type="button" value="print" onclick="PrintDiv();" />
</div> -->