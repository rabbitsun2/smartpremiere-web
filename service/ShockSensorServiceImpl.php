<?php
/*
 * Created Date: 2022-07-27 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ShockSensorServiceImpl
 * Filename: ShockSensorServiceImpl.php
 * Description:
 * 1. 
 */

class ShockSensorServiceImpl implements ShockSensorService{

    private $shockSensorDAO;
    private $conn;

    public function __construct(){
        $this->shockSensorDAO = null;
    }

    public function __destruct(){

        if ( $this->shockSensorDAO != null ){
            unset($this->shockSensorDAO);
        }

    }

    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }
    
    private function loadDAO(){
        
        $this->shockSensorDAO = new ShockSensorDAOImpl();
        
        $my_conn = $this->getConn();
        $this->shockSensorDAO->setConn($my_conn);
    }

    public function insertShockSensor($shockSensorVO){
        
        $this->loadDAO();
        return $this->shockSensorDAO->insertShockSensor($shockSensorVO);
    }

    public function selectAllShockCount(){
        $this->loadDAO();
        return $this->shockSensorDAO->selectAllShockCount();
    }

    public function selectPagingShock($startNum, $endNum){
        $this->loadDAO();
        return $this->shockSensorDAO->selectPagingShock($startNum, $endNum);
    }
    
    public function selectShockMachineIdBetweenDateCount($shockSpecificVO){
        $this->loadDAO();
        return $this->shockSensorDAO->selectShockMachineIdBetweenDateCount($shockSpecificVO);
    }

    public function selectPagingShockMachineIdBetweenDate($shockSpecificVO, $startNum, $endNum){
        $this->loadDAO();
        return $this->shockSensorDAO->selectPagingShockMachineIdBetweenDate($shockSpecificVO, $startNum, $endNum);
    }

}

?>