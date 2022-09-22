<?php
/*
 * Created Date: 2022-06-06 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MemberDAO
 * Filename: MemberDAO.php
 * Description:
 * 1. 사용자 관리 DAO 추가, 정도윤, 2022-06-19(Sun)
 * 2. 이메일주소, 사용자 이름으로 조회 기능 추가, 정도윤, 2022-09-10 (Sat)
 *
*/

interface MemberDAO{

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