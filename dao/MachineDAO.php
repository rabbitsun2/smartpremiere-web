<?php
/*
 * Created Date: 2022-07-27 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: MachineDAO
 * Filename: MachineDAO.php
 * Description:
 * 1. 
 *
*/

interface MachineDAO{

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