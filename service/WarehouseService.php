<?php
/*
 * Created Date: 2022-06-13 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: WarehouseService
 * Filename: WarehouseService.php
 * Description:
 * 1. 재고 현황 기능 구현 시작, 정도윤, 2022-06-14 (Tue).
 * 2. updateBeforeWarehouseLog() 출하 후 마감처리 기능, 정도윤, 2022-06-15 (Wed).
 * 3. 검색(키워드) 반영, 정도윤, 2022-06-27 (Mon).
 * 4. 프로젝트 ID로 입고, 출고 현황 찾기, 정도윤, 2022-08-03 (Wed).
 * 5. 입고 시 바코드 추가 기능, 정도윤, 2022-08-15 (Mon)
 * 6. 바코드 중복 찾기, 정도윤, 2022-08-15 (Mon).
 */

interface WarehouseService{

    public function insertWarehouse($warehouseVO);
    public function selectAllWarehouseCount();
    public function selectPagingWarehouse($startNum, $endNum);
    public function selectWarehouse($warehouseVO);

    public function insertWarehouseLog($warehouseLogVO);
    public function selectAllWarehouseLogCount();
    public function selectPagingWarehouseLog($startNum, $endNum);
    public function selectOneWarehouseLog($warehouseLogVO);

    public function selectPagingWarehouseLogView($startNum, $endNum);
    public function selectAllWarehouseLogViewCount();

    public function updateBeforeWarehouseLog($warehouseLogVO);

    public function selectWarehouseBetweenSumOfInputCnt($startDate, $endDate);
    public function selectWarehouseBetweenSumOfOutputCnt($startDate, $endDate);

    public function selectPagingWarehouseLogKeywordView($startNum, $endNum, $keyword);
    public function selectAllWarehouseLogViewKeywordCount($keyword);

    public function selectWarehouseFindProjectId($productVO);
    public function selectWarehouseFindProductId($productVO);
    public function selectWarehouseFindId($warehouseVO);

    public function insertWarehouseBarcode($warehouseBarcodeVO);
    public function selectWarehouseBarcodeFindId($warehouseBarcodeVO);
    public function selectWarehouseBarcodeFindRandId($warehouseBarcodeVO);

    public function insertWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO);
    public function selectWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO);
    public function selectWarehouseBarcodePrintLogLatestFindId($warehouseBarcodePrintLogVO);
    public function updateWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO);

    public function selectWarehouseBarcodeBagFindId($warehouseBarcodeBagVO);
    public function insertWarehouseBarcodeBag($warehouseBarcodeBagVO);

    public function selectWarehouseBarcodeBagList();
    public function deleteWarehouseBarcodeBag($warehouseBarcodeBagVO);

    public function selectWarehouseBarcodeBagCount();
    public function deleteWarehouseBarcodeAllBag();

    public function selectWarehouseBarcodeBagListFindMemberId($warehouseBarcodeBagVO);
    public function deleteWarehouseBarcodeBagFindMemberId($warehouseBarcodeBagVO);
    public function selectWarehouseBarcodeBagCountFindMemberId($warehouseBarcodeBagVO);

}

?>