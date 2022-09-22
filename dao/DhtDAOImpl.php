<?php
/*
 * Created Date: 2022-07-28 (Thu)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: DhtDAOImpl
 * Filename: DhtDAOImpl.php
 * Description:
 *
*/

class DhtDAOImpl implements DhtDAO{

    private $conn;

    private $INSERT_DHT_QRY;
    private $SELECT_DHT_ALL_COUNT_QRY;
    private $SELECT_DHT_PAGING_QRY;

    private $SELECT_DHT_COUNT_MACHINE_ID_AND_BETWEEN_DATE_QRY;
    private $SELECT_DHT_PAGING_MACHINE_ID_AND_BETWEEN_DATE_QRY;

    private function loadQuery(){

        $this->INSERT_DHT_QRY = "INSERT INTO smart_monitor_dht_sensor(machine_id, humidity, temperature, message, regidate, ip) 
                                            VALUES(?, ?, ?, ?, ?, ?)";

        $this->SELECT_DHT_ALL_COUNT_QRY = "SELECT COUNT(*) as 'cnt' FROM smart_monitor_dht_sensor";

        $this->SELECT_DHT_PAGING_QRY = "SELECT smart_monitor_dht_sensor.id, smart_monitor_dht_sensor.machine_id, 
                                        smart_machine.machine_name, smart_monitor_dht_sensor.humidity,
                                        smart_monitor_dht_sensor.temperature, smart_monitor_dht_sensor.message, 
                                        smart_monitor_dht_sensor.regidate, smart_monitor_dht_sensor.ip 
                                        FROM smart_machine, smart_monitor_dht_sensor 
                                        WHERE smart_monitor_dht_sensor.machine_id = smart_machine.machine_id 
                                        ORDER BY smart_monitor_dht_sensor.id desc 
                                        LIMIT ? OFFSET ?";
        
        $this->SELECT_DHT_COUNT_MACHINE_ID_AND_BETWEEN_DATE_QRY = "SELECT COUNT(*) as 'cnt' FROM smart_monitor_dht_sensor 
                                                            WHERE smart_monitor_dht_sensor.machine_id = ? AND 
                                                            regidate BETWEEN CAST(? AS DATE) AND CAST(? AS DATE)";

        $this->SELECT_DHT_PAGING_MACHINE_ID_AND_BETWEEN_DATE_QRY = "SELECT smart_monitor_dht_sensor.id, smart_monitor_dht_sensor.machine_id, 
                                                                    smart_machine.machine_name, smart_monitor_dht_sensor.humidity,
                                                                    smart_monitor_dht_sensor.temperature, smart_monitor_dht_sensor.message, 
                                                                    smart_monitor_dht_sensor.regidate, smart_monitor_dht_sensor.ip 
                                                                    FROM smart_machine, smart_monitor_dht_sensor 
                                                                    WHERE smart_monitor_dht_sensor.machine_id = smart_machine.machine_id 
                                                                    AND smart_monitor_dht_sensor.machine_id = ? AND 
                                                                    smart_monitor_dht_sensor.regidate 
                                                                    BETWEEN CAST(? AS DATE) AND CAST(? AS DATE) 
                                                                    ORDER BY smart_monitor_dht_sensor.id desc 
                                                                    LIMIT ? OFFSET ?";

    }

    public function __construct(){

    }

    public function __destruct(){

    }

    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }

    public function insertDht($dhtVO){
        
        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_DHT_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("isssss", 
                            $machine_id, 
                            $humdity, 
                            $temperature, 
                            $message, 
                            $regidate, 
                            $ip);

            $machine_id = $dhtVO->getMachine_id();
            $humdity = $dhtVO->getHumidity();
            $temperature = $dhtVO->getTemperature();
            $message = $dhtVO->getMessage();
            $regidate = $dhtVO->getRegidate();
            $ip = $dhtVO->getIp();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
            
        }

        return 0;

    }

    public function selectAllDhtCount(){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_DHT_ALL_COUNT_QRY);
            
            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function selectPagingDht($startNum, $endNum){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_DHT_PAGING_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("ii", $_limnum, $_startnum);
            
            // 오라클 페이징(자바 버전)
	    	//paramMap.put("startnum", startnum);		
    		//paramMap.put("endnum", endnum);			
		
            // mariaDB 페이징
            if ( $startNum === 1) {
                $_startnum = 0;
            }
            else {
                $_startnum = $startNum - 1;
            }
            
            $_limnum = ( $endNum - $startNum ) + 1;

            $stmt->execute();
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            
            
        }else{
            //echo "DB-거짓";
        }

        //return $boardArr;
        return $rows;

    }

    public function selectDhtMachineIdBetweenDateCount($dhtSpecificVO){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_DHT_COUNT_MACHINE_ID_AND_BETWEEN_DATE_QRY);
            
            $stmt->bind_param("iss", $_machine_id, $_startdate, $_enddate);
            
            $_machine_id = $dhtSpecificVO->getMachine_id();
            $_startdate = $dhtSpecificVO->getStartdate();
            $_enddate = $dhtSpecificVO->getEnddate();

            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function selectPagingDhtMachineIdBetweenDate($dhtSpecificVO, $startNum, $endNum){
        
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_DHT_PAGING_MACHINE_ID_AND_BETWEEN_DATE_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("issii", $_machine_id, 
                                    $_startdate, 
                                    $_enddate, 
                                    $_limnum, 
                                    $_startnum);
            
            $_machine_id = $dhtSpecificVO->getMachine_id();
            $_startdate = $dhtSpecificVO->getStartdate();
            $_enddate = $dhtSpecificVO->getEnddate();

            // 오라클 페이징(자바 버전)
	    	//paramMap.put("startnum", startnum);		
    		//paramMap.put("endnum", endnum);			
		
            // mariaDB 페이징
            if ( $startNum === 1) {
                $_startnum = 0;
            }
            else {
                $_startnum = $startNum - 1;
            }
            
            $_limnum = ( $endNum - $startNum ) + 1;

            $stmt->execute();
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            
            
        }else{
            //echo "DB-거짓";
        }

        //return $boardArr;
        return $rows;

    }

}

?>