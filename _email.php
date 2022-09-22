<?php
/*
 * Created Date: 2022-09-10 (Sat) / Chuseok.
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Smart Premiere Email
 * Filename: _email.php
 * Description:
 * 1. 초기 생성, 정도윤, 2022-09-10 (Sat) / Chuseok.
 * 
 */

include './include/config.php';
include $_ROOT_DIR . '/include/header.php';

$_SETUP_DIR = $config->getSetup_dir();                              // 사용자 설정
$_ROOT_DIR = $_SERVER['CONTEXT_DOCUMENT_ROOT'] . $_SETUP_DIR;


require $_ROOT_DIR . '/framework/phpmailer/src/Exception.php';
require $_ROOT_DIR . '/framework/phpmailer/src/PHPMailer.php';
require $_ROOT_DIR . '/framework/phpmailer/src/SMTP.php';
include $_ROOT_DIR . '/util/Sha256.php';
include $_ROOT_DIR . '/model/EmailVO.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//echo $config->getLimit_upload_size();

function emailer($_config, $_emailVO){
    
    // PHPMailer 선언
    $mail = new PHPMailer(true);

    if ( strcmp( $_config->getService_mode(), "개발") === 0 ){
        // 디버그 모드(production 환경에서는 주석 처리한다.)
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    }
    
    // SMTP 서버 세팅
    $mail->isSMTP();

    try {

        // smtp 설정
        $mail->Host = $_config->getEmail_smtp_host();
        // SMTP 암호화 여부
        $mail->SMTPAuth = true;
        // SMTP 포트
        $mail->Port = $_config->getEmail_smtp_port();
        // SMTP 보안 프초트콜
        $mail->SMTPSecure = $_config->getEmail_smtp_secure();
        // 이메일 계정 아이디
        $mail->Username = $_config->getEmail_smtp_username();
        // 이메일 계정 패스워드
        $mail->Password = $_config->getEmail_smtp_passwd();
        // 인코딩 셋
        $mail->CharSet = $_config->getEmail_charset();
        $mail->Encoding = $_config->getEmail_encoding();
        
        // 보내는 사람
        $mail->setFrom( $_config->getEmail_send_address(), $_config->getEmail_send_usrname() );
        // 받는 사람
        $mail->AddAddress( $_emailVO->getRecvAddr(), $_emailVO->getRecvUsrname() ); 

        // 본문 html 타입 설정
        $mail->isHTML(true);

        // 제목
        $mail->Subject = $_emailVO->getSubject();

        // 본문 (HTML 전용)
        $mail->Body    = $_emailVO->getBodyhtml();

        // 본문 (non-HTML 전용)
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->Send();
        
        return "success";

    } catch (phpmailerException $e) {
        return $e->errorMessage();
    } catch (Exception $e) {
        return $e->getMessage();
    }
    
}

$sec_parameter_usrname = Sha256::encrypt("usrname", $config->getSecret_key(), $config->getSecret_iv());
$sec_parameter_email = Sha256::encrypt("email", $config->getSecret_key(), $config->getSecret_iv());
$sec_parameter_ret_url = Sha256::encrypt("ret_url", $config->getSecret_key(), $config->getSecret_iv());
$sec_parameter_token = Sha256::encrypt("token", $config->getSecret_key(), $config->getSecret_iv());
$sec_parameter_message = Sha256::encrypt("message", $config->getSecret_key(), $config->getSecret_iv());


// 이메일 전송을 시도할 때
if ( isset( $_GET[$sec_parameter_usrname] ) && 
     isset( $_GET[$sec_parameter_email] ) && 
     isset( $_GET[$sec_parameter_ret_url] ) && 
     isset( $_GET[$sec_parameter_token] ) && 
     isset( $_GET[$sec_parameter_message] ) ){
    
    $passTwoDecToken = Sha256::decrypt( $_GET[$sec_parameter_token], $config->getSecret_key2(), $config->getSecret_iv2() );
    $passOneDecToken = Sha256::decrypt( $passTwoDecToken, $config->getSecret_key(), $config->getSecret_iv() );

    $emailVO = new EmailVO();
    $emailVO->setRecvUsrname( Sha256::decrypt( $_GET[$sec_parameter_usrname], $config->getSecret_key(), $config->getSecret_iv() ) );
    $emailVO->setRecvAddr( Sha256::decrypt( $_GET[$sec_parameter_email], $config->getSecret_key(), $config->getSecret_iv() ) );

    $retUrl = Sha256::decrypt( $_GET[$sec_parameter_ret_url], $config->getSecret_key(), $config->getSecret_iv() );
    $message = Sha256::decrypt( $_GET[$sec_parameter_message], $config->getSecret_key(), $config->getSecret_iv() );
    
    if ( strcmp( $passOneDecToken, "email_pwd_find_tokenizer9" ) === 0 ){
        $bodyHtml = "비밀번호는 " . $message . "입니다.";
        $emailVO->setSubject("비밀번호 찾기입니다.");
        $emailVO->setBodyhtml( $bodyHtml );
    }

    // 이메일
    $result_email = emailer($config, $emailVO);

    echo "<script>";
    echo "alert ('비밀번호 초기화가 완료되었습니다.');";
    echo "location.replace('" . $retUrl . "');";
    echo "</script>";
    exit;

}

?>