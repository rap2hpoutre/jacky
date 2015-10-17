<?php
namespace Rap2hpoutre\HttpClient\Exception;
class Exception extends \RuntimeException 
{

    protected $response;

    public function __construct($response, $code, \Exception $previous = null)
    {
        $message = (string)$response;
        $this->response = $response;
        parent::__construct($message, $code, $previous);
    }

    public function __get($key) 
    {
        return $this->response->$key;
    }
}
