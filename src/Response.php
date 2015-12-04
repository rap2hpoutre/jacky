<?php namespace Rap2hpoutre\Jacky;

class Response 
{

    private $properties;
    private $body;

    public function __construct($body, $accessors)
    {
        $this->body = $body;
        $this->properties = json_decode($this->body);
        
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
    
    public function __toString() 
    {
        return $this->body;
    }
}
