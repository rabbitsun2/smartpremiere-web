<?php
/*
 * Created Date: 2022-07-29 (Fri)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Controller
 * Filename: MachineController.php
 * Description:
 *  1. 센서 조회 기능 추가, 정도윤, 2022-07-29 (Fri).
 * 
 */

class MachineController extends Controller {
 
    private $machine_service;
    private $dht_service;
    private $shock_service;
    private $ultrasonic_service;

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
        
        $this->machine_service = new MachineServiceImpl();
        $this->dht_service = new DhtServiceImpl();
        $this->shock_service = new ShockSensorServiceImpl();
        $this->ultrasonic_service = new UltrasonicSensorServiceImpl();

        $my_conn = $this->getConn();

        $this->machine_service->setConn($my_conn);
        $this->dht_service->setConn($my_conn);
        $this->shock_service->setConn($my_conn);
        $this->ultrasonic_service->setConn($my_conn);
        //print_r($this->warehouse_service);

    }
    

    public function dht_list($pageCri){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();


        $paging = new Paging();

        $result = $this->dht_service->selectAllDhtCount();
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

        $dhtList = $this->dht_service->selectPagingDht($startnum, $endnum);
        //echo $keyword;
        //print_r($productList);

        $machineList = $this->machine_service->selectMachineAll();

        $var_fn = "&type=sensor&func=list&sort=dht";

        $smarty->assign("dhtList", $dhtList);
        $smarty->assign("machineList", $machineList);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);

        $smarty->assign("title", "장비(상태)/온습도 센서:::Smart Premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("option_selected", "NE");
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('machine_dht_list.tpl');

    }

    
    public function dht_specific_list($dhtSpecificVO, $pageCri){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $paging = new Paging();
        $machineVO = new MachineVO();
        $machineVO->setMachine_id($dhtSpecificVO->getMachine_id());

        $result = $this->dht_service->selectDhtMachineIdBetweenDateCount($dhtSpecificVO);
        $total_cnt = $result['cnt'];

        //echo $dhtSpecificVO->getMachine_id() . "/" . $dhtSpecificVO->getStartdate() . "<br>";
        //echo $total_cnt . "<br>";

        $page_no = $pageCri->getPage();
        $page_size = $pageCri->getPerPageNum();

        $paging->setPageNo($page_no);
        $paging->setPageSize($page_size);
        $paging->setTotalCount($total_cnt);

        $pagingObj = $paging->getObject();

        $startnum = $paging->getDbStartNum();
        $endnum = $paging->getDbEndNum();

        //$resultProductVO = $this->product_service->selectProduct($productVO);

        $dhtList = $this->dht_service->selectPagingDhtMachineIdBetweenDate($dhtSpecificVO, $startnum, $endnum);
        //echo $keyword;
        //print_r($productList);

        $resultCurrentMachine = $this->machine_service->selectMachineFindID($machineVO);

        $machineList = $this->machine_service->selectMachineAll();

        $var_fn = "&type=sensor&func=list&sort=dht&machine_id=";
        $var_fn = $var_fn . $dhtSpecificVO->getMachine_id();
        $var_fn = $var_fn . "&startdate=" . $dhtSpecificVO->getStartdate();
        $var_fn = $var_fn . "&enddate=" . $dhtSpecificVO->getEnddate();

        $smarty->assign("dhtList", $dhtList);
        $smarty->assign("currentMachine", $resultCurrentMachine);
        $smarty->assign("machineList", $machineList);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);

        $smarty->assign("title", "장비(상태)/온습도 센서:::Smart Premiere");
        $smarty->assign("startdate", $_GET['startdate']);
        $smarty->assign("enddate", $_GET['enddate']);
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('machine_dht_list.tpl');

    }

    
    public function shock_list($pageCri){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();


        $paging = new Paging();

        $result = $this->shock_service->selectAllShockCount();
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

        $shockList = $this->shock_service->selectPagingShock($startnum, $endnum);
        //echo $keyword;
        //print_r($productList);

        $machineList = $this->machine_service->selectMachineAll();

        $var_fn = "&type=sensor&func=list&sort=shock";

        $smarty->assign("shockList", $shockList);
        $smarty->assign("machineList", $machineList);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);

        $smarty->assign("title", "장비(상태)/충격감지 센서:::Smart Premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('machine_shock_list.tpl');

    }

    
    public function shock_specific_list($shockSpecificVO, $pageCri){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $paging = new Paging();
        $machineVO = new MachineVO();
        $machineVO->setMachine_id($shockSpecificVO->getMachine_id());

        $result = $this->shock_service->selectShockMachineIdBetweenDateCount($shockSpecificVO);
        $total_cnt = $result['cnt'];

        //echo $dhtSpecificVO->getMachine_id() . "/" . $dhtSpecificVO->getStartdate() . "<br>";
        //echo $total_cnt . "<br>";

        $page_no = $pageCri->getPage();
        $page_size = $pageCri->getPerPageNum();

        $paging->setPageNo($page_no);
        $paging->setPageSize($page_size);
        $paging->setTotalCount($total_cnt);

        $pagingObj = $paging->getObject();

        $startnum = $paging->getDbStartNum();
        $endnum = $paging->getDbEndNum();

        //$resultProductVO = $this->product_service->selectProduct($productVO);

        $shockList = $this->shock_service->selectPagingShockMachineIdBetweenDate($shockSpecificVO, $startnum, $endnum);
        //echo $keyword;
        //print_r($productList);

        $resultCurrentMachine = $this->machine_service->selectMachineFindID($machineVO);

        $machineList = $this->machine_service->selectMachineAll();

        $var_fn = "&type=sensor&func=list&sort=shock&machine_id=";
        $var_fn = $var_fn . $shockSpecificVO->getMachine_id();
        $var_fn = $var_fn . "&startdate=" . $shockSpecificVO->getStartdate();
        $var_fn = $var_fn . "&enddate=" . $shockSpecificVO->getEnddate();

        $smarty->assign("shockList", $shockList);
        $smarty->assign("currentMachine", $resultCurrentMachine);
        $smarty->assign("machineList", $machineList);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);

        $smarty->assign("title", "장비(상태)/충격감지 센서:::Smart Premiere");
        $smarty->assign("startdate", $_GET['startdate']);
        $smarty->assign("enddate", $_GET['enddate']);
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('machine_shock_list.tpl');

    }

    
    public function ultrasonic_list($pageCri){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();


        $paging = new Paging();

        $result = $this->ultrasonic_service->selectAllUltrasonicCount();
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

        $ultrasonicList = $this->ultrasonic_service->selectPagingUltrasonic($startnum, $endnum);
        //echo $keyword;
        //print_r($productList);

        $machineList = $this->machine_service->selectMachineAll();

        $var_fn = "&type=sensor&func=list&sort=ultrasonic";

        $smarty->assign("ultrasonicList", $ultrasonicList);
        $smarty->assign("machineList", $machineList);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);

        $smarty->assign("title", "장비(상태)/초음파 센서:::Smart Premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('machine_ultrasonic_list.tpl');

    }

    
    public function ultrasonic_specific_list($ultrasonicSpecificVO, $pageCri){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $paging = new Paging();
        $machineVO = new MachineVO();
        $machineVO->setMachine_id($ultrasonicSpecificVO->getMachine_id());

        $result = $this->ultrasonic_service->selectUltrasonicMachineIdBetweenDateCount($ultrasonicSpecificVO);
        $total_cnt = $result['cnt'];

        //echo $dhtSpecificVO->getMachine_id() . "/" . $dhtSpecificVO->getStartdate() . "<br>";
        //echo $total_cnt . "<br>";

        $page_no = $pageCri->getPage();
        $page_size = $pageCri->getPerPageNum();

        $paging->setPageNo($page_no);
        $paging->setPageSize($page_size);
        $paging->setTotalCount($total_cnt);

        $pagingObj = $paging->getObject();

        $startnum = $paging->getDbStartNum();
        $endnum = $paging->getDbEndNum();

        //$resultProductVO = $this->product_service->selectProduct($productVO);

        $ultrasonicList = $this->ultrasonic_service->selectPagingUltrasonicMachineIdBetweenDate($ultrasonicSpecificVO, $startnum, $endnum);
        //echo $keyword;
        //print_r($productList);

        $resultCurrentMachine = $this->machine_service->selectMachineFindID($machineVO);

        $machineList = $this->machine_service->selectMachineAll();

        $var_fn = "&type=sensor&func=list&sort=ultrasonic&machine_id=";
        $var_fn = $var_fn . $ultrasonicSpecificVO->getMachine_id();
        $var_fn = $var_fn . "&startdate=" . $ultrasonicSpecificVO->getStartdate();
        $var_fn = $var_fn . "&enddate=" . $ultrasonicSpecificVO->getEnddate();

        $smarty->assign("ultrasonicList", $ultrasonicList);
        $smarty->assign("currentMachine", $resultCurrentMachine);
        $smarty->assign("machineList", $machineList);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);

        $smarty->assign("title", "장비(상태)/초음파 센서:::Smart Premiere");
        $smarty->assign("startdate", $_GET['startdate']);
        $smarty->assign("enddate", $_GET['enddate']);
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('machine_ultrasonic_list.tpl');

    }

    public function machine_register(){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $root_dir = $this->getRootDir();
        $smarty->setTemplateDir($root_dir . '/view/main/core');

        $this->setSmarty($smarty);
        $smarty->clearAllCache();

        //echo "참";
        //print_r($memberAuthList);
        $smarty->assign("title", "장비/등록:::Smart Premiere");

        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('machine_register.tpl');

    }

    public function machine_register_ok($machineVO){
        
        $status = 1;

        $this->loadService();

        // 장비명 입력 상태
        if ($machineVO->getMachine_name() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $machineVO->getMachine_name() === -1 &&
                   $status === 1 ){
            $status = -1;
        }

        // UUID 입력 상태
        if ($machineVO->getUuid() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $machineVO->getUuid() === -1 &&
                   $status === 1 ){
            $status = -2;
        }

        // 메모 입력 상태
        if ($machineVO->getMemo() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $machineVO->getMemo() === -1 &&
                   $status === 1 ){
            $status = -3;
        }

        //echo $status . "참참참<br>";
        //echo $memberVO->getLocked() . "<br>참";

        // 활성화 상태
        if ($machineVO->getLocked() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( ( strcmp( $machineVO->getLocked(), "활성") === 0 && 
                    strcmp( $machineVO->getLocked(), "비활성") === 0 ) &&
                    $status === 1 ){
            $status = -4;
        }

        //echo "참3 /" . $status . "<br>";

        // 입력 프로세스
        if ($status === 1){
            //echo "참4<br>";
            $result = $this->machine_service->insertMachine($machineVO);

            if ($result === 1){
                echo "<script>";
                echo "alert ('성공적으로 등록되었습니다.');";
                echo "location.replace('../portal/machine?func=register');";
                echo "</script>";
                exit;
            }

            //echo "참5<br>";

        }
        else if ($status === -1){

            echo "<script>";
            echo "alert ('장비명을 확인하세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -2){

            echo "<script>";
            echo "alert ('UUID 입력 상태를 확인하세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -3){

            echo "<script>";
            echo "alert ('메모 입력 상태를 확인하세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -4){

            echo "<script>";
            echo "alert ('권한을 입력해주세요.');";
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

    public function machine_list($pageCri){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $root_dir = $this->getRootDir();
        $smarty->setTemplateDir($root_dir . '/view/main/core');

        $this->setSmarty($smarty);
        $smarty->clearAllCache();

        $paging = new Paging();

        $result = $this->machine_service->selectAllMachineCount();
        $total_cnt = $result['cnt'];

        //echo $dhtSpecificVO->getMachine_id() . "/" . $dhtSpecificVO->getStartdate() . "<br>";
        //echo $total_cnt . "<br>";

        $page_no = $pageCri->getPage();
        $page_size = $pageCri->getPerPageNum();

        $paging->setPageNo($page_no);
        $paging->setPageSize($page_size);
        $paging->setTotalCount($total_cnt);

        $pagingObj = $paging->getObject();

        $startnum = $paging->getDbStartNum();
        $endnum = $paging->getDbEndNum();

        
        //$resultProductVO = $this->product_service->selectProduct($productVO);

        $machineList = $this->machine_service->selectPagingMachine($startnum, $endnum);
        //echo $keyword;
        //print_r($productList);

        //print_r($machineList);

        $var_fn = "&func=list";


        $smarty->assign("machineList", $machineList);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);

        $smarty->assign("title", "장비/관리:::Smart Premiere");
        $smarty->assign("startdate", $_GET['startdate']);
        $smarty->assign("enddate", $_GET['enddate']);
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('machine_list.tpl');

    }

    public function machine_modify(){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $root_dir = $this->getRootDir();
        $smarty->setTemplateDir($root_dir . '/view/main/core');

        $this->setSmarty($smarty);
        $smarty->clearAllCache();

        $machineVO = new MachineVO();
        $machineVO->setMachine_id($_GET['id']);

        $resultMachineVO = $this->machine_service->selectMachineFindID($machineVO);

        if ( isset($resultMachineVO) ){

            $smarty->assign("machine_item", $resultMachineVO);

            $smarty->assign("title", "장비/수정:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('machine_modify.tpl');

        }

        else if ( !isset($resultMachineVO) ){
            
            echo "<script>";
            echo "alert('장비가 존재하지 않습니다.');";
            echo "location.replace('../portal/machine?func=list');";
            echo "</script>";
            exit;

        }

    }

    public function machine_modify_ok($updateVO){
        
        $status = 1;

        $this->loadService();

        // 장비명 입력 상태
        if ($updateVO->getMachine_name() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $updateVO->getMachine_name() === -1 &&
                   $status === 1 ){
            $status = -1;
        }

        // UUID 입력 상태
        if ($updateVO->getUuid() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $updateVO->getUuid() === -1 &&
                   $status === 1 ){
            $status = -2;
        }

        // 메모 입력 상태
        if ($updateVO->getMemo() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $updateVO->getMemo() === -1 &&
                   $status === 1 ){
            $status = -3;
        }

        //echo $status . "참참참<br>";
        //echo $memberVO->getLocked() . "<br>참";

        // 활성화 상태
        if ($updateVO->getLocked() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( ( strcmp( $updateVO->getLocked(), "활성") === 0 && 
                    strcmp( $updateVO->getLocked(), "비활성") === 0 ) &&
                    $status === 1 ){
            $status = -4;
        }

        $machineVO = new MachineVO();
        $machineVO->setMachine_id($_POST['machine_id']);

        $resultMachineVO = $this->machine_service->selectMachineFindID($machineVO);

        // UUID 일치 여부
        if ( isset( $resultMachineVO ) ){

            if ( strcmp( $resultMachineVO[0]['uuid'], $updateVO->getUuid() ) === 0 && 
                $status === 1){
                $status = 1;
            }else{
                $status = -5;
            }

        }else if (!isset($resultMachineVO) ){
            $status = -6;
        }


        // 입력 프로세스
        if ($status === 1){
            //echo "참4<br>";
            $result = $this->machine_service->updateMachine($updateVO);

            if ($result === 1){
                echo "<script>";
                echo "alert ('성공적으로 수정되었습니다.');";
                echo "location.replace('../portal/machine?func=list');";
                echo "</script>";
                exit;
            }

            //echo "참5<br>";

        }
        else if ($status === -1){

            echo "<script>";
            echo "alert ('장비명을 확인하세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -2){

            echo "<script>";
            echo "alert ('UUID 입력 상태를 확인하세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -3){

            echo "<script>";
            echo "alert ('메모 입력 상태를 확인하세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -4){

            echo "<script>";
            echo "alert ('권한을 입력해주세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -5){

            echo "<script>";
            echo "alert ('UUID가 일치하지 않습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -6){

            echo "<script>";
            echo "alert ('데이터가 존재하지 않습니다.');";
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
    
    public function machine_delete(){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $root_dir = $this->getRootDir();
        $smarty->setTemplateDir($root_dir . '/view/main/core');

        $this->setSmarty($smarty);
        $smarty->clearAllCache();

        $machineVO = new MachineVO();
        $machineVO->setMachine_id($_GET['id']);

        $resultMachineVO = $this->machine_service->selectMachineFindID($machineVO);

        if ( isset($resultMachineVO) ){

            $smarty->assign("machine_item", $resultMachineVO);

            $smarty->assign("title", "장비/삭제:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('machine_delete.tpl');

        }

        else if ( !isset($resultMachineVO) ){
            
            echo "<script>";
            echo "alert('장비가 존재하지 않습니다.');";
            echo "location.replace('../portal/machine?func=list');";
            echo "</script>";
            exit;

        }

    }

    public function machine_delete_ok($currentVO){

        
        $this->loadService();

        $status = 1;
        $resultMachineVO = $this->machine_service->selectMachineFindID($currentVO);

        if ( isset ( $resultMachineVO ) && $status === 1){

            if ( strcmp($resultMachineVO[0]['uuid'], $currentVO->getUuid()) === 0 ){
                $status = 1;
            }else{
                $status = -2;
            }

            
        }else if ( !isset($resultMachineVO) && $status === 1){
            $status = -1;
        }

        // 삭제 프로세스
        if ($status === 1){
                
            $result = $this->machine_service->deleteMachine($currentVO);

            if ($result === 1){
                echo "<script>";
                echo "alert ('성공적으로 삭제하였습니다.');";
                echo "location.replace('../portal/machine?func=list');";
                echo "</script>";
                exit;
            }

        }

        else if ($status === -1){

            echo "<script>";
            echo "alert ('사용자 계정을 찾을 수 없습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -2){

            echo "<script>";
            echo "alert ('UUID가 일치하지 않습니다.');";
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

}

?>