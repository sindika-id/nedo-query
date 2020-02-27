<?php

namespace Nedoquery\Api;

class NedoRequest {
    
    private $config;
    private $connection;

    
    private $select = [];
    private $from = [];
    private $filter = null;
    private $advsearch = [];
    private $order = [];

    public function __construct($config) {
        $this->config = $config;
        $this->connection = new NedoConnection($config['domain'], $config['service_code'], $config['service_secret']);
    }

    public function getConfig(){
        return $this->config;
    }
    
    public function request($url, $params, $header = [], $attachConfig = false){
        return $this->connection->request($url, $params, $header, $attachConfig);
    }
    
    public function select($fields){
        if (is_string($fields)){
            if (strpos($fields, ',') > 0){
                $fields = explode(',', $fields);
                foreach($fields as $f){
                    if (!in_array(trim($f), $this->select)){
                        $this->select[] = trim($f);
                    }
                }
            }
            else {
                if (!in_array(trim($f), $this->select)){
                    $this->select[] = $f;
                }
            }
        }
        else if (is_array($fields)){
            foreach($fields as $f){
                $this->select[] = $f;
            }
        }
        
        return $this;
    }
    
    public function from($from){
        $this->from = $from;
        return $this;
    }
    
    public function filter($field, $op, $value){
        $this->advsearch[] = [
            'name' => $field,
            'op' => $op,
            'val' => $value
        ];
        
        return $this;
    }

    public function order($field, $direction = 'ASC'){
        $order = new \stdClass();
        $order->field_name = $field;
        $order->sort = $direction;
        
        $this->order[] = $order;
        return $this;
    }
    
    public function search($text){
        $this->filter = $text;
        return $this;
    }

    public function get(){
        $params = $this->compileParam();
        $result = $this->request($this->from . '/index.mod', $params);
        
        $this->reset();
        return $result;
    }
    
    private function compileParam(){
        $params = [];
        $params['select'] = $this->select;
        
        if ($this->filter != null){
            $params['filter'] = $this->filter;
        }
        if ($this->advsearch != []){
            $data = array();
            foreach($this->advsearch as $as){
                $objData = new \stdClass();
                $objData->field_name = $as['name'];
                $objData->operator = $as['op'];
                if (is_array($as['val'])){
                    $objData->value = $as['val'];
                }
                else{
                    $objData->value = [$as['val']];
                }
                $data[] = $objData;
            }
            
            $opLogical = new \stdClass();
            $opLogical->logical = 'and';
            $opLogical->data = $data;
            
            $params['advsearch'] = [$opLogical];
        }
        if ($this->order != []){
            $params['order'] = $this->order;
        }
        
        return $params;
    }
    
    private function reset(){
        $this->select = [];
        $this->from = null;
        $this->filter = null;
        $this->advsearch = [];
    }
}