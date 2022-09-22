<?php

/*
 * Created Date: 2022-07-10 (Sun)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ProductFileVO
 * Filename: ProductFileVO.php
 * Description:
 *
*/
class ProductFileVO{

    private $product_id;
    private $uuid;
    private $root_dir;
    private $upload_dir;
    private $file_ext;
    private $file_size;
    private $original_name;
    private $file_name;
    private $file_type;
    private $regidate;
    private $ip;
    private $option;


    public function getProduct_id(){
        return $this->product_id;
    }

    public function setProduct_id($product_id){
        $this->product_id = $product_id;
    }

    public function getUuid(){
        return $this->uuid;
    }

    public function setUuid($uuid){
        $this->uuid = $uuid;
    }

    public function getRoot_dir(){
        return $this->root_dir;
    }

    public function setRoot_dir($root_dir){
        $this->root_dir = $root_dir;
    }

    public function getUpload_dir(){
        return $this->upload_dir;
    }

    public function setUpload_dir($upload_dir){
        $this->upload_dir = $upload_dir;
    }

    public function getFile_ext(){
        return $this->file_ext;
    }

    public function setFile_ext($file_ext){
        $this->file_ext = $file_ext;
    }

    public function getFile_size(){
        return $this->file_size;
    }

    public function setFile_size($file_size){
        $this->file_size = $file_size;
    }

    public function getOriginal_name(){
        return $this->original_name;
    }

    public function setOriginal_name($original_name){
        $this->original_name = $original_name;
    }

    public function getFile_name(){
        return $this->file_name;
    }

    public function setFile_name($file_name){
        $this->file_name = $file_name;
    }

    public function getFile_type(){
        return $this->file_type;
    }

    public function setFile_type($file_type){
        $this->file_type = $file_type;
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

    public function getOption(){
        return $this->option;
    }

    public function setOption($option){
        $this->option = $option;
    }

}

?>