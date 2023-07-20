 
  <!-- Page Loader
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div> -->
    <div class="overlay"></div>
   <?php include "include/navbar.php"; ?>
    <section>
<section>
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="assets/img/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b><?php echo $_SESSION["nama"]; ?></b></div>
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b><?php echo $_SESSION["userId"]; ?></b></div> 
                    <!--<div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Logout</a></li>
                        </ul>
                    </div>-->
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <?php include "include/menu_admin.php"; ?>
            <!-- #Menu -->
            <!-- Footer -->
            <?php include "include/footer.php"; ?>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>
