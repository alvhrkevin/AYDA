<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 

    <!-- Favicons -->
    <link href="assets/img/favicon/ayda.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/login.css" rel="stylesheet">

<body>

    <img class="wave" src="assets/img/wave.png">
    <div class="container">
        <div class="img">
            <img src="assets/img/logoayda.png">
        </div>
        <div class="login-content">
            <form action="proc_log" method="POST">
                <img src="assets/img/logokospin.png">
                <br><br>
                <h3 class="title">CCC Online - AYDA</h3>
                <br><br>
                <div class="input-div one">
                   <div class="i">
                        <i class="fas fa-user"></i>
                   </div>
                   <div class="div">
                        <h5>Username</h5>
                        <input id="login_username" type="text" class="input" name="username" maxlength="6" >
                        
                   </div>
                </div>
                <div class="input-div pass">
                   <div class="i"> 
                        <i class="fas fa-lock"></i>
                   </div>
                   <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input" name="password" id="password">
                        <div class="eye">
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </div>
                   </div>
                </div>
               <br>
                <input type="submit" class="btn" id="submit" name="submit" value="login">
                <br>  
            </form>
        </div>
    </div>

    

</body>
</html>

    <script type="text/javascript" src="assets/js/main.js"></script>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.js"></script>
    <script src="plugins/node-waves/waves.js"></script>
    <script src="assets/js/toogle.js"></script>
	


    
