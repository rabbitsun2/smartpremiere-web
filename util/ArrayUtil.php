<?php
/*
 * Created Date: 2022-07-02 (Sat)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ArrayUtil
 * Filename: ArrayUtil.php
 * Description:
 * 1. 다차원 배열 여부 판별 함수 구현, 정도윤, 2022-07-02.
*/


class ArrayUtil{

    public static function getDimensionArray($arr) {

        $result = -1;

        foreach ($arr as $t1){

            foreach ($t1 as $i2){
                
                foreach ( $i2 as $j3 ){
                    //echo "참1/" . $i . " ";
                    $result = 3;
                }
                //echo "참1/" . $i . " ";

                if ( $result === -1 ){
                    $result = 2;
                }
            }
            //echo "참3/ ";

            if ( $result === -1 ){
                $result = 1;
            }

        }

        return $result;

    }

}

?>