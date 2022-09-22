<?php
/*
 * Created Date: 2022-07-27 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: UltrasonicSensorService
 * Filename: UltrasonicSensorService.php
 * Description:
 *
 */

interface UltrasonicSensorService{

    public function insertUltrasonicSensor($ultrasonicVO);
    public function selectAllUltrasonicCount();
    public function selectPagingUltrasonic($startNum, $endNum);
    
    public function selectUltrasonicMachineIdBetweenDateCount($ultrasonicSpecificVO);
    public function selectPagingUltrasonicMachineIdBetweenDate($ultrasonicSpecificVO, $startNum, $endNum);
    
}

?>