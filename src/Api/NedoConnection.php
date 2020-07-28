<?php

namespace Nedoquery\Api;

class NedoConnection {
    
    private $base_url;
    private $username;
    private $password;
    
    public function __construct($base_url, $username, $password) {
        $this->base_url = $base_url;
        $this->username = $username;
        $this->password = $password;
    }


    public function getFile($path){
        $full_url = "plugin.json?plugin=db_file&id=" . $path;
        $result = $this->request($full_url, [], [], TRUE, 'POST', FALSE);
        
        return $result;
    }

    public function request($url, $params = [], $header = [], $attachConfig = true, $requestMethod = 'POST', $jsonEncode = true){
        $full_url = $this->base_url . '/' . $url;
        if ($attachConfig){
            $this->attachConfig($params);
        }
        
        $header_formated = null;
        if (count($header) > 0){
            foreach($header as $k => $v){
                $header_formated[] = $k . ': ' . $v;
            }
        }
        $result = null;
        if ($requestMethod == 'POST'){
            $result = $this->curlRequest($full_url, $params, $header_formated);
        }
        else{
            $result = $this->curlGetRequest($full_url, $params, $header_formated);
        }
        if ($jsonEncode){
            $jsonResult = json_decode($result);
            return $jsonResult;
        }
        
        return $result;
    }

    private function attachConfig(&$params){
        $params['hippo_username'] = $this->username;
        $params['hippo_password'] = $this->password;
    }


    private function curlRequest($url, $params, $headers = null){
        
        $post_string = $this->getPostString($params);
        $normalize_url = $this->normalizeUrl($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $normalize_url);
        curl_setopt($ch, CURLOPT_POST, count($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        if ($headers != null){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $result = curl_exec($ch);
        curl_close($ch);
        
        return $result;
    }
    
    public function curlGetRequest($url, $params, $headers = null){
        $post_string = $this->getPostString($params);
        $normalize_url = $this->normalizeUrl($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $normalize_url . '?' . $post_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        if ($headers != null){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $result = curl_exec($ch);
        curl_close($ch);
        
        return $result;
    }

    private function normalizeUrl($url){
        return str_replace(' ', '%20', $url);
    }
    
    private function getPostString($params){
        $fields_string = '';
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $fields_string .= $key . '=' . json_encode($value) . '&';
            } else {
                $fields_string .= $key . '=' . $value . '&';
            }
        }

        $post_string = rtrim($fields_string, '&');
        
        return $post_string;
    }
}