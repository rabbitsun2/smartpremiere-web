<?php

/*
 * Created Date: 2022-09-07 (Wed)
 * Author: Doyun Jung (정도윤) / rabbit.white@daum.net
 * Subject: BoxTypeVO
 * Filename: BoxTypeVO.php
 * Description:
 *
*/
class BoxTypeVO{

    private $box_type_id;
    private $type_name;

    public function getBox_type_id(){
        return $this->box_type_id;
    }

    public function setBox_type_id($box_type_id){
        $this->box_type_id = $box_type_id;
    }

    public function getType_name(){
        return $this->type_name;
    }

    public function setType_name($type_name){
        $this->type_name = $type_name;
    }

}

?>