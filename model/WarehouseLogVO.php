<?php
    
/*
 * Created Date: 2022-06-14 (Tue)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: WarehouseLogVO
 * Filename: WarehouseLogVO.php
 * Description:
 *
*/


class WarehouseLogVO{

    private $id;
    private $w_id;
    private $prev_w_id;
    private $prev_cnt;
    private $release_cnt;
    private $current_cnt;
    private $current_type;
    private $release_type;
    private $release_date;
    private $ip;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getW_id(){
        return $this->w_id;
    }

    public function setW_id($w_id){
        $this->w_id = $w_id;
    }

    public function getPrev_w_id(){
        return $this->prev_w_id;
    }

    public function setPrev_w_id($prev_w_id){
        $this->prev_w_id = $prev_w_id;
    }

    public function getPrev_cnt(){
        return $this->prev_cnt;
    }

    public function setPrev_cnt($prev_cnt){
        $this->prev_cnt = $prev_cnt;
    }

    public function getRelease_cnt(){
        return $this->release_cnt;
    }

    public function setRelease_cnt($release_cnt){
        $this->release_cnt = $release_cnt;
    }

    public function getCurrent_cnt(){
        return $this->current_cnt;
    }

    public function setCurrent_cnt($current_cnt){
        $this->current_cnt = $current_cnt;
    }

    public function getCurrent_type(){
        return $this->current_type;
    }

    public function setCurrent_type($current_type){
        $this->current_type = $current_type;
    }

    public function getRelease_type(){
        return $this->release_type;
    }

    public function setRelease_type($release_type){
        $this->release_type = $release_type;
    }

    public function getRelease_date(){
        return $this->release_date;
    }

    public function setRelease_date($release_date){
        $this->release_date = $release_date;
    }

    public function getIp(){
        return $this->ip;
    }

    public function setIp($ip){
        $this->ip = $ip;
    }

}

?>