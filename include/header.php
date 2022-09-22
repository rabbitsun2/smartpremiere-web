<?php
/*
 * Created Date: 2022-06-05 (Sun)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Smart Premiere
 * Filename: header.php
 * Description:
 * 
 * 
 */
    error_reporting(E_ALL^ E_WARNING);
    session_start();                                    // 세션 시작
    header('Content-Type: text/html; charset=UTF-8');   // UTF-8 헤더
    date_default_timezone_set('Asia/Seoul');    // 서버 환경시간

?>