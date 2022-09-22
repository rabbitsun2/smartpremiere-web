<?php
    
/*
 * Created Date: 2022-07-02 (Sat)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ProjectVO
 * Filename: ProjectVO.php
 * Description:
 *
*/


class ProjectVO{

    private $project_id;
    private $project_name;
    private $description;
    private $startdate;
    private $enddate;
    private $regidate;
    private $ip;
    private $file_option;

    public function getProject_id(){
        return $this->project_id;
    }

    public function setProject_id($project_id){
        $this->project_id = $project_id;
    }

    public function getProject_name(){
        return $this->project_name;
    }

    public function setProject_name($project_name){
        $this->project_name = $project_name;
    }
    
    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getStartdate(){
        return $this->startdate;
    }

    public function setStartdate($startdate){
        $this->startdate = $startdate;
    }
    
    public function getEnddate(){
        return $this->enddate;
    }

    public function setEnddate($enddate){
        $this->enddate = $enddate;
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

    public function getFile_option(){
        return $this->file_option;
    }

    public function setFile_option($file_option){
        $this->file_option = $file_option;
    }

}

?>