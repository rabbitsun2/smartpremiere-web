<?php
/*
 * Created Date: 2022-08-31 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: BoardVO
 * Filename: BoardVO.php
 * Description:
 * 1. 신규 생성, 정도윤, 2022-08-31 (Wed).
 * 2. 게시판명 추가, 정도윤, 2022-09-03 (Sat).
 * 3. 이메일 주소 추가(퇴사자 추적), 정도윤, 2022-09-04 (Sun).
 */

class BoardVO{

    private $article_id;
    private $subject;
    private $memo;
    private $member_id;
    private $nickname;
    private $email;
    private $regidate;
    private $cnt;
    private $ip;
    private $boardname;
    private $file_option;
    private $option1;

    public function getArticle_id(){
        return $this->article_id;
    }

    public function setArticle_id($article_id){
        $this->article_id = $article_id;
    }

    public function getSubject(){
        return $this->subject;
    }

    public function setSubject($subject){
        $this->subject = $subject;
    }

    public function getMemo(){
        return $this->memo;
    }

    public function setMemo($memo){
        $this->memo = $memo;
    }

    public function getMember_id(){
        return $this->member_id;
    }

    public function setMember_id($member_id){
        $this->member_id = $member_id;
    }

    public function getNickname(){
        return $this->nickname;
    }

    public function setNickname($nickname){
        $this->nickname = $nickname;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getRegidate(){
        return $this->regidate;
    }

    public function setRegidate($regidate){
        $this->regidate = $regidate;
    }

    public function getCnt(){
        return $this->cnt;
    }

    public function setCnt($cnt){
        $this->cnt = $cnt;
    }

    public function getIp(){
        return $this->ip;
    }

    public function setIp($ip){
        $this->ip = $ip;
    }

    public function getBoardname(){
        return $this->boardname;
    }

    public function setBoardname($boardname){
        $this->boardname = $boardname;
    }

    public function getFile_option(){
        return $this->file_option;
    }

    public function setFile_option($file_option){
        $this->file_option = $file_option;
    }

    public function getOption1(){
        return $this->option1;
    }

    public function setOption1($option1){
        $this->option1 = $option1;
    }

}

?>