<?php
 
class API_functions {
 
   protected function credential (){
        $credential['appId'] = 'Dashc3Online';
        $credential['secretKey'] = '0e5749769977a4795da290db260d042e';
        return $credential;
   }

   protected function url(){
    // $url = 'http://202.152.56.91/apiccc/v1/ccconline/';
    $url = 'http://jasakoe.kospinjasa.com:3333/apiccc/v1/ccconline/';
        return $url;
   }

    protected function token(){
        $credential = $this->credential();
        $jsonbody = json_encode($credential, JSON_UNESCAPED_SLASHES);

        $header = array(
            'Content-Type: application/json'
        );

        $process = curl_init($this->url().'token');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{
            $hasil = json_decode($response,true);
            if ($hasil['responseCode'] == "00") {
                
                return $hasil['accessToken'];
            } else {
                
                die();
            }  
        }
    }

    protected function time(){
        $time = date('Y-m-d H:i:s');
        return $time;
    }

    protected function signature($s1,$s2,$s3,$s4){
        $verb       = 'POST';
        $secretKey   = 'secretKey';
        $payload    = 'path='.$s1.'&verb='.$verb.'&token=Bearer '.$s2.'&timestamp='.$s3.'&body='.$s4;

        $hash       = hash_hmac('SHA256', $payload, $secretKey, true);
        $signature  = base64_encode($hash);
        return $signature;
    }

    public function login($s1,$s2){

        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/login";
        $body       = array(
                        "username" => $s1,
                        "password" => $s2
                    );
        
        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);

        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'login');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return json_decode($response,true);
        }
    }

    public function cek_eksnasabah($rekening){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/cek_eksnasabah";
        $body       = array(
                        "rekening"  => $rekening, 
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);

        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'cek_eksnasabah');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return json_decode($response,true);
        }
    }

    public function f_eks_peminjam($kode_kantor,$nama,$kode_rek,$alamat,$rekening,$ket_rek,$plafond,$saldo,$tgl_akad,$tgl_jth,$tgk_bunga,$tgk_denda,$tgk_lain,$ket_tgklain,$status,$userid,$useroto,$pil,$jml_aset,$asal_perolehan,$tgl_perolehan){

        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/eksnasabah";
        $body       = array(   
                        "kode_kantor"   => $kode_kantor,
                        "kode_rek"      => $kode_rek,
                        "ket_rek"       => $ket_rek,
                        "rekening"      => $rekening,
                        "nama"          => $nama,
                        "alamat"        => $alamat,
                        "plafond"       => $plafond,
                        "saldo"         => $saldo,
                        "tgl_akad"      => $tgl_akad,
                        "tgl_jth"       => $tgl_jth,
                        "tgk_bunga"     => $tgk_bunga,
                        "tgk_denda"     => $tgk_denda,
                        "tgk_lain"      => $tgk_lain,
                        "ket_tgklain"   => $ket_tgklain,
                        "status"        => $status,
                        "userid"        => $userid,
                        "useroto"       => $useroto,
                        "pil"           => $pil,
                        "jml_aset"      => $jml_aset,
                        "asal_perolehan"=> $asal_perolehan,
                        "tgl_perolehan" => $tgl_perolehan
        );

        
        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        // die($jsonbody);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'eksnasabah');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        // die($response);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return json_decode($response,true);
        }
    }

    public function data_eksnasabah(){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/data_eksnasabah";
        $body       = array(
                        "noprod"  => '', 
                    );
 
        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'data_eksnasabah');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return ($response);  
        }
    }

    public function editnasabah($rek){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/edit_nasabah";
        $body       = array(
                        "rekening"  => $rek, 
                    );
        
        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'edit_nasabah');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return ($response); 
        }
    }

    public function input_aset($kode_kantor,$NO_ASET ,$rekening,$JNS_ASET,$KET_ASET , $JNS_PRO, $KET_PRO, $NM_ASET, $SUTRI_ASET, $ALAMAT_ASET, $ID_ASET , $JUDUL_ASET, $MEMO_ASET , $KEPEMILIKAN , $TGLAWAL_ASET, $TGLJTH_ASET, $MAP_LOK ,$NILAI_JUAL ,$MEMO_JUAL , $USERID , $oto_stat , $USEROTO, $PIL){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/aset";
        $body       = array(
                        "kode_kantor"     => $kode_kantor,
                        "NO_ASET"         => $NO_ASET,
                        "rekening"        => $rekening,
                        "JNS_ASET"        => $JNS_ASET,
                        "KET_ASET"        => $KET_ASET,
                        "JNS_PRO"         => $JNS_PRO,
                        "KET_PRO"         => $KET_PRO,
                        "SUTRI_ASET"      => $SUTRI_ASET,
                        "ALAMAT_ASET"     => $ALAMAT_ASET,
                        "KEPEMILIKAN"     => $KEPEMILIKAN,
                        "TGLAWAL_ASET"    => $TGLAWAL_ASET,
                        "TGLJTH_ASET"     => $TGLJTH_ASET,
                        "MAP_LOK"         => $MAP_LOK,
                        "NM_ASET"         => $NM_ASET,
                        "ID_ASET"         => $ID_ASET,
                        "JUDUL_ASET"      => $JUDUL_ASET,
                        "MEMO_ASET"       => $MEMO_ASET,
                        "NILAI_JUAL"      => $NILAI_JUAL,
                        "MEMO_JUAL"       => $MEMO_JUAL,
                        "USERID"          => $USERID,
                        "oto_stat"        => $oto_stat,
                        "USEROTO"         => $USEROTO,
                        "PIL"             => $PIL
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'aset');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return json_decode($response,true);
        }
    }

    public function asetPeminjam($rek){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/asetpeminjam";
        $body       = array(
                        "noprod"  => $rek, 
                    );
        
        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'asetpeminjam');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return ($response);
        }
    }

     public function jaset(){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/jaset";
        $body       = array(             
                        "rekening"  => "al", 
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);

        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'jaset');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return ($response);   
        }
    }

     public function jnspro($jnsaset){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/jpro";
        $body       = array(
                        "jnsaset"  => $jnsaset, 
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);

        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'jpro');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return json_decode($response,true);
        }
    }

   public function property($noaset, $harga_penawaran){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/cekproperty";
        $body       = array(
                        "NO_ASET"  => $noaset, 
                        "KETERANGAN" => $harga_penawaran
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'cekproperty');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return ($response);
        }
    }

    public function input_pro($isi){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/property";
        $split=explode("#",$isi);
        $NO_ASET    = $split[0];
        $JNS_PRO    = $split[1];
        $INDEK_PRO  = $split[2];
        $NILAI      = $split[3];
        
        $body       = array(
                        "NO_ASET"       => $NO_ASET,
                        "JNS_PRO"       => $JNS_PRO,
                        "INDEK_PRO"     => $INDEK_PRO,
                        "NILAI"         => str_replace(".", "",$NILAI)
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
   
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'property');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return json_decode($response,true);
        }
    }

    public function input_fasilitas($NO_ASET, $KEAMANAN, $JLN_TOL, $PASAR_LAMA, $SEKOLAH, $B_BANJIR, $KEBUGARAN, $MASUK_MOBIL,
        $PST_BELANJA, $R_SAKIT, $MINI_MARKET, $PST_KOTA, $JLN_RAYA, $STASIUN_TRM_BND, $MASJID, $TMPT_IBADAHLAIN){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/inputfasilitas";
        $body       = array(

                    "NO_ASET"            => $NO_ASET,
                    "KEAMANAN"           => $KEAMANAN,
                    "JLN_TOL"            => $JLN_TOL,
                    "PASAR_LAMA"         => $PASAR_LAMA,
                    "SEKOLAH"            => $SEKOLAH,
                    "B_BANJIR"           => $B_BANJIR,
                    "KEBUGARAN"          => $KEBUGARAN,
                    "MASUK_MOBIL"        => $MASUK_MOBIL,
                    "PST_BELANJA"        => $PST_BELANJA,
                    "R_SAKIT"            => $R_SAKIT,
                    "MINI_MARKET"        => $MINI_MARKET,
                    "PST_KOTA"           => $PST_KOTA,
                    "JLN_RAYA"           => $JLN_RAYA,
                    "STASIUN_TRM_BND"    => $STASIUN_TRM_BND,
                    "MASJID"             => $MASJID,
                    "TMPT_IBADAHLAIN"    => $TMPT_IBADAHLAIN
                );

        
        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'inputfasilitas');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return json_decode($response,true);
            
        }
    }

      public function data_aset(){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/allaset";
        $body       = array(
                        "NO_ASET"  => '', 
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);

        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'allaset');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return ($response);
        }
    }

     public function editasset($noaset){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/cekaset";
        $body       = array(
                        "noaset"  => $noaset, 
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'cekaset');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return ($response);
            
        }

    }


    public function input_foto($NO_ASET, $INDEK, $LINK, $USERID, $PIL, $KETERANGAN){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/inputfoto";
        $body       = array(
                        
                        "NO_ASET" => $NO_ASET,
                        "INDEK" => $INDEK,
                        "LINK" => $LINK,
                        "USERID" => $USERID,
                        "PIL" => $PIL,
                        "KETERANGAN" => $KETERANGAN

                    );

        
        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        
        $signature  = $this->signature($path,$token,$time,$jsonbody);

        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'inputfoto');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        // die($response);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return json_decode($response,true);
        }
    }

 public function cekfoto($noaset){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/cekfoto";
        $body       = array(
                        "noaset" => $noaset,
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);

        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'cekfoto');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
            
            if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{
            return ($response);
        }
    }

    public function display($noaset){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/cekfoto";
        $body       = array(
                        "noaset" => $noaset,
                    );
        
        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);

        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'cekfoto');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
            
        if($erno>0){
            $response = json_encode($eror); 
            die($response);
        }else{
            return ($response);
        }
    }

     public function otorisasi($no_prod, $status, $ovdoto){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/otoprod";
        $body       = array(
                        "noprod" => $no_prod, 
                        "status" => $status, 
                        "ovdoto" => $ovdoto         
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'otoprod');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{
            return json_decode($response,true);
        }
    }

    public function otoaset($noaset, $status, $ovdoto){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/otoaset";
        $body       = array(      
                        "noaset" => $noaset, 
                        "status" => $status, 
                        "ovdoto" => $ovdoto  
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'otoaset');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{
            return json_decode($response,true);
        }
    }

    public function cekfasilitas($noaset){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/cekfasilitas";
        $body       = array(
                        "noaset" => $noaset,
                    );
        
        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
    
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'cekfasilitas');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
            
            if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return ($response);            
        }
    }

     public function input_user($userid, $password, $nama, $wil, $status, $menu1, $menu2, $menu3, $ovdid){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/inputuser";
        $body       = array(    
                        "userid" => $userid, 
                        "password" => $password,
                        "nama" => $nama, 
                        "wil" => $wil,
                        "status" => $status,
                        "menu1" => $menu1,
                        "menu2" => $menu2,
                        "menu3" => $menu3,
                        "ovdid" => $ovdid          
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'inputuser');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{
            return json_decode($response,true);
        }
    }

    public function edit_user($userid, $password, $nama, $wil, $status, $menu1, $menu2, $menu3, $ovdid){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/edituser";
        $body       = array(
                        
                        "userid" => $userid, 
                        "password" => $password,
                        "nama" => $nama, 
                        "wil" => $wil,
                        "status" => $status,
                        "menu1" => $menu1,
                        "menu2" => $menu2,
                        "menu3" => $menu3,
                        "ovdid" => $ovdid    
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'edituser');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return json_decode($response,true);
        }
    }

    public function cek_user($userid){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/cekuser";
        $body       = array(
                        "userid" => $userid,
                    );
        
        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'cekuser');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
            
            if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return ($response);  
        }
    }

     public function cekwil($wilcode){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/cekwil";
        $body       = array(
                        "wilcode" => $wilcode,

                    );
        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'cekwil');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
            
            if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return ($response);
        }
    }

    public function cekPerolehan(){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/cekperolehan";
        $body       = array(
                        "KAKAL"  => "al", 
                    );

        
        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'cekperolehan');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);
        
        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return ($response);
        }
    }

    public function cekDetailPerolehan($noprod){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/cekdetailperolehan";
        $body       = array(
                        "noprod"  => $noprod, 
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);

        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'cekdetailperolehan');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return ($response);
        }
    }
    
    public function inputPerolehan($noprod,$nilai,$memo){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/updateperolehan";
        $body       = array(
                        "noprod"  => $noprod, 
                        "nilai_perolehan"  => $nilai,
                        "memo_perolehan"  => $memo
                    );
        
        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'updateperolehan');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return ($response);    
        }
    }

     public function cekjenisaset($jnsaset){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/cekjenisaset";
        $body       = array(
                        "jnsaset"  => $jnsaset,           
                    );
        
        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'cekjenisaset');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);
        
        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return ($response);
        }
    }

     public function inputparameteraset($kd_aset, $ket_aset, $jnsaset){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/inputparameteraset";
        $body       = array(
                        "kd_aset"  => $kd_aset, 
                        "ket_aset" => $ket_aset,
                        "ket_jnsaset" => $jnsaset
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'inputparameteraset');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);
    
        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

           return json_decode($response,true);
            
        }

    }

    

    public function editparameteraset($kd_aset, $ket_aset, $jnsaset, $indek){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/editparameteraset";
        $body       = array(
                        
                        "kd_aset"  => $kd_aset, 
                        "ket_aset" => $ket_aset,
                        "ket_jnsaset" => $jnsaset,
                        "indek" => $indek
                    );

        
        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'editparameteraset');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);
        
        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

             return json_decode($response,true); 
        }
    }

      public function cekproperty($jnsaset,$indek){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/cekparameterproperty";
        $body       = array(
                        
                        "jns_aset"  => $jnsaset,
                        "indek" =>$indek
                    );

        
        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'cekparameterproperty');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);
       
        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

            return ($response);
        }
    }

     public function inputparameterproperty($jnsaset, $ket){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/inputparameterproperty";
        $body       = array( 
                        "jns_aset"  => $jnsaset, 
                        "keterangan" => $ket
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'inputparameterproperty');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);
        
        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

           return json_decode($response,true);
        }
    }    

    public function editparameterproperty($jnsaset, $ket, $indek){
        $token      = $this->token();
        $time       = $this->time();
        $path       = "/v1/ccconline/editparameterproperty";
        $body       = array(
                        "jns_aset"  => $jnsaset, 
                        "keterangan" => $ket,
                        "indek" => $indek
                    );

        $jsonbody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature  = $this->signature($path,$token,$time,$jsonbody);
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token,
            'signature: '.$signature,
            'timestamp: '.$time
        );

        $process = curl_init($this->url().'editparameterproperty');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $jsonbody);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);
        
        $response = curl_exec($process);
        $erno = curl_errno($process);
        $eror = curl_error($process);
        curl_close($process);
        if($erno>0){
            $response = json_encode($eror);
            
            die($response);
        }else{

             return json_decode($response,true);
        }
    }
    
}

?>