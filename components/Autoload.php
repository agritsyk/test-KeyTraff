<?php
declare(strict_types=1);

function myAutoLoader($className): void
{
    $array_path = array(
        '/models/',
        '/components/'
    );

    foreach ($array_path as $path) {
        $path = ROOT . $path . $className . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}