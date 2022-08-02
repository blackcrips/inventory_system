<?php
spl_autoload_register('autoLoadClasses');

function autoLoadClasses($classname)
{
    $path = './classes/';
    $extension = '.class.php';
    $filename = $path . strtolower($classname) . $extension;

    if (!file_exists(strtolower($filename))) {
        return false;
    }

    include_once $path . strtolower($classname) . $extension;
}