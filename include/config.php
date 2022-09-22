<?php
/*
 * Created Date: 2022-09-10 (Sat) / Chuseok.
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Smart Premiere Configuration
 * Filename: config.php
 * Description:
 * 
 */

class Config{

    // 시스템 설정
    private $limit_upload_size;
    private $service_mode;
    private $upload_dir;
    private $setup_dir;

    // mariadb 설정
    private $mysql_hostname;
    private $mysql_username;
    private $mysql_passwd;
    private $mysql_dbname;
    private $mysql_port;

    // email 설정
    private $email_smtp_host;
    private $email_smtp_port;
    private $email_smtp_username;
    private $email_smtp_passwd;
    private $email_smtp_secure;
    private $email_charset;
    private $email_encoding;
    private $email_send_usrname;
    private $email_send_address;

    // 암호화 SHA256 설정
    private $secret_key;
    private $secret_iv;

    // 암호화 SHA256 설정
    private $secret_key2;
    private $secret_iv2;

    
    public function getLimit_upload_size(){
        return $this->limit_upload_size;
    }

    public function setLimit_upload_size($limit_upload_size){
        $this->limit_upload_size = $limit_upload_size;
    }

    public function getService_mode(){
        return $this->service_mode;
    }

    public function setService_mode($service_mode){
        $this->service_mode = $service_mode;
    }

    public function getUpload_dir(){
        return $this->upload_dir;
    }

    public function setUpload_dir($upload_dir){
        $this->upload_dir = $upload_dir;
    }

    public function getSetup_dir(){
        return $this->setup_dir;
    }

    public function setSetup_dir($setup_dir){
        $this->setup_dir = $setup_dir;
    }

    public function getMysql_hostname(){
        return $this->mysql_hostname;
    }

    public function setMysql_hostname($mysql_hostname){
        $this->mysql_hostname = $mysql_hostname;
    }

    public function getMysql_username(){
        return $this->mysql_username;
    }

    public function setMysql_username($mysql_username){
        $this->mysql_username = $mysql_username;
    }

    public function getMysql_passwd(){
        return $this->mysql_passwd;
    }

    public function setMysql_passwd($mysql_passwd){
        $this->mysql_passwd = $mysql_passwd;
    }

    public function getMysql_dbname(){
        return $this->mysql_dbname;
    }

    public function setMysql_dbname($mysql_dbname){
        $this->mysql_dbname = $mysql_dbname;
    }

    public function getMysql_port(){
        return $this->mysql_port;
    }

    public function setMysql_port($mysql_port){
        $this->mysql_port = $mysql_port;
    }

    public function getEmail_smtp_host(){
        return $this->email_smtp_host;
    }

    public function setEmail_smtp_host($email_smtp_host){
        $this->email_smtp_host = $email_smtp_host;
    }

    public function getEmail_smtp_port(){
        return $this->email_smtp_port;
    }

    public function setEmail_smtp_port($email_smtp_port){
        $this->email_smtp_port = $email_smtp_port;
    }

    public function getEmail_smtp_username(){
        return $this->email_smtp_username;
    }

    public function setEmail_smtp_username($email_smtp_username){
        $this->email_smtp_username = $email_smtp_username;
    }
    
    public function getEmail_smtp_passwd(){
        return $this->email_smtp_passwd;
    }

    public function setEmail_smtp_passwd($email_smtp_passwd){
        $this->email_smtp_passwd = $email_smtp_passwd;
    }

    public function getEmail_smtp_secure(){
        return $this->email_smtp_secure;
    }

    public function setEmail_smtp_secure($email_smtp_secure){
        $this->email_smtp_secure = $email_smtp_secure;
    }

    public function getEmail_charset(){
        return $this->email_charset;
    }

    public function setEmail_charset($email_charset){
        $this->email_charset = $email_charset;
    }

    public function getEmail_encoding(){
        return $this->email_encoding;
    }
    
    public function setEmail_encoding($email_encoding){
        $this->email_encoding = $email_encoding;
    }

    public function getEmail_send_usrname(){
        return $this->email_send_usrname;
    }

    public function setEmail_send_usrname($email_send_usrname){
        $this->email_send_usrname = $email_send_usrname;
    }

    public function getEmail_send_address(){
        return $this->email_send_address;
    }

    public function setEmail_send_address($email_send_address){
        $this->email_send_address = $email_send_address;
    }

    public function getSecret_key(){
        return $this->secret_key;
    }

    public function setSecret_key($secret_key){
        $this->secret_key = $secret_key;
    }

    public function getSecret_iv(){
        return $this->secret_iv;
    }

    public function setSecret_iv($secret_iv){
        $this->$secret_iv = $secret_iv;
    }

    public function getSecret_key2(){
        return $this->secret_key2;
    }

    public function setSecret_key2($secret_key2){
        $this->secret_key2 = $secret_key2;
    }

    public function getSecret_iv2(){
        return $this->secret_iv2;
    }

    public function setSecret_iv2($secret_iv2){
        $this->$secret_iv2 = $secret_iv2;
    }
    
}

$config = new Config();
// 기본 설정
$config->setLimit_upload_size(39943040);
$config->setService_mode("개발");
$config->setUpload_dir("/upload");
$config->setSetup_dir("/smartLogistics");

// DB 설정
$config->setMysql_hostname("localhost");
$config->setMysql_username("hr");
$config->setMysql_passwd("123456");
$config->setMysql_dbname("hr");
$config->setMysql_port(3306);

// email 설정
$config->setEmail_smtp_host("smtp.naver.com");
$config->setEmail_smtp_port(465);
$config->setEmail_smtp_username("userid");
$config->setEmail_smtp_passwd("123456");
$config->setEmail_smtp_secure("ssl");
$config->setEmail_charset("utf-8");
$config->setEmail_encoding("base64");

$config->setEmail_send_usrname("정도윤");
$config->setEmail_send_address("userid@naver.com");

// Salt키 설정(암호)
$config->setSecret_key("123456789");
$config->setSecret_iv("#@$%^&*()_+=-");

$config->setSecret_key2("987654321");
$config->setSecret_iv2("-=+_)(*&^%$@#");


?>