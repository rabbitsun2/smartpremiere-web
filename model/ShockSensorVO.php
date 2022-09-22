<?php
/*
 * Created Date: 2022-07-27 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ShockSensorVO
 * Filename: ShockSensorVO.php
 * Description:
 * 1. 신규 생성, 정도윤, 2022-07-27(Wed).
 * 
 */

class ShockSensorVO{

    private $id;
    private $machine_id;
    private $message;
    private $regidate;
    private $ip;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getMachine_id(){
        return $this->machine_id;
    }

    public function setMachine_id($machine_id){
        $this->machine_id = $machine_id;
    }

    public function getMessage(){
        return $this->message;
    }

    public function setMessage($message){
        $this->message = $message;
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