<?php
/*
 * Created Date: 2022-08-31 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: DbmsService
 * Filename: DbmsService.php
 * Description:
 * 1. 초기 생성, 정도윤, 2022-08-31 (Wed).
 * 2. Table 명 조회 기능 추가, 정도윤, 2022-09-04 (Sun).
 * 
 */

interface DbmsService{

    public function selectDbSizeFindDbname($dbname);
    public function selectFindTablename($tablename);

}

?>