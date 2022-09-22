<?php
    
/*
 * Created Date: 2022-08-03 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ProductBarcodeVO
 * Filename: ProductBarcodeVO.php
 * Description:
 * 1. ProductBoxSpecVO.php 에서 ProductBarcodeVO.php로 변경, 정도윤, 2022-08-14 (Sun)
 * 
*/

class ProductBarcodeVO{

    private $product_id;
    private $rand_id;
    private $regidate;
    private $ip;

    public function getProduct_id(){
        return $this->product_id;
    }

    public function setProduct_id($product_id){
        $this->product_id = $product_id;
    }

    public function getRand_id(){
        return $this->rand_id;
    }

    public function setRand_id($rand_id){
        $this->rand_id = $rand_id;
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