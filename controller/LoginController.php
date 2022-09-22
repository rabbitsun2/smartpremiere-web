<?php
/*
 * Created Date: 2022-06-09 (Thu)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Controller
 * Filename: LoginController.php
 * Description:
 * 1. CSRF 토큰 인증, 정도윤, 2022-07-25 (Mon).
 * 2. MemberController에서 LoginController로 변경, 정도윤, 2022-08-14 (Sun).
 */

class LoginController extends Controller {
    
    private $member_service;
    
    public function __construct(){
        
    }
    
    public function __destruct(){
        
    }
    
    private function loadService(){
        
        $this->member_service = new MemberServiceImpl();
        
        $my_conn = $this->getConn();
        $this->member_service->setConn($my_conn);

        // print_r($my_conn);
        // echo "<br>";
        // print_r($this->emp_service);

    }
    
    private function templateDir(){
                
    }
    
    public function login($memberVO){
        //echo "홈2 / 참";
        //require_once $this->root_dir . "view/home.php";
        
        $status = -1;
        
        $this->loadService();
        
        // print_r($my_conn);
        // echo "<br>";
        // print_r($this->emp_service);
        $resultMemberVO = $this->member_service->selectMember($memberVO);
        
        // print_r($employeeVO);
        // echo "<br>";
        // print_r($resultEmpVO);
        // echo "<br>";
        
        // echo "--------<br>";
        // echo "출력1:" . $status;
        // echo "<br>";
        
        // 데이터가 존재할 때
        if ( isset($resultMemberVO) ){
                    
            // 아이디 일치 여부
            if ( strcmp($memberVO->getEmail(), $resultMemberVO["email"] ) === 0 ){
                $status = 1;
            }else{
                $status = 2;
            }
            
            // echo "출력2:" . $status;
            // echo "<br>";
            
            // 비밀번호 일치 여부
            if ( strcmp($memberVO->getPasswd(), $resultMemberVO["passwd"] ) === 0
                 && $status === 1 ){
                $status = 1;
            }else{
                $status = 3;
            }
            
            // 계정 활성 여부
            if ( strcmp($resultMemberVO["locked"], "활성") === 0 ){
                $status = 1;
            }
            else if ( strcmp($resultMemberVO["locked"], "비활성") === 0 ){
                $status = 4;
            }

            // echo "출력3:" . $status;
            // echo "<br>";
                        
        }

        // 해쉬 일치 여부(CSRF 토큰)
        if (!empty($_POST['token']) && $status === 1) {
            if (hash_equals($_SESSION['token'], $_POST['token'])) {
                 $status = 1;
            } else {
                 // Log this as a warning and keep an eye on these attempts
                 $status = 5;
            }
        }
        
        // 로그인 세션 생성
        if ( $status === 1 ){
            
            $_SESSION['member_id'] = $resultMemberVO['member_id'];
            $_SESSION['email'] = $resultMemberVO['email'];
            $_SESSION['member_auth'] = $resultMemberVO['member_auth'];
            $_SESSION['auth_name'] = $resultMemberVO['auth_name'];
            $_SESSION['usrname'] = $resultMemberVO['usrname'];
            $_SESSION['passwd'] = $resultMemberVO['passwd'];

            
            echo "<script>";
            echo "location.replace('../portal/main');";
            echo "</script>";
            exit;
        }
        else if ( $status === 2 ){
            
            echo "<script>";
            echo "alert('아이디가 일치하지 않습니다.');";
            echo "location.replace('../..');";
            echo "</script>";
            exit;
            
        }
        else if ( $status === 3 ){
            
            echo "<script>";
            echo "alert('비밀번호가 일치하지 않습니다.');";
            echo "location.replace('../..');";
            echo "</script>";
            exit;
            
        }
        else if ( $status === 4 ){
            
            echo "<script>";
            echo "alert('계정이 비활성화 상태입니다.');";
            echo "location.replace('../..');";
            echo "</script>";
            exit;
            
        }
        else if ( $status === 5 ){
            
            echo "<script>";
            echo "alert('토큰 오류<br>정상적인 방법으로 접근하세요.');";
            echo "location.replace('../..');";
            echo "</script>";
            exit;
            
        }
        else if ( $status === -1 ){
            
            echo "<script>";
            echo "alert('계정 정보를 찾을 수 없습니다.');";
            echo "location.replace('../..');";
            echo "</script>";
            exit;
            
        }
        
        /*
        $this->templateDir();
        $smarty = $this->getSmarty();
        $smarty->clearAllCache();
        
        $smarty->assign("title", "Smart Logistics");
        $smarty->display('index.tpl');
        
        */
        
    }
    
}

?>