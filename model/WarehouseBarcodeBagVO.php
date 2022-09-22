<?php
    
/*
 * Created Date: 2022-08-15 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: WarehouseBarcodeBagVO
 * Filename: WarehouseBarcodeBagVO.php
 * Description:
 *
*/

class WarehouseBarcodeBagVO{

    private $id;
    private $member_id;
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