<?php
/*
 * Created Date: 2022-07-27 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ShockSensorService
 * Filename: ShockSensorService.php
 * Description:
 * 1. 페이징 조회 기능 추가, 정도윤, 2022-07-29 (Fri).
 * 
 */

interface ShockSensorService{

    public function insertShockSensor($shockSensorVO);
    public function selectAllShockCount();
    public function selectPagingShock($startNum, $endNum);
    
    public function selectShockMachineIdBetweenDateCount($shockSpecificVO);
    public function selectPagingShockMachineIdBetweenDate($shockSpecificVO, $startNum, $endNum);
    
}

?>