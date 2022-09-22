<?php
/*
 * Created Date: 2022-07-26 (Tue)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MemberAuthDAOImpl
 * Filename: MemberAuthDAOImpl.php
 * Description:
 *
*/

class MemberAuthDAOImpl implements MemberAuthDAO{

    private $conn;

    private $INSERT_MEMBER_AUTH_QRY;
    private $SELECT_MEMBER_AUTH_COUNT_ALL;
    private $ALTER_MEMBER_AUTH_AUTO_INCREMENT_QRY;

    private $SELECT_ALL_MEMBER_AUTH_QRY;
    private $INSERT_MEMBER_AUTH_VAL_QRY;
    private $SELECT_MEMBER_AUTH_FIND_AUTH_NAME_QRY;
    private $SELECT_MEMBER_AUTH_PAGING_QRY;

    private $SELECT_MEMBER_AUTH_FIND_ID_QRY;
    private $UPDATE_MEMBER_AUTH_QRY;
    private $DELETE_MEMBER_AUTH_QRY;

    private function loadQuery(){

        $this->INSERT_MEMBER_AUTH_QRY = "INSERT INTO smart_member_auth(id, auth_name) 
                                            VALUES(?, ?)";
        
        $this->SELECT_MEMBER_AUTH_COUNT_ALL = "SELECT COUNT(*) AS 'cnt' FROM smart_member_auth";

        $this->ALTER_MEMBER_AUTH_AUTO_INCREMENT_QRY = "ALTER TABLE smart_member_auth AUTO_INCREMENT = 1";

        $this->SELECT_ALL_MEMBER_AUTH_QRY = "SELECT * FROM smart_member_auth ORDER BY id";

        $this->INSERT_MEMBER_AUTH_VAL_QRY = "INSERT INTO smart_member_auth(auth_name) 
                                                VALUES(?)";

        $this->SELECT_MEMBER_AUTH_FIND_AUTH_NAME_QRY = "SELECT * FROM smart_member_auth WHERE auth_name = ?";

        $this->SELECT_MEMBER_AUTH_PAGING_QRY = "SELECT id, auth_name FROM smart_member_auth 
                                                ORDER by id desc LIMIT ? OFFSET ?";

        $this->SELECT_MEMBER_AUTH_FIND_ID_QRY = "SELECT * FROM smart_member_auth WHERE id = ?";

        $this->UPDATE_MEMBER_AUTH_QRY = "UPDATE smart_member_auth SET auth_name = ? WHERE id = ?";

        $this->DELETE_MEMBER_AUTH_QRY = "DELETE FROM smart_member_auth WHERE id = ?";

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

    public function insertMemberAuth($memberAuthVO){
        
        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_MEMBER_AUTH_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("is", $id, $auth_name);

            $id = $memberAuthVO->getId();
            $auth_name = $memberAuthVO->getAuth_name();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
            
        }

        return 0;
    }

    public function selectCountAllMemberAuth(){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_MEMBER_AUTH_COUNT_ALL);

            //print_r($boardFileVO);

            $stmt->execute();
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            
            
        }else{
            //echo "DB-거짓";
        }

        //return $boardArr;
        return $rows;

    }

    public function alterAutoIncrement(){

        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            mysqli_query($mysqlConn, $this->ALTER_MEMBER_AUTH_AUTO_INCREMENT_QRY);
            
            return 1;
            
        }

        return 0;

    }

    public function selectAllMemberAuth(){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_ALL_MEMBER_AUTH_QRY);

            //print_r($boardFileVO);

            $stmt->execute();
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            
            
        }else{
            //echo "DB-거짓";
        }

        //return $boardArr;
        return $rows;

    }

    public function insertMemberAuthVal($memberAuthVO){

        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_MEMBER_AUTH_VAL_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("s", $auth_name);
            $auth_name = $memberAuthVO->getAuth_name();
            
            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
            
        }

        return 0;

    }

    public function selectFindAuthname($memberAuthVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_MEMBER_AUTH_FIND_AUTH_NAME_QRY);

            //print_r($boardFileVO);
            $stmt->bind_param("s", $auth_name);
            $auth_name = $memberAuthVO->getAuth_name();

            $stmt->execute();
            
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            
            
        }else{
            //echo "DB-거짓";
        }

        //return $boardArr;
        return $rows;

    }
    
    public function selectPagingMemberAuth($startNum, $endNum){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_MEMBER_AUTH_PAGING_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("ii", $_limnum, $_startnum);
            
            // 오라클 페이징(자바 버전)
	    	//paramMap.put("startnum", startnum);		
    		//paramMap.put("endnum", endnum);			
		
            // mariaDB 페이징
            if ( $startNum === 1) {
                $_startnum = 0;
            }
            else {
                $_startnum = $startNum - 1;
            }
            
            $_limnum = ( $endNum - $startNum ) + 1;

            $stmt->execute();
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            
            
        }else{
            //echo "DB-거짓";
        }

        //return $boardArr;
        return $rows;

    }

    public function selectFindId($memberAuthVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_MEMBER_AUTH_FIND_ID_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $id);
            $id = $memberAuthVO->getId();

            $stmt->execute();
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            
            
        }else{
            //echo "DB-거짓";
        }

        //return $boardArr;
        return $rows;
        
    }

    public function updateMemberAuth($memberAuthVO){

        $my_conn = $this->getConn();
        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->UPDATE_MEMBER_AUTH_QRY);

                //print_r($boardVO);

                $stmt->bind_param("si", $auth_name, $id);

                $auth_name = $memberAuthVO->getAuth_name();
                $id = $memberAuthVO->getId();


                $stmt->execute();

                $mysqlConn->commit();

            }catch(mysqli_sql_exception $exception){

                $mysqlConn->rollback();
                throw $exception;

                //echo "참7 - 오류 <br>";

                return 0;
            }

        }

        //echo "참7 - 성공 <br>";

        return 1;

    }

    public function deleteMemberAuth($memberAuthVO){

        $my_conn = $this->getConn();

        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->DELETE_MEMBER_AUTH_QRY);

                //print_r($boardVO);

                $stmt->bind_param("i", $id);

                $id = $memberAuthVO->getId();

                $stmt->execute();

                $mysqlConn->commit();

            }catch(mysqli_sql_exception $exception){

                $mysqlConn->rollback();
                throw $exception;

                //echo "참7 - 오류 <br>";

                return 0;
            }

        }

        //echo "참7 - 성공 <br>";

        return 1;

    }

}

?>