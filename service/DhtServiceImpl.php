<?php
/*
 * Created Date: 2022-07-28 (Thu)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: DhtServiceImpl
 * Filename: DhtServiceImpl.php
 * Description:
 * 1. 
 */

class DhtServiceImpl implements DhtService{

    private $dhtDAO;
    private $conn;

    public function __construct(){
        $this->dhtDAO = null;
    }

    public function __destruct(){

        if ( $this->dhtDAO != null ){
            unset($this->dhtDAO);
        }

    }

    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }
    
    private function loadDAO(){
        
        $this->dhtDAO = new DhtDAOImpl();
        
        $my_conn = $this->getConn();
        $this->dhtDAO->setConn($my_conn);
    }

    public function insertDht($dhtVO){
        
        $this->loadDAO();
        return $this->dhtDAO->insertDht($dhtVO);
    }

    public function selectAllDhtCount(){
        $this->loadDAO();
        return $this->dhtDAO->selectAllDhtCount();
    }

    public function selectPagingDht($startNum, $endNum){
        $this->loadDAO();
        return $this->dhtDAO->selectPagingDht($startNum, $endNum);
    }

    public function selectDhtMachineIdBetweenDateCount($dhtSpecificVO){
        $this->loadDAO();
        return $this->dhtDAO->selectDhtMachineIdBetweenDateCount($dhtSpecificVO);
    }

    public function selectPagingDhtMachineIdBetweenDate($dhtSpecificVO, $startNum, $endNum){
        $this->loadDAO();
        return $this->dhtDAO->selectPagingDhtMachineIdBetweenDate($dhtSpecificVO, $startNum, $endNum);
    }

}

?>