<?php
$logFilePath = __DIR__ . '/storage/logs/laravel.log';
if (!file_exists($logFilePath)) {
    echo "Log file not found.\n";
    exit;
}

$contents = file_get_contents($logFilePath);
// The file might be UTF-16LE, let's try to convert it if it has null bytes
if (strpos($contents, "\0") !== false) {
    $contents = mb_convert_encoding($contents, 'UTF-8', 'UTF-16LE');
}

$lines = explode("\n", $contents);
$lastLines = array_slice($lines, -150);
echo implode("\n", $lastLines);
