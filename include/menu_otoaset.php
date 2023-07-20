

<div class="menu">
    <ul class="list">
              
<!-- ============================================== MENU PEJABAT ========================================= -->
    <?php
          if ((($_SESSION["menu2"])=="1")){
          ?>
      
            
            <li class="header"></li>
            
            <li>
                <a href="oto_asset">
                    <i class="material-icons col-red">donut_large</i>
                    <span>KEMBALI</span>
                </a>
            </li>
      <?php
          }else ((($_SESSION["menu2"])=="0"));
          ?>


    </ul>
</div>