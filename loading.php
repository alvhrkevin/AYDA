<?php
session_start();
    if( !isset($_SESSION["userId"])){
         header("Location: ./");
       exit;
       }
       
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/img/favicon/ayda.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/loading.css">
</head>
<body>
    <div class="container">
        <div class="text">
            <h1>Loading...</h1>
        </div>
        <div id="loading" class="loading" >
            <div class="line-box">
                <div class="line"></div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
      // Mendeteksi kecepatan koneksi pengguna
      function getInternetSpeed() {
        var url = "https://example.com/file-to-download"; // Ganti dengan URL file yang dapat diunduh
        var startTime = new Date().getTime();
        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4) {
            var endTime = new Date().getTime();
            var duration = endTime - startTime;
            var fileSize = xhr.getResponseHeader("Content-Length");
            var speed = (fileSize / duration / 1000).toFixed(2); // Kecepatan dalam KB/s

            redirectToNextPage(speed);
          }
        };
        xhr.send();
      }

      // Mengarahkan pengguna ke halaman berikutnya berdasarkan kecepatan koneksi
      function redirectToNextPage(speed) {
        var nextPageUrl = "beranda"; // Ganti dengan URL halaman berikutnya
        if (speed > 2000) {
          window.location.href = nextPageUrl;
        } else if (speed > 1000) {
          window.location.href = nextPageUrl;
        } else {
          window.location.href = nextPageUrl;
        }
      }

      // Menyesuaikan animasi loading berdasarkan kecepatan koneksi
      function adjustLoadingAnimation(speed) {
        var lineElement = document.querySelector(".line");
        var animationDuration = 2; // Durasi animasi default (dalam detik)

        if (speed > 0) {
          // Menghitung durasi animasi berdasarkan kecepatan koneksi
          animationDuration = (1 / speed).toFixed(2);
        }

        // Mengatur durasi animasi pada elemen line
        lineElement.style.animationDuration = animationDuration + "s";

        // Menampilkan loading saat halaman dimuat
        var loadingElement = document.getElementById("loading");
        loadingElement.style.display = "block";
      }

      // Memulai deteksi kecepatan koneksi saat halaman dimuat
      getInternetSpeed();
    });
</script>
    
