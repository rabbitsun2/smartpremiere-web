<?php

class PageCriteria {

	private $page;
	private $perPageNum;
	
	public function getPageStart() {
        return ($this->page - 1) * $this->perPageNum;
    }
    
    public function __construct() {
        $this->page = 1;
        $this->perPageNum = 10;
    }
    
    public function getPage() {
        return $this->page;
    }
    public function setPage($page) {

        if($page <= 0) {
            $this->page = 1;
        } else {
            $this->page = $page;
        }
        
    }
    
    public function getPerPageNum() {
        return $this->perPageNum;
    }
    
    public function setPerPageNum($pageCount) {
        $cnt = $this->perPageNum;
        
        if($pageCount != $cnt) {
            $this->perPageNum = $cnt;
        } else {
            $this->perPageNum = $pageCount;
        }
        
    }
	
}

?>