<?php
    
/*
 * Created Date: 2022-06-13 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: WarehouseVO
 * Filename: WarehouseVO.php
 * Description:
 *
*/


class WarehouseVO{

    private $id;
    private $product_id;
    private $product_cnt;
    private $create_date;
    private $create_type;
    private $ip;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getProduct_id(){
        return $this->product_no;
    }

    public function setProduct_id($product_no){
        $this->product_no = $product_no;
    }

    public function getProduct_cnt(){
        return $this->product_cnt;
    }

    public function setProduct_cnt($cnt){
        $this->product_cnt = $cnt;
    }

    public function getCreate_date(){
        return $this->create_date;
    }

    public function setCreate_date($create_date){
        $this->create_date = $create_date;
    }

    public function getCreate_type(){
        return $this->create_type;
    }

    public function setCreate_type($create_type){
        $this->create_type = $create_type;
    }
    
    public function getIp(){
        return $this->ip;
    }

    public function setIp($ip){
        $this->ip = $ip;
    }

}

?>