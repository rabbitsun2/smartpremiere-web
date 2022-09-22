<?php
/*
 * Created Date: 2022-06-17 (Fri)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Controller
 * Filename: ConfigController.php
 * Description:
 * 1. 사용자 계정 수정 처리 프로세스 추가, 정도윤, 2022-07-02 (Sat).
 * 2. 계정 활성화 기능 추가, 정도윤, 2022-07-25 (Mon).
 * 
 */

class ConfigController extends Controller {
 
    private $member_service;
    private $member_auth_service;

    public function __construct(){
        
    }
    
    public function __destruct(){
        
    }
    
    private function templateDir(){

        $smarty = $this->getSmarty();
        $root_dir = $this->getRootDir();
        $smarty->setTemplateDir($root_dir . '/view/main/core');

        $this->setSmarty($smarty);
        
    }

    private function loadService(){
        
        $this->member_service = new MemberServiceImpl();
        $this->member_auth_service = new MemberAuthServiceImpl();
        
        $my_conn = $this->getConn();
        $this->member_service->setConn($my_conn);
        $this->member_auth_service->setConn($my_conn);

        //print_r($this->warehouse_service);

    }
    

    public function member_register(){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $memberAuthList = $this->member_service->selectMemberAuth();

        //echo "참";
        //print_r($memberAuthList);

        $smarty->assign("member_auth_list", $memberAuthList);
        $smarty->assign("title", "계정/사용자 등록:::Smart Premiere");

        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('member_register.tpl');

    }

    public function member_register_ok($memberVO){

        $status = 1;

        $this->loadService();

        //print_r($employeeVO);

        // 이메일 입력 여부
        if ( ( $memberVO->getEmail() !== -1 && 
               $memberVO->getEmail() !== -2 && 
               $memberVO->getEmail() !== -3 ) 
               && $status === 1){
            $status = 1;
        }else if ( $memberVO->getEmail() === -1 
               && $status === 1){
            $status = -1;
        }else if ( $memberVO->getEmail() === -2 
               && $status === 1){
            $status = -2;
        }else if ( $memberVO->getEmail() === -3 
               && $status === 1){
            $status = -3;
        }


        // 권한 입력 여부 상태
        if ($memberVO->getMember_auth() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $memberVO->getMember_auth() === -1 &&
                   $status === 1 ){
            $status = -4;
        }

        // 사용자명 입력 상태
        if ($memberVO->getUsrname() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $memberVO->getUsrname() === -1 &&
                   $status === 1 ){
            $status = -5;
        }

        // 비밀번호 입력 상태
        if ( ( $memberVO->getPasswd() !== -1 && 
            $memberVO->getPasswd() !== -2 &&
            $memberVO->getPasswd() !== -3 && 
            $memberVO->getPasswd() !== -4 ) &&
            $status === 1){
            $status = 1;

        }else if ( $memberVO->getPasswd() === -1 &&
                    $status === 1){
            $status = -6;

        }else if ( $memberVO->getPasswd() === -2 &&
                    $status === 1){
            $status = -7;

        }else if ( $memberVO->getPasswd() === -3 &&
                    $status === 1){
            $status = -8;

        }else if ( $memberVO->getPasswd() === -4 &&
                    $status === 1){
            $status = -9;

        }

        //echo $status . "참참참<br>";
        //echo $memberVO->getLocked() . "<br>참";

        // 활성화 상태
        if ($memberVO->getLocked() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( ( strcmp( $memberVO->getLocked(), "활성") === 0 && 
                    strcmp( $memberVO->getLocked(), "비활성") === 0 ) &&
                    $status === 1 ){
            $status = -10;
        }

        //echo "참3 /" . $status . "<br>";

        // 입력 프로세스
        if ($status === 1){
            //echo "참4<br>";
            $result = $this->member_service->insertMember($memberVO);

            if ($result === 1){
                echo "<script>";
                echo "alert ('성공적으로 등록되었습니다.');";
                echo "location.replace('../portal/member?func=register');";
                echo "</script>";
                exit;
            }

            //echo "참5<br>";

        }
        else if ($status === -1){

            echo "<script>";
            echo "alert ('이메일 주소 형식을 확인하세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -2){

            echo "<script>";
            echo "alert ('이메일 주소를 확인하세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -3){

            echo "<script>";
            echo "alert ('이메일 주소가 중복되었습니다.');";
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
            echo "alert ('사용자명을 입력해주세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -6){

            echo "<script>";
            echo "alert ('비밀번호 길이가 일치하지 않습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -7){

            echo "<script>";
            echo "alert ('비밀번호를 올바르게 입력해주세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -8){

            echo "<script>";
            echo "alert ('비밀번호를 입력해주세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -9){

            echo "<script>";
            echo "alert ('비밀번호를 올바르게 입력하세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -10){

            echo "<script>";
            echo "alert ('계정 활성화 상태를 입력하세요.');";
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

    public function member_list($pageCri){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();


        //echo "참";
        //print_r($memberAuthList);
        $paging = new Paging();

        $result = $this->member_service->selectAllMemberCount();
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

        $memberList = $this->member_service->selectPagingMember($startnum, $endnum);


        $var_fn = "&func=list";

        $smarty->assign("memberList", $memberList);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);

        $smarty->assign("title", "계정/사용자 관리:::Smart Premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('member_list.tpl');

    }

    public function member_modify(){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $memberVO = new MemberVO();
        $memberVO->setMember_id($_GET['id']);

        $memberAuthList = $this->member_service->selectMemberAuth();
        $resultMemberVO = $this->member_service->selectMemberFindId($memberVO);

        if ( isset($resultMemberVO) ){

            // 버그 개선(결과값 출력)
            if ( ArrayUtil::getDimensionArray($resultMemberVO) !== -1 ||
                ArrayUtil::getDimensionArray($resultMemberVO) !== 1 ){
                $resultMemberVO = array(0 => $resultMemberVO);
            }

            $smarty->assign("member_item", $resultMemberVO);
            $smarty->assign("member_auth_list", $memberAuthList);

            $smarty->assign("title", "계정/사용자 수정:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('member_modify.tpl');

        }

        else if ( !isset($resultMemberVO) ){
            
            echo "<script>";
            echo "alert('사용자 계정이 존재하지 않습니다.');";
            echo "location.replace('../portal/member?func=list');";
            echo "</script>";
            exit;

        }

    }

    public function member_modify_ok($curMemberVO, $updateMemberVO){

        $this->loadService();

        $status = 1;
        $resultMemberVO = $this->member_service->selectMemberFindId($curMemberVO);

        if ( isset ( $resultMemberVO ) && $status === 1 ){
            
            $status = 1;

        }else if ( !isset($resultMemberVO) ){
            $status = -8;
        }

        // 사용자 계정이 존재할 때, 기존 비밀번호가 일치할 때
        if ( $status === 1 ){

            // 권한 입력 여부 상태
            if ($updateMemberVO->getMember_auth() !== -1 &&
                $status === 1){
                $status = 1;
            }else if ($updateMemberVO->getMember_auth() === -1 && 
                $status === 1){
                $status = -1;
            }

            // 사용자명 입력 상태
            if ($updateMemberVO->getUsrname() !== -1 &&
                $status === 1){
                $status = 1;
            }else if ($updateMemberVO->getUsrname() === -1 &&
                $status === 1){
                $status = -2;
            }

            // 비밀번호 입력 상태
            if ( ( $updateMemberVO->getPasswd() !== -1 && 
                $updateMemberVO->getPasswd() !== -2 &&
                $updateMemberVO->getPasswd() !== -3 && 
                $updateMemberVO->getPasswd() !== -4 ) &&
                $status === 1){
                $status = 1;

            }else if ( $updateMemberVO->getPasswd() === -1 &&
                    $status === 1){
                
                $status = -3;

            }else if ( $updateMemberVO->getPasswd() === -2 &&
                    $status === 1){

                $status = -4;

            }else if ( $updateMemberVO->getPasswd() === -3 &&
                    $status === 1){

                $status = -5;

            }else if ( $updateMemberVO->getPasswd() === -4 &&
                $status === 1){

                $status = -6;
            }

            // 활성화 상태 입력 여부
            if ($updateMemberVO->getLocked() !== -1 &&
                $status === 1){
                $status = 1;
            }else if ($updateMemberVO->getLocked() === -1 &&
                $status === 1){
                $status = -7;
            }

        }

        // 수정 프로세스
        if ($status === 1){
            
            $result = $this->member_service->updateMember($updateMemberVO);

            if ($result === 1){
                echo "<script>";
                echo "alert ('성공적으로 수정하였습니다.');";
                echo "location.replace('../portal/member?func=list');";
                echo "</script>";
                exit;
            }

            //echo "참5<br>";

        }
        else if ($status === -1){

            echo "<script>";
            echo "alert ('권한을 입력해주세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -2){

            echo "<script>";
            echo "alert ('사용자명을 입력해주세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -3){

            echo "<script>";
            echo "alert ('비밀번호 길이가 일치하지 않습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -4){

            echo "<script>";
            echo "alert ('비밀번호를 올바르게 입력해주세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -5){

            echo "<script>";
            echo "alert ('비밀번호가 일치하지 않습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -6){

            echo "<script>";
            echo "alert ('비밀번호를 올바르게 입력하세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -7){

            echo "<script>";
            echo "alert ('계정 활성화 상태를 선택하세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -8){

            echo "<script>";
            echo "alert ('사용자 계정을 찾을 수 없습니다.');";
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

    
    public function member_delete(){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $memberVO = new MemberVO();
        $memberVO->setMember_id($_GET['id']);

        $memberAuthList = $this->member_service->selectMemberAuth();
        $resultMemberVO = $this->member_service->selectMemberFindId($memberVO);

        if ( isset($resultMemberVO) ){

            // 버그 개선(결과값 출력)
            if ( ArrayUtil::getDimensionArray($resultMemberVO) !== -1 ){
                $resultMemberVO = array(0 => $resultMemberVO);
            }

            $smarty->assign("member_item", $resultMemberVO);
            $smarty->assign("member_auth_list", $memberAuthList);

            $smarty->assign("title", "계정/사용자 삭제:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('member_delete.tpl');

        }

        else if ( !isset($resultMemberVO) ){
            
            echo "<script>";
            echo "alert('사용자 계정이 존재하지 않습니다.');";
            echo "location.replace('../portal/member?func=list');";
            echo "</script>";
            exit;

        }

    }

    public function member_delete_ok($curMemberVO){

        $this->loadService();

        $status = 1;
        $resultMemberVO = $this->member_service->selectMember($curMemberVO);

        if ( isset ( $resultMemberVO ) && $status === 1){
            $status = 1;
        }else if ( !isset($resultMemberVO) && $status === 1){
            $status = -1;
        }

        // 삭제 프로세스
        if ($status === 1){
                
            $result = $this->member_service->deleteMember($curMemberVO);

            if ($result === 1){
                echo "<script>";
                echo "alert ('성공적으로 삭제하였습니다.');";
                echo "location.replace('../portal/member?func=list');";
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
        else{

            echo "<script>";
            echo "alert ('비정상적인 접근입니다.');";
            echo "history.back();";
            echo "</script>";
            exit;

        }

    }

    
    public function member_auth_register(){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $resultMemberAuth = $this->member_auth_service->selectAllMemberAuth();

        //print_r($resultMemberAuth);

        //echo "참";
        //print_r($memberAuthList);

        $smarty->assign("member_auth_list", $resultMemberAuth);
        $smarty->assign("title", "권한/등록:::Smart Premiere");

        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('member_auth_register.tpl');

    }

    public function member_auth_register_ok($memberAuthVO){

        $status = 1;

        $this->loadService();

        //print_r($employeeVO);

        // 권한 입력 여부 상태
        if ($memberAuthVO->getAuth_name() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $memberAuthVO->getAuth_name() === -1 &&
                   $status === 1 ){
            $status = -1;
        }

        $resultMemberAuth = $this->member_auth_service->selectFindAuthname($memberAuthVO);

        // 권한 중복 여부
        if ( isset($resultMemberAuth) && 
            $status === 1){
                $status = -2;
        }else if ( !isset($resultMemberAuth) && 
            $status === 1){
            $status = 1;
        }


        //echo "참3 /" . $status . "<br>";

        // 입력 프로세스
        if ($status === 1){
            //echo "참4<br>";
            $result = $this->member_auth_service->insertMemberAuthVal($memberAuthVO);

            if ($result === 1){
                echo "<script>";
                echo "alert ('성공적으로 등록되었습니다.');";
                echo "location.replace('../portal/member_auth?func=register');";
                echo "</script>";
                exit;
            }

            //echo "참5<br>";

        }
        else if ($status === -1){

            echo "<script>";
            echo "alert ('권한을 입력하세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -2){

            echo "<script>";
            echo "alert ('권한이 중복됩니다.');";
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
    
    public function member_auth_list($pageCri){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();


        //echo "참";
        //print_r($memberAuthList);
        $paging = new Paging();

        $result = $this->member_auth_service->selectCountAllMemberAuth();
        $total_cnt = $result[0]['cnt'];

        $page_no = $pageCri->getPage();
        $page_size = $pageCri->getPerPageNum();

        $paging->setPageNo($page_no);
        $paging->setPageSize($page_size);
        $paging->setTotalCount($total_cnt);

        $pagingObj = $paging->getObject();

        $startnum = $paging->getDbStartNum();
        $endnum = $paging->getDbEndNum();

        //$resultProductVO = $this->product_service->selectProduct($productVO);

        $memberAuthList = $this->member_auth_service->selectPagingMemberAuth($startnum, $endnum);


        $var_fn = "&func=list";

        $smarty->assign("memberAuthList", $memberAuthList);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);

        $smarty->assign("title", "권한/관리:::Smart Premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('member_auth_list.tpl');

    }

    public function member_auth_modify(){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $memberAuthVO = new MemberAuthVO();
        $memberAuthVO->setId($_GET['id']);

        $resultMemberAuth = $this->member_auth_service->selectAllMemberAuth();
        $resultMemberAuthVO = $this->member_auth_service->selectFindId($memberAuthVO);

        if ( isset($resultMemberAuthVO) ){

            $smarty->assign("member_auth_item", $resultMemberAuthVO);
            $smarty->assign("member_auth_list", $resultMemberAuth);

            $smarty->assign("title", "권한/수정:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('member_auth_modify.tpl');

        }

        else if ( !isset($resultMemberAuthVO) ){
            
            echo "<script>";
            echo "alert('사용자 권한이 존재하지 않습니다.');";
            echo "location.replace('../portal/member_auth?func=list');";
            echo "</script>";
            exit;

        }

    }

    public function member_auth_modify_ok($memberAuthVO){

        $status = 1;

        $this->loadService();

        //print_r($employeeVO);

        // 권한 입력 여부 상태
        if ($memberAuthVO->getAuth_name() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $memberAuthVO->getAuth_name() === -1 &&
                   $status === 1 ){
            $status = -1;
        }

        $resultMemberAuth = $this->member_auth_service->selectFindAuthname($memberAuthVO);

        // 권한 중복 여부
        if ( isset($resultMemberAuth) && 
            $status === 1){
                $status = -2;
        }else if ( !isset($resultMemberAuth) && 
            $status === 1){
            $status = 1;
        }

        // 데이터 존재여부
        $resultMemberAuthId = $this->member_auth_service->selectFindId($memberAuthVO);
        if ( isset($resultMemberAuth) && 
           $status === 1){
            $status = -3;
        }else if ( !isset($resultMemberAuth) && 
            $status === 1){
            $status = 1;
        }

        //echo "참3 /" . $status . "<br>";

        // 입력 프로세스
        if ($status === 1){
            //echo "참4<br>";
            $result = $this->member_auth_service->updateMemberAuth($memberAuthVO);

            if ($result === 1){
                echo "<script>";
                echo "alert ('성공적으로 수정되었습니다.');";
                echo "location.replace('../portal/member_auth?func=list');";
                echo "</script>";
                exit;
            }

            //echo "참5<br>";

        }
        else if ($status === -1){

            echo "<script>";
            echo "alert ('권한을 입력하세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -2){

            echo "<script>";
            echo "alert ('권한이 중복됩니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -3){

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
    
    public function member_auth_delete(){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $memberAuthVO = new MemberAuthVO();
        $memberAuthVO->setId($_GET['id']);

        $resultMemberAuth = $this->member_auth_service->selectAllMemberAuth();
        $resultMemberAuthVO = $this->member_auth_service->selectFindId($memberAuthVO);

        if ( isset($resultMemberAuthVO) ){

            $smarty->assign("member_auth_item", $resultMemberAuthVO);
            $smarty->assign("member_auth_list", $resultMemberAuth);

            $smarty->assign("title", "권한/삭제:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('member_auth_delete.tpl');

        }

        else if ( !isset($resultMemberAuthVO) ){
            
            echo "<script>";
            echo "alert('사용자 권한이 존재하지 않습니다.');";
            echo "location.replace('../portal/member_auth?func=list');";
            echo "</script>";
            exit;

        }

    }

    
    public function member_auth_delete_ok($memberAuthVO){

        $status = 1;

        $this->loadService();

        //print_r($employeeVO);

        // 데이터 존재여부
        $resultMemberAuthId = $this->member_auth_service->selectFindId($memberAuthVO);
        if ( isset($resultMemberAuth) && 
           $status === 1){
            $status = -1;
        }else if ( !isset($resultMemberAuth) && 
            $status === 1){
            $status = 1;
        }

        // 관리자, 일반 권한 삭제 불능으로 처리
        if ( $memberAuthVO->getId() <= 2 && 
            $status === 1){

            $status = -2;

        }else if ( $memberAuthVO->getId() > 2 
                    && $status === 1 ){
            $status = 1;
        }

        //echo "참3 /" . $status . "/" . $memberAuthVO->getId() . "<br>";
        //echo $memberAuthVO->getId() > 2;

        // 입력 프로세스
        if ($status === 1){
            //echo "참4<br>";
            $result = $this->member_auth_service->deleteMemberAuth($memberAuthVO);

            if ($result === 1){
                echo "<script>";
                echo "alert ('성공적으로 삭제되었습니다.');";
                echo "location.replace('../portal/member_auth?func=list');";
                echo "</script>";
                exit;
            }

            //echo "참5<br>";

        }
        else if ($status === -1){

            echo "<script>";
            echo "alert ('권한이 존재하지 않습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -2){

            echo "<script>";
            echo "alert ('관리자, 일반 권한은 삭제가 불가능합니다.');";
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