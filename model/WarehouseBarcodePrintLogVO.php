<?php
    
/*
 * Created Date: 2022-08-15 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: WarehouseBarcodePrintLogVO
 * Filename: WarehouseBarcodePrintLogVO.php
 * Description:
 *
*/

class WarehouseBarcodePrintLogVO{

    private $id;
    private $member_id;
    private $release_cnt;
    private $release_type;
    private $print_type;
    private $regidate;
    private $ip;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getMember_id(){
        return $this->member_id;
    }

    public function setMember_id($member_id){
        $this->member_id = $member_id;
    }

    public function getRelease_cnt(){
        return $this->release_cnt;
    }

    public function setRelease_cnt($release_cnt){
        $this->release_cnt = $release_cnt;
    }

    public function getRelease_type(){
        return $this->release_type;
    }

    public function setRelease_type($release_type){
        $this->release_type = $release_type;
    }

    public function getPrint_type(){
        return $this->print_type;
    }

    public function setPrint_type($print_type){
        $this->print_type = $print_type;
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