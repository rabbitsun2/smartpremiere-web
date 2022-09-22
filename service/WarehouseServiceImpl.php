<?php
/*
 * Created Date: 2022-06-13 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: WarehouseServiceImpl
 * Filename: WarehouseServiceImpl.php
 * Description:
 * 1. 재고 현황 기능 구현 시작, 정도윤, 2022-06-14(Tue)
 * 2. updateBeforeWarehouseLog() 출하 후 마감처리 기능, 정도윤, 2022-06-15(Wed)
 * 3. 검색(키워드) 반영, 정도윤, 2022-06-27(Mon)
 * 
 */

class WarehouseServiceImpl implements WarehouseService{

    private $warehouseDAO;
    private $conn;

    public function __construct(){
        $this->warehouseDAO = null;
    }

    public function __destruct(){

        if ( $this->warehouseDAO != null ){
            unset($this->warehouseDAO);
        }

    }

    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }
    
    private function loadDAO(){
        
        $this->warehouseDAO = new WarehouseDAOImpl();
        
        $my_conn = $this->getConn();
        $this->warehouseDAO->setConn($my_conn);

        //print_r($this->productDAO);
        //echo "DAO-참";

    }

    public function insertWarehouse($warehouseVO){
        
        $this->loadDAO();
        return $this->warehouseDAO->insertWarehouse($warehouseVO);
    }

    public function selectAllWarehouseCount(){
        $this->loadDAO();
        return $this->warehouseDAO->selectAllWarehouseCount();
    }

    public function selectPagingWarehouse($startNum, $endNum){
        $this->loadDAO();
        return $this->warehouseDAO->selectPagingWarehouse($startNum, $endNum);
    }

    public function selectWarehouse($warehouseVO){
        $this->loadDAO();
        return $this->warehouseDAO->selectWarehouse($warehouseVO);
    }
    
    public function insertWarehouseLog($warehouseLogVO){
        $this->loadDAO();
        return $this->warehouseDAO->insertWarehouseLog($warehouseLogVO);
    }

    public function selectAllWarehouseLogCount(){
        $this->loadDAO();
        return $this->warehouseDAO->selectAllWarehouseLogCount();
    }

    public function selectPagingWarehouseLog($startNum, $endNum){
        $this->loadDAO();
        return $this->warehouseDAO->selectPagingWarehouseLog($startNum, $endNum);
    }

    public function selectOneWarehouseLog($warehouseLogVO){
        $this->loadDAO();
        return $this->warehouseDAO->selectOneWarehouseLog($warehouseLogVO);
    }

    public function selectPagingWarehouseLogView($startNum, $endNum){
        $this->loadDAO();
        return $this->warehouseDAO->selectPagingWarehouseLogView($startNum, $endNum);
    }

    public function selectAllWarehouseLogViewCount(){
        $this->loadDAO();
        return $this->warehouseDAO->selectAllWarehouseLogViewCount();
    }

    public function updateBeforeWarehouseLog($warehouseLogVO){
        $this->loadDAO();
        //print_r($warehouseLogVO);
        return $this->warehouseDAO->updateBeforeWarehouseLog($warehouseLogVO);
    }

    public function selectWarehouseBetweenSumOfInputCnt($startDate, $endDate){
        $this->loadDAO();
        return $this->warehouseDAO->selectWarehouseBetweenSumOfInputCnt($startDate, $endDate);
    }

    public function selectWarehouseBetweenSumOfOutputCnt($startDate, $endDate){
        $this->loadDAO();
        return $this->warehouseDAO->selectWarehouseBetweenSumOfOutputCnt($startDate, $endDate);
    }

    public function selectPagingWarehouseLogKeywordView($startNum, $endNum, $keyword){
        $this->loadDAO();
        return $this->warehouseDAO->selectPagingWarehouseLogKeywordView($startNum, $endNum, $keyword);

    }

    public function selectAllWarehouseLogViewKeywordCount($keyword){
        $this->loadDAO();
        return $this->warehouseDAO->selectAllWarehouseLogViewKeywordCount($keyword);
    }

    public function selectWarehouseFindProjectId($productVO){
        $this->loadDAO();
        return $this->warehouseDAO->selectWarehouseFindProjectId($productVO);
    }

    public function selectWarehouseFindProductId($productVO){
        $this->loadDAO();
        return $this->warehouseDAO->selectWarehouseFindProductId($productVO);
    }

    public function selectWarehouseFindId($warehouseVO){
        $this->loadDAO();
        return $this->warehouseDAO->selectWarehouseFindId($warehouseVO);
    }

    public function insertWarehouseBarcode($warehouseBarcodeVO){
        $this->loadDAO();
        return $this->warehouseDAO->insertWarehouseBarcode($warehouseBarcodeVO);
    }

    public function selectWarehouseBarcodeFindId($warehouseBarcodeVO){
        $this->loadDAO();
        return $this->warehouseDAO->selectWarehouseBarcodeFindId($warehouseBarcodeVO);
    }

    public function selectWarehouseBarcodeFindRandId($warehouseBarcodeVO){
        $this->loadDAO();
        return $this->warehouseDAO->selectWarehouseBarcodeFindRandId($warehouseBarcodeVO);
    }

    public function insertWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO){
        $this->loadDAO();
        return $this->warehouseDAO->insertWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO);
    }

    public function selectWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO){
        $this->loadDAO();
        return $this->warehouseDAO->selectWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO);
    }

    public function selectWarehouseBarcodePrintLogLatestFindId($warehouseBarcodePrintLogVO){
        $this->loadDAO();
        return $this->warehouseDAO->selectWarehouseBarcodePrintLogLatestFindId($warehouseBarcodePrintLogVO);
    }

    public function updateWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO){
        $this->loadDAO();
        return $this->warehouseDAO->updateWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO);
    }

    public function selectWarehouseBarcodeBagFindId($warehouseBarcodeBagVO){
        $this->loadDAO();
        return $this->warehouseDAO->selectWarehouseBarcodeBagFindId($warehouseBarcodeBagVO);
    }

    public function insertWarehouseBarcodeBag($warehouseBarcodeBagVO){
        $this->loadDAO();
        return $this->warehouseDAO->insertWarehouseBarcodeBag($warehouseBarcodeBagVO);
    }

    public function selectWarehouseBarcodeBagList(){
        $this->loadDAO();
        return $this->warehouseDAO->selectWarehouseBarcodeBagList();
    }

    public function deleteWarehouseBarcodeBag($warehouseBarcodeBagVO){
        $this->loadDAO();
        return $this->warehouseDAO->deleteWarehouseBarcodeBag($warehouseBarcodeBagVO);
    }

    public function selectWarehouseBarcodeBagCount(){
        $this->loadDAO();
        return $this->warehouseDAO->selectWarehouseBarcodeBagCount();
    }

    public function deleteWarehouseBarcodeAllBag(){
        $this->loadDAO();
        return $this->warehouseDAO->deleteWarehouseBarcodeAllBag();
    }

    public function selectWarehouseBarcodeBagListFindMemberId($warehouseBarcodeBagVO){
        $this->loadDAO();
        return $this->warehouseDAO->selectWarehouseBarcodeBagListFindMemberId($warehouseBarcodeBagVO);
    }

    public function deleteWarehouseBarcodeBagFindMemberId($warehouseBarcodeBagVO){
        $this->loadDAO();
        return $this->warehouseDAO->deleteWarehouseBarcodeBagFindMemberId($warehouseBarcodeBagVO);
    }

    public function selectWarehouseBarcodeBagCountFindMemberId($warehouseBarcodeBagVO){
        $this->loadDAO();
        return $this->warehouseDAO->selectWarehouseBarcodeBagCountFindMemberId($warehouseBarcodeBagVO);
    }

}

?>