<?php
/*
 * Created Date: 2022-08-31 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: BoardDAOImpl
 * Filename: BoardDAOImpl.php
 * Description:
 *
*/

class BoardDAOImpl implements BoardDAO{

    private $conn;

    private function loadQuery(){

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

    
    public function selectAllBoardCount($boardname){
        
        $my_conn = $this->getConn();
        $result = null;
        $rows = null;
        
        $SELECT_BOARD_ALL_COUNT_QRY = "SELECT COUNT(*) as 'cnt' from smart_board_" . $boardname;
        
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($SELECT_BOARD_ALL_COUNT_QRY);
            
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }
            
            $stmt->close();
            
        }
        
        return $rows;
        
    }
    
    
    public function selectPagingBoardList($boardname, $startNum, $endNum){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $SELECT_BOARD_LIST_QRY = "SELECT smart_board_" . $boardname . ".article_id, 
                                smart_board_" . $boardname . ".subject, 
                                smart_board_" . $boardname . ".memo, 
                                smart_board_" . $boardname . ".member_id, 
                                smart_board_" . $boardname . ".nickname, 
                                smart_board_" . $boardname . ".email, 
                                smart_board_" . $boardname . ".regidate, 
                                smart_board_" . $boardname . ".cnt, 
                                smart_board_" . $boardname . ".ip  
                                FROM smart_board_" . $boardname . "
                                ORDER BY smart_board_" . $boardname . ".regidate DESC
                                LIMIT ? OFFSET ?";

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($SELECT_BOARD_LIST_QRY);

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
    
    public function selectBoardFindId($boardVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $boardname = $boardVO->getBoardname();

        $SELECT_BOARD_VIEW_QRY = "SELECT smart_board_" . $boardname . ".article_id, 
                                smart_board_" . $boardname . ".subject, 
                                smart_board_" . $boardname . ".memo, 
                                smart_board_" . $boardname . ".member_id, 
                                smart_board_" . $boardname . ".nickname, 
                                smart_board_" . $boardname . ".email, 
                                smart_board_" . $boardname . ".regidate, 
                                smart_board_" . $boardname . ".cnt, 
                                smart_board_" . $boardname . ".ip  
                                FROM smart_board_" . $boardname . "
                                WHERE smart_board_" . $boardname . ".article_id = ?";


        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($SELECT_BOARD_VIEW_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $article_id);

            $article_id = $boardVO->getArticle_id();

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

    public function insertBoard($boardVO){

        $my_conn = $this->getConn();
        $result = null;
        
        $boardname = $boardVO->getBoardname();

        $INSERT_BOARD_QRY = "INSERT INTO smart_board_" . $boardname . 
                            "(subject, memo, member_id, nickname, 
                            email, regidate, cnt, ip) 
                            VALUES(?, ?, ?, ?, ?, 
                                   ?, ?, ?)";

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($INSERT_BOARD_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("ssisssis", 
                            $subject, 
                            $memo, 
                            $member_id, 
                            $nickname, 
                            $email, 
                            $regidate, 
                            $cnt, 
                            $ip);

            $subject = $boardVO->getSubject();
            $memo = $boardVO->getMemo();
            $member_id = $boardVO->getMember_id();
            $nickname = $boardVO->getNickname();
            $email = $boardVO->getEmail();
            $regidate = $boardVO->getRegidate();
            $cnt = $boardVO->getCnt();
            $ip = $boardVO->getIp();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
            
        }

        return 0;

    }

    public function selectBoardFindFullQry($boardVO){
        
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $boardname = $boardVO->getBoardname();

        $SELECT_BOARD_FULL_VIEW_QRY = "SELECT smart_board_" . $boardname . ".article_id, 
                                smart_board_" . $boardname . ".subject, 
                                smart_board_" . $boardname . ".memo, 
                                smart_board_" . $boardname . ".member_id, 
                                smart_board_" . $boardname . ".nickname, 
                                smart_board_" . $boardname . ".email, 
                                smart_board_" . $boardname . ".regidate, 
                                smart_board_" . $boardname . ".cnt, 
                                smart_board_" . $boardname . ".ip  
                                FROM smart_board_" . $boardname . "
                                WHERE smart_board_" . $boardname . ".subject = ? AND 
                                smart_board_" . $boardname . ".memo = ? AND 
                                smart_board_" . $boardname . ".member_id = ? AND 
                                smart_board_" . $boardname . ".nickname = ? AND 
                                smart_board_" . $boardname . ".email = ? AND 
                                smart_board_" . $boardname . ".regidate = ? AND 
                                smart_board_" . $boardname . ".cnt = ? AND 
                                smart_board_" . $boardname . ".ip = ?";


        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($SELECT_BOARD_FULL_VIEW_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("ssisssis", 
                            $subject, 
                            $memo, 
                            $member_id, 
                            $nickname, 
                            $email, 
                            $regidate, 
                            $cnt, 
                            $ip);

            $subject = $boardVO->getSubject();
            $memo = $boardVO->getMemo();
            $member_id = $boardVO->getMember_id();
            $nickname = $boardVO->getNickname();
            $email = $boardVO->getEmail();
            $regidate = $boardVO->getRegidate();
            $cnt = $boardVO->getCnt();
            $ip = $boardVO->getIp();


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

    public function insertBoardFile($boardFileVO){

        $my_conn = $this->getConn();
        $result = null;
        
        $boardname = $boardFileVO->getBoardname();

        $INSERT_BOARD_FILE_QRY = "INSERT INTO smart_board_" . $boardname . "_file
                                (article_id, uuid, root_dir, upload_dir, file_ext, 
                                file_size, original_name, file_name, file_type, regidate, ip) 
                                VALUES(?, ?, ?, ?, ?, 
                                       ?, ?, ?, ?, ?, ?)";

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($INSERT_BOARD_FILE_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("issssisssss", 
                            $article_id, 
                            $uuid, 
                            $root_dir, 
                            $upload_dir, 
                            $file_ext, 
                            $file_size, 
                            $original_name, 
                            $file_name, 
                            $file_type, 
                            $regidate, 
                            $ip);

            $article_id = $boardFileVO->getArticle_id();
            $uuid = $boardFileVO->getUuid();
            $root_dir = $boardFileVO->getRoot_dir();
            $upload_dir = $boardFileVO->getUpload_dir();
            $file_ext = $boardFileVO->getFile_ext();
            $file_size = $boardFileVO->getFile_size();
            $original_name = $boardFileVO->getOriginal_name();
            $file_name = $boardFileVO->getFile_name();
            $file_type = $boardFileVO->getFile_type();
            $regidate = $boardFileVO->getRegidate();
            $ip = $boardFileVO->getIp();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
            
        }

        return 0;

    }

    public function selectLatestBoardView($boardVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $boardname = $boardVO->getBoardname();

        $SELECT_BOARD_LATEST_VIEW_QRY = "SELECT smart_board_" . $boardname . ".article_id, 
                                smart_board_" . $boardname . ".subject, 
                                smart_board_" . $boardname . ".memo, 
                                smart_board_" . $boardname . ".member_id, 
                                smart_board_" . $boardname . ".nickname, 
                                smart_board_" . $boardname . ".email, 
                                smart_board_" . $boardname . ".regidate, 
                                smart_board_" . $boardname . ".cnt, 
                                smart_board_" . $boardname . ".ip  
                                FROM smart_board_" . $boardname . "
                                ORDER BY smart_board_" . $boardname . ".regidate DESC 
                                LIMIT ?";
                                
        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($SELECT_BOARD_LATEST_VIEW_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $usrCount);

            $usrCount = $boardVO->getOption1();


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

    public function selectBoardFileFindId($boardFileVO){
        
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $boardname = $boardFileVO->getBoardname();

        $SELECT_BOARD_FILE_FIND_ID_VIEW_QRY = "SELECT 
                                smart_board_" . $boardname . "_file.article_id, 
                                smart_board_" . $boardname . "_file.uuid, 
                                smart_board_" . $boardname . "_file.root_dir, 
                                smart_board_" . $boardname . "_file.upload_dir, 
                                smart_board_" . $boardname . "_file.file_ext, 
                                smart_board_" . $boardname . "_file.file_size, 
                                smart_board_" . $boardname . "_file.original_name, 
                                smart_board_" . $boardname . "_file.file_name, 
                                smart_board_" . $boardname . "_file.file_type, 
                                smart_board_" . $boardname . "_file.regidate, 
                                smart_board_" . $boardname . "_file.ip  
                                FROM smart_board_" . $boardname . "_file 
                                WHERE smart_board_" . $boardname . "_file.article_id = ? 
                                ORDER BY smart_board_" . $boardname . "_file.regidate DESC";
        
        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($SELECT_BOARD_FILE_FIND_ID_VIEW_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $article_id);

            $article_id = $boardFileVO->getArticle_id();


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

    public function selectFindUUIDBoardFile($boardFileVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $boardname = $boardFileVO->getBoardname();

        $SELECT_BOARD_FILE_FIND_ID_VIEW_QRY = "SELECT 
                                smart_board_" . $boardname . "_file.article_id, 
                                smart_board_" . $boardname . "_file.uuid, 
                                smart_board_" . $boardname . "_file.root_dir, 
                                smart_board_" . $boardname . "_file.upload_dir, 
                                smart_board_" . $boardname . "_file.file_ext, 
                                smart_board_" . $boardname . "_file.file_size, 
                                smart_board_" . $boardname . "_file.original_name, 
                                smart_board_" . $boardname . "_file.file_name, 
                                smart_board_" . $boardname . "_file.file_type, 
                                smart_board_" . $boardname . "_file.regidate, 
                                smart_board_" . $boardname . "_file.ip  
                                FROM smart_board_" . $boardname . "_file 
                                WHERE smart_board_" . $boardname . "_file.uuid = ? 
                                ORDER BY smart_board_" . $boardname . "_file.regidate DESC";
        
        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($SELECT_BOARD_FILE_FIND_ID_VIEW_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $uuid);

            $uuid = $boardFileVO->getUuid();

            $stmt->execute();

            $result = $stmt->get_result();

            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();
            
        }else{
            //echo "DB-거짓";
        }

        //return $boardArr;
        return $rows;

    }

    public function updateBoard($boardVO){

        $my_conn = $this->getConn();

        $boardname = $boardVO->getBoardname();
        $UPDATE_BOARD_QRY = "UPDATE smart_board_" . $boardname . " 
                            SET subject = ?, memo = ?, regidate = ? 
                            WHERE article_id = ?";
        
        //echo $UPDATE_BOARD_QRY;

        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($UPDATE_BOARD_QRY);

                //print_r($boardVO);

                $stmt->bind_param("sssi", 
                                $subject, 
                                $memo, 
                                $regidate, 
                                $article_id);

                $subject = $boardVO->getSubject();
                $memo = $boardVO->getMemo();
                $regidate = $boardVO->getRegidate();
                $article_id = $boardVO->getArticle_id();


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

    public function deleteFindUUIDBoardFile($boardFileVO){

        $my_conn = $this->getConn();
        $boardname = $boardFileVO->getBoardname();
        $DELETE_FIND_UUID_BOARD_FILE_QRY = "DELETE FROM smart_board_" . $boardname . "_file 
                                            WHERE uuid = ?";
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($DELETE_FIND_UUID_BOARD_FILE_QRY);

                //print_r($boardVO);

                $stmt->bind_param("s", $uuid);

                $uuid = $boardFileVO->getUuid();

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

    public function deleteBoard($boardVO){

        $my_conn = $this->getConn();
        $boardname = $boardVO->getBoardname();
        $DELETE_BOARD_QRY = "DELETE FROM smart_board_" . $boardname . " 
                                            WHERE article_id = ?";
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($DELETE_BOARD_QRY);

                //print_r($boardVO);

                $stmt->bind_param("s", $article_id);

                $article_id = $boardVO->getArticle_id();

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