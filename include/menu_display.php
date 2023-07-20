

<div class="menu">
    <ul class="list">
        			
<!-- ============================================== MENU PEJABAT ========================================= -->
		<?php
          if ((($_SESSION["menu2"])=="1")){
          ?>
			
            
            <li class="header"></li>
            
            <li>
                <a href="display">
                    <i class="material-icons col-red">donut_large</i>
                    <span>KEMBALI</span>
                </a>
            </li>
		  <?php
          }else ((($_SESSION["menu2"])=="0"));
          ?>
<!-- ========================================= AKHIR MENU PEJABAT ========================================== -->
<!-- ============================================== MENU ADMIN ========================================= -->   
        <?php
          if ((($_SESSION["menu1"])=="1")){
          ?>
            
            
            <li class="header"></li>
            
            <li>
                <a href="display">
                    <i class="material-icons col-red">donut_large</i>
                    <span>KEMBALI</span>
                </a>
            </li>
          <?php
          }else ((($_SESSION["menu1"])=="0"));
          ?>
          <!-- ============================================== AKHIR MENU ADMIN ========================================= -->
          <!-- ============================================== MENU CABANG ========================================= -->
          <?php
          if ((($_SESSION["menu3"])=="1")){
          ?>
            <li class="<?php if($page=='display'){echo 'active';}?>">
                
            
            <li>
                <a href="display">
                    <i class="material-icons col-red">donut_large</i>
                    <span>KEMBALI</span>
                </a>
            </li>
          <?php
          }else ((($_SESSION["menu3"])=="0"));
          ?>
		<!-- ============================================== AKHIR MENU CABANG ========================================= -->	     
    </ul>
</div>