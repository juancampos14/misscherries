<?php

namespace Brooktec\Helpers;

spl_autoload_register(function ($class_name) {
    $class_name = str_replace(__NAMESPACE__ . '\\', '', $class_name);
    $file = trailingslashit(__DIR__) . "helpers/{$class_name}.php";
    if (file_exists($file)) {
        require_once($file);
    }
});
