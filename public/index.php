<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

require_once join(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'vendor', 'autoload.php']);
define('TEMPLATES_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates');


$loader = new FilesystemLoader(TEMPLATES_PATH);
$twig = new Environment($loader);
$logger = new LoggerWrapper("Logger");
$logs = $logger->getLogsFromNewer();

try {
    echo $twig->render('index.html', ['logs' => $logs]);
} catch (LoaderError | RuntimeError | SyntaxError $e) {
    $logger->critical($e);
}