<?php
/*
 * Created Date: 2022-07-25 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MachineServiceImpl
 * Filename: MachineServiceImpl.php
 * Description:
 * 1. 
 */

class MachineServiceImpl implements MachineService{

    private $machineDAO;
    private $conn;

    public function __construct(){
        $this->machineDAO = null;
    }

    public function __destruct(){

        if ( $this->machineDAO != null ){
            unset($this->machineDAO);
        }

    }

    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }
    
    private function loadDAO(){
        
        $this->machineDAO = new MachineDAOImpl();
        
        $my_conn = $this->getConn();
        $this->machineDAO->setConn($my_conn);
    }

    public function insertMachine($machineVO){
        
        $this->loadDAO();
        return $this->machineDAO->insertMachine($machineVO);
    }

    public function selectMachineFindID($machineVO){
        $this->loadDAO();
        return $this->machineDAO->selectMachineFindID($machineVO);
    }

    public function selectMachineAll(){
        $this->loadDAO();
        return $this->machineDAO->selectMachineAll();
    }

    public function selectAllMachineCount(){
        $this->loadDAO();
        return $this->machineDAO->selectAllMachineCount();
    }

    public function selectPagingMachine($startNum, $endNum){
        $this->loadDAO();
        return $this->machineDAO->selectPagingMachine($startNum, $endNum);

    }

    public function updateMachine($machineVO){
        $this->loadDAO();
        return $this->machineDAO->updateMachine($machineVO);
    }

    public function deleteMachine($machineVO){
        $this->loadDAO();
        return $this->machineDAO->deleteMachine($machineVO);
    }

    public function selectMachineFindUuid($machineVO){
        $this->loadDAO();
        return $this->machineDAO->selectMachineFindUuid($machineVO);
    }

}

?>