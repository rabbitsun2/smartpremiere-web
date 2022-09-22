<?php
/*
 * Created Date: 2022-07-27 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: UltrasonicSensorDAOImpl
 * Filename: UltrasonicSensorDAOImpl.php
 * Description:
 *
*/

class UltrasonicSensorDAOImpl implements UltrasonicSensorDAO{

    private $conn;

    private $INSERT_ULTRASONIC_SENSOR_QRY;
    private $SELECT_ULTRASONIC_ALL_COUNT_QRY;
    private $SELECT_ULTRASONIC_PAGING_QRY;

    private $SELECT_ULTRASONIC_COUNT_MACHINE_ID_AND_BETWEEN_DATE_QRY;
    private $SELECT_ULTRASONIC_PAGING_MACHINE_ID_AND_BETWEEN_DATE_QRY;

    private function loadQuery(){

        $this->INSERT_ULTRASONIC_SENSOR_QRY = "INSERT INTO smart_monitor_ultrasonic_sensor
                                            (machine_id, message, duration, distance, regidate, ip) 
                                            VALUES(?, ?, ?, ?, ?, ?)";

        $this->SELECT_ULTRASONIC_ALL_COUNT_QRY = "SELECT COUNT(*) as 'cnt' FROM smart_monitor_ultrasonic_sensor";

        $this->SELECT_ULTRASONIC_PAGING_QRY = "SELECT smart_monitor_ultrasonic_sensor.id, smart_monitor_ultrasonic_sensor.machine_id, 
                                            smart_machine.machine_name, smart_monitor_ultrasonic_sensor.message, 
                                            smart_monitor_ultrasonic_sensor.duration, smart_monitor_ultrasonic_sensor.distance, 
                                            smart_monitor_ultrasonic_sensor.regidate, smart_monitor_ultrasonic_sensor.ip 
                                            FROM smart_machine, smart_monitor_ultrasonic_sensor 
                                            WHERE smart_monitor_ultrasonic_sensor.machine_id = smart_machine.machine_id 
                                            ORDER BY smart_monitor_ultrasonic_sensor.id desc 
                                            LIMIT ? OFFSET ?";

        $this->SELECT_ULTRASONIC_COUNT_MACHINE_ID_AND_BETWEEN_DATE_QRY = "SELECT COUNT(*) as 'cnt' FROM smart_monitor_ultrasonic_sensor 
                                                                    WHERE smart_monitor_ultrasonic_sensor.machine_id = ? AND 
                                                                    regidate BETWEEN CAST(? AS DATE) AND CAST(? AS DATE)";

        $this->SELECT_ULTRASONIC_PAGING_MACHINE_ID_AND_BETWEEN_DATE_QRY = "SELECT smart_monitor_ultrasonic_sensor.id, 
                                                                    smart_monitor_ultrasonic_sensor.machine_id, 
                                                                    smart_machine.machine_name, smart_monitor_ultrasonic_sensor.message, 
                                                                    smart_monitor_ultrasonic_sensor.duration, 
                                                                    smart_monitor_ultrasonic_sensor.distance, 
                                                                    smart_monitor_ultrasonic_sensor.regidate, 
                                                                    smart_monitor_ultrasonic_sensor.ip 
                                                                    FROM smart_machine, smart_monitor_ultrasonic_sensor 
                                                                    WHERE smart_monitor_ultrasonic_sensor.machine_id = smart_machine.machine_id 
                                                                    AND smart_monitor_ultrasonic_sensor.machine_id = ? AND 
                                                                    smart_monitor_ultrasonic_sensor.regidate 
                                                                    BETWEEN CAST(? AS DATE) AND CAST(? AS DATE) 
                                                                    ORDER BY smart_monitor_ultrasonic_sensor.id desc 
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

    public function insertUltrasonicSensor($ultrasonicVO){
        
        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_ULTRASONIC_SENSOR_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("isssss", 
                            $machine_id, 
                            $message, 
                            $duration, 
                            $distance, 
                            $regidate, 
                            $ip);

            $machine_id = $ultrasonicVO->getMachine_id();
            $message = $ultrasonicVO->getMessage();
            $duration = $ultrasonicVO->getDuration();
            $distance = $ultrasonicVO->getDistance();
            $regidate = $ultrasonicVO->getRegidate();
            $ip = $ultrasonicVO->getIp();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
            
        }

        return 0;

    }

    public function selectAllUltrasonicCount(){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_ULTRASONIC_ALL_COUNT_QRY);
            
            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function selectPagingUltrasonic($startNum, $endNum){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_ULTRASONIC_PAGING_QRY);

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

    public function selectUltrasonicMachineIdBetweenDateCount($ultrasonicSpecificVO){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_ULTRASONIC_COUNT_MACHINE_ID_AND_BETWEEN_DATE_QRY);
            
            $stmt->bind_param("iss", $_machine_id, $_startdate, $_enddate);
            
            $_machine_id = $ultrasonicSpecificVO->getMachine_id();
            $_startdate = $ultrasonicSpecificVO->getStartdate();
            $_enddate = $ultrasonicSpecificVO->getEnddate();

            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function selectPagingUltrasonicMachineIdBetweenDate($ultrasonicSpecificVO, $startNum, $endNum){
        
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_ULTRASONIC_PAGING_MACHINE_ID_AND_BETWEEN_DATE_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("issii", $_machine_id, 
                                    $_startdate, 
                                    $_enddate, 
                                    $_limnum, 
                                    $_startnum);
            
            $_machine_id = $ultrasonicSpecificVO->getMachine_id();
            $_startdate = $ultrasonicSpecificVO->getStartdate();
            $_enddate = $ultrasonicSpecificVO->getEnddate();

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