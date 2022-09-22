<?php
/*
 * Created Date: 2022-06-12 (Sun)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ProductServiceImpl
 * Filename: ProductServiceImpl.php
 * Description:
 * 1. 제품 품목 찾기 / 페이징 기능 추가, 정도윤(Doyun Jung), 2022-06-13.
 * 2. 박스 기능에서 바코드로 변경, 정도윤(Doyun Jung), 2022-08-14 (Sun).
 */

class ProductServiceImpl implements ProductService{

    private $productDAO;
    private $conn;

    public function __construct(){
        $this->productDAO = null;
    }

    public function __destruct(){

        if ( $this->productDAO != null ){
            unset($this->productDAO);
        }

    }

    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }
    
    private function loadDAO(){
        
        $this->productDAO = new ProductDAOImpl();
        
        $my_conn = $this->getConn();
        $this->productDAO->setConn($my_conn);

    }

    public function selectProduct($productVO){
        
        $this->loadDAO();
        return $this->productDAO->selectProduct($productVO);
    }

    public function selectAllProductCountFind($productVO){

        $this->loadDAO();
        return $this->productDAO->selectAllProductCountFind($productVO);
    }

    public function selectPagingProductFind($startNum, $endNum, $productVO){

        $this->loadDAO();
        return $this->productDAO->selectPagingProductFind($startNum, $endNum, $productVO);
    }

    public function selectAllProductCount(){
        $this->loadDAO();
        return $this->productDAO->selectAllProductCount();
    }

    public function selectPagingProduct($startNum, $endNum){
        $this->loadDAO();
        return $this->productDAO->selectPagingProduct($startNum, $endNum);
    }
    
    public function selectFullProductQry($productVO){
        $this->loadDAO();
        return $this->productDAO->selectFullProductQry($productVO);
    }

    public function insertProduct($productVO){
        $this->loadDAO();
        return $this->productDAO->insertProduct($productVO);
    }

    public function insertProductFile($productFileVO){
        $this->loadDAO();
        return $this->productDAO->insertProductFile($productFileVO);
    }

    public function selectFindUUIDProductFile($productFileVO){
        $this->loadDAO();
        return $this->productDAO->selectFindUUIDProductFile($productFileVO);
    }

    public function selectFindIDProduct($productVO){
        $this->loadDAO();
        return $this->productDAO->selectFindIDProduct($productVO);
    }

    public function selectFindIDProductFile($productFileVO){
        $this->loadDAO();
        return $this->productDAO->selectFindIDProductFile($productFileVO);
    }

    public function updateProduct($productVO){
        $this->loadDAO();
        return $this->productDAO->updateProduct($productVO);
    }

    public function deleteProductFile($productFileVO){
        $this->loadDAO();
        return $this->productDAO->deleteProductFile($productFileVO);
    }
    
    public function deleteFindUUIDProductFile($productFileVO){
        $this->loadDAO();
        return $this->productDAO->deleteFindUUIDProductFile($productFileVO);
    }

    public function insertProductBarcode($productBarcodeVO){
        $this->loadDAO();
        return $this->productDAO->insertProductBarcode($productBarcodeVO);
    }

    public function selectProductBarcodeFindId($productBarcodeVO){
        $this->loadDAO();
        return $this->productDAO->selectProductBarcodeFindId($productBarcodeVO);
    }

    public function selectProductBarcodeFindRandId($productBarcodeVO){
        $this->loadDAO();
        return $this->productDAO->selectProductBarcodeFindRandId($productBarcodeVO);
    }

    public function selectProductFindProjectId($productVO){
        $this->loadDAO();
        return $this->productDAO->selectProductFindProjectId($productVO);
    }
    
    public function deleteProduct($productVO){
        $this->loadDAO();
        return $this->productDAO->deleteProduct($productVO);
    }

    public function selectProductBoxSpecFindProductId($boxSpecVO){
        $this->loadDAO();
        return $this->productDAO->selectProductBoxSpecFindProductId($boxSpecVO);
    }

    public function insertProductBoxSpec($boxSpecVO){
        $this->loadDAO();
        return $this->productDAO->insertProductBoxSpec($boxSpecVO);
    }

    public function updateProductBoxSpec($boxSpecVO){
        $this->loadDAO();
        return $this->productDAO->updateProductBoxSpec($boxSpecVO);
    }

    public function deleteProductBoxSpec($boxSpecVO){
        $this->loadDAO();
        return $this->productDAO->deleteProductBoxSpec($boxSpecVO);
    }

}

?>