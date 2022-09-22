<?php
/*
 * Created Date: 2022-08-31 (Thu)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: BoardServiceImpl
 * Filename: BoardServiceImpl.php
 * Description:
 * 1. 
 */

class BoardServiceImpl implements BoardService{

    private $boardDAO;
    private $conn;

    public function __construct(){
        $this->boardDAO = null;
    }

    public function __destruct(){

        if ( $this->boardDAO != null ){
            unset($this->boardDAO);
        }

    }

    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }
    
    private function loadDAO(){
        
        $this->boardDAO = new BoardDAOImpl();
        
        $my_conn = $this->getConn();
        $this->boardDAO->setConn($my_conn);
    }

    public function selectPagingBoardList($boardname, $startNum, $endNum){
        $this->loadDAO();
        return $this->boardDAO->selectPagingBoardList($boardname, $startNum, $endNum);
    }
    
    public function selectAllBoardCount($boardname){
        $this->loadDAO();
        return $this->boardDAO->selectAllBoardCount($boardname);
    }

    public function selectBoardFindId($boardVO){
        $this->loadDAO();
        return $this->boardDAO->selectBoardFindId($boardVO);
    }

    public function insertBoard($boardVO){
        $this->loadDAO();
        return $this->boardDAO->insertBoard($boardVO);
    }
    
    public function selectBoardFindFullQry($boardVO){
        $this->loadDAO();
        return $this->boardDAO->selectBoardFindFullQry($boardVO);
    }

    public function insertBoardFile($boardFileVO){
        $this->loadDAO();
        return $this->boardDAO->insertBoardFile($boardFileVO);
    }

    public function selectLatestBoardView($boardVO){
        $this->loadDAO();
        return $this->boardDAO->selectLatestBoardView($boardVO);
    }

    public function selectBoardFileFindId($boardFileVO){
        $this->loadDAO();
        return $this->boardDAO->selectBoardFileFindId($boardFileVO);
    }

    public function selectFindUUIDBoardFile($boardFileVO){
        $this->loadDAO();
        return $this->boardDAO->selectFindUUIDBoardFile($boardFileVO);
    }

    public function updateBoard($boardVO){
        $this->loadDAO();
        return $this->boardDAO->updateBoard($boardVO);
    }

    public function deleteFindUUIDBoardFile($boardFileVO){
        $this->loadDAO();
        return $this->boardDAO->deleteFindUUIDBoardFile($boardFileVO);
    }

    public function deleteBoard($boardVO){
        $this->loadDAO();
        return $this->boardDAO->deleteBoard($boardVO);
    }

}

?>