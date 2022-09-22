<?php
/*
 * Created Date: 2022-07-29 (Fri)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ShockSpecificVO
 * Filename: ShockSpecificVO.php
 * Description:
 * 1. 신규 생성, 정도윤, 2022-07-29(Fri).
 * 
 */

class ShockSpecificVO{

    private $machine_id;
    private $startdate;
    private $enddate;

    public function getMachine_id(){
        return $this->machine_id;
    }

    public function setMachine_id($machine_id){
        $this->machine_id = $machine_id;
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

}

?>