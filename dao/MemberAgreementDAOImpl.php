<?php
/*
 * Created Date: 2022-07-25 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MemberAgreementDAOImpl
 * Filename: MemberAgreementDAOImpl.php
 * Description:
 *
*/

class MemberAgreementDAOImpl implements MemberAgreementDAO{

    private $conn;

    private $SELECT_MEMBER_AGREEMENT_QRY;
    private $INSERT_MEMBER_QRY;

    private function loadQuery(){

        $this->INSERT_MEMBER_AGREEMENT_QRY = "INSERT INTO smart_member_agreement(require_agree, option_agree, member_id, status, regidate, ip) 
                                            VALUES(?, ?, ?, ?, ?, ?)";

    }

    public function __construct(){

    }

    public function __destruct(){

    }

    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }

    public function insertMemberAgreement($memberAgreementVO){
        
        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_MEMBER_AGREEMENT_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("iiisss", 
                            $require_agree, 
                            $option_agree, 
                            $member_id,
                            $status, 
                            $regidate,  
                            $ip);

            $require_agree = $memberAgreementVO->getRequire_agree();
            $option_agree = $memberAgreementVO->getOption_agree();
            $member_id = $memberAgreementVO->getMember_id();
            $status = $memberAgreementVO->getStatus();
            $regidate = $memberAgreementVO->getRegidate();
            $ip = $memberAgreementVO->getIp();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
            
        }

        return 0;
    }

}

?>