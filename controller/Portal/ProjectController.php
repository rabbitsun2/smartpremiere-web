<?php
/*
 * Created Date: 2022-07-02 (Sat)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Controller
 * Filename: ProjectController.php
 * Description:
 * 1. 프로젝트 등록 내 다중 파일 업로드 기능 추가, 정도윤, 2022-07-03 (Sun)
 * 2. 프로젝트 수정, 프로젝트 상세(파일 정보), 프로젝트 파일삭제 기능 추가, 정도윤, 2022-07-03 (Sun)
 * 3. 제품 존재 여부, 입고 출고 기록물 현황 추적 기능 추가, 정도윤, 2022-08-03 (Wed)
 * 4. 프로젝트 삭제 기능 추가, 정도윤, 2022-08-03 (Wed)
 */

class ProjectController extends Controller {
 
    private $project_service;
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
        
        $this->project_service = new ProjectServiceImpl();
        $this->product_service = new ProductServiceImpl();
        $this->warehouse_service = new WarehouseServiceImpl();
        
        $my_conn = $this->getConn();

        $this->project_service->setConn($my_conn);
        $this->product_service->setConn($my_conn);
        $this->warehouse_service->setConn($my_conn);

        //print_r($this->warehouse_service);

    }
    

    public function list_page($pageCri){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();


        $paging = new Paging();

        $result = $this->project_service->selectAllProjectCount();
        $total_cnt = $result['cnt'];


        $page_no = $pageCri->getPage();
        $page_size = $pageCri->getPerPageNum();

        $paging->setPageNo($page_no);
        $paging->setPageSize($page_size);
        $paging->setTotalCount($total_cnt);

        $pagingObj = $paging->getObject();

        $startnum = $paging->getDbStartNum();
        $endnum = $paging->getDbEndNum();


        $projectList = $this->project_service->selectPagingProject($startnum, $endnum);
        //echo $keyword;
        //print_r($productList);

        $var_fn = "&func=list";

        $smarty->assign("projectList", $projectList);
        $smarty->assign("pagingObj", $pagingObj);
        $smarty->assign("fn", $var_fn);

        $smarty->assign("title", "프로젝트/현황:::Smart Premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('project_list.tpl');

    }

    public function project_register(){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();


        $smarty->assign("MAX_FILE_SIZE", $this->getUploadSize());
        $smarty->assign("title", "프로젝트/등록:::Smart Premiere");
        $smarty->assign("session_member_id", $_SESSION['member_id']);
        $smarty->assign("session_email", $_SESSION['email']);
        $smarty->assign("session_auth_name", $_SESSION['auth_name']);
        $smarty->assign("session_usrname", $_SESSION['usrname']);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("option_selected", "NE");
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->display('project_register.tpl');

    }

    public function project_register_ok($projectVO, $projectFileArr){

        $this->templateDir();
        $this->loadService();

        $status = 1;
        
        // 프로젝트 명 입력 여부
        if ($projectVO->getProject_name() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ($projectVO->getProject_name() === -1 &&
            $status === 1) {
            $status = -1;
        }

        // 프로젝트 설명 입력 여부
        if ($projectVO->getDescription() !== -1 &&
            $status === 1 ){
            $status = 1;
        }else if ($projectVO->getDescription() === -1 &&
            $status === 1 ){
            $status = -2;
        }

        // 시작일자 입력 여부
        if ($projectVO->getStartdate() !== -1 &&
            $status === 1 ){
            $status = 1;
        }else if ($projectVO->getStartdate() === -1 &&
            $status === 1 ){
            $status = -3;
        }

        // 종료일자 입력 여부
        if ($projectVO->getEnddate() !== -1 &&
            $status === 1 ){
            $status = 1;
        }else if ($projectVO->getEnddate() === -1 &&
            $status === 1 ){
            $status = -4;
        }

        // 파일 확장자 제한 여부
        if ( strcmp( $projectVO->getFile_option() , "NORMAL" ) === 0 &&
               $status === 1 ){

            $status = 1;

        }else if ( strcmp( $projectVO->getFile_option() , "RESTRICT" ) === 0 &&
            $status === 1 ){
            $status = -5;
        }


        if ( $status === 1 ){

            $result = $this->project_service->insertProject($projectVO);
    
            // 프로젝트 등록이 성공적인 경우
            if ( $result === 1 ){
                
                $result = $this->project_service->selectFullProjectQry($projectVO);
                //print_r($result);

                $id = $result['project_id'];

                //print_r($boardFileArr);
                
                // 파일 정보 입력(파일 업로드)
                foreach($projectFileArr as $key=>$val){
                    
                    $val->setProject_id($id);
                    
                    if ( strcmp( $val->getOption(), "success" ) === 0 ){
                        $result = $this->project_service->insertProjectFile($val);

                    }
                    
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
                echo "alert ('성공적으로 등록되었습니다.');";
                echo "location.replace('../portal/project?func=list');";
                echo "</script>";
                exit;

                break;

            case -1:

                echo "<script>";
                echo "alert('프로젝트명을 입력하세요.');";
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
                echo "alert('시작일자를 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;
                
                break;

            case -4:

                echo "<script>";
                echo "alert('종료일자를 입력하세요.');";
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
                echo "alert('프로젝트 등록에 실패하였습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

        }

    }

    public function project_list_detail_view($projectVO){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $project_id = $projectVO->getProject_id();

        $projectFileVO = new ProjectFileVO();
        $projectFileVO->setProject_id( $project_id );

        $resultProject = $this->project_service->selectFindIDProject($projectVO);
        $resultProjectFile = $this->project_service->selectFindIDProjectFile($projectFileVO);

        if ( isset( $resultProject) ){

            // 버그 개선(결과값 출력)
            if ( ArrayUtil::getDimensionArray($resultProject) !== -1 ){
                $resultProject = array(0 => $resultProject);
            }

        }

        //echo "참1/" . $project_id ;
        //print_r($resultProjectFile);

        if ( isset( $resultProject ) ){

            $smarty->assign("project_item", $resultProject);
            $smarty->assign("project_file_item", $resultProjectFile);

            $smarty->assign("title", "프로젝트/프로젝트 상세:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('project_detail_view.tpl');

        }else{
            
            echo "<script>";
            echo "alert('올바른 ID를 입력하세요.');";
            echo "</script>";
            exit;
        }

    }

    public function project_modify(){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $pjtVO = new ProjectVO();
        $pjtVO->setProject_id($_GET['id']);

        $pjtFileVO = new ProjectFileVO();
        $pjtFileVO->setProject_id($_GET['id']);


        $resultProjectVO = $this->project_service->selectFindIDProject($pjtVO);
        $resultProjectFileVO = $this->project_service->selectFindIDProjectFile($pjtFileVO);


        if ( isset($resultProjectVO) ){

            // 버그 개선(결과값 출력)
            if ( ArrayUtil::getDimensionArray($resultProjectVO) !== -1 ){
                $resultProjectVO = array(0 => $resultProjectVO);
            }

            $smarty->assign("project_item", $resultProjectVO);
            $smarty->assign("project_file_item", $resultProjectFileVO);

            $smarty->assign("MAX_FILE_SIZE", $this->getUploadSize());
            $smarty->assign("title", "프로젝트/프로젝트 수정:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('project_modify.tpl');

        }

        else if ( !isset($resultProjectVO) ){
            
            echo "<script>";
            echo "alert('프로젝트가 존재하지 않습니다.');";
            echo "location.replace('../portal/project?func=list');";
            echo "</script>";
            exit;

        }

    }

    
    public function project_modify_ok($projectVO, $projectFileArr){

        $this->templateDir();
        $this->loadService();


        $status = 1;
        
        // 프로젝트 명 입력 여부
        if ($projectVO->getProject_name() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ($projectVO->getProject_name() === -1 &&
            $status === 1) {
            $status = -1;
        }

        // 프로젝트 설명 입력 여부
        if ($projectVO->getDescription() !== -1 &&
            $status === 1 ){
            $status = 1;
        }else if ($projectVO->getDescription() === -1 &&
            $status === 1 ){
            $status = -2;
        }

        // 시작일자 입력 여부
        if ($projectVO->getStartdate() !== -1 &&
            $status === 1 ){
            $status = 1;
        }else if ($projectVO->getStartdate() === -1 &&
            $status === 1 ){
            $status = -3;
        }

        // 종료일자 입력 여부
        if ($projectVO->getEnddate() !== -1 &&
            $status === 1 ){
            $status = 1;
        }else if ($projectVO->getEnddate() === -1 &&
            $status === 1 ){
            $status = -4;
        }

        // 파일 확장자 제한 여부
        if ( strcmp( $projectVO->getFile_option() , "NORMAL" ) === 0 &&
               $status === 1 ){

            $status = 1;

        }else if ( strcmp( $projectVO->getFile_option() , "RESTRICT" ) === 0 &&
                $status === 1 ){
            $status = -5;
        }

        //echo "참";

        if ( $status === 1 ){

            $result = $this->project_service->updateProject($projectVO);
    
            // 프로젝트 등록이 성공적인 경우
            if ( $result === 1 ){
                
                //print_r($result);

                $id = $projectVO->getProject_id();

                //print_r($boardFileArr);
                
                // 파일 정보 입력(파일 업로드)
                foreach($projectFileArr as $key=>$val){
                    
                    $val->setProject_id($id);
                    
                    if ( strcmp( $val->getOption(), "success" ) === 0 ){
                        $result = $this->project_service->insertProjectFile($val);

                    }
                    
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
                echo "location.replace('../portal/project?func=list');";
                echo "</script>";
                exit;

                break;

            case -1:

                echo "<script>";
                echo "alert('프로젝트명을 입력하세요.');";
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
                echo "alert('시작일자를 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;
                
                break;

            case -4:

                echo "<script>";
                echo "alert('종료일자를 입력하세요.');";
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
                echo "alert('프로젝트 수정에 실패하였습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

        }

    }

    public function project_file_delete(){
        
        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $pjtFileVO = new ProjectFileVO();
        $pjtFileVO->setProject_id($_GET['project_id']);
        $pjtFileVO->setUuid($_GET['uuid']);


        $resultProjectFileVO = $this->project_service->selectFindUUIDProjectFile($pjtFileVO);


        if ( isset($resultProjectFileVO) ){

            // 버그 개선(결과값 출력)
            if ( ArrayUtil::getDimensionArray($resultProjectFileVO) !== -1 ){
                $resultProjectFileVO = array(0 => $resultProjectFileVO);
            }

            $smarty->assign("project_file_item", $resultProjectFileVO);

            $smarty->assign("MAX_FILE_SIZE", $this->getUploadSize());
            $smarty->assign("title", "프로젝트/프로젝트 수정/파일 삭제:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('project_delete_file.tpl');

        }

        else if ( !isset($resultProjectFileVO) ){
            
            echo "<script>";
            echo "alert('파일이 존재하지 않습니다.');";
            echo "location.replace('../portal/project?func=list');";
            echo "</script>";
            exit;

        }

    }

    public function project_file_delete_ok($projectFileVO){

        $this->loadService();

        $targetDir = $this->getRootDir();

        $status = 1;
        $resultProjectFile = $this->project_service->selectFindUUIDProjectFile($projectFileVO);

        // 파일이 DB에 존재할 때
        if ( !isset ( $resultProjectFile ) ){
            $status = -1;
        }

        // 삭제 프로세스
        if ($status === 1){
                
            //$result = $this->employee_service->deleteEmployee($curEmpVO);

            $targetDir = $targetDir . $resultProjectFile['upload_dir'];
            $upload_dir_uuid_fullpath = $targetDir . "/" . $resultProjectFile['uuid'];
            $uploadRealName = $targetDir . $resultProjectFile['file_name'];

            // 파일 삭제
            if ( is_file($uploadRealName) ){
                unlink($uploadRealName);
            }

            // 폴더 삭제
            rmdir($upload_dir_uuid_fullpath);   // 임시 삭제
            
            $result = $this->project_service->deleteFindUUIDProjectFile($projectFileVO);

            if ($result === 1){
                echo "<script>";
                echo "alert ('성공적으로 삭제하였습니다.');";
                echo "location.replace('../portal/project?func=modify&id=" . $projectFileVO->getProject_id() . "');";
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

    public function project_delete_ok($projectVO){

        $this->loadService();
        $status = 1;

        $productVO = new ProductVO();
        $productVO->setProject_id($projectVO->getProject_id());

        $targetDir = $this->getRootDir();
        
        // 프로젝트 ID값 존재 여부
        if ( ( $projectVO->getProject_id() !== -1 || 
                $projectVO->getProject_id() !== -2 ) && 
            $status === 1){
            $status = 1;
        }else if ( $projectVO->getProject_id() === -1 && 
                    $status === 1){
            $status = -1;
        }else if ( $projectVO->getProject_id() === -2 && 
                    $status === 1){
            $status = -2;
        }

        // 하위 데이터 존재 여부
        if ($status === 1){

            // 프로젝트 존재 여부 찾기
            $result_project = $this->project_service->selectFindIDProject($projectVO);

            if ( !isset($result_project) && 
                $status === 1 ){
                $status = -3;
            }

            // 해당 프로젝트의 제품 찾기
            $result_product = $this->product_service->selectProductFindProjectId($productVO);

            if ( isset($result_product) && 
                $status === 1 ){
                $status = -4;
            }

            // 해당 프로젝트의 창고 내 존재 여부 찾기
            $result_warehouse = $this->warehouse_service->selectWarehouseFindProjectId($productVO);

            if ( isset($result_warehouse) && 
                $status === 1 ){
                $status = -5;
            }

        }

        // 하위 데이터가 존재하지 않을 때
        if ($status === 1){
            $result_uuid = $this->project_service->selectFindIDProjectFile($projectVO);

            // 1단계: 파일 삭제 프로세스 
            foreach($result_uuid as $resultProjectFile){

                $projectFileVO = new ProjectFileVO();
                $projectFileVO->setUuid($resultProjectFile['uuid']);

                // echo $resultProjectFile['uuid'] . "<br>";                
                $targetDir = $targetDir . $resultProjectFile['upload_dir'];
                $upload_dir_uuid_fullpath = $targetDir . "/" . $resultProjectFile['uuid'];
                $uploadRealName = $targetDir . $resultProjectFile['file_name'];

                // 파일 삭제
                if ( is_file($uploadRealName) ){
                    unlink($uploadRealName);
                }

                // 폴더 삭제
                rmdir($upload_dir_uuid_fullpath);   // 임시 삭제
                
                $result = $this->project_service->deleteFindUUIDProjectFile($projectFileVO);

            }

            // 2단계: DB삭제
            $this->project_service->deleteProject($projectVO);

            echo "<script>";
            echo "alert ('성공적으로 삭제하였습니다.');";
            echo "location.replace('../portal/project?func=list');";
            echo "</script>";
            exit;

        }
        else if ($status === -1){

            echo "<script>";
            echo "alert ('올바른 프로젝트 값을 입력하세요.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -2){

            echo "<script>";
            echo "alert ('프로젝트 값이 유효하지 않습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -3){

            echo "<script>";
            echo "alert ('프로젝트가 존재하지 않습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -4){

            echo "<script>";
            echo "alert ('프로젝트 내 유효한 제품이 존재합니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -5){

            echo "<script>";
            echo "alert ('창고에 유효한 프로젝트가 존재합니다.');";
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

    public function process_register($projectProcessVO){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $projectVO = new ProjectVO();
        $projectVO->setProject_id($projectProcessVO->getProject_id());

        $result = $this->project_service->selectFindIDProject($projectVO);

        if ( isset( $result ) ){

            $smarty->assign("project_id", $projectVO->getProject_id());
            $smarty->assign("MAX_FILE_SIZE", $this->getUploadSize());
            $smarty->assign("title", "프로젝트/공정 등록:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('project_process_register.tpl');
        
        }
        else{
            
            echo "<script>";
            echo "alert ('존재하지 않는 프로젝트입니다.');";
            echo "history.back();";
            echo "</script>";
            exit;

        }

    }

    public function process_register_ok($projectProcessVO){

        $this->templateDir();
        $this->loadService();

        $status = 1;

        $projectVO = new ProjectVO();
        $projectVO->setProject_id($projectProcessVO->getProject_id());

        $result = $this->project_service->selectFindIDProject($projectVO);
        
        // 프로젝트 ID 유효 여부
        if ( isset($result) && 
            $status === 1 ){
            $status = 1;
        }
        else if ( !isset($result) && 
                $status === 1 ){
            $status = -1;
        }

        // 프로세스 명 입력 여부
        if ( ( $projectProcessVO->getProcess_name() !== -1 || 
               $projectProcessVO->getProcess_name() !== -2 ) && 
            $status === 1 ){
            $status = 1;
        }
        else if ($projectProcessVO->getProcess_name() === -1 &&
            $status === 1) {
            $status = -2;
        }
        else if ($projectProcessVO->getProcess_name() === -2 &&
            $status === 1) {
            $status = -3;
        }

        // 등록 프로세스
        if ( $status === 1){

            $result = $this->project_service->insertProjectProcess($projectProcessVO);
            
            echo "<script>";
            echo "alert ('성공적으로 등록하였습니다.');";
            echo "location.replace('../portal/project?func=process&project_id=" . $projectProcessVO->getProject_id() . "&view=list');";
            echo "</script>";
            exit;

        }
        else if ( $status === -1 ){
            
            echo "<script>";
            echo "alert ('프로젝트가 존재하지 않습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
            
        }
        else if ( $status === -2 ){
            
            echo "<script>";
            echo "alert ('공정명이 짧습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
            
        }
        else if ( $status === -3 ){
            
            echo "<script>";
            echo "alert ('공정명을 입력하세요.');";
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

    public function process_modify($projectProcessVO){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $projectVO = new ProjectVO();
        $projectVO->setProject_id($projectProcessVO->getProject_id());

        $result = $this->project_service->selectFindIDProject($projectVO);
        $project_process_item = $this->project_service->selectProjectProcessFindUuid($projectProcessVO);


        if ( isset( $result ) ){

            $smarty->assign("process_uuid", $projectProcessVO->getProcess_uuid());
            $smarty->assign("project_process_item", $project_process_item);
            $smarty->assign("project_id", $projectVO->getProject_id());
            $smarty->assign("MAX_FILE_SIZE", $this->getUploadSize());
            $smarty->assign("title", "프로젝트/공정 수정:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('project_process_modify.tpl');
        
        }
        else{
            
            echo "<script>";
            echo "alert ('존재하지 않는 프로젝트입니다.');";
            echo "history.back();";
            echo "</script>";
            exit;

        }

    }

    public function process_modify_ok($projectProcessVO){
        
        $this->templateDir();
        $this->loadService();

        $status = 1;

        $projectVO = new ProjectVO();
        $projectVO->setProject_id($projectProcessVO->getProject_id());

        $result = $this->project_service->selectFindIDProject($projectVO);
        
        // 프로젝트 ID 유효 여부
        if ( isset($result) && 
            $status === 1 ){
            $status = 1;
        }
        else if ( !isset($result) && 
                $status === 1 ){
            $status = -1;
        }

        $result = $this->project_service->selectProjectProcessFindUuid($projectProcessVO);

        // 프로젝트 UUID 검색
        if ( isset($result) && 
            $status === 1 ){
            $status = 1;
        }
        else if ( !isset($result) && 
                $status === 1 ){
            $status = -2;
        }

        // 프로세스 명 입력 여부
        if ( ( $projectProcessVO->getProcess_name() !== -1 || 
               $projectProcessVO->getProcess_name() !== -2 ) && 
            $status === 1 ){
            $status = 1;
        }
        else if ($projectProcessVO->getProcess_name() === -1 &&
            $status === 1) {
            $status = -3;
        }
        else if ($projectProcessVO->getProcess_name() === -2 &&
            $status === 1) {
            $status = -4;
        }

        // 등록 프로세스
        if ( $status === 1){

            $result = $this->project_service->updateProjectProcess($projectProcessVO);
            
            echo "<script>";
            echo "alert ('성공적으로 수정하였습니다.');";
            echo "location.replace('../portal/project?func=process&project_id=" . $projectProcessVO->getProject_id() . "&view=list');";
            echo "</script>";
            exit;

        }
        else if ( $status === -1 ){
            
            echo "<script>";
            echo "alert ('프로젝트가 존재하지 않습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
            
        }
        else if ( $status === -2 ){
            
            echo "<script>";
            echo "alert ('공정 UUID가 존재하지 않습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
            
        }
        else if ( $status === -3 ){
            
            echo "<script>";
            echo "alert ('공정명이 짧습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
            
        }
        else if ( $status === -4 ){
            
            echo "<script>";
            echo "alert ('공정명을 입력하세요.');";
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

    
    public function process_delete($projectProcessVO){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $projectVO = new ProjectVO();
        $projectVO->setProject_id($projectProcessVO->getProject_id());

        $result = $this->project_service->selectFindIDProject($projectVO);
        $project_process_item = $this->project_service->selectProjectProcessFindUuid($projectProcessVO);


        if ( isset( $result ) ){

            $smarty->assign("process_uuid", $projectProcessVO->getProcess_uuid());
            $smarty->assign("project_process_item", $project_process_item);
            $smarty->assign("project_id", $projectVO->getProject_id());
            $smarty->assign("MAX_FILE_SIZE", $this->getUploadSize());
            $smarty->assign("title", "프로젝트/공정 삭제:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('project_process_delete.tpl');
        
        }
        else{
            
            echo "<script>";
            echo "alert ('존재하지 않는 프로젝트입니다.');";
            echo "history.back();";
            echo "</script>";
            exit;

        }

    }

    public function process_delete_ok($projectProcessVO){

        
        $this->templateDir();
        $this->loadService();

        $status = 1;

        $projectVO = new ProjectVO();
        $projectVO->setProject_id($projectProcessVO->getProject_id());

        $result = $this->project_service->selectFindIDProject($projectVO);
        
        // 프로젝트 ID 유효 여부
        if ( isset($result) && 
            $status === 1 ){
            $status = 1;
        }
        else if ( !isset($result) && 
                $status === 1 ){
            $status = -1;
        }

        $result = $this->project_service->selectProjectProcessFindUuid($projectProcessVO);

        // 프로젝트 UUID 검색
        if ( isset($result) && 
            $status === 1 ){
            $status = 1;
        }
        else if ( !isset($result) && 
                $status === 1 ){
            $status = -2;
        }

        // 등록 프로세스
        if ( $status === 1){

            $result = $this->project_service->deleteProjectProcess($projectProcessVO);
            
            echo "<script>";
            echo "alert ('성공적으로 삭제하였습니다.');";
            echo "location.replace('../portal/project?func=process&project_id=" . $projectProcessVO->getProject_id() . "&view=list');";
            echo "</script>";
            exit;

        }
        else if ( $status === -1 ){
            
            echo "<script>";
            echo "alert ('프로젝트가 존재하지 않습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
            
        }
        else if ( $status === -2 ){
            
            echo "<script>";
            echo "alert ('공정 UUID가 존재하지 않습니다.');";
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

    public function process_list($pageCri, $projectProcessVO){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $projectVO = new ProjectVO();
        $projectVO->setProject_id($projectProcessVO->getProject_id());

        $result = $this->project_service->selectFindIDProject($projectVO);

        if ( isset($result) ){

            $paging = new Paging();

            $result = $this->project_service->selectAllProjectProcessCountFindProjectId($projectProcessVO);
            $total_cnt = $result['cnt'];


            $page_no = $pageCri->getPage();
            $page_size = $pageCri->getPerPageNum();

            $paging->setPageNo($page_no);
            $paging->setPageSize($page_size);
            $paging->setTotalCount($total_cnt);

            $pagingObj = $paging->getObject();

            $startnum = $paging->getDbStartNum();
            $endnum = $paging->getDbEndNum();


            $projectProcessList = $this->project_service->selectPagingProjectProcessFindProjectId($startnum, $endnum, $projectProcessVO);
            //echo $keyword;
            //print_r($productList);

            $var_fn = "&func=process&project_id=" . $projectProcessVO->getProject_id() . "&view=list";

            $smarty->assign("project_id", $projectProcessVO->getProject_id());
            $smarty->assign("projectProcessList", $projectProcessList);
            $smarty->assign("pagingObj", $pagingObj);
            $smarty->assign("fn", $var_fn);

            $smarty->assign("title", "프로젝트/공정 현황:::Smart Premiere");
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('project_process_list.tpl');

        }
        else{
            
            echo "<script>";
            echo "alert ('존재하지 않는 프로젝트입니다.');";
            echo "history.back();";
            echo "</script>";
            exit;

        }

    }

}

?>