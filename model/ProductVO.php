<?php
    
/*
 * Created Date: 2022-06-12 (Sun)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ProductVO
 * Filename: ProductVO.php
 * Description:
 *
 * 
*/


class ProductVO{

    private $product_id;
    private $product_name;
    private $description;
    private $regidate;
    private $ip;
    private $project_id;
    private $file_option;

    public function getProduct_id(){
        return $this->product_id;
    }

    public function setProduct_id($product_id){
        $this->product_id = $product_id;
    }

    public function getProduct_name(){
        return $this->product_name;
    }

    public function setProduct_name($product_name){
        $this->product_name = $product_name;
    }
    
    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
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

    public function getProject_id(){
        return $this->project_id;
    }

    public function setProject_id($project_id){
        $this->project_id = $project_id;
    }

    public function getFile_option(){
        return $this->file_option;
    }

    public function setFile_option($file_option){
        $this->file_option = $file_option;
    }

}

?>