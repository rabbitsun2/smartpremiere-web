<?php
/*
 * Created Date: 2022-06-06 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MemberService
 * Filename: MemberService.php
 * Description:
 * 1. 사원 기능 추가, 정도윤, 2022-06-18(Sat)
 * 2. 사용자 관리 페이징 기능 추가, 정도윤, 2022-06-19 (Sun)
 * 3. 회원 비밀번호 초기화 기능 추가, 정도윤, 2022-09-10 (Sat) / Chuseok.
 */

interface MemberService{

    public function selectMember($memberVO);
    public function selectMemberAuth();
    public function insertMember($memberVO);
    public function selectAllMemberCount();
    public function selectPagingMember($startNum, $endNum);
    public function updateMember($memberVO);
    public function deleteMember($memberVO);
    public function selectMemberFindId($memberVO);
    public function selectMemberFindEmailAndUsrname($memberVO);
    public function updateMemberChangePasswd($memberVO);

}

?>