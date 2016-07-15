<?php

namespace Ace;

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
        self::$__data[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public static function get(string $key)
    {
        return self::$__data[$key] ?? null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function has(string $key)
    {
        return (isset(self::$__data[$key]) OR array_key_exists($key, self::$__data)) ? true : false;
    }


    public function make()
    {
        extract(self::$__data + $this->data);
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
