<?php

namespace App\Traits\ContractTraits;
use \stdClass;

trait ContractEncriptionTrait {
    private $keys = ['id'];
    
    private function encryptKeys (&$data) {
		foreach ($this->keys as $key) {
		    $this->encryptKey($data, $key);
        }
	}
	private function encryptKey (&$data, $key) {
        if (isset($data[$key])) {
            if (!is_null($data[$key])) {
                    $data[$key] = encrypt($data[$key]);
            }
        }
        foreach ($data as $counter => &$element) {
             if(is_object($element)){
                $this->encryptObject($element, $key);
            }
            if($element instanceof stdClass){
                $this->encryptStd($element, $key);
            }
            if (is_array($element) || is_countable($element)) {
                $this->encryptKey($element, $key);
            }
            
        }
    }
    private function encryptObject(&$data, $key){
        if(isset($data->incrementing)){
            $data->incrementing = false;
        }
        if(isset($data->$key)){
            if(!is_null($data->$key)){
                $data->$key = encrypt($data->$key);
            }
        }
    }
    
    private function encryptStd(&$data, $key){
        $values = (array)$data;
        foreach ($values as $value) {
            if(is_array($value)){
                $this->encryptKey($value, $key);
            }
    }
    }
}