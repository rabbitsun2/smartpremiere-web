<?php
/*
 * Created Date: 2022-06-12 (Sun)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ProductDAO
 * Filename: ProductDAO.php
 * Description:
 *
*/

interface ProductDAO{

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