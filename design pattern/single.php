<?php

abstract class SingleObject
{
    
    /**-----  Instanciation -----**/
    protected function __construct() {
    }
    
    public static function getInstance() {
        static $instance = array();
        $class = get_called_class();
        
        if (isset($instance[$class]) === false){
            $instance[$class] = new $class();
        }

        return $instance[$class];
    }
    
    /**-----  Clonage -----**/
    
    protected function __clone() {
    }
}

class Connect extends SingleObject
{
    public $pdo;

    protected function __construct() {
    }

    public function getPdo(){
        echo "PDO";
    }

}

$pdo1 = Connect::getInstance();
$pdo2 = Connect::getInstance();
$pdo1->pdo = 'tweet';
/*$pdo3 = $pdo2->__clone();
var_dump($pdo3);
$pdo4 = new Connect();*/

var_dump($pdo1, $pdo2);