<?php
/*
 * Created Date: 2022-07-27 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: UltrasonicSensorDAO
 * Filename: UltrasonicSensorDAO.php
 * Description:
 * 1. 페이징 기능 추가, 정도윤, 2022-07-29 (Fri)
 *
*/

interface UltrasonicSensorDAO{

    public function insertUltrasonicSensor($ultrasonicVO);
    public function selectAllUltrasonicCount();
    public function selectPagingUltrasonic($startNum, $endNum);
    
    public function selectUltrasonicMachineIdBetweenDateCount($ultrasonicSpecificVO);
    public function selectPagingUltrasonicMachineIdBetweenDate($ultrasonicSpecificVO, $startNum, $endNum);

}

?>