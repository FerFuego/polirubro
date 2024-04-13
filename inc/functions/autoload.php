<?php

/**
 * Autoload of Classes
 */
spl_autoload_register( function ($class) {
    include 'class-' . strtolower($class) . '.php';
});

/*
 * Load .env
 */
$root = $_SERVER['DOCUMENT_ROOT'];
$envFilepath = "$root/.env";

if (is_file($envFilepath)) {
    $file = new \SplFileObject($envFilepath);

    // Loop until we reach the end of the file.
    while (false === $file->eof()) {
        // Get the current line value, trim it and save by putenv.
        putenv(trim($file->fgets()));
    }
}
?>