<?php
/*
 * Created Date: 2022-06-06 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MemberServiceImpl
 * Filename: MemberServiceImpl.php
 * Description:
 * 1. 사용자 관리 페이징 기능 추가, 정도윤, 2022-06-19(Sun)
 */

class MemberServiceImpl implements MemberService{

    private $memberDAO;
    private $conn;

    public function __construct(){
        $this->memberDAO = null;
    }

    public function __destruct(){

        if ( $this->memberDAO != null ){
            unset($this->memberDAO);
        }

    }

    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }
    
    private function loadDAO(){
        
        $this->memberDAO = new MemberDAOImpl();
        
        $my_conn = $this->getConn();
        $this->memberDAO->setConn($my_conn);
    }

    public function selectMember($memberVO){
        
        $this->loadDAO();
        return $this->memberDAO->selectMember($memberVO);
    }

    public function selectMemberAuth(){
        $this->loadDAO();
        return $this->memberDAO->selectMemberAuth();
    }

    public function insertMember($memberVO){
        $this->loadDAO();
        return $this->memberDAO->insertMember($memberVO);
    }

    public function selectAllMemberCount(){
        $this->loadDAO();
        return $this->memberDAO->selectAllMemberCount();
    }

    public function selectPagingMember($startNum, $endNum){
        $this->loadDAO();
        return $this->memberDAO->selectPagingMember($startNum, $endNum);
    }

    public function updateMember($memberVO){
        $this->loadDAO();
        return $this->memberDAO->updateMember($memberVO);
    }

    public function deleteMember($memberVO){
        $this->loadDAO();
        return $this->memberDAO->deleteMember($memberVO);
    }

    public function selectMemberFindId($memberVO){
        $this->loadDAO();
        return $this->memberDAO->selectMemberFindId($memberVO);
    }

    public function selectMemberFindEmailAndUsrname($memberVO){
        $this->loadDAO();
        return $this->memberDAO->selectMemberFindEmailAndUsrname($memberVO);
    }

    public function updateMemberChangePasswd($memberVO){
        $this->loadDAO();
        return $this->memberDAO->updateMemberChangePasswd($memberVO);
    }

}

?>