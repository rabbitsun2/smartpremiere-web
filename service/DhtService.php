<?php
/*
 * Created Date: 2022-07-28 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: DhtService
 * Filename: DhtService.php
 * Description:
 * 1. 초기 생성, 정도윤, 2022-07-28 (Thu).
 * 
 */

interface DhtService{

    public function insertDht($dhtVO);
    public function selectAllDhtCount();
    public function selectPagingDht($startNum, $endNum);
    
    public function selectDhtMachineIdBetweenDateCount($dhtSpecificVO);
    public function selectPagingDhtMachineIdBetweenDate($dhtSpecificVO, $startNum, $endNum);

}

?>