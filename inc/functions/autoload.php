<?php

/**
 * Autoload of Classes
 */
spl_autoload_register( function ($class) {
    include 'class-' . strtolower($class) . '.php';
});

?>