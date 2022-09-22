<?php
/*
 * Created Date: 2022-06-06 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Controller
 * Filename: PortalController.php
 * Description:
 * 1. 제품 현황 페이지 추가 시작, 정도윤, 2022-06-16(Thu)
 * 2. 사용자 관리 페이지 추가 시작, 정도윤, 2022-06-19(Sun)
 * 3. 사용자 수정, 사용자 삭제 기능 추가, 정도윤, 2022-07-02(Sat)
 * 4. 프로젝트 목록 조회, 정도윤, 2022-07-02(Sat)
 * 5. 프로젝트 등록 기능 추가, 정도윤, 2022-07-03(Sun)
 * 6. 프로젝트 등록 기능(파일 첨부) 추가, 정도윤, 2022-07-03 (Sun)
 * 7. 제품 수정 기능 추가, 정도윤, 2022-07-14 (Thu)
 * 8. 프로젝트 공정 기능 추가, 정도윤, 2022-08-30 (Tue)
 * 9. DB용량 조회 기능 추가, 정도윤, 2022-08-31 (Wed)
 * 10. 게시판 기능 추가, 정도윤, 2022-09-02 (Fri)
 * 11. 게시판 최근 게시글 기능 추가, 정도윤, 2022-09-04 (Sun)
 * 
 */

class PortalController extends Controller {
    
    private $logisticsController;
    private $factoryController;
    private $productController;
    private $projectController;
    private $configController;
    private $machineController;
    private $boardController;

    private $board_service;
    private $member_service;
    private $product_service;
    private $warehouse_service;
    private $project_service;
    private $dbms_service;

    private $FUNC_INPUT = 1;
    private $FUNC_OUTPUT = 2;

    public function __construct(){

        $this->logisticsController = NULL;
        $this->factoryController = NULL;
        $this->productController = NULL;
        $this->projectController = NULL;
        $this->configController = NULL;
        $this->machineController = NULL;
        $this->boardController = NULL;


    }
    
    public function __destruct(){
        
        if ( $this->logisticsController != NULL ){
            unset( $this->logisticsController );
        }

        if ( $this->factoryController != NULL ){
            unset( $this->factoryController );
        }

        if ( $this->productController != NULL ){
            unset( $this->productController );
        }

        if ( $this->projectController != NULL ){
            unset( $this->projectController );
        }

        if ( $this->configController != NULL ){
            unset( $this->configController );
        }

        if ( $this->machineController != NULL ){
            unset( $this->machineController );
        }

        if ( $this->boardController != NULL ){
            unset( $this->boardController );
        }

    }

    private function loadController(){
        
        $logisticsController = new LogisticsController();
        $productController = new ProductController();
        $projectController = new ProjectController();
        $configController = new ConfigController();
        $machineController = new MachineController();
        $boardController = new BoardController();

        // Controller 루트 경로 셋팅
        $logisticsController->setRootDir( $this->getRootDir() );
        $productController->setRootDir( $this->getRootDir() );
        $projectController->setRootDir( $this->getRootDir() );
        $configController->setRootDir( $this->getRootDir() );
        $machineController->setRootDir( $this->getRootDir() );
        $boardController->setRootDir( $this->getRootDir() );
        
        // Controller 스마티 셋팅
        $logisticsController->setSmarty( $this->getSmarty() );
        $productController->setSmarty( $this->getSmarty() );
        $projectController->setSmarty( $this->getSmarty() );
        $configController->setSmarty( $this->getSmarty() );
        $machineController->setSmarty( $this->getSmarty() );
        $boardController->setSmarty( $this->getSmarty() );

        // DB 셋팅
        $logisticsController->setConn( $this->getConn() );
        $productController->setConn( $this->getConn() );
        $projectController->setConn( $this->getConn() );
        $configController->setConn( $this->getConn() );
        $machineController->setConn( $this->getConn() );
        $boardController->setConn( $this->getConn() );

        // 업로드 경로 셋팅
        $logisticsController->setUploadDir( $this->getUploadDir() );
        $productController->setUploadDir( $this->getUploadDir() );
        $projectController->setUploadDir( $this->getUploadDir() );
        $configController->setUploadDir( $this->getUploadDir() );
        $machineController->setUploadDir( $this->getUploadDir() );
        $boardController->setUploadDir( $this->getUploadDir() );

        // 업로드 크기 제한 설정
        $logisticsController->setUploadSize( $this->getUploadSize() );
        $productController->setUploadSize( $this->getUploadSize() );
        $projectController->setUploadSize( $this->getUploadSize() );
        $configController->setUploadSize( $this->getUploadSize() );
        $machineController->setUploadSize( $this->getUploadSize() );
        $boardController->setUploadSize( $this->getUploadSize() );

        // 경로 설정
        $logisticsController->setRootRoute( $this->getRootRoute() );
        $logisticsController->setSecondRoute( $this->getSecondRoute() );
        $logisticsController->setThirdRoute( $this->getThirdRoute() );

        $productController->setRootRoute( $this->getRootRoute() );
        $productController->setSecondRoute( $this->getSecondRoute() );
        $productController->setThirdRoute( $this->getThirdRoute() );

        $projectController->setRootRoute( $this->getRootRoute() );
        $projectController->setSecondRoute( $this->getSecondRoute() );
        $projectController->setThirdRoute( $this->getThirdRoute() );

        $configController->setRootRoute( $this->getRootRoute() );
        $configController->setSecondRoute( $this->getSecondRoute() );
        $configController->setThirdRoute( $this->getThirdRoute() );

        $machineController->setRootRoute( $this->getRootRoute() );
        $machineController->setSecondRoute( $this->getSecondRoute() );
        $machineController->setThirdRoute( $this->getThirdRoute() );

        $boardController->setRootRoute( $this->getRootRoute() );
        $boardController->setSecondRoute( $this->getSecondRoute() );
        $boardController->setThirdRoute( $this->getThirdRoute() );

        // 서비스 모드 설정
        $logisticsController->setServiceMode( $this->getServiceMode() );
        $productController->setServiceMode( $this->getServiceMode() );
        $projectController->setServiceMode( $this->getServiceMode() );
        $configController->setServiceMode( $this->getServiceMode() );
        $machineController->setServiceMode( $this->getServiceMode() );
        $boardController->setServiceMode( $this->getServiceMode() );


        $this->logisticsController = $logisticsController;
        $this->productController = $productController;
        $this->projectController = $projectController;
        $this->configController = $configController;
        $this->machineController = $machineController;
        $this->boardController = $boardController;

    }
    
    private function templateDir(){
        $smarty = $this->getSmarty();
        $root_dir = $this->getRootDir();
        $smarty->setTemplateDir($root_dir . '/view/main/mgt');
        

        $this->setSmarty($smarty);
        
    }

    
    private function loadService(){
        
        $this->board_service = new BoardServiceImpl();
        $this->member_service = new MemberServiceImpl();
        $this->product_service = new ProductServiceImpl();
        $this->warehouse_service = new WarehouseServiceImpl();
        $this->project_service = new ProjectServiceImpl();
        $this->dbms_service = new DbmsServiceImpl();
        
        $my_conn = $this->getConn();

        $this->board_service->setConn($my_conn);
        $this->member_service->setConn($my_conn);
        $this->product_service->setConn($my_conn);
        $this->warehouse_service->setConn($my_conn);
        $this->project_service->setConn($my_conn);
        $this->dbms_service->setConn($my_conn);

        //print_r($this->warehouse_service);

    }
    
    public function main(){
        //echo "홈2 / 참";
        //require_once $this->root_dir . "view/home.php";
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();
        
        //print_r( $smarty->getTemplateDir() );

        // 최근 게시물 조회(공지사항)
        $boardVO = new BoardVO();
        $boardname = "notice";
        $boardVO->setBoardname($boardname);
        $boardVO->setOption1(1);
        $result_latest_notice = $this->board_service->selectLatestBoardView($boardVO);

        
        // 기간별 조회(1달)
        $dt = new DateTime('NOW');
        $periodOfstartDate = $dt->format('Y-m-01');
        $day_count = strtotime("+1 months", strtotime($periodOfstartDate) );
        $periodOfendDate = date("Y-m-d", $day_count);

        // 창고 조회(1달)
        //echo $startDate . "/" . $endDate . "/" . $day_count;
        $result = $this->warehouse_service->selectWarehouseBetweenSumOfInputCnt($periodOfstartDate, $periodOfendDate);
        $periodOfsumOfinput = $result['cnt'];

        $result = $this->warehouse_service->selectWarehouseBetweenSumOfOutputCnt($periodOfstartDate, $periodOfendDate);
        $periodOfsumOfoutput = $result['cnt'];

        
        // 전체 기간별 조회(창고)
        $dt = new DateTime('NOW');
        $oneYearOfstartDate = $dt->format('Y-01-01');
        $day_count = strtotime("+12 months", strtotime($oneYearOfstartDate) );
        $oneYearOfendDate = date("Y-m-d", $day_count);

        // 창고 조회(1년)
        //echo $startDate . "/" . $endDate . "/" . $day_count;
        $result = $this->warehouse_service->selectWarehouseBetweenSumOfInputCnt($oneYearOfstartDate, $oneYearOfendDate);
        $oneYearOfsumOfinput = $result['cnt'];

        $result = $this->warehouse_service->selectWarehouseBetweenSumOfOutputCnt($oneYearOfstartDate, $oneYearOfendDate);
        $oneYearOfsumOfoutput = $result['cnt'];

        // 창고 1달(1년을 1달 단위로 분할)
        $dt = new DateTime('NOW');
        $arrOneYearOfmonth = array();
        $arrOneYearOfstartdate = array();
        $arrOneYearOfenddate = array();
        $arrOneYearOfresultOfinput = array();
        $arrOneYearOfresultOfoutput = array();

        // 1달 일자별 구분
        for ( $i = 0; $i < 12; $i++ ){

            // 달력 생성
            $j = $i + 1;
            if ( $j >= 1 && $j < 10){
                $tmpStartDate = $dt->format('Y-0' . $j . '-01');
            }
            else{
                $tmpStartDate = $dt->format('Y-' . $j . '-01');
            }

            // 월 생성
            array_push($arrOneYearOfmonth, $j);

            // 시작일자 생성
            array_push($arrOneYearOfstartdate, $tmpStartDate);
            $day_count = strtotime("+1 months", strtotime($tmpStartDate) );
            
            $tmpEndDate = date("Y-m-d", $day_count);
            // 종료일자 생성
            array_push($arrOneYearOfenddate, $tmpEndDate);

            $result = $this->warehouse_service->selectWarehouseBetweenSumOfInputCnt($arrOneYearOfstartdate[$i], $arrOneYearOfenddate[$i]);
            $tmpResultInput = $result['cnt'];

            if ( !isset($tmpResultInput) ){
                $tmpResultInput = 0;
            }

            $result = $this->warehouse_service->selectWarehouseBetweenSumOfOutputCnt($arrOneYearOfstartdate[$i], $arrOneYearOfenddate[$i]);
            $tmpResultOutput = $result['cnt'];

            if ( !isset($tmpResultOutput) ){
                $tmpResultOutput = 0;
            }

            array_push($arrOneYearOfresultOfinput, $tmpResultInput);
            array_push($arrOneYearOfresultOfoutput, $tmpResultOutput);

        }

        // 회원 수
        $result = $this->member_service->selectAllMemberCount();
        $sumOfmember = $result['cnt'];

        // DB 크기
        $dbname = $this->getConn()->getDbname();
        $result = $this->dbms_service->selectDbSizeFindDbname( $dbname );
        $sumOfdbSize = $result['size'];

        // 디렉토리 크기
        $sumOfdirSize = FileUtil::getDirectorySize( $this->getRootDir() );
        $sumOfdirSize = FileUtil::convfileSize( $sumOfdirSize );

        //echo $_SESSION['auth_name'] . "<br>";
        //echo "참" . $_SESSION['emp_no'];
        $smarty->assign("boardname", $boardname);
        $smarty->assign("latest_notice_item", $result_latest_notice);
        $smarty->assign("sum_of_dirsize", $sumOfdirSize);
        $smarty->assign("sum_of_dbsize", $sumOfdbSize);
        $smarty->assign("sum_of_member", $sumOfmember);
        $smarty->assign("period_of_sum_of_input", $periodOfsumOfinput);
        $smarty->assign("period_of_sum_of_output", $periodOfsumOfoutput);
        $smarty->assign("periodOfstartDate", $periodOfstartDate);
        $smarty->assign("periodOfendDate", $periodOfendDate);
        $smarty->assign("oneyear_of_sum_of_input", $oneYearOfsumOfinput);
        $smarty->assign("oneyear_of_sum_of_output", $oneYearOfsumOfoutput);
        $smarty->assign("oneyearOfstartDate", $oneYearOfstartDate);
        $smarty->assign("oneyearOfendDate", $oneYearOfendDate);
        
        // 1달 단위로 1년을 분할
        $smarty->assign("arrOneYearOfstartdate", $arrOneYearOfstartdate);
        $smarty->assign("arrOneYearOfenddate", $arrOneYearOfenddate);
        $smarty->assign("arrOneYearOfmonth", $arrOneYearOfmonth);
        $smarty->assign("arrOneYearOfresultOfinput", $arrOneYearOfresultOfinput);
        $smarty->assign("arrOneYearOfresultOfoutput", $arrOneYearOfresultOfoutput);

        $smarty->assign("title", "메인:::Smart Premiere");
        $smarty->assign("session_emp_no", $_SESSION['emp_no']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('main_dashboard.tpl');
        
    }

    public function logistics(){

        $this->loadController();
        $this->templateDir();

        //echo "메시지" . $_POST['srtype'] . "/" . isset( $_POST['srtype'] ) . "<br>";
        //echo strcmp( $_POST['srtype'], 'submit') . "<br>";

        if ( !isset( $_GET['func'] ) ){
            exit;
        }

        if ( strcmp( $_GET['func'], 'input' ) === 0 ){
            #echo "참1" . "/" . isset($_GET['search']);

            if ( !isset($_GET['search']) && 
                !isset($_POST['srtype']) )
            {
                $this->logisticsController->input();
            }
            // 품목 코드 찾기
            else if ( isset($_GET['search']) &&
                     strcmp($_GET['search'], 'product') === 0 &&
                     !isset($_GET['keyword']) ){
                $this->logisticsController->input_search();
            }
            // 품목 코드 검색 결과 출력
            else if ( isset($_GET['search']) &&
                     strcmp($_GET['search'], 'product') === 0 &&
                      isset($_GET['keyword']) ){

                $pageCri = new PageCriteria();

                // 페이지 설정
                if ($_GET['page'] >= 0 &&
                    is_numeric($_GET['page'])){
                    
                    $pageCri->setPage($_GET['page']);

                }

                $this->logisticsController->input_search_result( $pageCri, $_GET['keyword'] );
            }
            // 입고 처리 프로세스
            else if ( isset( $_POST['srtype'] ) &&
                    strcmp( $_POST['srtype'], 'submit') === 0 ){
                
                $dt = new DateTime('NOW');
                $dt = $dt->format('Y-m-d H:i:s');

                //echo $dt;
                
                $warehouseVO = new WarehouseVO();

                // 상품코드 입력
                if ( isset($_POST['productCode']) && 
                    strcmp($_POST['productCode'], "") !== 0){
                    $warehouseVO->setProduct_id($_POST['productCode']);
                }
                else if ( isset($_POST['productCode']) && 
                        strcmp($_POST['productCode'], "") === 0 ){
                    $warehouseVO->setProduct_id(-1);
                }

                // 수량 입력
                if ( isset($_POST['productNum']) &&
                    strcmp($_POST['productNum'], "") !== 0){
                    $warehouseVO->setProduct_cnt($_POST['productNum']);
                }
                else if ( isset($_POST['productNum']) &&
                    strcmp($_POST['productNum'], "") === 0){
                    $warehouseVO->setProduct_cnt(-1);
                }

                //echo isset($_POST['productCode']) . "/" . strcmp($_POST['productCode'], "") . "<br>";
                //echo $warehouseVO->getProduct_no() . "/" . $warehouseVO->getProduct_cnt() . "<br>";

                $warehouseVO->setCreate_date($dt);
                $warehouseVO->setCreate_type("생성");
                $warehouseVO->setIp(Network::get_client_ip());

                //print_r($warehouseVO);

                $this->logisticsController->input_submit_ok($warehouseVO);
                
            }

        }

        // 바코드 출력
        else if ( strcmp( $_GET['func'], 'barcode' ) === 0 ){

            // 개별 출력
            if ( isset( $_GET['option'] ) && 
                isset( $_GET['id'] ) && 
                isset( $_GET['barcodeKey'] ) && 
                strcmp( $_GET['option'], 'print' ) === 0 )
            {

                $warehouseBarcodeVO = new WarehouseBarcodeVO();

                // 창고 ID
                if ( is_numeric($_GET['id']) && 
                     $_GET['id'] >= 0 ){
                    $warehouseBarcodeVO->setId($_GET['id']);
                }else if ( !is_numeric($_GET['id']) ){
                    $warehouseBarcodeVO->setId(-1);
                }

                $this->logisticsController->barcode_individual_print( $warehouseBarcodeVO );
                
            }
            // 단체 출력
            else if ( !isset( $_GET['id'] ) && 
                isset( $_GET['option'] ) && 
                isset( $_GET['barcodeKey'] ) && 
                strcmp( $_GET['option'], 'print' ) === 0 )
            {

                $this->logisticsController->barcode_cart_print( );
                //echo "출력";
                
            }

        }

        else if ( strcmp( $_GET['func'], 'output' ) === 0 ){
            #echo "참2";

            // 재고 현황
            if ( !isset($_GET['status']) && 
                !isset($_GET['keyword']) ){

                $pageCri = new PageCriteria();

                // 페이지 설정
                if ($_GET['page'] >= 0 &&
                    is_numeric($_GET['page'])){
                    
                    $pageCri->setPage($_GET['page']);

                }

                $this->logisticsController->output($pageCri);
                
            }
            // 재고 현황 키워드 검색
            if ( !isset($_GET['status']) && 
                isset($_GET['keyword']) ){

                $pageCri = new PageCriteria();
                $keyword = $_GET['keyword'];

                // 페이지 설정
                if ($_GET['page'] >= 0 &&
                    is_numeric($_GET['page'])){
                    
                    $pageCri->setPage($_GET['page']);

                }

                $this->logisticsController->output_search_result($pageCri, $keyword);
                
            }
            // 출고 입력 페이지
            else if ( isset($_GET['status']) && 
                    strcmp($_GET['status'], "release") === 0 &&
                     isset($_GET['id'])) {
                
                $this->logisticsController->output_release();

            }
            
            // 출고 입력 페이지
            else if ( isset($_GET['status']) && 
                    strcmp($_GET['status'], "w_ok") === 0 &&
                     isset($_GET['id']) && isset($_POST['w_log_id'])) {
                
                $dt = new DateTime('NOW');
                $dt = $dt->format('Y-m-d H:i:s');

                $warehouseLogVo = new WarehouseLogVO();
                $warehouseLogVo->setW_id($_POST["w_id"]);
                $warehouseLogVo->setPrev_w_id($_POST["prev_w_id"]);
                $warehouseLogVo->setPrev_cnt($_POST["prev_cnt"]);
                $warehouseLogVo->setRelease_cnt($_POST["release_cnt"]);
                $warehouseLogVo->setCurrent_cnt($_POST["prev_cnt"] - $_POST["release_cnt"]);
                $warehouseLogVo->setCurrent_type("최근");
                $warehouseLogVo->setRelease_type("출하");
                $warehouseLogVo->setRelease_date($dt);
                $warehouseLogVo->setIp(Network::get_client_ip());


                $this->logisticsController->output_w_ok($warehouseLogVo);

            }
            
            // 장바구니 페이지
            else if ( isset($_GET['status']) && 
                    strcmp($_GET['status'], "cart") === 0) {
                
                //$this->logisticsController->output_release();
                //echo "장바구니";
                
                $this->logisticsController->cart_list();

            }
            
        }
        // 장바구니 담기 기능
        else if ( strcmp( $_GET['func'], 'cart' ) === 0 ){

            // 장바구니에 추가
            if ( isset($_GET['w_id']) && 
                 !isset($_GET['barcodeKey']) && 
                 isset($_GET['option']) && 
                 strcmp( $_GET['w_id'], 'all') !== 0 && 
                 strcmp( $_GET['option'], 'add' ) === 0 ){
                
                $warehouseBarcodeBagVO = new WarehouseBarcodeBagVO();

                if ( isset($_GET['w_id']) &&
                    is_numeric($_GET['w_id']) ){
                    
                    $warehouseBarcodeBagVO->setId($_GET['w_id']);

                }else if ( isset($_GET['w_id']) && 
                    !is_numeric($_GET['w_id']) ){
                    $warehouseBarcodeBagVO->setId( -1 );

                }else if ( !isset($_GET['w_id']) ){                
                    $warehouseBarcodeBagVO->setId( -2 );
                }

                $this->logisticsController->cart_add( $warehouseBarcodeBagVO );

            }
            // 장바구니에 제거
            else if ( isset($_GET['w_id']) && 
                      !isset($_GET['barcodeKey']) && 
                      isset($_GET['option']) && 
                      strcmp( $_GET['w_id'], 'all') !== 0 && 
                      strcmp( $_GET['option'], 'remove' ) === 0 ){
                
                $warehouseBarcodeBagVO = new WarehouseBarcodeBagVO();

                if ( isset($_GET['w_id']) &&
                    is_numeric($_GET['w_id']) ){
                    
                    $warehouseBarcodeBagVO->setId($_GET['w_id']);

                }else if ( isset($_GET['w_id']) && 
                    !is_numeric($_GET['w_id']) ){
                    $warehouseBarcodeBagVO->setId( -1 );

                }else if ( !isset($_GET['w_id']) ){                
                    $warehouseBarcodeBagVO->setId( -2 );
                }

                $this->logisticsController->cart_remove( $warehouseBarcodeBagVO );

            }
            // 장바구니에 제거
            else if ( isset($_GET['w_id']) && 
                      isset($_GET['barcodeKey']) && 
                      isset($_GET['option']) && 
                      strcmp( $_GET['w_id'], 'all') === 0 && 
                      strcmp( $_GET['option'], 'remove' ) === 0 ){
                
                $this->logisticsController->cart_all_remove();
                
            }

        }

    }

    public function product(){
        
        $this->loadController();
        $this->templateDir();
        
        if ( !isset( $_GET['func'] ) ){
            exit;
        }

        if ( strcmp( $_GET['func'], 'list' ) === 0 ){
            
            // 제품 목록 페이지
            if ( !isset($_GET['id']) && 
                 !isset($_GET['option'])){
                
                $pageCri = new PageCriteria();

                // 페이지 설정
                if ($_GET['page'] >= 0 &&
                    is_numeric($_GET['page'])){
                    
                    $pageCri->setPage($_GET['page']);

                }
                
                $this->productController->product_list($pageCri);

            }
            // 제품 상세 보기 페이지
            else if ( isset($_GET['id']) && 
                isset($_GET['option']) && 
                strcmp($_GET['option'], 'detail_view') === 0 ){
                
                $productVO = new ProductVO();
                $productVO->setProduct_id($_GET['id']);

                $this->productController->product_list_detail_view($productVO);

            }
            
        }

        else if ( strcmp( $_GET['func'], 'register' ) === 0 ){
            
            // 제품 등록 페이지
            if (!isset($_POST['func'])){
                $this->productController->product_register();
            }
            // 제품 등록 처리 프로세스
            else if (isset($_POST['func']) && 
                    isset($_POST['srtype']) &&
                    strcmp($_POST['func'], 'input') === 0 &&
                    strcmp($_POST['srtype'], 'submit') === 0){

                $status = 1;
                $file_chk = "NORMAL";

                $productFileArr = array();

                $dt = new DateTime('NOW');
                $dt = $dt->format('Y-m-d H:i:s');

                //echo $dt;
                
                $boxSpecVO = new ProductBoxSpecVO();
                $productVO = new ProductVO();

                // 프로젝트 번호 입력
                if ( isset($_POST['project_id']) && 
                    strcmp($_POST['project_id'], "") !== 0){
                    $productVO->setProject_id($_POST['project_id']);
                }
                else if ( isset($_POST['project_id']) && 
                        strcmp($_POST['project_id'], "") === 0 ){
                    $productVO->setProject_id(-1);
                    $status = -1;
                }

                // 제품명 입력
                if ( isset($_POST['product_name']) &&
                    strlen($_POST['product_name']) > 3){
                    $productVO->setProduct_name($_POST['product_name']);
                }
                else if ( isset($_POST['product_name']) &&
                    strcmp($_POST['product_name'], "") === 0){
                    $productVO->setProduct_name(-1);
                    $status = -2;
                }

                // 설명 입력
                if ( isset($_POST['description']) &&
                    strcmp($_POST['description'], "") !== 0){
                    $productVO->setDescription($_POST['description']);
                }
                else if ( isset($_POST['description']) &&
                    strcmp($_POST['description'], "") === 0){
                    $productVO->setDescription(-1);
                    $status = -3;
                }

                // 등록일자
                $productVO->setRegidate($dt);
                                
                // IP주소
                $productVO->setIp(Network::get_client_ip());

                // 박스 초기 설정
                $boxSpecVO->setBox_type_id(1);
                $boxSpecVO->setWidth(0);
                $boxSpecVO->setLength(0);
                $boxSpecVO->setHeight(0);
                $boxSpecVO->setBox_name("해당없음");
                $boxSpecVO->setRegidate($dt);
                $boxSpecVO->setIp(Network::get_client_ip());

                // 파일 옵션
                $productVO->setFile_option("NORMAL");

                if ( $status === 1 ){

                    // 파일 업로드
                    foreach($_FILES['usrupload']['name'] as $f => $name){

                        $productFileVO = new ProductFileVO();

                        $root_dir = $this->getRootDir();
                        $upload_dir = $this->getUploadDir() . "/product";
                        $uuid = UUID::v4();
                        $upload_dir_fullpath = $root_dir . $upload_dir;
                        $upload_dir_uuid_fullpath = $upload_dir_fullpath . "/" . $uuid;

                        $name = $_FILES['usrupload']['name'][$f];
                        $uploadName = explode('.', $name);

                        $fileName = time(). $f . "." . $uploadName[1];
                        $uploadRealName = $upload_dir_uuid_fullpath . "/" . $fileName;
                        $originalName = $_FILES['usrupload']['name'][$f];
                        $fileSize = $_FILES['usrupload']['size'][$f];
                        $fileExt = $uploadName[1];
                        $fileType = $_FILES['usrupload']['type'][$f];
                        
                        //echo $fileName . ",";
                        //echo $originalName. "," . $fileSize . "," . $fileExt . "," . $fileType . "<br>";

                        //echo $uploadRealName;

                        // 파일 정보 입력
                        $productFileVO->setUuid($uuid);
                        $productFileVO->setRoot_dir($root_dir);
                        $productFileVO->setUpload_dir($upload_dir);
                        $productFileVO->setFile_ext($fileExt);
                        $productFileVO->setFile_size($fileSize);
                        $productFileVO->setOriginal_name($originalName);
                        $productFileVO->setFile_name($fileName);
                        $productFileVO->setFile_type($fileType);
                        $productFileVO->setRegidate($dt);
                        $productFileVO->setIp(Network::get_client_ip());
                        

                        //echo $fileExt . "/" . FileUtil::checkFileExtAllowPhoto($fileExt) . "<br>";

                        //echo $uploadName;

                        if ( strcmp( $file_chk, "NORMAL") === 0 && 
                              FileUtil::checkFileExtRestrict($fileExt) === 1 )
                        {
                            
                            if ( FileUtil::checkFileExtAllowPhoto($fileExt) === 0 ){
                                $file_chk = "RESTRICT";
                                $productVO->setFile_option("RESTRICT");
                            }

                        }

                        
                        if ( strcmp( $file_chk, "NORMAL") === 0 &&
                                $this->getUploadSize() < $fileSize){
                            $file_chk = "RESTRICT";
                            $productVO->setFile_option("RESTRICT");
                        }

                        //echo $file_chk;


                        // 파일 서버 전송
                        if ( strlen($originalName) != 0 && 
                            strcmp( $file_chk, "RESTRICT" ) !== 0 ){
                            
                            if(!is_dir( $upload_dir_fullpath )){
                                mkdir( $upload_dir_fullpath );
                            }

                            if(!is_dir( $upload_dir_uuid_fullpath )){
                                mkdir( $upload_dir_uuid_fullpath );
                            }

                            if (move_uploaded_file($_FILES['usrupload']['tmp_name'][$f], $uploadRealName)){
                                //echo "success";

                                /*
                                // 파일 삭제
                                if ( is_file($uploadRealName) ){
                                    unlink($uploadRealName);
                                }

                                // 폴더 삭제
                                rmdir($upload_dir_uuid_fullpath);   // 임시 삭제
                                */
                                $productFileVO->setOption("success");

                            }else{
                                //echo "error";
                                $productFileVO->setOption("error");
                            }

                        }

                        // 파일정보 배열로 입력
                        if(strlen($originalName) != 0 && 
                            strcmp( $file_chk, "RESTRICT") !== 0){
                            //echo "참";
                            array_push($productFileArr, $productFileVO);
                        }

                    }

                }
                
                $this->productController->product_register_ok($productVO, $productFileArr, $boxSpecVO);

            }

        }
        // 프로젝트 검색
        else if ( strcmp( $_GET['func'], 'input' ) === 0 ){
            #echo "참1" . "/" . isset($_GET['search']);

            // 프로젝트 코드 찾기
            if ( isset($_GET['search']) &&
                     strcmp($_GET['search'], 'project') === 0 &&
                     !isset($_GET['keyword']) ){
                $this->productController->project_search();
            }
            // 품목 코드 검색 결과 출력
            else if ( isset($_GET['search']) &&
                     strcmp($_GET['search'], 'project') === 0 &&
                      isset($_GET['keyword']) ){

                $pageCri = new PageCriteria();

                // 페이지 설정
                if ($_GET['page'] >= 0 &&
                    is_numeric($_GET['page'])){
                    
                    $pageCri->setPage($_GET['page']);

                }

                $this->productController->project_search_result( $pageCri, $_GET['keyword'] );

            }

        }
        // 제품 수정
        else if ( strcmp( $_GET['func'], 'modify' ) === 0 ){

            //echo $_POST['func'];

            // 제품 수정 페이지
            if (!isset($_POST['func']) && 
                !isset($_GET['option']) && 
                isset($_GET['id'])){
                $this->productController->product_modify();
            }

            // 제품 수정 처리 프로세스
            else if (isset($_POST['func']) && 
                    isset($_POST['srtype']) &&
                    isset($_POST['cur_project_id']) && 
                    isset($_POST['cur_product_id']) && 
                    !isset($_GET['option']) && 
                    strcmp($_POST['func'], 'modify') === 0 &&
                    strcmp($_POST['srtype'], 'submit') === 0){
                
                $status = 1;
                $file_chk = "NORMAL";

                $productFileArr = array();

                $dt = new DateTime('NOW');
                $dt = $dt->format('Y-m-d H:i:s');

                $updateVo = new ProductVO();   // 변경될 계정 정보

                // 계정 프로젝트, 제품 번호
                $updateVo->setProject_id($_POST['project_id']);
                $updateVo->setProduct_id($_POST['cur_product_id']);

                // 제품명
                if (isset($_POST['product_name']) && 
                    strlen($_POST['product_name'] > 3)){
                    $updateVo->setProduct_name($_POST['product_name']);
                }else{
                    $updateVo->setProduct_name(-1);
                    $status = -1;
                }

                // 설명
                if (isset($_POST['description']) && 
                    strlen($_POST['description'] > 4)){
                    $updateVo->setDescription($_POST['description']);
                }else{
                    $updateVo->setDescription(-1);
                    $status = -2;
                }

                // 수정일자
                $updateVo->setRegidate($dt);

                // 파일 옵션
                $updateVo->setFile_option("NORMAL");

                if ( $status === 1 ){

                    // 파일 업로드
                    foreach($_FILES['usrupload']['name'] as $f => $name){

                        $productFileVO = new ProductFileVO();

                        $root_dir = $this->getRootDir();
                        $upload_dir = $this->getUploadDir() . "/product";
                        $uuid = UUID::v4();
                        $upload_dir_fullpath = $root_dir . $upload_dir;
                        $upload_dir_uuid_fullpath = $upload_dir_fullpath . "/" . $uuid;

                        $name = $_FILES['usrupload']['name'][$f];
                        $uploadName = explode('.', $name);

                        $fileName = time(). $f . "." . $uploadName[1];
                        $uploadRealName = $upload_dir_uuid_fullpath . "/" . $fileName;
                        $originalName = $_FILES['usrupload']['name'][$f];
                        $fileSize = $_FILES['usrupload']['size'][$f];
                        $fileExt = $uploadName[1];
                        $fileType = $_FILES['usrupload']['type'][$f];
                        
                        //echo $fileName . ",";
                        //echo $originalName. "," . $fileSize . "," . $fileExt . "," . $fileType . "<br>";

                        //echo $uploadRealName;

                        // 파일 정보 입력
                        $productFileVO->setUuid($uuid);
                        $productFileVO->setRoot_dir($root_dir);
                        $productFileVO->setUpload_dir($upload_dir);
                        $productFileVO->setFile_ext($fileExt);
                        $productFileVO->setFile_size($fileSize);
                        $productFileVO->setOriginal_name($originalName);
                        $productFileVO->setFile_name($fileName);
                        $productFileVO->setFile_type($fileType);
                        $productFileVO->setRegidate($dt);
                        $productFileVO->setIp(Network::get_client_ip());
                        

                        //echo $fileExt . "/" . FileUtil::checkFileExtAllowPhoto($fileExt) . "<br>";

                        //echo $uploadName;

                        if ( strcmp( $file_chk, "NORMAL") === 0 && 
                              FileUtil::checkFileExtRestrict($fileExt) === 1 )
                        {
                            
                            if ( FileUtil::checkFileExtAllowPhoto($fileExt) === 0 ){
                                $file_chk = "RESTRICT";
                                $updateVo->setFile_option("RESTRICT");
                            }

                        }

                        
                        if ( strcmp( $file_chk, "NORMAL") === 0 &&
                                $this->getUploadSize() < $fileSize){
                            $file_chk = "RESTRICT";
                            $updateVo->setFile_option("RESTRICT");
                        }

                        //echo $file_chk;


                        // 파일 서버 전송
                        if ( strlen($originalName) != 0 && 
                            strcmp( $file_chk, "RESTRICT" ) !== 0 ){
                            
                            if(!is_dir( $upload_dir_fullpath )){
                                mkdir( $upload_dir_fullpath );
                            }

                            if(!is_dir( $upload_dir_uuid_fullpath )){
                                mkdir( $upload_dir_uuid_fullpath );
                            }

                            if (move_uploaded_file($_FILES['usrupload']['tmp_name'][$f], $uploadRealName)){
                                //echo "success";

                                /*
                                // 파일 삭제
                                if ( is_file($uploadRealName) ){
                                    unlink($uploadRealName);
                                }

                                // 폴더 삭제
                                rmdir($upload_dir_uuid_fullpath);   // 임시 삭제
                                */
                                $productFileVO->setOption("success");

                            }else{
                                //echo "error";
                                $productFileVO->setOption("error");
                            }

                        }

                        // 파일정보 배열로 입력
                        if(strlen($originalName) != 0 && 
                            strcmp( $file_chk, "RESTRICT") !== 0){
                            //echo "참";
                            array_push($productFileArr, $productFileVO);
                        }

                    }

                }
                
                $this->productController->product_modify_ok($updateVo, $productFileArr);
                

            }
            // 제품 파일 삭제 처리 프로세스
            else if (isset($_POST['func']) &&
                isset($_POST['srtype']) &&
                isset($_POST['product_id']) &&
                isset($_POST['uuid']) &&
                strcmp($_POST['func'], 'file_delete') === 0 &&
                strcmp($_POST['srtype'], 'submit') === 0 ){
                    
                $productFileVO = new ProductFileVO();
                    
                $productFileVO->setProduct_id($_POST['product_id']);
                $productFileVO->setUuid($_POST['uuid']);
                    
                //echo $_POST['project_id'] . "/" . $_POST['uuid'];
                
                $this->productController->product_file_delete_ok($productFileVO);
                    
            }
            // 제품 상자 수정
            else if ( isset($_GET['id']) && 
                      isset($_GET['option']) && 
                      !isset($_POST['product_id']) && 
                      !isset($_POST['func']) && 
                      !isset($_POST['srtype']) && 
                      strcmp($_GET['option'], 'box') === 0 ){
                
                $boxSpecVO = new ProductBoxSpecVO();
                        
                if ( is_numeric( $_GET['id'] ) ){
                    $boxSpecVO->setProduct_id( $_GET['id'] );
                }
                else if ( !is_numeric( $_GET['id']) ){
                    $boxSpecVO->setProduct_id( -1 );
                }

                $this->productController->product_box_spec($boxSpecVO);

            }
            // 제품 상자 수정 프로세스
            else if ( isset($_GET['id']) && 
                      isset($_GET['option']) && 
                      isset($_POST['product_id']) && 
                      isset($_POST['func']) && 
                      isset($_POST['srtype']) && 
                      strcmp($_GET['option'], 'box') === 0 && 
                      strcmp($_POST['func'], 'modify') === 0 && 
                      strcmp($_POST['srtype'], 'submit') === 0 ){

                $dt = new DateTime('NOW');
                $dt = $dt->format('Y-m-d H:i:s');
                $boxSpecVO = new ProductBoxSpecVO();

                // 제품 ID
                if ( is_numeric( $_POST['product_id'] ) ){
                    $boxSpecVO->setProduct_id( $_POST['product_id'] );
                }
                else if ( !is_numeric( $_POST['product_id'] ) ){
                    $boxSpecVO->setProduct_id( -1 );
                }
                
                // 박스 유형
                if ( isset( $_POST['box_type_id'] ) && 
                    strlen( $_POST['box_type_id'] ) > 0 && 
                    is_numeric( $_POST['box_type_id'] ) ){
                    $boxSpecVO->setBox_type_id( $_POST['box_type_id'] );
                }
                else if ( isset( $_POST['box_type_id'] ) && 
                    !is_numeric( $_POST['box_type_id'] ) ){
                    $boxSpecVO->setBox_type_id( -1 );
                }

                // 가로
                if ( isset( $_POST['width'] ) && 
                    strlen( $_POST['width'] ) > 0 ){
                    $boxSpecVO->setWidth( $_POST['width'] );
                }
                else if ( !isset( $_POST['width'] ) ){
                    $boxSpecVO->setWidth( -1 );
                }

                // 세로
                if ( isset( $_POST['length']) && 
                    strlen( $_POST['length']) > 0 ){
                    $boxSpecVO->setLength( $_POST['length'] );
                }
                else if ( !isset( $_POST['length']) ){
                    $boxSpecVO->setLength( -1 );
                }

                // 높이
                if ( isset( $_POST['height']) && 
                    strlen( $_POST['height']) > 0 ){
                    $boxSpecVO->setHeight( $_POST['height'] );
                }
                else if ( !isset( $_POST['height']) ){
                    $boxSpecVO->setHeight( -1 );
                }

                // 상자 이름
                if ( isset( $_POST['box_name']) && 
                    strlen( $_POST['box_name']) > 3 ){
                    $boxSpecVO->setBox_name( $_POST['box_name'] );
                }
                else if ( isset( $_POST['box_name'] ) && 
                    strlen( $_POST['box_name'] ) <= 3 ){
                    $boxSpecVO->setBox_name( -1 );
                }
                else if( !isset( $_POST['box_name'] ) ){
                    $boxSpecVO->setBox_name( -2 );
                }

                // 등록 일자
                $boxSpecVO->setRegidate($dt);

                // IP주소
                $boxSpecVO->setIp( Network::get_client_ip() );

                $this->productController->product_box_spec_modify_ok($boxSpecVO);

            }
                       
        }

        // 제품 삭제
        else if ( strcmp( $_GET['func'], 'delete' ) === 0 ){
            
            $productVO = new ProductVO();

            if ( isset($_GET['id']) && 
                 is_numeric($_GET['id']) ){

                $productVO->setProduct_id($_GET['id']);

            }else if ( isset($_GET['id']) && 
                       !is_numeric($_GET['id']) ){
                $productVO->setProduct_id(-1);
            }
            else if ( !isset($_GET['id']) ) {
                $productVO->setProduct_id(-2);
            }

            $this->productController->product_delete_ok($productVO);

        }
        
        // 다운로드 기능
        else if ( strcmp( $_GET['func'], 'download') === 0 ){
                
            // 다운로드 페이지 호출
            if ( isset($_GET['uuid']) &&
                !isset($_GET['page']) ){
                
                $this->loadService();

                $smarty = $this->getSmarty();
                $smarty->clearAllCache();

                $productFileVO = new ProductFileVO();
                $productFileVO->setUuid($_GET['uuid']);

                $fileitem = $this->product_service->selectFindUUIDProductFile($productFileVO);

                //echo "참1";

                //print_r($fileitem);
                if ( isset($fileitem) ){
                    $this->_download($fileitem);
                }

            }
            // 삭제 여부 페이지
            else if ( isset($_GET['uuid']) &&
                isset($_GET['page']) &&
                isset($_GET['product_id']) &&
                strcmp( $_GET['page'], "delete") === 0 ){
                    
                    $this->productController->product_file_delete();
                    
            }

        }

    }

    
    public function project(){
        
        $this->loadController();
        $this->templateDir();
        
        if ( !isset( $_GET['func'] ) ){
            exit;
        }

        // 프로젝트 목록
        if ( strcmp( $_GET['func'], 'list' ) === 0 ){
            
            
            // 프로젝트 목록 페이지
            if ( !isset($_GET['id']) && 
                 !isset($_GET['option'])){
                $pageCri = new PageCriteria();

                // 페이지 설정
                if ($_GET['page'] >= 0 &&
                    is_numeric($_GET['page'])){
                    
                    $pageCri->setPage($_GET['page']);

                }
                
                $this->projectController->list_page($pageCri);

            }
            // 프로젝트 상세 보기 페이지
            else if ( isset($_GET['id']) && 
                isset($_GET['option']) && 
                strcmp($_GET['option'], 'detail_view') === 0 ){
                
                $projectVO = new ProjectVO();
                $projectVO->setProject_id($_GET['id']);

                $this->projectController->project_list_detail_view($projectVO);
            }

        }

        // 프로젝트 등록
        else if ( strcmp( $_GET['func'], 'register') === 0 ){

            // 프로젝트 등록 페이지
            if (!isset($_POST['func'])){
                $this->projectController->project_register();
            }
            // 프로젝트 등록 처리 프로세스
            else if (isset($_POST['func']) && 
                isset($_POST['srtype']) &&
                strcmp($_POST['func'], 'input') === 0 &&
                strcmp($_POST['srtype'], 'submit') === 0){

                $status = 1;
                $file_chk = "NORMAL";

                $projectFileArr = array();

                $dt = new DateTime('NOW');
                $dt = $dt->format('Y-m-d H:i:s');

                $projectVO = new ProjectVO();
                

                if ( isset( $_POST['project_name'] ) && 
                    strlen( $_POST['project_name'] ) > 4 ){                    
                    
                    $projectVO->setProject_name($_POST['project_name']);

                }else{
                    $projectVO->setProject_name(-1);
                    $status = -1;
                }

                if ( isset( $_POST['description'] ) &&
                    strlen( $_POST['description']) ){
                    
                    $projectVO->setDescription( Xss::xss_clean( $_POST['description'] ) );
                }else{
                    $projectVO->setDescription(-1);
                    $status = -2;
                }
                
                if ( isset( $_POST['startdate'] ) &&
                    strlen( $_POST['startdate']) ){

                    $startDate = strtotime($_POST['startdate']);
                    $newStartDate = date('Y-m-d H:i:s', $startDate);
                    $projectVO->setStartdate( $newStartDate );

                }else{
                    $projectVO->setStartdate(-1);
                    $status = -3;
                }

                if ( isset( $_POST['enddate'] ) &&
                    strlen( $_POST['enddate']) ){
                    
                    $endDate = strtotime($_POST['enddate']);
                    $newEndDate = date('Y-m-d H:i:s', $endDate);
                    $projectVO->setEnddate( $newEndDate );

                }else{
                    $projectVO->setEnddate(-1);
                    $status = -4;
                }

                
                // 등록일자
                $projectVO->setRegidate($dt);
                
                // IP주소
                $projectVO->setIp(Network::get_client_ip());

                // 파일 옵션
                $projectVO->setFile_option("NORMAL");

                // echo $projectVO->getProject_name() . "/" . $projectVO->getStartdate() . "<br>";

                if ( $status === 1 ){

                    // 파일 업로드
                    foreach($_FILES['usrupload']['name'] as $f => $name){

                        $projectFileVO = new ProjectFileVO();

                        $root_dir = $this->getRootDir();
                        $upload_dir = $this->getUploadDir() . "/project";
                        $uuid = UUID::v4();
                        $upload_dir_fullpath = $root_dir . $upload_dir;
                        $upload_dir_uuid_fullpath = $upload_dir_fullpath . "/" . $uuid;

                        $name = $_FILES['usrupload']['name'][$f];
                        $uploadName = explode('.', $name);

                        $fileName = time(). $f . "." . $uploadName[1];
                        $uploadRealName = $upload_dir_uuid_fullpath . "/" . $fileName;
                        $originalName = $_FILES['usrupload']['name'][$f];
                        $fileSize = $_FILES['usrupload']['size'][$f];
                        $fileExt = $uploadName[1];
                        $fileType = $_FILES['usrupload']['type'][$f];
                        
                        //echo $fileName . ",";
                        //echo $originalName. "," . $fileSize . "," . $fileExt . "," . $fileType . "<br>";

                        //echo $uploadRealName;

                        // 파일 정보 입력
                        $projectFileVO->setUuid($uuid);
                        $projectFileVO->setRoot_dir($root_dir);
                        $projectFileVO->setUpload_dir($upload_dir);
                        $projectFileVO->setFile_ext($fileExt);
                        $projectFileVO->setFile_size($fileSize);
                        $projectFileVO->setOriginal_name($originalName);
                        $projectFileVO->setFile_name($fileName);
                        $projectFileVO->setFile_type($fileType);
                        $projectFileVO->setRegidate($dt);
                        $projectFileVO->setIp(Network::get_client_ip());
                        

                        //echo $fileExt;

                        //echo $uploadName;

                        if ( strcmp( $file_chk, "NORMAL") === 0 &&
                            FileUtil::checkFileExtRestrict($fileExt) === 1){
                            $file_chk = "RESTRICT";
                            $projectVO->setFile_option("RESTRICT");
                        }

                        
                        if ( strcmp( $file_chk, "NORMAL") === 0 &&
                            $this->getUploadSize() < $fileSize){
                            $file_chk = "RESTRICT";
                            $projectVO->setFile_option("RESTRICT");
                        }


                        // 파일 서버 전송
                        if ( strlen($originalName) != 0 && 
                            strcmp( $file_chk, "RESTRICT" ) !== 0 ){
                            
                            if(!is_dir( $upload_dir_fullpath )){
                                mkdir( $upload_dir_fullpath );
                            }

                            if(!is_dir( $upload_dir_uuid_fullpath )){
                                mkdir( $upload_dir_uuid_fullpath );
                            }

                            if (move_uploaded_file($_FILES['usrupload']['tmp_name'][$f], $uploadRealName)){
                                //echo "success";

                                /*
                                // 파일 삭제
                                if ( is_file($uploadRealName) ){
                                    unlink($uploadRealName);
                                }

                                // 폴더 삭제
                                rmdir($upload_dir_uuid_fullpath);   // 임시 삭제
                                */
                                $projectFileVO->setOption("success");

                            }else{
                                //echo "error";
                                $projectFileVO->setOption("error");
                            }

                        }

                        // 파일정보 배열로 입력
                        if(strlen($originalName) != 0 && 
                            strcmp( $file_chk, "RESTRICT") !== 0){
                            array_push($projectFileArr, $projectFileVO);
                        }

                    }

                }

                $this->projectController->project_register_ok($projectVO, $projectFileArr);

            }

        }

        // 프로젝트 수정
        else if ( strcmp( $_GET['func'], 'modify' ) === 0 ){

            //echo $_POST['func'];

            // 계정 수정 페이지
            if (!isset($_POST['func']) && 
                isset($_GET['id'])){
                $this->projectController->project_modify();
            }

            // 프로젝트 수정 처리 프로세스
            else if (isset($_POST['func']) && 
                    isset($_POST['srtype']) &&
                    isset($_POST['project_id']) && 
                    strcmp($_POST['func'], 'modify') === 0 &&
                    strcmp($_POST['srtype'], 'submit') === 0){


                $status = 1;
                $file_chk = "NORMAL";

                $projectFileArr = array();
                $dt = new DateTime('NOW');
                $dt = $dt->format('Y-m-d H:i:s');

                $projectVO = new ProjectVO();

                $projectVO->setProject_id($_POST['project_id']);

                if ( isset( $_POST['project_name'] ) && 
                    strlen( $_POST['project_name'] ) > 4 ){                    
                    
                    $projectVO->setProject_name($_POST['project_name']);

                }else{
                    $projectVO->setProject_name(-1);
                    $status = -1;
                }

                if ( isset( $_POST['description'] ) &&
                    strlen( $_POST['description']) ){
                    
                    $projectVO->setDescription( Xss::xss_clean( $_POST['description'] ) );
                }else{
                    $projectVO->setDescription(-1);
                    $status = -2;
                }

                if ( isset( $_POST['startdate'] ) &&
                    strlen( $_POST['startdate']) ){

                    $startDate = strtotime($_POST['startdate']);
                    $newStartDate = date('Y-m-d H:i:s', $startDate);
                    $projectVO->setStartdate( $newStartDate );

                }else{
                    $projectVO->setStartdate(-1);
                    $status = -3;
                }

                if ( isset( $_POST['enddate'] ) &&
                    strlen( $_POST['enddate']) ){
                    
                    $endDate = strtotime($_POST['enddate']);
                    $newEndDate = date('Y-m-d H:i:s', $endDate);
                    $projectVO->setEnddate( $newEndDate );

                }else{
                    $projectVO->setEnddate(-1);
                    $status = -4;
                }


                // 등록일자
                $projectVO->setRegidate($dt);

                // IP주소
                $projectVO->setIp(Network::get_client_ip());

                // 파일 옵션
                $projectVO->setFile_option("NORMAL");

                // echo $projectVO->getProject_name() . "/" . $projectVO->getStartdate() . "<br>";

                if ( $status === 1 ){

                    // 파일 업로드
                    foreach($_FILES['usrupload']['name'] as $f => $name){


                        $projectFileVO = new ProjectFileVO();

                        $root_dir = $this->getRootDir();
                        $upload_dir = $this->getUploadDir() . "/project";
                        $uuid = UUID::v4();
                        $upload_dir_fullpath = $root_dir . $upload_dir;
                        $upload_dir_uuid_fullpath = $upload_dir_fullpath . "/" . $uuid;

                        $name = $_FILES['usrupload']['name'][$f];
                        $uploadName = explode('.', $name);

                        $fileName = time(). $f . "." . $uploadName[1];
                        $uploadRealName = $upload_dir_uuid_fullpath . "/" . $fileName;
                        $originalName = $_FILES['usrupload']['name'][$f];
                        $fileSize = $_FILES['usrupload']['size'][$f];
                        $fileExt = $uploadName[1];
                        $fileType = $_FILES['usrupload']['type'][$f];
                        
                        //echo $fileName . ",";
                        //echo $originalName. "," . $fileSize . "," . $fileExt . "," . $fileType . "<br>";

                        //echo $uploadRealName;

                        // 파일 정보 입력
                        $projectFileVO->setUuid($uuid);
                        $projectFileVO->setRoot_dir($root_dir);
                        $projectFileVO->setUpload_dir($upload_dir);
                        $projectFileVO->setFile_ext($fileExt);
                        $projectFileVO->setFile_size($fileSize);
                        $projectFileVO->setOriginal_name($originalName);
                        $projectFileVO->setFile_name($fileName);
                        $projectFileVO->setFile_type($fileType);
                        $projectFileVO->setRegidate($dt);
                        $projectFileVO->setIp(Network::get_client_ip());
                        

                        //echo $fileExt;

                        //echo $uploadName;

                        if ( strcmp( $file_chk, "NORMAL") === 0 &&
                            FileUtil::checkFileExtRestrict($fileExt) === 1){
                            $file_chk = "RESTRICT";
                            $projectVO->setFile_option("RESTRICT");
                        }

                        
                        if ( strcmp( $file_chk, "NORMAL") === 0 &&
                            $this->getUploadSize() < $fileSize){
                            $file_chk = "RESTRICT";
                            $projectVO->setFile_option("RESTRICT");
                        }

                        // 파일 서버 전송
                        if ( strlen($originalName) != 0 && 
                            strcmp( $file_chk, "RESTRICT" ) !== 0 ){
                            
                            if(!is_dir( $upload_dir_fullpath )){
                                mkdir( $upload_dir_fullpath );
                            }

                            if(!is_dir( $upload_dir_uuid_fullpath )){
                                mkdir( $upload_dir_uuid_fullpath );
                            }

                            if(!is_uploaded_file($_FILES['usrupload']['tmp_name'][$f])) { 
                                echo "HTTP로 전송된 파일이 아닙니다."; 
                            } else {

                                if (move_uploaded_file($_FILES['usrupload']['tmp_name'][$f], $uploadRealName)){
                                    //echo "success";

                                    /*
                                    // 파일 삭제
                                    if ( is_file($uploadRealName) ){
                                        unlink($uploadRealName);
                                    }

                                    // 폴더 삭제
                                    rmdir($upload_dir_uuid_fullpath);   // 임시 삭제
                                    */
                                    $projectFileVO->setOption("success");

                                }else{
                                    //echo "error";
                                    $projectFileVO->setOption("error");
                                }

                            }

                        }

                        // 파일정보 배열로 입력
                        if(strlen($originalName) != 0 && 
                            strcmp( $file_chk, "RESTRICT") !== 0){
                            array_push($projectFileArr, $projectFileVO);
                        }

                    }

                }

                $this->projectController->project_modify_ok($projectVO, $projectFileArr);

            }
            // 프로젝트 파일 삭제 처리 프로세스
            else if (isset($_POST['func']) && 
                    isset($_POST['srtype']) &&
                    isset($_POST['project_id']) && 
                    isset($_POST['uuid']) && 
                    strcmp($_POST['func'], 'file_delete') === 0 &&
                    strcmp($_POST['srtype'], 'submit') === 0 ){

                $projectFileVO = new ProjectFileVO();

                $projectFileVO->setProject_id($_POST['project_id']);
                $projectFileVO->setUuid($_POST['uuid']);

                //echo $_POST['project_id'] . "/" . $_POST['uuid'];

                $this->projectController->project_file_delete_ok($projectFileVO);

            }

        }

        // 프로젝트 삭제
        else if ( strcmp( $_GET['func'], 'delete' ) === 0 ){
            
            $projectVO = new ProjectVO();

            if ( isset($_GET['id']) && 
                 is_numeric($_GET['id']) ){

                $projectVO->setProject_id($_GET['id']);

            }else if ( isset($_GET['id']) && 
                       !is_numeric($_GET['id']) ){
                $projectVO->setProject_id(-1);
            }
            else if ( !isset($_GET['id']) ) {
                $projectVO->setProject_id(-2);
            }

            $this->projectController->project_delete_ok($projectVO);

        }

        // 공정 업무
        else if ( strcmp( $_GET['func'], 'process' ) === 0 ){

            // 공정 등록
            if ( isset($_GET['project_id']) && 
                 isset($_GET['view']) && 
                 !isset($_POST['func']) && 
                 !isset($_POST['srtype']) && 
                 is_numeric($_GET['project_id']) && 
                 strcmp($_GET['view'], 'register') === 0 ){
                
                $projectProcessVO = new ProjectProcessVO();
                $projectProcessVO->setProject_id($_GET['project_id']);

                $this->projectController->process_register($projectProcessVO);

            }
            // 공정 등록 처리
            else if ( isset($_GET['project_id']) && 
                    isset($_GET['view']) && 
                    isset($_POST['func']) && 
                    isset($_POST['srtype']) && 
                    is_numeric($_GET['project_id']) && 
                    strcmp($_GET['view'], 'register') === 0 ){
                
                $dt = new DateTime('NOW');
                $dt = $dt->format('Y-m-d H:i:s');

                $projectProcessVO = new ProjectProcessVO();
                $projectProcessVO->setProject_id($_GET['project_id']);


                if ( isset ( $_POST['project_name'] ) && 
                    strlen( $_POST['project_name'] ) > 2 ){
                    $projectProcessVO->setProcess_name( $_POST['project_name'] );
                }
                else if ( isset( $_POST['project_name']) && 
                    strlen( $_POST['project_name']) <= 2 ){
                    $projectProcessVO->setProcess_name( -1 );
                }
                else if ( !isset( $_POST['project_name']) ){
                    $projectProcessVO->setProcess_name( -2 );
                }

                $projectProcessVO->setProcess_uuid( UUID::v4() );

                $projectProcessVO->setOrder_val( 0 );
                $projectProcessVO->setRegidate( $dt );
                $projectProcessVO->setIp( Network::get_client_ip() );

                $this->projectController->process_register_ok($projectProcessVO);

            }

            // 공정 수정
            else if ( isset($_GET['project_id']) && 
                isset($_GET['uuid']) && 
                isset($_GET['view']) && 
                is_numeric($_GET['project_id']) && 
                strcmp($_GET['view'], 'modify') === 0 ){
           
                // 수정 페이지
                if ( !isset($_POST['process_uuid']) && 
                     !isset($_POST['func']) && 
                     !isset($_POST['srtype']) && 
                     !isset($_POST['project_name']) && 
                     !isset($_POST['order_val'])){

                    $projectProcessVO = new ProjectProcessVO();
                    $projectProcessVO->setProject_id($_GET['project_id']);
                    $projectProcessVO->setProcess_uuid($_GET['uuid']);

                    $this->projectController->process_modify($projectProcessVO);

                }
                // 수정 진행 페이지
                else if ( isset($_POST['process_uuid']) && 
                         isset($_POST['func']) && 
                         isset($_POST['srtype']) && 
                         isset($_POST['project_name']) && 
                         isset($_POST['order_val']) && 
                         strcmp($_POST['func'], 'modify') === 0 &&  
                         strcmp($_POST['srtype'], 'submit') === 0){

                    $projectProcessVO = new projectProcessVO();
                    $projectProcessVO->setProject_id($_GET['project_id']);
                    $projectProcessVO->setProcess_uuid($_POST['process_uuid']);
                    $projectProcessVO->setOrder_val($_POST['order_val']);

                    if ( isset ( $_POST['project_name'] ) && 
                        strlen( $_POST['project_name'] ) > 2 ){
                        $projectProcessVO->setProcess_name( $_POST['project_name'] );
                    }
                    else if ( isset( $_POST['project_name']) && 
                        strlen( $_POST['project_name']) <= 2 ){
                        $projectProcessVO->setProcess_name( -1 );
                    }
                    else if ( !isset( $_POST['project_name']) ){
                        $projectProcessVO->setProcess_name( -2 );
                    }

                    $this->projectController->process_modify_ok($projectProcessVO);

                }

            }

            // 공정 삭제
            else if ( isset($_GET['project_id']) && 
                isset($_GET['uuid']) && 
                isset($_GET['view']) && 
                is_numeric($_GET['project_id']) && 
                strcmp($_GET['view'], 'delete') === 0 ){
                
                
                // 삭제 페이지
                if ( !isset($_POST['process_uuid']) && 
                     !isset($_POST['func']) && 
                     !isset($_POST['srtype']) && 
                     !isset($_POST['project_name']) && 
                     !isset($_POST['order_val'])){

                    $projectProcessVO = new ProjectProcessVO();
                    $projectProcessVO->setProject_id($_GET['project_id']);
                    $projectProcessVO->setProcess_uuid($_GET['uuid']);

                    $this->projectController->process_delete($projectProcessVO);

                }
                // 삭제 진행 페이지
                else if ( isset($_POST['process_uuid']) && 
                         isset($_POST['func']) && 
                         isset($_POST['srtype']) && 
                         strcmp($_POST['func'], 'delete') === 0 &&  
                         strcmp($_POST['srtype'], 'submit') === 0){

                    $projectProcessVO = new projectProcessVO();
                    $projectProcessVO->setProject_id($_GET['project_id']);
                    $projectProcessVO->setProcess_uuid($_POST['process_uuid']);
                    
                    $this->projectController->process_delete_ok($projectProcessVO);

                }

            }

            // 공정 목록
            else if ( isset($_GET['project_id']) && 
                 isset($_GET['view']) && 
                 is_numeric($_GET['project_id']) && 
                 strcmp($_GET['view'], 'list') === 0 ){

                $projectProcessVO = new ProjectProcessVO();
                $pageCri = new PageCriteria();

                $projectProcessVO->setProject_id($_GET['project_id']);

                // 페이지 설정
                if ($_GET['page'] >= 0 &&
                    is_numeric($_GET['page'])){
                    
                    $pageCri->setPage($_GET['page']);

                }

                $this->projectController->process_list($pageCri, $projectProcessVO);

            }

        }

        // 다운로드 기능
        else if ( strcmp( $_GET['func'], 'download') === 0 ){
                
            // 다운로드 페이지 호출
            if ( isset($_GET['uuid']) &&
                !isset($_GET['page']) ){
                
                $this->loadService();

                $smarty = $this->getSmarty();
                $smarty->clearAllCache();

                $projectFileVO = new ProjectFileVO();
                $projectFileVO->setUuid($_GET['uuid']);

                $fileitem = $this->project_service->selectFindUUIDProjectFile($projectFileVO);

                //echo "참1";

                //print_r($fileitem);
                if ( isset($fileitem) ){
                    $this->_download($fileitem);
                }

            }
            // 삭제 여부 페이지
            else if ( isset($_GET['uuid']) &&
                    isset($_GET['page']) && 
                    isset($_GET['project_id']) && 
                    strcmp( $_GET['page'], "delete") === 0 ){

                $this->projectController->project_file_delete();

            }
            
            //echo "참2";

        }
        
    }

    public function machine(){

        $this->loadController();
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        if ( isset( $_GET['type']) && 
            isset($_GET['func']) && 
            isset($_GET['sort']) ) {

            // DHT 센서(온습도 센서)
            if ( strcmp($_GET['type'], "sensor") === 0 && 
                strcmp($_GET['func'], "list") === 0 && 
                strcmp($_GET['sort'], "dht") === 0 ){
                
                $pageCri = new PageCriteria();

                // 페이지 설정
                if ($_GET['page'] >= 0 &&
                    is_numeric($_GET['page'])){
                    
                    $pageCri->setPage($_GET['page']);

                }

                if ( !isset($_GET['machine_id']) && 
                    !isset($_GET['startdate']) && 
                    !isset($_GET['enddate'])){
                    
                    $this->machineController->dht_list($pageCri);
                }

                else if ( isset($_GET['machine_id']) && 
                        isset($_GET['startdate']) && 
                        isset($_GET['enddate']) ){
                    
                    $dhtSpecificVO = new DhtSpecificVO();
                    $dhtSpecificVO->setMachine_id($_GET['machine_id']);
                    
                    $startDate = strtotime($_GET['startdate']);
                    $newStartDate = date('Y-m-d H:i:s', $startDate);
                    $dhtSpecificVO->setStartdate($newStartDate);
                    
                    $endDate = strtotime($_GET['enddate']);
                    $newEndDate = date('Y-m-d H:i:s', $endDate);
                    $dhtSpecificVO->setEnddate($newEndDate);

                    $this->machineController->dht_specific_list($dhtSpecificVO, $pageCri);
                }
                
            }

            // 충격 감지 센서
            else if ( strcmp($_GET['type'], "sensor") === 0 && 
                    strcmp($_GET['func'], "list") === 0 && 
                    strcmp($_GET['sort'], "shock") === 0 ){
                
                $pageCri = new PageCriteria();

                // 페이지 설정
                if ($_GET['page'] >= 0 &&
                    is_numeric($_GET['page'])){
                    
                    $pageCri->setPage($_GET['page']);

                }

                if ( !isset($_GET['machine_id']) && 
                    !isset($_GET['startdate']) && 
                    !isset($_GET['enddate'])){
                    
                    $this->machineController->shock_list($pageCri);
                }

                else if ( isset($_GET['machine_id']) && 
                        isset($_GET['startdate']) && 
                        isset($_GET['enddate']) ){
                    
                    $shockSpecificVO = new ShockSpecificVO();
                    $shockSpecificVO->setMachine_id($_GET['machine_id']);
                    
                    $startDate = strtotime($_GET['startdate']);
                    $newStartDate = date('Y-m-d H:i:s', $startDate);
                    $shockSpecificVO->setStartdate($newStartDate);
                    
                    $endDate = strtotime($_GET['enddate']);
                    $newEndDate = date('Y-m-d H:i:s', $endDate);
                    $shockSpecificVO->setEnddate($newEndDate);

                    $this->machineController->shock_specific_list($shockSpecificVO, $pageCri);

                }
                
            }
            // 초음파 센서
            else if ( strcmp($_GET['type'], "sensor") === 0 && 
                    strcmp($_GET['func'], "list") === 0 && 
                    strcmp($_GET['sort'], "ultrasonic") === 0 ){
            
                $pageCri = new PageCriteria();

                // 페이지 설정
                if ($_GET['page'] >= 0 &&
                    is_numeric($_GET['page'])){
                    
                    $pageCri->setPage($_GET['page']);

                }

                if ( !isset($_GET['machine_id']) && 
                    !isset($_GET['startdate']) && 
                    !isset($_GET['enddate'])){
                    
                    $this->machineController->ultrasonic_list($pageCri);
                }

                else if ( isset($_GET['machine_id']) && 
                        isset($_GET['startdate']) && 
                        isset($_GET['enddate']) ){
                    
                    $ultrasonicSpecificVO = new UltrasonicSpecificVO();
                    $ultrasonicSpecificVO->setMachine_id($_GET['machine_id']);
                    
                    $startDate = strtotime($_GET['startdate']);
                    $newStartDate = date('Y-m-d H:i:s', $startDate);
                    $ultrasonicSpecificVO->setStartdate($newStartDate);
                    
                    $endDate = strtotime($_GET['enddate']);
                    $newEndDate = date('Y-m-d H:i:s', $endDate);
                    $ultrasonicSpecificVO->setEnddate($newEndDate);

                    $this->machineController->ultrasonic_specific_list($ultrasonicSpecificVO, $pageCri);

                }
            
            }

        }

        // 장비 설정
        else if ( isset($_GET['func']) ){

            if ( strcmp($_GET['func'], "register") === 0 ){
                
                // 등록 페이지
                if ( !isset($_POST['func']) && 
                    !isset($_POST['srtype'])){
                    $this->machineController->machine_register();
                }

                // 등록 처리
                else if ( isset($_POST['func']) && 
                        isset($_POST['srtype']) && 
                        strcmp($_POST['func'], "input") === 0 &&
                        strcmp($_POST['srtype'], "submit") === 0 ){
                    
                    $dt = new DateTime('NOW');
                    $dt = $dt->format('Y-m-d H:i:s');
    
                    $machineVO = new MachineVO();
        
                    // 장비명
                    if (isset($_POST['machine_name']) && 
                        strlen($_POST['machine_name'] > 3)){
                        $machineVO->setMachine_name($_POST['machine_name']);
                    }else{
                        $machineVO->setMachine_name(-1);
                    }

                    // UUID 생성
                    $machineVO->setUuid(UUID::v4());

                    // 메모
                    if (isset($_POST['memo']) && 
                       strlen($_POST['memo'] > 3)){
                        $machineVO->setMemo($_POST['memo']);
                    }else{
                        $machineVO->setMemo(-1);
                    }

                    // 활성화 상태
                    if (isset($_POST['locked']) && 
                        (strcmp($_POST['locked'], "활성") !== -1 || 
                        strcmp($_POST['locked'], "비활성") !== -1 ) ){
                        $machineVO->setLocked($_POST['locked']);
                    }else{
                        $machineVO->setLocked(-1);
                    }
    
                    // 등록일자
                    $machineVO->setRegidate($dt);
                        
                    // IP주소
                    $machineVO->setIp(Network::get_client_ip());
    
                    $this->machineController->machine_register_ok($machineVO);

                }

            }
            else if ( strcmp($_GET['func'], "list") === 0 ){

                $pageCri = new PageCriteria();

                // 페이지 설정
                if ($_GET['page'] >= 0 &&
                    is_numeric($_GET['page'])){
                    
                    $pageCri->setPage($_GET['page']);

                }

                $this->machineController->machine_list($pageCri);

            }
            
            else if ( strcmp($_GET['func'], "modify") === 0 ){

                // 수정 페이지
                if (!isset($_POST['machine_id']) && 
                    !isset($_POST['uuid']) && 
                    !isset($_POST['func']) && 
                    !isset($_POST['srtype'])){
                    
                    $this->machineController->machine_modify();

                }
                // 수정 처리 프로세스
                else if(isset($_POST['machine_id']) && 
                        isset($_POST['uuid']) && 
                        isset($_POST['func']) && 
                        isset($_POST['srtype']) && 
                        strcmp($_POST['func'], "modify") === 0 && 
                        strcmp($_POST['srtype'], "submit") === 0 ){

                    $dt = new DateTime('NOW');
                    $dt = $dt->format('Y-m-d H:i:s');

                    $updateVo = new MachineVO();   // 변경될 계정 정보

                    // 계정 번호
                    $updateVo->setMachine_id($_POST['machine_id']);

                    // 장치명
                    if (isset($_POST['machine_name']) && 
                        strlen($_POST['machine_name'] > 3)){
                        $updateVo->setMachine_name($_POST['machine_name']);
                    }else{
                        $updateVo->setMachine_name(-1);
                    }

                    // UUID
                    if (isset($_POST['uuid'])){
                        $updateVo->setUuid($_POST['uuid']);
                    }else{
                        $updateVo->setUuid(-1);
                    }

                    // 메모
                    if (isset($_POST['memo']) && 
                        strlen($_POST['memo'] > 3)){
                        $updateVo->setMemo($_POST['memo']);
                    }else{
                        $updateVo->setMemo(-1);
                    }

                    // 활성화 상태
                    if (isset($_POST['locked']) && 
                        (strcmp($_POST['locked'], "활성") !== -1 || 
                        strcmp($_POST['locked'], "비활성") !== -1 ) ){
                        $updateVo->setLocked($_POST['locked']);
                    }else{
                        $updateVo->setLocked(-1);
                    }

                    // 등록 일자
                    $updateVo->setRegidate($dt);
                    
                    $this->machineController->machine_modify_ok($updateVo);

                }

            }
            else if ( strcmp($_GET['func'], "delete") === 0 ){

                // 삭제 페이지
                if (!isset($_POST['machine_id']) && 
                    !isset($_POST['uuid']) && 
                    !isset($_POST['func']) && 
                    !isset($_POST['srtype'])){
                    
                    $this->machineController->machine_delete();

                }
                // 삭제 처리 프로세스
                else if(isset($_POST['machine_id']) && 
                        isset($_POST['uuid']) && 
                        isset($_POST['func']) && 
                        isset($_POST['srtype']) && 
                        strcmp($_POST['func'], "delete") === 0 && 
                        strcmp($_POST['srtype'], "submit") === 0 ){

                    
                    $currentVo = new MachineVO();   // 변경될 계정 정보

                    // 계정 번호
                    $currentVo->setMachine_id($_POST['machine_id']);

                    // UUID
                    if (isset($_POST['uuid'])){
                        $currentVo->setUuid($_POST['uuid']);
                    }else{
                        $currentVo->setUuid(-1);
                    }

                    $this->machineController->machine_delete_ok($currentVo);

                }

            }

        }

    }

    public function config(){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $root_dir = $this->getRootDir();
        $smarty->setTemplateDir($root_dir . '/view/main/core');
        $this->setSmarty($smarty);

        $smarty->clearAllCache();
        
        
        $smarty->assign("title", "환경설정:::Smart Logistics");
        $smarty->assign("session_emp_no", $_SESSION['emp_no']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('main_notice.tpl');

    }

    
    public function member(){
        
        $this->loadController();
        $this->loadService();
        $this->templateDir();
        
        //echo isset($_POST['func']) . "/" ;

        if ( strcmp( $_GET['func'], 'register' ) === 0 ){
            
            // 계정 추가 페이지
            if (!isset($_POST['func'])){
                $this->configController->member_register();
            }

            // 계정 추가 처리 프로세스
            else if (isset($_POST['func']) && 
                    isset($_POST['srtype']) &&
                    strcmp($_POST['func'], 'input') === 0 &&
                    strcmp($_POST['srtype'], 'submit') === 0){
                
                $dt = new DateTime('NOW');
                $dt = $dt->format('Y-m-d H:i:s');

                $memberVO = new MemberVO();

                // 이메일 주소
                if (isset($_POST['email']) && 
                    PregMatch::mail_check($_POST['email']) === true ){
                    
                    $memberVO->setEmail($_POST['email']);

                }else if (isset($_POST['email']) && 
                    PregMatch::mail_check($_POST['email']) === false ){

                    $memberVO->setEmail(-1);

                }else{
                    $memberVO->setEmail(-2);
                }

                // 이메일 주소 중복확인
                $resultMember = $this->member_service->selectMember($memberVO);
                if (isset($resultMember)){
                    $memberVO->setEmail(-3);
                }

                // 사용자 권한
                if (isset($_POST['member_auth'])){
                    $memberVO->setMember_auth($_POST['member_auth']);
                }else{
                    $memberVO->setMember_auth(-1);
                }

                // 사용자명
                if (isset($_POST['usrname']) && 
                    strlen($_POST['usrname'] > 3)){
                    $memberVO->setUsrname($_POST['usrname']);
                }else{
                    $memberVO->setUsrname(-1);
                }

                // 비밀번호
                if (isset($_POST['passwd1']) &&
                    isset($_POST['passwd2']) &&
                    ( strcmp($_POST['passwd1'], $_POST['passwd2']) === 0) &&
                     strlen($_POST['passwd1']) > 4 ){
                    
                    $passwd = base64_encode( hash('sha256', $_POST["passwd1"], true) );
                    $memberVO->setPasswd($passwd);
                }
                // 비밀번호 길이가 일치하지 않을 때
                else if (isset($_POST['passwd1']) &&
                        isset($_POST['passwd2']) &&
                        ( strcmp($_POST['passwd1'], $_POST['passwd2']) === 0) &&
                        strlen($_POST['passwd1']) <= 4 ){
                    
                    $memberVO->setPasswd(-1);
                }
                // 비밀번호가 비어있을 때
                else if (!isset($_POST['passwd1']) || 
                          !isset($_POST['passwd2'])){
                    $memberVO->setPasswd(-2);
                }
                // 비밀번호가 일치하지 않을 때
                else if (isset($_POST['passwd1']) &&
                        isset($_POST['passwd2']) &&
                        strcmp($_POST['passwd1'], $_POST['passwd2']) !== 0){
                    $memberVO->setPasswd(-3);
                }
                // 원인을 알수 없는 비밀번호 오류
                else{
                    $memberVO->setPasswd(-4);
                }

                // 등록일자
                $memberVO->setRegidate($dt);
                
                // 수정일자
                $memberVO->setModify_date($dt);

                // 락 설정
                $memberVO->setLocked("활성");

                //echo $memberVo->getLocked() . "참";

                // IP주소
                $memberVO->setIp(Network::get_client_ip());

                //echo "참2";

                $this->configController->member_register_ok($memberVO);

            }

        }else if ( strcmp( $_GET['func'], 'list' ) === 0 ){
            
            $pageCri = new PageCriteria();

            // 페이지 설정
            if ($_GET['page'] >= 0 &&
                is_numeric($_GET['page'])){
                
                $pageCri->setPage($_GET['page']);

            }

            $this->configController->member_list($pageCri);

        }else if ( strcmp( $_GET['func'], 'modify' ) === 0 ){

            // 계정 수정 페이지
            if (!isset($_POST['func']) && 
                isset($_GET['id'])){
                $this->configController->member_modify();
            }

            // 계정 수정 프로세스
            else if (isset($_POST['func']) && 
                    isset($_POST['srtype']) &&
                    strcmp($_POST['func'], 'modify') === 0 &&
                    strcmp($_POST['srtype'], 'submit') === 0 &&
                    isset($_POST['idx']) &&
                    isset($_POST['email'])){

                $dt = new DateTime('NOW');
                $dt = $dt->format('Y-m-d H:i:s');

                $currentVo = new MemberVO();  // 기존 계정 정보
                $updateVo = new MemberVO();   // 변경될 계정 정보

                // 계정 번호
                $currentVo->setMember_id($_POST['idx']);
                $updateVo->setMember_id($_POST['idx']);

                // 계정 이메일
                $currentVo->setEmail($_POST['email']);
                $updateVo->setEmail($_POST['email']);

                //echo "참9/". $_POST['idx'];

                // 사용자 권한
                if (isset($_POST['member_auth'])){
                    $updateVo->setMember_auth($_POST['member_auth']);
                    //echo "참1/" . $_POST['member_auth'];
                }else{
                    $updateVo->setMember_auth(-1);
                    // echo "거짓1";
                }

                // 사용자명
                if (isset($_POST['usrname']) && 
                    strlen($_POST['usrname'] > 3)){
                    $updateVo->setUsrname($_POST['usrname']);
                }else{
                    $updateVo->setUsrname(-1);
                }

                // 신규 비밀번호
                if (isset($_POST['passwd1']) &&
                    isset($_POST['passwd2']) &&
                    ( strcmp($_POST['passwd1'], $_POST['passwd2']) === 0) &&
                     strlen($_POST['passwd1']) > 4 ){
                    
                    $passwd = base64_encode( hash('sha256', $_POST["passwd1"], true) );
                    $updateVo->setPasswd($passwd);
                }
                // 신규 비밀번호
                else if (isset($_POST['passwd1']) &&
                        isset($_POST['passwd2']) &&
                        ( strcmp($_POST['passwd1'], $_POST['passwd2']) === 0) &&
                        strlen($_POST['passwd1']) <= 4 ){
                    
                    $updateVo->setPasswd(-1);
                }
                // 신규 비밀번호가 비어있을 때
                else if (!isset($_POST['passwd1']) || 
                          !isset($_POST['passwd2'])){
                    $updateVo->setPasswd(-2);
                }
                // 신규 비밀번호가 일치하지 않을 때
                else if (isset($_POST['passwd1']) &&
                        isset($_POST['passwd2']) &&
                        strcmp($_POST['passwd1'], $_POST['passwd2']) !== 0){
                    $updateVo->setPasswd(-3);
                }
                // 원인을 알수 없는 신규 비밀번호 오류
                else{
                    $updateVo->setPasswd(-4);
                }

                // 활성화 상태
                if (isset($_POST['locked']) && 
                    (strcmp($_POST['locked'], "활성") !== -1 || 
                     strcmp($_POST['locked'], "비활성") !== -1 ) ){
                    $updateVo->setLocked($_POST['locked']);
                }else{
                    $updateVo->setLocked(-1);
                }

                // 수정일자
                $updateVo->setModify_date($dt);

               $this->configController->member_modify_ok($currentVo, $updateVo);

            }

        }else if ( strcmp( $_GET['func'], 'delete' ) === 0 ){
            
            // 계정 삭제 페이지
            if (!isset($_POST['func']) && 
                isset($_GET['id'])){
                
                $this->configController->member_delete();

            }
            // 계정 삭제 프로세스
            else if (isset($_POST['func']) && 
                    isset($_POST['srtype']) &&
                    strcmp($_POST['func'], 'delete') === 0 &&
                    strcmp($_POST['srtype'], 'submit') === 0 &&
                    isset($_POST['idx']) && 
                    isset($_POST['email'])){

                $currentVo = new MemberVO();  // 기존 계정 정보

                // 계정 이메일 주소
                $currentVo->setEmail($_POST['email']);

                $this->configController->member_delete_ok($currentVo);

            }

        }

    }

    public function member_auth(){

        $this->loadController();
        $this->loadService();
        $this->templateDir();

        // 장비 설정
        if ( isset($_GET['func']) ){

            if ( strcmp($_GET['func'], "register") === 0 ){
                
                // 등록 페이지
                if ( !isset($_POST['func']) && 
                    !isset($_POST['srtype'])){
                    
                    $this->configController->member_auth_register();

                }

                // 등록 처리
                else if ( isset($_POST['func']) && 
                        isset($_POST['srtype']) && 
                        strcmp($_POST['func'], "input") === 0 &&
                        strcmp($_POST['srtype'], "submit") === 0 ){
                    
                    $memberAuthVO = new MemberAuthVO();

                    $dt = new DateTime('NOW');
                    $dt = $dt->format('Y-m-d H:i:s');

                    // 권한명
                    if (isset($_POST['auth_name']) && 
                        strlen($_POST['auth_name'] > 3)){
                        $memberAuthVO->setAuth_name($_POST['auth_name']);
                    }else{
                        $memberAuthVO->setAuth_name(-1);
                    }

                    $this->configController->member_auth_register_ok($memberAuthVO);

                }

            }

            else if ( strcmp($_GET['func'], "list") === 0 ){
                                
                $pageCri = new PageCriteria();

                // 페이지 설정
                if ($_GET['page'] >= 0 &&
                    is_numeric($_GET['page'])){
                    
                    $pageCri->setPage($_GET['page']);

                }

                $this->configController->member_auth_list($pageCri);

            }

            else if ( strcmp($_GET['func'], "modify") === 0 ){

                // 수정 페이지
                if ( !isset($_POST['func']) && 
                    !isset($_POST['srtype'])){
                    
                    $this->configController->member_auth_modify();

                }

                // 수정 처리 프로세스
                else if ( isset($_POST['func']) && 
                        isset($_POST['srtype']) && 
                        strcmp($_POST['func'], "modify") === 0 &&
                        strcmp($_POST['srtype'], "submit") === 0 ){
                    
                    $memberAuthVO = new MemberAuthVO();

                    $dt = new DateTime('NOW');
                    $dt = $dt->format('Y-m-d H:i:s');

                    if (isset($_POST['id'])){
                        $memberAuthVO->setId($_POST['id']);
                    }else{
                        $memberAuthVO->setId(-1);
                    }

                    // 권한명
                    if (isset($_POST['auth_name']) && 
                        strlen($_POST['auth_name'] > 3)){
                        $memberAuthVO->setAuth_name($_POST['auth_name']);
                    }else{
                        $memberAuthVO->setAuth_name(-1);
                    }

                    $this->configController->member_auth_modify_ok($memberAuthVO);

                }

            }
            else if ( strcmp($_GET['func'], "delete") === 0 ){

                // 삭제 페이지
                if ( !isset($_POST['func']) && 
                    !isset($_POST['srtype'])){
                    
                    $this->configController->member_auth_delete();

                }

                // 삭제 처리 프로세스
                else if ( isset($_POST['func']) && 
                        isset($_POST['srtype']) && 
                        strcmp($_POST['func'], "delete") === 0 &&
                        strcmp($_POST['srtype'], "submit") === 0 ){
                    
                    $memberAuthVO = new MemberAuthVO();

                    $dt = new DateTime('NOW');
                    $dt = $dt->format('Y-m-d H:i:s');

                    if (isset($_POST['id'])){
                        $memberAuthVO->setId($_POST['id']);
                    }else{
                        $memberAuthVO->setId(-1);
                    }

                    // 권한명
                    if (isset($_POST['auth_name']) && 
                        strlen($_POST['auth_name'] > 3)){
                        $memberAuthVO->setAuth_name($_POST['auth_name']);
                    }else{
                        $memberAuthVO->setAuth_name(-1);
                    }

                    $this->configController->member_auth_delete_ok($memberAuthVO);

                }

            }

        }

    }

    public function board(){

        $this->loadController();
        $this->templateDir();

        if ( !isset( $_GET['func'] ) ){
            exit;
        }

        if ( isset( $_GET['func'] ) && 
             isset( $_GET['boardname'] ) ){
            
            // 목록
            if ( strcmp( $_GET['func'], 'list') === 0 ){

                $boardVO = new BoardVO();
                $pageCri = new PageCriteria();
                
                // 페이지 설정
                if ($_GET['page'] >= 0 &&
                    is_numeric($_GET['page'])){
                        
                        $pageCri->setPage($_GET['page']);
                        
                }
                
                $boardVO->setBoardname($_GET['boardname']);
                
                $this->boardController->board_list($boardVO, $pageCri);

            }
            // 글쓰기
            else if ( strcmp( $_GET['func'], 'write') === 0 ){

                // 글쓰기 페이지
                if ( !isset($_POST['func']) && 
                     !isset($_POST['srtype']) ){

                    $boardVO = new BoardVO();
                    $boardVO->setBoardname($_GET['boardname']);
    
                    $this->boardController->board_write($boardVO);

                }
                // 글 쓰기 처리
                else if ( isset($_POST['func']) && 
                          isset($_POST['srtype']) && 
                          strcmp($_POST['func'], 'input') === 0 &&
                          strcmp($_POST['srtype'], 'submit') === 0 ){
                    
                    $status = 1;
                    $file_chk = "NORMAL";

                    $boardFileArr = array();

                    $dt = new DateTime('NOW');
                    $dt = $dt->format('Y-m-d H:i:s');

                    $boardVO = new BoardVO();

                    // 게시판명 설정
                    $boardVO->setBoardname($_GET['boardname']);
                    

                    if ( isset( $_POST['nickname'] ) && 
                        strlen( $_POST['nickname'] ) > 2 && 
                        $status === 1){
                        
                        $boardVO->setNickname($_POST['nickname']);

                    }else if ( isset( $_POST['nickname'] ) && 
                        strlen( $_POST['nickname'] ) <= 2 && 
                        $status === 1){
                        $boardVO->setNickname(-1);
                        $status = -1;
                    }else if ( !isset( $_POST['nickname']) && 
                        $status === 1){
                        $boardVO->setNickname(-2);
                        $status = -2;
                    }

                    if ( isset( $_POST['subject']) && 
                        strlen( $_POST['subject']) > 2 && 
                        $status === 1){
                        $boardVO->setSubject( Xss::xss_clean( $_POST['subject']) );
                    }else if ( isset( $_POST['subject']) && 
                        strlen($_POST['subject'] ) <= 2  && 
                        $status === 1 ){
                        $boardVO->setSubject(-1);
                        $status = -3;
                    }else if ( !isset( $_POST['subject'] )){
                        $boardVO->setSubject(-2);
                        $status = -4;
                    }

                    if ( isset( $_POST['memo']) && 
                        strlen( $_POST['memo']) > 2 && 
                        $status === 1){
                        $boardVO->setMemo( Xss::xss_clean( $_POST['memo']) );
                    }else if ( isset( $_POST['memo']) && 
                        strlen($_POST['memo'] ) <= 2  && 
                        $status === 1 ){
                        $boardVO->setMemo(-1);
                        $status = -5;
                    }else if ( !isset( $_POST['memo'] )){
                        $boardVO->setMemo(-2);
                        $status = -6;
                    }

                    // 멤버 ID(노출 금지)
                    $boardVO->setMember_id( $_SESSION['member_id'] );
                    
                    // 이메일 주소
                    $boardVO->setEmail( $_SESSION['email'] );

                    // 등록일자
                    $boardVO->setRegidate($dt);
                    
                    // IP주소
                    $boardVO->setIp(Network::get_client_ip());

                    // 조회수
                    $boardVO->setCnt(0);

                    // 파일 옵션
                    $boardVO->setFile_option("NORMAL");

                    // echo $projectVO->getProject_name() . "/" . $projectVO->getStartdate() . "<br>";

                    if ( $status === 1 ){

                        // 파일 업로드
                        foreach($_FILES['usrupload']['name'] as $f => $name){

                            $boardFileVO = new BoardFileVO();

                            $root_dir = $this->getRootDir();
                            $upload_dir = $this->getUploadDir() . "/board";
                            $uuid = UUID::v4();
                            $upload_dir_fullpath = $root_dir . $upload_dir;
                            $upload_dir_uuid_fullpath = $upload_dir_fullpath . "/" . $uuid;

                            $name = $_FILES['usrupload']['name'][$f];
                            $uploadName = explode('.', $name);

                            $fileName = time(). $f . "." . $uploadName[1];
                            $uploadRealName = $upload_dir_uuid_fullpath . "/" . $fileName;
                            $originalName = $_FILES['usrupload']['name'][$f];
                            $fileSize = $_FILES['usrupload']['size'][$f];
                            $fileExt = $uploadName[1];
                            $fileType = $_FILES['usrupload']['type'][$f];
                            
                            //echo $fileName . ",";
                            //echo $originalName. "," . $fileSize . "," . $fileExt . "," . $fileType . "<br>";

                            //echo $uploadRealName;

                            // 파일 정보 입력
                            $boardFileVO->setUuid($uuid);
                            $boardFileVO->setRoot_dir($root_dir);
                            $boardFileVO->setUpload_dir($upload_dir);
                            $boardFileVO->setFile_ext($fileExt);
                            $boardFileVO->setFile_size($fileSize);
                            $boardFileVO->setOriginal_name($originalName);
                            $boardFileVO->setFile_name($fileName);
                            $boardFileVO->setFile_type($fileType);
                            $boardFileVO->setRegidate($dt);
                            $boardFileVO->setIp(Network::get_client_ip());
                            

                            //echo $fileExt;

                            //echo $uploadName;

                            if ( strcmp( $file_chk, "NORMAL") === 0 &&
                                FileUtil::checkFileExtRestrict($fileExt) === 1){
                                $file_chk = "RESTRICT";
                                $boardVO->setFile_option("RESTRICT");
                            }

                            
                            if ( strcmp( $file_chk, "NORMAL") === 0 &&
                                $this->getUploadSize() < $fileSize){
                                $file_chk = "RESTRICT";
                                $boardVO->setFile_option("RESTRICT");
                            }


                            // 파일 서버 전송
                            if ( strlen($originalName) != 0 && 
                                strcmp( $file_chk, "RESTRICT" ) !== 0 ){
                                
                                if(!is_dir( $upload_dir_fullpath )){
                                    mkdir( $upload_dir_fullpath );
                                }

                                if(!is_dir( $upload_dir_uuid_fullpath )){
                                    mkdir( $upload_dir_uuid_fullpath );
                                }

                                if (move_uploaded_file($_FILES['usrupload']['tmp_name'][$f], $uploadRealName)){
                                    //echo "success";

                                    /*
                                    // 파일 삭제
                                    if ( is_file($uploadRealName) ){
                                        unlink($uploadRealName);
                                    }

                                    // 폴더 삭제
                                    rmdir($upload_dir_uuid_fullpath);   // 임시 삭제
                                    */
                                    $boardFileVO->setOption("success");

                                }else{
                                    //echo "error";
                                    $boardFileVO->setOption("error");
                                }

                            }

                            // 파일정보 배열로 입력
                            if(strlen($originalName) != 0 && 
                                strcmp( $file_chk, "RESTRICT") !== 0){
                                array_push($boardFileArr, $boardFileVO);
                            }

                        }

                    }

                    $this->boardController->board_write_ok($boardVO, $boardFileArr);

                }

            }
            // 글 보기
            else if ( strcmp( $_GET['func'], 'view') === 0 ){

                $boardVO = new BoardVO();
                $boardVO->setArticle_id($_GET['id']);
                $boardVO->setBoardname($_GET['boardname']);

                $this->boardController->board_view($boardVO);

            }
            // 글 수정
            else if ( strcmp( $_GET['func'], 'modify') === 0 ){
                
                // 글수정 페이지
                if ( !isset($_POST['func']) && 
                     !isset($_POST['srtype']) ){
                
                    $boardVO = new BoardVO();
                    $boardVO->setArticle_id($_GET['id']);
                    $boardVO->setBoardname($_GET['boardname']);

                    $this->boardController->board_modify($boardVO);
                
                }
                // 글 수정 진행
                else if ( isset($_POST['func']) && 
                        isset($_POST['srtype']) && 
                    strcmp($_POST['func'], 'modify') === 0 && 
                    strcmp($_POST['srtype'], 'submit') === 0 ){
                                        
                    $status = 1;
                    $file_chk = "NORMAL";

                    $boardFileArr = array();
                    $dt = new DateTime('NOW');
                    $dt = $dt->format('Y-m-d H:i:s');

                    $boardVO = new BoardVO();

                    $boardVO->setBoardname($_GET['boardname']);
                    $boardVO->setArticle_id($_GET['id']);

                    if ( isset( $_POST['nickname'] ) && 
                        strlen( $_POST['nickname'] ) > 2 && 
                        $status === 1){
                        $boardVO->setNickname($_POST['nickname']);

                    }else if ( isset( $_POST['nickname'] ) && 
                        strlen( $_POST['nickname'] ) <= 2 && 
                        $status === 1){
                        $boardVO->setNickname(-1);
                        $status = -1;
                    }else if ( !isset( $_POST['nickname'] ) && 
                        $status === 1) {
                        $boardVO->setNickname(-2);
                        $status = -2;
                    }

                    if ( isset( $_POST['subject'] ) &&
                        strlen( $_POST['subject']) > 2 && 
                        $status === 1){
                        $boardVO->setSubject( Xss::xss_clean( $_POST['subject'] ) );
                    }else if( isset( $_POST['subject'] ) &&
                        strlen( $_POST['subject']) <= 2 && 
                        $status === 1 ){
                        $boardVO->setSubject(-1);
                        $status = -3;
                    }else if ( !isset( $_POST['subject']) && 
                        $status === 1){
                        $boardVO->setSubject(-2);
                        $status = -4;
                    }

                    if ( isset( $_POST['memo'] ) &&
                        strlen( $_POST['memo']) > 2 && 
                        $status === 1){
                        $boardVO->setMemo( Xss::xss_clean( $_POST['memo'] ) );
                    }else if( isset( $_POST['memo'] ) &&
                        strlen( $_POST['memo']) <= 2 && 
                        $status === 1 ){
                        $boardVO->setMemo(-1);
                        $status = -5;
                    }else if ( !isset( $_POST['memo']) && 
                        $status === 1){
                        $boardVO->setMemo(-2);
                        $status = -6;
                    }

                    // 등록일자
                    $boardVO->setRegidate($dt);

                    // IP주소
                    $boardVO->setIp(Network::get_client_ip());

                    // 파일 옵션
                    $boardVO->setFile_option("NORMAL");

                    // echo $projectVO->getProject_name() . "/" . $projectVO->getStartdate() . "<br>";

                    if ( $status === 1 ){

                        // 파일 업로드
                        foreach($_FILES['usrupload']['name'] as $f => $name){


                            $boardFileVO = new BoardFileVO();

                            $root_dir = $this->getRootDir();
                            $upload_dir = $this->getUploadDir() . "/board";
                            $uuid = UUID::v4();
                            $upload_dir_fullpath = $root_dir . $upload_dir;
                            $upload_dir_uuid_fullpath = $upload_dir_fullpath . "/" . $uuid;

                            $name = $_FILES['usrupload']['name'][$f];
                            $uploadName = explode('.', $name);

                            $fileName = time(). $f . "." . $uploadName[1];
                            $uploadRealName = $upload_dir_uuid_fullpath . "/" . $fileName;
                            $originalName = $_FILES['usrupload']['name'][$f];
                            $fileSize = $_FILES['usrupload']['size'][$f];
                            $fileExt = $uploadName[1];
                            $fileType = $_FILES['usrupload']['type'][$f];
                            
                            //echo $fileName . ",";
                            //echo $originalName. "," . $fileSize . "," . $fileExt . "," . $fileType . "<br>";

                            //echo $uploadRealName;

                            // 파일 정보 입력
                            $boardFileVO->setUuid($uuid);
                            $boardFileVO->setRoot_dir($root_dir);
                            $boardFileVO->setUpload_dir($upload_dir);
                            $boardFileVO->setFile_ext($fileExt);
                            $boardFileVO->setFile_size($fileSize);
                            $boardFileVO->setOriginal_name($originalName);
                            $boardFileVO->setFile_name($fileName);
                            $boardFileVO->setFile_type($fileType);
                            $boardFileVO->setRegidate($dt);
                            $boardFileVO->setIp(Network::get_client_ip());
                            

                            //echo $fileExt;

                            //echo $uploadName;

                            if ( strcmp( $file_chk, "NORMAL") === 0 &&
                                FileUtil::checkFileExtRestrict($fileExt) === 1){
                                $file_chk = "RESTRICT";
                                $boardVO->setFile_option("RESTRICT");
                            }

                            
                            if ( strcmp( $file_chk, "NORMAL") === 0 &&
                                $this->getUploadSize() < $fileSize){
                                $file_chk = "RESTRICT";
                                $boardVO->setFile_option("RESTRICT");
                            }

                            // 파일 서버 전송
                            if ( strlen($originalName) != 0 && 
                                strcmp( $file_chk, "RESTRICT" ) !== 0 ){
                                
                                if(!is_dir( $upload_dir_fullpath )){
                                    mkdir( $upload_dir_fullpath );
                                }

                                if(!is_dir( $upload_dir_uuid_fullpath )){
                                    mkdir( $upload_dir_uuid_fullpath );
                                }

                                if(!is_uploaded_file($_FILES['usrupload']['tmp_name'][$f])) { 
                                    echo "HTTP로 전송된 파일이 아닙니다."; 
                                } else {

                                    if (move_uploaded_file($_FILES['usrupload']['tmp_name'][$f], $uploadRealName)){
                                        //echo "success";

                                        /*
                                        // 파일 삭제
                                        if ( is_file($uploadRealName) ){
                                            unlink($uploadRealName);
                                        }

                                        // 폴더 삭제
                                        rmdir($upload_dir_uuid_fullpath);   // 임시 삭제
                                        */
                                        $boardFileVO->setOption("success");

                                    }else{
                                        //echo "error";
                                        $boardFileVO->setOption("error");
                                    }

                                }

                            }

                            // 파일정보 배열로 입력
                            if(strlen($originalName) != 0 && 
                                strcmp( $file_chk, "RESTRICT") !== 0){
                                array_push($boardFileArr, $boardFileVO);
                            }

                        }

                    }

                    $this->boardController->board_modify_ok($boardVO, $boardFileArr);

                }

            }
            // 삭제 기능
            else if ( strcmp( $_GET['func'], 'delete') === 0 ){

                // 글 삭제 페이지
                if ( !isset($_POST['func']) && 
                     !isset($_POST['srtype']) ){

                    $boardVO = new BoardVO();
                    $boardVO->setArticle_id($_GET['id']);
                    $boardVO->setBoardname($_GET['boardname']);

                    $this->boardController->board_delete($boardVO);
                    
                }
                // 글 삭제 진행 페이지
                else if ( isset($_POST['func']) && 
                        isset($_POST['srtype']) && 
                        strcmp($_POST['func'], 'delete') === 0 && 
                        strcmp($_POST['srtype'], 'submit') === 0){
                    
                    $boardVO = new BoardVO();

                    $boardVO->setBoardname( $_GET['boardname'] );

                    if ( isset($_GET['id']) && 
                        is_numeric($_GET['id']) ){

                        $boardVO->setArticle_id($_GET['id']);

                    }else if ( isset($_GET['id']) && 
                            !is_numeric($_GET['id']) ){
                        $boardVO->setArticle_id(-1);
                    }
                    else if ( !isset($_GET['id']) ) {
                        $boardVO->setArticle_id(-2);
                    }

                    $this->boardController->board_delete_ok($boardVO);

                }

            }
            // 다운로드 기능
            else if ( strcmp( $_GET['func'], 'download') === 0 ){
                    
                // 다운로드 페이지 호출
                if ( isset($_GET['uuid']) &&
                    !isset($_GET['page']) ){
                    
                    $this->loadService();

                    $smarty = $this->getSmarty();
                    $smarty->clearAllCache();

                    $boardFileVO = new BoardFileVO();
                    $boardFileVO->setUuid($_GET['uuid']);
                    $boardFileVO->setBoardname($_GET['boardname']);

                    $fileitem = $this->board_service->selectFindUUIDBoardFile($boardFileVO);

                    //echo "참1";

                    //print_r($fileitem);
                    if ( isset($fileitem) ){
                        $this->_download($fileitem);
                    }

                }   

            }

        }

    }
    
    

    // public function download(){

    //     $this->templateDir();
    //     $this->loadService();

    //     $smarty = $this->getSmarty();
    //     $smarty->clearAllCache();

    //     $projectFileVO = new ProjectFileVO();
    //     $projectFileVO->setUuid($_GET['uuid']);

    //     $fileitem = $this->board_service->selectBoardFileDetail($boardFileVO);

    //     //print_r($fileitem);
    //     $this->_download($fileitem);

    // }

    private function _download($fileitem){

        $upload_dir = $fileitem['upload_dir'];
        $original_name = $fileitem['original_name'];
        $filename = $fileitem['file_name'];
        $uuid = $fileitem['uuid'];

        $target_Dir = $upload_dir . "/" . $uuid;
        $file = $this->getRootDir() . $target_Dir ."/" . $filename;

        //echo $file;

        $filesize = filesize($file);

        header("Pragma: public");
        header("Expires: 0");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$original_name\"");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: $filesize");

        readfile($file);

    }
    
}

?>