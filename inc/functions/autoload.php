<?php

/**
 * Autoload of Classes
 */
spl_autoload_register(function ($class) {
    include 'class-' . strtolower($class) . '.php';
});

/*
 * Load .env
 * Works in both local (MAMP with subdirectories) and production environments
 */
// Get the project root directory (2 levels up from this file: inc/functions/)
$projectRoot = dirname(dirname(__DIR__));
$envFilepath = $projectRoot . '/.env';

if (is_file($envFilepath)) {
    $file = new \SplFileObject($envFilepath);

    // Loop until we reach the end of the file.
    while (false === $file->eof()) {
        $line = trim($file->fgets());

        // Skip empty lines and comments
        if (empty($line) || strpos($line, '#') === 0) {
            continue;
        }

        // Remove quotes and set environment variable
        putenv(str_replace('"', '', $line));
    }
}
?>