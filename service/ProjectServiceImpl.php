<?php
/*
 * Created Date: 2022-07-02 (Sat)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ProjectServiceImpl
 * Filename: ProjectServiceImpl.php
 * Description:
 * 1. 
 */

class ProjectServiceImpl implements ProjectService{

    private $projectDAO;
    private $conn;

    public function __construct(){
        $this->projectDAO = null;
    }

    public function __destruct(){

        if ( $this->projectDAO != null ){
            unset($this->projectDAO);
        }

    }

    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }
    
    private function loadDAO(){
        
        $this->projectDAO = new ProjectDAOImpl();
        
        $my_conn = $this->getConn();
        $this->projectDAO->setConn($my_conn);

    }

    public function selectProject($projectVO){
        
        $this->loadDAO();
        return $this->projectDAO->selectProject($projectVO);
    }

    public function selectAllProjectCount(){
        $this->loadDAO();
        return $this->projectDAO->selectAllProjectCount();
    }

    public function selectPagingProject($startNum, $endNum){
        $this->loadDAO();
        return $this->projectDAO->selectPagingProject($startNum, $endNum);
    }

    public function selectFullProjectQry($projectVO){
        $this->loadDAO();
        return $this->projectDAO->selectFullProjectQry($projectVO);
    }

    public function insertProject($projectVO){
        $this->loadDAO();
        return $this->projectDAO->insertProject($projectVO);
    }

    public function insertProjectFile($projectFileVO){
        $this->loadDAO();
        return $this->projectDAO->insertProjectFile($projectFileVO);
    }

    public function selectFindUUIDProjectFile($projectFileVO){
        $this->loadDAO();
        return $this->projectDAO->selectFindUUIDProjectFile($projectFileVO);
    }

    public function selectFindIDProject($projectVO){
        $this->loadDAO();
        return $this->projectDAO->selectFindIDProject($projectVO);
    }

    public function selectFindIDProjectFile($projectFileVO){
        $this->loadDAO();
        return $this->projectDAO->selectFindIDProjectFile($projectFileVO);
    }

    public function updateProject($projectVO){
        $this->loadDAO();
        return $this->projectDAO->updateProject($projectVO);
    }

    public function deleteFindUUIDProjectFile($projectFileVO){
        $this->loadDAO();
        return $this->projectDAO->deleteFindUUIDProjectFile($projectFileVO);
    }

    public function selectAllProjectCountFind($projectVO){
        $this->loadDAO();
        return $this->projectDAO->selectAllProjectCountFind($projectVO);
    }

    public function selectPagingProjectFind($startNum, $endNum, $projectVO){
        $this->loadDAO();
        return $this->projectDAO->selectPagingProjectFind($startNum, $endNum, $projectVO);
    }

    public function deleteProject($projectVO){
        $this->loadDAO();
        return $this->projectDAO->deleteProject($projectVO);
    }

    public function selectAllProjectProcessCountFindProjectId($projectProcessVO){
        $this->loadDAO();
        return $this->projectDAO->selectAllProjectProcessCountFindProjectId($projectProcessVO);
    }

    public function selectPagingProjectProcessFindProjectId($startNum, $endNum, $projectProcessVO){
        $this->loadDAO();
        return $this->projectDAO->selectPagingProjectProcessFindProjectId($startNum, $endNum, $projectProcessVO);
    }

    public function insertProjectProcess($projectProcessVO){
        $this->loadDAO();
        return $this->projectDAO->insertProjectProcess($projectProcessVO);
    }

    public function updateProjectProcess($projectProcessVO){
        $this->loadDAO();
        return $this->projectDAO->updateProjectProcess($projectProcessVO);
    }

    public function deleteProjectProcess($projectProcessVO){
        $this->loadDAO();
        return $this->projectDAO->deleteProjectProcess($projectProcessVO);
    }
    
    public function selectProjectProcessFindUuid($projectProcessVO){
        $this->loadDAO();
        return $this->projectDAO->selectProjectProcessFindUuid($projectProcessVO);
    }

}

?>