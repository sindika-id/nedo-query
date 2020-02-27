<?php

namespace Nedoquery\Api;

class NedoRequestService{
    
    private $nedoRequest;
    
    public function __construct(
        array $config = null
    )
    {
        $this->nedoRequest = new NedoRequest($config);
    }
}
