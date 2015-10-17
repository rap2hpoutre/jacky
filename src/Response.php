<?php namespace Rap2hpoutre\HttpClient;

class Response 
{

    private $properties;
    
    public function __construct($body, $accessors)
    {
        $this->properties = json_decode($body);
        
        foreach($accessors as $key => $callback) {
            if (isset($this->properties->$key)) {
                $this->properties->$key = call_user_func($callback, $this->properties->$key);
            }
        }
    }
    
    public function __get($key)
    {
        return $this->properties->key;
    }
}
