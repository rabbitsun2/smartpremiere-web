<?php
/*
 * Created Date: 2022-06-06 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MemberDAOImpl
 * Filename: MemberDAOImpl.php
 * Description:
 *
*/

class MemberDAOImpl implements MemberDAO{

    private $conn;

    private $MEMBER_VIEW_QRY;
    private $MEMBER_AUTH_ALL_QRY;
    private $INSERT_MEMBER_QRY;
    private $SELECT_MEMBER_ALL_COUNT_QRY;
    private $SELECT_MEMBER_PAGING_QRY;
    private $UPDATE_MEMBER_QRY;
    private $DELETE_MEMBER_QRY;
    private $SELECT_MEMBER_FIND_ID_QRY;
    private $SELECT_MEMBER_FIND_EMAIL_AND_USRNAME_QRY;
    private $UPDATE_MEMBER_CHANGE_PASSWD_QRY;

    private function loadQuery(){

        $this->MEMBER_VIEW_QRY = "SELECT member_id, email, member_auth, auth_name, usrname, passwd, regidate, modify_date, locked, ip  
                                    FROM smart_member, smart_member_auth WHERE smart_member.member_auth = smart_member_auth.id AND 
                                    email = ?";

        $this->MEMBER_AUTH_ALL_QRY = "SELECT * FROM smart_member_auth ORDER BY id";

        $this->INSERT_MEMBER_QRY = "INSERT INTO smart_member(email, member_auth, usrname, passwd, regidate, modify_date, locked, ip) 
                                    VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

        $this->SELECT_MEMBER_ALL_COUNT_QRY = "SELECT COUNT(*) as 'cnt' FROM smart_member";

        $this->SELECT_MEMBER_PAGING_QRY = "SELECT member_id, email, member_auth, auth_name, usrname, passwd, regidate, modify_date, locked, ip  
                                            FROM smart_member, smart_member_auth 
                                            WHERE smart_member.member_auth = smart_member_auth.id 
                                            ORDER by member_id desc 
                                            LIMIT ? OFFSET ?";

        $this->UPDATE_MEMBER_QRY = "UPDATE smart_member SET member_auth = ?, usrname = ?, passwd = ?, modify_date = ?, locked = ?  
                                    WHERE member_id = ?";

        $this->DELETE_MEMBER_QRY = "DELETE FROM smart_member WHERE email = ?";

        $this->SELECT_MEMBER_FIND_ID_QRY = "SELECT member_id, email, member_auth, auth_name, usrname, passwd, regidate, 
                                            modify_date, locked, ip 
                                            FROM smart_member, smart_member_auth 
                                            WHERE smart_member.member_auth = smart_member_auth.id 
                                            AND member_id = ?";

        $this->SELECT_MEMBER_FIND_EMAIL_AND_USRNAME_QRY = "SELECT member_id, email, member_auth, auth_name, usrname, passwd, 
                                                            regidate, modify_date, locked, ip  
                                                            FROM smart_member, smart_member_auth 
                                                            WHERE smart_member.member_auth = smart_member_auth.id AND 
                                                            email = ? AND usrname = ?";

        $this->UPDATE_MEMBER_CHANGE_PASSWD_QRY = "UPDATE smart_member SET passwd = ? WHERE email = ?";

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

    public function selectMember($memberVO){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;

            //echo "참1";
            $stmt = $mysqlConn->prepare($this->MEMBER_VIEW_QRY);

            //echo $this->SELECT_VIEW_QRY;
            //print_r($boardVO);

            //echo "참2";
            $stmt->bind_param("s", $email);
            
            $email = $memberVO->getEmail();

            //echo $id . "할로<br>";

            $stmt->execute();
            //echo "참3";

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                //echo "참";

                /*
                while( $row = $result->fetch_assoc() ){
                    $rows[] = $row;
                }
                */

                $rows = $result->fetch_assoc();
                
                //echo $result->num_rows . "/";
                //print_r($rows);
                //echo "<br>";

            }

            $stmt->close();

            //print_r($rows);

        }
        //echo "참4";
        return $rows;

    }

    public function selectMemberAuth(){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->MEMBER_AUTH_ALL_QRY);

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

    public function insertMember($memberVO){
        
        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_MEMBER_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("sissssss", 
                            $email, 
                            $member_auth, 
                            $usrname,
                            $passwd,
                            $regidate,
                            $modify_date, 
                            $locked, 
                            $ip);

            $email = $memberVO->getEmail();
            $member_auth = $memberVO->getMember_auth();
            $usrname = $memberVO->getUsrname();
            $passwd = $memberVO->getPasswd();
            $regidate = $memberVO->getRegidate();
            $modify_date = $memberVO->getModify_date();
            $locked = $memberVO->getLocked();
            $ip = $memberVO->getIp();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
        }

        return 0;

    }

    public function selectAllMemberCount(){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_MEMBER_ALL_COUNT_QRY);
            
            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function selectPagingMember($startNum, $endNum){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_MEMBER_PAGING_QRY);

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

    public function updateMember($memberVO){
        
        $my_conn = $this->getConn();

        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->UPDATE_MEMBER_QRY);

                //print_r($boardVO);

                $stmt->bind_param("issssi", 
                                $member_auth,
                                $usrname,
                                $passwd, 
                                $modify_date, 
                                $locked, 
                                $member_id);

                $member_auth = $memberVO->getMember_auth();
                $usrname = $memberVO->getUsrname();
                $passwd = $memberVO->getPasswd();
                $modify_date = $memberVO->getModify_date();
                $locked = $memberVO->getLocked();
                $member_id = $memberVO->getMember_id();


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

    public function deleteMember($memberVO){

        $my_conn = $this->getConn();

        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->DELETE_MEMBER_QRY);

                //print_r($boardVO);

                $stmt->bind_param("s", 
                                $email);

                $email = $memberVO->getEmail();

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

    public function selectMemberFindId($memberVO){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;

            //echo "참1";
            $stmt = $mysqlConn->prepare($this->SELECT_MEMBER_FIND_ID_QRY);

            //echo $this->SELECT_VIEW_QRY;
            //print_r($boardVO);

            //echo "참2";
            $stmt->bind_param("i", $member_id);
            
            $member_id = $memberVO->getMember_id();

            //echo $id . "할로<br>";

            $stmt->execute();
            //echo "참3";

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                //echo "참";

                /*
                while( $row = $result->fetch_assoc() ){
                    $rows[] = $row;
                }
                */

                $rows = $result->fetch_assoc();
                
                //echo $result->num_rows . "/";
                //print_r($rows);
                //echo "<br>";

            }

            $stmt->close();

            //print_r($rows);

        }
        //echo "참4";
        return $rows;

    }

    public function selectMemberFindEmailAndUsrname($memberVO){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;

            //echo "참1";
            $stmt = $mysqlConn->prepare($this->SELECT_MEMBER_FIND_EMAIL_AND_USRNAME_QRY);

            //echo $this->SELECT_VIEW_QRY;
            //print_r($boardVO);

            //echo "참2";
            $stmt->bind_param("ss", $email, $usrname);
            
            $email = $memberVO->getEmail();
            $usrname = $memberVO->getUsrname();

            //echo $id . "할로<br>";

            $stmt->execute();
            //echo "참3";

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

            //print_r($rows);

        }
        //echo "참4";
        return $rows;

    }

    public function updateMemberChangePasswd($memberVO){
        
        $my_conn = $this->getConn();

        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->UPDATE_MEMBER_CHANGE_PASSWD_QRY);

                //print_r($boardVO);

                $stmt->bind_param("ss", 
                                $passwd, 
                                $email);

                $passwd = $memberVO->getPasswd();
                $email = $memberVO->getEmail();

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