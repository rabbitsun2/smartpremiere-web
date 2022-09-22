<?php
/*
 * Created Date: 2022-07-03 (Sun)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: UUID
 * Filename: UUID.php
 * Description:
 *
*/

class UUID {
    /**
     * Generates version 1: MAC address
     */
    public static function v1() {

        return sprintf('%08x-%04x-%04x-%04x-%04x%08x',
               mt_rand(0, 0xffffffff),
               mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
               mt_rand(0, 0xffff), mt_rand(0, 0xffffffff)
        );

    }

    public static function v4() {

        return sprintf('%08x-%04x-%04x-%04x-%04x%08x',
           mt_rand(0, 0xffffffff),
           mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
           mt_rand(0, 0xffff), mt_rand(0, 0xffffffff)
         );
         
     }
         

}

?>