<?php
/*
 * Created Date: 2022-08-31 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: BoardDAO
 * Filename: BoardDAO.php
 * Description:
 * 1. 
 *
*/

interface BoardDAO{

    public function selectPagingBoardList($tablename, $startnum, $endnum);
    public function selectAllBoardCount($boardname);
    public function selectBoardFindId($boardVO);
    public function insertBoard($boardVO);
    public function selectBoardFindFullQry($boardVO);
    public function insertBoardFile($boardFileVO);
    public function selectLatestBoardView($boardVO);
    public function selectBoardFileFindId($boardFileVO);
    public function selectFindUUIDBoardFile($boardFileVO);
    public function updateBoard($boardVO);
    public function deleteFindUUIDBoardFile($boardFileVO);
    public function deleteBoard($boardVO);

}

?>