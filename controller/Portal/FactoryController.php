<?php
/*
 * Created Date: 2022-06-10 (Fri)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Controller
 * Filename: FactoryController.php
 * Description:
 * - 1. 서비스 추가(품목 코드 찾기), 정도윤(Doyun Jung), 2022-06-12(Sun)
 * - 2. 검색(키워드) 반영, 정도윤, 2022-06-27(Mon)
 */

class FactoryController extends Controller {

    
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
        
        $smarty->assign("title", "생산/입고:::Smart premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('input_page.tpl');
        
    }

    public function input_search(){

        $this->templateDir();
        $smarty = $this->getSmarty();
        $smarty->clearAllCache();
        
        $smarty->display('input_search.tpl');

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

        $smarty->assign("productList", $productList);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);
        $smarty->display('input_search_result.tpl');

    }

    public function input_submit_ok($warehouseVO){

        $result = 0;

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        //print_r($warehouseVO);

        //$result = $this->warehouse_service->insertGoods($warehouseVO);

        
        //echo "3번:" . $warehouseVO->getProduct_no() . "/" . $warehouseVO->getProduct_cnt() . "<br>";

        // 품목코드와 수량이 존재할 때
        if ( $warehouseVO->getProduct_no() !== -1 &&
            $warehouseVO->getProduct_cnt() !== -1 ){

            $result = $this->warehouse_service->insertWarehouse($warehouseVO);

            // 생산품 등록이 정상적으로 수행되었을 때
            if ( $result === 1){

                $tmpWarehouseRow = $this->warehouse_service->selectWarehouse($warehouseVO);

                //print_r($tmpWarehouseRow);

                $tmpWarehouseLogVO = new WarehouseLogVO();
                
                //echo "/" . $tmpWarehouseRow[0]["id"] . "/" . isset($tmpWarehouseRow) . "<br>"; 

                if ( isset($tmpWarehouseRow)){
 
                    $tmpWarehouseLogVO->setW_id($tmpWarehouseRow[0]["id"]);
                    $tmpWarehouseLogVO->setPrev_w_id($tmpWarehouseRow[0]["id"]);
                    $tmpWarehouseLogVO->setPrev_cnt($tmpWarehouseRow[0]["product_cnt"]);
                    $tmpWarehouseLogVO->setRelease_cnt(0);
                    
                    $tmpWarehouseLogVO->setCurrent_cnt($tmpWarehouseRow[0]["product_cnt"]);
                    $tmpWarehouseLogVO->setCurrent_type("신규");
                    $tmpWarehouseLogVO->setRelease_type("해당없음");
                    $tmpWarehouseLogVO->setRelease_date($tmpWarehouseRow[0]["create_date"]);
                    $tmpWarehouseLogVO->setIp($tmpWarehouseRow[0]["ip"]);

                    
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

        $smarty->assign("warehouseLogList", $warehouseLogRows);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);
        $smarty->assign("title", "생산/출고:::Smart Premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('output_page.tpl');
        
        
    }

    public function output_search_result($pageCri, $keyword){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();
        
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

        $smarty->assign("warehouseLogList", $warehouseLogRows);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);
        $smarty->assign("title", "생산/출고:::Smart Premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('output_page.tpl');
        
        
    }
    
    public function output_release(){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $warehouseLogVo = new WarehouseLogVO();
        $warehouseLogVo->setId($_GET['id']);

        $warehouse_rows = $this->warehouse_service->selectOneWarehouseLog($warehouseLogVo);
        
        $title = "생산/출고 - " . $warehouse_rows[0]["w_id"] .  
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
        $smarty->display('output_release.tpl');

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
            echo "location.replace('../portal/factory?func=output');";
            echo "</script>";
            exit;

        }

    }

}

?>