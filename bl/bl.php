<?php
    require_once '../dal/dal.php';

abstract class BusinessLogic 
{
    protected $dal;

    public function __construct() 
    {
        $this->dal = DataAccessLayer::Instance();
    }
    abstract function get();
    abstract function set($data);
    abstract function update($data, $data2);
    abstract function delete($data);
}

?>