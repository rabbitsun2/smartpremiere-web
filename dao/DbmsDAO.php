<?php
/*
 * Created Date: 2022-08-31 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: DbmsDAO
 * Filename: DbmsDAO.php
 * Description:
 * 1. 
 *
*/

interface DbmsDAO{

    public function selectDbSizeFindDbname($dbname);
    public function selectFindTablename($tablename);

}

?>