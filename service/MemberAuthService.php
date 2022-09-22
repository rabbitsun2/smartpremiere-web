<?php
/*
 * Created Date: 2022-07-25 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MemberAuthService
 * Filename: MemberAuthService.php
 * Description:
 * 1. 
 * 
 */

interface MemberAuthService{

    public function insertMemberAuth($memberAuthVO);
    public function selectCountAllMemberAuth();
    public function alterAutoIncrement();

    public function selectAllMemberAuth();
    public function insertMemberAuthVal($memberAuthVO);
    public function selectFindAuthname($memberAuthVO);
    
    public function selectPagingMemberAuth($startNum, $endNum);
    public function selectFindId($memberAuthVO);

    public function updateMemberAuth($memberAuthVO);
    public function deleteMemberAuth($memberAuthVO);

}

?>