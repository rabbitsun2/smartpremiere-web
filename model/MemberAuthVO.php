<?php
/*
 * Created Date: 2022-07-25 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MemberAuthVO
 * Filename: MemberAuthVO.php
 * Description:
 * 1. 
 * 
 */

class MemberAuthVO{

    private $id;
    private $auth_name;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getAuth_name(){
        return $this->auth_name;
    }

    public function setAuth_name($auth_name){
        $this->auth_name = $auth_name;
    }

}

?>