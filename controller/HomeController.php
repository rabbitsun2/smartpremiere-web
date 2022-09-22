<?php
/*
 * Created Date: 2022-06-05 (Sun)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: Controller
 * Filename: HomeController.php
 * Description:
 *
 */

class HomeController extends Controller {
    
    public function __construct(){
        
    }
    
    public function __destruct(){
        
    }
    
    private function templateDir(){
        $smarty = $this->getSmarty();
        $root_dir = $this->getRootDir();
        $smarty->setTemplateDir($root_dir . '/view');
        
        $this->setSmarty($smarty);
        
    }
    
    public function home(){
        //echo "홈2 / 참";
        //require_once $this->root_dir . "view/home.php";
        
        $this->templateDir();
        $smarty = $this->getSmarty();
        $smarty->clearAllCache();
        
        // 토큰 생성
        if (empty($_SESSION['token'])) {
            $_SESSION['token'] = bin2hex(random_bytes(32));
        }

        $token = $_SESSION['token'];

        $smarty->assign("title", "Smart Premiere");
        $smarty->assign("service_mode", $this->getServiceMode() );
        $smarty->assign("today", date("Y-m-d H:i:s"));
        $smarty->assign("token", $token);
        $smarty->display('index.tpl');
        
    }

}

?>