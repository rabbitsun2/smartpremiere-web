<?php
/*
 * Created Date: 2022-08-03 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: RandUtil
 * Filename: RandUtil.php
 * Description:
 * 1. 바코드 난수 생성 구현, 정도윤, 2022-08-03 (Wed).
 * 2. 랜덤 비밀번호 생성, 정도윤, 2022-09-10 (Sat) / Chuseok.
*/


class RandUtil{

    public static function createBarcode() {

        $rand_id = -1;
        $tmp_number = rand(10000, 99999);
        $rand_id = (string)$tmp_number;

        $tmp_number = rand(10000, 99999);
        $rand_id = $rand_id . (string)$tmp_number;

        $tmp_number = rand(100, 999);
        $rand_id = $rand_id . (string)$tmp_number;

        return $rand_id;

    }

    public static function createPassword() {

        $rand_id = -1;
        $tmp_number = rand(10000, 99999);
        $rand_id = (string)$tmp_number;

        $tmp_number = rand(10000, 99999);
        $rand_id = $rand_id . (string)$tmp_number;

        $rand_pwd = Sha256::encrypt($rand_id, '123456789', '#@!$%^&*');

        return $rand_pwd;

    }

}

?>