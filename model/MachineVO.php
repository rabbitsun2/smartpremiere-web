<?php
/*
 * Created Date: 2022-07-27 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MachineVO
 * Filename: MachineVO.php
 * Description:
 * 1. 신규 생성, 정도윤, 2022-07-27(Wed).
 * 
 */

class MachineVO{

    private $machine_id;
    private $machine_name;
    private $uuid;
    private $memo;
    private $locked;
    private $regidate;
    private $ip;

    public function getMachine_id(){
        return $this->machine_id;
    }

    public function setMachine_id($machine_id){
        $this->machine_id = $machine_id;
    }

    public function getMachine_name(){
        return $this->machine_name;
    }

    public function setMachine_name($machine_name){
        $this->machine_name = $machine_name;
    }

    public function getUuid(){
        return $this->uuid;
    }

    public function setUuid($uuid){
        $this->uuid = $uuid;
    }

    public function getMemo(){
        return $this->memo;
    }

    public function setMemo($memo){
        $this->memo = $memo;
    }

    public function getLocked(){
        return $this->locked;
    }

    public function setLocked($locked){
        $this->locked = $locked;
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