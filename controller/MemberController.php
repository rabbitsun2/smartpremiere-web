<?php
/*
 * Created Date: 2022-07-25 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Controller
 * Filename: MemberController.php
 * Description:
 * 1. 신규 계정 생성 기능 추가, 정도윤, 2022-07-26 (Tue)
 * 2. HelloController에서 MemberController로 변경, 정도윤, 2022-09-08 (Thu)
 */

class MemberController extends Controller {
    
    private $member_service;
    private $member_auth_service;
    private $member_agreement_service;

    public function __construct(){
        
    }
    
    public function __destruct(){
        
    }
    
    private function templateDir(){
        $smarty = $this->getSmarty();
        $root_dir = $this->getRootDir();
        $smarty->setTemplateDir($root_dir . '/view/main/member');
        
        $this->setSmarty($smarty);
        
    }

    private function loadService(){
        
        $this->member_service = new MemberServiceImpl();
        $this->member_auth_service = new MemberAuthServiceImpl();
        $this->member_agreement_service = new MemberAgreementServiceImpl();
        
        $my_conn = $this->getConn();
        $this->member_service->setConn($my_conn);
        $this->member_auth_service->setConn($my_conn);
        $this->member_agreement_service->setConn($my_conn);

        //print_r($this->warehouse_service);

    }
    
    public function hello(){
        
        $this->templateDir();
        $this->loadService();

        if ( !isset($_POST['func']) ){

            $smarty = $this->getSmarty();
            $smarty->clearAllCache();

            // 기초 권한 생성
            $this->basic_setup_auth();
            
            $smarty->assign("title", "Smart Premiere - Welcome");
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('register_agree.tpl');

        }

        // 동의 여부
        else if ( isset($_POST['func']) ){
            #echo "참1" . "/" . isset($_GET['search']);

            // 등록 처리
            if ( strcmp( $_POST['func'], 'input' ) === 0 && 
                 strcmp( $_POST['srtype'], 'submit' ) === 0 && 
                 isset( $_POST['srtype'] )){
                
                $status = 1;

                $currentVO = new MemberVO();
                $memberVO = new MemberVO();
                $memberAgreementVO = new MemberAgreementVO();

                $dt = new DateTime('NOW');
                $dt = $dt->format('Y-m-d H:i:s');

                $currentVO->setEmail($_POST["email"]);

                $resultMember = $this->member_service->selectMember($currentVO);

                // 이메일 주소 입력 확인
                if ( isset($_POST["email"]) && 
                    PregMatch::mail_check($_POST["email"]) === true ){
                    
                    $memberVO->setEmail($_POST["email"]);

                }else if ( isset($_POST["email"]) &&
                    PregMatch::mail_check($_POST["email"]) === false ){
                    
                    $memberVO->setEmail(-1);

                }else if ( !isset($_POST["email"]) ){

                    $memberVO->setEmail(-2);
                }

                // 이메일 주소 중복 확인
                if ( isset($resultMember) ){
                    $memberVO->setEmail(-3);    // 중복되었을 때
                }
                
                // 사용자 권한
                $memberVO->setMember_auth(1);

                // 사용자명
                if (isset($_POST['usrname']) && 
                    strlen($_POST['usrname'] > 3)){
                    $memberVO->setUsrname($_POST['usrname']);
                }else{
                    $memberVO->setUsrname(-1);
                }

                // 비밀번호 확인
                if ( isset( $_POST["passwd1"] ) && 
                     isset( $_POST["passwd2"] ) && 
                     strcmp ($_POST["passwd1"], $_POST["passwd2"]) === 0 && 
                     strlen ($_POST["passwd1"]) > 4){
                        
                    $passwd = base64_encode( hash('sha256', $_POST["passwd1"], true) );
                    $memberVO->setPasswd($passwd);

                }else if ( isset( $_POST["passwd1"] ) && 
                            isset( $_POST["passwd2"] ) && 
                            strcmp ($_POST["passwd1"], $_POST["passwd2"]) === 0 && 
                            strlen ($_POST["passwd1"]) <= 4){

                    $memberVO->setPasswd(-1);

                }else if ( isset( $_POST["passwd1"] ) && 
                            isset( $_POST["passwd2"] ) && 
                            strcmp ($_POST["passwd1"], $_POST["passwd2"]) !== 0){

                    $memberVO->setPasswd(-2);

                }else if ( !isset( $_POST["passwd1"] ) || 
                            !isset( $_POST["passwd2"] ) ){

                    $memberVO->setPasswd(-3);

                }else{
                    $memberVO->setPasswd(-4);
                }

                //echo $memberVO->getPasswd() . "/" . $_POST["passwd1"] . "/" . $_POST["passwd2"] . "<br>";
                //echo strcmp ($_POST["passwd1"], $_POST["passwd2"]) . "/" . strlen ($_POST["passwd1"]) . "<br>";

                // 필수 동의
                if ( isset($_POST["require_agree"]) &&  
                      strcmp($_POST["require_agree"], "on") === 0 ){
                    
                    $memberAgreementVO->setRequire_agree(1);

                }else if ( !isset ($_POST["require_agree"])){
                    
                    $memberAgreementVO->setRequire_agree(-1);
                }

                // 옵션 동의(또는 선택 동의)
                if ( isset($_POST["option_agree"]) ){

                    if ( strcmp($_POST["option_agree"], "on") === 0 ){
                        $memberAgreementVO->setOption_agree(1);
                    }else{
                        $memberAgreementVO->setOption_agree(0);
                    }
                }else if ( !isset($_POST["option_agree"] ) ){
                    $memberAgreementVO->setOption_agree(0);
                }

                // 계정 - 등록일자
                $memberVO->setRegidate($dt);

                // 계정 - 수정일자
                $memberVO->setModify_date($dt);

                $resultMember = $this->member_service->selectAllMemberCount();

                // 락 설정
                if ( $resultMember['cnt'] > 0 ){
                    $memberVO->setLocked("비활성");
                }
                else if ( $resultMember['cnt'] === 0 ){
                    $memberVO->setLocked("활성");
                }

                // IP주소
                $memberVO->setIp(Network::get_client_ip());

                // 약관 - 처음 동의 상태
                $memberAgreementVO->setStatus("초기");

                // 약관 - 등록일자
                $memberAgreementVO->setRegidate($dt);

                // 약관 - IP주소
                $memberAgreementVO->setIp(Network::get_client_ip());
                
                // echo $memberAgreementVO->getRequire_agree() . "/" . $memberAgreementVO->getOption_agree() . "<br>";

                $this->hello_ok($memberVO, $memberAgreementVO);

            }

        }
        
    }

    public function hello_agree(){

        $this->templateDir();
        $this->loadService();

        // 동의 여부
        if ( isset($_POST['func']) ){
            #echo "참1" . "/" . isset($_GET['search']);

            // 동의함 여부
            if ( strcmp( $_POST['func'], 'agree' ) === 0 && 
                 strcmp( $_POST['srtype'], 'submit' ) === 0 && 
                 isset( $_POST['srtype'] )){
                
                $memberAgreementVO = new MemberAgreementVO();

                // 필수 동의
                if ( isset($_POST["require_agree"]) &&  
                      strcmp($_POST["require_agree"], "on") === 0 ){
                    
                    $memberAgreementVO->setRequire_agree(1);

                }else if ( !isset ($_POST["require_agree"])){
                    
                    $memberAgreementVO->setRequire_agree(-1);
                }

                // 옵션 동의(또는 선택 동의)
                if ( isset($_POST["option_agree"]) ){

                    if ( strcmp($_POST["option_agree"], "on") === 0 ){
                        $memberAgreementVO->setOption_agree(1);
                    }else{
                        $memberAgreementVO->setOption_agree(0);
                    }
                }else if ( !isset($_POST["option_agree"] ) ){
                    $memberAgreementVO->setOption_agree(0);
                }

                $this->hello_agree_ok($memberAgreementVO);

            }

        }

    }

    private function hello_agree_ok($memberAgreementVO){

        $status = 1;

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();

        // 필수 동의
        if ( $memberAgreementVO->getRequire_agree() === 1 && 
             $status === 1){
            $status = 1;
        }else if ( $memberAgreementVO->getRequire_agree() === -1 &&
            $status === 1 ){
            $status = -1;
        }

        if ( $status === 1 ){
            
            $smarty->assign("title", "Smart Premiere - Welcome");
            $smarty->assign("require_agree", $memberAgreementVO->getRequire_agree() );
            $smarty->assign("option_agree", $memberAgreementVO->getOption_agree() );
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('register_field.tpl');

        }
        else if ($status === -1){

            echo "<script>";
            echo "alert ('필수 동의를 선택하세요.');";
            echo "history.back();";
            echo "</script>";
            exit;

        }

    }

    private function hello_ok($memberVO, $memberAgreementVO){

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

        // 필수 동의
        if ( $memberAgreementVO->getRequire_agree() === 1 && 
             $status === 1){
            $status = 1;
        }else if ( $memberAgreementVO->getRequire_agree() === -1 &&
            $status === 1 ){
            $status = -11;
        }

        //echo "참3 /" . $status . "<br>";

        // 입력 프로세스
        if ($status === 1){
            //echo "참4<br>";
            $result = $this->member_service->insertMember($memberVO);
            $resultMember = $this->member_service->selectMember($memberVO);

            $member_id = -1;
            if ( isset($resultMember) ){
                $member_id = $resultMember['member_id'];
            }

            // 멤버 ID값 할당
            $memberAgreementVO->setMember_id($member_id);
            $resultAgreement = $this->member_agreement_service->insertMemberAgreement($memberAgreementVO);

            echo "<script>";
            echo "alert ('성공적으로 등록되었습니다.');";
            echo "location.replace('../../');";
            echo "</script>";
            exit;

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
        else if ($status === -11){

            echo "<script>";
            echo "alert ('필수 동의를 선택하세요.');";
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

    private function basic_setup_auth(){

        $status = 1;
        $this->loadService();

        $resultMemberAuth = $this->member_auth_service->selectCountAllMemberAuth();

        // 1단계 - 기초 권한 생성 여부
        if ( isset($resultMemberAuth) ){

            if ( $resultMemberAuth[0]['cnt'] > 0 ){
                $status = -1;
            }else {
                $status = 1;
            }

        }

        //print_r($resultMemberAuth);
        //echo "<br>" . $resultMemberAuth[0]['cnt'] . "/" . $status . "/2<br>";

        // 데이터 등록
        if ( $status === 1 ){
            
            $memberAuthVO = new MemberAuthVO();
            $memberAuthVO->setId(1);
            $memberAuthVO->setAuth_name("관리자");
            $result = $this->member_auth_service->insertMemberAuth($memberAuthVO);

            $memberAuthVO->setId(2);
            $memberAuthVO->setAuth_name("일반");
            $result = $this->member_auth_service->insertMemberAuth($memberAuthVO);

            $result = $this->member_auth_service->alterAutoIncrement();

        }

    }

    public function passwd_find(){

        $this->templateDir();
        $this->loadService();

        if ( !isset($_POST['func']) ){

            $smarty = $this->getSmarty();
            $smarty->clearAllCache();
    
            // 토큰 생성
            if (empty($_SESSION['passwd_find_token'])) {
                $_SESSION['passwd_find_token'] = bin2hex(random_bytes(32));
            }

            $passwd_find_token = $_SESSION['passwd_find_token'];
            
            $smarty->assign("passwd_find_token", $passwd_find_token);
            $smarty->assign("title", "Smart Premiere - 비밀번호 찾기");
            $smarty->assign("service_mode", $this->getServiceMode() );
            $smarty->assign("today", date("Y-m-d H:i:s"));
            $smarty->display('passwd_find.tpl');

        }
        
        // 등록 처리
        else if ( isset( $_POST['func'] ) && 
            isset( $_POST['srtype'] ) && 
            isset( $_POST['token'] ) && 
            isset( $_POST['usrname'] ) && 
            isset( $_POST['email'] ) && 
            strcmp( $_POST['func'], 'passwd_find' ) === 0 && 
            strcmp( $_POST['srtype'], 'submit') === 0 ){
            
            $memberVO = new MemberVO();
            $memberVO->setEmail( $_POST["email"] );

            // 사용자명
            if (isset($_POST['usrname']) && 
                strlen($_POST['usrname'] > 3)){
                $memberVO->setUsrname( $_POST['usrname'] );
            }else{
                $memberVO->setUsrname(-1);
            }

            // 이메일 주소 입력 확인
            if ( isset($_POST["email"]) && 
                PregMatch::mail_check($_POST["email"]) === true ){
                
                $memberVO->setEmail($_POST["email"]);

            }else if ( isset($_POST["email"]) &&
                PregMatch::mail_check($_POST["email"]) === false ){
                
                $memberVO->setEmail(-1);

            }else if ( !isset($_POST["email"]) ){

                $memberVO->setEmail(-2);
            }

            $resultMember = $this->member_service->selectMemberFindEmailAndUsrname($memberVO);

            // 이메일 주소 존재 확인
            if ( !isset($resultMember) ){
                $memberVO->setEmail(-3);
            }

            $this->passwd_find_ok($memberVO);

        }

    }

    private function passwd_find_ok($memberVO){

        $this->templateDir();
        $this->loadService();

        $rand_passwd = RandUtil::createPassword();

        $status = 1;

        // 사용자명 입력 상태
        if ($memberVO->getUsrname() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $memberVO->getUsrname() === -1 &&
                   $status === 1 ){
            $status = -1;
        }

        // 이메일 형식 성공
        if ( ( $memberVO->getEmail() !== -1 && 
               $memberVO->getEmail() !== -2 && 
               $memberVO->getEmail() !== -3 ) && 
               $status === 1 ){
            $status = 1;
        }
        // 이메일 형식 불일치
        else if ( $memberVO->getEmail() === -1 && 
            $status === 1 ){
            $status = -2;
        }
        // 이메일 주소 없음
        else if ( $memberVO->getEmail() === -2 && 
            $status === 1 ){
            $status = -3;
        }
        // 이메일 DB에 존재 안함
        else if ( $memberVO->getEmail() === -3 && 
            $status === 1 ){
            $status = -4;
        }

        // 해쉬 일치 여부(CSRF 토큰)
        if (!empty($_POST['token']) && $status === 1) {
            if (hash_equals($_SESSION['passwd_find_token'], $_POST['token'])) {
                $status = 1;
            } else {
                // Log this as a warning and keep an eye on these attempts
                $status = -5;
            }

        }

        // 비밀번호 초기화
        if ( $status === 1 ){
                        
            $passwd = base64_encode(hash('sha256', $rand_passwd, true) );
            $memberVO->setPasswd($passwd);

            $result = $this->member_service->updateMemberChangePasswd($memberVO);

        }

        switch( $status ){

            case 1:

                $config = $this->getUsr_config();

                $sec_parameter_usrname = Sha256::encrypt("usrname", $config->getSecret_key(), $config->getSecret_iv());
                $sec_parameter_email = Sha256::encrypt("email", $config->getSecret_key(), $config->getSecret_iv());
                $sec_parameter_ret_url = Sha256::encrypt("ret_url", $config->getSecret_key(), $config->getSecret_iv());
                $sec_parameter_token = Sha256::encrypt("token", $config->getSecret_key(), $config->getSecret_iv());
                $sec_parameter_message = Sha256::encrypt("message", $config->getSecret_key(), $config->getSecret_iv());

                $usrname = Sha256::encrypt($memberVO->getUsrname(), $config->getSecret_key(), $config->getSecret_iv());
                $email = Sha256::encrypt($memberVO->getEmail(), $config->getSecret_key(), $config->getSecret_iv());
                $ret_url = Sha256::encrypt("index.php", $config->getSecret_key(), $config->getSecret_iv());
                $token = Sha256::encrypt("email_pwd_find_tokenizer9", $config->getSecret_key(), $config->getSecret_iv());
                $token = Sha256::encrypt($token, $config->getSecret_key2(), $config->getSecret_iv2());
                $message = Sha256::encrypt($rand_passwd, $config->getSecret_key(), $config->getSecret_iv());

                //echo $sec_parameter_ret_url . "/" . $config->getSecret_key();

                $sec_parameter = $sec_parameter_usrname . "=" . $usrname . "&";
                $sec_parameter = $sec_parameter . $sec_parameter_email . "=" . $email . "&";
                $sec_parameter = $sec_parameter . $sec_parameter_ret_url . "=" . $ret_url . "&";
                $sec_parameter = $sec_parameter . $sec_parameter_token . "=" . $token . "&";
                $sec_parameter = $sec_parameter . $sec_parameter_message . "=" . $message;

                //header('Location: _email.php?' . $sec_parameter);

                echo "<script>";
                echo "location.replace('../../_email.php?" . $sec_parameter . "');";
                echo "</script>";
                exit;
                
                exit;

                break;

            case -1:
                
                echo "<script>";
                echo "alert ('사용자명을 확인하세요.');";
                echo "history.back();";
                echo "</script>";
                exit;
                break;

            case -2:

                echo "<script>";
                echo "alert ('이메일 형식이 불일치합니다.');";
                echo "history.back();";
                echo "</script>";
                exit;
                
                break;

            case -3:

                echo "<script>";
                echo "alert ('이메일 주소가 없습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -4:

                echo "<script>";
                echo "alert ('이메일 주소가 존재하지 않습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            case -5:

                echo "<script>";
                echo "alert ('토큰이 존재하지 않거나 일치하지 않습니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

            default:

                echo "<script>";
                echo "alert ('비정상적인 접근입니다.');";
                echo "history.back();";
                echo "</script>";
                exit;

                break;

        }

    }
    
}

?>