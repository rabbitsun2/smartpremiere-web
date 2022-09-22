<?php
/*
 * Created Date: 2022-06-10 (Fri)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Controller
 * Filename: LogisticsController.php
 * Description:
 * - 1. 서비스 추가(품목 코드 찾기), 정도윤(Doyun Jung), 2022-06-12(Sun)
 * - 2. 검색(키워드) 반영, 정도윤, 2022-06-27(Mon)
 */

class LogisticsController extends Controller {

    
    private $product_service;
    private $warehouse_service;

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
        
        $this->product_service = new ProductServiceImpl();
        $this->warehouse_service = new WarehouseServiceImpl();
        
        $my_conn = $this->getConn();
        $this->product_service->setConn($my_conn);
        $this->warehouse_service->setConn($my_conn);

        //print_r($this->warehouse_service);

    }
    
    public function input(){
        
        $this->templateDir();
        $smarty = $this->getSmarty();
        $smarty->clearAllCache();
        
        $smarty->assign("title", "물류/입고:::Smart Premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('logistics_input_page.tpl');
        
    }

    public function input_search(){

        $this->templateDir();
        $smarty = $this->getSmarty();
        $smarty->clearAllCache();
        
        $smarty->assign("title", "제품 검색:::Smart Premiere");
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->display('logistics_input_search.tpl');

    }

    public function input_search_result($pageCri, $keyword){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $productVO = new ProductVO();
        $productVO->setProduct_name($keyword);
        
        $paging = new Paging();

        $result = $this->product_service->selectAllProductCountFind($productVO);
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

        $productList = $this->product_service->selectPagingProductFind($startnum, $endnum, $productVO);
        //echo $keyword;
        //print_r($productList);

        $var_fn = "&func=input&search=product&keyword=" . $keyword;

        $smarty->assign("title", "제품 검색결과 - " . $keyword . ":::Smart Premiere");
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("productList", $productList);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);
        $smarty->display('logistics_input_search_result.tpl');

    }

    public function input_submit_ok($warehouseVO){

        $result = 0;
        $status_rand_id = true;
        $rand_id = -1;

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        //print_r($warehouseVO);

        //$result = $this->warehouse_service->insertGoods($warehouseVO);

        
        //echo "3번:" . $warehouseVO->getProduct_no() . "/" . $warehouseVO->getProduct_cnt() . "<br>";

        // 품목코드와 수량이 존재할 때
        if ( $warehouseVO->getProduct_id() !== -1 &&
            $warehouseVO->getProduct_cnt() !== -1 ){

            $result = $this->warehouse_service->insertWarehouse($warehouseVO);

            // 생산품 등록이 정상적으로 수행되었을 때
            if ( $result === 1){

                $tmpWarehouseRow = $this->warehouse_service->selectWarehouse($warehouseVO);

                //print_r($tmpWarehouseRow);

                $tmpWarehouseLogVO = new WarehouseLogVO();
                $tmpWarehouseBarcodeVO = new WarehouseBarcodeVO();
                
                //echo "/" . $tmpWarehouseRow[0]["id"] . "/" . isset($tmpWarehouseRow) . "<br>"; 

                if ( isset($tmpWarehouseRow)){

                    // 바코드 생성
                    $tmpWarehouseBarcodeVO->setId( $tmpWarehouseRow[0]["id"] );

                    while($status_rand_id){

                        $rand_id = RandUtil::createBarcode();
                        $tmpWarehouseBarcodeVO->setRand_id($rand_id);
    
                        $resultRandId = $this->warehouse_service->selectWarehouseBarcodeFindRandId($tmpWarehouseBarcodeVO);
    
                        if ( !isset( $resultRandId ) ){
    
                            $tmpWarehouseBarcodeVO->setRegidate( $warehouseVO->getCreate_date() );
                            $tmpWarehouseBarcodeVO->setIp( $warehouseVO->getIp() );    

                            // 바코드 등록처리
                            $this->warehouse_service->insertWarehouseBarcode( $tmpWarehouseBarcodeVO );
                            $status_rand_id = false;
    
                        }
    
                    }
                    
                    // 초기 출고 기록 생성
                    $tmpWarehouseLogVO->setW_id($tmpWarehouseRow[0]["id"]);
                    $tmpWarehouseLogVO->setPrev_w_id($tmpWarehouseRow[0]["id"]);
                    $tmpWarehouseLogVO->setPrev_cnt($tmpWarehouseRow[0]["product_cnt"]);
                    $tmpWarehouseLogVO->setRelease_cnt(0);
                    
                    $tmpWarehouseLogVO->setCurrent_cnt($tmpWarehouseRow[0]["product_cnt"]);
                    $tmpWarehouseLogVO->setCurrent_type("신규");
                    $tmpWarehouseLogVO->setRelease_type("해당없음");
                    $tmpWarehouseLogVO->setRelease_date($tmpWarehouseRow[0]["create_date"]);
                    $tmpWarehouseLogVO->setIp($tmpWarehouseRow[0]["ip"]);

                    // 초기 출고 기록 등록
                    $result = $this->warehouse_service->insertWarehouseLog($tmpWarehouseLogVO);
                    //print_r($tmpWarehouseLogVO);

                }

            }

        }else{
            echo "<script>";
            echo "alert ('내용을 입력해주세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }


        // 성공적으로 로그기록까지 등록했을 때 처리
        if ( $result === 1 ){

            echo "<script>";
            echo "alert ('성공적으로 등록되었습니다.');";
            echo "location.replace('../portal/main');";
            echo "</script>";
            exit;
        }
        
    }
    
    public function output($pageCri){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();
        
        // 바코드 토큰 생성
        if (empty($_SESSION['barcode_token'])) {
            $_SESSION['barcode_token'] = bin2hex(random_bytes(32));
        }

        $barcode_token = $_SESSION['barcode_token'];

        $paging = new Paging();

        $result = $this->warehouse_service->selectAllWarehouseLogViewCount();
        $total_cnt = $result['cnt'];

        //print_r($paging);

        // echo $total_cnt . "/";
        //print_r($result);

        
        $page_no = $pageCri->getPage();
        $page_size = $pageCri->getPerPageNum();

        $paging->setPageNo($page_no);
        $paging->setPageSize($page_size);
        $paging->setTotalCount($total_cnt);

        $pagingObj = $paging->getObject();
        
        //print_r($pagingObj);
        
        $startnum = $paging->getDbStartNum();
        $endnum = $paging->getDbEndNum();

        $warehouseLogRows = $this->warehouse_service->selectPagingWarehouseLogView($startnum, $endnum);

        //print_r($warehouseLogRows);

        
        $var_fn = "&func=output";

        $smarty->assign("barcode_token", $barcode_token);
        $smarty->assign("warehouseLogList", $warehouseLogRows);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);
        $smarty->assign("title", "물류/출고:::Smart Premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('logistics_output_list_page.tpl');
        
        
    }

    public function output_search_result($pageCri, $keyword){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();
        
        // 바코드 토큰 생성
        if (empty($_SESSION['barcode_token'])) {
            $_SESSION['barcode_token'] = bin2hex(random_bytes(32));
        }

        $barcode_token = $_SESSION['barcode_token'];

        $paging = new Paging();

        $result = $this->warehouse_service->selectAllWarehouseLogViewKeywordCount($keyword);
        $total_cnt = $result['cnt'];

        //print_r($paging);

        // echo $total_cnt . "/";
        //print_r($result);

        
        $page_no = $pageCri->getPage();
        $page_size = $pageCri->getPerPageNum();

        $paging->setPageNo($page_no);
        $paging->setPageSize($page_size);
        $paging->setTotalCount($total_cnt);

        $pagingObj = $paging->getObject();
        
        //print_r($pagingObj);
        
        $startnum = $paging->getDbStartNum();
        $endnum = $paging->getDbEndNum();

        $warehouseLogRows = $this->warehouse_service->selectPagingWarehouseLogKeywordView($startnum, $endnum, $keyword);

        //print_r($warehouseLogRows);

        
        $var_fn = "&func=output&keyword=" . $keyword;

        $smarty->assign("barcode_token", $barcode_token);
        $smarty->assign("warehouseLogList", $warehouseLogRows);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);
        $smarty->assign("title", "물류/출고:::Smart Premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('logistics_output_list_page.tpl');
        
        
    }
    
    public function output_release(){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $warehouseLogVo = new WarehouseLogVO();
        $warehouseLogVo->setId($_GET['id']);

        $warehouse_rows = $this->warehouse_service->selectOneWarehouseLog($warehouseLogVo);
        
        $title = "물류/출고 - " . $warehouse_rows[0]["w_id"] .  
                "(" . $warehouse_rows[0]["product_name"] . "):::Smart Premiere";

        $smarty->assign("warehouse_rows", $warehouse_rows);
        $smarty->assign("title", $title);
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('logistics_output_release.tpl');

    }

    public function output_w_ok($warehouseLogVo){
        
        $this->loadService();

        $prev_log_id = $_POST["w_log_id"];

        //echo "참1<br>";

        $prev_warehouseLogVo = new WarehouseLogVO();
        $prev_warehouseLogVo->setId($prev_log_id);
        $prev_warehouseLogVo->setCurrent_type("과거");
        $prev_warehouseLogVo->setRelease_type("해당없음");

        //echo "참2<br>";
        //print_r($this->warehouse_service);

        $result = $this->warehouse_service->updateBeforeWarehouseLog($prev_warehouseLogVo);
        //$this->warehouse_service->updateBeforeWarehouseLog($prevWarehouseLogVo);
        //echo "참8 / " . $result . "<br>";

        //echo $_POST['w_log_id'] . "/<br>";
        //print_r($warehouseLogVo);

        //$result_insert = $this->warehouse_service->insertWarehouseLog($warehouseLogVo);

        // 창고 재고 추가
        if ( $result === 1){
            $result = $this->warehouse_service->insertWarehouseLog($warehouseLogVo);
            
        }
        
        // 성공적으로 출하등록이 되었을 때
        if ( $result === 1){
            
            echo "<script>";
            echo "alert ('성공적으로 등록되었습니다.');";
            echo "location.replace('../portal/logistics?func=output');";
            echo "</script>";
            exit;

        }

    }

    public function barcode_individual_print( $warehouseBarcodeVO ){
        
        $w_barcode_rows;
        $w_barcode_print_log_rows;
        $status = 1;

        $dt = new DateTime('NOW');
        $dt = $dt->format('Y-m-d H:i:s');

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        // ID값이 유효할 때
        if ( $warehouseBarcodeVO->getId() !== -1 && 
            $status === 1 ){
            $status = 1;
        }
        else if ( $warehouseBarcodeVO->getId() === -1 && 
            $status === 1){
            $status = -1;
        }

        // 해쉬 일치 여부(CSRF 토큰)
        if (!empty($_GET['barcodeKey']) && $status === 1) {
            if (hash_equals($_SESSION['barcode_token'], $_GET['barcodeKey'])) {
                 $status = 1;
            } else {
                 // Log this as a warning and keep an eye on these attempts
                 $status = -2;
            }
        }

        // Warehouse 바코드 찾기
        if ($status === 1){

            $warehouseVO = new WarehouseVO();
            $warehouseVO->setId( $warehouseBarcodeVO->getId() );

            $w_barcode_rows = $this->warehouse_service->selectWarehouseFindId($warehouseVO);

            //print_r($w_barcode_rows);

            if ( isset ($w_barcode_rows ) && 
                $status === 1 ){
                $status = 1;

            }
            else if ( !isset ( $w_barcode_rows ) && 
                $status === 1 ){
                $status = -3;
            }

        }

        // Warehouse 바코드 출력 기록 찾기
        if ($status === 1){

            $warehouseBarcodePrintLogVO = new WarehouseBarcodePrintLogVO();
            $warehouseBarcodePrintLogVO->setId( $warehouseBarcodeVO->getId() );

            $w_barcode_print_rows = $this->warehouse_service->selectWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO);

            //print_r($w_barcode_rows);

            if ( !isset ($w_barcode_print_rows ) && 
                $status === 1 ){
                $status = 1;

            }
            else if ( isset ( $w_barcode_print_rows ) && 
                $status === 1 ){
                $status = -4;
            }

        }

        // Warehouse 바코드 출력 기록이 존재하지 않을 때
        if ($status === 1){

            $warehouseBarcodePrintLogVO = new WarehouseBarcodePrintLogVO();
            $warehouseBarcodePrintLogVO->setId( $warehouseBarcodeVO->getId() );
            $warehouseBarcodePrintLogVO->setMember_id( $_SESSION['member_id'] );
            $warehouseBarcodePrintLogVO->setRelease_cnt( $w_barcode_rows[0]["product_cnt"] );
            $warehouseBarcodePrintLogVO->setRelease_type( "최근" );
            $warehouseBarcodePrintLogVO->setPrint_type( "개별" );
            $warehouseBarcodePrintLogVO->setRegidate($dt);
            $warehouseBarcodePrintLogVO->setIp( Network::get_client_ip() );

            // 로그 기록 처리
            $result = $this->warehouse_service->insertWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO);

        }

        // Warehouse 바코드 출력 기록 재생성 토큰 비교
        if ($status === -4 ){

            // 바코드 출력 재생성 토큰이 존재할 때
            if ( isset ( $_SESSION['refresh_barcode_token'] ) && 
                isset ( $_GET['refreshKey'] ) && 
                strcmp($_GET['refreshKey'], $_SESSION['refresh_barcode_token']) === 0 ){

                $warehouseBarcodePrintLogVO = new WarehouseBarcodePrintLogVO();
                $warehouseBarcodePrintLogVO->setId( $warehouseBarcodeVO->getId() );
                $warehouseBarcodePrintLogVO->setRelease_type( "최근" );

                // 최근 바코드 출력 기록 가져오기
                $result_row = $this->warehouse_service->selectWarehouseBarcodePrintLogLatestFindId($warehouseBarcodePrintLogVO);

                $warehouseBarcodePrintLogVO->setMember_id( $result_row[0]["member_id"] );
                $warehouseBarcodePrintLogVO->setRelease_type( "과거" );
                $warehouseBarcodePrintLogVO->setRegidate( $result_row[0]["regidate"] );

                // 최근 바코드 출력 기록 -> 과거 바코드 출력 기록으로 전환
                $result = $this->warehouse_service->updateWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO);

                $warehouseBarcodePrintLogVO->setMember_id( $_SESSION['member_id'] );
                $warehouseBarcodePrintLogVO->setRelease_cnt( $result_row[0]["release_cnt"] );
                $warehouseBarcodePrintLogVO->setRelease_type( "최근" );
                $warehouseBarcodePrintLogVO->setPrint_type( "개별" );
                $warehouseBarcodePrintLogVO->setRegidate($dt);
                $warehouseBarcodePrintLogVO->setIp( Network::get_client_ip() );

                // 로그 기록 처리
                $result = $this->warehouse_service->insertWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO);

                $status = 1;

                // 이전 세션 랜덤으로 접근 차단
                $_SESSION['refresh_barcode_token'] = md5(uniqid(mt_rand(), true));

            }
            // 바코드 출력 재생성 토큰이 존재할 때
            else if ( isset ( $_SESSION['refresh_barcode_token'] ) && 
                    isset ( $_GET['refreshKey'] ) && 
                    strcmp($_GET['refreshKey'], $_SESSION['refresh_barcode_token']) !== 0 ){
                $status = -5;
            }
    
        }

        // 출력 - 바코드
        if ($status === 1){
            
            $w_i_count = 1;     // 개별 수량

            $title = "물류/출고 - " . $w_barcode_rows[0]["w_id"] .  
            "(" . $w_barcode_rows[0]["product_name"] . "):::Smart Premiere";
                
            $w_rand_id = $w_barcode_rows[0]["rand_id"];

            // 바코드 생성
            $barcode1 = "$('.bcTarget1').barcode('$w_rand_id', 'code128');";
            $barcode2 = "$('.bcTarget2').barcode('$w_rand_id', 'ean13',{barWidth:2, barHeight:30});";
            $barcode3 = "$('.bcTarget3').barcode('$w_rand_id', 'int25',{barWidth:2, barHeight:30});";
            $barcode4 = "$('.bcTarget4').barcode('$w_rand_id', 'code128',{barWidth:1, barHeight:70,showHRI:true,bgColor:'red'});";
            $barcode5 = "$('.bcTarget5').barcode('$w_rand_id', 'datamatrix',{showHRI:false,bgColor:'white'});";

            $smarty->assign("barcode1", $barcode1);
            $smarty->assign("barcode2", $barcode2);
            $smarty->assign("barcode3", $barcode3);
            $smarty->assign("barcode4", $barcode4);
            $smarty->assign("barcode5", $barcode5);

            $smarty->assign("w_id", $w_barcode_rows[0]["w_id"]);
            $smarty->assign("w_product_id", $w_barcode_rows[0]["product_id"]);
            $smarty->assign("w_product_name", $w_barcode_rows[0]["product_name"]);
            $smarty->assign("w_rand_id", $w_barcode_rows[0]["rand_id"]);
            $smarty->assign("w_count", $w_barcode_rows[0]["product_cnt"]);
            $smarty->assign("w_create_date", $w_barcode_rows[0]["create_date"]);
            $smarty->assign("w_ip", $w_barcode_rows[0]["ip"]);
            $smarty->assign("w_i_count", $w_i_count);

            $smarty->assign("title", $title);
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('logistics_output_barcode_view.tpl');

        }else if ($status === -1){

            echo "<script>";
            echo "alert ('유효하지 않는 ID값입니다.');";
            echo "location.replace('../portal/logistics?func=output');";
            echo "</script>";
            exit;

        }else if ($status === -2){

            echo "<script>";
            echo "alert ('유효하지 않는 토큰 값입니다.');";
            echo "location.replace('../portal/logistics?func=output');";
            echo "</script>";
            exit;

        }else if ($status === -3){

            echo "<script>";
            echo "alert ('존재하지 않는 ID값입니다.');";
            echo "location.replace('../portal/logistics?func=output');";
            echo "</script>";
            exit;

        }else if ($status === -4){
            
            // 바코드 재생성 토큰
            $barcode_token = $_GET['barcodeKey'];
            $_SESSION['refresh_barcode_token'] = md5(uniqid(mt_rand(), true));
            $refreshKey = $_SESSION['refresh_barcode_token'];

            $locationUrl = "../portal/logistics?func=barcode&option=print&id=" . $warehouseBarcodeVO->getId() . 
                   "&barcodeKey=" . $barcode_token . "&refreshKey=" . $refreshKey;

            echo "<script>";
            echo "let alertConfirm = confirm('이미 바코드를 출력하였습니다.\\n추가로 출력하시겠습니까?');";
            echo "if( alertConfirm ){ ";
            echo "  location.replace('" . $locationUrl . "');";
            echo "}else{";
            echo "  location.replace('../portal/logistics?func=output');";
            echo "}";
            echo "</script>";
            exit;
            
        }else if ($status === -5){

            echo "<script>";
            echo "alert ('유효하지 않는 토큰 키(Key)입니다.');";
            echo "location.replace('../portal/logistics?func=output');";
            echo "</script>";
            exit;

        }else{

            echo "<script>";
            echo "alert ('비정상적인 접근입니다.');";
            echo "location.replace('../portal/logistics?func=output');";
            echo "</script>";
            exit;

        }

    }

    public function barcode_cart_print(){

        $w_barcode_rows;
        $w_barcode_print_log_rows;

        $barcode1 = "";
        $barcode2 = "";
        $barcode3 = "";
        $barcode4 = "";
        $barcode5 = "";

        $status = 1;

        $dt = new DateTime('NOW');
        $dt = $dt->format('Y-m-d H:i:s');

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $warehouseBarcodeBagVO = new WarehouseBarcodeBagVO();
        $warehouseBarcodeBagVO->setMember_id( $_SESSION['member_id'] );

        // 해쉬 일치 여부(CSRF 토큰)
        if (!empty($_GET['barcodeKey']) && $status === 1) {
            if (hash_equals($_SESSION['barcode_token'], $_GET['barcodeKey'])) {
                 $status = 1;
            } else {
                 // Log this as a warning and keep an eye on these attempts
                 $status = -1;
            }
        }

        // Warehouse 바코드 찾기
        if ($status === 1){

            $w_barcode_rows = $this->warehouse_service->selectWarehouseBarcodeBagListFindMemberId( $warehouseBarcodeBagVO );

            //print_r($w_barcode_rows);

            if ( isset ($w_barcode_rows ) && 
                $status === 1 ){
                $status = 1;

            }
            else if ( !isset ( $w_barcode_rows ) && 
                $status === 1 ){
                $status = -2;
            }

        }

        foreach($w_barcode_rows as $row){
            
            // Warehouse 바코드 출력 기록 찾기
            if ($status === 1){

                $warehouseBarcodePrintLogVO = new WarehouseBarcodePrintLogVO();
                $warehouseBarcodePrintLogVO->setId( $row['id'] );

                $w_barcode_print_rows = $this->warehouse_service->selectWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO);

                //print_r($w_barcode_rows);

                if ( !isset ($w_barcode_print_rows ) && 
                    $status === 1 ){
                    $status = 1;

                }
                else if ( isset ( $w_barcode_print_rows ) && 
                    $status === 1 ){
                    $status = -3;
                }
                
                // 바코드 생성
                $barcode1 = $barcode1 . "$('.bcTarget" . $row['id'] . "_1').barcode('" . $row['rand_id'] . "', 'code128');\n";
                $barcode2 = $barcode2 . "$('.bcTarget" . $row['id'] . "_2').barcode('" . $row['rand_id'] . "', 'ean13',{barWidth:2, barHeight:30});\n";
                $barcode3 = $barcode3 . "$('.bcTarget" . $row['id'] . "_3').barcode('" . $row['rand_id'] . "', 'int25',{barWidth:2, barHeight:30});\n";
                $barcode4 = $barcode4 . "$('.bcTarget" . $row['id'] . "_4').barcode('" . $row['rand_id'] . "', 'code128',{barWidth:1, barHeight:70,showHRI:true,bgColor:'red'});\n";
                $barcode5 = $barcode5 . "$('.bcTarget" . $row['id'] . "_5').barcode('" . $row['rand_id'] . "', 'datamatrix',{showHRI:false,bgColor:'white'});\n";

            }

            // Warehouse 바코드 출력 기록이 존재하지 않을 때
            if ($status === 1){

                $warehouseBarcodePrintLogVO = new WarehouseBarcodePrintLogVO();
                $warehouseBarcodePrintLogVO->setId( $row['id'] );
                $warehouseBarcodePrintLogVO->setMember_id( $_SESSION['member_id'] );
                $warehouseBarcodePrintLogVO->setRelease_cnt( $row['current_cnt'] );
                $warehouseBarcodePrintLogVO->setRelease_type( "최근" );
                $warehouseBarcodePrintLogVO->setPrint_type( "장바구니" );
                $warehouseBarcodePrintLogVO->setRegidate($dt);
                $warehouseBarcodePrintLogVO->setIp( Network::get_client_ip() );

                // 로그 기록 처리
                $result = $this->warehouse_service->insertWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO);

            }

            // Warehouse 바코드 출력 기록 재생성 토큰 비교
            if ($status === -3 ){

                // 바코드 출력 재생성 토큰이 존재할 때
                if ( isset ( $_SESSION['refresh_barcode_token'] ) && 
                    isset ( $_GET['refreshKey'] ) && 
                    strcmp($_GET['refreshKey'], $_SESSION['refresh_barcode_token']) === 0 ){

                    $warehouseBarcodePrintLogVO = new WarehouseBarcodePrintLogVO();
                    $warehouseBarcodePrintLogVO->setId( $row['id'] );
                    $warehouseBarcodePrintLogVO->setRelease_type( "최근" );

                    // 최근 바코드 출력 기록 가져오기
                    $result_row = $this->warehouse_service->selectWarehouseBarcodePrintLogLatestFindId($warehouseBarcodePrintLogVO);

                    $warehouseBarcodePrintLogVO->setMember_id( $row["member_id"] );
                    $warehouseBarcodePrintLogVO->setRelease_type( "과거" );
                    $warehouseBarcodePrintLogVO->setRegidate( $row["regidate"] );

                    // 최근 바코드 출력 기록 -> 과거 바코드 출력 기록으로 전환
                    $result = $this->warehouse_service->updateWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO);

                    $warehouseBarcodePrintLogVO->setMember_id( $_SESSION['member_id'] );
                    $warehouseBarcodePrintLogVO->setRelease_cnt( $row["current_cnt"] );
                    $warehouseBarcodePrintLogVO->setRelease_type( "최근" );
                    $warehouseBarcodePrintLogVO->setPrint_type( "장바구니" );
                    $warehouseBarcodePrintLogVO->setRegidate($dt);
                    $warehouseBarcodePrintLogVO->setIp( Network::get_client_ip() );

                    // 로그 기록 처리
                    $result = $this->warehouse_service->insertWarehouseBarcodePrintLog($warehouseBarcodePrintLogVO);

                    	
                    


                    $status = 1;

                }
                // 바코드 출력 재생성 토큰이 존재할 때
                else if ( isset ( $_SESSION['refresh_barcode_token'] ) && 
                        isset ( $_GET['refreshKey'] ) && 
                        strcmp($_GET['refreshKey'], $_SESSION['refresh_barcode_token']) !== 0 ){
                    $status = -4;
                }
        
            }

        }

        // 출력 - 바코드
        if ($status === 1){
            
            // 이전 세션 랜덤으로 접근 차단
            $_SESSION['refresh_barcode_token'] = md5(uniqid(mt_rand(), true));

            $title = "물류/출고 - :::Smart Premiere";

            $smarty->assign("barcode1", $barcode1);
            $smarty->assign("barcode2", $barcode2);
            $smarty->assign("barcode3", $barcode3);
            $smarty->assign("barcode4", $barcode4);
            $smarty->assign("barcode5", $barcode5);
            
            $smarty->assign("w_item", $w_barcode_rows);
            $smarty->assign("title", $title);
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('logistics_output_barcode_bag_view.tpl');

        }else if ($status === -1){

            echo "<script>";
            echo "alert ('유효하지 않는 토큰 값입니다.');";
            echo "location.replace('../portal/logistics?func=output');";
            echo "</script>";
            exit;

        }else if ($status === -2){

            echo "<script>";
            echo "alert ('존재하지 않는 ID값입니다.');";
            echo "location.replace('../portal/logistics?func=output');";
            echo "</script>";
            exit;

        }else if ($status === -3){
            
            // 바코드 재생성 토큰
            $barcode_token = $_GET['barcodeKey'];
            $_SESSION['refresh_barcode_token'] = md5(uniqid(mt_rand(), true));
            $refreshKey = $_SESSION['refresh_barcode_token'];

            $locationUrl = "../portal/logistics?func=barcode&option=print" . 
                   "&barcodeKey=" . $barcode_token . "&refreshKey=" . $refreshKey;

            echo "<script>";
            echo "let alertConfirm = confirm('이미 바코드를 출력하였습니다.\\n추가로 출력하시겠습니까?');";
            echo "if( alertConfirm ){ ";
            echo "  location.replace('" . $locationUrl . "');";
            echo "}else{";
            echo "  location.replace('../portal/logistics?func=output');";
            echo "}";
            echo "</script>";
            exit;
            
        }else if ($status === -4){

            echo "<script>";
            echo "alert ('유효하지 않는 토큰 키(Key)입니다.');";
            echo "location.replace('../portal/logistics?func=output');";
            echo "</script>";
            exit;

        }else{

            echo "<script>";
            echo "alert ('비정상적인 접근입니다.');";
            echo "location.replace('../portal/logistics?func=output');";
            echo "</script>";
            exit;

        }

    }

    public function cart_add( $warehouseBarcodeBagVO ){

        $result_rows;
        $status = 1;

        $dt = new DateTime('NOW');
        $dt = $dt->format('Y-m-d H:i:s');

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        // Id값이 유효할 때
        if ( ( $warehouseBarcodeBagVO->getId() !== -1 || 
             $warehouseBarcodeBagVO->getId() !== -2 ) && 
             $status === 1){
            $status = 1;
        }else if ( $warehouseBarcodeBagVO->getId() === -1 && 
            $status === 1){
            $status = -1;
        }else if ( $warehouseBarcodeBagVO->getId() === -2 && 
            $status === 1){
            $status = -2;
        }

        // ID값의 존재 여부
        if ($status === 1){

            $result_rows = $this->warehouse_service->selectWarehouseBarcodeBagFindId( $warehouseBarcodeBagVO );

            // Bag이 존재할 때
            if ( isset( $result_rows ) ){
                $status = -3;
            }

        }

        // 장바구니 등록하기
        if ($status === 1){

            $warehouseBarcodeBagVO->setMember_id($_SESSION['member_id']);
            $warehouseBarcodeBagVO->setRegidate($dt);
            $warehouseBarcodeBagVO->setIp( Network::get_client_ip() );

            // 데이터 등록하기
            $result = $this->warehouse_service->insertWarehouseBarcodeBag($warehouseBarcodeBagVO);

            $message = "정상적으로 등록이 되었습니다.";

            $smarty->assign("message", $message);
            $smarty->assign("title", "창고/제품 담기:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('cart_add_page.tpl');

        } else if ( $status === -1 ){

            echo "<script>";
            echo "alert ('아이디(id)값이 숫자가 아닙니다.');";
            echo "window.close();";
            echo "</script>";
            exit;

        } else if ( $status === -2 ){

            echo "<script>";
            echo "alert ('아이디(id)값을 입력하세요.');";
            echo "window.close();";
            echo "</script>";
            exit;

        } else if ( $status === -3 ){

            echo "<script>";
            echo "alert ('이미 장바구니에 담겨져 있습니다.');";
            echo "window.close();";
            echo "</script>";
            exit;

        }else{

            echo "<script>";
            echo "alert ('잘못된 접근입니다.');";
            echo "window.close();";
            echo "</script>";
            exit;

        }

    }

    public function cart_list(){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();
        
        // 바코드 토큰 생성
        if (empty($_SESSION['barcode_token'])) {
            $_SESSION['barcode_token'] = bin2hex(random_bytes(32));
        }

        $warehouseBarcodeBagVO = new WarehouseBarcodeBagVO();
        $warehouseBarcodeBagVO->setMember_id( $_SESSION['member_id'] );

        $barcode_token = $_SESSION['barcode_token'];
        $result_rows = $this->warehouse_service->selectWarehouseBarcodeBagListFindMemberId( $warehouseBarcodeBagVO );

        //print_r($warehouseLogRows);

        
        $var_fn = "&func=output";

        $smarty->assign("barcode_token", $barcode_token);
        $smarty->assign("result_rows", $result_rows);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);

        $smarty->assign("title", "물류/출고 - 바코드 장바구니:::Smart Premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('logistics_output_barcode_bag_list.tpl');

    }

    public function cart_remove( $warehouseBarcodeBagVO ){
        
        $result_rows;
        $status = 1;

        $dt = new DateTime('NOW');
        $dt = $dt->format('Y-m-d H:i:s');

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        // Id값이 유효할 때
        if ( ( $warehouseBarcodeBagVO->getId() !== -1 || 
             $warehouseBarcodeBagVO->getId() !== -2 ) && 
             $status === 1){
            $status = 1;
        }else if ( $warehouseBarcodeBagVO->getId() === -1 && 
            $status === 1){
            $status = -1;
        }else if ( $warehouseBarcodeBagVO->getId() === -2 && 
            $status === 1){
            $status = -2;
        }

        // ID값의 존재 여부
        if ($status === 1){

            $result_rows = $this->warehouse_service->selectWarehouseBarcodeBagFindId( $warehouseBarcodeBagVO );

            // Bag이 존재할 때
            if ( !isset( $result_rows ) ){
                $status = -3;
            }

        }

        // 장바구니 등록하기
        if ($status === 1){

            // 데이터 등록하기
            $result = $this->warehouse_service->deleteWarehouseBarcodeBag( $warehouseBarcodeBagVO );

            $message = "정상적으로 삭제 되었습니다.";

            $smarty->assign("message", $message);
            $smarty->assign("title", "물류/입고:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('cart_remove_page.tpl');

        } else if ( $status === -1 ){

            echo "<script>";
            echo "alert ('아이디(id)값이 숫자가 아닙니다.');";
            echo "window.close();";
            echo "</script>";
            exit;

        } else if ( $status === -2 ){

            echo "<script>";
            echo "alert ('아이디(id)값을 입력하세요.');";
            echo "window.close();";
            echo "</script>";
            exit;

        } else if ( $status === -3 ){

            echo "<script>";
            echo "alert ('장바구니에 담겨있지 않습니다.');";
            echo "window.close();";
            echo "</script>";
            exit;

        }else{

            echo "<script>";
            echo "alert ('잘못된 접근입니다.');";
            echo "window.close();";
            echo "</script>";
            exit;

        }

    }

    public function cart_all_remove(){

        
        $result_rows;
        $status = 1;

        $dt = new DateTime('NOW');
        $dt = $dt->format('Y-m-d H:i:s');

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $warehouseBarcodeBagVO = new WarehouseBarcodeBagVO();
        $warehouseBarcodeBagVO->setMember_id( $_SESSION['member_id'] );

        // ID값의 존재 여부
        if ($status === 1){

            $result_rows = $this->warehouse_service->selectWarehouseBarcodeBagCountFindMemberId( $warehouseBarcodeBagVO );

            // Bag이 존재할 때
            if ( is_numeric( $result_rows[0]['cnt'] ) && 
                $result_rows[0]['cnt'] === 0 ){
                $status = -1;
            }

        }

        // 장바구니 등록하기
        if ($status === 1){

            // 데이터 등록하기
            $result = $this->warehouse_service->deleteWarehouseBarcodeBagFindMemberId( $warehouseBarcodeBagVO );

            $message = "정상적으로 삭제 되었습니다.";

            $smarty->assign("message", $message);
            $smarty->assign("title", "물류/입고:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('cart_remove_page.tpl');

        } else if ( $status === -1 ){

            echo "<script>";
            echo "alert ('장바구니가 비어있습니다.');";
            echo "window.close();";
            echo "</script>";
            exit;

        }else{

            echo "<script>";
            echo "alert ('잘못된 접근입니다.');";
            echo "window.close();";
            echo "</script>";
            exit;

        }

    }

}

?>