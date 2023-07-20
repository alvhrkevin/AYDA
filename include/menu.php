

<div class="menu">
    <ul class="list">
        <li class="header">MAIN NAVIGATION</li>			
<!-- ============================================== MENU PEJABAT ========================================= -->
		<?php
          if ((($_SESSION["menu2"])=="1")){
          ?>
			<li class="<?php if($page=='ekspeminjam'){echo 'active';}?>">
                <a href="ekspeminjam">
                    <i class="material-icons">person</i>
                    <span>EKS PEMINJAM</span>
                </a>
            </li>
            
            <li class="<?php if($page=='aset'){echo 'active';}?>">
                <a href="data_asset">
                    <i class="material-icons">home</i>
                    <span>ASSET</span>
                </a>
			     </li>
            <li class="<?php if($page=='display'){echo 'active';}?>">
                
                <a href="display"> 
					<i class="material-icons">monitor</i>
                    <span>DISPLAY</span>
                </a>
            </li>
            
            <li class="header"></li>
            
            <li>
                <a href="beranda">
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
            <li class="<?php if($page=='ekspeminjam'){echo 'active';}?>">
                <a href="ekspeminjam">
                    <i class="material-icons">person</i>
                    <span>EKS PEMINJAM</span>
                </a>
            </li>
            
            <li class="<?php if($page=='aset'){echo 'active';}?>">
                <a href="data_asset">
                    <i class="material-icons">home</i>
                    <span>ASSET</span>
                </a>
            </li>
            
            <li class="<?php if($page=='display'){echo 'active';}?>">
                
                <a href="display"> 
                    <i class="material-icons">monitor</i>
                    <span>DISPLAY</span>
                </a>
            </li>
            
            <li class="header"></li>
            
            <li>
                <a href="beranda">
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
                
                <a href="discab"> 
                    <i class="material-icons">monitor</i>
                    <span>DISPLAY</span>
                </a>
            </li>
            
            <li class="header"></li>
            
            <li>
                <a href="beranda">
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