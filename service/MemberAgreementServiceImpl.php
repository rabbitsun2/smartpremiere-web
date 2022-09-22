<?php
/*
 * Created Date: 2022-07-25 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MemberAgreementServiceImpl
 * Filename: MemberAgreementServiceImpl.php
 * Description:
 * 1. 
 */

class MemberAgreementServiceImpl implements MemberAgreementService{

    private $memberAgreementDAO;
    private $conn;

    public function __construct(){
        $this->memberAgreementDAO = null;
    }

    public function __destruct(){

        if ( $this->memberAgreementDAO != null ){
            unset($this->memberAgreementDAO);
        }

    }

    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }
    
    private function loadDAO(){
        
        $this->memberAgreementDAO = new MemberAgreementDAOImpl();
        
        $my_conn = $this->getConn();
        $this->memberAgreementDAO->setConn($my_conn);
    }

    public function insertMemberAgreement($memberAgreementVO){
        
        $this->loadDAO();
        return $this->memberAgreementDAO->insertMemberAgreement($memberAgreementVO);
    }

}

?>