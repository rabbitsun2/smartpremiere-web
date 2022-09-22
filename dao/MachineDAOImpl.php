<?php
/*
 * Created Date: 2022-07-27 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MachineDAOImpl
 * Filename: MachineDAOImpl.php
 * Description:
 *
*/

class MachineDAOImpl implements MachineDAO{

    private $conn;

    private $INSERT_MACHINE_QRY;
    private $SELECT_MACHINE_FIND_ID_QRY;
    private $SELECT_MACHINE_ALL_QRY;

    private $SELECT_MACHINE_ALL_COUNT_QRY;
    private $SELECT_MACHINE_PAGING_QRY;

    private $UPDATE_MACHINE_QRY;
    private $DELETE_MACHINE_QRY;

    private $SELECT_MACHINE_FIND_UUID_QRY;

    private function loadQuery(){

        $this->INSERT_MACHINE_QRY = "INSERT INTO smart_machine(machine_name, uuid, memo, locked, regidate, ip) 
                                            VALUES(?, ?, ?, ?, ?, ?)";

        $this->SELECT_MACHINE_FIND_ID_QRY = "SELECT * FROM smart_machine WHERE machine_id = ?";

        $this->SELECT_MACHINE_ALL_QRY = "SELECT * FROM smart_machine ORDER BY machine_id";

        $this->SELECT_MACHINE_ALL_COUNT_QRY = "SELECT COUNT(*) as 'cnt' FROM smart_machine";

        $this->SELECT_MACHINE_PAGING_QRY = "SELECT machine_id, machine_name, uuid, memo, 
                                        locked, regidate, ip  
                                        FROM smart_machine 
                                        ORDER BY machine_id desc 
                                        LIMIT ? OFFSET ?";

        $this->UPDATE_MACHINE_QRY = "UPDATE smart_machine SET machine_name = ?, memo = ?, locked = ?, regidate = ?  
                                    WHERE machine_id = ?";

        $this->DELETE_MACHINE_QRY = "DELETE FROM smart_machine WHERE machine_id = ?";

        $this->SELECT_MACHINE_FIND_UUID_QRY = "SELECT * FROM smart_machine WHERE uuid = ?";

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

    public function insertMachine($machineVO){
        
        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_MACHINE_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("ssssss", 
                            $machine_name, 
                            $uuid, 
                            $memo, 
                            $locked, 
                            $regidate, 
                            $ip);

            $machine_name = $machineVO->getMachine_name();
            $uuid = $machineVO->getUuid();
            $memo = $machineVO->getMemo();
            $locked = $machineVO->getLocked();
            $regidate = $machineVO->getRegidate();
            $ip = $machineVO->getIp();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
            
        }

        return 0;

    }

    public function selectMachineFindID($machineVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_MACHINE_FIND_ID_QRY);
            
            $stmt->bind_param("i", $machine_id);

            $machine_id = $machineVO->getMachine_id();
            //print_r($boardFileVO);

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

    public function selectMachineAll(){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_MACHINE_ALL_QRY);
            
            //print_r($boardFileVO);

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

    public function selectAllMachineCount(){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_MACHINE_ALL_COUNT_QRY);
            
            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }
    
    public function selectPagingMachine($startNum, $endNum){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_MACHINE_PAGING_QRY);

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

    public function updateMachine($machineVO){
        
        $my_conn = $this->getConn();

        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->UPDATE_MACHINE_QRY);

                //print_r($boardVO);

                $stmt->bind_param("ssssi", 
                                $machine_name,
                                $memo,
                                $locked, 
                                $regidate, 
                                $machine_id);

                $machine_name = $machineVO->getMachine_name();
                $memo = $machineVO->getMemo();
                $locked = $machineVO->getLocked();
                $regidate = $machineVO->getRegidate();
                $machine_id = $machineVO->getMachine_id();


                $stmt->execute();

                $mysqlConn->commit();

            }catch(mysqli_sql_exception $exception){

                $mysqlConn->rollback();
                throw $exception;

                //echo "참7 - 오류 <br>";

                return 0;
            }

        }

        //echo "참7 - 성공 <br>";

        return 1;

    }

    public function deleteMachine($machineVO){
        
        $my_conn = $this->getConn();

        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->DELETE_MACHINE_QRY);

                //print_r($boardVO);

                $stmt->bind_param("i", $machine_id);

                $machine_id = $machineVO->getMachine_id();

                $stmt->execute();

                $mysqlConn->commit();

            }catch(mysqli_sql_exception $exception){

                $mysqlConn->rollback();
                throw $exception;

                //echo "참7 - 오류 <br>";

                return 0;
            }

        }

        //echo "참7 - 성공 <br>";

        return 1;

    }

    public function selectMachineFindUuid($machineVO){
        
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_MACHINE_FIND_UUID_QRY);
            
            $stmt->bind_param("s", $uuid);

            $uuid = $machineVO->getUuid();
            //print_r($boardFileVO);

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