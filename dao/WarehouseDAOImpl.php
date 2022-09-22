<?php
/*
 * Created Date: 2022-06-13 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: WarehouseDAOImpl
 * Filename: WarehouseDAOImpl.php
 * Description:
 * 1. 재고 현황 기능 구현 시작, 정도윤, 2022-06-14(Tue)
 * 2. 로그 타입 출하시스템 구현, 정도윤, 2022-06-15(Wed)
 * 3. updateBeforeWarehouseLog() 출하 후 마감처리 기능, 정도윤, 2022-06-15(Wed)
 * 4. 입출고 일자별 현황 조회 쿼리 반영, 정도윤, 2022-06-16(Thu)
 * 5. 검색(키워드) 반영, 정도윤, 2022-06-27(Mon)
 * 6. 프로젝트 ID 검색 기능 추가, 정도윤, 2022-08-03(Wed)
 * 7. 제품 ID 검색 기능 추가, 정도윤, 2022-08-03(Wed)
 * 8. 바코드 기능 추가, 정도윤, 2022-08-15(Mon)
 * 9. 장바구니 기능 추가, 정도윤, 2022-08-15(Mon)
 * 
*/

class WarehouseDAOImpl implements WarehouseDAO{

    private $conn;

    private $INSERT_WAREHOUSE_QRY;
    private $SELECT_WAREHOUSE_ALL_COUNT_QRY;
    private $SELECT_WAREHOUSE_PAGING_QRY;
    private $SELECT_WAREHOUSE_QRY;
   
    private $INSERT_WAREHOUSE_LOG_QRY;
    private $SELECT_WAREHOUSE_LOG_ALL_COUNT_QRY;
    private $SELECT_WAREHOUSE_LOG_PAGING_QRY;
    private $SELECT_WAREHOUSE_LOG_QRY;

    private $SELECT_WAREHOUSE_LOG_VIEW_PAGING_QRY;
    private $SELECT_WAREHOUSE_LOG_VIEW_ALL_COUNT_QRY;

    private $UPDATE_WAREHOUSE_LOG_BEFORE_QRY;

    private $SELECT_WAREHOUSE_INPUT_DATE_SUM_QRY;
    private $SELECT_WAREHOUSE_OUTPUT_DATE_SUM_QRY;

    private $SELECT_WAREHOUSE_LOG_VIEW_KEYWORD_PAGING_QRY;
    private $SELECT_WAREHOUSE_LOG_VIEW_KEYWORD_ALL_COUNT_QRY;

    private $SELECT_WAREHOUSE_FIND_PROJECT_ID_QRY;
    private $SELECT_WAREHOUSE_FIND_PRODUCT_ID_QRY;
    private $SELECT_WAREHOUSE_FIND_ID_QRY;

    private $INSERT_WAREHOUSE_BARCODE_QRY;
	private $SELECT_WAREHOUSE_BARCODE_FIND_ID_QRY;
    private $SELECT_WAREHOUSE_BARCODE_FIND_RAND_ID_QRY;
    private $SELECT_WAREHOUSE_BARCODE_COUNT_FIND_ID_QRY;
    
    private $INSERT_WAREHOUSE_BARCODE_PRINT_LOG_QRY;
    private $SELECT_WAREHOUSE_BARCODE_PRINT_LOG_QRY;
    private $SELECT_WAREHOUSE_BARCODE_PRINT_LOG_LATEST_FIND_ID_QRY;
    private $UPDATE_WAREHOUSE_BARCODE_PRINT_LOG_QRY;

    private $SELECT_WAREHOUSE_BARCODE_BAG_FIND_ID_QRY;
    private $INSERT_WAREHOUSE_BARCODE_BAG_QRY;

    private $SELECT_WAREHOUSE_BARCODE_BAG_FULL_QRY;
    private $DELETE_WAREHOUSE_BARCODE_BAG_FIND_ID_QRY;

    private $SELECT_WAREHOUSE_BARCODE_BAG_COUNT_QRY;
    private $DELETE_WAREHOUSE_BARCODE_BAG_ALL_QRY;

    private $SELECT_WAREHOUSE_BARCODE_BAG_LIST_FIND_MEMBER_ID_QRY;
    private $DELETE_WAREHOUSE_BARCODE_BAG_FIND_MEMBER_ID_QRY;
    private $SELECT_WAREHOUSE_BARCODE_BAG_COUNT_FIND_MEMBER_ID_QRY;


    private function loadQuery(){

        $this->INSERT_WAREHOUSE_QRY = "INSERT INTO smart_factory_warehouse
                                    (product_id, product_cnt, create_date, create_type, ip) 
                                    VALUES(?, ?, ?, ?, ?)";

        $this->SELECT_WAREHOUSE_ALL_COUNT_QRY = "SELECT COUNT(*) as 'cnt' FROM smart_factory_warehouse";
                
        $this->SELECT_WAREHOUSE_PAGING_QRY = "SELECT * FROM smart_factory_warehouse 
                                        WHERE ORDER by id desc 
                                        LIMIT ? OFFSET ?";

        $this->SELECT_WAREHOUSE_QRY = "SELECT * from smart_factory_warehouse 
                                    WHERE product_id = ? and product_cnt = ? 
                                    and create_date = ? and create_type = ? 
                                    and ip = ?";

        $this->INSERT_WAREHOUSE_LOG_QRY = "INSERT INTO smart_factory_warehouse_log
                                        (w_id, prev_w_id, prev_cnt, release_cnt,
                                        current_cnt, current_type, release_type, release_date, ip) 
                                        VALUES(?, ?, ?, ?, ?, 
                                            ?, ?, ?, ?)";

        $this->SELECT_WAREHOUSE_LOG_ALL_COUNT_QRY = "SELECT COUNT(*) as 'cnt' FROM smart_factory_warehouse_log";

        $this->SELECT_WAREHOUSE_LOG_PAGING_QRY = "SELECT * FROM smart_factory_warehouse_log 
                                                WHERE current_type = ? OR current_type = ? ORDER by id desc 
                                                LIMIT ? OFFSET ?";

        $this->SELECT_WAREHOUSE_LOG_QRY = "SELECT smart_factory_warehouse_log.id AS 'id', smart_factory_warehouse_log.w_id, 
                                        smart_factory_warehouse.product_id, smart_product.product_name, 
                                        smart_factory_warehouse_log.prev_w_id, smart_factory_warehouse_log.prev_cnt, 
                                        smart_factory_warehouse_log.release_cnt, smart_factory_warehouse_log.current_cnt, 
                                        smart_factory_warehouse_log.current_type, smart_factory_warehouse_log.release_type,
                                        smart_factory_warehouse_log.release_date, smart_factory_warehouse_log.ip 
                                        FROM smart_product, smart_factory_warehouse, smart_factory_warehouse_log 
                                        WHERE smart_factory_warehouse.id = smart_factory_warehouse_log.w_id 
                                        AND smart_factory_warehouse.product_id = smart_product.product_id 
                                        AND smart_factory_warehouse_log.id = ?";

        $this->SELECT_WAREHOUSE_LOG_VIEW_PAGING_QRY = "SELECT smart_factory_warehouse_log.id, w_id, 
                                                smart_product.project_id as 'project_id',  
                                                smart_product.product_id as 'product_id', 
                                                smart_project.project_name as 'project_name', 
                                                product_name, 
                                                smart_product.description as 'product_description', 
                                                prev_w_id, create_date, prev_cnt, release_cnt, 
                                                current_cnt, current_type, release_type, release_date, 
                                                smart_factory_warehouse_log.ip 
                                                FROM smart_factory_warehouse_log, smart_factory_warehouse, 
                                                     smart_product, smart_project 
                                                WHERE (smart_factory_warehouse.id = smart_factory_warehouse_log.w_id) 
                                                AND (smart_product.project_id = smart_project.project_id) 
                                                AND (smart_factory_warehouse.product_id = smart_product.product_id) 
                                                AND (current_type = ? OR current_type = ?) 
                                                ORDER BY smart_factory_warehouse_log.w_id DESC LIMIT ? OFFSET ?";

        $this->SELECT_WAREHOUSE_LOG_VIEW_ALL_COUNT_QRY = "SELECT COUNT(*) as 'cnt' FROM smart_factory_warehouse_log 
                                                        WHERE current_type = ? OR current_type = ?";

        $this->UPDATE_WAREHOUSE_LOG_BEFORE_QRY = "UPDATE smart_factory_warehouse_log 
                                                SET current_type = ?, release_type = ? WHERE id = ?";

        $this->SELECT_WAREHOUSE_INPUT_DATE_SUM_QRY = "SELECT SUM(smart_factory_warehouse.product_cnt) AS 'cnt'
                                            FROM smart_factory_warehouse, smart_product 
                                            WHERE smart_factory_warehouse.product_id = smart_product.product_id AND 
                                            create_date BETWEEN CAST(? AS DATE) AND CAST(? AS DATE)";

        $this->SELECT_WAREHOUSE_OUTPUT_DATE_SUM_QRY = "SELECT SUM(smart_factory_warehouse_log.release_cnt) AS 'cnt'
                                            FROM smart_factory_warehouse_log 
                                            WHERE release_date BETWEEN CAST(? AS DATE) AND CAST(? AS DATE) 
                                            AND (current_type = ? OR current_type = ? 
                                                 OR current_type = ?)";

        $this->SELECT_WAREHOUSE_LOG_VIEW_KEYWORD_PAGING_QRY = "SELECT smart_factory_warehouse_log.id, w_id, 
                                                    smart_product.project_id as 'project_id', 
                                                    smart_product.product_id as 'product_id', 
                                                    smart_project.project_name as 'project_name', 
                                                    smart_product.product_name as 'product_name', 
                                                    smart_product.description as 'product_description', 
                                                    prev_w_id, create_date, prev_cnt, release_cnt, 
                                                    current_cnt, current_type, release_type, release_date, 
                                                    smart_factory_warehouse_log.ip 
                                                    FROM smart_factory_warehouse_log, smart_factory_warehouse, 
                                                        smart_product, smart_project 
                                                    WHERE (smart_factory_warehouse.id = smart_factory_warehouse_log.w_id) 
                                                    AND (smart_product.project_id = smart_project.project_id) 
                                                    AND (smart_factory_warehouse.product_id = smart_product.product_id) 
                                                    AND (current_type = ? OR current_type = ?) 
                                                    AND (smart_project.project_name like ? 
                                                    OR smart_product.product_name like ?)
                                                    ORDER BY smart_factory_warehouse_log.w_id DESC LIMIT ? OFFSET ?";

        $this->SELECT_WAREHOUSE_LOG_VIEW_KEYWORD_ALL_COUNT_QRY = "SELECT COUNT(*) as 'cnt' 
                                                    FROM smart_factory_warehouse_log, smart_factory_warehouse, 
                                                        smart_product, smart_project 
                                                    WHERE (smart_factory_warehouse.id = smart_factory_warehouse_log.w_id) 
                                                    AND (smart_factory_warehouse.product_id = smart_product.product_id) 
                                                    AND (smart_product.project_id = smart_project.project_id) 
                                                    AND (current_type = ? OR current_type = ?)
                                                    AND (smart_project.project_name like ? 
                                                    OR smart_product.product_name like ?)";

        $this->SELECT_WAREHOUSE_FIND_PROJECT_ID_QRY = "SELECT smart_factory_warehouse_log.id, smart_factory_warehouse_log.w_id, 
                                                        smart_factory_warehouse_log.prev_w_id, 
                                                        smart_factory_warehouse.product_id, smart_product.project_id, 
                                                        smart_product.product_name FROM 
                                                        smart_factory_warehouse_log, smart_factory_warehouse, smart_product WHERE 
                                                        smart_factory_warehouse_log.w_id = smart_factory_warehouse.id AND 
                                                        smart_factory_warehouse.product_id = smart_product.product_id 
                                                        AND smart_product.project_id = ?";

        $this->SELECT_WAREHOUSE_FIND_PRODUCT_ID_QRY = "SELECT smart_factory_warehouse_log.id, smart_factory_warehouse_log.w_id, 
                                                    smart_factory_warehouse_log.prev_w_id, 
                                                    smart_factory_warehouse.product_id, smart_product.project_id, 
                                                    smart_product.product_name FROM 
                                                    smart_factory_warehouse_log, smart_factory_warehouse, smart_product 
                                                    WHERE 
                                                    smart_factory_warehouse_log.w_id = smart_factory_warehouse.id AND 
                                                    smart_factory_warehouse.product_id = smart_product.product_id 
                                                    AND smart_product.product_id = ?";

        $this->SELECT_WAREHOUSE_FIND_ID_QRY = "SELECT smart_factory_warehouse.id AS 'w_id', smart_product.product_id, 
                                                smart_product.product_name, smart_factory_warehouse.product_cnt, 
                                                smart_factory_warehouse_barcode.rand_id, 
                                                smart_factory_warehouse.create_date, smart_factory_warehouse.create_type, 
                                                smart_factory_warehouse.ip 
                                                FROM smart_factory_warehouse, smart_factory_warehouse_barcode, smart_product   
                                                WHERE smart_factory_warehouse.product_id = smart_product.product_id AND 
                                                smart_factory_warehouse.id = smart_factory_warehouse_barcode.id AND 
                                                smart_factory_warehouse.id = ?  
                                                ORDER BY smart_factory_warehouse.id";


        $this->INSERT_WAREHOUSE_BARCODE_QRY = "INSERT INTO smart_factory_warehouse_barcode(id, rand_id, regidate, ip) 
                                            VALUES(?, ?, ?, ?)";

        $this->SELECT_WAREHOUSE_BARCODE_FIND_ID_QRY = "SELECT * FROM smart_factory_warehouse_barcode WHERE id = ?";

        $this->SELECT_WAREHOUSE_BARCODE_FIND_RAND_ID_QRY = "SELECT * FROM smart_factory_warehouse_barcode WHERE rand_id = ?";

        $this->INSERT_WAREHOUSE_BARCODE_PRINT_LOG_QRY = "INSERT INTO smart_factory_warehouse_barcode_print_log
                                                        (id, member_id, release_cnt, release_type, print_type, regidate, ip) 
                                                        VALUES(?, ?, ?, ?, ?, ?, ?)";

        $this->SELECT_WAREHOUSE_BARCODE_PRINT_LOG_QRY = "SELECT * FROM smart_factory_warehouse_barcode_print_log 
                                                        WHERE id = ?";

        $this->SELECT_WAREHOUSE_BARCODE_PRINT_LOG_LATEST_FIND_ID_QRY = "SELECT * FROM smart_factory_warehouse_barcode_print_log 
                                                                WHERE id = ? AND release_type = ?";

        $this->UPDATE_WAREHOUSE_BARCODE_PRINT_LOG_QRY = "UPDATE smart_factory_warehouse_barcode_print_log SET 
                                                        release_type = ? WHERE id = ? 
                                                        AND member_id = ? AND regidate = ?";

        $this->SELECT_WAREHOUSE_BARCODE_BAG_FIND_ID_QRY = "SELECT * FROM smart_factory_warehouse_barcode_bag WHERE id = ?";

        $this->INSERT_WAREHOUSE_BARCODE_BAG_QRY = "INSERT INTO smart_factory_warehouse_barcode_bag
                                                    (id, member_id, regidate, ip) VALUES(?, ?, ?, ?)";

        $this->SELECT_WAREHOUSE_BARCODE_BAG_FULL_QRY = "SELECT smart_factory_warehouse_barcode_bag.id, 
                                                        smart_factory_warehouse_barcode.rand_id, 
                                                        smart_product.project_id, 
                                                        smart_project.project_name, 
                                                        smart_factory_warehouse.product_id, 
                                                        smart_product.product_name, 
                                                        smart_factory_warehouse_log.current_cnt, 
                                                        smart_factory_warehouse_log.current_type, 
                                                        smart_factory_warehouse_log.release_type, 
                                                        smart_factory_warehouse_log.release_date, 
                                                        smart_factory_warehouse_log.release_cnt, 
                                                        smart_factory_warehouse.create_date, 
                                                        smart_factory_warehouse_barcode_bag.regidate, 
                                                        smart_factory_warehouse_barcode_bag.ip   
                                                        FROM smart_project, smart_product, 
                                                        smart_factory_warehouse, smart_factory_warehouse_log, 
                                                        smart_factory_warehouse_barcode, 
                                                        smart_factory_warehouse_barcode_bag 
                                                        WHERE 
                                                        smart_project.project_id = smart_product.project_id AND 
                                                        smart_product.product_id = smart_factory_warehouse.product_id AND 
                                                        smart_factory_warehouse_barcode.id = smart_factory_warehouse.id AND 
                                                        smart_factory_warehouse_barcode_bag.id = smart_factory_warehouse.id AND 
                                                        smart_factory_warehouse.id = smart_factory_warehouse_log.w_id AND 
                                                        (smart_factory_warehouse_log.current_type = '최근' OR 
                                                        smart_factory_warehouse_log.current_type = '신규') 
                                                        ORDER BY smart_factory_warehouse_barcode_bag.id";

        $this->DELETE_WAREHOUSE_BARCODE_BAG_FIND_ID_QRY = "DELETE FROM smart_factory_warehouse_barcode_bag 
                                                            WHERE id = ?";

        $this->SELECT_WAREHOUSE_BARCODE_BAG_COUNT_QRY = "SELECT COUNT(*) as 'cnt' FROM smart_factory_warehouse_barcode_bag";

        $this->DELETE_WAREHOUSE_BARCODE_BAG_ALL_QRY = "DELETE FROM smart_factory_warehouse_barcode_bag";

        $this->SELECT_WAREHOUSE_BARCODE_BAG_LIST_FIND_MEMBER_ID_QRY = "SELECT smart_factory_warehouse_barcode_bag.id, 
                                                            smart_factory_warehouse_barcode.rand_id, 
                                                            smart_product.project_id, 
                                                            smart_project.project_name, 
                                                            smart_factory_warehouse.product_id, 
                                                            smart_product.product_name, 
                                                            smart_factory_warehouse_log.current_cnt, 
                                                            smart_factory_warehouse_log.current_type, 
                                                            smart_factory_warehouse_log.release_type, 
                                                            smart_factory_warehouse_log.release_date, 
                                                            smart_factory_warehouse_log.release_cnt, 
                                                            smart_factory_warehouse.create_date, 
                                                            smart_factory_warehouse_barcode_bag.regidate, 
                                                            smart_factory_warehouse_barcode_bag.ip   
                                                            FROM smart_project, smart_product, 
                                                            smart_factory_warehouse, smart_factory_warehouse_log, 
                                                            smart_factory_warehouse_barcode, 
                                                            smart_factory_warehouse_barcode_bag 
                                                            WHERE 
                                                            smart_project.project_id = smart_product.project_id AND 
                                                            smart_product.product_id = smart_factory_warehouse.product_id AND 
                                                            smart_factory_warehouse_barcode.id = smart_factory_warehouse.id AND 
                                                            smart_factory_warehouse_barcode_bag.id = smart_factory_warehouse.id AND 
                                                            smart_factory_warehouse.id = smart_factory_warehouse_log.w_id AND 
                                                            smart_factory_warehouse_barcode_bag.member_id = ? AND 
                                                            (smart_factory_warehouse_log.current_type = '최근' OR 
                                                            smart_factory_warehouse_log.current_type = '신규') 
                                                            ORDER BY smart_factory_warehouse_barcode_bag.id";

        $this->DELETE_WAREHOUSE_BARCODE_BAG_FIND_MEMBER_ID_QRY = "DELETE FROM smart_factory_warehouse_barcode_bag 
                                                                WHERE member_id = ?";

        $this->SELECT_WAREHOUSE_BARCODE_BAG_COUNT_FIND_MEMBER_ID_QRY = "SELECT COUNT(*) as 'cnt' FROM smart_factory_warehouse_barcode_bag 
                                                                    WHERE member_id = ?";

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
        //echo "특: <br>";
        //print_r($this->conn);
    }

    public function insertWarehouse($warehouseVO){
        
        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_WAREHOUSE_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("iisss", 
                            $product_id, 
                            $product_cnt,
                            $create_date,
                            $create_type,
                            $ip);

            $product_id = $warehouseVO->getProduct_id();
            $product_cnt = $warehouseVO->getProduct_cnt();
            $create_date = $warehouseVO->getCreate_date();
            $create_type = $warehouseVO->getCreate_type();
            $ip = $warehouseVO->getIp();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
        }

        return 0;

    }

    public function selectAllWarehouseCount(){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_ALL_COUNT_QRY);
            
            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function selectPagingWarehouse($startNum, $endNum){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_PAGING_QRY);

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

    public function selectWarehouse($warehouseVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("iisss", 
                            $product_id, 
                            $product_cnt,
                            $create_date,
                            $create_type,
                            $ip);

            $product_id = $warehouseVO->getProduct_id();
            $product_cnt = $warehouseVO->getProduct_cnt();
            $create_date = $warehouseVO->getCreate_date();
            $create_type = $warehouseVO->getCreate_type();
            $ip = $warehouseVO->getIp();


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

    public function insertWarehouseLog($warehouseLogVO){

        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_WAREHOUSE_LOG_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("iiiiissss", 
                            $w_id, 
                            $prev_w_id,
                            $prev_cnt,
                            $release_cnt,
                            $current_cnt,
                            $current_type,
                            $release_type,
                            $release_date,
                            $ip);

            $w_id = $warehouseLogVO->getW_id();
            $prev_w_id = $warehouseLogVO->getPrev_w_id();
            $prev_cnt = $warehouseLogVO->getPrev_cnt();
            $release_cnt = $warehouseLogVO->getRelease_cnt();
            $current_cnt = $warehouseLogVO->getCurrent_cnt();
            $current_type = $warehouseLogVO->getCurrent_type();
            $release_type = $warehouseLogVO->getRelease_type();
            $release_date = $warehouseLogVO->getRelease_date();
            $ip = $warehouseLogVO->getIp();
            

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
        }

        return 0;

    }

    public function selectAllWarehouseLogCount(){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_LOG_ALL_COUNT_QRY);
            
            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function selectPagingWarehouseLog($startNum, $endNum){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_LOG_PAGING_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("ssii", 
                                $current_type1, 
                                $current_type2, 
                                $_limnum, 
                                $_startnum);

            $current_type1 = "신규";
            $current_type2 = "최근";

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

    public function selectOneWarehouseLog($warehouseLogVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_LOG_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $id);

            $id = $warehouseLogVO->getId();


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

    public function selectPagingWarehouseLogView($startNum, $endNum){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_LOG_VIEW_PAGING_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("ssii", 
                                $current_type1, 
                                $current_type2, 
                                $_limnum, 
                                $_startnum);

            $current_type1 = "신규";
            $current_type2 = "최근";

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

    public function selectAllWarehouseLogViewCount(){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_LOG_VIEW_ALL_COUNT_QRY);
            
            $stmt->bind_param("ss", 
                                $current_type1, 
                                $current_type2);

            $current_type1 = "신규";
            $current_type2 = "최근";

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
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function updateBeforeWarehouseLog($warehouseLogVO){

        $my_conn = $this->getConn();

        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            //echo "참4 - mysqlConn<br>";
            //echo "참5 - " . $this->UPDATE_WAREHOUSE_LOG_BEFORE_QRY . "<br>";
                            
            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->UPDATE_WAREHOUSE_LOG_BEFORE_QRY);

                //print_r($boardVO);

                $stmt->bind_param("ssi", 
                                $current_type,
                                $release_type,
                                $id);

                $current_type = $warehouseLogVO->getCurrent_type();
                $release_type = $warehouseLogVO->getRelease_type();
                $id = $warehouseLogVO->getId();


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

    public function selectWarehouseBetweenSumOfInputCnt($startDate, $endDate){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_INPUT_DATE_SUM_QRY);
            
            $stmt->bind_param("ss", 
                                $_startDate, 
                                $_endDate);

            $_startDate = $startDate;
            $_endDate = $endDate;

            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function selectWarehouseBetweenSumOfOutputCnt($startDate, $endDate){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_OUTPUT_DATE_SUM_QRY);
            
            $stmt->bind_param("sssss", 
                                $_startDate, 
                                $_endDate,
                                $current_type1,
                                $current_type2,
                                $current_type3);

            $_startDate = $startDate;
            $_endDate = $endDate;
            $current_type1 = "신규";
            $current_type2 = "최근";
            $current_type3 = "과거";

            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function selectPagingWarehouseLogKeywordView($startNum, $endNum, $keyword){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_LOG_VIEW_KEYWORD_PAGING_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("ssssii", 
                                $current_type1, 
                                $current_type2, 
                                $keyword1, 
                                $keyword2, 
                                $_limnum, 
                                $_startnum);

            $current_type1 = "신규";
            $current_type2 = "최근";

            $keyword1 = "%". $keyword . "%";
            $keyword2 = "%". $keyword . "%";

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

    public function selectAllWarehouseLogViewKeywordCount($keyword){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_LOG_VIEW_KEYWORD_ALL_COUNT_QRY);
            
            $stmt->bind_param("ssss", 
                                $current_type1, 
                                $current_type2,
                                $keyword1,
                                $keyword2);

            $current_type1 = "신규";
            $current_type2 = "최근";

            $keyword1 = "%". $keyword . "%";
            $keyword2 = "%". $keyword . "%";

            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function selectWarehouseFindProjectId($productVO){
        
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_FIND_PROJECT_ID_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $project_id);
            $project_id = $productVO->getProject_id();

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

    public function selectWarehouseFindProductId($productVO){
        
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_FIND_PRODUCT_ID_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $product_id);
            $product_id = $productVO->getProduct_id();

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

    public function selectWarehouseFindId($warehouseVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_FIND_ID_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $id);
            $id = $warehouseVO->getId();

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

    public function insertWarehouseBarcode($warehouseBarcodeVO){

        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_WAREHOUSE_BARCODE_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("isss", 
                            $id, 
                            $rand_id,
                            $regidate,
                            $ip);

            $id = $warehouseBarcodeVO->getId();
            $rand_id = $warehouseBarcodeVO->getRand_id();
            $regidate = $warehouseBarcodeVO->getRegidate();
            $ip = $warehouseBarcodeVO->getIp();
            

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
        }

        return 0;

    }
    
    public function selectWarehouseBarcodeFindId($warehouseBarcodeVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_BARCODE_FIND_ID_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $id);

            $id = $warehouseBarcodeVO->getId();
            

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

    public function selectWarehouseBarcodeFindRandId($warehouseBarcodeVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_BARCODE_FIND_RAND_ID_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("s", $rand_id);

            $rand_id = $warehouseBarcodeVO->getRand_id();
            

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

    public function insertWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO){

        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_WAREHOUSE_BARCODE_PRINT_LOG_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("iiissss", 
                            $id, 
                            $member_id, 
                            $release_cnt, 
                            $release_type, 
                            $print_type, 
                            $regidate, 
                            $ip);

            $id = $warehouseBarcodePrintLogVO->getId();
            $member_id = $warehouseBarcodePrintLogVO->getMember_id();
            $release_cnt = $warehouseBarcodePrintLogVO->getRelease_cnt();
            $release_type = $warehouseBarcodePrintLogVO->getRelease_type();
            $print_type = $warehouseBarcodePrintLogVO->getPrint_type();
            $regidate = $warehouseBarcodePrintLogVO->getRegidate();
            $ip = $warehouseBarcodePrintLogVO->getIp();
            

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
        }

        return 0;

    }

    public function selectWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_BARCODE_PRINT_LOG_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $id);

            $id = $warehouseBarcodePrintLogVO->getId();
            

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

    public function selectWarehouseBarcodePrintLogLatestFindId($warehouseBarcodePrintLogVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_BARCODE_PRINT_LOG_LATEST_FIND_ID_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("is", $id,
                                    $release_type);

            $id = $warehouseBarcodePrintLogVO->getId();
            $release_type = $warehouseBarcodePrintLogVO->getRelease_type();
            

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

    public function updateWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO){
        
        $my_conn = $this->getConn();

        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            //echo "참4 - mysqlConn<br>";
            //echo "참5 - " . $this->UPDATE_WAREHOUSE_LOG_BEFORE_QRY . "<br>";
                            
            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->UPDATE_WAREHOUSE_BARCODE_PRINT_LOG_QRY);

                //print_r($boardVO);

                $stmt->bind_param("siis", 
                                $release_type,
                                $id,
                                $member_id, 
                                $regidate);

                $release_type = $warehouseBarcodePrintLogVO->getRelease_type();
                $id = $warehouseBarcodePrintLogVO->getId();
                $member_id = $warehouseBarcodePrintLogVO->getMember_id();
                $regidate = $warehouseBarcodePrintLogVO->getRegidate();


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

    public function selectWarehouseBarcodeBagFindId($warehouseBarcodeBagVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_BARCODE_BAG_FIND_ID_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $id);

            $id = $warehouseBarcodeBagVO->getId();
            

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

    public function insertWarehouseBarcodeBag($warehouseBarcodeBagVO){

        
        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_WAREHOUSE_BARCODE_BAG_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("iiss", 
                            $id, 
                            $member_id,  
                            $regidate, 
                            $ip);

            $id = $warehouseBarcodeBagVO->getId();
            $member_id = $warehouseBarcodeBagVO->getMember_id();
            $regidate = $warehouseBarcodeBagVO->getRegidate();
            $ip = $warehouseBarcodeBagVO->getIp();
            

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
        }

        return 0;

    }

    public function selectWarehouseBarcodeBagList(){
        
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_BARCODE_BAG_FULL_QRY);

            //print_r($boardFileVO);

            //$stmt->bind_param("i", $id);
            //$id = $warehouseBarcodeBagVO->getId();

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

    public function deleteWarehouseBarcodeBag($warehouseBarcodeBagVO){

        $my_conn = $this->getConn();
        
        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();
            
            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->DELETE_WAREHOUSE_BARCODE_BAG_FIND_ID_QRY);
                
                //print_r($boardVO);
                
                $stmt->bind_param("i", $id);
                
                $id = $warehouseBarcodeBagVO->getId();
                
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

    public function selectWarehouseBarcodeBagCount(){
        
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_BARCODE_BAG_COUNT_QRY);

            //print_r($boardFileVO);

            //$stmt->bind_param("i", $id);
            //$id = $warehouseBarcodeBagVO->getId();

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

    public function deleteWarehouseBarcodeAllBag(){
        
        $my_conn = $this->getConn();
        
        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();
            
            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->DELETE_WAREHOUSE_BARCODE_BAG_ALL_QRY);
                
                //print_r($boardVO);
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

    public function selectWarehouseBarcodeBagListFindMemberId($warehouseBarcodeBagVO){
        
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_BARCODE_BAG_LIST_FIND_MEMBER_ID_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $member_id);
            $member_id = $warehouseBarcodeBagVO->getMember_id();

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
    
    public function deleteWarehouseBarcodeBagFindMemberId($warehouseBarcodeBagVO){

        $my_conn = $this->getConn();
        
        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();
            
            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->DELETE_WAREHOUSE_BARCODE_BAG_FIND_MEMBER_ID_QRY);
                
                $stmt->bind_param("i", $member_id);
                $member_id = $warehouseBarcodeBagVO->getMember_id();
                //print_r($boardVO);
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

    public function selectWarehouseBarcodeBagCountFindMemberId($warehouseBarcodeBagVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_WAREHOUSE_BARCODE_BAG_COUNT_FIND_MEMBER_ID_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $member_id);
            $member_id = $warehouseBarcodeBagVO->getMember_id();

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