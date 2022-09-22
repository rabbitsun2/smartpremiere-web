<?php
/*
 * Created Date: 2022-07-27 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ShockSensorDAO
 * Filename: ShockSensorDAO.php
 * Description:
 * 1. 
 *
*/

interface ShockSensorDAO{

    public function insertShockSensor($shockSensorVO);
    public function selectAllShockCount();
    public function selectPagingShock($startNum, $endNum);

    public function selectShockMachineIdBetweenDateCount($shockSpecificVO);
    public function selectPagingShockMachineIdBetweenDate($shockSpecificVO, $startNum, $endNum);

}

?>