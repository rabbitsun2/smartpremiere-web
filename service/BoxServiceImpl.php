<?php
/*
 * Created Date: 2022-09-07 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: BoxServiceImpl
 * Filename: BoxServiceImpl.php
 * Description:
 * 1. 
 */

class BoxServiceImpl implements BoxService{

    private $boxDAO;
    private $conn;

    public function __construct(){
        $this->boxDAO = null;
    }

    public function __destruct(){

        if ( $this->boxDAO != null ){
            unset($this->boxDAO);
        }

    }

    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }
    
    private function loadDAO(){
        
        $this->boxDAO = new BoxDAOImpl();
        
        $my_conn = $this->getConn();
        $this->boxDAO->setConn($my_conn);
    }

    public function selectBoxType(){
        $this->loadDAO();
        return $this->boxDAO->selectBoxType();
    }

    public function insertBoxType($boxTypeVO){
        $this->loadDAO();
        return $this->boxDAO->insertBoxType($boxTypeVO);
    }

    public function deleteBoxType($boxTypeVO){
        $this->loadDAO();
        return $this->boxDAO->deleteBoxType($boxTypeVO);
    }

    public function selectCountAllBoxType(){
        $this->loadDAO();
        return $this->boxDAO->selectCountAllBoxType();
    }

    public function alterAutoIncrement(){
        $this->loadDAO();
        return $this->boxDAO->alterAutoIncrement();
    }

}

?>