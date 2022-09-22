<?php

/*
 * Created Date: 2022-08-28 (Sun)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ProjectProcessVO
 * Filename: ProjectProcessVO.php
 * Description:
 *
*/
class ProjectProcessVO{

    private $project_id;
    private $process_uuid;
    private $process_name;
    private $order_val;
    private $regidate;
    private $ip;

    public function getProject_id(){
        return $this->project_id;
    }

    public function setProject_id($project_id){
        $this->project_id = $project_id;
    }

    public function getProcess_uuid(){
        return $this->process_uuid;
    }

    public function setProcess_uuid($process_uuid){
        $this->process_uuid = $process_uuid;
    }

    public function getProcess_name(){
        return $this->process_name;
    }

    public function setProcess_name($process_name){
        $this->process_name = $process_name;
    }

    public function getOrder_val(){
        return $this->order_val;
    }

    public function setOrder_val($order_val){
        $this->order_val = $order_val;
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