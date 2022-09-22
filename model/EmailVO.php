<?php
/*
 * Created Date: 2022-09-10 (Sat) / Chuseok.
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: EmailVO
 * Filename: EmailVO.php
 * Description:
 * 1. 신규 생성, 정도윤, 2022-09-10 (Sat).
 * 
 */
class EmailVO{

    private $recvUsrname;
    private $recvAddr;
    private $subject;
    private $bodyHtml;
    
    public function getRecvUsrname(){
        return $this->recvUsrname;
    }

    public function setRecvUsrname($recvUsrname){
        $this->recvUsrname = $recvUsrname;
    }

    public function getRecvAddr(){
        return $this->recvAddr;
    }

    public function setRecvAddr($recvAddr){
        $this->recvAddr = $recvAddr;
    }

    public function getSubject(){
        return $this->subject;
    }

    public function setSubject($subject){
        $this->subject = $subject;
    }

    public function getBodyhtml(){
        return $this->bodyHtml;
    }

    public function setBodyhtml($bodyHtml){
        $this->bodyHtml = $bodyHtml;
    }

}

?>