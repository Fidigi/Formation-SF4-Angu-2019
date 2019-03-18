<?php
namespace App\Controller;

abstract class OBase
{
    public function __call($name, $arguments = array()) {
        $matches = null;
        //setter
        if (preg_match('/^set([a-zA-Z0-9]+)/', $name, $matches)) {
        	$sProp = str_replace(' ', '', ucwords(str_replace('_', ' ', $matches[1])));
        	$sProp[0] = strtolower($sProp[0]);
            $this->$sProp = $arguments[0];
            return $this;
        }
        //getter
        elseif (preg_match('/^get([a-zA-Z0-9]+)/', $name, $matches)) {
            $sProp = str_replace(' ', '', ucwords(str_replace('_', ' ', $matches[1])));
            if(isset($this->$sProp)){
                return $this->$sProp;
            } else {
                return null;
            }
            
        }
    }
    
    public static function factory($object, $data = null) {
        if (is_array($data) || is_object($data)) {
            foreach ($data as $property => $value){
            	$sProp = str_replace(' ', '', ucwords(str_replace('_', ' ', $property)));
                $setProperty = "set".$sProp;
                call_user_func(array( $object , $setProperty), $value);
            }
        }
        return $object;
    }
}