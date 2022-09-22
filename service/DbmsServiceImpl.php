<?php
/*
 * Created Date: 2022-08-31 (Thu)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: DbmsServiceImpl
 * Filename: DbmsServiceImpl.php
 * Description:
 * 1. Table 명 조회 기능 추가, 정도윤, 2022-09-04 (Sun).
 * 
 */

class DbmsServiceImpl implements DbmsService{

    private $dbmsDAO;
    private $conn;

    public function __construct(){
        $this->dbmsDAO = null;
    }

    public function __destruct(){

        if ( $this->dbmsDAO != null ){
            unset($this->dbmsDAO);
        }

    }

    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }
    
    private function loadDAO(){
        
        $this->dbmsDAO = new DbmsDAOImpl();
        
        $my_conn = $this->getConn();
        $this->dbmsDAO->setConn($my_conn);
    }

    public function selectDbSizeFindDbname($dbname){
        $this->loadDAO();
        return $this->dbmsDAO->selectDbSizeFindDbname($dbname);
    }

    public function selectFindTablename($tablename){
        $this->loadDAO();
        return $this->dbmsDAO->selectFindTablename($tablename);
    }

}
?>