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
include "include/function_rupiah.php";

 $rek = base64_decode($_GET['nr']);
 $cek = $API -> cekDetailPerolehan($rek);
 $parscek= json_decode($cek,true);
 $nilai_perolehan= $parscek['data'][0]['nilai_perolehan'];
 $memo_perolehan= $parscek['data'][0]['memo_perolehan'];
 $otomatis='0';
 
 if($memo_perolehan!='0'){
    $pars2      = json_decode($memo_perolehan,true);
    $saldo      = $pars2['Sisa Pokok'];
    $jumplus    = $pars2['Jumlah Penambah'];
    $jumin      = $pars2['Hasil Pengurang'];
    $jumtot     = $pars2['Jumlah Total'];
    $rinciplus  = $pars2['penambah'];
    $rincimin   = $pars2['pengurang'];
    //$parsplus = json_decode($rinciplus,true);
    $pjgplus    = sizeof($rinciplus);
    $pjgmin     = sizeof($rincimin);
    $otomatis='1';
    
    $namaplus   = array_keys($rinciplus);
    $namamin    = array_keys($rincimin);
    //$nama ='BY. PENJUAL (BY. LELANG PENJUAL DAN PPH FINAL)';
    //$isi  = $rinciplus[$nama];
 } 
 
 $na = $API -> cekPerolehan();
 $pars  = json_decode($na,true);
 $RC    = '88';
 $RC    = $pars['responseCode'];
 $plus=0;
 $minus=0;
 
 ?>

<style>
    #button{
        margin-right: 10px; width: 80%; color: #483838;
    }
</style>

<head>
    <link rel="stylesheet"  href="assets/css/print.css" media="print">
</head>

<body class="theme-green">
    <!-- Top Bar -->
    <!-- #Top Bar -->

     <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <center><h1><b>RINCIAN NILAI PEROLEHAN</b></h1></center>
                            <div class="row clearfix">
                                    <div class="col-sm-3">
                                </div>
                            </div> 
                        </div>
                        <?php 
                             if ($RC!='00'){
                                echo '<h7><b> ULANGI BEBERAPA SAAT LAGI </b></h7>';
                             }
                             else{
                        ?>
                                <div class="body">
                            <div class="table-responsive">
                               `<table class="table table-bordered" >
                                
                                <input type="hidden" class="form-control" name="f_eks_peminjam">
                                <thead>
                                    <th><center>Keterangan</center></th>
                                    <th><center>Jumlah</center></th>
                                </thead>    
                                        <!-----================================= FAKTOR PENGURANGAN ===================---------->
                                <thead>
                                    <tr style="background-color:yellow">
                                        <td>
                                            <p style="text-align: left;"><b>Sisa Pokok / Outstanding</b></p>
                                        </td>
                                        <td>
                                        <?php  
                                        $rc = $parscek['responseCode'];
                                            if ($rc='00'){
                                                if($otomatis=='1'){
                                                    echo '<p style="text-align: left; margin: 0 0 -20px;font-size: 15px;">Rp.</p><input type="text" class="form-control" name="pokok" id="isipokok" value="'. $saldo.'" style="width: 68%; margin-left: 30px;" readonly></td>';
                                                }
                                                else{
                                                    echo '<p style="text-align: left; margin: 0 0 -20px; font-size: 15px;">Rp.</p><input type="text" class="form-control" name="pokok" id="isipokok" value="'. intval($parscek['data'][0]['saldo']).'" style="width: 68%; margin-left: 30px;" readonly></td>';
                                                }
                                            
                                            }
                                            else {
                                                echo '<p style="text-align: left; margin: 0 0 -20px; font-size: 15px;">Rp.</p><input type="text" class="form-control nmbr" name="pokok" id="isipokok" value="0" style="width: 68%; margin-left: 30px;" readonly></td>';
                                            }
                                            
                                         ?> 
                                            
                                    </tr>
                                </thead>
                                <thead>
                                    <tr >
                                        <td>
                                            <p style="text-align: left;"><b>Biaya Pokok : (Sebagai Faktor Penambah) : (sebagai faktor pengurang)</b></p>
                                        </td>
                                        <td></td>
                                        

                                    </tr>
                                </thead>
                                
                                <tbody id="table_body">
                                    <?php
                                        if($otomatis=='0'){
                                             $size=count($pars['data']);
                                                for($x=0;$x<$size;$x++){
                                                $GOL        = $pars['data'][$x]['GOL'];
                                                // $KET_OLEH2  = $pars['data'][$x]['KET_OLEH2'];
                                                $NO         = $pars['data'][$x]['NO'];
                                                
                                                $name = "$GOL#$NO";
                                                if($GOL=="PENAMBAH"){
                                                    $plus++;
                                                    echo "<tr>";
                                                    
                                                    echo '<td><input type="text" class="form-control" id="'.$x.'" name="lt'.$plus.'" value="" ></td>';
                                            
                                                    echo '<td><input type="text" class="form-control nmbr"  id="tambah" name="it'.$plus.'" value="0"></td>';
                                                    echo '</tr>';
                                                    
                                                }
                                                //$no++;
                                            }
                                        }else{
                                            for($x=0;$x<$pjgplus;$x++){
                                                
                                                $nama   = $namaplus[$x];
                                                $isi    = $rinciplus[$nama];
                                                $plus++;
                                                    echo "<tr>";
                                                    
                                                    echo '<td><input type="text" class="form-control" id="'.$x.'" name="lt'.$plus.'" value="'.$nama.'" ></td>';
                                            
                                                    echo '<td><input type="text" class="form-control nmbr"  id="tambah" name="it'.$plus.'" value="'.$isi.'" amount></td>';
                                                    echo '</tr>';
                                                
                                            }
                                        }
                                    ?>
                                </tbody>
                                <thead>
                                    <?php
                                    if($otomatis=='0'){
                                        echo '<tr style="background-color:cyan">';
                                        echo '<td style="text-align: left;">Jumlah Penambah</td>';
                                        echo '<td><p style="text-align: left; margin: 0 0 -20px; font-size: 15px;">Rp.</p><input type="text" class="form-control nmbr"  id="hasiltambah" value="0"  style="width: 68%; margin-left: 30px;"readonly ></td>';
                                        echo '</tr>';
                                    }else{
                                        echo '<tr style="background-color:cyan">';
                                        echo '<td style="text-align: left;">Jumlah Penambah</td>';
                                        echo '<td><p style="text-align: left; margin: 0 0 -20px; font-size: 15px;">Rp.</p><input type="text" class="form-control nmbr"   id="hasiltambah" value="'.$jumplus.'" style="width: 68%; margin-left: 30px;" readonly></td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </thead>
                                <thead>
                                            <tr >
                                                <td>
                                                    <p style="text-align: left;"><b>Setoran : (sebagai faktor pengurang)</b></p>
                                                </td>
                                                <td></td>
                                                </td></td>
                                            </tr>
                                            
                                        </thead>

                                        <tbody id="table_body2">
                                           <?php 
                                            if($otomatis=='0'){
                                                $size=count($pars['data']);
                                                for($x=0;$x<$size;$x++){
                                                    
                                                    $GOL        = $pars['data'][$x]['GOL'];
                                                    // $KET_OLEH2  = $pars['data'][$x]['KET_OLEH2'];
                                                    $NO         = $pars['data'][$x]['NO'];
                                                    
                                                    $name = "$GOL#$NO";
                                                    if($GOL=="PENGURANG"){
                                                        $minus++;
                                                        echo "<tr>";
                                                        
                                                        echo '<td><input type="text" class="form-control" id="'.$x.'" name="lk'.$minus.'" value="" required></td>';
                                                
                                                        echo '<td><input type="text" class="form-control nmbr"  id="kurang" name="ik'.$minus.'"  value="0" ></td>';
                                                        echo '</tr>';
                                                        
                                                    }
                                                    //$no++;
                                                }
                                            }else{
                                                for($x=0;$x<$pjgmin;$x++){
                                                    
                                                    $nama   = $namamin[$x];
                                                    $isi    = $rincimin[$nama];
                                                    $minus++;
                                                        echo "<tr>";
                                                        
                                                        echo '<td><input type="text" class="form-control" id="'.$x.'" name="lk'.$minus.'" value="'.$nama.'" ></td>';
                                                
                                                        echo '<td><input type="text" class="form-control nmbr"  id="kurang" name="ik'.$minus.'"  value="'.$isi.'" ></td>';
                                                        echo '</tr>';
                                                }
                                            }
                                            ?>
                                            </tbody>

                                            <thead>
                                            
                                            <?php
                                            if($otomatis=='0'){
                                                echo '<tr style="background-color:orange">';
                                                echo '<td style="text-align: left;">Hasil Pengurang</td>';
                                                echo '<td><p style="text-align: left; margin: 0 0 -20px; font-size: 15px;">Rp.</p><input type="text" class="form-control nmbr"  id="pengurang" style="width: 68%; margin-left: 30px;" value="0" readonly></td>';
                                                echo '</tr>';
                                                echo ' <tr style="background-color:grey">';
                                                echo '<td style="text-align: left;">Jumlah Total</td>';
                                                echo '<td><p style="text-align: left; margin: 0 0 -20px; font-size: 15px;">Rp.</p><input type="text" class="form-control nmbr"  id="total" value="0" style="width: 68%; margin-left: 30px;" readonly></td>';
                                                echo '</tr>';
                                            }else{
                                                echo '<tr style="background-color:orange">';
                                                echo '<td style="text-align: left;">Hasil Pengurang</td>';
                                                echo '<td><p style="text-align: left; margin: 0 0 -20px; font-size: 15px;">Rp.</p><input type="text" class="form-control"  id="pengurang" value="'.$jumin.'" style="width: 68%; margin-left: 30px;" readonly></td>';
                                                echo '</tr>';
                                                echo ' <tr style="background-color:grey">';
                                                echo '<td style="text-align: left;">Jumlah Total</td>';
                                                echo '<td><p style="text-align: left; margin: 0 0 -20px;  font-size: 15px;">Rp.</p><input type="text" class="form-control"  id="total" value="'.$jumtot.'" style="width: 68%; margin-left: 30px;" readonly></td>';
                                                echo '</tr>';
                                            }
                                            ?>

                                           
                                            <tr>
                                            <td></td>
                                            <td>        
                                            </div>
                                            </td>
                                            </tr>
                                        </thead>
                            </div>
                            </table>   
                        </div>     
                    </div>
                </div>
                <?php } ?>
            </div>
          </div>
        </div>                        
    </section>


    <script>
    	window.print();
        window.onfocus=function(){ window.close();}
        $(".nmbr").keyup( function() {
               convertToRupiah(this);

    });
        $(".nmbr").keyup( function() {
               convertToRupiah(this);
         
    });
        var isipokok = document.getElementById('isipokok');
        convertToRupiah(isipokok)     
          
        function convertToRupiah(objek) {
          separator = ",";
          a = objek.value;
          b = a.replace(/[^\d]/g,"");
          c = "";
          panjang = b.length;
          j = 0;
          for (i = panjang; i > 0; i--) {
            j = j + 1;
            if (((j % 3) == 1) && (j != 1)) {
              c = b.substr(i-1,1) + separator + c;
            } else {
              c = b.substr(i-1,1) + c;
            }
          }
          objek.value = c;

        };

    	
        function simpan(){
            var data    = {};
            var plus    = {};
            var minus = {};
            var pokok   = document.getElementById("isipokok").value;
            var tambah  = document.getElementById("hasiltambah").value;
            var kurang  = document.getElementById("pengurang").value;
            var total   = document.getElementById("total").value;
            var hasiltotal = total.replace(/,/g, "");
            data["Sisa Pokok"]                  = pokok;
            data["Jumlah Penambah"]             = tambah;
            data["Hasil Pengurang"]             = kurang;
            data["Jumlah Total"]                = total;
            var rek = <?php echo $rek; ?>;
            var table = document.getElementById("table_body");
            var penambah = table.rows.length;
            var table2 = document.getElementById("table_body2");
            var pengurang = table2.rows.length;
            console.log(penambah);
            for (var i=1;i<=penambah;i++){
                var judul = document.getElementsByName("lt"+i)[0].value;
                var isi = document.getElementsByName("it"+i)[0].value;
                if(judul!=''){
                    plus[judul]=isi;
                }
            }
            for (var i=1;i<=pengurang;i++){
                var judul = document.getElementsByName("lk"+i)[0].value;
                var isi = document.getElementsByName("ik"+i)[0].value;
                if(judul!=''){
                    minus[judul]=isi;
                }
            }
            data["penambah"]=plus;
            data["pengurang"]=minus;
            var oke = JSON.stringify(Object.assign({}, data));
            console.log(oke);
            $.ajax({ 
                url: 'updateperolehan.php',
                data: { rekening:rek ,nilai:hasiltotal, memo:oke },
                type: 'post'
            }).done(function(respon) {
                console.log('Done: '+ respon);
                alert('DATA BERHASIL DISIMPAN');
                window.location='./data_ekspeminjam';
                
            }).fail(function() {
                console.log('Failed');
            });
            
        }
        
        
        document.body.addEventListener( 'keyup', function ( event ) {
            if( event.target.id == 'tambah' ) {
                var textboxes = document.querySelectorAll("#tambah");
                var total = 0;
                textboxes.forEach(function(box) {
                  	var n = box.value.replace(/,/g, "");
                    var $this = $(this);
                    if (box.value == "") val = 0;
                    else val = parseFloat(n);
                    total += val;
                });
                document.getElementById("hasiltambah").value=convertR(total);
                kabeh();
            };
        } );
        
        function convertR(bilangan){
        var number_string = bilangan.toString(),
            sisa    = number_string.length % 3,
            rupiah  = number_string.substr(0, sisa),
            ribuan  = number_string.substr(sisa).match(/\d{3}/g);
        if (ribuan) {
            separator = sisa ? ',' : '';
            rupiah += separator + ribuan.join(',');
        }
        return rupiah;
        }
        
        document.body.addEventListener( 'keyup', function ( event ) {
            if( event.target.id == 'kurang' ) {
                var textboxes2 = document.querySelectorAll("#kurang");
                var total2 = 0;
                textboxes2.forEach(function(box2) {
                    var val2;
                    var n2 = box2.value.replace(/,/g, "");
                    if (box2.value == "") val2 = 0;
                    else val2 = parseFloat(n2);
                    total2 += val2;
                });
                document.getElementById("pengurang").value=convertR(total2);
                console.log(total2);
                kabeh();
            };
        } );


        function sumAll() {
          var total = 0;
          textboxes.forEach(function(box) {
            var val;
            if (box.value == "") val = 0;
            else val = parseFloat(box.value);
            total += val;
          });
          document.getElementById("hasiltambah").value=convertR(total);
          kabeh();
        }
        
        
        function sumAllKurang() {
          var total2 = 0;
          textboxes2.forEach(function(box2) {
            var val2;
            if (box2.value == "") val2 = 0;
            else val2 = parseFloat(box2.value);
            total2 += val2;
          });
          document.getElementById("pengurang").value=total2;
          kabeh();
        }
        
        function kabeh(){
            var nilai = document.getElementById("isipokok").value;
            var pokok =  nilai.replace(/,/g, "").toString()
            var hasil = document.getElementById("hasiltambah").value;
            var tambah =  hasil.replace(/,/g, "").toString()
            var minus = document.getElementById("pengurang").value;
            var kurang =  minus.replace(/,/g, "").toString()
            var totale = (parseFloat(pokok)+parseFloat(tambah))-parseFloat(kurang);
            document.getElementById("total").value= convertR(totale);
        }
        
        function baristambah(table_id){
            let table_body = document.getElementById(table_id),
            first_tr = table_body.firstElementChild
            tr_clone = first_tr.cloneNode(true);
            var row = table_body.insertRow();
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            //var urut =  "<?php $plus++; echo $plus; ?>";
            var table = document.getElementById("table_body");
            var urut = parseFloat(table.rows.length);
            
            cell1.innerHTML = '<input type="text" class="form-control" name="lt'+urut+'">';
            
            var element = document.createElement("input");

            element.setAttribute("type", "text");
            element.setAttribute("id", "tambah");
            element.setAttribute("name",'it'+urut);
            element.setAttribute("onkeyup","convertToRupiah(this)");
            element.setAttribute("class", "form-control nmbr");
            element.setAttribute("value", "0");
             
            cell2.append(element);
            
        }
        
        function bariskurang(table_id){
            let table_body = document.getElementById(table_id),
            first_tr = table_body.firstElementChild
            tr_clone = first_tr.cloneNode(true);
            
            var row = table_body.insertRow();
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            
            var table = document.getElementById("table_body2");
            var urut = parseFloat(table.rows.length);
            
            cell1.innerHTML = '<input type="text" class="form-control" name="lk'+urut+'">';
            
            var element = document.createElement("input");
            element.setAttribute("type", "text");
            element.setAttribute("id", "kurang");
            element.setAttribute("name",'ik'+urut);
            element.setAttribute("onkeyup","convertToRupiah(this)");
            element.setAttribute("class", "form-control nmbr");
            element.setAttribute("value", "0");
             
            cell2.append(element);
        }
    </script>          
</body>
</html>

