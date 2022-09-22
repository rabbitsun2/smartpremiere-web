<?php

/*
 * Created Date: 2022-06-09 (Thursday)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: DAO
 * Filename: DAO.php
 * Description:
 *
 */

class DAO{
    
    private $conn;
    
    public function __construct(){
        $this->conn = null;
    }
    
    public function __destruct(){
        unset($this->conn);
    }
    
    public function getConn(){
        return $this->conn;
    }
    
    public function setConn($conn){
        $this->conn = $conn;
    }
    
}

?>