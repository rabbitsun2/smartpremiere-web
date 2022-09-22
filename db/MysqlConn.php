<?php
/*
 * Created Date: 2022-06-05 (Sun)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MySQLConn
 * Filename: MySQLConn.php
 * Description:
 * 1. getter / setter 추가, 정도윤, 2022-08-31 (Tue).
 */

class MysqlConn{
    
    private $mysqli;
    private $hostname;
    private $username;
    private $passwd;
    private $dbname;
    private $port;
    
    public function __construct(){
        $this->mysqli = null;
        $this->hostname = null;
        $this->username = null;
        $this->passwd = null;
        $this->dbname = null;
        $this->port = null;
    }
    
    public function __destruct(){
        
        if($this->mysqli != null){
            unset($this->mysqli);
        }
        
    }
    
    public function init($hostname, $username, $passwd, $dbname, $port){
        
        //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT );
        
        $this->hostname = $hostname;
        $this->username = $username;
        $this->passwd = $passwd;
        $this->dbname = $dbname;
        $this->port = $port;
        
        
        $this->mysqli = new mysqli($hostname, $username, $passwd, $dbname, $port);
        
        $this->connCheck();
        
    }

    public function getHostname(){
        return $this->hostname;
    }

    public function setHostname($hostname){
        $this->hostname = $hostname;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function getPasswd(){
        return $this->passwd;
    }

    public function setPasswd($passwd){
        $this->passwd = $passwd;
    }

    public function getDbname(){
        return $this->dbname;
    }

    public function setDbname($dbname){
        $this->dbname = $dbname;
    }

    public function getPort(){
        return $this->port;
    }

    public function setPort($port){
        $this->port = $port;
    }
    
    public function getMysqli(){
        return $this->mysqli;
    }
    
    public function setMysqli($mysqli){
        $this->mysqli = $mysqli;
    }
    
    private function connCheck(){
        
        // 연결 확인
        if ( $this->mysqli->connect_error ){
            echo "Connect failed: " . $this->mysqli->connect_error . "<br>";
        }
        
    }
    
    public function close(){
        
        $this->mysqli->close();
        
    }
    
}

?>