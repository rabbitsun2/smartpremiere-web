<?php
/*
 * Created Date: 2022-06-12 (Sun)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ProductService
 * Filename: ProductService.php
 * Description:
 * 1. 제품 파일 삭제 기능 추가, 정도윤, 2022-07-14 (Thu).
 * 2. 박스 기능 추가, 정도윤, 2022-08-03 (Wed).
 * 3. 프로젝트 ID 검색 기능 추가, 정도윤, 2022-08-03 (Wed).
 * 4. 박스 기능에서 바코드로 변경, 정도윤, 2022-08-14 (Sun).
 * 5. 제품에서 박스 분류 기능 추가, 정도윤, 2022-09-07 (Wed).
 */

interface ProductService{

    public function selectProduct($productVO);
    public function selectAllProductCountFind($productVO);
    public function selectPagingProductFind($startNum, $endNum, $productVO);

    public function selectAllProductCount();
    public function selectPagingProduct($startNum, $endNum);

    public function selectFullProductQry($productVO);
    public function insertProduct($productVO);
    public function insertProductFile($productFileVO);

    public function selectFindUUIDProductFile($productFileVO);
    public function selectFindIDProduct($productVO);
    public function selectFindIDProductFile($productFileVO);

    public function updateProduct($productVO);
    public function deleteProductFile($productFileVO);
    public function deleteFindUUIDProductFile($productFileVO);
  
    public function insertProductBarcode($productBarcodeVO);
    public function selectProductBarcodeFindId($productBarcodeVO);
    public function selectProductBarcodeFindRandId($productBarcodeVO);
    
    public function selectProductFindProjectId($productVO);
    public function deleteProduct($productVO);

    public function selectProductBoxSpecFindProductId($boxSpecVO);
    public function insertProductBoxSpec($boxSpecVO);
    public function updateProductBoxSpec($boxSpecVO);
    public function deleteProductBoxSpec($boxSpecVO);

}

?>