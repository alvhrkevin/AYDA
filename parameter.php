<?php
session_start();
if( !isset($_SESSION["userId"])){
     header("Location: ./");
   exit;
   }

   include "timeout.php";
   include "include/header.php";

?>

<body class="theme-green">
    <!-- Top Bar -->
    <?php include "include/navbar.php"; ?>
    <!-- #Top Bar -->
    <?php $page = 'parameter'; include "include/sidebar_admin.php"; ?>

     <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href=""><i class="material-icons">list</i>Parameter</a></li>
            </ol>
            <a href="p_asset"><button class="btn btn-warning waves-effect">
            <b>1. PARAMETER JENIS ASSET</b></button></a>
            <a href="p_property"><button class="btn btn-warning waves-effect">
            <b>2. PARAMETER JENIS PROPERTY</b></button></a>              
        </div>
    </section>
</body>
</html>
