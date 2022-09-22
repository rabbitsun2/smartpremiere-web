<?php
/*
 * Created Date: 2022-06-06 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MemberVO
 * Filename: MemberVO.php
 * Description:
 * 1. 수정일자 반영, 정도윤, 2022-07-02(Sat).
 * 2. 락 기능 추가 반영, 정도윤, 2022-07-25(Mon).
 */

class MemberVO{

    private $member_id;
    private $email;
    private $member_auth;
    private $auth_name;
    private $usrname;
    private $passwd;
    private $regidate;
    private $modify_date;
    private $locked;
    private $ip;

    public function getMember_id(){
        return $this->member_id;
    }

    public function setMember_id($member_id){
        $this->member_id = $member_id;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getMember_auth(){
        return $this->member_auth;
    }

    public function setMember_auth($member_auth){
        $this->member_auth = $member_auth;
    }

    public function getAuth_name(){
        return $this->auth_name;
    }

    public function setAuth_name($auth_name){
        $this->auth_name = $auth_name;
    }

    public function getUsrname(){
        return $this->usrname;
    }

    public function setUsrname($usrname){
        $this->usrname = $usrname;
    }

    public function getPasswd(){
        return $this->passwd;
    }

    public function setPasswd($passwd){
        $this->passwd = $passwd;
    }

    public function getRegidate(){
        return $this->regidate;
    }

    public function setRegidate($regidate){
        $this->regidate = $regidate;
    }

    public function getModify_date(){
        return $this->modify_date;
    }

    public function setModify_date($modify_date){
        $this->modify_date = $modify_date;
    }

    public function getLocked(){
        return $this->locked;
    }

    public function setLocked($locked){
        $this->locked = $locked;
    }

    public function getIp(){
        return $this->ip;
    }

    public function setIp($ip){
        $this->ip = $ip;
    }

}

?>