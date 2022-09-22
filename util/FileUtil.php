<?php

/*
 * Created Date: 2022-07-03 (Sun)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: FileUtil
 * Filename: FileUtil.php
 * Description:
 * 1. 파일 크기 단위로 변환 구현, 정도윤, 2022-07-03 (Sun).
 * 2. 파일 업로드 확장자 방어, 정도윤, 2022-07-03 (Sun).
 * 3. 파일 업로드 사진파일만 허용, 정도윤, 2022-07-10 (Sun).
 * 4. 폴더 크기 측정 기능 추가, 2022-08-31 (Tue).
 * 5. 파일 크기 변환 기능 추가, 2022-08-31 (Tue).
 * 
*/

class FileUtil{

    public static function convfileSize($size) {

        $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
        
        if ($size == 0) {
            return('n/a');
        } else {
            return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]);
        }

    }

    public static function checkFileExtRestrict($file_ext){

        $status = 1;

        $restrict_ext = array("php", "php3", "php4", "phps", "html", "htm", 
                                "py", "sh", "cmd", "exe");

        for ( $i = 0; $i < count($restrict_ext) &&
                      $status === 1; $i++ ){
            
            if ( strcmp( $file_ext, $restrict_ext[$i] ) === 0 ){
                $status = -1;
                //echo "참";
            }

        }

        if ($status === 1){
            return 0;
        }else{
            return 1;
        }
    
    }

    public static function checkFileExtAllowPhoto($file_ext){

        $status = -1;

        $allow_ext = array("jpg", "png", "gif", "jpeg", "bmp", 
                           "JPG", "PNG", "GIF", "JPEG", "BMP");

        for ( $i = 0; $i < count($allow_ext) &&
                      $status === -1; $i++ ){
            
            if ( strcmp( $file_ext, $allow_ext[$i] ) === 0 ){
                $status = 1;
                //echo "참";
            }

        }

        if ($status === 1){
            return 1;
        }else{
            return 0;
        }
    
    }

    // 폴더 전체용량 
    public static function getDirectorySize($path){
        $bytestotal = 0;
        $path = realpath($path);
        if($path!==false && $path!='' && file_exists($path)){
            foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
                $bytestotal += $object->getSize();
            }
        }
        return $bytestotal;
    }

}

?>