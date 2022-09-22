<?php
/*
 * Created Date: 2022-06-05 (Sun)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Controller
 * Filename: Controller.php
 * Description:
 * 1. 파일 업로드 크기 제한 추가, 정도윤, 2022-07-03(Sun)
 * 2. 사용자 환경설정 추가, 정도윤, 2022-09-10(Sat) / Chuseok.
 * 
 */

class Controller {
    
    private $root_dir;
    private $upload_dir;
    private $upload_size;
    private $smarty;
    private $conn;
    private $service_mode;
    private $usr_config;
    
    private $root_route;
    private $second_route;
    private $third_route;
    
    public function __contruct(){
        $this->root_dir = null;
        $this->smarty = null;
    }
    
    public function __destruct(){
        unset($this->smarty);
    }
    
    public function getRootDir(){
        return $this->root_dir;
    }
    
    public function setRootDir($root_dir){
        $this->root_dir = $root_dir;
    }
    
    public function getUploadDir(){
        return $this->upload_dir;
    }
    
    public function setUploadDir($upload_dir){
        $this->upload_dir = $upload_dir;
    }

    public function getUploadSize(){
        return $this->upload_size;
    }

    public function setUploadSize($upload_size){
        $this->upload_size = $upload_size;
    }
    
    public function getSmarty(){
        return $this->smarty;
    }
    
    public function setSmarty($smarty){
        $this->smarty = $smarty;
    }
    
    public function getConn(){
        return $this->conn;
    }
    
    public function setConn($conn){
        $this->conn = $conn;
    }
    
    public function getRootRoute(){
        return $this->root_route;
    }
    
    public function setRootRoute($root_route){
        $this->root_route = $root_route;
    }
    
    public function getSecondRoute(){
        return $this->second_route;
    }
    
    public function setSecondRoute($second_route){
        $this->second_route = $second_route;
    }
    
    public function getThirdRoute(){
        return $this->third_route;
    }
    
    public function setThirdRoute($third_route){
        $this->third_route = $third_route;
    }

    public function getServiceMode(){
        return $this->service_mode;
    }

    public function setServiceMode($service_mode){
        $this->service_mode = $service_mode;
    }
    
    public function getUsr_config(){
        return $this->usr_config;
    }

    public function setUsr_config($usr_config){
        $this->usr_config = $usr_config;
    }

}

?>