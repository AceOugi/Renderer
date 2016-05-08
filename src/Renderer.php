<?php

namespace AceOugi;

class Renderer
{
    /** @var array */
    protected static $__data = [];

    /** @var string */
    protected $path;
    /** @var array */
    protected $data;

    /**
     * Renderer constructor.
     * @param string $path
     * @param array $data
     */
    public function __construct(string $path, array $data = [])
    {
        $this->path = $path;
        $this->data = $data;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public static function set(string $key, $value)
    {
        static::$__data[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public static function get(string $key)
    {
        return static::$__data[$key] ?? null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function has(string $key)
    {
        return (isset(static::$__data[$key]) OR array_key_exists($key, static::$__data)) ? true : false;
    }

    /**
     * @param string $key
     * @param $value
     * @return self
     */
    public function with(string $key, $value)
    {
        $new = clone $this;
        $new->data[$key] = $value;
        return $new;
    }

    /**
     * @param string $key
     * @return self
     */
    public function without(string $key)
    {
        $new = clone $this;
        unset($new->data[$key]);
        return $new;
    }

    public function make()
    {
        extract(static::$__data + $this->data);
        include $this->path;
    }

    /**
     * @return string
     */
    public function makeToString()
    {
        ob_start();
        $this->make();
        return ob_get_clean();
    }

    /**
     * @param string $path
     * @param array $data
     */
    public static function display(string $path, array $data = [])
    {
        (new static($path, $data))->make();
    }

    /**
     * @param string $path
     * @param array $data
     * @return string
     */
    public static function render(string $path, array $data = [])
    {
        return (new static($path, $data))->makeToString();
    }
}
