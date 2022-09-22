<?php
/*
 * Created Date: 2022-06-05 (Sun)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Smart Premiere
 * Filename: index.php
 * Description:
 * 
 */

include './include/config.php';

$_SETUP_DIR = $config->getSetup_dir();                              // 사용자 설정
$_UPLOAD_DIR = $config->getUpload_dir();                            // 업로드 경로
$_LIMIT_UPLOAD_SIZE = $config->getLimit_upload_size();
$_SERVICE_MODE = $config->getService_mode();                        // 개발 유형

$_URL = $_SERVER['PATH_INFO'];
$_ROOT_DIR = $_SERVER['CONTEXT_DOCUMENT_ROOT'] . $_SETUP_DIR;


include $_ROOT_DIR . '/include/header.php';

include $_ROOT_DIR . "/util/FileUtil.php";
include $_ROOT_DIR . "/util/UUID.php";
include $_ROOT_DIR . "/util/Xss.php";
include $_ROOT_DIR . "/util/Network.php";
include $_ROOT_DIR . '/util/Paging.php';
include $_ROOT_DIR . '/util/RouteCreator.php';
include $_ROOT_DIR . '/util/ArrayUtil.php';
include $_ROOT_DIR . "/util/PregMatch.php";
include $_ROOT_DIR . "/util/Sha256.php";
include $_ROOT_DIR . "/util/RandUtil.php";

include $_ROOT_DIR . '/db/MysqlConn.php';


include $_ROOT_DIR . '/framework/smarty/libs/Smarty.class.php';


include $_ROOT_DIR . '/model/EmailVO.php';
include $_ROOT_DIR . '/model/PageCriteria.php';
include $_ROOT_DIR . '/model/BoardVO.php';
include $_ROOT_DIR . '/model/BoardFileVO.php';
include $_ROOT_DIR . '/model/BoxTypeVO.php';
include $_ROOT_DIR . '/model/ProjectFileVO.php';
include $_ROOT_DIR . '/model/ProjectProcessVO.php';
include $_ROOT_DIR . '/model/ProjectVO.php';
include $_ROOT_DIR . '/model/ProductFileVO.php';
include $_ROOT_DIR . '/model/ProductVO.php';
include $_ROOT_DIR . '/model/ProductBarcodeVO.php';
include $_ROOT_DIR . '/model/ProductBoxSpecVO.php';
include $_ROOT_DIR . '/model/MemberAgreementVO.php';
include $_ROOT_DIR . '/model/MemberVO.php';
include $_ROOT_DIR . '/model/MemberAuthVO.php';
include $_ROOT_DIR . '/model/WarehouseVO.php';
include $_ROOT_DIR . '/model/WarehouseLogVO.php';
include $_ROOT_DIR . '/model/WarehouseBarcodeVO.php';
include $_ROOT_DIR . '/model/WarehouseBarcodePrintLogVO.php';
include $_ROOT_DIR . '/model/WarehouseBarcodeBagVO.php';
include $_ROOT_DIR . '/model/MachineVO.php';
include $_ROOT_DIR . '/model/ShockSensorVO.php';
include $_ROOT_DIR . '/model/UltrasonicSensorVO.php';
include $_ROOT_DIR . '/model/DhtVO.php';
include $_ROOT_DIR . '/model/DhtSpecificVO.php';
include $_ROOT_DIR . '/model/ShockSpecificVO.php';
include $_ROOT_DIR . '/model/UltrasonicSpecificVO.php';


include $_ROOT_DIR . '/dao/BoxDAO.php';
include $_ROOT_DIR . '/dao/BoxDAOImpl.php';
include $_ROOT_DIR . '/dao/BoardDAO.php';
include $_ROOT_DIR . '/dao/BoardDAOImpl.php';
include $_ROOT_DIR . '/dao/WarehouseDAO.php';
include $_ROOT_DIR . '/dao/WarehouseDAOImpl.php';
include $_ROOT_DIR . '/dao/ProjectDAO.php';
include $_ROOT_DIR . '/dao/ProjectDAOImpl.php';
include $_ROOT_DIR . '/dao/ProductDAO.php';
include $_ROOT_DIR . '/dao/ProductDAOImpl.php';
include $_ROOT_DIR . '/dao/MemberDAO.php';
include $_ROOT_DIR . '/dao/MemberDAOImpl.php';
include $_ROOT_DIR . '/dao/MemberAuthDAO.php';
include $_ROOT_DIR . '/dao/MemberAuthDAOImpl.php';
include $_ROOT_DIR . '/dao/MemberAgreementDAO.php';
include $_ROOT_DIR . '/dao/MemberAgreementDAOImpl.php';
include $_ROOT_DIR . '/dao/MachineDAO.php';
include $_ROOT_DIR . '/dao/MachineDAOImpl.php';
include $_ROOT_DIR . '/dao/ShockSensorDAO.php';
include $_ROOT_DIR . '/dao/ShockSensorDAOImpl.php';
include $_ROOT_DIR . '/dao/UltrasonicSensorDAO.php';
include $_ROOT_DIR . '/dao/UltrasonicSensorDAOImpl.php';
include $_ROOT_DIR . '/dao/DhtDAO.php';
include $_ROOT_DIR . '/dao/DhtDAOImpl.php';
include $_ROOT_DIR . '/dao/DbmsDAO.php';
include $_ROOT_DIR . '/dao/DbmsDAOImpl.php';


include $_ROOT_DIR . '/service/BoxService.php';
include $_ROOT_DIR . '/service/BoxServiceImpl.php';
include $_ROOT_DIR . '/service/BoardService.php';
include $_ROOT_DIR . '/service/BoardServiceImpl.php';
include $_ROOT_DIR . '/service/WarehouseService.php';
include $_ROOT_DIR . '/service/WarehouseServiceImpl.php';
include $_ROOT_DIR . '/service/ProjectService.php';
include $_ROOT_DIR . '/service/ProjectServiceImpl.php';
include $_ROOT_DIR . '/service/ProductService.php';
include $_ROOT_DIR . '/service/ProductServiceImpl.php';
include $_ROOT_DIR . '/service/MemberService.php';
include $_ROOT_DIR . '/service/MemberServiceImpl.php';
include $_ROOT_DIR . '/service/MemberAgreementService.php';
include $_ROOT_DIR . '/service/MemberAgreementServiceImpl.php';
include $_ROOT_DIR . '/service/MemberAuthService.php';
include $_ROOT_DIR . '/service/MemberAuthServiceImpl.php';
include $_ROOT_DIR . '/service/MachineService.php';
include $_ROOT_DIR . '/service/MachineServiceImpl.php';
include $_ROOT_DIR . '/service/ShockSensorService.php';
include $_ROOT_DIR . '/service/ShockSensorServiceImpl.php';
include $_ROOT_DIR . '/service/UltrasonicSensorService.php';
include $_ROOT_DIR . '/service/UltrasonicSensorServiceImpl.php';
include $_ROOT_DIR . '/service/DhtService.php';
include $_ROOT_DIR . '/service/DhtServiceImpl.php';
include $_ROOT_DIR . '/service/DbmsService.php';
include $_ROOT_DIR . '/service/DbmsServiceImpl.php';


include $_ROOT_DIR . '/include/Controller.php';
include $_ROOT_DIR . '/include/DAO.php';


include $_ROOT_DIR . "/controller/Portal/BoardController.php";
include $_ROOT_DIR . "/controller/Portal/ConfigController.php";
include $_ROOT_DIR . "/controller/Portal/ProjectController.php";
include $_ROOT_DIR . "/controller/Portal/ProductController.php";
include $_ROOT_DIR . "/controller/Portal/LogisticsController.php";
include $_ROOT_DIR . "/controller/Portal/MachineController.php";
include $_ROOT_DIR . "/controller/LoginController.php";
include $_ROOT_DIR . "/controller/PortalController.php";
include $_ROOT_DIR . "/controller/MemberController.php";
include $_ROOT_DIR . "/controller/HomeController.php";
include $_ROOT_DIR . "/controller/IotController.php";


// Route 경로 생성
$routeCreator = new RouteCreator();

// MariaDB(MySQL) 환경설정
$mysqlConn = new MysqlConn();
$mysqlConn->init( $config->getMysql_hostname(),
                  $config->getMysql_username(),
                  $config->getMysql_passwd(),
                  $config->getMysql_dbname(),
                  $config->getMysql_port() );

// Smarty 환경설정
$smarty = new Smarty();
//$smarty->force_compile = true;
//$smarty->debugging = true;
$smarty->debugging = false;
$smarty->caching = true;
$smarty->cache_lifetime = 120;

// 컨트롤러 생성
$homeController = new HomeController();
$portalController = new PortalController();
$loginController = new LoginController();
$memberController = new MemberController();
$iotController = new IotController();

// Controller 루트 경로 셋팅
$homeController->setRootDir($_ROOT_DIR);
$portalController->setRootDir($_ROOT_DIR);
$loginController->setRootDir($_ROOT_DIR);
$memberController->setRootDir($_ROOT_DIR);
$iotController->setRootDir($_ROOT_DIR);

// Controller 스마티 셋팅
$homeController->setSmarty($smarty);
$portalController->setSmarty($smarty);
$loginController->setSmarty($smarty);
$memberController->setSmarty($smarty);
$iotController->setSmarty($smarty);

// DB 셋팅
$homeController->setConn($mysqlConn);
$portalController->setConn($mysqlConn);
$loginController->setConn($mysqlConn);
$memberController->setConn($mysqlConn);
$iotController->setConn($mysqlConn);

// 업로드 경로 셋팅
$homeController->setUploadDir($_UPLOAD_DIR);
$portalController->setUploadDir($_UPLOAD_DIR);
$loginController->setUploadDir($_UPLOAD_DIR);
$memberController->setUploadDir($_UPLOAD_DIR);
$iotController->setUploadDir($_UPLOAD_DIR);

// 파일 업로드 크기 제한
$homeController->setUploadSize($_LIMIT_UPLOAD_SIZE);
$portalController->setUploadSize($_LIMIT_UPLOAD_SIZE);
$loginController->setUploadSize($_LIMIT_UPLOAD_SIZE);
$memberController->setUploadSize($_LIMIT_UPLOAD_SIZE);
$iotController->setUploadSize($_LIMIT_UPLOAD_SIZE);

// 경로 생성
$_ROOT_ROUTE = $routeCreator->getRootRoute($_URL);
$_SECOND_ROUTE = $routeCreator->getSubPath($_URL, 2 );
$_THIRD_ROUTE = $routeCreator->getSubPath($_URL, 3 );

// 경로 설정
$homeController->setRootRoute($_ROOT_ROUTE);
$homeController->setSecondRoute($_SECOND_ROUTE);
$homeController->setThirdRoute($_THIRD_ROUTE);

$portalController->setRootRoute($_ROOT_ROUTE);
$portalController->setSecondRoute($_SECOND_ROUTE);
$portalController->setThirdRoute($_THIRD_ROUTE);

$loginController->setRootRoute($_ROOT_ROUTE);
$loginController->setSecondRoute($_SECOND_ROUTE);
$loginController->setThirdRoute($_THIRD_ROUTE);

$memberController->setRootRoute($_ROOT_ROUTE);
$memberController->setSecondRoute($_SECOND_ROUTE);
$memberController->setThirdRoute($_THIRD_ROUTE);

$iotController->setRootRoute($_ROOT_ROUTE);
$iotController->setSecondRoute($_SECOND_ROUTE);
$iotController->setThirdRoute($_THIRD_ROUTE);

// 서비스 모드 설정
$homeController->setServiceMode($_SERVICE_MODE);
$portalController->setServiceMode($_SERVICE_MODE);
$loginController->setServiceMode($_SERVICE_MODE);
$memberController->setServiceMode($_SERVICE_MODE);
$iotController->setServiceMode($_SERVICE_MODE);

// 사용자 환경설정 설정
$homeController->setUsr_config($config);
$portalController->setUsr_config($config);
$loginController->setUsr_config($config);
$memberController->setUsr_config($config);
$iotController->setUsr_config($config);

//echo $_ROOT_ROUTE . "<br><br>";
//echo $_SECOND_ROUTE . "<br><br>";
//echo $_THIRD_ROUTE ;

// index.php
if ( strcmp($_ROOT_ROUTE, "home") === 0 ){

    $homeController->home();
}

// {page}.php
if ( strcmp($_ROOT_ROUTE, "home") !== 0 ){
    
    switch ( $_ROOT_ROUTE ){
        
        // 로그인 인증 화면
        case "sso":
            
            switch ( $_SECOND_ROUTE ){
             
                case "login":
                    
                    $memberVO = new MemberVO();
                    
                    $memberVO->setEmail($_POST["email"]);
                    $passwd = base64_encode( hash('sha256', $_POST["passwd"], true) );
                    $memberVO->setPasswd($passwd);
                    
                    //echo $empVO->getEmp_no();
                    //echo $empVO->getPasswd();
                    
                    $loginController->login($memberVO);
                    
                    break;
                    
                case "logout":
                    
                    // 로그아웃
                    session_destroy(); // (세션 비우기)
                    
                    echo "<script>";
                    echo "location.replace('../..');";
                    echo "</script>";
                    exit;
                    
                    break;
                
            }
            
            break;

        // 사용자 등록
        case "member":
            
            switch( $_SECOND_ROUTE ){

                case "register":
                    $memberController->hello();
                    //echo "참";
                    
                    break;
                
                
                case "register_agree":
                    $memberController->hello_agree();
                    //echo "참";
                    
                    break;

                case "passwd_find":
                    $memberController->passwd_find();

                    break;

            }

            break;

        // IoT
        case "iot":
            
            switch( $_SECOND_ROUTE ){

                case "collect":
                    $iotController->collect();
                    //echo "참";
                    
                    break;

            }

            break;

        // 포털 화면
        case "portal":
        
            if(isset($_SESSION['member_id'])){

                switch ( $_SECOND_ROUTE ){
                
                    case "main":
                        $portalController->main();

                        break;

                    case "logistics":
                        $portalController->logistics( );
                        
                        break;

                    case "product":
                        $portalController->product( );

                        break;

                    case "project":
                        
                        $portalController->project( );
                        
                        break;

                    case "machine":
                        $portalController->machine();

                        break;

                    case "config":
                        $portalController->config();

                        break;

                    case "member":
                        $portalController->member();

                        break;

                    case "member_auth":
                        $portalController->member_auth();

                        break;

                    case "board":
                        $portalController->board();

                        break;
                        
                }

            }else{
                                
                echo "<script>";
                echo "location.replace('../..');";
                echo "</script>";
                exit;
                
            }
            
            break;
        
    }
    
}


// Free memory
if ($smarty != null){
    unset($smarty);
}

?>