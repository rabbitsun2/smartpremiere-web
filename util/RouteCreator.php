<?php
/*
 * Created Date: 2022-06-05 (Sun)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: RouteCreate
 * Filename: RouteCreator.php
 * Description:
 *
*/

class RouteCreator{
    
    private $root_url;
    private $path_startnum;
    private $path_endnum;
    
    public function __construct(){
        $this->root_url = null;
        $this->path_startnum = null;
        $this->path_endnum = null;
    }
    
    public function __destruct(){
        
    }
    
    public function SUB_LEVEL_SECOND(){
        return 2;
    }
    
    public function SUB_LEVEL_THIRD(){
        return 3;
    }
    
    public function getRootUrl(){
        return $this->root_url;
    }
    
    public function setRootUrl($root_url){
        $this->root_url = $root_url;
    }
    
    public function getPathStartNum(){
        return $this->path_startnum;
    }
    
    public function setPathStartNum($path_startnum){
        $this->path_startnum = $path_startnum;
    }
    
    public function getPathEndNum(){
        return $this->path_endnum;
    }
    
    public function setPathEndNum($path_endnum){
        $this->path_endnum = $path_endnum;        
    }
    
    public function getRootRoute($_URL){
        
        $usr_route = "";
        
        // index.php
        if ( strlen($_URL) == 0 ){
            
            //echo "참1";
            //$a = new HomeController($_ROOT_DIR);
            //$a->home();
            $usr_route = "home";
        }
        
        // {pages}.php
        else if ( strlen($_URL) != 0 ){
            
            //echo "참3";
            
            $_PATH_STARTNUM = strpos($_URL, "/", 0) + 1;
            //echo $_PATH_STARTNUM;
            
            $_PATH_ENDNUM = strpos($_URL, "/", 3);
            
            //echo "처음:" . $_PATH_STARTNUM . "/" . $_PATH_ENDNUM;
            //echo "<br>";
            
            if (strlen($_PATH_ENDNUM) != 0){
                $_PATH_ENDNUM = $_PATH_ENDNUM - $_PATH_STARTNUM;
            }else{
                $_PATH_ENDNUM = strlen($_URL);
            }
            
            //echo "나중:" . $_PATH_STARTNUM . "/" . $_PATH_ENDNUM;
            //echo "<br>";
            
            $usr_route = substr($_URL, $_PATH_STARTNUM, $_PATH_ENDNUM);
            //echo "주소:" . $_USR_PATH . "<br>";
            
        }
        
        // Setter
        $this->setRootUrl($usr_route);
        $this->setPathStartNum($_PATH_STARTNUM);
        $this->setPathEndNum($_PATH_ENDNUM);
        
        
        return $usr_route;
        
    }
    
    public function getSubPath($_URL, $_LEVEL){
        
        $root_url = $this->getRootUrl();
        $sub_url = "";
        
        $_PATH_STARTNUM = $this->getPathStartNum();
        $_PATH_ENDNUM = $this->getPathEndNum();
        
        
        if ( strcmp($root_url, "home") === 0 ){
            
        }
        
        else if ( strcmp($root_url, "home") !== 0 ){
            
            //echo $_URL . "/" . $_PATH_STARTNUM . "/" . $_PATH_ENDNUM . "<br>";
            
            //$root_url . "참";
            //$sub_url = $this->convSubPath($_URL, $_PATH_STARTNUM, $_PATH_ENDNUM, $_LEVEL);
            //echo strlen($root_url) . "<비교>" . strlen($_URL) - 1 . "<br>";
            
            
            // 버그 개선
            if ( strlen($root_url) === (strlen($_URL) - 1) ){
                $sub_url = "";                
            }
            else{
                $sub_url = $this->convSubPath($_URL, $_PATH_STARTNUM, $_PATH_ENDNUM, $_LEVEL);
            }
            
        }
        
        return $sub_url;
        
    }
    
    private function convSubPath($_URL, $_PATH_STARTNUM, $_PATH_ENDNUM, $_LEVEL){
        
        //echo "<br>";
        //echo "주소2:" . $_URL . "<br>";
        
        $_SUB_PATH = "";
        
        //echo "레벨:" . $_LEVEL . "<br>";
        
        switch ($_LEVEL){
            
            case 2:
                
                $_PATH_STARTNUM = strpos($_URL, "/", $_PATH_ENDNUM);
                $_PATH_STARTNUM = $_PATH_STARTNUM + 1;
                
                //echo "치타:" . $_PATH_ENDNUM + 3 . "<br>";
                //echo "하하:" . strpos($_URL, "/", $_PATH_ENDNUM + 3) . "<br>";
                
                if(strpos($_URL, "/", $_PATH_ENDNUM + 3) != "" ){
                    $_PATH_ENDNUM = strpos($_URL, "/", $_PATH_STARTNUM);
                    $_PATH_ENDNUM = $_PATH_ENDNUM - $_PATH_STARTNUM;
                }
                else{
                    $_PATH_ENDNUM = strlen($_URL) - 1;
                }
                
                break;
                
            case 3:
                                
                $_PATH_STARTNUM = strpos($_URL, "/", $_PATH_ENDNUM);
                $_PATH_STARTNUM = $_PATH_STARTNUM + 1;
                
                $_SUB_TWO_PATH = $this->convSubPath($_URL, $_PATH_STARTNUM, $_PATH_ENDNUM, 2);
                
                //echo "레벨3 위치 찾기:". strpos($_URL, $_SUB_TWO_PATH, $_PATH_STARTNUM) . "<br>";
                
                $_PATH_STARTNUM = strpos($_URL, $_SUB_TWO_PATH, $_PATH_STARTNUM);
                $_PATH_STARTNUM = strpos($_URL, "/", $_PATH_STARTNUM);
                $_PATH_STARTNUM = $_PATH_STARTNUM + 1;
                
                //echo "참참참:" . $_PATH_STARTNUM . "<br>";
                
                if(strpos($_URL, "/", $_PATH_STARTNUM + 3) != "" ){
                    $_PATH_ENDNUM = strpos($_URL, "/", $_PATH_STARTNUM);
                    $_PATH_ENDNUM = $_PATH_ENDNUM - $_PATH_STARTNUM;
                }
                else{
                    $_PATH_ENDNUM = strlen($_URL) - 1;
                }
                
                // 상위 루트 레벨일 때 길이 0으로 반환
                if($_PATH_STARTNUM === 1){
                    $_PATH_ENDNUM = 0;
                }
                
                break;
                
            default:
                
                
        }
        
        //echo $_PATH_STARTNUM . "*" . $_PATH_ENDNUM . "<br>";
        
        // echo substr($_URL, $_PATH_STARTNUM, $_PATH_ENDNUM);
        
        $_SUB_PATH = substr($_URL, $_PATH_STARTNUM, $_PATH_ENDNUM);
        
        return $_SUB_PATH;
        
    }
    
}

?>