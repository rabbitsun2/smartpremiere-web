<?php
    
/*
 * Created Date: 2022-09-07 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ProductBoxSpecVO
 * Filename: ProductBoxSpecVO.php
 * Description:
 * 1. 초기 파일 생성, 정도윤, 2022-09-07 (Wed)
 * 
*/

class ProductBoxSpecVO{

    private $product_id;
    private $box_type_id;
    private $width;
    private $length;
    private $height;
    private $box_name;
    private $regidate;
    private $ip;

    public function getProduct_id(){
        return $this->product_id;
    }

    public function setProduct_id($product_id){
        $this->product_id = $product_id;
    }

    public function getBox_type_id(){
        return $this->box_type_id;
    }

    public function setBox_type_id($box_type_id){
        $this->box_type_id = $box_type_id;
    }

    public function getWidth(){
        return $this->width;
    }

    public function setWidth($width){
        $this->width = $width;
    }

    public function getLength(){
        return $this->length;
    }

    public function setLength($length){
        $this->length = $length;
    }

    public function getHeight(){
        return $this->height;
    }

    public function setHeight($height){
        $this->height = $height;
    }

    public function getBox_name(){
        return $this->box_name;
    }

    public function setBox_name($box_name){
        $this->box_name = $box_name;
    }

    public function getRegidate(){
        return $this->regidate;
    }

    public function setRegidate($regidate){
        $this->regidate = $regidate;
    }

    public function getIp(){
        return $this->ip;
    }

    public function setIp($ip){
        $this->ip = $ip;
    }

}

?>