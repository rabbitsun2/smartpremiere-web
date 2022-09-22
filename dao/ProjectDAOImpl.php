<?php
/*
 * Created Date: 2022-07-02 (Sat)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ProjectDAOImpl
 * Filename: ProjecttDAOImpl.php
 * Description:
 * 1. 
 * 
*/

class ProjectDAOImpl implements ProjectDAO{

    private $conn;

    private $SELECT_PROJECT_VIEW_QRY;
    private $SELECT_PROJECT_ALL_COUNT_QRY;
    private $SELECT_PROJECT_PAGING_QRY;

    private $SELECT_PROJECT_FULL_QRY;
    private $INSERT_PROJECT_QRY;
    private $SELECT_FIND_UUID_PROJECT_FILE_QRY;

    private $SELECT_FIND_ID_PROJECT_QRY;
    private $SELECT_FIND_ID_PROJECT_FILE_QRY;

    private $UPDATE_PROJECT_QRY;

    private $DELETE_FIND_UUID_PROJECT_FILE_QRY;

    private $SELECT_All_PROJECT_COUNT_FIND_QRY;
    private $SELECT_PAGING_PROJECT_FIND_QRY;

    private $DELETE_PROJECT_FIND_ID_QRY;

    private $SELECT_PROJECT_PROCESS_COUNT_FIND_PROJECT_ID_QRY;
    private $SELECT_PAGING_PROJECT_PROCESS_FIND_PROJECT_ID_QRY;
    private $INSERT_PROJECT_PROCESS_QRY;
    private $UPDATE_PROJECT_PROCESS_QRY;
    private $DELETE_PROJECT_PROCESS_QRY;

    private $SELECT_PROJECT_PROCESS_FIND_UUID_QRY;
    
    private function loadQuery(){

        $this->SELECT_PROJECT_VIEW_QRY = "SELECT * FROM smart_project 
                                    WHERE project_name like ? ORDER BY project_id";

        $this->SELECT_PROJECT_ALL_COUNT_QRY = "SELECT COUNT(*) as 'cnt' FROM smart_project";

        $this->SELECT_PROJECT_PAGING_QRY = "SELECT * FROM smart_project 
                                            ORDER BY project_id desc 
                                            LIMIT ? OFFSET ?";
                                    
        $this->SELECT_PROJECT_FULL_QRY = "SELECT * FROM smart_project 
                                        WHERE project_name = ? AND 
                                        description = ? AND 
                                        startdate = ? AND 
                                        enddate = ? AND 
                                        regidate = ? AND 
                                        ip = ?";

        $this->INSERT_PROJECT_QRY = "INSERT INTO smart_project (project_name, 
                                    description, startdate, enddate, regidate, ip) 
                                    VALUES(?, ?, ?, ?, ?, ?)";

        $this->INSERT_PROJECT_FILE_QRY = "INSERT INTO smart_project_file (project_id, 
                                    uuid, root_dir, upload_dir, file_ext, file_size, 
                                    original_name, file_name, file_type, regidate, ip) 
                                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->SELECT_FIND_UUID_PROJECT_FILE_QRY = "SELECT * FROM smart_project_file 
                                                WHERE uuid = ?";

        $this->SELECT_FIND_ID_PROJECT_QRY = "SELECT * FROM smart_project 
                                            WHERE project_id = ?";

        $this->SELECT_FIND_ID_PROJECT_FILE_QRY = "SELECT * FROM smart_project_file 
                                                WHERE project_id = ?";

        $this->UPDATE_PROJECT_QRY = "UPDATE smart_project SET project_name = ?, 
                                     description = ?, startdate = ?, enddate = ?, 
                                     regidate = ? WHERE project_id = ?";

        $this->DELETE_FIND_UUID_PROJECT_FILE_QRY = "DELETE FROM smart_project_file 
                                                    WHERE uuid = ?";

        $this->SELECT_All_PROJECT_COUNT_FIND_QRY = "SELECT COUNT(*) as 'cnt' FROM smart_project
                                                    WHERE project_name like ?";

        $this->SELECT_PAGING_PROJECT_FIND_QRY = "SELECT * FROM smart_project 
                                                WHERE project_name like ? 
                                                ORDER BY project_id desc 
                                                LIMIT ? OFFSET ?";

        $this->DELETE_PROJECT_FIND_ID_QRY = "DELETE FROM smart_project 
                                            WHERE project_id = ?";

        $this->SELECT_PROJECT_PROCESS_COUNT_FIND_PROJECT_ID_QRY = "SELECT COUNT(*) as 'cnt' FROM smart_project_process 
                                                    WHERE project_id = ?";
        
        $this->SELECT_PAGING_PROJECT_PROCESS_FIND_PROJECT_ID_QRY = "SELECT * FROM smart_project_process 
                                                WHERE project_id = ? 
                                                ORDER BY regidate desc 
                                                LIMIT ? OFFSET ?";
 
        $this->INSERT_PROJECT_PROCESS_QRY = "INSERT INTO smart_project_process(project_id, process_uuid, process_name, order_val, regidate, ip) 
                                             VALUES(?, ?, ?, ?, ?, ?)";

        $this->UPDATE_PROJECT_PROCESS_QRY = "UPDATE smart_project_process SET process_name = ?, 
                                             order_val = ? WHERE process_uuid = ?";

        $this->DELETE_PROJECT_PROCESS_QRY = "DELETE FROM smart_project_process WHERE process_uuid = ?";

        $this->SELECT_PROJECT_PROCESS_FIND_UUID_QRY = "SELECT * FROM smart_project_process WHERE process_uuid = ?";

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

    public function selectProject($projectVO){

        //$boardArr = null;
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
            //            echo "DB-참<br>";

            $mysqlConn = $my_conn->getMysqli();

            $stmt = $mysqlConn->prepare($this->SELECT_PROJECT_VIEW_QRY);

            $stmt->bind_param("s", $projectName);

            $projectName = "%". $projectVO->getProject_name() . "%";

            $stmt->execute();

            $result = $stmt->get_result();

            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();
            //echo $productName;
            //print_r($rows);

        }else{

        }


        return $rows;

    }

    public function selectAllProjectCount(){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_PROJECT_ALL_COUNT_QRY);
            
            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function selectPagingProject($startNum, $endNum){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_PROJECT_PAGING_QRY);

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

    public function selectFullProjectQry($projectVO){
        
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
            //            echo "DB-참<br>";

            $mysqlConn = $my_conn->getMysqli();

            $stmt = $mysqlConn->prepare($this->SELECT_PROJECT_FULL_QRY);

            $stmt->bind_param("ssssss", $projectName, 
                                        $description, 
                                        $startdate, 
                                        $enddate,
                                        $regidate, 
                                        $ip);

            $projectName = $projectVO->getProject_name();
            $description = $projectVO->getDescription();
            $startdate = $projectVO->getStartdate();
            $enddate = $projectVO->getEnddate();
            $regidate = $projectVO->getRegidate();
            $ip = $projectVO->getIp();

            $stmt->execute();

            $result = $stmt->get_result();

            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();
            //echo $productName;
            //print_r($rows);

        }else{

        }

        return $rows;

    }

    public function insertProject($projectVO){

        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_PROJECT_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("ssssss", $projectName, 
                                        $description, 
                                        $startdate, 
                                        $enddate,
                                        $regidate, 
                                        $ip);

            $projectName = $projectVO->getProject_name();
            $description = $projectVO->getDescription();
            $startdate = $projectVO->getStartdate();
            $enddate = $projectVO->getEnddate();
            $regidate = $projectVO->getRegidate();
            $ip = $projectVO->getIp();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
        }

        return 0;

    }

    public function insertProjectFile($projectFileVO){

        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_PROJECT_FILE_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("sssssssssss", $project_id, 
                                        $uuid, 
                                        $root_dir, 
                                        $upload_dir,
                                        $file_ext, 
                                        $file_size, 
                                        $original_name, 
                                        $file_name, 
                                        $file_type, 
                                        $regidate, 
                                        $ip);

            $project_id = $projectFileVO->getProject_id();
            $uuid = $projectFileVO->getUuid();
            $root_dir = $projectFileVO->getRoot_dir();
            $upload_dir = $projectFileVO->getUpload_dir();
            $file_ext = $projectFileVO->getFile_ext();

            $file_size = $projectFileVO->getFile_size();
            $original_name = $projectFileVO->getOriginal_name();
            $file_name = $projectFileVO->getFile_name();
            $file_type = $projectFileVO->getFile_type();
            $regidate = $projectFileVO->getRegidate();

            $ip = $projectFileVO->getIp();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;

        }

        return 0;

    }

    public function selectFindUUIDProjectFile($projectFileVO){

        //$boardArr = null;
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
            //            echo "DB-참<br>";

            $mysqlConn = $my_conn->getMysqli();

            $stmt = $mysqlConn->prepare($this->SELECT_FIND_UUID_PROJECT_FILE_QRY);

            $stmt->bind_param("s", $uuid);

            $uuid = $projectFileVO->getUuid();

            $stmt->execute();

            $result = $stmt->get_result();

            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();
            //echo $productName;
            //print_r($rows);

        }else{

        }

        return $rows;

    }

    public function selectFindIDProject($projectVO){

        //$boardArr = null;
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
            //            echo "DB-참<br>";

            $mysqlConn = $my_conn->getMysqli();

            $stmt = $mysqlConn->prepare($this->SELECT_FIND_ID_PROJECT_QRY);

            $stmt->bind_param("i", $project_id);

            $project_id = $projectVO->getProject_id();

            $stmt->execute();

            $result = $stmt->get_result();

            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();
            //echo $productName;
            //print_r($rows);

        }else{

        }

        return $rows;

    }

    public function selectFindIDProjectFile($projectFileVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_FIND_ID_PROJECT_FILE_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $project_id);

            $project_id = $projectFileVO->getProject_id();
            

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

    public function updateProject($projectVO){

        $my_conn = $this->getConn();

        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->UPDATE_PROJECT_QRY);

                //print_r($boardVO);

                $stmt->bind_param("sssssi", 
                                $project_name,
                                $description,
                                $startdate, 
                                $enddate, 
                                $regidate,
                                $project_id);

                $project_name = $projectVO->getProject_name();
                $description = $projectVO->getDescription();
                $startdate = $projectVO->getStartdate();
                $enddate = $projectVO->getEnddate();
                $regidate = $projectVO->getRegidate();
                $project_id = $projectVO->getProject_id();


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

    public function deleteFindUUIDProjectFile($projectFileVO){

        $my_conn = $this->getConn();

        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->DELETE_FIND_UUID_PROJECT_FILE_QRY);

                //print_r($boardVO);

                $stmt->bind_param("s", $uuid);

                $uuid = $projectFileVO->getUuid();

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

    public function selectAllProjectCountFind($projectVO){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_All_PROJECT_COUNT_FIND_QRY);
            
            $stmt->bind_param("s", $projectName);
            $projectName = "%". $projectVO->getProject_name() . "%";

            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function selectPagingProjectFind($startNum, $endNum, $projectVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_PAGING_PROJECT_FIND_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("sii", 
                                $projectName, 
                                $_limnum, 
                                $_startnum);
            
            $projectName = "%". $projectVO->getProject_name() . "%";
            
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

    public function deleteProject($projectVO){
        
        $my_conn = $this->getConn();

        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->DELETE_PROJECT_FIND_ID_QRY);

                //print_r($boardVO);

                $stmt->bind_param("i", $project_id);
                $project_id = $projectVO->getProject_id();

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

    public function selectAllProjectProcessCountFindProjectId($projectProcessVO){
        
        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_PROJECT_PROCESS_COUNT_FIND_PROJECT_ID_QRY);
            
            $stmt->bind_param("i", $project_id);
            $project_id = $projectProcessVO->getProject_id();

            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function selectPagingProjectProcessFindProjectId($startNum, $endNum, $projectProcessVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_PAGING_PROJECT_PROCESS_FIND_PROJECT_ID_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("iii", 
                                $project_id, 
                                $_limnum, 
                                $_startnum);
            
            $project_id = $projectProcessVO->getProject_id();
            
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

    public function insertProjectProcess($projectProcessVO){

        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_PROJECT_PROCESS_QRY);

            //echo $this->INSERT_GOODS_QRY;
            $stmt->bind_param("ississ", $project_id, 
                                        $process_uuid, 
                                        $process_name, 
                                        $order_val,
                                        $regidate, 
                                        $ip);

            $project_id = $projectProcessVO->getProject_id();
            $process_uuid = $projectProcessVO->getProcess_uuid();
            $process_name = $projectProcessVO->getProcess_name();

            $order_val = $projectProcessVO->getOrder_val();
            $regidate = $projectProcessVO->getRegidate();
            $ip = $projectProcessVO->getIp();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;

        }

        return 0;
        
    }

    public function updateProjectProcess($projectProcessVO){

        $my_conn = $this->getConn();

        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->UPDATE_PROJECT_PROCESS_QRY);

                //print_r($boardVO);

                $stmt->bind_param("sis", 
                                $process_name,
                                $order_val,
                                $process_uuid);

                $process_name = $projectProcessVO->getProcess_name();
                $order_val = $projectProcessVO->getOrder_val();
                $process_uuid = $projectProcessVO->getProcess_uuid();


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

    public function deleteProjectProcess($projectProcessVO){

        $my_conn = $this->getConn();

        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->DELETE_PROJECT_PROCESS_QRY);

                //print_r($boardVO);

                $stmt->bind_param("s", $process_uuid);
                $process_uuid = $projectProcessVO->getProcess_uuid();

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

    public function selectProjectProcessFindUuid($projectProcessVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_PROJECT_PROCESS_FIND_UUID_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("s", $process_uuid);
            
            $process_uuid = $projectProcessVO->getProcess_uuid();
            
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