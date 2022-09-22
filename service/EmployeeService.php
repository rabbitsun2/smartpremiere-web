<?php
/*
 * Created Date: 2022-06-06 (Mon)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: EmployeeService
 * Filename: EmployeeService.php
 * Description:
 * 1. 사원 기능 추가, 정도윤, 2022-06-18(Sat)
 * 2. 사용자 관리 페이징 기능 추가, 정도윤, 2022-06-19(Sun)
 * 
 */

interface EmployeeService{

    public function selectEmployee($employeeVO);
    public function selectEmployeeAuth();
    public function insertEmployee($employeeVO);
    public function selectAllEmployeeCount();
    public function selectPagingEmployee($startNum, $endNum);
    public function updateEmployee($employeeVO);
    public function deleteEmployee($employeeVO);

}

?>