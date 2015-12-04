<?php
namespace Rap2hpoutre\Jacky\Exception;
class Exception extends \RuntimeException 
{

    protected $response;

    public function __construct($response, $code, $message = 'No message.', \Exception $previous = null)
    {
        $this->response = $response;
        parent::__construct($message, $code, $previous);
    }

    public function __get($key) 
    {
        return $this->response->$key;
    }
}
