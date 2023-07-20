

<div class="menu">
    <ul class="list">
              
<!-- ============================================== MENU PEJABAT ========================================= -->
    <?php
          if ((($_SESSION["menu2"])=="1")){
          ?>
      
            
            <li class="header"></li>
            
            <li>
                <a href="user">
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
                <a href="user">
                    <i class="material-icons col-red">donut_large</i>
                    <span>KEMBALI</span>
                </a>
            </li>
          <?php
          }else ((($_SESSION["menu1"])=="0"));
          ?>
          <!-- ============================================== AKHIR MENU ADMIN ========================================= -->
    </ul>
</div>