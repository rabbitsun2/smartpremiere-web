<?php
/*
 * Created Date: 2022-07-27 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Controller
 * Filename: IotController.php
 * Description:
 * 1. 신규 생성, 정도윤, 2022-07-27 (Wed)
 * 
 */

class IotController extends Controller {
    
    private $machine_service;
    private $shock_sensor_service;
    private $ultrasonic_sensor_service;
    private $dht_sensor_service;

    public function __construct(){
        
    }
    
    public function __destruct(){
        
    }
    
    private function templateDir(){
        $smarty = $this->getSmarty();
        $root_dir = $this->getRootDir();
        $smarty->setTemplateDir($root_dir . '/view/main/iot');
        
        $this->setSmarty($smarty);
        
    }

    private function loadService(){
        
        $this->machine_service = new MachineServiceImpl();
        $this->shock_sensor_service = new ShockSensorServiceImpl();
        $this->ultrasonic_sensor_service = new UltrasonicSensorServiceImpl();
        $this->dht_sensor_service = new DhtServiceImpl();
        
        $my_conn = $this->getConn();

        $this->machine_service->setConn($my_conn);
        $this->shock_sensor_service->setConn($my_conn);
        $this->ultrasonic_sensor_service->setConn($my_conn);
        $this->dht_sensor_service->setConn($my_conn);

        //print_r($this->warehouse_service);

    }
    
    public function collect(){
        
        $this->templateDir();
        $this->loadService();

        if ( isset($_POST['distance']) &&
            isset($_POST['duration']) && 
            isset($_POST['humi']) && 
            isset($_POST['temp']) && 
            isset($_POST['shock']) &&
            isset($_POST['machine_id']) && 
            isset($_POST['message']) && 
            isset($_POST['uuid'])){


            $dt = new DateTime('NOW');
            $dt = $dt->format('Y-m-d H:i:s');
            
            $dhtSensorVO = new DhtVO();
            $shockSensorVO = new ShockSensorVO();
            $ultrasonicSensorVO = new UltrasonicSensorVO();
            $machineVO = new MachineVO();

            // 충격 센서
            if (is_numeric($_POST['machine_id'])){
                $shockSensorVO->setMachine_id($_POST['machine_id']);
            }else{
                $shockSensorVO->setMachine_id(-1);
            }

            $shockSensorVO->setMessage($_POST['shock']);
            $shockSensorVO->setRegidate($dt);
            $shockSensorVO->setIp(Network::get_client_ip());            

            // 초음파 센서
            if (is_numeric($_POST['machine_id'])){
                $ultrasonicSensorVO->setMachine_id($_POST['machine_id']);
            }else{
                $ultrasonicSensorVO->setMachine_id(-1);
            }

            $ultrasonicSensorVO->setMessage($_POST['message']);
            $ultrasonicSensorVO->setDuration($_POST['duration']);
            $ultrasonicSensorVO->setDistance($_POST['distance']);
            $ultrasonicSensorVO->setRegidate($dt);
            $ultrasonicSensorVO->setIp(Network::get_client_ip());

            // 온습도 센서
            if ( is_numeric($_POST['machine_id'])){
                $dhtSensorVO->setMachine_id($_POST['machine_id']);
            }else{
                $dhtSensorVO->setMachine_id(-1);
            }

            $dhtSensorVO->setHumidity($_POST['humi']);
            $dhtSensorVO->setTemperature($_POST['temp']);
            $dhtSensorVO->setMessage($_POST['message']);
            $dhtSensorVO->setRegidate($dt);
            $dhtSensorVO->setIp(Network::get_client_ip());

            // UUID
            $machineVO->setUuid($_POST['uuid']);

            $this->collect_ok($shockSensorVO, $ultrasonicSensorVO, $dhtSensorVO, $machineVO);

        }

    }

    private function collect_ok($shockSensorVO, $ultrasonicSensorVO, $dhtSensorVO, $machineVO){

        $this->templateDir();
        $this->loadService();

        $smarty = $this->getSmarty();
        $smarty->clearAllCache();
        
        $status = 1;
        $message = "초기";

        //print_r($employeeVO);

        // 1. 충격 감지 센서
        // 장비 번호 입력 여부
        if ( $shockSensorVO->getMachine_id() !== -1
               && $status === 1){
            $status = 1;
        }else if ( $shockSensorVO->getMachine_id() === -1 
               && $status === 1){
            $status = -1;
        }

        // 메시지 상태
        if ($shockSensorVO->getMessage() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $shockSensorVO->getMessage() === -1 &&
                   $status === 1 ){
            $status = -2;
        }

        // 등록일자 입력 상태
        if ($shockSensorVO->getRegidate() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $shockSensorVO->getRegidate() === -1 &&
                   $status === 1 ){
            $status = -3;
        }

        // IP주소 입력 상태
        if ( $shockSensorVO->getIp() !== -1 &&
            $status === 1){
            $status = 1;

        }else if ( $shockSensorVO->getIp() === -1 &&
                    $status === 1){
            $status = -4;
        }

        // 2. 초음파 센서
        // 장비 번호 입력 여부
        if ($ultrasonicSensorVO->getMachine_id() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $ultrasonicSensorVO->getMachine_id() === -1 &&
                    $status === 1 ){
            $status = -5;
        }

        // 메시지 상태
        if ($ultrasonicSensorVO->getMessage() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $ultrasonicSensorVO->getMessage() === -1 &&
                   $status === 1 ){
            $status = -6;
        }

        // duration 입력 상태
        if ($ultrasonicSensorVO->getDuration() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $shockSensorVO->getDuration() === -1 &&
                   $status === 1 ){
            $status = -7;
        }

        // distance 입력 상태
        if ($ultrasonicSensorVO->getDistance() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $shockSensorVO->getDistance() === -1 &&
                   $status === 1 ){
            $status = -8;
        }

        // 등록일자 입력 상태
        if ($ultrasonicSensorVO->getRegidate() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $ultrasonicSensorVO->getRegidate() === -1 &&
                   $status === 1 ){
            $status = -9;
        }

        // IP주소 입력 상태
        if ( $ultrasonicSensorVO->getIp() !== -1 &&
            $status === 1){
            $status = 1;

        }else if ( $ultrasonicSensorVO->getIp() === -1 &&
                    $status === 1){
            $status = -10;
        }

        // 3. Dht 센서
        // 장비 번호 입력 여부
        if ($dhtSensorVO->getMachine_id() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $dhtSensorVO->getMachine_id() === -1 &&
                    $status === 1 ){
            $status = -11;
        }

        // humidity 입력 상태
        if ($dhtSensorVO->getHumidity() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $dhtSensorVO->getHumidity() === -1 &&
                   $status === 1 ){
            $status = -12;
        }

        // temperature 입력 상태
        if ($dhtSensorVO->getTemperature() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $dhtSensorVO->getTemperature() === -1 &&
                   $status === 1 ){
            $status = -13;
        }

        // 메시지 입력 상태
        if ($dhtSensorVO->getMessage() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $dhtSensorVO->getMessage() === -1 &&
                $status === 1 ){
            $status = -14;
        }

        // 등록일자 입력 상태
        if ($dhtSensorVO->getRegidate() !== -1 &&
            $status === 1){
            $status = 1;
        }else if ( $dhtSensorVO->getRegidate() === -1 &&
                   $status === 1 ){
            $status = -15;
        }

        // IP주소 입력 상태
        if ( $dhtSensorVO->getIp() !== -1 &&
            $status === 1){
            $status = 1;

        }else if ( $dhtSensorVO->getIp() === -1 &&
                    $status === 1){
            $status = -16;
        }

        // UUID 입력 상태
        if ( $machineVO->getUuid() !== -1 &&
            $status === 1){
            $status = 1;

        }else if ( $machineVO->getUuid() === -1 &&
                    $status === 1){
            $status = -17;
        }

        // UUID 존재 여부
        if ($status === 1){
            $resultUuid = $this->machine_service->selectMachineFindUuid( $machineVO );

            if ( isset($resultUuid) ){
                $status = 1;
            }else if ( !isset($resultUuid) ){
                $status = -18;
            }

        }

        // 입력 프로세스
        if ($status === 1){
            //echo "참4<br>";
            //print_r($ultrasonicSensorVO);
            $resultShock = $this->shock_sensor_service->insertShockSensor($shockSensorVO);
            $resultUltrasonic = $this->ultrasonic_sensor_service->insertUltrasonicSensor($ultrasonicSensorVO);
            $resultDht = $this->dht_sensor_service->insertDht($dhtSensorVO);

            if ( $resultShock * $resultUltrasonic * $resultDht === 1){
                $message = "성공";
            }else{
                $message = "실패";
            }

            //echo "참5<br>";

        }
        else if ($status === -1){
            $message = "충격센서 - 올바르지 않는 장비번호";
        }
        else if ($status === -2){
            $message = "충격센서 - 올바르지 않는 메시지 상태";
        }
        else if ($status === -3){
            $message = "충격센서 - 올바르지 않는 등록일자";
        }
        else if ($status === -4){
            $message = "충격센서 - 올바르지 않는 IP주소";
        }
        else if ($status === -5){
            $message = "초음파센서 - 올바르지 않는 장비번호";
        }
        else if ($status === -6){
            $message = "초음파센서 - 올바르지 않는 메시지 상태";
        }
        else if ($status === -7){
            $message = "초음파센서 - 올바르지 않는 duration 상태";
        }
        else if ($status === -8){
            $message = "초음파센서 - 올바르지 않는 distance 입력 상태";
        }
        else if ($status === -9){
            $message = "초음파센서 - 올바르지 않는 등록일자";
        }
        else if ($status === -10){
            $message = "초음파센서 - 올바르지 않는 IP주소";
        }
        else if ($status === -11){
            $message = "DHT센서 - 올바르지 않는 장비번호";
        }
        else if ($status === -12){
            $message = "DHT센서 - 올바르지 않는 humidity 입력 상태";
        }
        else if ($status === -13){
            $message = "DHT센서 - 올바르지 않는 temperature 입력 상태";
        }
        else if ($status === -14){
            $message = "DHT센서 - 올바르지 않는 메시지 상태";
        }
        else if ($status === -15){
            $message = "DHT센서 - 올바르지 않는 등록일자";
        }
        else if ($status === -16){
            $message = "DHT센서 - 올바르지 않는 IP주소";
        }
        else if ($status === -17){
            $message = "UUID - 올바르지 않는 고유식별자";
        }
        else if ($status === -18){
            $message = "UUID - 존재하지 않는 고유식별자";
        }
        else{
            $message = "일반 - 비정상적인 접근";
        }

        $smarty->assign("message", $message);
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->display('message.tpl');

    }

}
