<?php
    
/*
 * Created Date: 2022-08-15 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: WarehouseBarcodeVO
 * Filename: WarehouseBarcodeVO.php
 * Description:
 *
*/

class WarehouseBarcodeVO{

    private $id;
    private $rand_id;
    private $regidate;
    private $ip;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
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