
<div class="menu">
    <ul class="list">
    <li class="header">MAIN MENU</li>       
<!-- ============================================== MENU  ========================================= -->
<!-- ============================================== MENU OTORISASI PEJABAT ========================================= -->
            
            
            <li class="<?php if($page=='register'){echo 'active';}?>">
                <a href="user">
                    <i class="material-icons">person</i>
                    <span>USER ID</span>
                </a>
            </li>
            <?php 
            if ((($_SESSION["menu2"])=="1")){
            ?>
            <li class="<?php if($page=='parameter'){echo 'active';}?>">  
                <a href="param">
                    <i class="material-icons">list</i>
                    <span>PARAMETER</span>
                </a>
            </li>
              <?php
              }else ((($_SESSION["menu2"])=="0"));
              ?>
            <hr>
            <li>
                <a href="beranda">
                    <i class="material-icons col-red">donut_large</i>
                    <span>KEMBALI</span>
                </a>
            </li>
             
            <!-- ========================================= AKHIR OTORISASI PEJABAT ========================================== -->
    </ul>
</div>