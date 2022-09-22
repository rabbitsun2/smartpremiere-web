<?php
/*
 * Created Date: 2022-08-31 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: BoardService
 * Filename: BoardService.php
 * Description:
 * 1. 초기 생성, 정도윤, 2022-08-31 (Wed).
 * 2. 게시물 추가 기능, 정도윤, 2022-09-04 (Sun).
 * 3. 최근 게시글 기능 추가, 정도윤, 2022-09-04 (Sun).
 * 4. 파일 목록 기능 추가, 정도윤, 2022-09-04 (Sun).
 * 
 */

interface BoardService{

    public function selectPagingBoardList($boardname, $startNum, $endNum);
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