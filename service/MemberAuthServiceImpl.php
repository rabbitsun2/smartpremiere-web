<?php
/*
 * Created Date: 2022-07-26 (Tue)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MemberAuthServiceImpl
 * Filename: MemberAuthServiceImpl.php
 * Description:
 * 1. 
 * 
 */

class MemberAuthServiceImpl implements MemberAuthService{

    private $memberAuthDAO;
    private $conn;

    public function __construct(){
        $this->memberAuthDAO = null;
    }

    public function __destruct(){

        if ( $this->memberAuthDAO != null ){
            unset($this->memberAuthDAO);
        }

    }

    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }
    
    private function loadDAO(){
        
        $this->memberAuthDAO = new MemberAuthDAOImpl();
        
        $my_conn = $this->getConn();
        $this->memberAuthDAO->setConn($my_conn);
    }

    public function insertMemberAuth($memberAuthVO){
        $this->loadDAO();
        return $this->memberAuthDAO->insertMemberAuth($memberAuthVO);
    }

    public function selectCountAllMemberAuth(){
        $this->loadDAO();
        return $this->memberAuthDAO->selectCountAllMemberAuth();
    }

    public function alterAutoIncrement(){
        $this->loadDAO();
        return $this->memberAuthDAO->alterAutoIncrement();
    }

    public function selectAllMemberAuth(){
        $this->loadDAO();
        return $this->memberAuthDAO->selectAllMemberAuth();
    }

    public function insertMemberAuthVal($memberAuthVO){
        $this->loadDAO();
        return $this->memberAuthDAO->insertMemberAuthVal($memberAuthVO);
    }

    public function selectFindAuthname($memberAuthVO){
        $this->loadDAO();
        return $this->memberAuthDAO->selectFindAuthname($memberAuthVO);
    }

    public function selectPagingMemberAuth($startNum, $endNum){
        $this->loadDAO();
        return $this->memberAuthDAO->selectPagingMemberAuth($startNum, $endNum);
    }

    public function selectFindId($memberAuthVO){
        $this->loadDAO();
        return $this->memberAuthDAO->selectFindId($memberAuthVO);
    }

    public function updateMemberAuth($memberAuthVO){
        $this->loadDAO();
        return $this->memberAuthDAO->updateMemberAuth($memberAuthVO);
    }

    public function deleteMemberAuth($memberAuthVO){
        $this->loadDAO();
        return $this->memberAuthDAO->deleteMemberAuth($memberAuthVO);
    }

}

?>