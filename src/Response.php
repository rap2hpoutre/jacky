<?php namespace Rap2hpoutre\Jacky;

use Illuminate\Contracts\Support\Arrayable;
use Iterator;

/**
 * Class Response
 * @package Rap2hpoutre\Jacky
 */
class Response implements Iterator, Arrayable
{

    /**
     * @var mixed
     */
    private $properties;
    /**
     * @var
     */
    private $body;

    /**
     * Response constructor.
     * @param $body
     * @param $accessors
     */
    public function __construct($body, $accessors)
    {
        $this->body = $body;
        $this->properties = json_decode($this->body);

        foreach ($accessors as $key => $callback) {
            if (isset($this->properties->$key)) {
                $this->properties->$key = call_user_func($callback, $this->properties->$key);
            }
        }
    }

    /**
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->properties->$key;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->body;
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return current($this->properties);
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        next($this->properties);
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return key($this->properties);
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return !!current($this->properties);
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        reset($this->properties);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return (array)$this->properties;
    }

    /**
     * Get properties has collection.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect($this->toArray());
    }
}
