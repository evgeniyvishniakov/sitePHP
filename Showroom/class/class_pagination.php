<?php

include_once 'class_filter.php';

class Pagination{

    public $count_pages_array;

    public function __construct(){
        $this->count_pages_array = Filter::filterBD();
    }

    public function NumberPages() {
        
        return $row;
    }
    
}

?>