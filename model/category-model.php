<?php

class ProductCategory implements IModel {
    private $category_id;    //auto increment
    private $category_name;

    function __construct($arr) {
        if (!empty($arr['category_id'])) {
            $this->category_id = $arr['category_id'];
        }
        $this->category_name = $arr['category_name'];
        
    }

    function getCategoryId() {
        return $this->category_id;
    }
   
    function getCategoryName() {
        return $this->category_name;
    }
}


?>