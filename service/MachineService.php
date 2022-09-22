<?php
/*
 * Created Date: 2022-07-27 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MachineService
 * Filename: MachineService.php
 * Description:
 * 1. 조회 기능 추가, 정도윤, 2022-07-28 (Thu).
 * 2. 전체 조회 기능 추가, 정도윤, 2022-07-29 (Fri).
 * 3. 수정 기능 추가, 정도윤, 2022-07-31 (Sun).
 * 4. 삭제 기능 추가, 정도윤, 2022-07-31 (Sun).
 */

interface MachineService{

    public function insertMachine($machineVO);
    public function selectMachineFindID($machineVO);
    public function selectMachineAll();

    public function selectAllMachineCount();
    public function selectPagingMachine($startNum, $endNum);

    public function updateMachine($machineVO);
    public function deleteMachine($machineVO);

    public function selectMachineFindUuid($machineVO);

}

?>