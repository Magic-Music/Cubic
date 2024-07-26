<?php

use Cubic\Container;
use Cubic\Files\File;

function create($class)
{
    return Container::getClass($class);
}

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

function array_join(string $separator, string|array $subject): string
{
    if (is_array($subject)) {
        $subject = implode($separator, $subject);
    }

    return $subject;
}

function array_wrap(string|array|null $subject): array
{
    if (!is_array($subject)) {
        $subject = [$subject];
    }

    return $subject;
}

function app_root(): string
{
    return create(File::class)->rootFolder();
}