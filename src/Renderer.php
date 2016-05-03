<?php

namespace AceOugi;

class Renderer
{
    /**
     * @param string $__PATH
     * @param array $__DATA
     */
    public static function display(string $__PATH, array $__DATA = [])
    {
        extract($__DATA);
        include $__PATH;
    }

    /**
     * @param string $__PATH
     * @param array $__DATA
     * @return string
     */
    public static function render(string $__PATH, array $__DATA = [])
    {
        ob_start();
        static::display($__PATH, $__DATA);
        return ob_get_clean();
    }
}
