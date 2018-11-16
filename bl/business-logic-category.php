<?php
 require_once 'bl.php';
 require_once '../model/category-model.php'; 
class BusinessLogicCategory extends BusinessLogic {
   
   
    function getOne($id) {
        $query = "SELECT * FROM `products_categories` WHERE category_id= :cid";

        $results = $this->dal->select($query, [
            'cid' => $id
        ]);
        $row = $results->fetch();
        return new ProductCategory($row);
    }

    function get() {
        $query = 'SELECT * FROM `products_categories`';
            
        $result = $this->dal->select($query);
        $resultsArray = [];
        
        while ($row = $result->fetch()) {
            array_push($resultsArray, new ProductCategory($row));
        }
        
        return $resultsArray;
    }
 
    function set($data) {
        $query = "INSERT INTO `products_categories`(`category_name`) VALUES (:cname)";

        $params = array(
            'cname' => $data->getCategoryName()
        );

        $this->dal->insert($query, $params);  
    }

    function update($data, $data2) {

    }

    function delete($data) {

    }

}
?>