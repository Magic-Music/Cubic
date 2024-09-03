<?php

namespace Cubic;

new Autoload();

class Autoload
{
    public function __construct()
    {
        spl_autoload_register([$this, 'autoload']);
    }

    public function autoload(string $class): void
    {

        $file = getcwd() . '/' . $class . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }
}
