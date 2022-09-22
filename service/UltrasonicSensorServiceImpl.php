<?php
/*
 * Created Date: 2022-07-27 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: UltrasonicSensorServiceImpl
 * Filename: UltrasonicSensorServiceImpl.php
 * Description:
 * 1. 
 */

class UltrasonicSensorServiceImpl implements UltrasonicSensorService{

    private $ultrasonicDAO;
    private $conn;

    public function __construct(){
        $this->ultrasonicDAO = null;
    }

    public function __destruct(){

        if ( $this->ultrasonicDAO != null ){
            unset($this->ultrasonicDAO);
        }

    }

    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }
    
    private function loadDAO(){
        
        $this->ultrasonicDAO = new UltrasonicSensorDAOImpl();
        
        $my_conn = $this->getConn();
        $this->ultrasonicDAO->setConn($my_conn);
    }

    public function insertUltrasonicSensor($shockSensorVO){
        
        $this->loadDAO();
        return $this->ultrasonicDAO->insertUltrasonicSensor($shockSensorVO);
    }

    public function selectAllUltrasonicCount(){
        $this->loadDAO();
        return $this->ultrasonicDAO->selectAllUltrasonicCount();
    }

    public function selectPagingUltrasonic($startNum, $endNum){
        $this->loadDAO();
        return $this->ultrasonicDAO->selectPagingUltrasonic($startNum, $endNum);
    }
    
    public function selectUltrasonicMachineIdBetweenDateCount($ultrasonicSpecificVO){
        $this->loadDAO();
        return $this->ultrasonicDAO->selectUltrasonicMachineIdBetweenDateCount($ultrasonicSpecificVO);
    }

    public function selectPagingUltrasonicMachineIdBetweenDate($ultrasonicSpecificVO, $startNum, $endNum){
        $this->loadDAO();
        return $this->ultrasonicDAO->selectPagingUltrasonicMachineIdBetweenDate($ultrasonicSpecificVO, $startNum, $endNum);
    }

}

?>