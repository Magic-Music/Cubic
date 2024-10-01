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

        $file = getcwd() . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }
}
