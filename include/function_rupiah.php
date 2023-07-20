 <?php 
        function rupiah($angka){
            $format_rupiah = "Rp " . number_format($angka,0,'.',',');
            return $format_rupiah;
        }

    ?>
