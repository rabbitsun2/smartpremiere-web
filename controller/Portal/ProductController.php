<?php
/*
 * Created Date: 2022-06-16 (Thu)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Controller
 * Filename: ProductController.php
 * Description:
 *  1. 제품 수정 기능 추가, 정도윤, 2022-07-14 (Thu).
 *  2. 박스 기능 추가, 정도윤, 2022-08-03 (Wed).
 * 
 */

class ProductController extends Controller {
 
    private $project_service;
    private $product_service;
    private $warehouse_service;
    private $box_service;

    public function __construct(){
        
    }
    
    public function __destruct(){
        
    }
    
    private function templateDir(){

        $smarty = $this->getSmarty();
        $root_dir = $this->getRootDir();
        $smarty->setTemplateDir($root_dir . '/view/main/mgt');

        $this->setSmarty($smarty);
        
    }

    private function loadService(){
        
        $this->project_service = new ProjectServiceImpl();
        $this->product_service = new ProductServiceImpl();
        $this->warehouse_service = new WarehouseServiceImpl();
        $this->box_service = new BoxServiceImpl();
        
        $my_conn = $this->getConn();

        $this->project_service->setConn($my_conn);
        $this->product_service->setConn($my_conn);
        $this->warehouse_service->setConn($my_conn);
        $this->box_service->setConn($my_conn);
        //print_r($this->warehouse_service);

    }
    

    public function product_list($pageCri){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $paging = new Paging();

        $result = $this->product_service->selectAllProductCount();
        $total_cnt = $result['cnt'];


        $page_no = $pageCri->getPage();
        $page_size = $pageCri->getPerPageNum();

        $paging->setPageNo($page_no);
        $paging->setPageSize($page_size);
        $paging->setTotalCount($total_cnt);

        $pagingObj = $paging->getObject();

        $startnum = $paging->getDbStartNum();
        $endnum = $paging->getDbEndNum();

        //$resultProductVO = $this->product_service->selectProduct($productVO);

        $productList = $this->product_service->selectPagingProduct($startnum, $endnum);
        //echo $keyword;
        //print_r($productList);

        $var_fn = "&func=item_status";

        $smarty->assign("productList", $productList);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);

        $smarty->assign("title", "프로젝트/제품 현황:::Smart Premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('product_list.tpl');

    }

    public function product_list_detail_view($productVO){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $product_id = $productVO->getProduct_id();

        $productFileVO = new ProductFileVO();
        $productFileVO->setProduct_id( $product_id );

        $resultProduct = $this->product_service->selectFindIDProduct($productVO);
        $resultProductFile = $this->product_service->selectFindIDProductFile($productFileVO);


        if ( isset( $resultProduct) ){

            // 버그 개선(결과값 출력)
            if ( ArrayUtil::getDimensionArray($resultProduct) !== -1 ){
                $resultProduct = array(0 => $resultProduct);
            }

        }

        //echo "참1/" . $project_id ;
        //print_r($resultProjectFile);

        if ( isset( $resultProduct ) ){

            $smarty->assign("product_item", $resultProduct);
            $smarty->assign("product_file_item", $resultProductFile);

            $smarty->assign("title", "프로젝트/제품 상세:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('product_detail_view.tpl');

        }
        else{

            echo "<script>";
            echo "alert('올바른 ID를 입력하세요.');";
            echo "</script>";
            exit;

        }

    }

    public function product_register(){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();


        $smarty->assign("MAX_FILE_SIZE", $this->getUploadSize());
        $smarty->assign("title", "프로젝트/제품 등록:::Smart Premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('product_register.tpl');

    }

    public function project_search(){

        $this->templateDir();
        $smarty = $this->getSmarty();
        $smarty->clearAllCache();
        

        $smarty->assign("title", "프로젝트 검색:::Smart Premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('product_pjt_search_page.tpl');

    }

    public function project_search_result($pageCri, $keyword){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $projectVO = new ProjectVO();
        $projectVO->setProject_name($keyword);
        
        $paging = new Paging();

        $result = $this->project_service->selectAllProjectCountFind($projectVO);
        $total_cnt = $result['cnt'];


        $page_no = $pageCri->getPage();
        $page_size = $pageCri->getPerPageNum();

        $paging->setPageNo($page_no);
        $paging->setPageSize($page_size);
        $paging->setTotalCount($total_cnt);

        $pagingObj = $paging->getObject();

        $startnum = $paging->getDbStartNum();
        $endnum = $paging->getDbEndNum();

        //$resultProductVO = $this->product_service->selectProduct($productVO);

        $projectList = $this->project_service->selectPagingProjectFind($startnum, $endnum, $projectVO);
        //echo $keyword;
        //print_r($productList);

        $var_fn = "&func=input&search=project&keyword=" . $keyword;

        $smarty->assign("title", "프로젝트 검색 결과 - " . $keyword . ":::Smart Premiere");
        $smarty->assign("projectList", $projectList);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('product_pjt_search_result.tpl');

    }

    public function product_register_ok($productVO, $productFileArr, $boxSpecVO){

        $this->templateDir();
        $this->loadService();

        $status_rand_id = true;
        $rand_id = -1;
        $productBarcodeVO = new ProductBarcodeVO();

        $status = 1;

        
        // 제품명 입력 여부
        if ($productVO->getProduct_name() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ($productVO->getProduct_name() === -1 &&
            $status === 1) {
            $status = -1;
        }

        // 설명 입력 여부
        if ($productVO->getDescription() !== -1 &&
            $status === 1 ){
            $status = 1;
        }else if ($productVO->getDescription() === -1 &&
            $status === 1 ){
            $status = -2;
        }

        // 프로젝트 번호 입력 여부
        if ($productVO->getProject_id() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ($productVO->getProject_id() === -1 &&
            $status === 1) {
            $status = -3;
        }


        // 파일 확장자 제한 여부
        if ( strcmp( $productVO->getFile_option() , "NORMAL" ) === 0 &&
               $status === 1 ){

            $status = 1;

        }else if ( strcmp( $productVO->getFile_option() , "RESTRICT" ) === 0 &&
            $status === 1 ){
            $status = -4;
        }


        if ( $status === 1 ){

            $result = $this->product_service->insertProduct($productVO);
    
            // 프로젝트 등록이 성공적인 경우
            if ( $result === 1 ){
                
                $result = $this->product_service->selectFullProductQry($productVO);
                //print_r($result);

                $product_id = $result['product_id'];
                $boxSpecVO->setProduct_id($product_id);     // 박스 Product_id 설정

                // 박스 추가
                $result_box_spec = $this->product_service->insertProductBoxSpec($boxSpecVO);

                //print_r($boardFileArr);
                
                // 파일 정보 입력(파일 업로드)
                foreach($productFileArr as $key=>$val){
                    
                    $val->setProduct_id($product_id);
                    
                    if ( strcmp( $val->getOption(), "success" ) === 0 ){
                        $result = $this->product_service->insertProductFile($val);

                    }
                    
                }

                // 바코드 생성
                $productBarcodeVO->setProduct_id($product_id);

                while($status_rand_id){

                    $rand_id = RandUtil::createBarcode();
                    $productBarcodeVO->setRand_id($rand_id);

                    $resultRandId = $this->product_service->selectProductBarcodeFindRandId($productBarcodeVO);

                    if ( !isset( $resultRandId ) ){

                        $productBarcodeVO->setRegidate($productVO->getRegidate());
                        $productBarcodeVO->setIp($productVO->getIp());

                        // 바코드 등록처리
                        $this->product_service->insertProductBarcode($productBarcodeVO);

                        $status_rand_id = false;

                    }

                }

            }
            else{
                //return 0;
                $status = -5;
            }
            
        }


        switch($status){

            // 프로젝트 등록이 성공일 때
            case 1:

                echo "<script>";
                echo "alert ('성공적으로 등록되었습니다.');";
                echo "location.replace('../portal/product?func=list');";
                echo "</script>";
                exit;

                break;

            case -1:

                echo "<script>";
                echo "alert('제품명을 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -2:

                echo "<script>";
                echo "alert('설명을 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -3:

                echo "<script>";
                echo "alert('프로젝트 번호를 선택하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;
                
                break;

            case -4:

                echo "<script>";
                echo "alert('파일 확장자가 제한되었습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -5:

                echo "<script>";
                echo "alert('제품 등록에 실패하였습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

        }

    }

    public function product_modify(){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $productVO = new ProductVO();
        $productVO->setProduct_id($_GET['id']);

        $productFileVO = new ProductFileVO();
        $productFileVO->setProduct_id($_GET['id']);


        $resultProductVO = $this->product_service->selectFindIDProduct($productVO);
        $resultProductFileVO = $this->product_service->selectFindIDProductFile($productFileVO);


        if ( isset($resultProductVO) ){

            // 버그 개선(결과값 출력)
            if ( ArrayUtil::getDimensionArray($resultProductVO) !== -1 ){
                $resultProductVO = array(0 => $resultProductVO);
            }

            $smarty->assign("product_item", $resultProductVO);
            $smarty->assign("product_file_item", $resultProductFileVO);

            $smarty->assign("MAX_FILE_SIZE", $this->getUploadSize());
            $smarty->assign("title", "프로젝트/제품 수정:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('product_modify.tpl');

        }

        else if ( !isset($resultProjectVO) ){
            
            echo "<script>";
            echo "alert('제품 정보가 존재하지 않습니다.');";
            echo "location.replace('../portal/product?func=list');";
            echo "</script>";
            exit;

        }

    }

    public function product_modify_ok($productVO, $productFileArr){

        $this->templateDir();
        $this->loadService();

        $status = 1;
        $index = 0;
        $i = 0;

        
        // 프로젝트 명 입력 여부
        if ($productVO->getProduct_name() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ($productVO->getProduct_name() === -1 &&
            $status === 1) {
            $status = -1;
        }

        // 설명 입력 여부
        if ($productVO->getDescription() !== -1 &&
            $status === 1 ){
            $status = 1;
        }else if ($productVO->getDescription() === -1 &&
            $status === 1 ){
            $status = -2;
        }

        // 프로젝트 번호 입력 여부
        if ($productVO->getProject_id() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ($productVO->getProject_id() === -1 &&
            $status === 1) {
            $status = -3;
        }

        // 제품 번호 입력 여부
        if ($productVO->getProduct_id() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ($productVO->getProduct_id() === -1 &&
            $status === 1) {
            $status = -4;
        }


        // 파일 확장자 제한 여부
        if ( strcmp( $productVO->getFile_option() , "NORMAL" ) === 0 &&
               $status === 1 ){

            $status = 1;

        }else if ( strcmp( $productVO->getFile_option() , "RESTRICT" ) === 0 &&
            $status === 1 ){
            $status = -5;
        }


        if ( $status === 1 ){

            $result = $this->product_service->updateProduct($productVO);
    
            // 프로젝트 등록이 성공적인 경우
            if ( $result === 1 ){
                
                $index = 0;
                // 파일 정보 입력(파일 업로드)
                foreach($productFileArr as $key=>$val){
                    
                    // 기존 파일 정보
                    if ( $index === 0 ){
                        
                        //echo $productVO->getProduct_id();
                        
                        $fileitem = $this->product_service->selectFindIDProductFile($productVO);
                                                
                        $i = 0;
                        
                        // 기존 파일이 존재할 때
                        if ( isset($fileitem) ){

                            for( $i = 0; $i < count($fileitem); $i++){
                                                        
                                //echo $fileitem[$i]["uuid"] . "<br><br>";
                                
                                $productFileVO = new ProductFileVO();
                                
                                $product_id = $fileitem[$i]['product_id'];
                                $uuid = $fileitem[$i]['uuid'];
                                $upload_dir = $fileitem[$i]['upload_dir'];
                                $original_name = $fileitem[$i]['original_name'];
                                $filename = $fileitem[$i]['file_name'];
                                $regidate = $fileitem[$i]['regidate'];
                                
                                $productFileVO->setProduct_id($product_id);
                                $productFileVO->setUuid($uuid);
                                $productFileVO->setUpload_dir($upload_dir);
                                $productFileVO->setOriginal_name($original_name);
                                $productFileVO->setFile_name($filename);
                                $productFileVO->setRegidate($regidate);
                                
                                $target_Dir = $upload_dir . "/" . $uuid;
                                $upload_dir_uuid_fullpath = $this->getRootDir() . $target_Dir;
                                $uploadRealName = $this->getRootDir() . $target_Dir ."/" . $filename;
                                                            
                                // 파일 삭제
                                if ( is_file($uploadRealName) ){
                                    unlink($uploadRealName);
                                }
                                
                                // 폴더 삭제
                                rmdir($upload_dir_uuid_fullpath);   // 임시 삭제
                                
                                // DB 삭제
                                $result = $this->product_service->deleteProductFile($productFileVO);
                                
                            }
                            
                        }
                                                
                    }
                    
                    $val->setProduct_id( $productVO->getProduct_id() );

                    // 파일 등록
                    if ( strcmp( $val->getOption(), "success" ) === 0 ){
                        $result = $this->product_service->insertProductFile($val);
                    }

                    $index++;
                    
                }

            }
            else{
                //return 0;
                $status = -6;
            }
            
        }


        switch($status){

            // 프로젝트 등록이 성공일 때
            case 1:

                echo "<script>";
                echo "alert ('성공적으로 수정되었습니다.');";
                echo "location.replace('../portal/product?func=list');";
                echo "</script>";
                exit;

                break;

            case -1:

                echo "<script>";
                echo "alert('제품명을 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -2:

                echo "<script>";
                echo "alert('설명을 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -3:

                echo "<script>";
                echo "alert('프로젝트 번호를 선택하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;
                
                break;
            
            case -4:

                echo "<script>";
                echo "alert('제품 번호를 선택하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;
                
                break;

            case -5:

                echo "<script>";
                echo "alert('파일 확장자가 제한되었습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -6:

                echo "<script>";
                echo "alert('제품 수정에 실패하였습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

        }

    }
    
    public function product_file_delete(){
        
        $this->templateDir();
        $this->loadService();
        
        $smarty = $this->getSmarty();
        $smarty->clearAllCache();
        
        $productFileVO = new ProductFileVO();
        $productFileVO->setProduct_id($_GET['product_id']);
        $productFileVO->setUuid($_GET['uuid']);
        

        $resultProductFileVO = $this->product_service->selectFindUUIDProductFile($productFileVO);
        
        
        if ( isset($resultProductFileVO) ){
            
            // 버그 개선(결과값 출력)
            if ( ArrayUtil::getDimensionArray($resultProductFileVO) !== -1 ){
                $resultProductFileVO = array(0 => $resultProductFileVO);
            }
            
            $smarty->assign("product_file_item", $resultProductFileVO);
            
            $smarty->assign("MAX_FILE_SIZE", $this->getUploadSize());
            $smarty->assign("title", "프로젝트/제품/파일 삭제:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('product_delete_file.tpl');
            
        }
        
        else if ( !isset($resultProductFileVO) ){
            
            echo "<script>";
            echo "alert('파일이 존재하지 않습니다.');";
            echo "location.replace('../portal/project?func=list');";
            echo "</script>";
            exit;
            
        }
        
    }
    
    
    public function product_file_delete_ok($productFileVO){
        
        $this->loadService();
        
        $targetDir = $this->getRootDir();
        
        $status = 1;
        $resultProductFile = $this->product_service->selectFindUUIDProductFile($productFileVO);
        
        // 파일이 DB에 존재할 때
        if ( !isset ( $resultProductFile ) ){
            $status = -1;
        }
        
        // 삭제 프로세스
        if ($status === 1){
                        
            $targetDir = $targetDir . $resultProductFile['upload_dir'];
            $upload_dir_uuid_fullpath = $targetDir . "/" . $resultProductFile['uuid'];
            $uploadRealName = $targetDir . $resultProductFile['file_name'];
            
            // 파일 삭제
            if ( is_file($uploadRealName) ){
                unlink($uploadRealName);
            }
            
            // 폴더 삭제
            rmdir($upload_dir_uuid_fullpath);   // 임시 삭제
            
            $result = $this->product_service->deleteFindUUIDProductFile($productFileVO);
            
            if ($result === 1){
                echo "<script>";
                echo "alert ('성공적으로 삭제하였습니다.');";
                echo "location.replace('../portal/product?func=modify&id=" . $productFileVO->getProduct_id() . "');";
                echo "</script>";
                exit;
            }
            
        }
        
        else if ($status === -1){
            
            echo "<script>";
            echo "alert ('DB에 파일 정보가 존재하지 않습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else{
            
            echo "<script>";
            echo "alert ('비정상적인 접근입니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
            
        }
        
    }

    public function product_delete_ok($productVO){

        $this->loadService();
        $targetDir = $this->getRootDir();

        // 박스 - 제품ID 할당
        $boxSpecVO = new ProductBoxSpecVO();
        $boxSpecVO->setProduct_id($productVO->getProduct_id());
        
        $status = 1;

        // 제품 ID값 존재 여부
        if ( ( $productVO->getProduct_id() !== -1 || 
                $productVO->getProduct_id() !== -2 ) && 
            $status === 1){
            $status = 1;
        }else if ( $productVO->getProduct_id() === -1 && 
                    $status === 1){
            $status = -1;
        }else if ( $productVO->getProduct_id() === -2 && 
                    $status === 1){
            $status = -2;
        }

        
        // 하위 데이터 존재 여부
        if ($status === 1){

            $result_product = $this->product_service->selectFindIDProduct($productVO);

            // 제품 존재 유무
            if ( !isset($result_product) && 
                $status === 1 ){
                $status = -3;
            }

            // 해당 제품의 창고 내 존재 여부 찾기
            $result_warehouse = $this->warehouse_service->selectWarehouseFindProductId($productVO);

            if ( isset($result_warehouse) && 
                $status === 1 ){
                $status = -4;
            }

        }

        // 하위 데이터가 존재하지 않을 때
        if ($status === 1){
            
            $result_uuid = $this->product_service->selectFindIDProductFile($productVO);

            // 1단계: 파일 삭제 프로세스 
            foreach($result_uuid as $resultProductFile){

                $productFileVO = new ProductFileVO();
                $productFileVO->setUuid($resultProductFile['uuid']);

                // echo $resultProjectFile['uuid'] . "<br>";                
                $targetDir = $targetDir . $resultProductFile['upload_dir'];
                $upload_dir_uuid_fullpath = $targetDir . "/" . $resultProductFile['uuid'];
                $uploadRealName = $targetDir . $resultProductFile['file_name'];

                // 파일 삭제
                if ( is_file($uploadRealName) ){
                    unlink($uploadRealName);
                }

                // 폴더 삭제
                rmdir($upload_dir_uuid_fullpath);   // 임시 삭제
                
                $result = $this->product_service->deleteFindUUIDProductFile($productFileVO);

            }
            
            // 2단계: DB - 제품 삭제
            $this->product_service->deleteProduct($productVO);

            // 3단계: DB - 박스 삭제
            $this->product_service->deleteProductBoxSpec($boxSpecVO);

            echo "<script>";
            echo "alert ('성공적으로 삭제하였습니다.');";
            echo "location.replace('../portal/product?func=list');";
            echo "</script>";
            exit;

        }
        else if ($status === -1){

            echo "<script>";
            echo "alert ('올바른 제품 값을 입력하세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -2){

            echo "<script>";
            echo "alert ('제품 값이 유효하지 않습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -3){

            echo "<script>";
            echo "alert ('제품이 존재하지 않습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -4){

            echo "<script>";
            echo "alert ('창고 내 유효한 제품이 존재합니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else{

            echo "<script>";
            echo "alert ('비정상적인 접근입니다.');";
            echo "history.back();";
            echo "</script>";
            exit;

        }

    }

    public function product_box_spec($boxSpecVO){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        // 1단계 - 박스 유형 생성
        $this->basic_setup_boxtype();
        
        $resultBoxSpecVO = $this->product_service->selectProductBoxSpecFindProductId($boxSpecVO);
        

        if ( isset($resultBoxSpecVO) ){

            $resultBoxTypeItem = $this->box_service->selectBoxType();

            $smarty->assign("box_type_item", $resultBoxTypeItem);
            $smarty->assign("box_item", $resultBoxSpecVO);

            $smarty->assign("MAX_FILE_SIZE", $this->getUploadSize());
            $smarty->assign("title", "프로젝트/상자 수정:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('product_modify_box_spec.tpl');

        }

        else if ( !isset($resultBoxSpecVO) ){
            
            echo "<script>";
            echo "alert('제품 정보가 존재하지 않습니다.');";
            echo "location.replace('../portal/product?func=list');";
            echo "</script>";
            exit;

        }

    }
    
    private function basic_setup_boxtype(){

        $this->loadService();
        $status = 1;

        $result = $this->box_service->selectCountAllBoxType();
        
        // 박스가 존재할 때
        if ( isset( $result ) && 
            $status === 1){
            $box_cnt = $result[0]['cnt'];

            if ( $box_cnt > 0 ){
                $status = 1;

            }else if ( $box_cnt === 0 ){
                
                $result = $this->box_service->alterAutoIncrement();

                $boxTypeVO = new BoxTypeVO();
                $boxTypeVO->setBox_type_id(1);
                $boxTypeVO->setType_name('해당없음');

                $result = $this->box_service->insertBoxType($boxTypeVO);

                $boxTypeVO->setBox_type_id(2);
                $boxTypeVO->setType_name('1호');

                $result = $this->box_service->insertBoxType($boxTypeVO);

                $boxTypeVO->setBox_type_id(3);
                $boxTypeVO->setType_name('2호');

                $result = $this->box_service->insertBoxType($boxTypeVO);

                $boxTypeVO->setBox_type_id(4);
                $boxTypeVO->setType_name('3호');

                $result = $this->box_service->insertBoxType($boxTypeVO);

                $boxTypeVO->setBox_type_id(5);
                $boxTypeVO->setType_name('5호');

                $result = $this->box_service->insertBoxType($boxTypeVO);

            }

        }
     
    }

    public function product_box_spec_modify_ok($boxSpecVO){

        $this->templateDir();
        $this->loadService();

        $status = 1;
        
        // 제품ID 입력 여부
        if ($boxSpecVO->getProduct_id() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ($boxSpecVO->getProduct_id() === -1 &&
            $status === 1) {
            $status = -1;
        }

        // 박스 유형 여부
        if ($boxSpecVO->getBox_type_id() !== -1 &&
            $status === 1 ){
            $status = 1;
        }else if ($boxSpecVO->getBox_type_id() === -1 &&
            $status === 1 ){
            $status = -2;
        }

        // 가로 입력 여부
        if ($boxSpecVO->getWidth() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ($boxSpecVO->getWidth() === -1 &&
            $status === 1) {
            $status = -3;
        }

        // 세로 입력 여부
        if ($boxSpecVO->getLength() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ($boxSpecVO->getLength() === -1 &&
            $status === 1) {
            $status = -4;
        }

        // 높이 입력 여부
        if ($boxSpecVO->getHeight() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ($boxSpecVO->getHeight() === -1 &&
            $status === 1) {
            $status = -5;
        }

        // 상자 이름 입력 여부
        if ( ( $boxSpecVO->getBox_name() !== -1 && 
               $boxSpecVO->getBox_name() !== -2 ) &&
            $status === 1){
            $status = 1;
        }else if ($boxSpecVO->getBox_name() === -1 &&
            $status === 1) {
            $status = -6;
        }else if ($boxSpecVO->getBox_name() === -2 &&
            $status === 1) {
            $status = -7;
        }

        //echo $status . "/" . $boxSpecVO->getBox_name() . "<br>";

        if ( $status === 1 ){
            $result = $this->product_service->updateProductBoxSpec($boxSpecVO);    
        }
        
        switch($status){

            // 프로젝트 등록이 성공일 때
            case 1:

                echo "<script>";
                echo "alert ('성공적으로 수정되었습니다.');";
                echo "location.replace('../portal/product?func=list');";
                echo "</script>";
                exit;

                break;

            case -1:

                echo "<script>";
                echo "alert('제품 ID를 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -2:

                echo "<script>";
                echo "alert('박스 유형을 선택하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -3:

                echo "<script>";
                echo "alert('가로를 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;
                
                break;
            
            case -4:

                echo "<script>";
                echo "alert('세로를 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;
                
                break;

            case -5:

                echo "<script>";
                echo "alert('높이를 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -6:

                echo "<script>";
                echo "alert('상자명 길이가 짧습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -7:

                echo "<script>";
                echo "alert('상자명을 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;
    
            default:

                echo "<script>";
                echo "alert('제품 수정에 실패하였습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

        }

    }
    
}

?>