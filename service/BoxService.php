<?php
/*
 * Created Date: 2022-09-07 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: BoxService
 * Filename: BoxService.php
 * Description:
 * 1. 초기 생성, 정도윤, 2022-09-07 (Wed).
 * 
 */

interface BoxService{

    public function selectBoxType();
    public function insertBoxType($boxTypeVO);
    public function deleteBoxType($boxTypeVO);
    public function selectCountAllBoxType();
    public function alterAutoIncrement();

}

?>