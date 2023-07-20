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
include "include/function_rupiah.php";
include('include/API_functions.php');
$noaset = $_GET['na'];
$API = new API_functions();
$cekfoto = $API->cekfoto($noaset);

?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cetak</title>
    <link href="https://www.cssscript.com/demo/sticky.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.0.1/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-print.min.css" media="print" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <style>
        <style>.bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }


        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;

            }
        }

        @media print {
            .rows-print-as-pages .row {
                page-break-before: always;
            }

            /* include this style if you want the first row to be on the same page as whatever precedes it */
            /*
  .rows-print-as-pages .row:first-child {
    page-break-before: avoid;
  }
  */
        }

        body {
            background-image: linear-gradient(180deg, #eee, #fff 100px, #fff);
            margin:0;
            padding:0;
        }

        .container {
            max-width: 960px;
        }

        .pricing-header {
            max-width: 700px;
        }

        @media print {
            footer {
                page-break-after: always;
            }
        }

        @media print {
            .pagebreak {
                page-break-before: always;
            }

            /* page-break-after works, as well */
        }

        @page {
            size: auto;
            /* auto is the initial value */
             margin: 25mm 25mm 25mm 25mm;
            /* this affects the margin in the printer settings */
        }

        .card-img-top {
            width: 100%;
            height: 38vh;
            object-fit: cover;
        }

        table { page-break-inside:auto }
        tr    { page-break-inside:avoid; page-break-after:auto }
        thead { display:table-header-group; }
        tfoot { display:table-footer-group; }
        
    </style>

</head>

<body>
        <div class="container">
            <main>
                <div class="row text-center">

                    <?php
                    $pars = json_decode($cekfoto, true);
                    $size = count($pars['data']);
                    $z = 0;
                    foreach ($pars['data'] as $key => $value) {

                    ?>
                        <div class="col-md-12 mb-1 pagebreak">
                            <div class="card rounded-3 shadow-sm">
                                <img class="card-img-top img-responsive" style="width: 100%; height: 550px;" src="<?php echo $value['LINK'] ?>" alt="Card image cap">
                                <div class="card-header shadow-sm bg-info text-white">
                                    <h4 class="my-0 fw-normal"><?php echo $value['KETERANGAN'] ?></h4>
                                </div>

                            </div>
                        </div>

                    <?php $z++;
                    } ?>
        </div>
    </div>

    <div class="container">
    <div class="row">
        <div class="col-12 mb-5 mt-2 rounded">
            <div class="card text-center">
                <div class="card">
                    <div class="header bg-info text-white">
                        <h2>
                            <center>Deskripsi Property</center>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        $aset = $API->editasset($noaset);
                        $pars = json_decode($aset, true);
                        $size = count($pars['data']);
                        foreach ($pars['data'] as $key => $value) {

                            $np = $API->property($noaset, 'harga penawaran');
                            $nparray = json_decode($np, true);
                            $nilai_penawaran = $nparray['data'][0]['NILAI'];

                            if (isset($pars['data'])) {
                                $size = count($pars['data']);
                                for ($x = 0; $x < $size; $x++) {

                                    $KET_PRO = $pars['data'][$x]['KET_PRO'];
                                    $ALAMAT_ASET = $pars['data'][$x]['ALAMAT_ASET'];
                                    // echo strlen($ALAMAT_ASET);

                                    $memo_aset = $pars['data'][$x]['MEMO_ASET'];

                                    echo "<tr>";
                                    echo '<div class="card body" ><p text-align="left">' . rupiah($nilai_penawaran) . '</p><p text-align="left">' . $KET_PRO . '</p><p text-align="left">' . $memo_aset . '</p><p text-align="left">' . $ALAMAT_ASET . '</p>';

                                    echo '</tr>';
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
    
    <div class="row">
        <div class="col-12 mb-2 mt-5 rounded ">
            <div class="card">
                <div class="header bg-info text-white">
                        <h2>
                            <center>Detail Property</center>
                        </h2>
                    </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <?php
                            $no     = 1;
                            $property = $API->property($noaset, '');
                            $pars = json_decode($property, true);

                            if (isset($pars['data'])) {
                                $size = count($pars['data']);

                                for ($x = 0; $x < $size; $x++) {

                                    $NO_ASET    = $pars['data'][$x]['NO_ASET'];
                                    $JNS_PRO    = $pars['data'][$x]['JNS_PRO'];
                                    $INDEK_PRO  = $pars['data'][$x]['INDEK_PRO'];
                                    $KET_PRO    = $pars['data'][$x]['KET_PRO'];
                                    $NILAI      = $pars['data'][$x]['NILAI'];
                                    $name = "$JNS_PRO#$INDEK_PRO";
                                    echo " <tbody><tr>";
                                    echo '<th scope="row" class="text-start">
                                         <label class="form-label" id="' . $x . '" name="' . $x . '">' . $KET_PRO . '</label>
                                         </th>';
                                    echo '<td>' . $NILAI . '</td>';
                                    echo '</tr> </tbody>';
                                    $no++;
                                }
                            } else
                                echo '<tr><td><h5>BELUM ADA DATA ASET</h5></td>';
                            echo "</tr>";
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    
    <div class="row">
        <div class="col-md-12 mb-5 mt-5  text-center pagebreak ">
            <div class="card rounded-3 shadow-sm">
                <div class="card-header shadow-sm bg-info text-white">
                    <h2 class="my-0 fw-normal">Fasilitas Property</h2>
                </div>
                <div class="card-body">
                    <?php
                    $cekfasilitas = $API->cekfasilitas($noaset);
                    $pars = json_decode($cekfasilitas, true);
                    $size = count($pars['data']);
                    $z = 0;
                    foreach ($pars['data'] as $value) {
                        if ($value['KEAMANAN'] == 1) {
                            $value['KEAMANAN']  = '<font color="#16FF00"><i class="material-icons col-green">check</i></font>';
                        } else if ($value['KEAMANAN'] == 0) {
                            $value['KEAMANAN']  = '<font color="#F55050"><i class="material-icons col-red">close</i></font>';
                        }

                        if ($value['KEBUGARAN'] == 1) {
                            $value['KEBUGARAN']  = '<font color="#16FF00"><i class="material-icons col-green">check</i></font>';
                        } else if ($value['KEBUGARAN'] == 0) {
                            $value['KEBUGARAN']  = '<font color="#F55050"><i class="material-icons col-red">close</i></font>';
                        }

                        if ($value['PST_KOTA'] == 1) {
                            $value['PST_KOTA']  = '<font color="#16FF00"><i class="material-icons col-green">check</i></font></font>';
                        } else if ($value['PST_KOTA'] == 0) {
                            $value['PST_KOTA']  = '<font color="#F55050"><i class="material-icons col-red">close</i></font>';
                        }

                        if ($value['JLN_TOL'] == 1) {
                            $value['JLN_TOL']  = '<font color="#16FF00"><i class="material-icons col-green">check</i></font>';
                        } else if ($value['JLN_TOL'] == 0) {
                            $value['JLN_TOL']  = '<font color="#F55050"><i class="material-icons col-red">close</i></font>';
                        }

                        if ($value['MASUK_MOBIL'] == 1) {
                            $value['MASUK_MOBIL']  = '<font color="#16FF00"><i class="material-icons col-green">check</i></font>';
                        } else if ($value['MASUK_MOBIL'] == 0) {
                            $value['MASUK_MOBIL']  = '<font color="#F55050"><i class="material-icons col-red">close</i></font>';
                        }

                        if ($value['JLN_RAYA'] == 1) {
                            $value['JLN_RAYA']  = '<font color="#16FF00"><i class="material-icons col-green">check</i></font>';
                        } else if ($value['JLN_RAYA'] == 0) {
                            $value['JLN_RAYA']  = '<font color="#F55050"><i class="material-icons col-red">close</i></font>';
                        }

                        if ($value['PASAR_LAMA'] == 1) {
                            $value['PASAR_LAMA']  = '<font color="#16FF00"><i class="material-icons col-green">check</i></font>';
                        } else if ($value['PASAR_LAMA'] == 0) {
                            $value['PASAR_LAMA']  = '<font color="#F55050"><i class="material-icons col-red">close</i></font>';
                        }

                        if ($value['PST_BELANJA'] == 1) {
                            $value['PST_BELANJA']  = '<font color="#16FF00"><i class="material-icons col-green">check</i></font>';
                        } else if ($value['PST_BELANJA'] == 0) {
                            $value['PST_BELANJA']  = '<font color="#F55050"><i class="material-icons col-red">close</i></font>';
                        }

                        if ($value['STASIUN_TRM_BND'] == 1) {
                            $value['STASIUN_TRM_BND']  = '<font color="#16FF00"><i class="material-icons col-green">check</i></font>';
                        } else if ($value['STASIUN_TRM_BND'] == 0) {
                            $value['STASIUN_TRM_BND']  = '<font color="#F55050"><i class="material-icons col-red">close</i></font>';
                        }

                        if ($value['SEKOLAH'] == 1) {
                            $value['SEKOLAH']  = '<font color="#16FF00"><i class="material-icons col-green">check</i></font>';
                        } else if ($value['SEKOLAH'] == 0) {
                            $value['SEKOLAH']  = '<font color="#F55050"><i class="material-icons col-red">close</i></font>';
                        }

                        if ($value['R_SAKIT'] == 1) {
                            $value['R_SAKIT']  = '<font color="#16FF00"><i class="material-icons col-green">check</i></font>';
                        } else if ($value['R_SAKIT'] == 0) {
                            $value['R_SAKIT']  = '<font color="#F55050"><i class="material-icons col-red">close</i></font>';
                        }

                        if ($value['MASJID'] == 1) {
                            $value['MASJID']  = '<font color="#16FF00"><i class="material-icons col-green">check</i></font>';
                        } else if ($value['MASJID'] == 0) {
                            $value['MASJID']  = '<font color="#F55050"><i class="material-icons col-red">close</i></font>';
                        }

                        if ($value['B_BANJIR'] == 1) {
                            $value['B_BANJIR']  = '<font color="#16FF00"><i class="material-icons col-green">check</i></font>';
                        } else if ($value['B_BANJIR'] == 0) {
                            $value['B_BANJIR']  = '<font color="#F55050"><i class="material-icons col-red">close</i></font>';
                        }

                        if ($value['MINI_MARKET'] == 1) {
                            $value['MINI_MARKET']  = '<font color="#16FF00"><i class="material-icons col-green">check</i></font>';
                        } else if ($value['MINI_MARKET'] == 0) {
                            $value['MINI_MARKET']  = '<font color="#F55050"><i class="material-icons col-red">close</i></font>';
                        }

                        if ($value['TMPT_IBADAHLAIN'] == 1) {
                            $value['TMPT_IBADAHLAIN']  = '<font color="#16FF00"><i class="material-icons col-green">check</i></font>';
                        } else if ($value['TMPT_IBADAHLAIN'] == 0) {
                            $value['TMPT_IBADAHLAIN']  = '<font color="#F55050"><i class="material-icons col-red">close</i></font>';
                        }

                        echo '<div class="row clearfix" >
                        <div class="col-sm-2" id="keamanan">
                            <center><i class="material-icons">local_police</i>
                            <p>Keamanan 24 Jam </p> ' . $value['KEAMANAN'] . '
                        </div>
                        <div class="col-sm-2" id="keamanan">
                            <center><i class="material-icons">sports_football</i>
                            <p>Pusat Kebugaran </p>' . $value['KEBUGARAN'] . '
                        </div>
                        <div class="col-sm-2" id="keamanan">
                            <center><i class="material-icons">apartment</i>
                            <p>Dekat Pusat Kota </p>' . $value['PST_KOTA'] . '
                        </div>
                        <div class="col-sm-2" id="keamanan">
                            <center><i class="material-icons">add_road</i>
                            <p>Akses Jalan Tol </p>' . $value['JLN_TOL'] . '
                        </div>
                        <div class="col-sm-2" id="keamanan">
                            <center><i class="material-icons">garage</i>
                            <p>Masuk Mobil </p>' . $value['MASUK_MOBIL'] . '
                        </div>
                         <div class="col-sm-2" id="keamanan">
                            <center><i class="material-icons">add_road</i>
                            <p>Dekat Jalan Raya </p>' . $value['JLN_RAYA'] . '
                        </div>
                    </div>
                        <div class="row clearfix">
                            <div class="col-sm-2" id="pasar">
                            <center><i class="material-icons">storefront</i>
                            <p>Dekat Pasar </p>' . $value['PASAR_LAMA'] . '
                        </div>
                        <div class="col-sm-2" id="pasar">
                            <center><i class="material-icons">local_grocery_store</i>
                            <p>Dekat Supermarket</p>' . $value['PST_BELANJA'] . '
                        </div>
                        <div class="col-sm-2" id="pasar">
                            <center><i class="material-icons">flood</i>
                            <p>Bebas Banjir</p>' . $value['B_BANJIR'] . '
                            </div>
                        <div class="col-sm-2" id="pasar">
                            <center><i class="material-icons">school</i>
                            <p>Dekat Sekolah</p>' . $value['SEKOLAH'] . '
                        </div>
                        <div class="col-sm-2" id="pasar">
                            <center><i class="material-icons">local_hospital</i>
                            <p>Dekat Rumah Sakit</p>' . $value['R_SAKIT'] . '
                        </div>
                        <div class="col-sm-2" id="pasar">
                             <center><i class="material-icons">mosque</i>
                            <p>Dekat Masjid</p>' . $value['MASJID'] . '
                        </div>
                    </div>
                        <div class="row clearfix">
                            <div class="col-sm-2" id="mini">
                            <center><i class="material-icons">store</i>
                            <p>Dekat Mini Market</p>' . $value['MINI_MARKET'] . '
                            </div>
                            <div class="col-sm-2" id="mini">
                            <center><i class="material-icons">church</i>
                            <p>Ibadah Non Muslim</p>' . $value['TMPT_IBADAHLAIN'] . '
                            </div>
                            <div class="col-sm-2" id="mini">
                            <center><i class="material-icons">commuter</i>
                            <p>Dekat Stasiun / Terminal / Bandara</p>' . $value['STASIUN_TRM_BND'] . '
                        </div>
                        </div>';
                        $z++;
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
    </div>

    </main>

    </div>


    <script>
        window.print();
        window.onfocus = function() {
            window.close();
        }
        $(".nmbr").keyup(function() {
            convertToRupiah(this);

        });
        try {
            fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", {
                method: 'HEAD',
                mode: 'no-cors'
            })).then(function(response) {
                return true;
            }).catch(function(e) {
                var carbonScript = document.createElement("script");
                carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CE7DC2JW&placement=wwwcssscriptcom";
                carbonScript.id = "_carbonads_js";
                document.getElementById("carbon-block").appendChild(carbonScript);
            });
        } catch (error) {
            console.log(error);
        }
    </script>
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-46156385-1', 'cssscript.com');
        ga('send', 'pageview');
    </script>
</body>

</html>