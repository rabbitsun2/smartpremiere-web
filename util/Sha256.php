<?php
/*
 * Created Date: 2022-09-10 (Sat) / Chuseok
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: SHA256
 * Filename: Sha256.php
 * Description:
 *
*/

class Sha256{

    public static function encrypt($str, $secret_key='secret key', $secret_iv='secret iv')
    {
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 32)    ;
        return str_replace("=", "", base64_encode(
            openssl_encrypt($str, "AES-256-CBC", $key, 0, $iv))
        );
    }

    public static function decrypt($str, $secret_key='secret key', $secret_iv='secret iv')
    {

        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 32);
        return openssl_decrypt(
            base64_decode($str), "AES-256-CBC", $key, 0, $iv
        );

    }

}

?>