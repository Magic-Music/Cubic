<?php

use Cubic\Container;

if (!function_exists('create')) {
    function create($class)
    {
        return Container::getClass($class);
    }
}

if (!function_exists('throw_if')) {
    function throw_if($condition, $exception = 'RuntimeException', ...$parameters)
    {
        if ($condition) {
            if (is_string($exception) && class_exists($exception)) {
                $exception = new $exception(...$parameters);
            }

            throw is_string($exception) ? new RuntimeException($exception) : $exception;
        }

        return $condition;
    }
}

if (!function_exists('array_join')) {
    function array_join(string $separator, string|array $subject): string
    {
        if (is_array($subject)) {
            $subject = implode($separator, $subject);
        }

        return $subject;
    }
}

if (!function_exists('array_wrap')) {
    function array_wrap(string|array|null $subject): array
    {
        if (!is_array($subject)) {
            $subject = [$subject];
        }

        return $subject;
    }
}
