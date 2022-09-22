<?php
/*
 * Created Date: 2022-06-12 (Sun)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: ProductDAOImpl
 * Filename: ProductDAOImpl.php
 * Description:
 * 1. 제품 페이징 알고리즘 적용, 정도윤(Doyun Jung), 2022-06-12.
 * 
*/

class ProductDAOImpl implements ProductDAO{

    private $conn;

    private $SELECT_PRODUCT_VIEW_QRY;
    private $SELECT_PRODUCT_ALL_COUNT_FIND_QRY;
    private $SELECT_PRODUCT_PAGING_FIND_QRY;

    private $SELECT_PRODUCT_ALL_COUNT_QRY;
    private $SELECT_PRODUCT_PAGING_QRY;

    private $SELECT_PRODUCT_FULL_QRY;
    private $INSERT_PRODUCT_QRY;
    private $INSERT_PRODUCT_FILE_QRY;

    private $SELECT_FIND_UUID_PRODUCT_FILE_QRY;
    private $SELECT_FIND_ID_PRODUCT_QRY;
    private $SELECT_FIND_ID_PRODUCT_FILE_QRY;

    private $UPDATE_PRODUCT_QRY;
    
    private $DELETE_PRODUCT_FILE_QRY;
    private $DELETE_FIND_UUID_PRODUCT_FILE_QRY;

    private $INSERT_PRODUCT_BARCODE_QRY;
    private $SELECT_PRODUCT_BARCODE_FIND_ID_QRY;
    private $SELECT_PRODUCT_BARCODE_FIND_RAND_ID_QRY;

    private $SELECT_PRODUCT_FIND_PROJECT_ID_QRY;
    private $DELETE_FIND_ID_PRODUCT_QRY;

    private $SELECT_PRODUCT_BOX_SPEC_FIND_PRODUCT_ID_QRY;
    private $INSERT_PRODUCT_BOX_SPEC_QRY;
    private $UPDATE_PRODUCT_BOX_SPEC_QRY;
    private $DELETE_PRODUCT_BOX_SPEC_QRY;


    private function loadQuery(){

        $this->SELECT_PRODUCT_VIEW_QRY = "SELECT * FROM smart_product 
                                    WHERE product_name like ? ORDER BY product_id";

        $this->SELECT_PRODUCT_ALL_COUNT_FIND_QRY = "SELECT COUNT(*) as 'cnt' FROM smart_product
                                         WHERE product_name like ?";
        
        $this->SELECT_PRODUCT_PAGING_FIND_QRY = "SELECT * FROM smart_product 
                                        WHERE product_name like ? 
                                        ORDER BY product_id desc 
                                        LIMIT ? OFFSET ?";

        $this->SELECT_PRODUCT_ALL_COUNT_QRY = "SELECT COUNT(*) as 'cnt' FROM smart_product";

        $this->SELECT_PRODUCT_PAGING_QRY = "SELECT * FROM smart_product 
                                            ORDER BY product_id desc 
                                            LIMIT ? OFFSET ?";

        $this->SELECT_PRODUCT_FULL_QRY = "SELECT * FROM smart_product 
                                        WHERE product_name = ? AND 
                                        description = ? AND 
                                        regidate = ? AND 
                                        ip = ? AND 
                                        project_id = ?";
                                        
        $this->INSERT_PRODUCT_QRY = "INSERT INTO smart_product (product_name, description, regidate, 
                                    ip, project_id) VALUES(?, ?, ?, ?, ?)";


        $this->INSERT_PRODUCT_FILE_QRY = "INSERT INTO smart_product_file (product_id, 
                                    uuid, root_dir, upload_dir, file_ext, file_size, 
                                    original_name, file_name, file_type, regidate, ip) 
                                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->SELECT_FIND_UUID_PRODUCT_FILE_QRY = "SELECT * FROM smart_product_file 
                                                    WHERE uuid = ?";

        $this->SELECT_FIND_ID_PRODUCT_QRY = "SELECT smart_project.project_id AS 'project_id', 
                                            smart_project.project_name, smart_product.product_id, 
                                            smart_product.product_name, smart_product.description, 
                                            smart_product.regidate AS 'regidate', smart_product.ip AS 'ip' 
                                            FROM smart_project, smart_product 
                                            WHERE smart_product.project_id = smart_project.project_id  
                                            AND smart_product.product_id = ? 
                                            ORDER BY smart_product.product_id";

        $this->SELECT_FIND_ID_PRODUCT_FILE_QRY = "SELECT * FROM smart_product_file WHERE product_id = ?";

        $this->UPDATE_PRODUCT_QRY = "UPDATE smart_product SET product_name = ?, 
                                    description = ?, regidate = ?, project_id = ? 
                                    WHERE product_id = ?";
        
        $this->DELETE_PRODUCT_FILE_QRY = "DELETE FROM smart_product_file WHERE product_id = ? AND    
                                                                        uuid = ? AND upload_dir = ? AND  
                                                                        original_name = ? AND file_name = ? AND  
                                                                        regidate = ?";
        
        $this->DELETE_FIND_UUID_PRODUCT_FILE_QRY = "DELETE FROM smart_product_file 
                                                    WHERE uuid = ?";

        $this->INSERT_PRODUCT_BARCODE_QRY = "INSERT INTO smart_product_barcode(product_id, rand_id, regidate, ip) VALUES(?, ?, ?, ?)";

		$this->SELECT_PRODUCT_BARCODE_FIND_ID_QRY = "SELECT * FROM smart_product_barcode WHERE product_id = ?";

        $this->SELECT_PRODUCT_BARCODE_FIND_RAND_ID_QRY = "SELECT * FROM smart_product_barcode WHERE rand_id = ?";

        $this->SELECT_PRODUCT_FIND_PROJECT_ID_QRY = "SELECT * FROM smart_product WHERE project_id = ?";

        $this->DELETE_FIND_ID_PRODUCT_QRY = "DELETE FROM smart_product WHERE product_id = ?";

        $this->SELECT_PRODUCT_BOX_SPEC_FIND_PRODUCT_ID_QRY = "SELECT smart_product_box_spec.product_id, 
                                                            smart_product_box_spec.box_type_id,
                                                            smart_box_type.type_name, 
                                                            smart_product_box_spec.width, 
                                                            smart_product_box_spec.`length`, 
                                                            smart_product_box_spec.height, 
                                                            smart_product_box_spec.box_name,
                                                            smart_product_box_spec.regidate,
                                                            smart_product_box_spec.ip 
                                                            FROM smart_product_box_spec, smart_box_type 
                                                            WHERE smart_product_box_spec.box_type_id = smart_box_type.box_type_id 
                                                            AND smart_product_box_spec.product_id = ?";

        $this->INSERT_PRODUCT_BOX_SPEC_QRY = "INSERT INTO smart_product_box_spec(product_id, box_type_id, width, 
                                            length, height, box_name, regidate, ip) 
                                            VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

        $this->UPDATE_PRODUCT_BOX_SPEC_QRY = "UPDATE smart_product_box_spec SET box_type_id = ?, width = ?, length = ?, 
                                            height = ?, box_name = ?, regidate = ?, ip = ? WHERE product_id = ?";

        $this->DELETE_PRODUCT_BOX_SPEC_QRY = "DELETE FROM smart_product_box_spec WHERE product_id = ?";

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

    public function selectProduct($productVO){

        //$boardArr = null;
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
            //            echo "DB-참<br>";

            $mysqlConn = $my_conn->getMysqli();

            $stmt = $mysqlConn->prepare($this->SELECT_PRODUCT_VIEW_QRY);

            $stmt->bind_param("s", $productName);

            $productName = "%". $productVO->getProduct_name() . "%";

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

    public function selectAllProductCountFind($productVO){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_PRODUCT_ALL_COUNT_FIND_QRY);
            
            $stmt->bind_param("s", $productName);
            $productName = "%". $productVO->getProduct_name() . "%";

            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function selectPagingProductFind($startNum, $endNum, $productVO){


        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_PRODUCT_PAGING_FIND_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("sii", $productName, $_limnum, $_startnum);
            $productName = "%". $productVO->getProduct_name() . "%";

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

    public function selectAllProductCount(){

        $my_conn = $this->getConn();
        $result = null;
        $rows = null;

        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_PRODUCT_ALL_COUNT_QRY);
            
            $stmt->execute();

            $result = $stmt->get_result();
            
            if ( $result->num_rows == 1 ){
                $rows = $result->fetch_assoc();
            }

            $stmt->close();

        }

        return $rows;

    }

    public function selectPagingProduct($startNum, $endNum){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_PRODUCT_PAGING_QRY);

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

    public function selectFullProductQry($productVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
            //            echo "DB-참<br>";

            $mysqlConn = $my_conn->getMysqli();

            $stmt = $mysqlConn->prepare($this->SELECT_PRODUCT_FULL_QRY);

            $stmt->bind_param("sssss", $product_name, 
                                        $description, 
                                        $regidate, 
                                        $ip,
                                        $project_id);

            $product_name = $productVO->getProduct_name();
            $description = $productVO->getDescription();
            $regidate = $productVO->getRegidate();
            $ip = $productVO->getIp();
            $project_id = $productVO->getProject_id();

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

    public function insertProduct($productVO){

        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_PRODUCT_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("sssss", $product_name, 
                                        $description, 
                                        $regidate, 
                                        $ip, 
                                        $project_id);

            $product_name = $productVO->getProduct_name();
            $description = $productVO->getDescription();
            $regidate = $productVO->getRegidate();
            $ip = $productVO->getIp();
            $project_id = $productVO->getProject_id();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;
        }

        return 0;

    }

    public function insertProductFile($productFileVO){

        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_PRODUCT_FILE_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("sssssssssss", $product_id, 
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

            $product_id = $productFileVO->getProduct_id();
            $uuid = $productFileVO->getUuid();
            $root_dir = $productFileVO->getRoot_dir();
            $upload_dir = $productFileVO->getUpload_dir();
            $file_ext = $productFileVO->getFile_ext();

            $file_size = $productFileVO->getFile_size();
            $original_name = $productFileVO->getOriginal_name();
            $file_name = $productFileVO->getFile_name();
            $file_type = $productFileVO->getFile_type();
            $regidate = $productFileVO->getRegidate();

            $ip = $productFileVO->getIp();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;

        }

        return 0;

    }

    
    public function selectFindUUIDProductFile($productFileVO){

        //$boardArr = null;
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
            //            echo "DB-참<br>";

            $mysqlConn = $my_conn->getMysqli();

            $stmt = $mysqlConn->prepare($this->SELECT_FIND_UUID_PRODUCT_FILE_QRY);

            $stmt->bind_param("s", $uuid);

            $uuid = $productFileVO->getUuid();

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

    public function selectFindIDProduct($productVO){

        //$boardArr = null;
        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
            //            echo "DB-참<br>";

            $mysqlConn = $my_conn->getMysqli();

            $stmt = $mysqlConn->prepare($this->SELECT_FIND_ID_PRODUCT_QRY);

            $stmt->bind_param("i", $product_id);

            $product_id = $productVO->getProduct_id();

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

    public function selectFindIDProductFile($productFileVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_FIND_ID_PRODUCT_FILE_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $product_id);

            $product_id = $productFileVO->getProduct_id();
            

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

    public function updateProduct($productVO){

        $my_conn = $this->getConn();

        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->UPDATE_PRODUCT_QRY);

                //print_r($boardVO);

                $stmt->bind_param("sssss", 
                                $product_name, 
                                $description, 
                                $regidate, 
                                $project_id, 
                                $product_id);

                $product_name = $productVO->getProduct_name();
                $description = $productVO->getDescription();
                $regidate = $productVO->getRegidate();
                $project_id = $productVO->getProject_id();
                $product_id = $productVO->getProduct_id();


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
    
    public function deleteProductFile($productFileVO){
        
        $my_conn = $this->getConn();
        
        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();
            
            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->DELETE_PRODUCT_FILE_QRY);
                
                //print_r($boardVO);
                
                $stmt->bind_param("ssssss",
                                                $product_id,
                                                $uuid, 
                                                $upload_dir, 
                                                $original_name, 
                                                $file_name,
                                                $regidate);
                
                $product_id = $productFileVO->getProduct_id();
                $uuid = $productFileVO->getUuid();
                $upload_dir = $productFileVO->getUpload_dir();
                $original_name = $productFileVO->getOriginal_name();
                $file_name = $productFileVO->getFile_name();
                $regidate = $productFileVO->getRegidate();
                
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
    
    public function deleteFindUUIDProductFile($productFileVO){
        
        $my_conn = $this->getConn();
        
        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();
            
            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->DELETE_FIND_UUID_PRODUCT_FILE_QRY);
                
                //print_r($boardVO);
                
                $stmt->bind_param("s", $uuid);
                
                $uuid = $productFileVO->getUuid();
                
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

    public function insertProductBarcode($productBarcodeVO){

        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_PRODUCT_BARCODE_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("isss", $product_id, 
                                        $rand_id, 
                                        $regidate, 
                                        $ip);

            $product_id = $productBarcodeVO->getProduct_id();
            $rand_id = $productBarcodeVO->getRand_id();
            $regidate = $productBarcodeVO->getRegidate();
            $ip = $productBarcodeVO->getIp();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;

        }

        return 0;

    }

    public function selectProductBarcodeFindId($productBarcodeVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_PRODUCT_BARCODE_FIND_ID_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $product_id);

            $product_id = $productBarcodeVO->getProduct_id();
            

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

    public function selectProductBarcodeFindRandId($productBarcodeVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_PRODUCT_BARCODE_FIND_RAND_ID_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $rand_id);

            $rand_id = $productBarcodeVO->getRand_id();
            

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

    public function selectProductFindProjectId($productVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_PRODUCT_FIND_PROJECT_ID_QRY);

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

    public function deleteProduct($productVO){

        $my_conn = $this->getConn();
        
        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();
            
            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->DELETE_FIND_ID_PRODUCT_QRY);
                
                //print_r($boardVO);
                
                $stmt->bind_param("i", $product_id);
                
                $product_id = $productVO->getProduct_id();
                
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

    public function selectProductBoxSpecFindProductId($boxSpecVO){

        $rows = null;
        $my_conn = $this->getConn();
        $result = null;

        $this->loadQuery();

        if ( $my_conn != null ){
    
            $mysqlConn = $my_conn->getMysqli();
            $stmt = $mysqlConn->prepare($this->SELECT_PRODUCT_BOX_SPEC_FIND_PRODUCT_ID_QRY);

            //print_r($boardFileVO);

            $stmt->bind_param("i", $product_id);

            $product_id = $boxSpecVO->getProduct_id();
            

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

    public function insertProductBoxSpec($boxSpecVO){

        $my_conn = $this->getConn();
        $result = null;
        
        $this->loadQuery();

        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            //echo $this->INSERT_QRY;
            $stmt = $mysqlConn->prepare($this->INSERT_PRODUCT_BOX_SPEC_QRY);

            //echo $this->INSERT_GOODS_QRY;

            $stmt->bind_param("iissssss", $product_id, 
                                        $box_type_id, 
                                        $width, 
                                        $length, 
                                        $height, 
                                        $box_name, 
                                        $regidate, 
                                        $ip);

            $product_id = $boxSpecVO->getProduct_id();
            $box_type_id = $boxSpecVO->getBox_type_id();
            $width = $boxSpecVO->getWidth();
            $length = $boxSpecVO->getLength();
            $height = $boxSpecVO->getHeight();
            $box_name = $boxSpecVO->getBox_name();
            $regidate = $boxSpecVO->getRegidate();
            $ip = $boxSpecVO->getIp();

            //echo $ip;

            $stmt->execute();
            //$stmt->close();
            
            return 1;

        }

        return 0;

    }

    public function updateProductBoxSpec($boxSpecVO){

        $my_conn = $this->getConn();

        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();

            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->UPDATE_PRODUCT_BOX_SPEC_QRY);

                //print_r($boardVO);

                $stmt->bind_param("issssssi", 
                                $box_type_id, 
                                $width, 
                                $length, 
                                $height, 
                                $box_name, 
                                $regidate, 
                                $ip, 
                                $product_id);


                $box_type_id = $boxSpecVO->getBox_type_id();
                $width = $boxSpecVO->getWidth();
                $length = $boxSpecVO->getLength();
                $height = $boxSpecVO->getHeight();
                $box_name = $boxSpecVO->getBox_name();
                $regidate = $boxSpecVO->getRegidate();
                $ip = $boxSpecVO->getIp();
                $product_id = $boxSpecVO->getProduct_id();

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

    public function deleteProductBoxSpec($boxSpecVO){

        $my_conn = $this->getConn();
        
        $this->loadQuery();
        
        //echo "참3 <br>";
        if($my_conn != null ){
            
            $mysqlConn = $my_conn->getMysqli();
            
            // 트랜젝션
            $mysqlConn->begin_transaction();
            
            try{
                //echo $this->DELETE_QRY;
                $stmt = $mysqlConn->prepare($this->DELETE_PRODUCT_BOX_SPEC_QRY);
                
                //print_r($boardVO);
                
                $stmt->bind_param("i", $product_id);
                
                $product_id = $boxSpecVO->getProduct_id();
                
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

}

?>