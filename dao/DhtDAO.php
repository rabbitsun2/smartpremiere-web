<?php
/*
 * Created Date: 2022-07-28 (Thu)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: DhtDAO
 * Filename: DhtDAO.php
 * Description:
 * 1. 
 *
*/

interface DhtDAO{

    public function insertDht($dhtVO);
    public function selectAllDhtCount();
    public function selectPagingDht($startNum, $endNum);

    public function selectDhtMachineIdBetweenDateCount($dhtSpecificVO);
    public function selectPagingDhtMachineIdBetweenDate($dhtSpecificVO, $startNum, $endNum);

}

?>