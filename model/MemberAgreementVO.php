<?php
/*
 * Created Date: 2022-07-25 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MemberAgreementVO
 * Filename: MemberAgreementVO.php
 * Description:
 * 1. 
 * 
 */

class MemberAgreementVO{

    private $id;
    private $require_agree;
    private $option_agree;
    private $member_id;
    private $status;
    private $regidate;
    private $ip;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getRequire_agree(){
        return $this->require_agree;
    }

    public function setRequire_agree($require_agree){
        $this->require_agree = $require_agree;
    }

    public function getOption_agree(){
        return $this->option_agree;
    }

    public function setOption_agree($option_agree){
        $this->option_agree = $option_agree;
    }

    public function getMember_id(){
        return $this->member_id;
    }

    public function setMember_id($member_id){
        $this->member_id = $member_id;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
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