<?php

namespace Cubic;

use Cubic\Cli\Cli;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class File
{
    private string $rootFolder;

    public function __construct()
    {
        $this->rootFolder = dirname(__dir__) . DIRECTORY_SEPARATOR;
    }

    public function rootFolder(): string
    {
        return $this->rootFolder ?? DIRECTORY_SEPARATOR;
    }

    public function search(string $folder, string|array|null $extensions = null): array
    {
        $files = [];
        $extensions = array_wrap($extensions);
        $folder = str_replace('\\', DIRECTORY_SEPARATOR, $folder);

        $iterator = new RecursiveDirectoryIterator($this->rootFolder . $folder);
        foreach(new RecursiveIteratorIterator($iterator) as $file) {
            if (!$extensions || in_array($file->getExtension(), $extensions)) {
                $files[] = [
                    'path' => str_replace($this->rootFolder, '', $file->getPath()),
                    'file' => $file->getFilename(),
                    'file_no_extension' => str_replace('.' . $file->getExtension(), '', $file->getFilename()),
                ];
            }
        }

        return $files;
    }

    public function writeStringToFile(string $filename, string $string): void
    {
        file_put_contents($this->filesFolder() . $filename, $string);
    }

    public function writeCsv(string $filename, array $array): void
    {
        $handle = fopen($this->filesFolder() . $filename, 'w');

        fputcsv($handle, array_keys($array[0] ?? []));
        foreach ($array as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);
    }
}