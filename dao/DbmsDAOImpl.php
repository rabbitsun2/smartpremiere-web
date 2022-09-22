<?php
/*
 * Created Date: 2022-08-31 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: DbmsDAOImpl
 * Filename: DbmsDAOImpl.php
 * Description:
 *
*/

class DbmsDAOImpl implements DbmsDAO{

    private $conn;

    private $SELECT_DB_SIZE_FIND_DBNAME_QRY;

    private function loadQuery(){

        $this->SELECT_DB_SIZE_FIND_DBNAME_QRY = "SELECT table_schema 'db_name', 
                                                ROUND(SUM(data_length + index_length) / 1024 / 1024, 1) 'size' 
                                                FROM information_schema.tables WHERE table_schema = ? 
                                                GROUP BY table_schema";

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

    public function selectDbSizeFindDbname($dbname){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_DB_SIZE_FIND_DBNAME_QRY);
            
            $stmt->bind_param("s", $_dbname);
            $_dbname = $dbname;

            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function selectFindTablename($tablename){

        $my_conn = $this->getConn();
        $result = null;
        $exist = null;

        $SHOW_TABLE_LIKE_TABLENAME_QRY = "SHOW TABLES LIKE '" . $tablename . "'";

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $result = $mysqlConn->query($SHOW_TABLE_LIKE_TABLENAME_QRY);
            $exist = ( $result->num_rows > 0 );

        }

        return $exist;

    }

}

?>