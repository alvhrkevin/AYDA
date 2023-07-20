
<div class="menu">
    <ul class="list">
    <li class="header">MAIN MENU</li>		
<!-- ============================================== MENU  ========================================= -->
<!-- ============================================== MENU OTORISASI PEJABAT ========================================= -->
			
			<li class="<?php if($page=='oto_internal'){echo 'active';}?>">
                <a href="oto_internal">
                    <i class="material-icons">security</i>
                    <span>OTORISASI EKS PEMINJAM</span>
                </a>
            </li>
             <li class="<?php if($page=='asset'){echo 'active';}?>">  
                <a href="oto_asset">
                    <i class="material-icons">security</i>
                    <span>OTORISASI AYDA</span>
                </a>
            </li>
            <li class="<?php if($page=='user'){echo 'active';}?>">  
                <a href="oto_user">
                    <i class="material-icons">admin_panel_settings</i>
                    <span>OTORISASI USER</span>
                </a>
            </li>


            <li>
                <a href="beranda">
                    <i class="material-icons col-red">donut_large</i>
                    <span>KEMBALI</span>
                </a>
            </li>
            
            <!-- ========================================= AKHIR OTORISASI PEJABAT ========================================== -->
    </ul>
</div>