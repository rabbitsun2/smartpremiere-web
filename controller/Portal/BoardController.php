<?php
/*
 * Created Date: 2022-08-31 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Controller
 * Filename: BoardController.php
 * Description:
 * - 1. 게시판 컨트롤러 생성, 정도윤(Doyun Jung), 2022-08-31 (Wed)
 * 
 */

class BoardController extends Controller {

    private $dbms_service;
    private $board_service;

    public function __construct(){
        
    }
    
    public function __destruct(){
        
    }
    
    private function templateDir(){

        $smarty = $this->getSmarty();
        $root_dir = $this->getRootDir();
        $smarty->setTemplateDir($root_dir . '/view/main/board');

        $this->setSmarty($smarty);
        
    }

    private function loadService(){
        
        $this->dbms_service = new DbmsServiceImpl();
        $this->board_service = new BoardServiceImpl();
        
        $my_conn = $this->getConn();
        $this->dbms_service->setConn($my_conn);
        $this->board_service->setConn($my_conn);

        //print_r($this->warehouse_service);

    }
    public function board_list($boardVO, $pageCri){
        
        $this->templateDir();
        $this->loadService();

        $status = 1;
        
        $smarty = $this->getSmarty();
        $smarty->clearAllCache();
        
        $tablename = "smart_board_" . $boardVO->getBoardname();
        $result_is_tablename = $this->dbms_service->selectFindTablename( $tablename );

        if ( strcmp($result_is_tablename, '1') === 0 &&
            $status === 1){
            $status = 1;
        }else if ( strcmp($result_is_tablename, '1') !== 0 &&
            $status === 1){
            $status = -1;
        }

        if ( $status === 1 ){ 

            $paging = new Paging();
            
            $result = $this->board_service->selectAllBoardCount( $boardVO->getBoardname() );
            $total_cnt = $result['cnt'];
            
            
            $page_no = $pageCri->getPage();
            $page_size = $pageCri->getPerPageNum();
            
            $paging->setPageNo($page_no);
            $paging->setPageSize($page_size);
            $paging->setTotalCount($total_cnt);
            
            $pagingObj = $paging->getObject();
            $startnum = $paging->getDbStartNum();
            $endnum = $paging->getDbEndNum();
            
            $boardList = $this->board_service->selectPagingBoardList( $boardVO->getBoardname(), $startnum, $endnum );
            
            $var_fn = "&func=list&boardname=" . $boardVO->getBoardname();
            
            $smarty->assign("boardname", $boardVO->getBoardname() );
            $smarty->assign("boardList", $boardList);
            $smarty->assign("pagingObj", $pagingObj);
            $smarty->assign("fn", $var_fn);
            
            $smarty->assign("MAX_FILE_SIZE", $this->getUploadSize() );
            $smarty->assign("title", "게시판/목록:::Smart Premiere");
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('board_list.tpl');

        }
        
    }

    public function board_write($boardVO){

        $this->templateDir();
        $this->loadService();

        $status = 1;

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $boardname = $boardVO->getBoardname();
        
        $tablename = "smart_board_" . $boardVO->getBoardname();
        $result_is_tablename = $this->dbms_service->selectFindTablename( $tablename );

        if ( strcmp($result_is_tablename, '1') === 0 &&
            $status === 1){
            $status = 1;
        }else if ( strcmp($result_is_tablename, '1') !== 0 &&
            $status === 1){
            $status = -1;
        }


        if ( $status === 1 ){

            $smarty->assign("boardname", $boardname);
            $smarty->assign("title", "게시물 글쓰기:::Smart Premiere");
            $smarty->assign("MAX_FILE_SIZE", $this->getUploadSize());
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('board_write.tpl');

        }

        else if ( $status === -1 ){
            
            echo "<script>";
            echo "alert('게시판이 존재하지 않습니다.');";
            echo "location.replace('../portal/main');";
            echo "</script>";
            exit;

        }

    }

    public function board_write_ok($boardVO, $boardFileArr){

        $this->templateDir();
        $this->loadService();

        $status = 1;

        $boardname = $boardVO->getBoardname();
        
        // 닉네임 입력 여부
        if ( ($boardVO->getNickname() !== -1 || 
              $boardVO->getNickname() !== -2 ) && 
            $status === 1){
            $status = 1;
        }else if ($boardVO->getNickname() === -1 &&
            $status === 1) {
            $status = -1;
        }else if ($boardVO->getNickname() === -2 &&
           $status === 1) {
            $status = -2;
        }

        // 제목 입력 여부
        if ( ( $boardVO->getSubject() !== -1 || 
               $boardVO->getSubject() !== -2 ) && 
            $status === 1 ){
            $status = 1;
        }else if ($boardVO->getSubject() === -1 &&
            $status === 1 ){
            $status = -3;
        }else if ($boardVO->getSubject() === -2 &&
            $status === 1 ){
            $status = -4;
        }

        
        // 내용 입력 여부
        if ( ( $boardVO->getMemo() !== -1 || 
               $boardVO->getMemo() !== -2 ) && 
            $status === 1 ){
            $status = 1;
        }else if ($boardVO->getMemo() === -1 &&
            $status === 1 ){
            $status = -5;
        }else if ($boardVO->getMemo() === -2 &&
            $status === 1 ){
            $status = -6;
        }


        // 파일 확장자 제한 여부
        if ( strcmp( $boardVO->getFile_option() , "NORMAL" ) === 0 &&
               $status === 1 ){

            $status = 1;

        }else if ( strcmp( $boardVO->getFile_option() , "RESTRICT" ) === 0 &&
            $status === 1 ){
            $status = -7;
        }


        if ( $status === 1 ){

            $result = $this->board_service->insertBoard($boardVO);
    
            // 프로젝트 등록이 성공적인 경우
            if ( $result === 1 ){
                
                $result = $this->board_service->selectBoardFindFullQry($boardVO);
                //print_r($result);

                $article_id = $result[0]['article_id'];
                //echo "<br>" . $article_id;
                //print_r($boardFileArr);
                
                // 파일 정보 입력(파일 업로드)
                foreach($boardFileArr as $key=>$val){
                    
                    $val->setBoardname( $boardname );
                    $val->setArticle_id($article_id);
                    
                    if ( strcmp( $val->getOption(), "success" ) === 0 ){
                        $result = $this->board_service->insertBoardFile($val);

                    }
                    
                }

            }
            else{
                //return 0;
                $status = -8;
            }
            
        }


        switch($status){

            // 게시물 등록이 성공일 때
            case 1:

                echo "<script>";
                echo "alert ('성공적으로 등록되었습니다.');";
                echo "location.replace('../portal/board?func=list&boardname=" . $boardname . "');";
                echo "</script>";
                exit;

                break;

            case -1:

                echo "<script>";
                echo "alert('성명 길이가 짧습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -2:

                echo "<script>";
                echo "alert('성명을 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -3:

                echo "<script>";
                echo "alert('제목 길이가 짧습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;
                
                break;

            case -4:

                echo "<script>";
                echo "alert('제목을 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -5:

                echo "<script>";
                echo "alert('내용이 짧습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -6:

                echo "<script>";
                echo "alert('내용을 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -7:

                echo "<script>";
                echo "alert('파일 확장자가 제한되었습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            
            case -8:

                echo "<script>";
                echo "alert('등록에 실패하였습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            default:

                echo "<script>";
                echo "alert('비정상적인 접근입니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

        }

    }

    public function board_view($boardVO){
        
        $this->templateDir();
        $this->loadService();

        $status = 1;

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $boardname = $boardVO->getBoardname();
        
        $tablename = "smart_board_" . $boardVO->getBoardname();
        $result_is_tablename = $this->dbms_service->selectFindTablename( $tablename );

        if ( strcmp($result_is_tablename, '1') === 0 &&
            $status === 1){
            $status = 1;
        }else if ( strcmp($result_is_tablename, '1') !== 0 &&
            $status === 1){
            $status = -1;
        }

        // 테이블 명이 존재할 때 게시물 조회
        if ( $status === 1 ){
            $resultBoardVO = $this->board_service->selectBoardFindId($boardVO);
        }

        if ( isset($resultBoardVO) && 
            $status === 1 ){
            $status = 1;
        }
        else if ( !isset($resultBoardVO) && 
            $status === 1 ){
            $status = -2;
        }

        // 파일 목록 조회
        if ( $status === 1 ){

            $boardFileVO = new BoardFileVO();
            $boardFileVO->setArticle_id($boardVO->getArticle_id());
            $boardFileVO->setBoardname($boardVO->getBoardname());

            $resultBoardFileVO = $this->board_service->selectBoardFileFindId($boardFileVO);

        }
        

        if ( $status === 1 ){

            $smarty->assign("board_item", $resultBoardVO);
            $smarty->assign("board_file_item", $resultBoardFileVO);
            $smarty->assign("boardname", $boardname);
            $smarty->assign("title", "게시물 보기:::Smart Premiere");
            $smarty->assign("MAX_FILE_SIZE", $this->getUploadSize());
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('board_view.tpl');

        }

        else if ( $status === -1 ){

            echo "<script>";
            echo "alert('게시판이 존재하지 않습니다.');";
            echo "location.replace('../portal/main');";
            echo "</script>";
            exit;

        }

        else if ( $status === -2 ){
            
            echo "<script>";
            echo "alert('게시물이 존재하지 않습니다.');";
            echo "location.replace('../portal/board?func=list&boardname=" . $boardVO->getBoardname() . "');";
            echo "</script>";
            exit;

        }

    }

    public function board_modify($boardVO){

        $this->templateDir();
        $this->loadService();

        $status = 1;

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $boardname = $boardVO->getBoardname();
        
        $tablename = "smart_board_" . $boardVO->getBoardname();
        $result_is_tablename = $this->dbms_service->selectFindTablename( $tablename );

        if ( strcmp($result_is_tablename, '1') === 0 &&
            $status === 1){
            $status = 1;
        }else if ( strcmp($result_is_tablename, '1') !== 0 &&
            $status === 1){
            $status = -1;
        }

        // 테이블 명이 존재할 때 게시물 조회
        if ( $status === 1 ){
            $resultBoardVO = $this->board_service->selectBoardFindId($boardVO);
        }

        if ( isset($resultBoardVO) && 
            $status === 1 ){
            $status = 1;
        }
        else if ( !isset($resultBoardVO) && 
            $status === 1 ){
            $status = -2;
        }

        // 파일 목록 조회
        if ( $status === 1 ){

            $boardFileVO = new BoardFileVO();
            $boardFileVO->setArticle_id($boardVO->getArticle_id());
            $boardFileVO->setBoardname($boardVO->getBoardname());

            $resultBoardFileVO = $this->board_service->selectBoardFileFindId($boardFileVO);

        }
        

        if ( $status === 1 ){

            $smarty->assign("board_item", $resultBoardVO);
            $smarty->assign("board_file_item", $resultBoardFileVO);
            $smarty->assign("boardname", $boardname);
            $smarty->assign("title", "게시물 수정:::Smart Premiere");
            $smarty->assign("MAX_FILE_SIZE", $this->getUploadSize());
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('board_modify.tpl');

        }

        else if ( $status === -1 ){

            echo "<script>";
            echo "alert('게시판이 존재하지 않습니다.');";
            echo "location.replace('../portal/main');";
            echo "</script>";
            exit;

        }

        else if ( $status === -2 ){
            
            echo "<script>";
            echo "alert('게시물이 존재하지 않습니다.');";
            echo "location.replace('../portal/board?func=list&boardname=" . $boardVO->getBoardname() . "');";
            echo "</script>";
            exit;

        }
        
    }

    public function board_modify_ok($boardVO, $boardFileArr){

        $this->templateDir();
        $this->loadService();

        $status = 1;
        
        $boardname = $boardVO->getBoardname();
        $tablename = "smart_board_" . $boardname;
        $result_is_tablename = $this->dbms_service->selectFindTablename( $tablename );

        if ( strcmp($result_is_tablename, '1') === 0 &&
            $status === 1){
            $status = 1;
        }else if ( strcmp($result_is_tablename, '1') !== 0 &&
            $status === 1){
            $status = -1;
        }

        // 테이블 명이 존재할 때 게시물 조회
        if ( $status === 1 ){
            $resultBoardVO = $this->board_service->selectBoardFindId($boardVO);
        }

        if ( isset($resultBoardVO) && 
            $status === 1 ){
            $status = 1;
        }
        else if ( !isset($resultBoardVO) && 
            $status === 1 ){
            $status = -2;
        }

        // 별명 입력 여부
        if ( ( $boardVO->getNickname() !== -1 || 
               $boardVO->getNickname() !== -2 ) &&
            $status === 1){
            $status = 1;
        }else if ($boardVO->getNickname() === -1 &&
            $status === 1) {
            $status = -3;
        }else if ($boardVO->getNickname() === -1 &&
            $status === 1) {
            $status = -4;
        }

        // 제목 입력 여부
        if ( ( $boardVO->getSubject() !== -1 || 
               $boardVO->getSubject() !== -2 ) && 
            $status === 1 ){
            $status = 1;
        }else if ($boardVO->getSubject() === -1 &&
            $status === 1 ){
            $status = -5;
        }else if ($boardVO->getSubject() === -2 &&
            $status === 1 ){
            $status = -6;
        }

        // 내용 입력 여부
        if ( ( $boardVO->getMemo() !== -1 || 
               $boardVO->getMemo() !== -2 ) && 
            $status === 1 ){
            $status = 1;
        }else if ($boardVO->getMemo() === -1 &&
            $status === 1 ){
            $status = -7;
        }else if ($boardVO->getMemo() === -2 &&
            $status === 1 ){
            $status = -8;
        }


        // 파일 확장자 제한 여부
        if ( strcmp( $boardVO->getFile_option() , "NORMAL" ) === 0 &&
               $status === 1 ){

            $status = 1;

        }else if ( strcmp( $boardVO->getFile_option() , "RESTRICT" ) === 0 &&
                $status === 1 ){
            $status = -9;
        }

        //echo "참";

        if ( $status === 1 ){

            $result = $this->board_service->updateBoard($boardVO);
    
            // 게시물 수정이 성공적인 경우
            if ( $result === 1 ){
                
                //print_r($result);

                $article_id = $boardVO->getArticle_id();

                //print_r($boardFileArr);
                
                // 파일 정보 입력(파일 업로드)
                foreach($boardFileArr as $key=>$val){
                    
                    $val->setArticle_id($article_id);
                    $val->setBoardname($boardname);
                    
                    if ( strcmp( $val->getOption(), "success" ) === 0 ){
                        $result = $this->board_service->insertBoardFile($val);
                    }
                    
                }

            }
            else{
                //return 0;
                $status = -10;
            }
            
        }


        switch($status){

            // 프로젝트 등록이 성공일 때
            case 1:

                echo "<script>";
                echo "alert ('성공적으로 수정되었습니다.');";
                echo "location.replace('../portal/board?func=list&boardname=" . $boardname . "');";
                echo "</script>";
                exit;

                break;

            case -1:

                echo "<script>";
                echo "alert('게시판이 존재하지 않습니다.');";
                echo "location.replace('../portal/main');";
                echo "</script>";
                exit;
    
                break;
    
            case -2:
                
                echo "<script>";
                echo "alert('게시물이 존재하지 않습니다.');";
                echo "location.replace('../portal/board?func=list&boardname=" . $boardname . "');";
                echo "</script>";
                exit;
    
                break;

            case -3:

                echo "<script>";
                echo "alert('별명이 짧습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -4:

                echo "<script>";
                echo "alert('별명을 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -5:

                echo "<script>";
                echo "alert('제목이 짧습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;
                
                break;

            case -6:

                echo "<script>";
                echo "alert('제목을 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

                
            case -7:

                echo "<script>";
                echo "alert('내용이 짧습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;
                
                break;

            case -8:

                echo "<script>";
                echo "alert('내용을 입력하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -9:

                echo "<script>";
                echo "alert('파일 확장자가 제한되었습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -10:

                echo "<script>";
                echo "alert('게시물 수정에 실패하였습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

        }

    }

    public function board_delete($boardVO){

        $this->templateDir();
        $this->loadService();

        $status = 1;

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        $boardname = $boardVO->getBoardname();
        
        $tablename = "smart_board_" . $boardVO->getBoardname();
        $result_is_tablename = $this->dbms_service->selectFindTablename( $tablename );

        if ( strcmp($result_is_tablename, '1') === 0 &&
            $status === 1){
            $status = 1;
        }else if ( strcmp($result_is_tablename, '1') !== 0 &&
            $status === 1){
            $status = -1;
        }

        // 테이블 명이 존재할 때 게시물 조회
        if ( $status === 1 ){
            $resultBoardVO = $this->board_service->selectBoardFindId($boardVO);
        }

        if ( isset($resultBoardVO) && 
            $status === 1 ){
            $status = 1;
        }
        else if ( !isset($resultBoardVO) && 
            $status === 1 ){
            $status = -2;
        }
       

        if ( $status === 1 ){

            $smarty->assign("board_item", $resultBoardVO);
            $smarty->assign("boardname", $boardname);
            $smarty->assign("title", "게시물 삭제:::Smart Premiere");
            $smarty->assign("MAX_FILE_SIZE", $this->getUploadSize());
            $smarty->assign("session_member_id", $_SESSION['member_id']);
            $smarty->assign("session_email", $_SESSION['email']);
            $smarty->assign("session_auth_name", $_SESSION['auth_name']);
            $smarty->assign("session_usrname", $_SESSION['usrname']);
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("option_selected", "NE");
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('board_delete.tpl');

        }

        else if ( $status === -1 ){

            echo "<script>";
            echo "alert('게시판이 존재하지 않습니다.');";
            echo "location.replace('../portal/main');";
            echo "</script>";
            exit;

        }

        else if ( $status === -2 ){
            
            echo "<script>";
            echo "alert('게시물이 존재하지 않습니다.');";
            echo "location.replace('../portal/board?func=list&boardname=" . $boardVO->getBoardname() . "');";
            echo "</script>";
            exit;

        }

    }
    
    public function board_delete_ok($boardVO){

        $this->loadService();
        $status = 1;

        $targetDir = $this->getRootDir();
        $boardname = $boardVO->getBoardname();
        
        $tablename = "smart_board_" . $boardname;
        $result_is_tablename = $this->dbms_service->selectFindTablename( $tablename );

        if ( strcmp($result_is_tablename, '1') === 0 &&
            $status === 1){
            $status = 1;
        }else if ( strcmp($result_is_tablename, '1') !== 0 &&
            $status === 1){
            $status = -1;
        }

        // 테이블 명이 존재할 때 게시물 조회
        if ( $status === 1 ){
            $resultBoardVO = $this->board_service->selectBoardFindId($boardVO);
        }

        if ( isset($resultBoardVO) && 
            $status === 1 ){
            $status = 1;
        }
        else if ( !isset($resultBoardVO) && 
            $status === 1 ){
            $status = -2;
        }

        // 게시물 ID값 유효 여부
        if ( ( $boardVO->getArticle_id() !== -1 || 
                $boardVO->getArticle_id() !== -2 ) && 
            $status === 1){
            $status = 1;
        }else if ( $boardVO->getArticle_id() === -1 && 
                    $status === 1){
            $status = -3;
        }else if ( $boardVO->getArticle_id() === -2 && 
                    $status === 1){
            $status = -4;
        }

        // 삭제 프로세스
        if ($status === 1){
            
            $boardFileVO = new BoardFileVO();
            $boardFileVO->setArticle_id( $boardVO->getArticle_id() );
            $boardFileVO->setBoardname( $boardname );
            $result_uuid = $this->board_service->selectBoardFileFindId($boardFileVO);

            // 1단계: 파일 삭제 프로세스 
            foreach($result_uuid as $resultBoardFile){

                $boardFileVO->setUuid($resultBoardFile[0]['uuid']);

                // echo $resultProjectFile['uuid'] . "<br>";                
                $targetDir = $targetDir . $resultBoardFile[0]['upload_dir'];
                $upload_dir_uuid_fullpath = $targetDir . "/" . $resultBoardFile[0]['uuid'];
                $uploadRealName = $targetDir . $resultBoardFile[0]['file_name'];

                // 파일 삭제
                if ( is_file($uploadRealName) ){
                    unlink($uploadRealName);
                }

                // 폴더 삭제
                rmdir($upload_dir_uuid_fullpath);   // 임시 삭제
                
                $result = $this->board_service->deleteFindUUIDBoardFile($boardFileVO);

            }

            // 2단계: DB삭제
            $this->board_service->deleteBoard($boardVO);

            echo "<script>";
            echo "alert ('성공적으로 삭제하였습니다.');";
            echo "location.replace('../portal/board?func=list&boardname=" . $boardname . "');";
            echo "</script>";
            exit;

        }
        else if ( $status === -1 ){

            echo "<script>";
            echo "alert('게시판이 존재하지 않습니다.');";
            echo "location.replace('../portal/main');";
            echo "</script>";
            exit;

        }

        else if ( $status === -2 ){
            
            echo "<script>";
            echo "alert('게시물이 존재하지 않습니다.');";
            echo "location.replace('../portal/board?func=list&boardname=" . $boardVO->getBoardname() . "');";
            echo "</script>";
            exit;

        }
        else if ($status === -3){

            echo "<script>";
            echo "alert ('게시물 ID가 유효하지 않습니다.');";
            echo "history.back();";
            echo "</script>";
            exit;
        }
        else if ($status === -4){

            echo "<script>";
            echo "alert ('게시물 ID가 존재하지 않습니다.');";
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