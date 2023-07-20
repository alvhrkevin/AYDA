<?php
include ('include/API_functions.php');
include ('include/function_rupiah.php');
$rekening = $_POST['rekening'];
$API = new API_functions();
$cek_eksnasabah = $API->cek_eksnasabah($rekening);
$data = array(//Parse Array Jadi Object
    'no_rek'     =>  $rekening,
    'kantor'     =>  $cek_eksnasabah['data'][0]['kantor'],
    'ket_rek'    =>  $cek_eksnasabah['data'][0]['ket_rek'],
    'kode_rek'   =>  $cek_eksnasabah['data'][0]['kode_rek'],
    'nama'       =>  $cek_eksnasabah['data'][0]['nama'],
    'alamat'     =>  $cek_eksnasabah['data'][0]['alamat'],
    'plafond'    =>  $cek_eksnasabah['data'][0]['plafond'],
    'saldo'      =>  $cek_eksnasabah['data'][0]['saldo'],
    'tgl_akad'   =>  $cek_eksnasabah['data'][0]['tgl_akad'],
    'tgl_jth'    =>  $cek_eksnasabah['data'][0]['tgl_jth'],
    'bungatgk'   =>  $cek_eksnasabah['data'][0]['tgk_bunga'],
    'TGK_DENDA'  =>  $cek_eksnasabah['data'][0]['TGK_DENDA']  
);
sleep(5);
if ($cek_eksnasabah) {
    if ($cek_eksnasabah['responseCode'] == "00") {
        echo json_encode($cek_eksnasabah['data'][0], true);
    } else {
        http_response_code(400); // Set HTTP response code to indicate an error
        $error_message = "Nomor rekening tidak valid. Silakan periksa kembali.";
        echo json_encode(array('error' => $error_message));
    }
} else {
    http_response_code(500); // Set HTTP response code to indicate a server error
    $error_message = "Terjadi kesalahan saat terhubung ke API.";
    echo json_encode(array('error' => $error_message));
}

?>

