<?php

/*
 * Created Date: 2022-09-07 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: BoxDAOImpl
 * Filename: BoxDAOImpl.php
 * Description:
 * 1. 초기 설정, 정도윤, 2022-09-07 (Wed).
 *
*/

class BoxDAOImpl implements BoxDAO{

    private $conn;

    private $SELECT_BOX_TYPE_QRY;
    private $INSERT_BOX_TYPE_QRY;
    private $DELETE_BOX_TYPE_QRY;
    private $SELECT_COUNT_ALL_BOX_TYPE_QRY;
    private $ALTER_BOX_TYPE_AUTO_INCREMENT_QRY;

    private function loadQuery(){

        $this->SELECT_BOX_TYPE_QRY = "SELECT * FROM smart_box_type ORDER BY box_type_id";

        $this->INSERT_BOX_TYPE_QRY = "INSERT INTO smart_box_type(box_type_id, type_name) 
                                      VALUES(?, ?)";

        $this->DELETE_BOX_TYPE_QRY = "DELETE FROM smart_box_type WHERE box_type_id = ?";

        $this->SELECT_COUNT_ALL_BOX_TYPE_QRY = "SELECT count(*) as `cnt` FROM smart_box_type";

        $this->ALTER_BOX_TYPE_AUTO_INCREMENT_QRY = "ALTER TABLE smart_box_type AUTO_INCREMENT = 1";


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

    public function selectBoxType(){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_BOX_TYPE_QRY);

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

    public function insertBoxType($boxTypeVO){

        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_BOX_TYPE_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("is", 
                            $box_type_id, 
                            $type_name);

            $box_type_id = $boxTypeVO->getBox_type_id();
            $type_name = $boxTypeVO->getType_name();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
            
        }

        return 0;

    }

    public function deleteBoxType($boxTypeVO){

        $my_conn = $this->getConn();
        
        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();
            
            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->DELETE_BOX_TYPE_QRY);
                
                //print_r($boardVO);
                
                $stmt->bind_param("i", $box_type_id);
                
                $box_type_id = $boxTypeVO->getBox_type_id();
                
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

    public function selectCountAllBoxType(){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_COUNT_ALL_BOX_TYPE_QRY);

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
            mysqli_query($mysqlConn, $this->ALTER_BOX_TYPE_AUTO_INCREMENT_QRY);
            
            return 1;
            
        }

        return 0;

    }

}

?>