<?php

$required_files = [
    'enqueue',
    'support',
];

foreach ($required_files as $required_file) {
    require_once(trailingslashit(__DIR__) . "_{$required_file}.config.php");
}
