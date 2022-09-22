<?php
/*
 * Created Date: 2022-06-06 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: EmployeeServiceImpl
 * Filename: EmployeeServiceImpl.php
 * Description:
 * 1. 사용자 관리 페이징 기능 추가, 정도윤, 2022-06-19(Sun)
 */

class EmployeeServiceImpl implements EmployeeService{

    private $employeeDAO;
    private $conn;

    public function __construct(){
        $this->employeeDAO = null;
    }

    public function __destruct(){

        if ( $this->employeeDAO != null ){
            unset($this->employeeDAO);
        }

    }

    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }
    
    private function loadDAO(){
        
        $this->employeeDAO = new EmployeeDAOImpl();
        
        $my_conn = $this->getConn();
        $this->employeeDAO->setConn($my_conn);
    }

    public function selectEmployee($employeeVO){
        
        $this->loadDAO();
        return $this->employeeDAO->selectEmployee($employeeVO);
    }

    public function selectEmployeeAuth(){
        $this->loadDAO();
        return $this->employeeDAO->selectEmployeeAuth();
    }

    public function insertEmployee($employeeVO){
        $this->loadDAO();
        return $this->employeeDAO->insertEmployee($employeeVO);
    }

    public function selectAllEmployeeCount(){
        $this->loadDAO();
        return $this->employeeDAO->selectAllEmployeeCount();
    }

    public function selectPagingEmployee($startNum, $endNum){
        $this->loadDAO();
        return $this->employeeDAO->selectPagingEmployee($startNum, $endNum);
    }

    public function updateEmployee($employeeVO){
        $this->loadDAO();
        return $this->employeeDAO->updateEmployee($employeeVO);
    }

    public function deleteEmployee($employeeVO){
        $this->loadDAO();
        return $this->employeeDAO->deleteEmployee($employeeVO);
    }

}

?>